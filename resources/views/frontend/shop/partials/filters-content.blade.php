<!-- Categories -->
<div class="filter-section is-open">
  <div class="filter-title">
    <span>Categories</span>
    <i class="bi bi-chevron-down"></i>
  </div>
  <div class="filter-content">
    <ul class="filter-list">
      <li>
        <label>
          <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }}>
          <span>All Categories</span>
        </label>
      </li>
      @foreach($categories as $cat)
        <li>
          <label>
            <input type="radio" name="category" value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'checked' : '' }}>
            <span>{{ $cat->name }}</span>
            @if($cat->products_count)
              <small class="text-muted ms-auto">({{ $cat->products_count }})</small>
            @endif
          </label>
          @if($cat->children->count() > 0)
          <ul class="filter-list ps-3 mt-1">
            @foreach($cat->children as $child)
            <li>
              <label>
                <input type="radio" name="category" value="{{ $child->slug }}" {{ request('category') == $child->slug ? 'checked' : '' }}>
                <span>{{ $child->name }}</span>
              </label>
            </li>
            @endforeach
          </ul>
          @endif
        </li>
      @endforeach
    </ul>
  </div>
</div>

<!-- Price Range -->
<div class="filter-section is-open">
  <div class="filter-title">
    <span>Price Range</span>
    <i class="bi bi-chevron-down"></i>
  </div>
  <div class="filter-content">
    <div class="price-range mb-2">
      <input type="number" name="min_price" class="price-input" placeholder="Min ₨" value="{{ request('min_price') }}">
      <span class="text-muted">—</span>
      <input type="number" name="max_price" class="price-input" placeholder="Max ₨" value="{{ request('max_price') }}">
    </div>
  </div>
</div>

<!-- Product Highlights -->
<div class="filter-section is-open">
  <div class="filter-title">
    <span>Highlights</span>
    <i class="bi bi-chevron-down"></i>
  </div>
  <div class="filter-content">
    <ul class="filter-list">
      <li>
        <label>
          <input type="checkbox" name="best_seller" value="1" {{ request('best_seller') ? 'checked' : '' }}>
          <span>Best Sellers</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="new_arrival" value="1" {{ request('new_arrival') ? 'checked' : '' }}>
          <span>New Arrivals</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="featured" value="1" {{ request('featured') ? 'checked' : '' }}>
          <span>Featured Products</span>
        </label>
      </li>
    </ul>
  </div>
</div>
