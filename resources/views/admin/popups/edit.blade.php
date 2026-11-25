@extends('admin.layout.app')

@section('title', 'Edit Popup - Admin')

@section('content')
<div class="page-header">
  <div>
    <h4>Edit Popup: {{ $popup->title }}</h4>
    <p class="text-muted small mb-0">Update promotional popup content, discounts, and targeting settings.</p>
  </div>
  <a href="{{ route('admin.popups.index') }}" class="btn btn-outline-secondary">
    <i class="bi bi-arrow-left me-1"></i> Back to Popups
  </a>
</div>

<form action="{{ route('admin.popups.update', $popup) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="form-card mb-4">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Popup Content</h5>

        <div class="mb-3">
          <label class="form-label">Internal Title <span class="text-danger">*</span></label>
          <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $popup->title) }}" required>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Popup Type <span class="text-danger">*</span></label>
            <select name="type" id="popupTypeSelect" class="form-select" onchange="handleTypeChange()">
              <option value="offer" {{ old('type', $popup->type) == 'offer' ? 'selected' : '' }}>Offer Popup (Discount / Coupon)</option>
              <option value="simple" {{ old('type', $popup->type) == 'simple' ? 'selected' : '' }}>Simple Popup (Announcement / Text / Title)</option>
              <option value="image_only" {{ old('type', $popup->type) == 'image_only' ? 'selected' : '' }}>Image-Only Popup (Clean Banner / Poster)</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Badge Tag</label>
            <input type="text" name="badge_text" class="form-control" value="{{ old('badge_text', $popup->badge_text) }}" placeholder="e.g. EXCLUSIVE OFFER, SPECIAL DEAL, NOTICE">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Headline</label>
          <input type="text" name="headline" class="form-control" value="{{ old('headline', $popup->headline) }}" placeholder="e.g. Flat 15% Off On Premium Luggage & Bags">
        </div>

        <div class="mb-3">
          <label class="form-label">Description / Body Text</label>
          <textarea name="description" class="form-control" rows="3">{{ old('description', $popup->description) }}</textarea>
        </div>

        <!-- Offer fields (shown when type is offer) -->
        <div id="offerFieldsGroup" class="p-3 mb-3 rounded-3" style="background:#fefbf4; border:1px solid #f6eedb;">
          <h6 class="fw-bold text-dark mb-3"><i class="bi bi-tag-fill text-warning me-1"></i> Discount &amp; Coupon Details</h6>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Discount Percentage (%)</label>
              <div class="input-group">
                <input type="number" name="discount_percentage" class="form-control" value="{{ old('discount_percentage', $popup->discount_percentage) }}" min="1" max="100">
                <span class="input-group-text">% OFF</span>
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Coupon Code (Optional)</label>
              <input type="text" name="coupon_code" class="form-control text-uppercase fw-bold" value="{{ old('coupon_code', $popup->coupon_code) }}">
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Button Text</label>
            <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $popup->button_text) }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Button URL / Redirect</label>
            <input type="text" name="button_url" class="form-control" value="{{ old('button_url', $popup->button_url) }}">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Popup Banner Image (Optional)</label>
          @if($popup->image)
            <div class="mb-2">
              <img src="{{ $popup->image_url }}" alt="" style="max-height:120px; border-radius:8px; border:1px solid #eee;">
            </div>
          @endif
          <input type="file" name="image" class="form-control" accept="image/*">
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
            <option value="all" {{ old('target_type', $popup->target_type) == 'all' ? 'selected' : '' }}>Entire Website (All Pages)</option>
            <option value="home_only" {{ old('target_type', $popup->target_type) == 'home_only' ? 'selected' : '' }}>Homepage Only</option>
            <option value="category" {{ old('target_type', $popup->target_type) == 'category' ? 'selected' : '' }}>Specific Category Pages</option>
            <option value="product" {{ old('target_type', $popup->target_type) == 'product' ? 'selected' : '' }}>Specific Product Pages</option>
          </select>
        </div>

        <div class="mb-3" id="categoryTargetDiv" style="display:none;">
          <label class="form-label">Select Category <span class="text-danger">*</span></label>
          <select name="category_id" class="form-select">
            <option value="">-- Choose Category --</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ old('category_id', $popup->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3" id="productTargetDiv" style="display:none;">
          <label class="form-label">Select Product <span class="text-danger">*</span></label>
          <select name="product_id" class="form-select">
            <option value="">-- Choose Product --</option>
            @foreach($products as $prod)
              <option value="{{ $prod->id }}" {{ old('product_id', $popup->product_id) == $prod->id ? 'selected' : '' }}>{{ $prod->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Display Delay (Seconds)</label>
          <input type="number" name="delay_seconds" class="form-control" value="{{ old('delay_seconds', $popup->delay_seconds) }}" min="0" max="60">
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="show_once_per_session" id="show_once" value="1" {{ old('show_once_per_session', $popup->show_once_per_session) ? 'checked' : '' }}>
          <label class="form-check-label fw-bold small text-dark" for="show_once">Show only once per user session</label>
        </div>

        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $popup->is_active) ? 'checked' : '' }}>
          <label class="form-check-label fw-bold text-success" for="is_active">Activate this Popup</label>
        </div>

        <button type="submit" class="btn btn-gold w-100 py-2.5 fw-bold">
          <i class="bi bi-check-lg me-1"></i> Update Popup
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
