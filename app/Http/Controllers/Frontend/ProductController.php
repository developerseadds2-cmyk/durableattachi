<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->active()
            ->with(['category', 'brand', 'images', 'attributes', 'approvedReviews.user'])
            ->firstOrFail();

        $product->increment('views');

        $related = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('category')
            ->limit(4)
            ->get();

        $isWishlisted = false;
        if (auth()->check()) {
            $isWishlisted = $product->wishlists()->where('user_id', auth()->id())->exists();
        }

        return view('frontend.product.show', compact('product', 'related', 'isWishlisted'));
    }

    public function storeReview(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title'  => 'nullable|string|max:191',
            'body'   => 'required|string|min:10',
        ]);

        // Check if already reviewed
        $existing = Review::where('product_id', $id)->where('user_id', auth()->id())->first();
        if ($existing) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        Review::create([
            'product_id' => $id,
            'user_id'    => auth()->id(),
            'rating'     => $request->rating,
            'title'      => $request->title,
            'body'       => $request->body,
            'status'     => 'pending',
        ]);

        return back()->with('success', 'Your review has been submitted and is pending approval.');
    }

    public function search(Request $request)
    {
        $q       = $request->q;
        $products = collect();

        if ($q && strlen($q) >= 2) {
            $products = Product::active()
                ->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                          ->orWhere('sku', 'like', "%{$q}%")
                          ->orWhere('short_description', 'like', "%{$q}%")
                          ->orWhereHas('category', fn($cq) => $cq->where('name', 'like', "%{$q}%"));
                })
                ->with('category')
                ->paginate(12)
                ->withQueryString();
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'count' => $products->count(),
                'products' => $products->map(function ($p) {
                    return [
                        'id' => $p->id,
                        'name' => $p->name,
                        'slug' => $p->slug,
                        'url' => route('product.show', $p->slug),
                        'image' => $p->primary_image ?: asset('uploads/placeholder.png'),
                        'category' => $p->category ? $p->category->name : '',
                        'price' => number_format($p->price, 2),
                        'sale_price' => $p->sale_price ? number_format($p->sale_price, 2) : null,
                    ];
                })
            ]);
        }

        return view('frontend.shop.search', compact('products', 'q'));
    }
}
