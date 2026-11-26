<!-- Price Range Slider -->
<div class="filter-group-block">
  <div class="filter-group-header" onclick="toggleFilterBlock(this)">
    <span>Price</span>
    <i class="bi bi-chevron-up"></i>
  </div>
  <div class="filter-group-body">
    <!-- Slider Track -->
    <div class="range-slider-wrapper mb-3">
      <input type="range" class="form-range custom-slider" id="priceRangeSlider" min="0" max="<?php echo e($priceRange['max'] ?? 50000); ?>" step="500" value="<?php echo e(request('max_price', $priceRange['max'] ?? 50000)); ?>" oninput="updatePriceInputs(this.value)" onchange="triggerAjaxFilter()">
    </div>
    <div class="d-flex align-items-center gap-2">
      <div class="input-group input-group-sm">
        <span class="input-group-text bg-white">₹</span>
        <input type="number" name="min_price" id="minPriceInput" class="form-control text-center" placeholder="0" value="<?php echo e(request('min_price', 0)); ?>" onchange="triggerAjaxFilter()">
      </div>
      <span class="text-muted small">To</span>
      <div class="input-group input-group-sm">
        <span class="input-group-text bg-white">₹</span>
        <input type="number" name="max_price" id="maxPriceInput" class="form-control text-center" placeholder="<?php echo e($priceRange['max'] ?? 50000); ?>" value="<?php echo e(request('max_price', $priceRange['max'] ?? 50000)); ?>" onchange="triggerAjaxFilter()">
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
      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <label class="custom-check-item">
          <input type="checkbox" name="category" value="<?php echo e($cat->slug); ?>" <?php echo e(request('category') == $cat->slug ? 'checked' : ''); ?> onchange="triggerAjaxFilter(this)">
          <span class="check-box"></span>
          <span class="check-label"><?php echo e($cat->name); ?> <?php if($cat->products_count): ?>(<?php echo e($cat->products_count); ?>)<?php endif; ?></span>
        </label>
        <?php $__currentLoopData = $cat->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <label class="custom-check-item ps-3">
            <input type="checkbox" name="category" value="<?php echo e($child->slug); ?>" <?php echo e(request('category') == $child->slug ? 'checked' : ''); ?> onchange="triggerAjaxFilter(this)">
            <span class="check-box"></span>
            <span class="check-label"><?php echo e($child->name); ?></span>
          </label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
      <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <button type="button" 
                class="filter-color-bubble <?php echo e(request('color') == $color->id ? 'active' : ''); ?>" 
                style="background:<?php echo e($color->code ?: '#4a5568'); ?>;" 
                title="<?php echo e($color->name); ?>" 
                data-color-id="<?php echo e($color->id); ?>"
                onclick="toggleColorFilter('<?php echo e($color->id); ?>', this)">
        </button>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <input type="hidden" name="color" id="selectedColorFilter" value="<?php echo e(request('color')); ?>">
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
      <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <label class="custom-check-item">
          <input type="checkbox" name="size" value="<?php echo e($sz->id); ?>" <?php echo e(request('size') == $sz->id ? 'checked' : ''); ?> onchange="triggerAjaxFilter(this)">
          <span class="check-box"></span>
          <span class="check-label"><?php echo e($sz->name); ?> <?php if($sz->products_count): ?>(<?php echo e($sz->products_count); ?>)<?php endif; ?></span>
        </label>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
      <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <label class="custom-check-item">
          <input type="checkbox" name="brand" value="<?php echo e($b->slug); ?>" <?php echo e(request('brand') == $b->slug ? 'checked' : ''); ?> onchange="triggerAjaxFilter(this)">
          <span class="check-box"></span>
          <span class="check-label"><?php echo e($b->name); ?> <?php if($b->products_count): ?>(<?php echo e($b->products_count); ?>)<?php endif; ?></span>
        </label>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp8.2\htdocs\durableattachi\resources\views/frontend/shop/partials/filters-content.blade.php ENDPATH**/ ?>