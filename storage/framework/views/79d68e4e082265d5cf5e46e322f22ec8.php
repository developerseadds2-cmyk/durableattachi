<div class="product-card">
  <div class="product-card-img">
    <a href="<?php echo e(route('product.show', $product->slug)); ?>">
      <img src="<?php echo e($product->thumbnail_url); ?>" alt="<?php echo e($product->name); ?>" loading="lazy" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1565026057447-bc90a3dceb87?w=700&q=80&fit=crop';">
    </a>

    <!-- Badges -->
    <div class="product-card-badges">
      <?php if($product->is_new_arrival): ?> <span class="product-badge badge-new">New</span> <?php endif; ?>
      <?php if($product->discount_percentage): ?> <span class="product-badge badge-sale">-<?php echo e($product->discount_percentage); ?>%</span> <?php endif; ?>
      <?php if($product->is_best_seller): ?> <span class="product-badge badge-best">Best</span> <?php endif; ?>
    </div>

    <!-- Quick Actions -->
    <div class="product-card-actions">
      <button class="product-action-btn" onclick="addToCart(<?php echo e($product->id); ?>, 1)" title="Add to Cart">
        <i class="bi bi-bag-plus"></i> Add to Cart
      </button>
      <?php if(auth()->guard()->check()): ?>
      <button class="product-action-btn wishlist-btn <?php echo e(auth()->user()->wishlists()->where('product_id', $product->id)->exists() ? 'active' : ''); ?>"
        onclick="toggleWishlist(<?php echo e($product->id); ?>, this)" title="Wishlist">
        <i class="bi <?php echo e(auth()->user()->wishlists()->where('product_id', $product->id)->exists() ? 'bi-heart-fill' : 'bi-heart'); ?>"></i>
      </button>
      <?php else: ?>
      <a href="<?php echo e(route('login')); ?>" class="product-action-btn wishlist-btn" title="Wishlist">
        <i class="bi bi-heart"></i>
      </a>
      <?php endif; ?>
    </div>
  </div>

  <div class="product-card-body">
    <div class="product-card-cat"><?php echo e($product->category?->name); ?></div>
    <a href="<?php echo e(route('product.show', $product->slug)); ?>">
      <h3 class="product-card-name"><?php echo e($product->name); ?></h3>
    </a>

    <!-- Stars -->
    <?php if($product->average_rating > 0): ?>
    <div class="mb-1">
      <span class="stars">
        <?php for($i=1; $i<=5; $i++): ?><?php echo e($i <= $product->average_rating ? '★' : '☆'); ?><?php endfor; ?>
      </span>
      <span class="stars-count">(<?php echo e($product->approvedReviews->count()); ?>)</span>
    </div>
    <?php endif; ?>

    <div class="product-card-price">
      <span class="price-current">₨<?php echo e(number_format($product->current_price, 2)); ?></span>
      <?php if($product->sale_price): ?>
        <span class="price-original">₨<?php echo e(number_format($product->price, 2)); ?></span>
      <?php endif; ?>
    </div>

    <!-- Mobile Always-Visible Action Buttons -->
    <div class="product-card-mobile-actions d-sm-none mt-3">
      <button class="product-action-btn w-100" onclick="addToCart(<?php echo e($product->id); ?>, 1)">
        <i class="bi bi-bag-plus me-1"></i> Add to Cart
      </button>
      <?php if(auth()->guard()->check()): ?>
      <button class="product-action-btn wishlist-btn <?php echo e(auth()->user()->wishlists()->where('product_id', $product->id)->exists() ? 'active' : ''); ?>"
        onclick="toggleWishlist(<?php echo e($product->id); ?>, this)" title="Wishlist">
        <i class="bi <?php echo e(auth()->user()->wishlists()->where('product_id', $product->id)->exists() ? 'bi-heart-fill' : 'bi-heart'); ?>"></i>
      </button>
      <?php else: ?>
      <a href="<?php echo e(route('login')); ?>" class="product-action-btn wishlist-btn" title="Wishlist">
        <i class="bi bi-heart"></i>
      </a>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp8.2\htdocs\durableattachi\resources\views/frontend/partials/product-card.blade.php ENDPATH**/ ?>