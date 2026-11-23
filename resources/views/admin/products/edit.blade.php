@extends('admin.layout.app')
@section('title', 'Edit Product')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
  <li class="breadcrumb-item active">Edit</li>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="page-header">
  <div>
    <h4>Edit Product</h4>
    <p class="text-muted small mb-0">{{ $product->name }}</p>
  </div>
  <div class="d-flex gap-2">
    <a href="{{ route('product.show', $product->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye me-1"></i>Preview</a>
    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
  </div>
</div>

<form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
  @csrf @method('PUT')
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-4 pb-2 border-bottom">Basic Information</h6>
        <div class="mb-3">
          <label class="form-label">Product Name <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>
        <div class="mb-3"><label class="form-label">URL Slug</label><div class="input-group"><span class="input-group-text">/product/</span><input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug) }}" placeholder="diamond-solitaire-ring"></div><small class="text-muted">Use lowercase letters, numbers and hyphens.</small></div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Category <span class="text-danger">*</span></label>
            <select name="category_id" class="form-select" required>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Brand</label>
            <select name="brand_id" class="form-select">
              <option value="">No Brand</option>
              @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="mt-3">
          <label class="form-label">Short Description</label>
          <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $product->short_description) }}</textarea>
        </div>
        <div class="mt-3">
          <label class="form-label">Description</label>
          <textarea name="description" id="descriptionEditor" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>
      </div>

      <div class="form-card mb-4">
        <h6 class="fw-bold mb-4 pb-2 border-bottom">Pricing & Stock</h6>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Regular Price <span class="text-danger">*</span></label>
            <div class="input-group"><span class="input-group-text">₨</span>
              <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" step="0.01" required>
            </div>
          </div>
          <div class="col-md-4">
            <label class="form-label">Sale Price</label>
            <div class="input-group"><span class="input-group-text">₨</span>
              <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price', $product->sale_price) }}" step="0.01">
            </div>
          </div>
          <div class="col-md-4">
            <label class="form-label">Stock Quantity</label>
            <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', $product->stock_quantity) }}" min="0" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">Metal Type</label>
            <select name="metal_type" class="form-select">
              <option value="">Select Metal</option>
              @foreach(['Gold','White Gold','Rose Gold','Platinum','Silver','Yellow Gold'] as $m)
                <option value="{{ $m }}" {{ $product->metal_type == $m ? 'selected' : '' }}>{{ $m }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Stone Type</label>
            <select name="stone_type" class="form-select">
              <option value="">Select Stone</option>
              @foreach(['Diamond','Ruby','Emerald','Sapphire','Pearl','Topaz','No Stone'] as $s)
                <option value="{{ $s }}" {{ $product->stone_type == $s ? 'selected' : '' }}>{{ $s }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <!-- Existing Images -->
      @if($product->images->count() > 0)
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-3 pb-2 border-bottom">Product Images</h6>
        <div class="row g-2">
          @foreach($product->images as $img)
          <div class="col-auto" id="img_{{ $img->id }}">
            <div class="position-relative">
              <img src="{{ $img->url }}" style="width:90px;height:90px;object-fit:cover;border-radius:8px;">
              <button type="button" class="btn btn-danger btn-sm" style="position:absolute;top:2px;right:2px;padding:2px 6px;font-size:0.7rem;"
                onclick="deleteImage({{ $img->id }})">×</button>
            </div>
          </div>
          @endforeach
        </div>
        <div class="mt-3">
          <label class="form-label">Add More Images</label>
          <input type="file" name="images[]" class="form-control" multiple accept="image/*">
        </div>
      </div>
      @endif
    </div>

    <div class="col-lg-4">
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-3 pb-2 border-bottom">Status</h6>
        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-select">
            <option value="active" {{ $product->status === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $product->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
            <option value="draft" {{ $product->status === 'draft' ? 'selected' : '' }}>Draft</option>
          </select>
        </div>
        <div class="form-check form-switch mb-2">
          <input class="form-check-input" type="checkbox" name="is_featured" id="isFeatured" {{ $product->is_featured ? 'checked' : '' }}>
          <label class="form-check-label" for="isFeatured">Featured</label>
        </div>
        <div class="form-check form-switch mb-2">
          <input class="form-check-input" type="checkbox" name="is_new_arrival" id="isNew" {{ $product->is_new_arrival ? 'checked' : '' }}>
          <label class="form-check-label" for="isNew">New Arrival</label>
        </div>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" name="is_best_seller" id="isBest" {{ $product->is_best_seller ? 'checked' : '' }}>
          <label class="form-check-label" for="isBest">Best Seller</label>
        </div>
      </div>

      <div class="form-card">
        <h6 class="fw-bold mb-3 pb-2 border-bottom">Thumbnail</h6>
        <img id="thumbPreview" src="{{ $product->thumbnail_url }}" class="img-preview-large mb-3" style="width:100%;">
        <input type="file" name="thumbnail" class="form-control form-control-sm" accept="image/*"
          onchange="document.getElementById('thumbPreview').src = URL.createObjectURL(this.files[0])">
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-end gap-3 mt-4">
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
    <button type="submit" class="btn btn-gold px-4"><i class="bi bi-check-lg me-1"></i>Update Product</button>
  </div>
</form>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
$('#descriptionEditor').summernote({ height: 250 });

function deleteImage(imageId) {
  if (!confirm('Delete this image?')) return;
  fetch(`/admin/products/images/${imageId}`, {
    method: 'DELETE',
    headers: { 'X-CSRF-TOKEN': csrfToken }
  })
  .then(r => r.json())
  .then(d => { if (d.success) document.getElementById('img_' + imageId)?.remove(); });
}
</script>
@endpush
