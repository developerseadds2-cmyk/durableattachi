@extends('admin.layout.app')
@section('title','Add Slider')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">Sliders</a></li>
  <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
<div class="page-header">
  <h4>Add Slider</h4>
  <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>
<form method="POST" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="form-card">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="e.g. Save Upto $200">
          </div>
          <div class="col-md-6">
            <label class="form-label">Subtitle / Label</label>
            <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}" placeholder="e.g. New Collection 2024">
          </div>
          <div class="col-12">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="2" placeholder="Slider description...">{{ old('description') }}</textarea>
          </div>
          <div class="col-md-6">
            <label class="form-label">Button Text</label>
            <input type="text" name="button_text" class="form-control" value="{{ old('button_text','Shop Now') }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Button Link</label>
            <input type="text" name="button_link" class="form-control" value="{{ old('button_link','/shop') }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',0) }}" min="0">
          </div>
          <div class="col-md-6">
            <label class="form-label">Position</label>
            <select name="position" class="form-select">
              <option value="left">Left</option>
              <option value="center" selected>Center</option>
              <option value="right">Right</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="form-card mb-4">
        <label class="form-label">Slider Image <span class="text-danger">*</span></label>
        <input type="file" name="image" class="form-control" accept="image/*" required onchange="document.getElementById('imgPreview').src=URL.createObjectURL(this.files[0])">
        <img id="imgPreview" src="{{ asset('images/product-placeholder.jpg') }}" class="img-preview-large mt-2">
        <small class="text-muted">Recommended: 1920×800px</small>
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
    <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-secondary">Cancel</a>
    <button type="submit" class="btn btn-gold"><i class="bi bi-check-lg me-1"></i>Save Slider</button>
  </div>
</form>
@endsection
