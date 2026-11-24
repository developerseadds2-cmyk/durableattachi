@extends('admin.layout.app')
@section('title', 'Edit Product')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
  <li class="breadcrumb-item active">Edit</li>
@endsection

@push('styles')
<style>
  .ck-editor__editable { min-height: 250px; }
  .color-swatch-btn { transition: transform 0.2s, box-shadow 0.2s, outline 0.2s; cursor: pointer; }
  .color-swatch-btn:hover { transform: scale(1.2); }
  .color-swatch-btn.active-swatch { outline: 3px solid #142D4E; outline-offset: 2px; transform: scale(1.2); }
</style>
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
          <input type="text" name="name" id="productName" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>
        <div class="mb-3">
          <label class="form-label">URL Slug</label>
          <div class="input-group">
            <span class="input-group-text">/product/</span>
            <input type="text" name="slug" id="productSlug" class="form-control" value="{{ old('slug', $product->slug) }}" placeholder="product-slug">
          </div>
          <small class="text-muted">Use lowercase letters, numbers and hyphens.</small>
        </div>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Category <span class="text-danger">*</span></label>
            <select name="category_id" class="form-select" required>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Brand</label>
            <select name="brand_id" class="form-select">
              <option value="">No Brand</option>
              @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Color</label>
            <div class="dropdown custom-color-dropdown">
              <input type="hidden" name="color_id" id="colorIdInput" value="{{ old('color_id', $product->color_id) }}">
              <button class="btn btn-outline-secondary form-select text-start d-flex align-items-center justify-content-between" type="button" id="colorDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false" style="background:#fff;border-color:#dee2e6;">
                <span class="d-flex align-items-center gap-2" id="colorBtnLabel">
                  <span id="btnColorCircle" style="display:inline-block;width:18px;height:18px;border-radius:50%;background:{{ $product->color->code ?? '#e0e0e0' }};border:1px solid #ccc;box-shadow:inset 0 1px 2px rgba(0,0,0,0.15);"></span>
                  <span id="btnColorName" class="{{ $product->color ? 'text-dark fw-500' : 'text-muted' }}">{{ $product->color->name ?? 'Select Color' }}</span>
                </span>
              </button>
              <div class="dropdown-menu p-2 shadow-sm w-100" style="max-height: 280px; overflow-y: auto;" aria-labelledby="colorDropdownBtn">
                <input type="text" class="form-control form-control-sm mb-2" id="colorSearchInput" placeholder="Search color..." onkeyup="filterColors(this.value)">
                <div id="colorOptionsList">
                  <div class="dropdown-item d-flex align-items-center gap-2 rounded-2 py-1 px-2 cursor-pointer" onclick="selectColor('', 'Select Color', '#e0e0e0')" style="cursor:pointer;">
                    <span style="display:inline-block;width:18px;height:18px;border-radius:50%;background:#e0e0e0;border:1px solid #ccc;"></span>
                    <span class="text-muted">No Color</span>
                  </div>
                  @foreach($colors as $color)
                    <div class="dropdown-item d-flex align-items-center justify-content-between rounded-2 py-1 px-2 color-option-row" 
                         data-name="{{ strtolower($color->name) }}"
                         onclick="selectColor('{{ $color->id }}', '{{ $color->name }}', '{{ $color->code ?: '#C0C0C0' }}')"
                         style="cursor:pointer;">
                      <span class="d-flex align-items-center gap-2">
                        <span style="display:inline-block;width:18px;height:18px;border-radius:50%;background:{{ $color->code ?: '#C0C0C0' }};border:1px solid #ccc;box-shadow:inset 0 1px 2px rgba(0,0,0,0.2);"></span>
                        <span class="fw-500">{{ $color->name }}</span>
                      </span>
                      <small class="text-muted">{{ $color->code }}</small>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mt-3">
          <label class="form-label">Product Description</label>
          <textarea name="description" id="descriptionEditor" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>
      </div>

      <!-- Highlights -->
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-4 pb-2 border-bottom"><i class="bi bi-stars me-2 text-warning"></i>Highlights</h6>
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label">Product Features <small class="text-muted">(Short description & key features)</small></label>
            <textarea name="short_description" class="form-control" rows="2" placeholder="e.g. Securitech zipper, TSA lock, Full PVC convipack, Double wheels, Expander">{{ old('short_description', $product->short_description) }}</textarea>
          </div>
          <div class="col-md-6">
            <label class="form-label">Warranty Details</label>
            <input type="text" name="warranty_details" class="form-control" value="{{ old('warranty_details', $product->warranty_details ?? '5 years international warranty') }}" placeholder="e.g. 5 years international warranty">
          </div>
          <div class="col-md-6">
            <label class="form-label">Material & Shell</label>
            <input type="text" name="material" class="form-control" value="{{ old('material', $product->material) }}" placeholder="e.g. Polycarbonate / Ballistic Nylon / Full Grain Leather">
          </div>
        </div>
      </div>

      <!-- Pricing & Stock -->
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-4 pb-2 border-bottom">Pricing & Stock</h6>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Regular Price <span class="text-danger">*</span></label>
            <div class="input-group"><span class="input-group-text">₹</span>
              <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" step="0.01" required>
            </div>
          </div>
          <div class="col-md-4">
            <label class="form-label">Sale Price</label>
            <div class="input-group"><span class="input-group-text">₹</span>
              <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price', $product->sale_price) }}" step="0.01">
            </div>
          </div>
          <div class="col-md-4">
            <label class="form-label">Cost Price</label>
            <div class="input-group"><span class="input-group-text">₹</span>
              <input type="number" name="cost_price" class="form-control" value="{{ old('cost_price', $product->cost_price) }}" step="0.01">
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
        </div>
      </div>

      <!-- Other Info -->
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-4 pb-2 border-bottom"><i class="bi bi-info-circle me-2 text-primary"></i>Other Info</h6>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Product Warranty</label>
            <input type="text" name="product_warranty" class="form-control" value="{{ old('product_warranty', $product->product_warranty ?? '5 Years') }}" placeholder="e.g. 5 Years">
          </div>
          <div class="col-md-4">
            <label class="form-label">Tax Rate (%)</label>
            <div class="input-group">
              <input type="number" name="tax_rate" class="form-control" value="{{ old('tax_rate', $product->tax_rate ?? '18.00') }}" step="0.01" min="0">
              <span class="input-group-text">%</span>
            </div>
          </div>
          <div class="col-md-4">
            <label class="form-label">HSN Code</label>
            <input type="text" name="hsn_code" class="form-control" value="{{ old('hsn_code', $product->hsn_code ?? '42021250') }}" placeholder="42021250">
          </div>
          <div class="col-md-8">
            <label class="form-label">Manufacturer Details</label>
            <textarea name="manufacturer_details" class="form-control" rows="2">{{ old('manufacturer_details', $product->manufacturer_details ?? 'DGP House, 5th Floor 88C Old Prabhadevi Road Mumbai, Maharashtra - 400025') }}</textarea>
          </div>
          <div class="col-md-4">
            <label class="form-label">Weight (kg)</label>
            <input type="number" name="weight" class="form-control" value="{{ old('weight', $product->weight) }}" step="0.01" min="0">
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
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
ClassicEditor
  .create(document.querySelector('#descriptionEditor'), {
    toolbar: [
      'heading', '|',
      'bold', 'italic', 'link', '|',
      'bulletedList', 'numberedList', 'blockQuote', '|',
      'insertTable', 'undo', 'redo'
    ]
  })
  .catch(error => console.error(error));

// Color selection inside dropdown
function selectColor(id, name, code) {
  document.getElementById('colorIdInput').value = id;
  document.getElementById('btnColorCircle').style.background = code || '#e0e0e0';
  const label = document.getElementById('btnColorName');
  label.textContent = name;
  if (id) {
    label.className = 'text-dark fw-500';
  } else {
    label.className = 'text-muted';
  }
  // Close dropdown
  const btn = document.getElementById('colorDropdownBtn');
  const dropdown = bootstrap.Dropdown.getInstance(btn);
  if (dropdown) dropdown.hide();
}

function filterColors(term) {
  const filter = term.toLowerCase().trim();
  document.querySelectorAll('#colorOptionsList .color-option-row').forEach(row => {
    const name = row.getAttribute('data-name') || '';
    if (name.includes(filter)) {
      row.style.setProperty('display', 'flex', 'important');
    } else {
      row.style.setProperty('display', 'none', 'important');
    }
  });
}

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
