<?php $__env->startSection('title', 'Luggage & Bags — Durable Suitcase House Since 1960'); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* Main Shop Page Styles matching Uppercase */
.shop-page-wrapper {
  background: #f8fafc;
  min-height: 100vh;
  padding: 24px 32px 60px;
  overflow-x: hidden;
  width: 100%;
  box-sizing: border-box;
}
@media (max-width: 1200px) { .shop-page-wrapper { padding: 20px 20px 40px; } }
@media (max-width: 992px) { .shop-page-wrapper { padding: 14px 12px 30px; } }
@media (max-width: 576px) { .shop-page-wrapper { padding: 10px 8px 20px; } }

.shop-main-row {
  margin-left: -8px !important;
  margin-right: -8px !important;
}
.shop-main-row > [class*="col-"] {
  padding-left: 8px !important;
  padding-right: 8px !important;
}

/* Mobile Slide-out Filter Drawer */
.mobile-filter-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(15, 23, 42, 0.6);
  backdrop-filter: blur(2px);
  z-index: 1055;
  opacity: 0;
  visibility: hidden;
  transition: all 0.25s ease;
}
.mobile-filter-backdrop.show {
  opacity: 1;
  visibility: visible;
}

.mobile-filter-drawer {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  width: 85%;
  max-width: 340px;
  background: #ffffff;
  z-index: 1060;
  transform: translateX(-100%);
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  display: flex;
  flex-direction: column;
  box-shadow: 10px 0 30px rgba(0,0,0,0.15);
}
.mobile-filter-drawer.show {
  transform: translateX(0);
}

.mobile-filter-header {
  padding: 16px 20px;
  border-bottom: 1px solid #e2e8f0;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.mobile-filter-body {
  padding: 20px;
  overflow-y: auto;
  flex: 1;
}
.mobile-filter-footer {
  padding: 14px 20px;
  border-top: 1px solid #e2e8f0;
  display: flex;
  gap: 10px;
  background: #f8fafc;
}

@media (max-width: 991px) {
  .filters-col-wrap {
    display: none !important;
  }
  .products-col-wrap {
    width: 100% !important;
    max-width: 100% !important;
    flex: 0 0 100% !important;
  }
  #btnToggleFiltersDesktop {
    display: none !important;
  }
  #btnMobileFilterTrigger {
    display: inline-flex !important;
  }
}
@media (min-width: 992px) {
  #btnMobileFilterTrigger {
    display: none !important;
  }
}

/* Sidebar Filter Column */
.filters-col-wrap {
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}
.filters-col-wrap.hidden-sidebar {
  display: none !important;
}
.products-col-wrap.full-width {
  width: 100% !important;
  max-width: 100% !important;
  flex: 0 0 100% !important;
}

.filters-title-main {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 24px;
}
.filter-group-block {
  border-bottom: 1px solid #e2e8f0;
  padding-bottom: 18px;
  margin-bottom: 18px;
}
.filter-group-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  cursor: pointer;
  font-weight: 700;
  font-size: 0.95rem;
  color: #0f172a;
  margin-bottom: 14px;
  user-select: none;
}
.filter-group-header i {
  font-size: 0.85rem;
  color: #64748b;
  transition: transform 0.2s ease;
}
.filter-group-block.collapsed .filter-group-body {
  display: none;
}
.filter-group-block.collapsed .filter-group-header i {
  transform: rotate(180deg);
}

/* Custom Checkbox list */
.custom-checkbox-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.custom-check-item {
  display: flex;
  align-items: center;
  gap: 10px;
  cursor: pointer;
  font-size: 0.88rem;
  color: #334155;
  user-select: none;
}
.custom-check-item input {
  display: none;
}
.custom-check-item .check-box {
  width: 18px;
  height: 18px;
  border: 1.5px solid #cbd5e1;
  border-radius: 4px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #ffffff;
  transition: all 0.15s;
}
.custom-check-item input:checked + .check-box {
  background: #142D4E;
  border-color: #142D4E;
}
.custom-check-item input:checked + .check-box::after {
  content: '✓';
  color: #ffffff;
  font-size: 0.75rem;
  font-weight: 800;
}
.custom-check-item .check-label {
  line-height: 1.2;
}

/* Color Bubbles Grid */
.color-bubbles-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
.filter-color-bubble {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  border: 2px solid #ffffff;
  box-shadow: 0 0 0 1px #cbd5e1;
  cursor: pointer;
  transition: transform 0.15s;
  padding: 0;
}
.filter-color-bubble.active, .filter-color-bubble:hover {
  box-shadow: 0 0 0 2px #142D4E;
  transform: scale(1.15);
}

/* Header Banner & Feature Strip */
.shop-banner-headline {
  font-size: 1.85rem;
  font-weight: 800;
  color: #0f172a;
  letter-spacing: -0.5px;
  text-transform: uppercase;
}
.feature-badges-row {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 12px;
  margin-top: 16px;
  margin-bottom: 24px;
}
@media (max-width: 992px) {
  .feature-badges-row { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 576px) {
  .feature-badges-row { grid-template-columns: 1fr; }
}

.feature-badge-box {
  background: #ffffff;
  border: 1px solid #eef2f6;
  border-radius: 12px;
  padding: 12px 14px;
  display: flex;
  align-items: center;
  gap: 12px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.02);
}
.feature-badge-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.15rem;
  flex-shrink: 0;
}
.badge-icon-green { background: #ecfdf5; color: #059669; }
.badge-icon-coral { background: #fff1f2; color: #e11d48; }
.badge-icon-amber { background: #fffbeb; color: #d97706; }
.badge-icon-blue  { background: #eff6ff; color: #2563eb; }

.feature-badge-text .badge-title {
  font-size: 0.82rem;
  font-weight: 700;
  color: #1e293b;
  line-height: 1.2;
}
.feature-badge-text .badge-sub {
  font-size: 0.75rem;
  color: #64748b;
  line-height: 1.2;
}

/* Product Cards in Uppercase Style */
.uppercase-card {
  background: #ffffff;
  border: 1px solid #eef2f6;
  border-radius: 16px;
  padding: 14px;
  transition: all 0.25s ease;
  height: 100%;
  display: flex;
  flex-direction: column;
}
.uppercase-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 24px rgba(0,0,0,0.06);
}
.uppercase-card .product-card-img {
  aspect-ratio: 1;
  background: #f8fafc;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 12px;
  margin-bottom: 12px;
  position: relative;
  overflow: hidden;
}
.uppercase-card .product-card-img img {
  max-height: 100%;
  max-width: 100%;
  object-fit: contain;
  transition: transform 0.3s ease;
}
.uppercase-card:hover .product-card-img img {
  transform: scale(1.04);
}

.card-color-swatches {
  display: flex;
  gap: 6px;
  align-items: center;
}
.card-color-bubble {
  width: 14px;
  height: 14px;
  border-radius: 50%;
  border: 1px solid rgba(0,0,0,0.15);
  display: inline-block;
}
.card-color-bubble.active {
  box-shadow: 0 0 0 1.5px #142D4E;
}

.uppercase-card .product-card-name {
  font-size: 0.92rem;
  font-weight: 600;
  color: #1e293b;
  margin-top: 4px;
  margin-bottom: 4px;
  line-height: 1.3;
}
.card-rating-line {
  font-size: 0.78rem;
  color: #64748b;
  display: flex;
  align-items: center;
  gap: 4px;
}
.stars-gold {
  color: #f59e0b;
  letter-spacing: 1px;
}
.rating-val {
  font-weight: 700;
  color: #334155;
}

.uppercase-card .product-card-price {
  display: flex;
  align-items: baseline;
  gap: 6px;
  margin-top: 4px;
  margin-bottom: 10px;
}
.uppercase-card .price-current {
  font-size: 1.15rem;
  font-weight: 800;
  color: #0f172a;
}
.uppercase-card .price-original {
  font-size: 0.88rem;
  color: #94a3b8;
  text-decoration: line-through;
}
.badge-discount-red {
  background: #fee2e2;
  color: #dc2626;
  font-size: 0.72rem;
  font-weight: 700;
  padding: 2px 6px;
  border-radius: 4px;
}

.btn-green-add-cart {
  background: var(--dsh-navy, #142D4E);
  color: #ffffff;
  border: none;
  border-radius: 8px;
  padding: 10px;
  font-weight: 700;
  font-size: 0.88rem;
  transition: all 0.2s;
  cursor: pointer;
}
.btn-green-add-cart:hover {
  background: #0f233d;
  color: #ffffff;
  box-shadow: 0 4px 12px rgba(20,45,78,0.25);
}

/* 3-Column Grid Default */
.shop-products-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  transition: all 0.3s ease;
}
/* When sidebar is hidden (Full screen products), use 4 columns */
.products-col-wrap.full-width .shop-products-grid {
  grid-template-columns: repeat(4, 1fr);
}

@media (max-width: 1200px) {
  .shop-products-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
  .products-col-wrap.full-width .shop-products-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 991px) {
  .shop-products-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 14px !important; }
}
@media (max-width: 480px) {
  /* On very small screens (<= 480px) */
  .shop-products-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 10px !important; }
  .shop-products-grid .uppercase-card { max-width: 100% !important; }
}

/* ROW (LIST) VIEW — 2 PER ROW on desktop, 1 per row on tablet and mobile */
.shop-products-grid.list-view {
  display: grid !important;
  grid-template-columns: repeat(2, 1fr) !important;
  gap: 16px !important;
}
.products-col-wrap.full-width .shop-products-grid.list-view {
  grid-template-columns: repeat(2, 1fr) !important;
}
@media (max-width: 991px) {
  .shop-products-grid.list-view,
  .products-col-wrap.full-width .shop-products-grid.list-view {
    grid-template-columns: 1fr !important;
    gap: 12px !important;
  }
}
.shop-products-grid.list-view .uppercase-card {
  flex-direction: row;
  align-items: center;
  gap: 14px;
  padding: 12px;
  height: auto;
  min-height: 120px;
}
.shop-products-grid.list-view .product-card-img {
  width: 110px;
  min-width: 110px;
  max-width: 110px;
  height: 110px;
  flex-shrink: 0;
  margin-bottom: 0;
  padding: 6px;
}
.shop-products-grid.list-view .product-card-body {
  flex: 1;
  min-width: 0; /* Prevents overflow with flex-child */
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.shop-products-grid.list-view .product-card-name {
  white-space: normal;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  font-size: 0.95rem;
}
.shop-products-grid.list-view .btn-green-add-cart {
  width: auto !important;
  max-width: 160px;
  padding: 7px 14px;
  font-size: 0.85rem;
}

@media (max-width: 768px) {
  /* Ensure uppercase cards fill their column container without fixed width constraints */
  .shop-products-grid .uppercase-card {
    max-width: 100% !important;
    margin: 0 !important;
    border-radius: 12px;
  }

  /* List view on phones and smaller tablets */
  .shop-products-grid.list-view .uppercase-card {
    flex-direction: row !important;
    align-items: center !important;
    gap: 14px !important;
    padding: 12px 14px !important;
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
    overflow: hidden !important;
    min-height: 126px !important;
  }
  .shop-products-grid.list-view .product-card-img {
    width: 105px !important;
    min-width: 105px !important;
    max-width: 105px !important;
    height: 105px !important;
    padding: 6px !important;
    border-radius: 10px !important;
    margin-bottom: 0 !important;
    position: relative !important;
  }
  .shop-products-grid.list-view .product-card-body {
    flex: 1 !important;
    min-width: 0 !important;
    overflow: hidden !important;
  }
  .shop-products-grid.list-view .product-card-name {
    font-size: 0.88rem !important;
    line-height: 1.3 !important;
    margin-bottom: 3px !important;
  }
  .shop-products-grid.list-view .card-rating-line {
    font-size: 0.72rem !important;
    gap: 3px !important;
  }
  .shop-products-grid.list-view .price-current {
    font-size: 0.98rem !important;
  }
  .shop-products-grid.list-view .btn-green-add-cart {
    max-width: 140px !important;
    padding: 7px 12px !important;
    font-size: 0.8rem !important;
    border-radius: 6px !important;
  }

  /* Standard Grid on phones: 2-columns */
  .shop-products-grid:not(.list-view) {
    grid-template-columns: repeat(2, 1fr) !important;
    gap: 10px !important;
  }
  .shop-products-grid:not(.list-view) .uppercase-card {
    padding: 8px !important;
  }
  .shop-products-grid:not(.list-view) .product-card-img {
    border-radius: 8px;
    padding: 6px;
    margin-bottom: 6px;
  }
  .shop-products-grid:not(.list-view) .product-card-body {
    padding: 0 !important;
  }
  .shop-products-grid:not(.list-view) .product-card-name {
    font-size: 0.8rem !important;
    line-height: 1.25 !important;
    white-space: normal !important;
    display: -webkit-box !important;
    -webkit-line-clamp: 2 !important;
    -webkit-box-orient: vertical !important;
    overflow: hidden !important;
    height: 2.3em !important;
    margin-bottom: 3px !important;
  }
  .shop-products-grid:not(.list-view) .card-rating-line {
    font-size: 0.68rem !important;
    gap: 2px !important;
    flex-wrap: wrap !important;
  }
  .shop-products-grid:not(.list-view) .price-current {
    font-size: 0.92rem !important;
  }
  .shop-products-grid:not(.list-view) .price-original {
    font-size: 0.76rem !important;
  }
  .shop-products-grid:not(.list-view) .btn-green-add-cart {
    padding: 6px 8px !important;
    font-size: 0.75rem !important;
    border-radius: 6px !important;
  }
  .shop-products-grid:not(.list-view) .product-card-wish-top .wishlist-btn {
    width: 28px !important;
    height: 28px !important;
    font-size: 0.8rem !important;
    top: 6px !important;
    right: 6px !important;
  }
}

/* View switcher and Filter toggle buttons */
.view-btn {
  width: 36px;
  height: 36px;
  border-radius: 6px;
  border: 1px solid #cbd5e1;
  background: #ffffff;
  color: #64748b;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s;
}
.view-btn.active, .view-btn:hover {
  background: #142D4E;
  color: #ffffff;
  border-color: #142D4E;
}

.btn-toggle-filters {
  height: 36px;
  padding: 0 14px;
  border-radius: 6px;
  border: 1px solid #cbd5e1;
  background: #ffffff;
  color: #334155;
  font-weight: 600;
  font-size: 0.85rem;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  cursor: pointer;
  transition: all 0.2s;
}
.btn-toggle-filters:hover {
  border-color: #142D4E;
  color: #142D4E;
}
.btn-toggle-filters.active {
  background: #e2e8f0;
}

/* Loading Overlay */
#shopLoadingOverlay {
  position: absolute;
  inset: 0;
  background: rgba(248, 250, 252, 0.7);
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 10;
  border-radius: 12px;
}
.spinner-border-navy {
  color: #142D4E;
  width: 2.5rem;
  height: 2.5rem;
}

/* Sort dropdown */
.sort-select-box {
  background: #ffffff;
  border: 1px solid #cbd5e1;
  border-radius: 6px;
  padding: 6px 14px;
  font-size: 0.85rem;
  font-weight: 600;
  color: #334155;
  outline: none;
  height: 36px;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="shop-page-wrapper">
  <div class="row g-4 g-xl-5 position-relative shop-main-row">

    <!-- LEFT SIDEBAR: Filters (Col 3) -->
    <div class="col-lg-3 filters-col-wrap" id="filtersSidebarCol">
      <div class="filters-container">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h4 class="filters-title-main mb-0">Filters</h4>
          <button type="button" class="btn btn-sm btn-link text-muted text-decoration-none p-0" onclick="resetAllFilters()">Clear All</button>
        </div>
        
        <form id="ajaxFilterForm" onsubmit="return false;">
          <input type="hidden" name="sort" id="currentSortInput" value="<?php echo e(request('sort', 'best_seller')); ?>">
          <?php echo $__env->make('frontend.shop.partials.filters-content', ['formId' => 'Desktop'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </form>
      </div>
    </div>

    <!-- RIGHT CONTENT: Banner, Badges & Products Grid (Col 9) -->
    <div class="col-lg-9 products-col-wrap" id="productsMainCol">
      
      <!-- Top Action Bar: Filter Toggle | Grid/Row View | Sort By -->
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
        <!-- Left: Toggle Sidebar & View Modes -->
        <div class="d-flex align-items-center gap-2">
          <!-- Desktop Toggle Fullscreen / Hide Filters -->
          <button type="button" class="btn-toggle-filters" id="btnToggleFiltersDesktop" onclick="toggleSidebarFilters()">
            <i class="fa-solid fa-sliders"></i>
            <span id="filterBtnText">Hide Filters</span>
          </button>

          <!-- Mobile Filter Button (Visible only on screens <= 991px) -->
          <button type="button" class="btn-toggle-filters" id="btnMobileFilterTrigger" onclick="openMobileFilterDrawer()">
            <i class="fa-solid fa-sliders"></i>
            <span>Filters</span>
          </button>

          <!-- Grid vs Row/List View -->
          <div class="d-flex align-items-center gap-1 ms-1">
            <button type="button" class="view-btn active" id="btnGridView" onclick="setProductLayout('grid')" title="Grid View">
              <i class="fa-solid fa-table-cells-large"></i>
            </button>
            <button type="button" class="view-btn" id="btnRowView" onclick="setProductLayout('list')" title="Row / List View (2 per row)">
              <i class="fa-solid fa-list"></i>
            </button>
          </div>
          <span class="text-muted small ms-2 d-none d-sm-inline" id="productsCountText">
            Showing <strong id="totalProductsCount"><?php echo e($products->total()); ?></strong> products
          </span>
        </div>

        <!-- Right: Sort Dropdown -->
        <div class="d-flex align-items-center gap-2">
          <span class="text-muted small fw-semibold">Sort by:</span>
          <select class="sort-select-box" id="sortSelectBox" onchange="applySortAjax(this.value)">
            <option value="best_seller" <?php echo e(request('sort')=='best_seller' ? 'selected' : ''); ?>>Best selling</option>
            <option value="newest" <?php echo e(request('sort')=='newest' ? 'selected' : ''); ?>>Featured / Newest</option>
            <option value="price_asc" <?php echo e(request('sort')=='price_asc' ? 'selected' : ''); ?>>Price: Low to High</option>
            <option value="price_desc" <?php echo e(request('sort')=='price_desc' ? 'selected' : ''); ?>>Price: High to Low</option>
          </select>
        </div>
      </div>

      <!-- Dynamic AJAX Products Container with Loading Overlay -->
      <div class="position-relative" style="min-height:300px;">
        <div id="shopLoadingOverlay">
          <div class="spinner-border spinner-border-navy" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>

        <div id="ajaxProductsContainer">
          <?php echo $__env->make('frontend.shop.partials.products-list', ['products' => $products], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Mobile Filter Slide-out Drawer & Backdrop -->
<div class="mobile-filter-backdrop" id="mobileFilterBackdrop" onclick="closeMobileFilterDrawer()"></div>
<div class="mobile-filter-drawer" id="mobileFilterDrawer">
  <div class="mobile-filter-header">
    <div class="d-flex align-items-center gap-2">
      <i class="fa-solid fa-sliders text-primary"></i>
      <h6 class="mb-0 fw-bold text-dark">Filter Products</h6>
    </div>
    <button type="button" class="btn-close" onclick="closeMobileFilterDrawer()" aria-label="Close"></button>
  </div>
  <div class="mobile-filter-body" id="mobileFilterBody">
    <!-- Filters are dynamically populated or synchronized -->
    <div id="mobileFiltersContainer"></div>
  </div>
  <div class="mobile-filter-footer">
    <button type="button" class="btn btn-sm btn-outline-secondary flex-grow-1" onclick="resetAllFilters(); closeMobileFilterDrawer();">Reset</button>
    <button type="button" class="btn btn-sm btn-dark flex-grow-1" onclick="closeMobileFilterDrawer()">Done</button>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
let currentLayout = 'grid'; // 'grid' or 'list'
let isSidebarHidden = false;
let ajaxAbortController = null;

function toggleFilterBlock(headerEl) {
  const block = headerEl.closest('.filter-group-block');
  if (block) {
    block.classList.toggle('collapsed');
  }
}

function updatePriceInputs(val) {
  const maxInp = document.getElementById('maxPriceInput');
  if (maxInp) maxInp.value = val;
}

// Mobile Filter Drawer Open / Close
function openMobileFilterDrawer() {
  const drawer = document.getElementById('mobileFilterDrawer');
  const backdrop = document.getElementById('mobileFilterBackdrop');
  const desktopForm = document.getElementById('ajaxFilterForm');
  const mobileContainer = document.getElementById('mobileFiltersContainer');

  // Move the filter form to mobile container so all inputs remain active and synchronized
  if (desktopForm && mobileContainer && !mobileContainer.contains(desktopForm)) {
    mobileContainer.appendChild(desktopForm);
  }

  drawer.classList.add('show');
  backdrop.classList.add('show');
  document.body.style.overflow = 'hidden';
}

function closeMobileFilterDrawer() {
  const drawer = document.getElementById('mobileFilterDrawer');
  const backdrop = document.getElementById('mobileFilterBackdrop');
  drawer.classList.remove('show');
  backdrop.classList.remove('show');
  document.body.style.overflow = '';
}

// Window resize listener to restore form if user flips between mobile and desktop
window.addEventListener('resize', () => {
  if (window.innerWidth >= 992) {
    const desktopForm = document.getElementById('ajaxFilterForm');
    const desktopSidebar = document.querySelector('#filtersSidebarCol .filters-container');
    if (desktopForm && desktopSidebar && !desktopSidebar.contains(desktopForm)) {
      desktopSidebar.appendChild(desktopForm);
    }
    closeMobileFilterDrawer();
  }
});

// Toggle Sidebar Filters for Fullscreen Products (Desktop)
function toggleSidebarFilters() {
  const sidebar = document.getElementById('filtersSidebarCol');
  const mainCol = document.getElementById('productsMainCol');
  const btn = document.getElementById('btnToggleFiltersDesktop');
  const btnText = document.getElementById('filterBtnText');

  isSidebarHidden = !isSidebarHidden;
  if (isSidebarHidden) {
    sidebar.classList.add('hidden-sidebar');
    mainCol.classList.add('full-width');
    btn.classList.add('active');
    btnText.textContent = 'Show Filters';
  } else {
    sidebar.classList.remove('hidden-sidebar');
    mainCol.classList.remove('full-width');
    btn.classList.remove('active');
    btnText.textContent = 'Hide Filters';
  }
}

// Grid vs Row/List layout switcher
function setProductLayout(layout, savePreference = true) {
  currentLayout = layout;
  if (savePreference) {
    try { localStorage.setItem('dsh_shop_layout', layout); } catch (e) {}
  }
  const gridContainer = document.getElementById('productsGridContainer');
  const btnGrid = document.getElementById('btnGridView');
  const btnRow = document.getElementById('btnRowView');

  if (layout === 'list') {
    if (gridContainer) gridContainer.classList.add('list-view');
    if (btnRow) btnRow.classList.add('active');
    if (btnGrid) btnGrid.classList.remove('active');
  } else {
    if (gridContainer) gridContainer.classList.remove('list-view');
    if (btnGrid) btnGrid.classList.add('active');
    if (btnRow) btnRow.classList.remove('active');
  }
}

// Color Filter Toggle
function toggleColorFilter(colorId, btnEl) {
  const inp = document.getElementById('selectedColorFilter');
  if (inp.value === colorId) {
    inp.value = '';
    btnEl.classList.remove('active');
  } else {
    document.querySelectorAll('.filter-color-bubble').forEach(b => b.classList.remove('active'));
    inp.value = colorId;
    btnEl.classList.add('active');
  }
  triggerAjaxFilter();
}

// Clear / Reset All Filters
function resetAllFilters() {
  const form = document.getElementById('ajaxFilterForm');
  if (form) {
    form.reset();
    form.querySelectorAll('input[type="checkbox"]').forEach(c => c.checked = false);
    document.getElementById('selectedColorFilter').value = '';
    document.querySelectorAll('.filter-color-bubble').forEach(b => b.classList.remove('active'));
    document.getElementById('minPriceInput').value = 0;
    document.getElementById('maxPriceInput').value = "<?php echo e($priceRange['max'] ?? 50000); ?>";
    document.getElementById('priceRangeSlider').value = "<?php echo e($priceRange['max'] ?? 50000); ?>";
  }
  triggerAjaxFilter();
}

// Apply Sort via AJAX
function applySortAjax(sortVal) {
  document.getElementById('currentSortInput').value = sortVal;
  triggerAjaxFilter();
}

// Core AJAX Filter Function (No page reload)
function triggerAjaxFilter(inputEl) {
  // If a single-choice group checkbox was clicked, uncheck sibling checkboxes with same name
  if (inputEl && (inputEl.name === 'category' || inputEl.name === 'brand' || inputEl.name === 'size')) {
    if (inputEl.checked) {
      document.querySelectorAll(`input[name="${inputEl.name}"]`).forEach(cb => {
        if (cb !== inputEl) cb.checked = false;
      });
    }
  }

  const form = document.getElementById('ajaxFilterForm');
  const formData = new FormData(form);
  const params = new URLSearchParams();

  for (const [key, val] of formData.entries()) {
    if (val !== '' && val !== null) {
      params.append(key, val);
    }
  }

  // Abort pending request
  if (ajaxAbortController) {
    ajaxAbortController.abort();
  }
  ajaxAbortController = new AbortController();

  const loading = document.getElementById('shopLoadingOverlay');
  if (loading) loading.style.display = 'flex';

  const ajaxUrl = "<?php echo e(route('shop.index')); ?>?" + params.toString();

  // Update browser URL without reloading
  window.history.pushState({}, '', ajaxUrl);

  fetch(ajaxUrl, {
    headers: {
      'X-Requested-With': 'XMLHttpRequest'
    },
    signal: ajaxAbortController.signal
  })
  .then(res => res.json())
  .then(data => {
    if (loading) loading.style.display = 'none';
    const container = document.getElementById('ajaxProductsContainer');
    if (container && data.html) {
      container.innerHTML = data.html;
      setProductLayout(currentLayout);
    }
    if (document.getElementById('totalProductsCount') && data.total !== undefined) {
      document.getElementById('totalProductsCount').textContent = data.total;
    }
    bindPaginationLinks();
  })
  .catch(err => {
    if (err.name !== 'AbortError') {
      if (loading) loading.style.display = 'none';
      console.error('Filter error:', err);
    }
  });
}

// Bind AJAX to pagination links
function bindPaginationLinks() {
  document.querySelectorAll('#ajaxProductsContainer .pagination a').forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const href = this.getAttribute('href');
      if (!href) return;

      const loading = document.getElementById('shopLoadingOverlay');
      if (loading) loading.style.display = 'flex';

      fetch(href, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
      .then(res => res.json())
      .then(data => {
        if (loading) loading.style.display = 'none';
        const container = document.getElementById('ajaxProductsContainer');
        if (container && data.html) {
          container.innerHTML = data.html;
          setProductLayout(currentLayout);
          window.scrollTo({ top: 180, behavior: 'smooth' });
          bindPaginationLinks();
        }
      })
      .catch(err => {
        if (loading) loading.style.display = 'none';
      });
    });
  });
}

document.addEventListener('DOMContentLoaded', () => {
  bindPaginationLinks();

  // 1. Restore saved layout preference (Grid vs List/Row) on page refresh
  try {
    const savedLayout = localStorage.getItem('dsh_shop_layout');
    if (savedLayout && (savedLayout === 'list' || savedLayout === 'grid')) {
      setProductLayout(savedLayout, false);
    }
  } catch (e) {}

  // 2. Client-side fallback check for recently viewed products stored in localStorage
  try {
    const viewedIds = JSON.parse(localStorage.getItem('dsh_recently_viewed') || '[]');
    if (Array.isArray(viewedIds) && viewedIds.length > 0) {
      document.querySelectorAll('.uppercase-card[data-product-id]').forEach(card => {
        const pId = parseInt(card.getAttribute('data-product-id'), 10);
        if (viewedIds.includes(pId)) {
          card.classList.add('is-recently-viewed');
          const bodyWrap = card.querySelector('.product-card-body');
          if (bodyWrap && !bodyWrap.querySelector('.recently-viewed-pill')) {
            const pill = document.createElement('div');
            pill.className = 'recently-viewed-pill';
            pill.title = 'You recently viewed this item';
            pill.innerHTML = '<i class="fa-solid fa-eye me-1"></i> Recently Viewed';
            bodyWrap.prepend(pill);
          }
        }
      });
    }
  } catch (e) {}
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\durableattachi\resources\views/frontend/shop/index.blade.php ENDPATH**/ ?>