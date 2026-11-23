@extends('frontend.layouts.app')
@section('title', $post->meta_title ?? $post->title . ' — Ayur Naman')
@section('meta_description', $post->meta_description ?? $post->excerpt)

@section('content')

<!-- Hero -->
<div style="background:var(--pd-ice);padding:60px 0 40px;">
  <div class="container-xl-custom">
    <div style="max-width:800px;margin:0 auto;text-align:center;">
      @if($post->category)
        <a href="{{ route('blog.index') }}" style="font-size:0.7rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--pd-blue);margin-bottom:16px;display:inline-block;">
          {{ $post->category->name }}
        </a>
      @endif
      <h1 style="font-family:var(--font-serif);font-size:2.8rem;font-weight:400;color:var(--dark);line-height:1.2;margin-bottom:20px;">{{ $post->title }}</h1>
      <div class="d-flex align-items-center justify-content-center gap-3 text-muted small">
        @if($post->author)
          <span><i class="bi bi-person me-1"></i>{{ $post->author->name }}</span>
          <span style="color:var(--border);">|</span>
        @endif
        <span><i class="bi bi-calendar3 me-1"></i>{{ ($post->published_at ?? $post->created_at)->format('d M Y') }}</span>
        @if($post->reading_time)
          <span style="color:var(--border);">|</span>
          <span><i class="bi bi-clock me-1"></i>{{ $post->reading_time }} min read</span>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- Featured Image -->
@if($post->thumbnail)
<div style="max-width:900px;margin:0 auto;padding:0 40px 48px;">
  <img src="{{ $post->thumbnail_url }}" alt="{{ $post->title }}" style="width:100%;max-height:500px;object-fit:cover;">
</div>
@endif

<!-- Content -->
<div class="container-xl-custom pb-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      @if($post->excerpt)
      <p style="font-family:var(--font-serif);font-size:1.2rem;color:var(--text-muted);line-height:1.7;margin-bottom:32px;border-left:3px solid var(--pd-blue);padding-left:20px;">
        {{ $post->excerpt }}
      </p>
      @endif

      <div class="blog-content" style="font-size:0.95rem;line-height:1.9;color:var(--text);">
        {!! $post->body !!}
      </div>

      <!-- Share -->
      <div class="mt-4 d-flex align-items-center gap-3">
        <span class="text-muted small">Share:</span>
        <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="social-link" style="width:32px;height:32px;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-muted);" title="Share on Facebook">
          <i class="bi bi-facebook"></i>
        </a>
        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank" class="social-link" style="width:32px;height:32px;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-muted);" title="Share on Twitter">
          <i class="bi bi-twitter-x"></i>
        </a>
        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->url()) }}" target="_blank" class="social-link" style="width:32px;height:32px;border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--text-muted);" title="Share on WhatsApp">
          <i class="bi bi-whatsapp"></i>
        </a>
      </div>

      <!-- Back -->
      <div class="mt-5">
        <a href="{{ route('blog.index') }}" class="btn-outline-glamora" style="padding:10px 24px;font-size:0.75rem;">
          <i class="bi bi-arrow-left me-1"></i> Back to Journal
        </a>
      </div>
    </div>
  </div>
</div>

@push('styles')
<style>
.blog-content h2 { font-family:var(--font-serif);font-size:1.8rem;font-weight:400;color:var(--dark);margin:36px 0 16px; }
.blog-content h3 { font-family:var(--font-serif);font-size:1.4rem;font-weight:400;color:var(--dark);margin:28px 0 12px; }
.blog-content p { margin-bottom:20px; }
.blog-content img { max-width:100%;height:auto;margin:24px 0; }
.blog-content ul, .blog-content ol { padding-left:24px;margin-bottom:20px; }
.blog-content li { margin-bottom:8px; }
.blog-content blockquote { border-left:3px solid var(--pd-blue);padding:16px 20px;margin:28px 0;background:var(--pd-ice);font-family:var(--font-serif);font-size:1.1rem;font-style:italic;color:var(--text); }
.blog-content a { color:var(--pd-blue);text-decoration:underline; }
</style>
@endpush
@endsection
