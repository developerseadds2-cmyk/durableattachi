<div class="product-card">
  <div class="product-card-img">
    <a href="{{ route('product.show', $product->slug) }}">
      <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" loading="lazy" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1565026057447-bc90a3dceb87?w=700&q=80&fit=crop';">
    </a>

    <!-- Badges -->
    <div class="product-card-badges">
      @if($product->is_new_arrival) <span class="product-badge badge-new">New</span> @endif
      @if($product->discount_percentage) <span class="product-badge badge-sale">-{{ $product->discount_percentage }}%</span> @endif
      @if($product->is_best_seller) <span class="product-badge badge-best">Best</span> @endif
    </div>

    <!-- Quick Actions -->
    <div class="product-card-actions">
      <button class="product-action-btn" onclick="addToCart({{ $product->id }}, 1)" title="Add to Cart">
        <i class="bi bi-bag-plus"></i> Add to Cart
      </button>
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
    <div class="product-card-cat">{{ $product->category?->name }}</div>
    <a href="{{ route('product.show', $product->slug) }}">
      <h3 class="product-card-name">{{ $product->name }}</h3>
    </a>

    <!-- Stars -->
    @if($product->average_rating > 0)
    <div class="mb-1">
      <span class="stars">
        @for($i=1; $i<=5; $i++){{ $i <= $product->average_rating ? '★' : '☆' }}@endfor
      </span>
      <span class="stars-count">({{ $product->approvedReviews->count() }})</span>
    </div>
    @endif

    <div class="product-card-price">
      <span class="price-current">₨{{ number_format($product->current_price, 2) }}</span>
      @if($product->sale_price)
        <span class="price-original">₨{{ number_format($product->price, 2) }}</span>
      @endif
    </div>

    <!-- Mobile Always-Visible Action Buttons -->
    <div class="product-card-mobile-actions d-sm-none mt-3">
      <button class="product-action-btn w-100" onclick="addToCart({{ $product->id }}, 1)">
        <i class="bi bi-bag-plus me-1"></i> Add to Cart
      </button>
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
</div>
