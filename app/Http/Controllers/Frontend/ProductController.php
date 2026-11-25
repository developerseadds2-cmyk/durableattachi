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
            ->with(['category', 'brand', 'color', 'size', 'images', 'attributes', 'approvedReviews.user'])
            ->firstOrFail();

        $product->increment('views');

        // Track recently viewed products in session
        $recentlyViewed = session()->get('recently_viewed_products', []);
        if (!in_array($product->id, $recentlyViewed)) {
            array_unshift($recentlyViewed, $product->id);
            // keep up to 20 recently viewed items
            $recentlyViewed = array_slice($recentlyViewed, 0, 20);
            session()->put('recently_viewed_products', $recentlyViewed);
        }

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

        $rules = [
            'rating' => 'required|integer|min:1|max:5',
            'title'  => 'nullable|string|max:191',
            'body'   => 'required|string|min:5|max:2000',
        ];

        if (!auth()->check()) {
            $rules['customer_name']  = 'required|string|max:100';
            $rules['customer_email'] = 'required|email|max:150';
        }

        $request->validate($rules);

        $userId = auth()->id();
        $customerName = auth()->check() ? auth()->user()->name : $request->customer_name;
        $customerEmail = auth()->check() ? auth()->user()->email : $request->customer_email;

        Review::create([
            'product_id'     => $id,
            'user_id'        => $userId,
            'customer_name'  => $customerName,
            'customer_email' => $customerEmail,
            'rating'         => $request->rating,
            'title'          => $request->title,
            'body'           => $request->body,
            'status'         => 'pending', // Strictly pending until admin approval
        ]);

        return back()->with('success', 'Thank you! Your review has been submitted and will appear once approved by our team.');
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
