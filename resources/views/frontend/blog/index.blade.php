@extends('frontend.layouts.app')
@section('title', 'Blog — Ayur Naman')

@section('content')
<div style="background:var(--pd-ice);padding:60px 0;text-align:center;">
  <span class="section-label">Our Journal</span>
  <h1 style="font-family:var(--font-serif);font-size:2.5rem;font-weight:400;">Jewelry Blog</h1>
</div>

<div class="container-xl-custom py-5">
  <div class="row g-5">
    <!-- Posts -->
    <div class="col-lg-8">
      @forelse($posts as $post)
      <div class="d-flex gap-4 mb-5 pb-5" style="border-bottom:1px solid var(--border);" data-aos="fade-up">
        <a href="{{ route('blog.show', $post->slug) }}" style="flex:0 0 220px;height:180px;overflow:hidden;display:block;">
          <img src="{{ $post->thumbnail_url }}" style="width:100%;height:100%;object-fit:cover;transition:transform 0.4s;" alt="{{ $post->title }}" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
        </a>
        <div>
          <div class="blog-cat">{{ $post->category?->name ?? 'Jewelry' }}</div>
          <a href="{{ route('blog.show', $post->slug) }}">
            <h2 style="font-family:var(--font-serif);font-size:1.5rem;font-weight:400;color:var(--dark);margin-bottom:10px;line-height:1.3;">{{ $post->title }}</h2>
          </a>
          <p class="text-muted small mb-3">{{ Str::limit($post->excerpt ?? strip_tags($post->body), 150) }}</p>
          <div class="d-flex align-items-center gap-3 small text-muted">
            <span><i class="bi bi-person me-1"></i>{{ $post->author?->name }}</span>
            <span><i class="bi bi-calendar3 me-1"></i>{{ $post->published_at?->format('d M Y') }}</span>
            <span><i class="bi bi-clock me-1"></i>{{ $post->reading_time }} min</span>
          </div>
        </div>
      </div>
      @empty
      <div class="text-center py-5 text-muted">No blog posts yet.</div>
      @endforelse
      <div class="mt-3">{{ $posts->links() }}</div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
      <!-- Categories -->
      <div style="background:var(--pd-ice);padding:24px;margin-bottom:24px;">
        <h5 style="font-family:var(--font-serif);font-size:1.2rem;margin-bottom:16px;">Categories</h5>
        @foreach($categories as $cat)
        <a href="{{ route('blog.index', ['category' => $cat->slug]) }}" class="d-flex justify-content-between py-2" style="border-bottom:1px solid var(--border);color:var(--text);">
          <span>{{ $cat->name }}</span>
          <span class="text-muted small">({{ $cat->posts_count }})</span>
        </a>
        @endforeach
      </div>

      <!-- Recent Posts -->
      <div style="background:var(--pd-ice);padding:24px;">
        <h5 style="font-family:var(--font-serif);font-size:1.2rem;margin-bottom:16px;">Recent Posts</h5>
        @foreach($recent as $rp)
        <div class="d-flex gap-3 mb-3 pb-3" style="border-bottom:1px solid var(--border);">
          <img src="{{ $rp->thumbnail_url }}" style="width:60px;height:60px;object-fit:cover;" alt="{{ $rp->title }}">
          <div>
            <a href="{{ route('blog.show', $rp->slug) }}" class="small fw-600 d-block" style="color:var(--dark);">{{ Str::limit($rp->title, 50) }}</a>
            <span class="text-muted" style="font-size:0.72rem;">{{ $rp->published_at?->format('d M Y') }}</span>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
