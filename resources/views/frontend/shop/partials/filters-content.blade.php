<!-- Price Range Slider -->
<div class="filter-group-block">
  <div class="filter-group-header" onclick="toggleFilterBlock(this)">
    <span>Price</span>
    <i class="bi bi-chevron-up"></i>
  </div>
  <div class="filter-group-body">
    <!-- Slider Track -->
    <div class="range-slider-wrapper mb-3">
      <input type="range" class="form-range custom-slider" id="priceRangeSlider" min="0" max="{{ $priceRange['max'] ?? 50000 }}" step="500" value="{{ request('max_price', $priceRange['max'] ?? 50000) }}" oninput="updatePriceInputs(this.value)" onchange="triggerAjaxFilter()">
    </div>
    <div class="d-flex align-items-center gap-2">
      <div class="input-group input-group-sm">
        <span class="input-group-text bg-white">₹</span>
        <input type="number" name="min_price" id="minPriceInput" class="form-control text-center" placeholder="0" value="{{ request('min_price', 0) }}" onchange="triggerAjaxFilter()">
      </div>
      <span class="text-muted small">To</span>
      <div class="input-group input-group-sm">
        <span class="input-group-text bg-white">₹</span>
        <input type="number" name="max_price" id="maxPriceInput" class="form-control text-center" placeholder="{{ $priceRange['max'] ?? 50000 }}" value="{{ request('max_price', $priceRange['max'] ?? 50000) }}" onchange="triggerAjaxFilter()">
      </div>
    </div>
  </div>
</div>

<!-- Bag Style / Categories (Checkboxes) -->
<div class="filter-group-block">
  <div class="filter-group-header" onclick="toggleFilterBlock(this)">
    <span>Bag Style</span>
    <i class="bi bi-chevron-up"></i>
  </div>
  <div class="filter-group-body">
    <div class="custom-checkbox-list">
      @foreach($categories as $cat)
        <label class="custom-check-item">
          <input type="checkbox" name="category" value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'checked' : '' }} onchange="triggerAjaxFilter(this)">
          <span class="check-box"></span>
          <span class="check-label">{{ $cat->name }} @if($cat->products_count)({{ $cat->products_count }})@endif</span>
        </label>
        @foreach($cat->children as $child)
          <label class="custom-check-item ps-3">
            <input type="checkbox" name="category" value="{{ $child->slug }}" {{ request('category') == $child->slug ? 'checked' : '' }} onchange="triggerAjaxFilter(this)">
            <span class="check-box"></span>
            <span class="check-label">{{ $child->name }}</span>
          </label>
        @endforeach
      @endforeach
    </div>
  </div>
</div>

<!-- Colors Grid -->
<div class="filter-group-block">
  <div class="filter-group-header" onclick="toggleFilterBlock(this)">
    <span>Color</span>
    <i class="bi bi-chevron-up"></i>
  </div>
  <div class="filter-group-body">
    <div class="color-bubbles-grid">
      @foreach($colors as $color)
        <button type="button" 
                class="filter-color-bubble {{ request('color') == $color->id ? 'active' : '' }}" 
                style="background:{{ $color->code ?: '#4a5568' }};" 
                title="{{ $color->name }}" 
                data-color-id="{{ $color->id }}"
                onclick="toggleColorFilter('{{ $color->id }}', this)">
        </button>
      @endforeach
    </div>
    <input type="hidden" name="color" id="selectedColorFilter" value="{{ request('color') }}">
  </div>
</div>

<!-- Sizes -->
<div class="filter-group-block">
  <div class="filter-group-header" onclick="toggleFilterBlock(this)">
    <span>Sizes</span>
    <i class="bi bi-chevron-up"></i>
  </div>
  <div class="filter-group-body">
    <div class="custom-checkbox-list">
      @foreach($sizes as $sz)
        <label class="custom-check-item">
          <input type="checkbox" name="size" value="{{ $sz->id }}" {{ request('size') == $sz->id ? 'checked' : '' }} onchange="triggerAjaxFilter(this)">
          <span class="check-box"></span>
          <span class="check-label">{{ $sz->name }} @if($sz->products_count)({{ $sz->products_count }})@endif</span>
        </label>
      @endforeach
    </div>
  </div>
</div>

<!-- Brand Filter -->
<div class="filter-group-block">
  <div class="filter-group-header" onclick="toggleFilterBlock(this)">
    <span>Brands</span>
    <i class="bi bi-chevron-up"></i>
  </div>
  <div class="filter-group-body">
    <div class="custom-checkbox-list">
      @foreach($brands as $b)
        <label class="custom-check-item">
          <input type="checkbox" name="brand" value="{{ $b->slug }}" {{ request('brand') == $b->slug ? 'checked' : '' }} onchange="triggerAjaxFilter(this)">
          <span class="check-box"></span>
          <span class="check-label">{{ $b->name }} @if($b->products_count)({{ $b->products_count }})@endif</span>
        </label>
      @endforeach
    </div>
  </div>
</div>
