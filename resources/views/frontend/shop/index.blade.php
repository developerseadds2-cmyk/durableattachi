@extends('frontend.layouts.app')
@section('title', 'Shop — Durable Suitcase House')

@push('styles')
<style>
.shop-hero {
  background: var(--pd-ice);
  padding: 50px 0 40px;
  text-align: center;
}
.filter-sidebar {
  position: sticky;
  top: 90px;
}
.filter-card {
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 10px;
  padding: 22px;
}
.filter-section {
  border-bottom: 1px solid #edf1eb;
  padding-bottom: 16px;
  margin-bottom: 16px;
}
.filter-section:last-child {
  border-bottom: none;
  padding-bottom: 0;
  margin-bottom: 0;
}
.filter-title {
  font-size: 0.76rem;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: var(--dsh-navy);
  margin-bottom: 12px;
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.filter-title i {
  transition: transform .2s ease;
  font-size: 0.8rem;
  color: #718096;
}
.filter-section:not(.is-open) .filter-content {
  display: none;
}
.filter-section:not(.is-open) .filter-title i {
  transform: rotate(-90deg);
}
.filter-list {
  list-style: none;
  padding: 0;
  margin: 0;
}
.filter-list li {
  margin-bottom: 8px;
}
.filter-list label {
  font-size: 0.88rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 10px;
  color: var(--text);
  transition: color 0.15s;
}
.filter-list label:hover {
  color: var(--dsh-navy-light);
}
.filter-list input[type="radio"],
.filter-list input[type="checkbox"] {
  accent-color: var(--dsh-navy-light);
  cursor: pointer;
  width: 16px;
  height: 16px;
}
.price-range {
  display: flex;
  gap: 8px;
  align-items: center;
}
.price-input {
  width: 100%;
  padding: 8px 12px;
  border: 1px solid var(--border);
  border-radius: 6px;
  font-size: 0.84rem;
  outline: none;
}
.price-input:focus {
  border-color: var(--dsh-navy-light);
}

/* Shop Products Grid */
.shop-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 300px));
  gap: 24px;
}
.shop-grid-item {
  width: 100%;
}

.sort-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 20px;
  padding-bottom: 16px;
  border-bottom: 1px solid var(--border);
  flex-wrap: wrap;
  gap: 12px;
}
.sort-bar select {
  border: 1px solid var(--border);
  border-radius: 6px;
  padding: 8px 14px;
  font-size: 0.84rem;
  outline: none;
  background: #fff;
  color: var(--text);
}
.sort-bar select:focus {
  border-color: var(--dsh-navy-light);
}

/* Mobile Filter Drawer / Offcanvas */
.mobile-filter-drawer {
  position: fixed;
  top: 0;
  left: -100%;
  bottom: 0;
  width: 85%;
  max-width: 380px;
  background: #fff;
  z-index: 99998;
  display: flex;
  flex-direction: column;
  transition: left 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  box-shadow: 8px 0 32px rgba(0,0,0,0.18);
}
.mobile-filter-drawer.open {
  left: 0;
}
.mobile-filter-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.5);
  z-index: 99997;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.3s ease, visibility 0.3s ease;
}
.mobile-filter-overlay.active {
  opacity: 1;
  visibility: visible;
}
.mobile-filter-header {
  padding: 16px 20px;
  border-bottom: 1px solid #edf1eb;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.mobile-filter-body {
  flex: 1;
  overflow-y: auto;
  padding: 20px;
}
.mobile-filter-footer {
  padding: 14px 20px;
  border-top: 1px solid #edf1eb;
  display: flex;
  gap: 10px;
  background: #fcfdfa;
}

/* Mobile 1-per-row card */
@media (max-width: 576px) {
  .shop-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }
  .shop-grid-item {
    max-width: 360px;
    margin: 0 auto;
  }
}
</style>
@endpush

@php
  $activeBrand = request('brand') ? $brands->firstWhere('slug', request('brand')) ?? \App\Models\Brand::where('slug', request('brand'))->first() : null;
  $activeCat = request('category') ? $categories->firstWhere('slug', request('category')) ?? \App\Models\Category::where('slug', request('category'))->first() : null;

  if ($activeBrand) {
      $shopTitle = $activeBrand->name . ' Collection';
      $breadcrumbCurrent = $activeBrand->name;
      $sectionLabel = 'Authorized Brand';
  } elseif ($activeCat) {
      $shopTitle = $activeCat->name;
      $breadcrumbCurrent = $activeCat->name;
      $sectionLabel = 'Category';
  } elseif (request('new_arrival')) {
      $shopTitle = 'New Season Arrivals';
      $breadcrumbCurrent = 'New Arrivals';
      $sectionLabel = 'Fresh In Store';
  } elseif (request('featured')) {
      $shopTitle = 'Featured Collection';
      $breadcrumbCurrent = 'Featured';
      $sectionLabel = 'Curated Selection';
  } else {
      $shopTitle = 'Shop All Travel Gear & Bags';
      $breadcrumbCurrent = 'All Products';
      $sectionLabel = 'Our Collection';
  }
@endphp

@section('content')
<div class="shop-hero">
  <div class="container-xl-custom">
    <span class="section-label">{{ $sectionLabel }}</span>
    <h1 style="font-family:var(--font-serif); font-size:2.5rem; font-weight:700; color:var(--dsh-navy, #142D4E); margin-bottom:6px;">{{ $shopTitle }}</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center small text-muted" style="background:none; padding:0; margin:0;">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Shop</a></li>
        @if($breadcrumbCurrent !== 'All Products')
          <li class="breadcrumb-item active" style="color:var(--dsh-gold-dark, #A97E3B); font-weight:600;">{{ $breadcrumbCurrent }}</li>
        @endif
      </ol>
    </nav>
  </div>
</div>

<div class="container-xl-custom py-4 py-md-5">
  <div class="row g-4 g-lg-5">

    <!-- Desktop Sidebar (Hidden on tablets & phones) -->
    <div class="col-lg-3 d-none d-lg-block">
      <div class="filter-sidebar">
        <div class="filter-card">
          <form method="GET" action="{{ route('shop.index') }}" id="filterFormDesktop">
            @include('frontend.shop.partials.filters-content', ['formId' => 'Desktop'])
            <div class="mt-4">
              <button type="submit" class="btn-glamora w-100 justify-content-center" style="padding:11px;border-radius:6px;">
                <i class="bi bi-funnel me-1"></i> Apply Filters
              </button>
              <a href="{{ route('shop.index') }}" class="d-block text-center text-muted small mt-2">
                Clear all filters
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Products Column -->
    <div class="col-lg-9">

      <!-- Sort & Mobile Filter Toggle Bar -->
      <div class="sort-bar">
        <div class="d-flex align-items-center gap-2">
          <!-- Mobile Filter Button -->
          <button type="button" class="btn btn-outline-dark d-lg-none d-inline-flex align-items-center gap-2" onclick="openFilterDrawer()" style="font-size:0.82rem;font-weight:600;padding:8px 16px;border-radius:6px;border-color:var(--border);">
            <i class="bi bi-sliders"></i>
            <span>Filters</span>
            @php
              $activeFiltersCount = (request('category') ? 1 : 0)
                + (request('min_price') || request('max_price') ? 1 : 0)
                + (request('best_seller') ? 1 : 0)
                + (request('new_arrival') ? 1 : 0)
                + (request('featured') ? 1 : 0);
            @endphp
            @if($activeFiltersCount > 0)
              <span class="badge" style="background:var(--dsh-navy-light);color:#fff;border-radius:50%;font-size:0.65rem;padding:2px 6px;">{{ $activeFiltersCount }}</span>
            @endif
          </button>

          <span class="small text-muted d-none d-sm-inline">
            Showing <strong>{{ $products->total() }}</strong> products
          </span>
        </div>

        <div class="d-flex align-items-center gap-2">
          <label class="small text-muted d-none d-md-inline" for="sortSelect">Sort by:</label>
          <select id="sortSelect" name="sort" class="form-select form-select-sm" style="width:auto; min-width:160px;" onchange="applySort(this.value)">
            <option value="">Default Sorting</option>
            <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>Newest First</option>
            <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Price: High to Low</option>
            <option value="best_seller" {{ request('sort')=='best_seller' ? 'selected' : '' }}>Best Sellers</option>
          </select>
        </div>
      </div>

      <!-- Active Filters Quick Bar (Chips) -->
      @if($activeFiltersCount > 0)
        <div class="d-flex flex-wrap align-items-center gap-2 mb-3 pb-2">
          <span class="small text-muted fw-semibold me-1">Active:</span>
          @if(request('category'))
            <span class="badge" style="background:#eef4ec;color:var(--dsh-navy);font-size:0.75rem;padding:6px 10px;border-radius:20px;font-weight:500;">
              {{ ucfirst(request('category')) }}
              <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="ms-1 text-muted">&times;</a>
            </span>
          @endif
          @if(request('min_price') || request('max_price'))
            <span class="badge" style="background:#eef4ec;color:var(--dsh-navy);font-size:0.75rem;padding:6px 10px;border-radius:20px;font-weight:500;">
              ₨{{ request('min_price', 0) }} - ₨{{ request('max_price', '∞') }}
              <a href="{{ request()->fullUrlWithQuery(['min_price' => null, 'max_price' => null]) }}" class="ms-1 text-muted">&times;</a>
            </span>
          @endif
          @if(request('best_seller'))
            <span class="badge" style="background:#eef4ec;color:var(--dsh-navy);font-size:0.75rem;padding:6px 10px;border-radius:20px;font-weight:500;">
              Best Sellers
              <a href="{{ request()->fullUrlWithQuery(['best_seller' => null]) }}" class="ms-1 text-muted">&times;</a>
            </span>
          @endif
          @if(request('new_arrival'))
            <span class="badge" style="background:#eef4ec;color:var(--dsh-navy);font-size:0.75rem;padding:6px 10px;border-radius:20px;font-weight:500;">
              New Arrivals
              <a href="{{ request()->fullUrlWithQuery(['new_arrival' => null]) }}" class="ms-1 text-muted">&times;</a>
            </span>
          @endif
          @if(request('featured'))
            <span class="badge" style="background:#eef4ec;color:var(--dsh-navy);font-size:0.75rem;padding:6px 10px;border-radius:20px;font-weight:500;">
              Featured
              <a href="{{ request()->fullUrlWithQuery(['featured' => null]) }}" class="ms-1 text-muted">&times;</a>
            </span>
          @endif
          <a href="{{ route('shop.index') }}" class="small text-danger text-decoration-none ms-2" style="font-size:0.75rem;">Clear All</a>
        </div>
      @endif

      <!-- Products Grid -->
      @if($products->count() > 0)
        <div class="shop-grid">
          @foreach($products as $product)
            <div class="shop-grid-item" data-aos="fade-up" data-aos-delay="{{ $loop->index % 6 * 60 }}">
              @include('frontend.partials.product-card', ['product' => $product])
            </div>
          @endforeach
        </div>
        <div class="mt-5 d-flex justify-content-center">
          {{ $products->links() }}
        </div>
      @else
        <div class="text-center py-5">
          <div style="width:72px;height:72px;background:var(--pd-ice);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
            <i class="bi bi-funnel" style="font-size:2rem;color:var(--dsh-navy-light);"></i>
          </div>
          <h5 style="font-family:var(--font-serif);font-size:1.3rem;color:var(--dsh-navy);margin-bottom:8px;">No Products Found</h5>
          <p class="text-muted small mb-4">Try relaxing or clearing your filter criteria.</p>
          <a href="{{ route('shop.index') }}" class="btn-glamora" style="padding:11px 28px;border-radius:6px;">
            <i class="bi bi-arrow-repeat me-1"></i> Reset Filters
          </a>
        </div>
      @endif

    </div>
  </div>
</div>

<!-- Mobile Slide-Out Filter Drawer -->
<div class="mobile-filter-overlay" id="mobileFilterOverlay" onclick="closeFilterDrawer()"></div>
<div class="mobile-filter-drawer" id="mobileFilterDrawer">
  <div class="mobile-filter-header">
    <div class="d-flex align-items-center gap-2">
      <i class="bi bi-sliders text-ayur-leaf"></i>
      <h6 class="mb-0 fw-bold" style="font-family:var(--font-serif);font-size:1.15rem;color:var(--dsh-navy);">Filter Products</h6>
    </div>
    <button type="button" class="btn-close" onclick="closeFilterDrawer()" aria-label="Close"></button>
  </div>

  <form method="GET" action="{{ route('shop.index') }}" id="filterFormMobile" class="d-flex flex-column h-100">
    <input type="hidden" name="sort" value="{{ request('sort') }}" id="mobileHiddenSort">

    <div class="mobile-filter-body">
      @include('frontend.shop.partials.filters-content', ['formId' => 'Mobile'])
    </div>

    <div class="mobile-filter-footer">
      <a href="{{ route('shop.index') }}" class="btn btn-light flex-grow-1" style="font-size:0.84rem;font-weight:600;border:1px solid var(--border);border-radius:6px;display:flex;align-items:center;justify-content:center;">
        Reset
      </a>
      <button type="submit" class="btn-glamora flex-grow-1 justify-content-center" style="padding:11px;border-radius:6px;">
        Apply Filters
      </button>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
// Filter accordion collapse/expand
document.querySelectorAll('.filter-title').forEach(title => {
  title.addEventListener('click', () => {
    title.closest('.filter-section').classList.toggle('is-open');
  });
});

// Mobile Filter Drawer Toggle
function openFilterDrawer() {
  document.getElementById('mobileFilterDrawer').classList.add('open');
  document.getElementById('mobileFilterOverlay').classList.add('active');
  document.body.style.overflow = 'hidden';
}

function closeFilterDrawer() {
  document.getElementById('mobileFilterDrawer').classList.remove('open');
  document.getElementById('mobileFilterOverlay').classList.remove('active');
  document.body.style.overflow = '';
}

// Sorting change
function applySort(sortVal) {
  const currentUrl = new URL(window.location.href);
  if (sortVal) {
    currentUrl.searchParams.set('sort', sortVal);
  } else {
    currentUrl.searchParams.delete('sort');
  }
  window.location.href = currentUrl.toString();
}
</script>
@endpush


