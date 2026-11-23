@extends('admin.layout.app')
@section('title', 'Add Banner')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Banners</a></li>
  <li class="breadcrumb-item active">Add Banner</li>
@endsection

@section('content')
<div class="page-header">
  <div><h4>Add New Banner</h4><p class="text-muted small mb-0">Upload a promotional banner image</p></div>
  <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<form method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-4 pb-2 border-bottom">Banner Details</h6>
        <div class="mb-3">
          <label class="form-label">Banner Image <span class="text-danger">*</span></label>
          <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" required onchange="previewImg(this,'imgPreview')">
          @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <div class="mt-3 text-center" id="imgPreview" style="display:none;">
            <img id="imgPreviewEl" src="" alt="" style="max-width:100%;max-height:200px;border-radius:8px;object-fit:cover;">
          </div>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Banner title (optional)">
          </div>
          <div class="col-md-6">
            <label class="form-label">Subtitle</label>
            <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}" placeholder="Subtitle or tagline">
          </div>
          <div class="col-md-6">
            <label class="form-label">Link URL</label>
            <input type="text" name="link" class="form-control" value="{{ old('link') }}" placeholder="https://... or /shop">
          </div>
          <div class="col-md-6">
            <label class="form-label">Banner Type</label>
            <select name="type" class="form-select">
              <option value="promo" {{ old('type')=='promo'?'selected':'' }}>Promo</option>
              <option value="hero" {{ old('type')=='hero'?'selected':'' }}>Hero</option>
              <option value="sidebar" {{ old('type')=='sidebar'?'selected':'' }}>Sidebar</option>
              <option value="popup" {{ old('type')=='popup'?'selected':'' }}>Popup</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',0) }}" min="0">
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="form-card">
        <h6 class="fw-bold mb-3 pb-2 border-bottom">Settings</h6>
        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="status" id="status" value="1" checked>
          <label class="form-check-label" for="status">Active</label>
        </div>
        <button type="submit" class="btn btn-gold w-100"><i class="bi bi-check-lg me-1"></i>Create Banner</button>
      </div>
    </div>
  </div>
</form>
@endsection
@push('scripts')
<script>
function previewImg(input, previewId) {
  const file = input.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = e => {
      document.getElementById('imgPreviewEl').src = e.target.result;
      document.getElementById(previewId).style.display = 'block';
    };
    reader.readAsDataURL(file);
  }
}
</script>
@endpush
