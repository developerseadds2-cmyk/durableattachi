<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use App\Models\BlogPost;
use App\Models\Page;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders      = Slider::active()->get();
        $categories   = Category::active()->whereNull('parent_id')->withCount('products')->orderBy('sort_order')->get();
        $featured     = Product::active()->featured()->with('category')->limit(10)->get();
        $newArrivals  = Product::active()->newArrivals()->with('category')->latest()->limit(10)->get();
        $bestSellers  = Product::active()->bestSellers()->with('category')->limit(10)->get();
        $banners      = Banner::active()->where('type', 'promo')->get();
        $recentPosts  = BlogPost::published()->with('author', 'category')->latest('published_at')->limit(3)->get();

        return view('frontend.home.index', compact(
            'sliders', 'categories', 'featured', 'newArrivals', 'bestSellers', 'banners', 'recentPosts'
        ));
    }

    public function newsletter(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        Newsletter::firstOrCreate(['email' => $request->email]);
        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }

    public function page(string $slug)
    {
        $page = Page::where('slug', $slug)->active()->firstOrFail();

        return view('frontend.page', compact('page'));
    }
}
