@extends('admin.layout.app')
@php($editing = isset($brand))
@section('title', $editing ? 'Edit Brand' : 'Add Brand')
@section('content')
<div class="page-header"><h4>{{ $editing ? 'Edit Brand' : 'Add Brand' }}</h4><a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary btn-sm">Back</a></div>
<form method="POST" action="{{ $editing ? route('admin.brands.update', $brand) : route('admin.brands.store') }}" enctype="multipart/form-data">
  @csrf @if($editing) @method('PUT') @endif
  <div class="form-card" style="max-width:700px">
    <label class="form-label">Name</label><input name="name" class="form-control mb-3" value="{{ old('name', $brand->name ?? '') }}" required>
    <label class="form-label">URL Slug</label><div class="input-group mb-1"><span class="input-group-text">/brand/</span><input name="slug" class="form-control" value="{{ old('slug', $brand->slug ?? '') }}" placeholder="brand-name"></div><small class="text-muted d-block mb-3">Leave blank to generate from name.</small>
    <label class="form-label">Description</label><textarea name="description" class="form-control mb-3">{{ old('description', $brand->description ?? '') }}</textarea>
    <label class="form-label">Logo</label><input type="file" name="logo" class="form-control mb-3" accept="image/*">
    <div class="form-check form-switch mb-3"><input class="form-check-input" type="checkbox" name="status" value="1" @checked(old('status', $brand->status ?? true))><label class="form-check-label">Active</label></div>
    <button class="btn btn-gold">Save Brand</button>
  </div>
</form>
@endsection
