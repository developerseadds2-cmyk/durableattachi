<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    public function index()
    {
        $posts      = BlogPost::published()->with('author', 'category')->latest('published_at')->paginate(9);
        $featured   = BlogPost::published()->where('is_featured', true)->with('author')->latest('published_at')->first();
        $categories = BlogCategory::withCount(['posts' => fn($q) => $q->published()])->where('status', true)->get();
        $recent     = BlogPost::published()->latest('published_at')->limit(5)->get();

        return view('frontend.blog.index', compact('posts', 'featured', 'categories', 'recent'));
    }

    public function show(string $slug)
    {
        $post = BlogPost::where('slug', $slug)->published()->with('author', 'category')->firstOrFail();
        $post->increment('views');

        $related = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->limit(3)
            ->get();

        $recent = BlogPost::published()->where('id', '!=', $post->id)->latest('published_at')->limit(5)->get();

        return view('frontend.blog.show', compact('post', 'related', 'recent'));
    }
}
