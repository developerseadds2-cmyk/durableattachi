<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('author', 'category')->latest()->paginate(20);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::where('status', true)->orderBy('name')->get();
        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:191',
            'body'      => 'nullable|string',
            'category_id' => 'nullable|exists:blog_categories,id',
            'status'    => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except(['_token', 'thumbnail']);
        $data['user_id']     = auth()->id();
        $data['slug']        = $this->uniqueSlug($request->title);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['status']      = $request->status ?? 'draft';
        if ($request->status === 'published') $data['published_at'] = now();

        if ($request->hasFile('thumbnail')) {
            File::ensureDirectoryExists(public_path('uploads/blog'));
            $file     = $request->file('thumbnail');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blog'), $filename);
            $data['thumbnail'] = $filename;
        }

        BlogPost::create($data);
        return redirect()->route('admin.blog.index')->with('success', 'Blog post created.');
    }

    public function edit(BlogPost $blog)
    {
        $categories = BlogCategory::where('status', true)->orderBy('name')->get();
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, BlogPost $blog)
    {
        $request->validate([
            'title'       => 'required|string|max:191',
            'category_id' => 'nullable|exists:blog_categories,id',
            'status'      => 'required|in:draft,published',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except(['_token', '_method', 'thumbnail']);
        $data['slug']        = $this->uniqueSlug($request->title, $blog->id);
        $data['is_featured'] = $request->boolean('is_featured');
        if ($request->status === 'published' && !$blog->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            File::ensureDirectoryExists(public_path('uploads/blog'));
            if ($blog->thumbnail) @unlink(public_path('uploads/blog/' . $blog->thumbnail));
            $file     = $request->file('thumbnail');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/blog'), $filename);
            $data['thumbnail'] = $filename;
        }

        $blog->update($data);
        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated.');
    }

    public function destroy(BlogPost $blog)
    {
        if ($blog->thumbnail) @unlink(public_path('uploads/blog/' . $blog->thumbnail));
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Post deleted.');
    }

    public function show(BlogPost $blog)
    {
        return redirect()->route('admin.blog.edit', $blog);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title) ?: 'blog-post';
        $slug = $baseSlug;
        $counter = 2;

        while (BlogPost::where('slug', $slug)->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        return $slug;
    }
}
