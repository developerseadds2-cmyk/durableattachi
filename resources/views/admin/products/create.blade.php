@extends('admin.layout.app')
@section('title', 'Add Product')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
  <li class="breadcrumb-item active">Add Product</li>
@endsection

@push('styles')
<style>
  .dropzone-box { border: 2px dashed #c9a96e; border-radius: 12px; padding: 40px; text-align: center; cursor: pointer; background: #fdfaf5; transition: all 0.2s; }
  .dropzone-box:hover { background: #f5ede0; border-color: #b8935a; }
  .image-preview-grid { display: grid; grid-template-columns: repeat(auto-fill,minmax(90px,1fr)); gap: 10px; margin-top: 12px; }
  .preview-item { position: relative; }
  .preview-item img { width: 100%; height: 90px; object-fit: cover; border-radius: 8px; }
  .preview-item .remove-img { position: absolute; top: 4px; right: 4px; background: rgba(220,53,69,0.9); color: #fff; border: none; border-radius: 50%; width: 20px; height: 20px; font-size: 0.65rem; cursor: pointer; display: flex; align-items: center; justify-content: center; }
  .attr-row { background: #f8f9fa; border-radius: 8px; padding: 12px; margin-bottom: 8px; }
  /* CKEditor styling */
  .ck-editor__editable { min-height: 250px; }
  .color-swatch-btn { transition: transform 0.2s, box-shadow 0.2s, outline 0.2s; cursor: pointer; }
  .color-swatch-btn:hover { transform: scale(1.2); }
  .color-swatch-btn.active-swatch { outline: 3px solid #142D4E; outline-offset: 2px; transform: scale(1.2); }
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
          <input type="text" name="name" id="productName" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. American Tourister Curio Trolley" required>
          @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">URL Slug</label>
          <div class="input-group">
            <span class="input-group-text">/product/</span>
            <input type="text" name="slug" id="productSlug" class="form-control" value="{{ old('slug') }}" placeholder="american-tourister-curio-trolley">
          </div>
          <small class="text-muted">Auto-generated from name. You can also customize it manually.</small>
        </div>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Category <span class="text-danger">*</span></label>
            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
              <option value="">Select Category</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-4">
            <label class="form-label">Brand</label>
            <select name="brand_id" class="form-select">
              <option value="">No Brand</option>
              @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Color</label>
            <div class="dropdown custom-color-dropdown">
              <input type="hidden" name="color_id" id="colorIdInput" value="{{ old('color_id') }}">
              <button class="btn btn-outline-secondary form-select text-start d-flex align-items-center justify-content-between" type="button" id="colorDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false" style="background:#fff;border-color:#dee2e6;">
                <span class="d-flex align-items-center gap-2" id="colorBtnLabel">
                  <span id="btnColorCircle" style="display:inline-block;width:18px;height:18px;border-radius:50%;background:#e0e0e0;border:1px solid #ccc;box-shadow:inset 0 1px 2px rgba(0,0,0,0.15);"></span>
                  <span id="btnColorName" class="text-muted">Select Color</span>
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
          <textarea name="description" id="descriptionEditor" class="form-control">{{ old('description') }}</textarea>
        </div>
      </div>

      <!-- Highlights -->
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-4 pb-2 border-bottom"><i class="bi bi-stars me-2 text-warning"></i>Highlights</h6>
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label">Product Features <small class="text-muted">(Short description & key features)</small></label>
            <textarea name="short_description" class="form-control" rows="2" placeholder="e.g. Securitech zipper, TSA lock, Full PVC convipack, Double wheels, Expander">{{ old('short_description') }}</textarea>
          </div>
          <div class="col-md-6">
            <label class="form-label">Warranty Details</label>
            <input type="text" name="warranty_details" class="form-control" value="{{ old('warranty_details', '5 years international warranty') }}" placeholder="e.g. 5 years international warranty">
          </div>
          <div class="col-md-6">
            <label class="form-label">Material & Shell</label>
            <input type="text" name="material" class="form-control" value="{{ old('material') }}" placeholder="e.g. Polycarbonate / Ballistic Nylon / Full Grain Leather">
          </div>
        </div>
      </div>

      <!-- Pricing & Stock -->
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-4 pb-2 border-bottom">Pricing & Stock</h6>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Regular Price <span class="text-danger">*</span></label>
            <div class="input-group">
              <span class="input-group-text">₹</span>
              <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" step="0.01" min="0" placeholder="5665.00" required>
            </div>
            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-4">
            <label class="form-label">Sale Price</label>
            <div class="input-group">
              <span class="input-group-text">₹</span>
              <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price') }}" step="0.01" min="0" placeholder="4999.00">
            </div>
          </div>
          <div class="col-md-4">
            <label class="form-label">Cost Price</label>
            <div class="input-group">
              <span class="input-group-text">₹</span>
              <input type="number" name="cost_price" class="form-control" value="{{ old('cost_price') }}" step="0.01" min="0">
            </div>
          </div>
          <div class="col-md-4">
            <label class="form-label">Stock Quantity <span class="text-danger">*</span></label>
            <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', 15) }}" min="0" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Low Stock Alert</label>
            <input type="number" name="low_stock_threshold" class="form-control" value="{{ old('low_stock_threshold', 5) }}" min="0">
          </div>
          <div class="col-md-4">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ old('sku') }}" placeholder="DSH-001">
          </div>
        </div>
      </div>

      <!-- Other Info -->
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-4 pb-2 border-bottom"><i class="bi bi-info-circle me-2 text-primary"></i>Other Info</h6>
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Product Warranty</label>
            <input type="text" name="product_warranty" class="form-control" value="{{ old('product_warranty', '5 Years') }}" placeholder="e.g. 5 Years">
          </div>
          <div class="col-md-4">
            <label class="form-label">Tax Rate (%)</label>
            <div class="input-group">
              <input type="number" name="tax_rate" class="form-control" value="{{ old('tax_rate', '18.00') }}" step="0.01" min="0" placeholder="18.00">
              <span class="input-group-text">%</span>
            </div>
          </div>
          <div class="col-md-4">
            <label class="form-label">HSN Code</label>
            <input type="text" name="hsn_code" class="form-control" value="{{ old('hsn_code', '42021250') }}" placeholder="42021250">
          </div>
          <div class="col-md-8">
            <label class="form-label">Manufacturer Details</label>
            <textarea name="manufacturer_details" class="form-control" rows="2" placeholder="e.g. DGP House, 5th Floor 88C Old Prabhadevi Road Mumbai, Maharashtra - 400025">{{ old('manufacturer_details', 'DGP House, 5th Floor 88C Old Prabhadevi Road Mumbai, Maharashtra - 400025') }}</textarea>
          </div>
          <div class="col-md-4">
            <label class="form-label">Weight (kg)</label>
            <input type="number" name="weight" class="form-control" value="{{ old('weight') }}" step="0.01" min="0" placeholder="e.g. 3.2">
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
          <div id="thumbPreviewWrap" class="mb-3 d-flex align-items-center justify-content-center bg-light border rounded" style="height:150px;width:100%;overflow:hidden;">
            <img id="thumbPreview" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 24 24' fill='none' stroke='%23ccc' stroke-width='1.5'%3E%3Crect x='3' y='3' width='18' height='18' rx='2' ry='2'/%3E%3Ccircle cx='8.5' cy='8.5' r='1.5'/%3E%3Cpolyline points='21 15 16 10 5 21'/%3E%3C/svg%3E" alt="" style="max-height:100%;max-width:100%;object-fit:contain;">
          </div>
          <input type="file" name="thumbnail" id="thumbnail" class="d-none" accept="image/*,.jpg,.jpeg,.png,.webp,.avif,.gif,.svg,.bmp,.ico" onchange="previewThumb(this)">
          <button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="document.getElementById('thumbnail').click()">
            <i class="bi bi-upload me-1"></i>Upload Thumbnail
          </button>
          <small class="text-muted d-block mt-1">Accepts any image format and size</small>
        </div>
      </div>

      <!-- Gallery -->
      <div class="form-card">
        <h6 class="fw-bold mb-3 pb-2 border-bottom">Product Gallery</h6>
        <div class="dropzone-box" onclick="document.getElementById('galleryInput').click()">
          <i class="bi bi-cloud-upload fs-2 text-muted d-block mb-2"></i>
          <p class="mb-0 small text-muted">Click to upload multiple images</p>
          <small class="text-muted">Accepts all image formats (JPG, PNG, WEBP, AVIF, GIF, etc.)</small>
        </div>
        <input type="file" name="images[]" id="galleryInput" multiple class="d-none" accept="image/*,.jpg,.jpeg,.png,.webp,.avif,.gif,.svg,.bmp,.ico" onchange="previewGallery(this)">
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
<!-- CKEditor 5 Classic -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<script>
  // Initialize CKEditor 5
  let editorInstance;
  ClassicEditor
    .create(document.querySelector('#descriptionEditor'), {
      toolbar: [
        'heading', '|',
        'bold', 'italic', 'link', '|',
        'bulletedList', 'numberedList', 'blockQuote', '|',
        'insertTable', 'undo', 'redo'
      ]
    })
    .then(editor => {
      editorInstance = editor;
    })
    .catch(error => {
      console.error(error);
    });

  // Auto-generate URL slug when typing product name
  const nameInput = document.getElementById('productName');
  const slugInput = document.getElementById('productSlug');
  let slugManual = false;

  slugInput.addEventListener('input', function() {
    slugManual = this.value.trim().length > 0;
  });

  nameInput.addEventListener('input', function() {
    if (!slugManual) {
      slugInput.value = this.value
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .trim()
        .replace(/\s+/g, '-');
    }
  });

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
    if (!preview) return;
    preview.innerHTML = '';
    Array.from(input.files).forEach((file, index) => {
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

  // Form Draft Auto-Save to LocalStorage so data is never lost on refresh
  const FORM_STORAGE_KEY = 'dsh_product_create_draft';
  const productForm = document.getElementById('productForm');

  function saveFormDraft() {
    const data = {};
    const formData = new FormData(productForm);
    for (let [key, val] of formData.entries()) {
      if (key !== 'thumbnail' && key !== 'images[]' && key !== '_token') {
        data[key] = val;
      }
    }
    if (editorInstance) {
      data['description'] = editorInstance.getData();
    }
    // Also save color button visual attributes
    data['_btnColorName'] = document.getElementById('btnColorName').textContent;
    data['_btnColorCode'] = document.getElementById('btnColorCircle').style.background;

    localStorage.setItem(FORM_STORAGE_KEY, JSON.stringify(data));
  }

  function restoreFormDraft() {
    const raw = localStorage.getItem(FORM_STORAGE_KEY);
    if (!raw) return;
    try {
      const data = JSON.parse(raw);
      for (let key in data) {
        if (key.startsWith('_')) continue;
        const el = productForm.querySelector(`[name="${key}"]`);
        if (el) {
          if (el.type === 'checkbox') {
            el.checked = data[key] === '1' || data[key] === 'on' || data[key] === true;
          } else {
            // Only populate if current element is empty (don't overwrite server old() values)
            if (!el.value || el.value === '15' || el.value === '5665.00') {
              el.value = data[key];
            }
          }
        }
      }

      if (data['color_id']) {
        document.getElementById('colorIdInput').value = data['color_id'];
        if (data['_btnColorCode']) document.getElementById('btnColorCircle').style.background = data['_btnColorCode'];
        if (data['_btnColorName']) {
          const lbl = document.getElementById('btnColorName');
          lbl.textContent = data['_btnColorName'];
          lbl.className = 'text-dark fw-500';
        }
      }

      if (editorInstance && data['description']) {
        editorInstance.setData(data['description']);
      }
    } catch (e) {
      console.warn('Draft restore error:', e);
    }
  }

  // Auto-save on every input/change event
  productForm.addEventListener('input', saveFormDraft);
  productForm.addEventListener('change', saveFormDraft);

  // Clear draft only on successful submit
  productForm.addEventListener('submit', function() {
    localStorage.removeItem(FORM_STORAGE_KEY);
  });

  // Restore draft when DOM and CKEditor are ready
  window.addEventListener('DOMContentLoaded', function() {
    setTimeout(restoreFormDraft, 300);
  });
</script>
@endpush
