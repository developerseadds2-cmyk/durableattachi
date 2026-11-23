<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active()->with('category', 'brand');

        $this->applyFilters($query, $request);

        $products   = $query->paginate(12)->withQueryString();
        $categories = Category::active()->whereNull('parent_id')->with('children')->withCount('products')->get();
        $brands     = Brand::where('status', true)->withCount('products')->get();
        $priceRange = ['min' => 0, 'max' => Product::active()->max('price') ?? 100000];

        return view('frontend.shop.index', compact('products', 'categories', 'brands', 'priceRange'));
    }

    public function category(string $slug)
    {
        $category = Category::where('slug', $slug)->active()->firstOrFail();

        // Get all child category IDs
        $categoryIds = [$category->id];
        foreach ($category->children as $child) {
            $categoryIds[] = $child->id;
        }

        $products = Product::active()
            ->whereIn('category_id', $categoryIds)
            ->with('category')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::active()->whereNull('parent_id')->with('children')->get();

        return view('frontend.shop.category', compact('category', 'products', 'categories'));
    }

    private function applyFilters($query, Request $request): void
    {
        if ($request->category) {
            $cat = Category::where('slug', $request->category)->first();
            if ($cat) {
                $ids = [$cat->id, ...$cat->children->pluck('id')->toArray()];
                $query->whereIn('category_id', $ids);
            }
        }

        if ($request->brand) {
            $query->whereHas('brand', fn($q) => $q->where('slug', $request->brand));
        }

        if ($request->min_price) $query->where('price', '>=', $request->min_price);
        if ($request->max_price) $query->where('price', '<=', $request->max_price);

        if ($request->metal_type) $query->where('metal_type', $request->metal_type);
        if ($request->stone_type) $query->where('stone_type', $request->stone_type);

        if ($request->featured) $query->featured();
        if ($request->new_arrival) $query->newArrivals();

        switch ($request->sort) {
            case 'price_asc':    $query->orderBy('price'); break;
            case 'price_desc':   $query->orderByDesc('price'); break;
            case 'newest':       $query->latest(); break;
            case 'name_asc':     $query->orderBy('name'); break;
            case 'best_seller':  $query->bestSellers()->orderBy('name'); break;
            default:             $query->latest(); break;
        }
    }
}
