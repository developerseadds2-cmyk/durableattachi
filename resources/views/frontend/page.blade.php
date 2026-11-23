@extends('frontend.layouts.app')
@section('title', $page->meta_title ?? $page->title . ' — Ayur Naman')
@section('meta_description', $page->meta_description ?? '')

@section('content')

<!-- Page Header -->
<div style="background:var(--pd-ice);padding:60px 0 40px;text-align:center;">
  <div class="container-xl-custom">
    <span class="section-label">Ayur Naman</span>
    <h1 style="font-family:var(--font-serif);font-size:2.8rem;font-weight:400;color:var(--dark);margin-bottom:0;">{{ $page->title }}</h1>
  </div>
</div>

<!-- Page Content -->
<div class="container-xl-custom py-5">
  <div class="row justify-content-center">
    <div class="col-lg-9">
      <div class="page-content" style="font-size:0.95rem;line-height:1.9;color:var(--text);">
        {!! $page->content !!}
      </div>
    </div>
  </div>
</div>

@push('styles')
<style>
.page-content h2 { font-family:var(--font-serif);font-size:1.8rem;font-weight:400;color:var(--dark);margin:36px 0 16px; }
.page-content h3 { font-family:var(--font-serif);font-size:1.4rem;font-weight:400;color:var(--dark);margin:28px 0 12px; }
.page-content p { margin-bottom:20px; }
.page-content img { max-width:100%;height:auto;margin:24px 0; }
.page-content ul, .page-content ol { padding-left:24px;margin-bottom:20px; }
.page-content li { margin-bottom:8px; }
.page-content blockquote { border-left:3px solid var(--pd-blue);padding:16px 20px;margin:28px 0;background:var(--pd-ice);font-family:var(--font-serif);font-size:1.1rem;font-style:italic;color:var(--text); }
.page-content a { color:var(--pd-blue); }
.page-content table { width:100%;border-collapse:collapse;margin-bottom:20px; }
.page-content table th, .page-content table td { border:1px solid var(--border);padding:10px 14px;font-size:0.88rem; }
.page-content table th { background:var(--pd-ice);font-weight:600; }
</style>
@endpush
@endsection
