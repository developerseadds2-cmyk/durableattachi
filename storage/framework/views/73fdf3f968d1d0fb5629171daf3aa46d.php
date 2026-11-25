<?php if($products->count() > 0): ?>
  <div class="shop-products-grid" id="productsGridContainer">
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="shop-product-item">
        <?php echo $__env->make('frontend.partials.product-card', ['product' => $product], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <div class="mt-5 d-flex justify-content-center" id="paginationWrap">
    <?php echo e($products->links()); ?>

  </div>
<?php else: ?>
  <div class="text-center py-5 bg-white rounded-3 border p-5">
    <i class="fa-solid fa-suitcase-rolling fs-1 text-muted mb-3 d-block"></i>
    <h5 class="fw-bold text-dark">No Products Found</h5>
    <p class="text-muted small mb-4">Try clearing or adjusting your selected filters.</p>
    <button type="button" onclick="resetAllFilters()" class="btn btn-dark px-4 py-2" style="border-radius:6px; font-weight:600;">
      Reset Filters
    </button>
  </div>
<?php endif; ?>
<?php /**PATH C:\xampp8.2\htdocs\durableattachi\resources\views/frontend/shop/partials/products-list.blade.php ENDPATH**/ ?>