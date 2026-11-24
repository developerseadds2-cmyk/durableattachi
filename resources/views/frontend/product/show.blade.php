@extends('frontend.layouts.app')
@section('title', $product->name . ' — Durable Suitcase House Since 1960')
@section('meta_description', $product->meta_description ?? $product->short_description)

@push('styles')
<style>
.product-gallery { position: sticky; top: 90px; }
.main-image { 
  aspect-ratio: 1; 
  overflow: hidden; 
  background: #ffffff; 
  border-radius: var(--border-radius, 12px);
  box-shadow: var(--shadow-sm);
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #ebebeb;
  padding: 15px;
}
.main-image img { width: 100%; height: 100%; object-fit: contain; transition: transform 0.4s ease; }
.main-image:hover img { transform: scale(1.04); }
.thumb-gallery { 
  display: grid; 
  grid-template-columns: repeat(4, 1fr); 
  gap: 10px; 
  margin-top: 12px; 
}
.thumb-item { 
  aspect-ratio: 1; 
  overflow: hidden; 
  cursor: pointer; 
  border: 2px solid #ebebeb; 
  border-radius: 8px;
  background: #ffffff;
  transition: all 0.2s ease; 
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 4px;
}
.thumb-item.active, .thumb-item:hover { 
  border-color: var(--dsh-navy, #163624); 
  transform: translateY(-2px);
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}
.thumb-item img { width: 100%; height: 100%; object-fit: contain; }
.product-title { 
  font-family: var(--font-serif); 
  font-size: 2rem; 
  font-weight: 500; 
  color: var(--dark); 
  line-height: 1.25; 
}
.product-price { font-size: 1.75rem; font-weight: 700; color: var(--dsh-navy, #163624); }
.product-price-old { font-size: 1.05rem; color: var(--text-muted); text-decoration: line-through; }
.product-badge-save { 
  background: #c2410c; 
  color: #fff; 
  font-size: 0.75rem; 
  padding: 4px 10px; 
  font-weight: 700; 
  border-radius: 999px;
  letter-spacing: 0.3px;
}
.qty-group {
  display: inline-flex;
  align-items: stretch;
  border: 1px solid var(--border);
  border-radius: 8px;
  overflow: hidden;
  background: #fff;
}
.qty-input { 
  width: 50px; 
  border: none; 
  padding: 10px 4px; 
  text-align: center; 
  font-size: 1rem; 
  font-weight: 600;
  -moz-appearance: textfield;
}
.qty-input::-webkit-outer-spin-button,
.qty-input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
.qty-btn { 
  border: none; 
  background: #f8fafc; 
  padding: 10px 16px; 
  cursor: pointer; 
  font-size: 1.1rem; 
  font-weight: 600;
  color: var(--dark);
  transition: all 0.2s; 
}
.qty-btn:hover { background: var(--dsh-navy, #163624); color: #fff; }
.attr-option { display: none; }
.attr-label {
  padding: 8px 16px;
  border: 1.5px solid var(--border);
  border-radius: 8px;
  cursor: pointer;
  font-size: 0.85rem;
  transition: all 0.2s;
  font-weight: 600;
  background: #fff;
}
.attr-option:checked + .attr-label { 
  border-color: var(--dsh-navy, #163624); 
  background: var(--dsh-navy, #163624); 
  color: #fff; 
}
.product-meta-row { display: flex; align-items: baseline; gap: 8px; margin-bottom: 8px; font-size: 0.9rem; }
.product-meta-label { font-weight: 600; min-width: 105px; color: var(--text-muted); }
.review-card { padding: 18px 0; border-bottom: 1px solid var(--border); }
.review-card:last-child { border-bottom: none; }

.guarantee-box {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 12px;
}
.guarantee-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  text-align: center;
  padding: 12px 6px;
  background: #fff;
  border: 1px solid rgba(0,0,0,0.05);
  border-radius: 8px;
}

/* Mobile Sticky Action Bar at the bottom */
.product-mobile-bar {
  display: none;
}

@media (max-width: 991px) {
  .product-gallery { position: static; margin-bottom: 24px; }
}

@media (max-width: 767px) {
  .product-title { font-size: 1.45rem; line-height: 1.3; }
  .product-price { font-size: 1.4rem; }
  .guarantee-box { grid-template-columns: repeat(2, 1fr); gap: 10px; }
  
  /* Scrollable thumbnails row on mobile phones */
  .thumb-gallery {
    display: flex;
    overflow-x: auto;
    gap: 8px;
    padding-bottom: 6px;
    scrollbar-width: thin;
  }
  .thumb-item {
    flex: 0 0 70px;
    width: 70px;
    height: 70px;
  }

  /* Make actions side-by-side in one line on mobile phones */
  .add-to-cart-wrapper {
    display: block;
    margin-bottom: 20px;
  }
  .add-to-cart-wrapper .d-flex {
    flex-direction: row !important;
    align-items: stretch !important;
    gap: 10px !important;
  }
  .qty-group {
    width: auto !important;
    flex: 0 0 115px !important;
    display: inline-flex;
    justify-content: space-between;
  }
  .qty-btn {
    padding: 10px 14px !important;
    flex: 0 0 auto;
  }
  .qty-input {
    width: 38px !important;
    flex: 1;
    padding: 8px 2px !important;
  }
  .add-to-cart-wrapper .btn-glamora {
    flex: 1 1 auto !important;
    padding: 12px 14px !important;
    font-size: 0.85rem !important;
    white-space: nowrap !important;
  }

  /* Sticky buy button at the bottom of the mobile viewport, above bottom nav */
  .product-mobile-bar {
    display: flex;
    position: fixed;
    bottom: 60px; /* Above .mobile-bottom-nav */
    left: 0;
    right: 0;
    z-index: 1030;
    background: #ffffff;
    padding: 10px 16px;
    box-shadow: 0 -4px 18px rgba(0,0,0,0.1);
    border-top: 1px solid rgba(0,0,0,0.08);
    align-items: center;
    justify-content: space-between;
    gap: 12px;
  }
  .product-mobile-bar .price-col {
    display: flex;
    flex-direction: column;
    min-width: 0;
  }
  .product-mobile-bar .price-now {
    font-size: 1.15rem;
    font-weight: 800;
    color: var(--dsh-navy, #163624);
    line-height: 1.1;
  }
  .product-mobile-bar .price-sub {
    font-size: 0.72rem;
    color: var(--text-muted);
  }
  .product-mobile-bar .btn-mobile-buy {
    background: var(--dsh-navy, #163624);
    color: #fff;
    font-weight: 700;
    font-size: 0.88rem;
    padding: 11px 20px;
    border-radius: 8px;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    white-space: nowrap;
    box-shadow: 0 4px 12px rgba(22, 54, 36, 0.25);
  }
  
  /* Extra bottom padding on mobile container so content isn't covered by sticky bars */
  .product-page-container {
    padding-bottom: 90px !important;
  }
}
</style>
@endpush

@section('content')
<!-- Breadcrumb -->
<div style="background:var(--pd-ice); padding:16px 0;">
  <div class="container-xl-custom">
    <ol class="breadcrumb small text-muted mb-0" style="background:none; padding:0;">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Shop</a></li>
      @if($product->category)
        <li class="breadcrumb-item"><a href="{{ route('shop.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
      @endif
      <li class="breadcrumb-item active">{{ Str::limit($product->name, 40) }}</li>
    </ol>
  </div>
</div>

<div class="container-xl-custom py-4 py-md-5 product-page-container">
  <div class="row g-4 g-lg-5">
    <!-- Gallery -->
    <div class="col-lg-6">
      <div class="product-gallery">
        <div class="main-image" id="mainImage">
          <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" id="mainImg">
        </div>
        @if($product->images->count() > 0)
        <div class="thumb-gallery">
          <div class="thumb-item active" onclick="changeImage(this, '{{ $product->thumbnail_url }}')">
            <img src="{{ $product->thumbnail_url }}" alt="">
          </div>
          @foreach($product->images as $img)
          <div class="thumb-item" onclick="changeImage(this, '{{ $img->url }}')">
            <img src="{{ $img->url }}" alt="{{ $img->alt_text }}">
          </div>
          @endforeach
        </div>
        @endif
      </div>
    </div>

    <!-- Details -->
    <div class="col-lg-6">
      <!-- Category & SKU -->
      <div class="d-flex align-items-center justify-content-between mb-2 mb-md-3">
        <a href="{{ route('shop.category', $product->category->slug) }}" class="text-pd-blue small fw-600" style="letter-spacing:1.5px; text-transform:uppercase;">
          {{ $product->category?->name }}
        </a>
        @if($product->sku)<span class="text-muted small">SKU: {{ $product->sku }}</span>@endif
      </div>

      <h1 class="product-title mb-2 mb-md-3">{{ $product->name }}</h1>

      <!-- Stars -->
      @if($product->average_rating > 0)
      <div class="d-flex align-items-center gap-2 mb-3 mb-md-4">
        <div class="stars" style="font-size:0.9rem;">
          @for($i=1; $i<=5; $i++){{ $i <= $product->average_rating ? '★' : '☆' }}@endfor
        </div>
        <span class="small text-muted">({{ $product->approvedReviews->count() }} reviews)</span>
      </div>
      @endif

      <!-- Price -->
      <div class="d-flex align-items-baseline gap-2 gap-md-3 mb-3 mb-md-4 flex-wrap">
        <span class="product-price" id="currentPrice">₨{{ number_format($product->current_price, 2) }}</span>
        @if($product->sale_price)
          <span class="product-price-old">₨{{ number_format($product->price, 2) }}</span>
          <span class="product-badge-save">Save {{ $product->discount_percentage }}%</span>
        @endif
      </div>

      <!-- Short Desc -->
      @if($product->short_description)
        <p class="text-muted mb-4" style="line-height:1.6; font-size:0.95rem;">{{ $product->short_description }}</p>
      @endif

      <div class="divider-gold-left divider-gold mb-4"></div>

      <!-- Attributes -->
      @if($product->attributes->count() > 0)
        @php $attributeGroups = $product->attributes->groupBy('attribute_name'); @endphp
        @foreach($attributeGroups as $attrName => $options)
        <div class="mb-4">
          <label class="product-meta-label d-block mb-2">{{ $attrName }}</label>
          <div class="d-flex gap-2 flex-wrap">
            @foreach($options as $opt)
            <div>
              <input type="radio" name="attr_{{ Str::slug($attrName) }}" id="opt_{{ $opt->id }}" value="{{ $opt->attribute_value }}" class="attr-option" data-price="{{ $opt->price_adjustment }}">
              <label for="opt_{{ $opt->id }}" class="attr-label">{{ $opt->attribute_value }}</label>
            </div>
            @endforeach
          </div>
        </div>
        @endforeach
      @endif

      <!-- Quantity & Add to Cart -->
      <div class="add-to-cart-wrapper mb-4">
        <div class="d-flex gap-3 align-items-stretch flex-column flex-sm-row">
          <div class="qty-group">
            <button class="qty-btn" onclick="changeQty(-1)" type="button">−</button>
            <input type="number" id="qtyInput" class="qty-input" value="1" min="1" max="{{ $product->stock_quantity }}">
            <button class="qty-btn" onclick="changeQty(1)" type="button">+</button>
          </div>
          @if($product->isInStock())
            <button class="btn-glamora flex-grow-1 justify-content-center" onclick="handleAddToCart()" style="padding:14px; border-radius:8px; font-weight:700;">
              <i class="bi bi-bag-plus me-2"></i>Add to Cart
            </button>
          @else
            <button class="btn-glamora flex-grow-1 justify-content-center" disabled style="padding:14px; opacity:0.6; cursor:not-allowed; border-radius:8px;">
              Out of Stock
            </button>
          @endif
        </div>
      </div>

      <!-- Wishlist & Share -->
      <div class="d-flex gap-4 mb-4">
        @auth
        <button class="d-flex align-items-center gap-2 small fw-600 text-muted" style="background:none;border:none;cursor:pointer;padding:0;" onclick="toggleWishlist({{ $product->id }}, this)" id="wishBtn">
          <i class="bi {{ $isWishlisted ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
          {{ $isWishlisted ? 'Remove from Wishlist' : 'Add to Wishlist' }}
        </button>
        @else
        <a href="{{ route('login') }}" class="d-flex align-items-center gap-2 small fw-600 text-muted text-decoration-none">
          <i class="bi bi-heart"></i> Add to Wishlist
        </a>
        @endauth
        <button class="d-flex align-items-center gap-2 small fw-600 text-muted" style="background:none;border:none;cursor:pointer;padding:0;" onclick="navigator.share ? navigator.share({title: '{{ $product->name }}', url: window.location.href}) : null">
          <i class="bi bi-share"></i> Share
        </button>
      </div>

      <!-- Highlights Section -->
      <div class="border-top pt-3 mt-3">
        <h6 class="fw-bold mb-3" style="color:var(--dsh-navy, #142D4E); font-size: 1.05rem; letter-spacing: 0.5px;">
          <i class="bi bi-stars me-2 text-warning"></i>Highlights
        </h6>
        <div class="p-3 rounded-3 mb-3" style="background:#f9f9f6; border:1px solid #ebe9df;">
          @if($product->brand)
            <div class="product-meta-row py-1"><span class="product-meta-label fw-bold" style="color:#555;">Brand:</span> <span class="fw-600 text-dark">{{ $product->brand->name }}</span></div>
          @endif
          @if($product->color)
            <div class="product-meta-row py-1 d-flex align-items-center gap-2">
              <span class="product-meta-label fw-bold" style="color:#555;">Color:</span>
              <span class="d-inline-flex align-items-center gap-2 fw-600 text-dark">
                <span style="display:inline-block; width:16px; height:16px; border-radius:50%; background:{{ $product->color->code ?: '#C0C0C0' }}; border:1px solid #bbb;"></span>
                {{ $product->color->name }}
              </span>
            </div>
          @endif
          @if($product->short_description)
            <div class="product-meta-row py-1">
              <span class="product-meta-label fw-bold" style="color:#555;">Product Features:</span>
              <span class="text-dark">{{ $product->short_description }}</span>
            </div>
          @endif
          @if($product->warranty_details)
            <div class="product-meta-row py-1">
              <span class="product-meta-label fw-bold" style="color:#555;">Warranty Details:</span>
              <span class="text-success fw-600"><i class="bi bi-shield-check me-1"></i>{{ $product->warranty_details }}</span>
            </div>
          @endif
        </div>
      </div>

      <!-- Other Info Section -->
      <div class="border-top pt-3 mt-3">
        <h6 class="fw-bold mb-3" style="color:var(--dsh-navy, #142D4E); font-size: 1.05rem; letter-spacing: 0.5px;">
          <i class="bi bi-info-circle me-2 text-primary"></i>Other Info
        </h6>
        <div class="p-3 rounded-3 mb-3" style="background:#ffffff; border:1px solid #ebebeb;">
          @if($product->product_warranty)
            <div class="product-meta-row py-1"><span class="product-meta-label fw-bold" style="color:#555;">Product Warranty:</span> <span class="text-dark">{{ $product->product_warranty }}</span></div>
          @endif
          @if($product->manufacturer_details)
            <div class="product-meta-row py-1"><span class="product-meta-label fw-bold" style="color:#555;">Manufacturer Details:</span> <span class="text-dark">{{ $product->manufacturer_details }}</span></div>
          @endif
          @if($product->tax_rate)
            <div class="product-meta-row py-1"><span class="product-meta-label fw-bold" style="color:#555;">Tax Rate:</span> <span class="text-dark">{{ number_format($product->tax_rate, 2) }}%</span></div>
          @endif
          @if($product->hsn_code)
            <div class="product-meta-row py-1"><span class="product-meta-label fw-bold" style="color:#555;">HSN:</span> <span class="text-dark">{{ $product->hsn_code }}</span></div>
          @endif
          @if($product->material)
            <div class="product-meta-row py-1"><span class="product-meta-label fw-bold" style="color:#555;">Material:</span> <span class="text-dark">{{ $product->material }}</span></div>
          @endif
          @if($product->weight)
            <div class="product-meta-row py-1"><span class="product-meta-label fw-bold" style="color:#555;">Weight:</span> <span class="text-dark">{{ $product->weight }} kg</span></div>
          @endif
          <div class="product-meta-row py-1"><span class="product-meta-label fw-bold" style="color:#555;">Availability:</span>
            @if($product->isInStock())
              <span class="text-success fw-600">In Stock ({{ $product->stock_quantity }} available)</span>
            @else
              <span class="text-danger fw-600">Out of Stock</span>
            @endif
          </div>
        </div>
      </div>

      <!-- Guarantees Grid -->
      <div class="guarantee-box mt-4 pt-3 border-top">
        @foreach(['bi-shield-check' => 'Certified Genuine', 'bi-truck' => 'Free Shipping', 'bi-arrow-repeat' => '30-Day Returns', 'bi-lock' => 'Secure Payment'] as $icon => $text)
        <div class="guarantee-item">
          <i class="bi {{ $icon }}" style="font-size:1.35rem; color:var(--dsh-navy, #163624);"></i>
          <span style="font-size:0.75rem; font-weight:600; line-height:1.2;">{{ $text }}</span>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Tabs: Description, Reviews -->
  <div class="mt-5 pt-3">
    <ul class="nav border-bottom mb-4 d-flex" id="productTabs">
      <li class="nav-item">
        <button class="nav-link active px-0 me-4 fw-600" style="background:none;border:none;border-bottom:2px solid var(--dsh-navy, #163624);color:var(--dark);padding-bottom:12px;font-size:0.95rem;" data-tab="description">Description</button>
      </li>
      <li class="nav-item">
        <button class="nav-link px-0 me-4 text-muted" style="background:none;border:none;padding-bottom:12px;font-size:0.95rem;" data-tab="reviews">
          Reviews ({{ $product->approvedReviews->count() }})
        </button>
      </li>
    </ul>

    <!-- Description -->
    <div id="tab-description" class="tab-pane">
      @if($product->description)
        <div class="prose" style="max-width:850px; line-height:1.8; color:var(--text); font-size:0.95rem;">{!! $product->description !!}</div>
      @else
        <p class="text-muted">No detailed description available for this product.</p>
      @endif
    </div>

    <!-- Reviews -->
    <div id="tab-reviews" class="tab-pane" style="display:none;">
      <div class="row g-4 g-md-5">
        <div class="col-md-4">
          <div class="text-center p-4 bg-cream" style="border-radius:12px;">
            <div style="font-size:3.5rem; font-family:var(--font-serif); font-weight:500; color:var(--dark); line-height:1;">{{ number_format($product->average_rating, 1) }}</div>
            <div class="stars my-2" style="font-size:1.25rem;">
              @for($i=1; $i<=5; $i++){{ $i <= round($product->average_rating) ? '★' : '☆' }}@endfor
            </div>
            <div class="text-muted small">{{ $product->approvedReviews->count() }} reviews</div>
          </div>
        </div>
        <div class="col-md-8">
          @forelse($product->approvedReviews->take(5) as $review)
          <div class="review-card">
            <div class="d-flex justify-content-between mb-1">
              <strong class="small">{{ $review->user->name }}</strong>
              <span class="text-muted small">{{ $review->created_at->format('d M Y') }}</span>
            </div>
            <div class="stars small mb-1">@for($i=1;$i<=5;$i++){{ $i<=$review->rating?'★':'☆' }}@endfor</div>
            @if($review->title)<div class="fw-600 small mb-1">{{ $review->title }}</div>@endif
            <p class="text-muted small mb-0">{{ $review->body }}</p>
          </div>
          @empty
          <p class="text-muted">No reviews yet. Be the first to review this product!</p>
          @endforelse

          <!-- Write Review Form -->
          @auth
          <div class="mt-4 p-4" style="background:var(--pd-ice); border-radius:12px;">
            <h6 style="font-family:var(--font-serif); font-size:1.1rem;">Write a Review</h6>
            <form method="POST" action="{{ route('product.review', $product->id) }}">
              @csrf
              <div class="mb-3">
                <label class="form-label small fw-600">Rating</label>
                <div class="d-flex gap-1" id="ratingStars">
                  @for($i=1; $i<=5; $i++)
                    <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}" style="display:none;">
                    <label for="star{{ $i }}" class="star-label" style="cursor:pointer; font-size:1.8rem; color:#ddd; transition:color 0.1s;">★</label>
                  @endfor
                </div>
              </div>
              <div class="mb-3">
                <input type="text" name="title" class="form-control" placeholder="Review title (optional)" style="border-radius:6px;">
              </div>
              <div class="mb-3">
                <textarea name="body" class="form-control" rows="3" placeholder="Share your experience..." required style="border-radius:6px;"></textarea>
              </div>
              <button type="submit" class="btn-glamora" style="padding:10px 24px; font-size:0.85rem; border-radius:6px;">Submit Review</button>
            </form>
          </div>
          @else
          <div class="p-4 bg-cream text-center mt-4" style="border-radius:12px;">
            <p class="mb-2 text-muted">Please log in to write a review</p>
            <a href="{{ route('login') }}" class="btn-gold" style="padding:10px 24px; font-size:0.85rem; border-radius:6px;">Login</a>
          </div>
          @endauth
        </div>
      </div>
    </div>
  </div>

  <!-- Related Products -->
  @if($related->count() > 0)
  <div class="mt-5 pt-4 border-top">
    <div class="section-header text-start mb-4">
      <span class="section-label">You May Also Like</span>
      <h2 class="section-title" style="font-size:1.6rem;">Related Products</h2>
    </div>
    <div class="row g-3 g-md-4">
      @foreach($related as $rp)
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">@include('frontend.partials.product-card', ['product' => $rp])</div>
      @endforeach
    </div>
  </div>
  @endif
</div>

<!-- Mobile Fixed Bottom Action Bar -->
<div class="product-mobile-bar d-md-none">
  <div class="price-col">
    <span class="price-now">₨{{ number_format($product->current_price, 2) }}</span>
    @if($product->isInStock())
      <span class="price-sub text-success">● In Stock</span>
    @else
      <span class="price-sub text-danger">● Out of Stock</span>
    @endif
  </div>
  <div>
    @if($product->isInStock())
      <button class="btn-mobile-buy" onclick="handleAddToCart()">
        <i class="bi bi-bag-plus"></i> Add to Cart
      </button>
    @else
      <button class="btn-mobile-buy" disabled style="opacity:0.6; cursor:not-allowed;">
        Out of Stock
      </button>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<script>
function changeImage(el, src) {
  document.getElementById('mainImg').src = src;
  document.querySelectorAll('.thumb-item').forEach(t => t.classList.remove('active'));
  el.classList.add('active');
}

function changeQty(dir) {
  const inp = document.getElementById('qtyInput');
  let val = parseInt(inp.value) + dir;
  inp.value = Math.max(1, Math.min(val, {{ $product->stock_quantity }}));
}

function handleAddToCart() {
  const qty   = parseInt(document.getElementById('qtyInput').value);
  const attrs = {};
  document.querySelectorAll('[name^="attr_"]:checked').forEach(inp => {
    attrs[inp.name.replace('attr_', '')] = inp.value;
  });
  addToCart({{ $product->id }}, qty, attrs);
}

// Star rating interactivity
document.querySelectorAll('.star-label').forEach((label, idx) => {
  label.addEventListener('mouseover', () => {
    document.querySelectorAll('.star-label').forEach((l, i) => l.style.color = i <= idx ? '#0077CC' : '#ddd');
  });
  label.addEventListener('mouseout', () => {
    const checked = document.querySelector('input[name="rating"]:checked');
    if (checked) {
      const val = parseInt(checked.value);
      document.querySelectorAll('.star-label').forEach((l, i) => l.style.color = i < val ? '#0077CC' : '#ddd');
    } else {
      document.querySelectorAll('.star-label').forEach(l => l.style.color = '#ddd');
    }
  });
  label.addEventListener('click', () => {
    document.querySelectorAll('.star-label').forEach((l, i) => l.style.color = i <= idx ? '#0077CC' : '#ddd');
  });
});

// Tab switching
document.querySelectorAll('[data-tab]').forEach(btn => {
  btn.addEventListener('click', function() {
    document.querySelectorAll('[data-tab]').forEach(b => {
      b.style.borderBottom = '2px solid transparent';
      b.style.color = '#888';
    });
    this.style.borderBottom = '2px solid var(--dark)';
    this.style.color = 'var(--dark)';
    document.querySelectorAll('.tab-pane').forEach(p => p.style.display = 'none');
    document.getElementById('tab-' + this.dataset.tab).style.display = 'block';
  });
});
</script>
@endpush

