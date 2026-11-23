@extends('admin.layout.app')
@section('title', 'Add Menu Item')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.megamenu.index') }}">Mega Menu</a></li>
  <li class="breadcrumb-item active">Add Item</li>
@endsection

@section('content')
<div class="page-header">
  <h4>Add Menu Item</h4>
  <a href="{{ route('admin.megamenu.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<form method="POST" action="{{ route('admin.megamenu.store') }}" enctype="multipart/form-data">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-3 pb-2 border-bottom">Menu Item</h6>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Parent Menu</label>
            <select name="parent_id" class="form-select">
              <option value="">Level 1 (Top Level)</option>
              @foreach($menus as $parent)
                <option value="{{ $parent->id }}" @selected(old('parent_id') == $parent->id)>{{ $parent->title }}</option>
              @endforeach
            </select>
            <small class="text-muted">Drag later for Level 2 or Level 3 placement.</small>
          </div>
          <div class="col-md-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-select" id="menuType" onchange="toggleType()">
              <option value="link">Simple Link</option>
              <option value="dropdown">Dropdown</option>
              <option value="megamenu">Mega Menu</option>
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
          </div>
          <div class="col-md-8">
            <label class="form-label">URL</label>
            <input type="text" name="url" class="form-control" value="{{ old('url') }}" placeholder="/shop or https://...">
          </div>
          <div class="col-md-4">
            <label class="form-label">Bootstrap Icon</label>
            <input type="text" name="icon" class="form-control" value="{{ old('icon') }}" placeholder="bi-gem">
          </div>
          <div class="col-md-4">
            <label class="form-label">Target</label>
            <select name="target" class="form-select">
              <option value="_self">Same Window</option>
              <option value="_blank">New Tab</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Badge Text</label>
            <input type="text" name="badge_text" class="form-control" value="{{ old('badge_text') }}" placeholder="NEW, HOT...">
          </div>
          <div class="col-md-4">
            <label class="form-label">Badge Color</label>
            <div class="input-group">
              <span class="input-group-text p-1"><input type="color" name="badge_color" value="{{ old('badge_color','#c9a96e') }}" style="width:30px;height:30px;border:none;cursor:pointer;"></span>
              <input type="text" class="form-control" value="{{ old('badge_color','#c9a96e') }}" readonly>
            </div>
          </div>
        </div>
      </div>

      <!-- Mega Menu Columns -->
      <div class="form-card" id="megamenuSection" style="display:none;">
        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
          <h6 class="fw-bold mb-0">Mega Menu Columns</h6>
          <button type="button" class="btn btn-sm btn-gold" id="addColumn"><i class="bi bi-plus me-1"></i>Add Column</button>
        </div>
        <div id="columnsContainer"></div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-3 pb-2 border-bottom">Settings</h6>
        <div class="form-check form-switch mb-3">
          <input class="form-check-input" type="checkbox" name="status" id="status" value="1" checked>
          <label class="form-check-label" for="status">Active</label>
        </div>
      </div>

      <!-- Mega Menu Banner -->
      <div class="form-card" id="bannerSection" style="display:none;">
        <h6 class="fw-bold mb-3 pb-2 border-bottom">Promo Banner</h6>
        <div class="mb-3">
          <input type="file" name="banner_image" class="form-control form-control-sm" accept="image/*">
        </div>
        <div class="mb-2">
          <input type="text" name="banner_title" class="form-control form-control-sm" placeholder="Banner title">
        </div>
        <div class="mb-2">
          <input type="text" name="banner_subtitle" class="form-control form-control-sm" placeholder="Subtitle">
        </div>
        <input type="text" name="banner_link" class="form-control form-control-sm" placeholder="Link URL">
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-end gap-3 mt-4">
    <a href="{{ route('admin.megamenu.index') }}" class="btn btn-outline-secondary">Cancel</a>
    <button type="submit" class="btn btn-gold"><i class="bi bi-check-lg me-1"></i>Save Menu Item</button>
  </div>
</form>
@endsection

@push('scripts')
<script>
let colCount = 0;

function toggleType() {
  const type = document.getElementById('menuType').value;
  document.getElementById('megamenuSection').style.display = type === 'megamenu' ? 'block' : 'none';
  document.getElementById('bannerSection').style.display = type === 'megamenu' ? 'block' : 'none';
}

document.getElementById('addColumn').addEventListener('click', () => {
  colCount++;
  const html = `<div class="border rounded-3 p-3 mb-3" id="col_${colCount}">
    <div class="d-flex justify-content-between mb-2">
      <h6 class="small fw-bold mb-0">Column ${colCount}</h6>
      <button type="button" class="btn btn-sm btn-outline-danger" onclick="document.getElementById('col_${colCount}').remove()"><i class="bi bi-trash"></i></button>
    </div>
    <input type="text" name="columns[${colCount}][title]" class="form-control form-control-sm mb-3" placeholder="Column heading (e.g. EARRINGS)">
    <input type="hidden" name="columns[${colCount}][sort_order]" value="${colCount}">
    <div id="items_${colCount}">
      <div class="row g-1 mb-1">
        <div class="col-5"><input type="text" name="columns[${colCount}][items][0][label]" class="form-control form-control-sm" placeholder="Item label"></div>
        <div class="col-3"><input type="text" name="columns[${colCount}][items][0][url]" class="form-control form-control-sm" placeholder="URL"></div>
        <div class="col-3"><input type="text" name="columns[${colCount}][items][0][icon]" class="form-control form-control-sm" placeholder="bi-gem"></div>
        <div class="col-1"><input type="checkbox" name="columns[${colCount}][items][0][is_highlighted]" class="form-check-input mt-2" title="Highlight"></div>
      </div>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary mt-1" onclick="addItem(${colCount})">+ Add Item</button>
  </div>`;
  document.getElementById('columnsContainer').insertAdjacentHTML('beforeend', html);
});

let itemCounts = {};
function addItem(colId) {
  itemCounts[colId] = (itemCounts[colId] || 1);
  itemCounts[colId]++;
  const idx = itemCounts[colId];
  const html = `<div class="row g-1 mb-1">
    <div class="col-5"><input type="text" name="columns[${colId}][items][${idx}][label]" class="form-control form-control-sm" placeholder="Item label"></div>
    <div class="col-3"><input type="text" name="columns[${colId}][items][${idx}][url]" class="form-control form-control-sm" placeholder="URL"></div>
    <div class="col-3"><input type="text" name="columns[${colId}][items][${idx}][icon]" class="form-control form-control-sm" placeholder="bi-gem"></div>
    <div class="col-1"><input type="checkbox" name="columns[${colId}][items][${idx}][is_highlighted]" class="form-check-input mt-2" title="Highlight"></div>
  </div>`;
  document.getElementById(`items_${colId}`).insertAdjacentHTML('beforeend', html);
}
</script>
@endpush
