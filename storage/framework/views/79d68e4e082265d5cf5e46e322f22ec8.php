<?php
  $isRecentlyViewed = in_array($product->id, session()->get('recently_viewed_products', []));
?>
<div class="product-card uppercase-card <?php echo e($isRecentlyViewed ? 'is-recently-viewed' : ''); ?>" data-product-id="<?php echo e($product->id); ?>">
  <!-- Card Image Container -->
  <div class="product-card-img <?php echo e($product->secondary_image_url ? 'has-hover-image' : ''); ?>">
    <a href="<?php echo e(route('product.show', $product->slug)); ?>">
      <img src="<?php echo e($product->thumbnail_url); ?>" alt="<?php echo e($product->name); ?>" class="product-img-primary" loading="lazy" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1565026057447-bc90a3dceb87?w=700&q=80&fit=crop';">
      <?php if($product->secondary_image_url): ?>
        <img src="<?php echo e($product->secondary_image_url); ?>" alt="<?php echo e($product->name); ?> alternate" class="product-img-secondary" loading="lazy">
      <?php endif; ?>
    </a>

    <!-- Wishlist Top-Right -->
    <div class="product-card-wish-top">
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
    <div class="card-meta-slot">
      <?php if($isRecentlyViewed): ?>
        <div class="recently-viewed-pill" title="You recently viewed this item">
          <i class="fa-solid fa-eye me-1"></i> Recently Viewed
        </div>
      <?php endif; ?>
    </div>

    <!-- Product Title -->
    <a href="<?php echo e(route('product.show', $product->slug)); ?>" class="text-decoration-none">
      <h3 class="product-card-name" title="<?php echo e($product->name); ?>"><?php echo e($product->name); ?></h3>
    </a>

    <!-- Color Swatches Row (Above reviews & stars) -->
    <div class="card-color-swatches mb-1 mt-1">
      <?php if($product->color): ?>
        <span class="card-color-bubble active" style="background:<?php echo e($product->color->code ?: '#4a5568'); ?>;" title="<?php echo e($product->color->name); ?>"></span>
      <?php else: ?>
        <span class="card-color-bubble active" style="background:#8c9096;"></span>
      <?php endif; ?>
    </div>

    <!-- Stars & Reviews -->
    <div class="card-rating-line mb-1">
      <span class="stars-gold">★★★★★</span>
      <span class="rating-val">4.9</span>
      <span class="reviews-count">(<?php echo e($product->approvedReviews->count() > 0 ? $product->approvedReviews->count() : 83); ?> Reviews)</span>
    </div>

    <!-- Pricing Row with Discount Badge -->
    <div class="product-card-price">
      <span class="price-current">₹<?php echo e(number_format($product->current_price, 0)); ?></span>
      <?php if($product->sale_price && $product->price > $product->sale_price): ?>
        <span class="price-original">₹<?php echo e(number_format($product->price, 0)); ?></span>
        <span class="badge-discount-red">-<?php echo e($product->discount_percentage); ?>%</span>
      <?php elseif($product->price > $product->current_price): ?>
        <span class="price-original">₹<?php echo e(number_format($product->price, 0)); ?></span>
        <span class="badge-discount-red">-15%</span>
      <?php endif; ?>
    </div>

    <!-- Green Full-Width Add To Cart Button -->
    <div class="product-card-bottom-actions mt-2">
      <button class="btn-green-add-cart w-100" onclick="addToCart(<?php echo e($product->id); ?>, 1)" title="Add to Cart">
        Add to cart
      </button>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp8.2\htdocs\durableattachi\resources\views/frontend/partials/product-card.blade.php ENDPATH**/ ?>