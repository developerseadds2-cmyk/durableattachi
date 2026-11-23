@extends('admin.layout.app')
@section('title','Add Category')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
  <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
<div class="page-header">
  <h4>Add Category</h4>
  <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="form-card">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
          </div>
          <div class="col-md-6"><label class="form-label">URL Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="diamond-rings"><small class="text-muted">Leave blank to generate from name.</small></div>
          <div class="col-md-6">
            <label class="form-label">Parent Category</label>
            <select name="parent_id" class="form-select">
              <option value="">No Parent (Top-level)</option>
              @foreach($parents as $p)
                <option value="{{ $p->id }}" {{ old('parent_id') == $p->id ? 'selected':'' }}>{{ $p->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',0) }}" min="0">
          </div>
          <div class="col-12">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
          </div>
          <div class="col-12">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
          </div>
          <div class="col-12">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description') }}</textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="form-card mb-4">
        <label class="form-label">Category Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
      </div>
      <div class="form-card">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" name="status" value="1" id="status" checked>
          <label class="form-check-label" for="status">Active</label>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-end gap-3 mt-4">
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
    <button type="submit" class="btn btn-gold"><i class="bi bi-check-lg me-1"></i>Save</button>
  </div>
</form>
@endsection
