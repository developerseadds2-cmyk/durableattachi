@extends('admin.layout.app')
@php($editing = isset($category))
@section('title', $editing ? 'Edit Blog Category' : 'Add Blog Category')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blog</a></li>
  <li class="breadcrumb-item"><a href="{{ route('admin.blog-categories.index') }}">Categories</a></li>
  <li class="breadcrumb-item active">{{ $editing ? 'Edit' : 'Add' }}</li>
@endsection

@section('content')
<div class="page-header">
  <h4>{{ $editing ? 'Edit Blog Category' : 'Add Blog Category' }}</h4>
  <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<form method="POST" action="{{ $editing ? route('admin.blog-categories.update', $category) : route('admin.blog-categories.store') }}">
  @csrf
  @if($editing) @method('PUT') @endif
  <div class="form-card" style="max-width:720px;">
    <div class="mb-3">
      <label class="form-label">Category Name <span class="text-danger">*</span></label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
    </div>
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" name="status" value="1" id="status" {{ old('status', $category->status ?? true) ? 'checked' : '' }}>
      <label class="form-check-label" for="status">Active</label>
    </div>
  </div>
  <div class="mt-4"><button class="btn btn-gold">Save Category</button></div>
</form>
@endsection