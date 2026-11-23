@extends('admin.layout.app')
@section('title','Add Page')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
  <li class="breadcrumb-item active">Add</li>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="page-header">
  <h4>{{ isset($page) ? 'Edit Page' : 'Add Page' }}</h4>
  <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<form method="POST" action="{{ isset($page) ? route('admin.pages.update', $page) : route('admin.pages.store') }}">
  @csrf
  @if(isset($page)) @method('PUT') @endif
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="form-card mb-4">
        <div class="mb-3">
          <label class="form-label">Page Title <span class="text-danger">*</span></label>
          <input type="text" name="title" class="form-control" value="{{ old('title', $page->title ?? '') }}" required>
        </div>
        <div class="mb-3">
          <label class="form-label">URL Slug</label>
          <div class="input-group"><span class="input-group-text">/page/</span><input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug ?? '') }}" placeholder="about-us"></div>
          <small class="text-muted">Use lowercase letters, numbers and hyphens. Leave blank to generate it from the title.</small>
        </div>
        <div>
          <label class="form-label">Content</label>
          <textarea name="content" id="contentEditor" class="form-control">{{ old('content', $page->content ?? '') }}</textarea>
        </div>
      </div>
      <div class="form-card">
        <h6 class="fw-bold mb-3">SEO</h6>
        <div class="mb-3">
          <label class="form-label">Meta Title</label>
          <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $page->meta_title ?? '') }}">
        </div>
        <div>
          <label class="form-label">Meta Description</label>
          <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="form-card">
        <div class="form-check form-switch mb-0">
          <input class="form-check-input" type="checkbox" name="status" value="1" id="status" {{ old('status', ($page->status ?? true)) ? 'checked':'' }}>
          <label class="form-check-label" for="status">Published</label>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-end gap-3 mt-4">
    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">Cancel</a>
    <button type="submit" class="btn btn-gold">Save Page</button>
  </div>
</form>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>$('#contentEditor').summernote({height:350});</script>
@endpush
