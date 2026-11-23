@extends('admin.layout.app')
@section('title', 'Add Product')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
  <li class="breadcrumb-item active">Add Product</li>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<style>
  .dropzone-box { border: 2px dashed #c9a96e; border-radius: 12px; padding: 40px; text-align: center; cursor: pointer; background: #fdfaf5; transition: all 0.2s; }
  .dropzone-box:hover { background: #f5ede0; border-color: #b8935a; }
  .image-preview-grid { display: grid; grid-template-columns: repeat(auto-fill,minmax(90px,1fr)); gap: 10px; margin-top: 12px; }
  .preview-item { position: relative; }
  .preview-item img { width: 100%; height: 90px; object-fit: cover; border-radius: 8px; }
  .preview-item .remove-img { position: absolute; top: 4px; right: 4px; background: rgba(220,53,69,0.9); color: #fff; border: none; border-radius: 50%; width: 20px; height: 20px; font-size: 0.65rem; cursor: pointer; display: flex; align-items: center; justify-content: center; }
  .attr-row { background: #f8f9fa; border-radius: 8px; padding: 12px; margin-bottom: 8px; }
</style>
@endpush

@section('content')
<div class="page-header">
  <div>
    <h4>Add New Product</h4>
    <p class="text-muted small mb-0">Create a new jewelry product</p>
  </div>
  <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" id="productForm">
  @csrf
  <div class="row g-4">
    <!-- Left Column -->
    <div class="col-lg-8">
      <!-- Basic Info -->
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-4 pb-2 border-bottom">Basic Information</h6>
        <div class="mb-3">
          <label class="form-label">Product Name <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Diamond Solitaire Ring" required>
          @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3"><label class="form-label">URL Slug</label><div class="input-group"><span class="input-group-text">/product/</span><input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="diamond-solitaire-ring"></div><small class="text-muted">Leave blank to generate from product name.</small></div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Category <span class="text-danger">*</span></label>
            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
              <option value="">Select Category</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-6">
            <label class="form-label">Brand</label>
            <select name="brand_id" class="form-select">
              <option value="">No Brand</option>
              @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="mt-3">
          <label class="form-label">Short Description</label>
          <textarea name="short_description" class="form-control" rows="2" placeholder="Brief product description for listing pages">{{ old('short_description') }}</textarea>
        </div>
        <div class="mt-3">
          <label class="form-label">Full Description</label>
          <textarea name="description" id="descriptionEditor" class="form-control">{{ old('description') }}</textarea>
        </div>
      </div>

      <!-- Pricing -->
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-4 pb-2 border-bottom">Pricing & Stock</h6>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Regular Price <span class="text-danger">*</span></label>
            <div class="input-group">
              <span class="input-group-text">₨</span>
              <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" step="0.01" min="0" required>
            </div>
            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-4">
            <label class="form-label">Sale Price</label>
            <div class="input-group">
              <span class="input-group-text">₨</span>
              <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price') }}" step="0.01" min="0">
            </div>
          </div>
          <div class="col-md-4">
            <label class="form-label">Cost Price</label>
            <div class="input-group">
              <span class="input-group-text">₨</span>
              <input type="number" name="cost_price" class="form-control" value="{{ old('cost_price') }}" step="0.01" min="0">
            </div>
          </div>
          <div class="col-md-4">
            <label class="form-label">Stock Quantity <span class="text-danger">*</span></label>
            <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', 0) }}" min="0" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Low Stock Alert</label>
            <input type="number" name="low_stock_threshold" class="form-control" value="{{ old('low_stock_threshold', 5) }}" min="0">
          </div>
          <div class="col-md-4">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku') }}" placeholder="GLM-001">
          </div>
        </div>
      </div>

      <!-- Jewelry Details -->
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-4 pb-2 border-bottom">Jewelry Details</h6>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Material</label>
            <input type="text" name="material" class="form-control" value="{{ old('material') }}" placeholder="e.g. 18K Gold">
          </div>
          <div class="col-md-4">
            <label class="form-label">Metal Type</label>
            <select name="metal_type" class="form-select">
              <option value="">Select Metal</option>
              @foreach(['Gold','White Gold','Rose Gold','Platinum','Silver','Yellow Gold'] as $m)
                <option value="{{ $m }}" {{ old('metal_type') == $m ? 'selected' : '' }}>{{ $m }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Stone Type</label>
            <select name="stone_type" class="form-select">
              <option value="">Select Stone</option>
              @foreach(['Diamond','Ruby','Emerald','Sapphire','Pearl','Topaz','Amethyst','No Stone'] as $s)
                <option value="{{ $s }}" {{ old('stone_type') == $s ? 'selected' : '' }}>{{ $s }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Weight (grams)</label>
            <input type="number" name="weight" class="form-control" value="{{ old('weight') }}" step="0.01" min="0">
          </div>
        </div>
      </div>

      <!-- SEO -->
      <div class="form-card">
        <h6 class="fw-bold mb-4 pb-2 border-bottom">SEO</h6>
        <div class="mb-3">
          <label class="form-label">Meta Title</label>
          <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
        </div>
        <div>
          <label class="form-label">Meta Description</label>
          <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description') }}</textarea>
        </div>
      </div>
    </div>

    <!-- Right Column -->
    <div class="col-lg-4">
      <!-- Status -->
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-3 pb-2 border-bottom">Product Status</h6>
        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-select">
            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
          </select>
        </div>
        <div class="d-flex flex-column gap-2">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_featured" id="isFeatured" {{ old('is_featured') ? 'checked' : '' }}>
            <label class="form-check-label" for="isFeatured">Featured Product</label>
          </div>
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_new_arrival" id="isNew" {{ old('is_new_arrival') ? 'checked' : '' }}>
            <label class="form-check-label" for="isNew">New Arrival</label>
          </div>
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_best_seller" id="isBest" {{ old('is_best_seller') ? 'checked' : '' }}>
            <label class="form-check-label" for="isBest">Best Seller</label>
          </div>
        </div>
      </div>

      <!-- Thumbnail -->
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-3 pb-2 border-bottom">Thumbnail Image</h6>
        <div class="text-center">
          <img id="thumbPreview" src="{{ asset('images/product-placeholder.jpg') }}" alt="" class="img-preview-large mb-3" style="max-height:150px; width:100%;">
          <input type="file" name="thumbnail" id="thumbnail" class="d-none" accept="image/*" onchange="previewThumb(this)">
          <button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="document.getElementById('thumbnail').click()">
            <i class="bi bi-upload me-1"></i>Upload Thumbnail
          </button>
        </div>
      </div>

      <!-- Gallery -->
      <div class="form-card">
        <h6 class="fw-bold mb-3 pb-2 border-bottom">Product Gallery</h6>
        <div class="dropzone-box" onclick="document.getElementById('galleryInput').click()">
          <i class="bi bi-cloud-upload fs-2 text-muted d-block mb-2"></i>
          <p class="mb-0 small text-muted">Click to upload multiple images</p>
          <small class="text-muted">JPG, PNG, WEBP up to 2MB each</small>
        </div>
        <input type="file" name="images[]" id="galleryInput" multiple class="d-none" accept="image/*" onchange="previewGallery(this)">
        <div class="image-preview-grid" id="galleryPreview"></div>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-end gap-3 mt-4">
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
    <button type="submit" class="btn btn-gold px-4"><i class="bi bi-check-lg me-1"></i>Create Product</button>
  </div>
</form>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
  // Summernote editor
  $('#descriptionEditor').summernote({
    height: 250,
    toolbar: [
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['insert', ['link', 'hr']],
      ['view', ['fullscreen', 'codeview']]
    ]
  });

  function previewThumb(input) {
    const file = input.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = e => document.getElementById('thumbPreview').src = e.target.result;
      reader.readAsDataURL(file);
    }
  }

  function previewGallery(input) {
    const preview = document.getElementById('galleryPreview');
    Array.from(input.files).forEach(file => {
      const reader = new FileReader();
      reader.onload = e => {
        const div = document.createElement('div');
        div.className = 'preview-item';
        div.innerHTML = `<img src="${e.target.result}" alt=""><button class="remove-img" type="button" onclick="this.parentNode.remove()">×</button>`;
        preview.appendChild(div);
      };
      reader.readAsDataURL(file);
    });
  }
</script>
@endpush
