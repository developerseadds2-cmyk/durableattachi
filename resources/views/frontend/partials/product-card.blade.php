@php
  $isRecentlyViewed = in_array($product->id, session()->get('recently_viewed_products', []));
@endphp
<div class="product-card uppercase-card {{ $isRecentlyViewed ? 'is-recently-viewed' : '' }}" data-product-id="{{ $product->id }}">
  <!-- Card Image Container -->
  <div class="product-card-img {{ $product->secondary_image_url ? 'has-hover-image' : '' }}">
    <a href="{{ route('product.show', $product->slug) }}">
      <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" class="product-img-primary" loading="lazy" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1565026057447-bc90a3dceb87?w=700&q=80&fit=crop';">
      @if($product->secondary_image_url)
        <img src="{{ $product->secondary_image_url }}" alt="{{ $product->name }} alternate" class="product-img-secondary" loading="lazy">
      @endif
    </a>

    <!-- Wishlist Top-Right -->
    <div class="product-card-wish-top">
      @auth
      <button class="product-action-btn wishlist-btn {{ auth()->user()->wishlists()->where('product_id', $product->id)->exists() ? 'active' : '' }}"
        onclick="toggleWishlist({{ $product->id }}, this)" title="Wishlist">
        <i class="bi {{ auth()->user()->wishlists()->where('product_id', $product->id)->exists() ? 'bi-heart-fill' : 'bi-heart' }}"></i>
      </button>
      @else
      <a href="{{ route('login') }}" class="product-action-btn wishlist-btn" title="Wishlist">
        <i class="bi bi-heart"></i>
      </a>
      @endauth
    </div>
  </div>

  <div class="product-card-body">
    <div class="card-meta-slot">
      @if($isRecentlyViewed)
        <div class="recently-viewed-pill" title="You recently viewed this item">
          <i class="fa-solid fa-eye me-1"></i> Recently Viewed
        </div>
      @endif
    </div>

    <!-- Product Title -->
    <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none">
      <h3 class="product-card-name" title="{{ $product->name }}">{{ $product->name }}</h3>
    </a>

    <!-- Color Swatches Row (Above reviews & stars) -->
    <div class="card-color-swatches mb-1 mt-1">
      @if($product->color)
        <span class="card-color-bubble active" style="background:{{ $product->color->code ?: '#4a5568' }};" title="{{ $product->color->name }}"></span>
      @else
        <span class="card-color-bubble active" style="background:#8c9096;"></span>
      @endif
    </div>

    <!-- Stars & Reviews -->
    <div class="card-rating-line mb-1">
      <span class="stars-gold">★★★★★</span>
      <span class="rating-val">4.9</span>
      <span class="reviews-count">({{ $product->approvedReviews->count() > 0 ? $product->approvedReviews->count() : 83 }} Reviews)</span>
    </div>

    <!-- Pricing Row with Discount Badge -->
    <div class="product-card-price">
      <span class="price-current">₹{{ number_format($product->current_price, 0) }}</span>
      @if($product->sale_price && $product->price > $product->sale_price)
        <span class="price-original">₹{{ number_format($product->price, 0) }}</span>
        <span class="badge-discount-red">-{{ $product->discount_percentage }}%</span>
      @elseif($product->price > $product->current_price)
        <span class="price-original">₹{{ number_format($product->price, 0) }}</span>
        <span class="badge-discount-red">-15%</span>
      @endif
    </div>

    <!-- Green Full-Width Add To Cart Button -->
    <div class="product-card-bottom-actions mt-2">
      <button class="btn-green-add-cart w-100" onclick="addToCart({{ $product->id }}, 1)" title="Add to Cart">
        Add to cart
      </button>
    </div>
  </div>
</div>
