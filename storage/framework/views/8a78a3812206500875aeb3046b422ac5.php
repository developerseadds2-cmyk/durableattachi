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
          <input type="radio" name="category" value="" <?php echo e(!request('category') ? 'checked' : ''); ?>>
          <span>All Categories</span>
        </label>
      </li>
      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
          <label>
            <input type="radio" name="category" value="<?php echo e($cat->slug); ?>" <?php echo e(request('category') == $cat->slug ? 'checked' : ''); ?>>
            <span><?php echo e($cat->name); ?></span>
            <?php if($cat->products_count): ?>
              <small class="text-muted ms-auto">(<?php echo e($cat->products_count); ?>)</small>
            <?php endif; ?>
          </label>
          <?php if($cat->children->count() > 0): ?>
          <ul class="filter-list ps-3 mt-1">
            <?php $__currentLoopData = $cat->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
              <label>
                <input type="radio" name="category" value="<?php echo e($child->slug); ?>" <?php echo e(request('category') == $child->slug ? 'checked' : ''); ?>>
                <span><?php echo e($child->name); ?></span>
              </label>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          <?php endif; ?>
        </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
      <input type="number" name="min_price" class="price-input" placeholder="Min ₨" value="<?php echo e(request('min_price')); ?>">
      <span class="text-muted">—</span>
      <input type="number" name="max_price" class="price-input" placeholder="Max ₨" value="<?php echo e(request('max_price')); ?>">
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
          <input type="checkbox" name="best_seller" value="1" <?php echo e(request('best_seller') ? 'checked' : ''); ?>>
          <span>Best Sellers</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="new_arrival" value="1" <?php echo e(request('new_arrival') ? 'checked' : ''); ?>>
          <span>New Arrivals</span>
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="featured" value="1" <?php echo e(request('featured') ? 'checked' : ''); ?>>
          <span>Featured Products</span>
        </label>
      </li>
    </ul>
  </div>
</div>
<?php /**PATH C:\xampp8.2\htdocs\ayushnaman\resources\views/frontend/shop/partials/filters-content.blade.php ENDPATH**/ ?>