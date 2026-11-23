<?php $__env->startSection('title', 'Shop — Ayur Naman'); ?>

<?php $__env->startPush('styles'); ?>
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
  color: var(--ayur-green-dark);
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
  color: var(--ayur-green);
}
.filter-list input[type="radio"],
.filter-list input[type="checkbox"] {
  accent-color: var(--ayur-green);
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
  border-color: var(--ayur-green);
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
  border-color: var(--ayur-green);
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
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="shop-hero">
  <div class="container-xl-custom">
    <span class="section-label">Our Collection</span>
    <h1 style="font-family:var(--font-serif); font-size:2.5rem; font-weight:400; margin-bottom:6px;">Shop All Ayurvedic Products</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center small text-muted" style="background:none; padding:0; margin:0;">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item active">Shop</li>
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
          <form method="GET" action="<?php echo e(route('shop.index')); ?>" id="filterFormDesktop">
            <?php echo $__env->make('frontend.shop.partials.filters-content', ['formId' => 'Desktop'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <div class="mt-4">
              <button type="submit" class="btn-glamora w-100 justify-content-center" style="padding:11px;border-radius:6px;">
                <i class="bi bi-funnel me-1"></i> Apply Filters
              </button>
              <a href="<?php echo e(route('shop.index')); ?>" class="d-block text-center text-muted small mt-2">
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
            <?php
              $activeFiltersCount = (request('category') ? 1 : 0)
                + (request('min_price') || request('max_price') ? 1 : 0)
                + (request('best_seller') ? 1 : 0)
                + (request('new_arrival') ? 1 : 0)
                + (request('featured') ? 1 : 0);
            ?>
            <?php if($activeFiltersCount > 0): ?>
              <span class="badge" style="background:var(--ayur-green);color:#fff;border-radius:50%;font-size:0.65rem;padding:2px 6px;"><?php echo e($activeFiltersCount); ?></span>
            <?php endif; ?>
          </button>

          <span class="small text-muted d-none d-sm-inline">
            Showing <strong><?php echo e($products->total()); ?></strong> products
          </span>
        </div>

        <div class="d-flex align-items-center gap-2">
          <label class="small text-muted d-none d-md-inline" for="sortSelect">Sort by:</label>
          <select id="sortSelect" name="sort" class="form-select form-select-sm" style="width:auto; min-width:160px;" onchange="applySort(this.value)">
            <option value="">Default Sorting</option>
            <option value="newest" <?php echo e(request('sort')=='newest' ? 'selected' : ''); ?>>Newest First</option>
            <option value="price_asc" <?php echo e(request('sort')=='price_asc' ? 'selected' : ''); ?>>Price: Low to High</option>
            <option value="price_desc" <?php echo e(request('sort')=='price_desc' ? 'selected' : ''); ?>>Price: High to Low</option>
            <option value="best_seller" <?php echo e(request('sort')=='best_seller' ? 'selected' : ''); ?>>Best Sellers</option>
          </select>
        </div>
      </div>

      <!-- Active Filters Quick Bar (Chips) -->
      <?php if($activeFiltersCount > 0): ?>
        <div class="d-flex flex-wrap align-items-center gap-2 mb-3 pb-2">
          <span class="small text-muted fw-semibold me-1">Active:</span>
          <?php if(request('category')): ?>
            <span class="badge" style="background:#eef4ec;color:var(--ayur-green-dark);font-size:0.75rem;padding:6px 10px;border-radius:20px;font-weight:500;">
              <?php echo e(ucfirst(request('category'))); ?>

              <a href="<?php echo e(request()->fullUrlWithQuery(['category' => null])); ?>" class="ms-1 text-muted">&times;</a>
            </span>
          <?php endif; ?>
          <?php if(request('min_price') || request('max_price')): ?>
            <span class="badge" style="background:#eef4ec;color:var(--ayur-green-dark);font-size:0.75rem;padding:6px 10px;border-radius:20px;font-weight:500;">
              ₨<?php echo e(request('min_price', 0)); ?> - ₨<?php echo e(request('max_price', '∞')); ?>

              <a href="<?php echo e(request()->fullUrlWithQuery(['min_price' => null, 'max_price' => null])); ?>" class="ms-1 text-muted">&times;</a>
            </span>
          <?php endif; ?>
          <?php if(request('best_seller')): ?>
            <span class="badge" style="background:#eef4ec;color:var(--ayur-green-dark);font-size:0.75rem;padding:6px 10px;border-radius:20px;font-weight:500;">
              Best Sellers
              <a href="<?php echo e(request()->fullUrlWithQuery(['best_seller' => null])); ?>" class="ms-1 text-muted">&times;</a>
            </span>
          <?php endif; ?>
          <?php if(request('new_arrival')): ?>
            <span class="badge" style="background:#eef4ec;color:var(--ayur-green-dark);font-size:0.75rem;padding:6px 10px;border-radius:20px;font-weight:500;">
              New Arrivals
              <a href="<?php echo e(request()->fullUrlWithQuery(['new_arrival' => null])); ?>" class="ms-1 text-muted">&times;</a>
            </span>
          <?php endif; ?>
          <?php if(request('featured')): ?>
            <span class="badge" style="background:#eef4ec;color:var(--ayur-green-dark);font-size:0.75rem;padding:6px 10px;border-radius:20px;font-weight:500;">
              Featured
              <a href="<?php echo e(request()->fullUrlWithQuery(['featured' => null])); ?>" class="ms-1 text-muted">&times;</a>
            </span>
          <?php endif; ?>
          <a href="<?php echo e(route('shop.index')); ?>" class="small text-danger text-decoration-none ms-2" style="font-size:0.75rem;">Clear All</a>
        </div>
      <?php endif; ?>

      <!-- Products Grid -->
      <?php if($products->count() > 0): ?>
        <div class="shop-grid">
          <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="shop-grid-item" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index % 6 * 60); ?>">
              <?php echo $__env->make('frontend.partials.product-card', ['product' => $product], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="mt-5 d-flex justify-content-center">
          <?php echo e($products->links()); ?>

        </div>
      <?php else: ?>
        <div class="text-center py-5">
          <div style="width:72px;height:72px;background:var(--pd-ice);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
            <i class="bi bi-funnel" style="font-size:2rem;color:var(--ayur-green);"></i>
          </div>
          <h5 style="font-family:var(--font-serif);font-size:1.3rem;color:var(--ayur-green-dark);margin-bottom:8px;">No Products Found</h5>
          <p class="text-muted small mb-4">Try relaxing or clearing your filter criteria.</p>
          <a href="<?php echo e(route('shop.index')); ?>" class="btn-glamora" style="padding:11px 28px;border-radius:6px;">
            <i class="bi bi-arrow-repeat me-1"></i> Reset Filters
          </a>
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>

<!-- Mobile Slide-Out Filter Drawer -->
<div class="mobile-filter-overlay" id="mobileFilterOverlay" onclick="closeFilterDrawer()"></div>
<div class="mobile-filter-drawer" id="mobileFilterDrawer">
  <div class="mobile-filter-header">
    <div class="d-flex align-items-center gap-2">
      <i class="bi bi-sliders text-ayur-leaf"></i>
      <h6 class="mb-0 fw-bold" style="font-family:var(--font-serif);font-size:1.15rem;color:var(--ayur-green-dark);">Filter Products</h6>
    </div>
    <button type="button" class="btn-close" onclick="closeFilterDrawer()" aria-label="Close"></button>
  </div>

  <form method="GET" action="<?php echo e(route('shop.index')); ?>" id="filterFormMobile" class="d-flex flex-column h-100">
    <input type="hidden" name="sort" value="<?php echo e(request('sort')); ?>" id="mobileHiddenSort">

    <div class="mobile-filter-body">
      <?php echo $__env->make('frontend.shop.partials.filters-content', ['formId' => 'Mobile'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <div class="mobile-filter-footer">
      <a href="<?php echo e(route('shop.index')); ?>" class="btn btn-light flex-grow-1" style="font-size:0.84rem;font-weight:600;border:1px solid var(--border);border-radius:6px;display:flex;align-items:center;justify-content:center;">
        Reset
      </a>
      <button type="submit" class="btn-glamora flex-grow-1 justify-content-center" style="padding:11px;border-radius:6px;">
        Apply Filters
      </button>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\ayushnaman\resources\views/frontend/shop/index.blade.php ENDPATH**/ ?>