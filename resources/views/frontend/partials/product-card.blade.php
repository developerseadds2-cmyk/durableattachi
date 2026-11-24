<div class="product-card">
  <div class="product-card-img {{ $product->secondary_image_url ? 'has-hover-image' : '' }}">
    <a href="{{ route('product.show', $product->slug) }}">
      <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" class="product-img-primary" loading="lazy" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1565026057447-bc90a3dceb87?w=700&q=80&fit=crop';">
      @if($product->secondary_image_url)
        <img src="{{ $product->secondary_image_url }}" alt="{{ $product->name }} alternate" class="product-img-secondary" loading="lazy">
      @endif
    </a>

    <!-- Badges -->
    <div class="product-card-badges">
      @if($product->is_new_arrival) <span class="product-badge badge-new">New</span> @endif
      @if($product->discount_percentage) <span class="product-badge badge-sale">-{{ $product->discount_percentage }}%</span> @endif
      @if($product->is_best_seller) <span class="product-badge badge-best">Best</span> @endif
    </div>

    <!-- Quick Wishlist Top-Right -->
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
    <!-- Category -->
    <div class="product-card-cat">{{ $product->category?->name }}</div>

    <!-- 1. First: Product Name (Single line with ellipsis) -->
    <a href="{{ route('product.show', $product->slug) }}" title="{{ $product->name }}">
      <h3 class="product-card-name text-truncate" title="{{ $product->name }}">{{ $product->name }}</h3>
    </a>

    <!-- Stars (if rated) -->
    @if($product->average_rating > 0)
    <div class="mb-1">
      <span class="stars">
        @for($i=1; $i<=5; $i++){{ $i <= $product->average_rating ? '★' : '☆' }}@endfor
      </span>
      <span class="stars-count">({{ $product->approvedReviews->count() }})</span>
    </div>
    @endif

    <!-- 2. Second: Price -->
    <div class="product-card-price">
      <span class="price-current">₨{{ number_format($product->current_price, 2) }}</span>
      @if($product->sale_price)
        <span class="price-original">₨{{ number_format($product->price, 2) }}</span>
      @endif
    </div>

    <!-- 3. Third: Always Visible Add To Cart Button -->
    <div class="product-card-bottom-actions mt-3">
      <button class="product-action-btn w-100" onclick="addToCart({{ $product->id }}, 1)" title="Add to Cart">
        <i class="bi bi-bag-plus me-1"></i> Add to Cart
      </button>
    </div>
  </div>
</div>
