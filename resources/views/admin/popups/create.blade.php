@extends('admin.layout.app')

@section('title', 'Create Popup - Admin')

@section('content')
<div class="page-header">
  <div>
    <h4>Create Promotional Popup</h4>
    <p class="text-muted small mb-0">Create discount or notification popups targeted to all pages, homepage, or specific categories/products.</p>
  </div>
  <a href="{{ route('admin.popups.index') }}" class="btn btn-outline-secondary">
    <i class="bi bi-arrow-left me-1"></i> Back to Popups
  </a>
</div>

<form action="{{ route('admin.popups.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="form-card mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Popup Content</h5>

        <div class="mb-3">
          <label class="form-label">Internal Title <span class="text-danger">*</span></label>
          <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. 15% Off Luggage Categories" required>
          <div class="form-text">Used for your internal reference in the admin panel.</div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Popup Type <span class="text-danger">*</span></label>
            <select name="type" id="popupTypeSelect" class="form-select" onchange="handleTypeChange()">
              <option value="offer" {{ old('type') == 'offer' ? 'selected' : '' }}>Offer Popup (Discount / Coupon)</option>
              <option value="simple" {{ old('type') == 'simple' ? 'selected' : '' }}>Simple Popup (Announcement / Text / Title)</option>
              <option value="image_only" {{ old('type') == 'image_only' ? 'selected' : '' }}>Image-Only Popup (Clean Banner / Poster)</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Badge Tag</label>
            <input type="text" name="badge_text" class="form-control" value="{{ old('badge_text', 'EXCLUSIVE OFFER') }}" placeholder="e.g. EXCLUSIVE OFFER, SPECIAL DEAL, NOTICE">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Headline</label>
          <input type="text" name="headline" class="form-control" value="{{ old('headline') }}" placeholder="e.g. Flat 15% Off On Premium Luggage & Bags">
        </div>

        <div class="mb-3">
          <label class="form-label">Description / Body Text</label>
          <textarea name="description" class="form-control" rows="3" placeholder="Upgrade your travel gear with authentic suitcases, trolley bags & backpacks.">{{ old('description') }}</textarea>
        </div>

        <!-- Offer fields (shown when type is offer) -->
        <div id="offerFieldsGroup" class="p-3 mb-3 rounded-3" style="background:#fefbf4; border:1px solid #f6eedb;">
          <h6 class="fw-bold text-dark mb-3"><i class="bi bi-tag-fill text-warning me-1"></i> Discount &amp; Coupon Details</h6>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Discount Percentage (%)</label>
              <div class="input-group">
                <input type="number" name="discount_percentage" class="form-control" value="{{ old('discount_percentage', 15) }}" min="1" max="100" placeholder="15">
                <span class="input-group-text">% OFF</span>
              </div>
              <div class="form-text">e.g. 15 for 15% discount badge.</div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Coupon Code (Optional)</label>
              <input type="text" name="coupon_code" class="form-control text-uppercase fw-bold" value="{{ old('coupon_code') }}" placeholder="e.g. TRAVEL15">
              <div class="form-text">Users can click to auto-copy this code!</div>
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Button Text</label>
            <input type="text" name="button_text" class="form-control" value="{{ old('button_text', 'Claim Discount Now') }}" placeholder="e.g. Claim Discount Now">
          </div>
          <div class="col-md-6">
            <label class="form-label">Button URL / Redirect</label>
            <input type="text" name="button_url" class="form-control" value="{{ old('button_url', '/shop') }}" placeholder="e.g. /category/luggage or /shop">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Popup Banner Image (Optional)</label>
          <input type="file" name="image" class="form-control" accept="image/*">
          <div class="form-text">Recommended size: 600x400 or square 500x500px.</div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <!-- Targeting Settings -->
      <div class="form-card mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Where to Display</h5>

        <div class="mb-3">
          <label class="form-label">Target Page</label>
          <select name="target_type" id="targetTypeSelect" class="form-select" onchange="handleTargetChange()">
            <option value="all" {{ old('target_type') == 'all' ? 'selected' : '' }}>Entire Website (All Pages)</option>
            <option value="home_only" {{ old('target_type') == 'home_only' ? 'selected' : '' }}>Homepage Only</option>
            <option value="category" {{ old('target_type') == 'category' ? 'selected' : '' }}>Specific Category Pages</option>
            <option value="product" {{ old('target_type') == 'product' ? 'selected' : '' }}>Specific Product Pages</option>
          </select>
        </div>

        <div class="mb-3" id="categoryTargetDiv" style="display:none;">
          <label class="form-label">Select Category <span class="text-danger">*</span></label>
          <select name="category_id" class="form-select">
            <option value="">-- Choose Category --</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3" id="productTargetDiv" style="display:none;">
          <label class="form-label">Select Product <span class="text-danger">*</span></label>
          <select name="product_id" class="form-select">
            <option value="">-- Choose Product --</option>
            @foreach($products as $prod)
              <option value="{{ $prod->id }}" {{ old('product_id') == $prod->id ? 'selected' : '' }}>{{ $prod->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Display Delay (Seconds)</label>
          <input type="number" name="delay_seconds" class="form-control" value="{{ old('delay_seconds', 2) }}" min="0" max="60">
          <div class="form-text">Popup appears after this many seconds.</div>
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="show_once_per_session" id="show_once" value="1" {{ old('show_once_per_session', true) ? 'checked' : '' }}>
          <label class="form-check-label fw-bold small text-dark" for="show_once">Show only once per user session</label>
          <div class="form-text">Prevents annoying users on every page navigation.</div>
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
          <label class="form-check-label fw-bold text-success" for="is_active">Activate this Popup</label>
        </div>

        <button type="submit" class="btn btn-gold w-100 py-2.5 fw-bold">
          <i class="bi bi-check-lg me-1"></i> Save Popup
        </button>
      </div>
    </div>
  </div>
</form>
@endsection

@push('scripts')
<script>
function handleTypeChange() {
  const type = document.getElementById('popupTypeSelect').value;
  const offerGroup = document.getElementById('offerFieldsGroup');
  if (type === 'offer') {
    offerGroup.style.display = 'block';
  } else {
    offerGroup.style.display = 'none';
  }
}

function handleTargetChange() {
  const target = document.getElementById('targetTypeSelect').value;
  document.getElementById('categoryTargetDiv').style.display = target === 'category' ? 'block' : 'none';
  document.getElementById('productTargetDiv').style.display = target === 'product' ? 'block' : 'none';
}

document.addEventListener('DOMContentLoaded', () => {
  handleTypeChange();
  handleTargetChange();
});
</script>
@endpush
