@extends('frontend.layouts.app')
@section('title', $product->name . ' — Durable Suitcase House Since 1960')
@section('meta_description', $product->meta_description ?? $product->short_description)

@push('styles')
<style>
/* Match Reference Page Width and Container */
.product-detail-page {
  width: 100%;
  max-width: 100vw;
  padding: 0 32px 60px 32px;
  background: #ffffff;
  overflow-x: clip;
  box-sizing: border-box;
}
@media (max-width: 1200px) {
  .product-detail-page { padding: 0 20px 40px 20px; }
}
@media (max-width: 992px) {
  .product-detail-page { padding: 0 16px 30px 16px; }
}
@media (max-width: 576px) {
  .product-detail-page { padding: 0 12px 24px 12px; }
}

.product-detail-page .row {
  margin-left: 0 !important;
  margin-right: 0 !important;
}

/* Breadcrumb Bar */
.detail-breadcrumb-bar {
  background: #ffffff;
  padding: 14px 32px;
  border-bottom: 1px solid #f0f0f0;
  width: 100%;
  max-width: 100vw;
  overflow-x: clip;
  box-sizing: border-box;
}
@media (max-width: 1200px) { .detail-breadcrumb-bar { padding: 12px 20px; } }
@media (max-width: 992px) { .detail-breadcrumb-bar { padding: 10px 16px; } }
@media (max-width: 576px) { .detail-breadcrumb-bar { padding: 10px 12px; } }

.detail-breadcrumb-bar ol {
  background: none;
  padding: 0;
  margin: 0;
  font-size: 0.85rem;
  flex-wrap: wrap;
  white-space: normal;
  word-break: break-word;
}
.detail-breadcrumb-bar .breadcrumb-item {
  display: inline-flex;
  align-items: center;
  max-width: 100%;
}
.detail-breadcrumb-bar .breadcrumb-item.active {
  word-break: break-word;
}
.detail-breadcrumb-bar a {
  color: #666;
  text-decoration: none;
}
.detail-breadcrumb-bar a:hover {
  color: var(--dsh-navy, #142D4E);
}

/* Image Showcase Column */
.product-gallery-wrap {
  position: relative;
}
.product-main-card {
  position: relative;
  background: #ffffff;
  border: 1px solid #eef0f2;
  border-radius: 12px;
  height: 480px;
  max-width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 24px;
  overflow: hidden;
  box-sizing: border-box;
}
@media (max-width: 576px) {
  .product-main-card {
    height: 380px;
    padding: 16px;
  }
}
.product-main-card img {
  max-height: 100%;
  max-width: 100%;
  object-fit: contain;
  transition: transform 0.3s ease;
}
.product-main-card:hover img {
  transform: scale(1.03);
}

/* VIP Authorized Ribbon */
.authorized-ribbon {
  position: absolute;
  top: 16px;
  left: 16px;
  background: #142D4E;
  color: #fff;
  border-radius: 6px;
  padding: 6px 14px;
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 0.5px;
  display: flex;
  align-items: center;
  gap: 6px;
  box-shadow: 0 4px 10px rgba(20,45,78,0.2);
  z-index: 5;
}
.authorized-ribbon i {
  color: #C59A55;
  font-size: 0.95rem;
}

/* Heart Wishlist floating button on top right of image */
.btn-floating-wishlist {
  position: absolute;
  top: 16px;
  right: 16px;
  width: 38px;
  height: 38px;
  border-radius: 50%;
  background: #ffffff;
  border: 1px solid #e2e8f0;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #64748b;
  box-shadow: 0 2px 8px rgba(0,0,0,0.06);
  cursor: pointer;
  transition: all 0.2s;
  z-index: 5;
}
.btn-floating-wishlist:hover {
  color: #ef4444;
  border-color: #fca5a5;
  transform: scale(1.08);
}

/* Arrow Navigation on Main Image */
.gallery-arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.95);
  border: 1px solid #e2e8f0;
  color: #334155;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  transition: all 0.2s;
  z-index: 4;
}
.gallery-arrow:hover {
  background: #ffffff;
  color: var(--dsh-navy, #142D4E);
  box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}
.gallery-arrow-prev { left: 12px; }
.gallery-arrow-next { right: 12px; }

/* Thumbnails Strip */
.detail-thumb-strip {
  display: flex;
  gap: 10px;
  margin-top: 14px;
  overflow-x: auto;
  padding-bottom: 4px;
}
.detail-thumb-box {
  width: 68px;
  height: 68px;
  border-radius: 8px;
  border: 2px solid #e2e8f0;
  background: #fff;
  padding: 4px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  flex-shrink: 0;
  transition: all 0.2s;
}
.detail-thumb-box.active, .detail-thumb-box:hover {
  border-color: #142D4E;
  box-shadow: 0 2px 6px rgba(20,45,78,0.12);
}
.detail-thumb-box img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

/* Right Content Column */
.product-cat-tag {
  color: #8c9096;
  font-size: 0.8rem;
  letter-spacing: 1.5px;
  font-weight: 700;
  text-transform: uppercase;
}
.product-headline {
  font-size: 1.65rem;
  font-weight: 700;
  color: #1a1a1a;
  line-height: 1.25;
  margin-top: 4px;
  margin-bottom: 8px;
}

/* Rating line */
.rating-bar {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.85rem;
  margin-bottom: 14px;
}
.rating-stars {
  color: #f59e0b;
  font-size: 0.95rem;
  letter-spacing: 1px;
}
.rating-text {
  color: #475569;
  font-weight: 600;
}
.write-review-link {
  color: #475569;
  text-decoration: underline;
  cursor: pointer;
}

/* Pricing line */
.pricing-row {
  display: flex;
  align-items: baseline;
  gap: 10px;
  flex-wrap: wrap;
}
.price-main {
  font-size: 1.85rem;
  font-weight: 800;
  color: #142D4E;
}
.price-cut {
  font-size: 1.05rem;
  color: #94a3b8;
  text-decoration: line-through;
}
.badge-discount-tag {
  background: #fef3c7;
  color: #b45309;
  border: 1px solid #fde68a;
  font-size: 0.75rem;
  font-weight: 700;
  padding: 3px 8px;
  border-radius: 4px;
}
.tax-note {
  font-size: 0.78rem;
  color: #94a3b8;
  margin-bottom: 16px;
}

/* Color Choices */
.color-swatch-list {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: 6px;
  margin-bottom: 16px;
}
.color-bubble {
  width: 26px;
  height: 26px;
  border-radius: 50%;
  cursor: pointer;
  border: 2px solid #ffffff;
  box-shadow: 0 0 0 1px #cbd5e1;
  transition: all 0.2s;
  display: inline-block;
}
.color-bubble.active {
  box-shadow: 0 0 0 2px #142D4E;
  transform: scale(1.15);
}

/* Size Pill Selectors */
.size-pill-list {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: 6px;
  margin-bottom: 22px;
  flex-wrap: wrap;
}
.size-pill {
  padding: 7px 18px;
  border: 1.5px solid #e2e8f0;
  border-radius: 8px;
  font-size: 0.85rem;
  font-weight: 600;
  color: #334155;
  background: #ffffff;
  cursor: pointer;
  transition: all 0.2s;
}
.size-pill.active {
  border-color: #C59A55;
  color: #8c6628;
  background: #fffdf9;
  box-shadow: 0 2px 6px rgba(197,154,85,0.15);
}

/* Action Controls (Qty + Add to Cart + Wishlist + Share) */
.action-strip {
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
  margin-bottom: 24px;
}
.qty-stepper {
  display: inline-flex;
  align-items: center;
  border: 1px solid #cbd5e1;
  border-radius: 6px;
  overflow: hidden;
  height: 44px;
  background: #ffffff;
}
.qty-stepper button {
  width: 38px;
  height: 100%;
  border: none;
  background: #f8fafc;
  font-size: 1.1rem;
  color: #475569;
  cursor: pointer;
  transition: background 0.2s;
}
.qty-stepper button:hover {
  background: #e2e8f0;
}
.qty-stepper input {
  width: 44px;
  height: 100%;
  border: none;
  text-align: center;
  font-weight: 700;
  font-size: 0.95rem;
  color: #1e293b;
  -moz-appearance: textfield;
}
.qty-stepper input::-webkit-outer-spin-button,
.qty-stepper input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.btn-add-cart-navy {
  background: #142D4E;
  color: #ffffff;
  border: none;
  border-radius: 6px;
  height: 44px;
  padding: 0 28px;
  font-weight: 700;
  font-size: 0.95rem;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
  transition: all 0.2s;
  box-shadow: 0 4px 12px rgba(20,45,78,0.22);
}
.btn-add-cart-navy:hover {
  background: #0f233d;
  color: #ffffff;
  transform: translateY(-1px);
}

.btn-action-outline {
  height: 44px;
  padding: 0 18px;
  border: 1.5px solid #cbd5e1;
  border-radius: 6px;
  background: #ffffff;
  color: #334155;
  font-weight: 600;
  font-size: 0.88rem;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  cursor: pointer;
  transition: all 0.2s;
  text-decoration: none;
}
.btn-action-outline:hover {
  border-color: #142D4E;
  color: #142D4E;
}
.btn-action-outline.square {
  padding: 0;
  width: 44px;
  justify-content: center;
}

/* Sticky Add to Cart Floating Bar */
.sticky-add-cart-bar {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background: #ffffff;
  border-top: 1px solid #e2e8f0;
  box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.1);
  padding: 12px 20px;
  z-index: 1030;
  transform: translateY(115%);
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  display: flex;
  align-items: center;
  justify-content: center;
}
.sticky-add-cart-bar.visible {
  transform: translateY(0) !important;
}
.sticky-cart-container {
  width: 100%;
  max-width: 1280px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 16px;
}
.sticky-prod-info {
  display: flex;
  align-items: center;
  gap: 14px;
  min-width: 0;
}
.sticky-prod-img {
  width: 48px;
  height: 48px;
  border-radius: 8px;
  object-fit: cover;
  border: 1px solid #e2e8f0;
  background: #f8fafc;
  flex-shrink: 0;
}
.sticky-prod-details {
  min-width: 0;
}
.sticky-prod-title {
  font-size: 0.95rem;
  font-weight: 700;
  color: #1e293b;
  margin: 0;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.sticky-prod-price {
  font-size: 1.1rem;
  font-weight: 800;
  color: #142D4E;
  margin: 0;
  display: flex;
  align-items: baseline;
  gap: 8px;
}
.sticky-prod-price .cut-price {
  font-size: 0.85rem;
  color: #94a3b8;
  text-decoration: line-through;
  font-weight: 500;
}
.sticky-actions-wrap {
  display: flex;
  align-items: center;
  gap: 12px;
  flex-shrink: 0;
}
.sticky-qty-wrap {
  display: flex;
  align-items: center;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  background: #ffffff;
  overflow: hidden;
  height: 42px;
}
.sticky-qty-wrap button {
  width: 34px;
  height: 100%;
  background: #f8fafc;
  border: none;
  font-weight: 700;
  color: #334155;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}
.sticky-qty-wrap input {
  width: 42px;
  border: none;
  text-align: center;
  font-weight: 700;
  font-size: 0.9rem;
  color: #0f172a;
}
.sticky-btn-cart {
  background: #142D4E;
  color: #ffffff;
  font-weight: 700;
  font-size: 0.92rem;
  border: none;
  border-radius: 8px;
  padding: 0 24px;
  height: 44px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 4px 12px rgba(20, 45, 78, 0.25);
  transition: all 0.2s;
  cursor: pointer;
}
.sticky-btn-cart:hover {
  background: #1e3f6b;
  color: #ffffff;
}

@media (max-width: 991px) {
  .sticky-add-cart-bar {
    padding: 8px 12px;
    bottom: 60px; /* Sits right above the 60px mobile bottom nav bar (Home, Shop, Wishlist, Account, Cart) */
    box-shadow: 0 -4px 18px rgba(0, 0, 0, 0.12);
  }
  .sticky-cart-container {
    gap: 8px;
    width: 100%;
  }
  .sticky-prod-info {
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 0;
    flex: 1 1 auto;
  }
  .sticky-prod-img {
    width: 40px;
    height: 40px;
    border-radius: 6px;
    flex-shrink: 0;
  }
  .sticky-prod-details {
    display: block !important;
    min-width: 0;
    line-height: 1.2;
  }
  .sticky-prod-title {
    font-size: 0.78rem;
    font-weight: 700;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 140px;
    margin-bottom: 2px;
  }
  .sticky-prod-price {
    font-size: 0.88rem;
    font-weight: 800;
    color: #142D4E;
    gap: 4px;
  }
  .sticky-prod-price .cut-price {
    font-size: 0.75rem;
  }
  .sticky-actions-wrap {
    gap: 6px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
  }
  .sticky-qty-wrap {
    height: 38px;
  }
  .sticky-qty-wrap button {
    width: 28px;
    font-size: 0.85rem;
  }
  .sticky-qty-wrap input {
    width: 28px;
    font-size: 0.82rem;
    padding: 0;
  }
  .sticky-btn-cart {
    height: 38px;
    padding: 0 14px;
    font-size: 0.82rem;
    font-weight: 700;
    border-radius: 8px;
    white-space: nowrap;
    gap: 5px;
  }
}

@media (max-width: 420px) {
  .sticky-qty-wrap {
    display: none; /* On tiny mobile screens, streamline to image + price + Add to Cart button */
  }
  .sticky-prod-title {
    max-width: 110px;
  }
  .sticky-btn-cart {
    padding: 0 16px;
    flex: 1 0 auto;
    justify-content: center;
  }
}

/* Feature Cards on Right Top (Product Highlights & Other Info) */
.highlights-card-styled {
  background: #fffdf9;
  border: 1px solid #f6eedb;
  border-radius: 10px;
  padding: 16px 18px;
  margin-bottom: 14px;
}
.highlights-card-title {
  font-size: 0.92rem;
  font-weight: 700;
  color: #8c6628;
  display: flex;
  align-items: center;
  gap: 6px;
  margin-bottom: 12px;
}
.highlight-item {
  display: flex;
  align-items: flex-start;
  gap: 8px;
  font-size: 0.84rem;
  color: #475569;
  margin-bottom: 7px;
  line-height: 1.4;
}
.highlight-item i {
  color: #16a34a;
  font-size: 0.9rem;
  flex-shrink: 0;
  margin-top: 1px;
}

.other-info-card-styled {
  background: #ffffff;
  border: 1px solid #eef0f2;
  border-radius: 10px;
  padding: 16px 18px;
}
.other-info-title {
  font-size: 0.92rem;
  font-weight: 700;
  color: #334155;
  display: flex;
  align-items: center;
  gap: 6px;
  margin-bottom: 12px;
}
.info-table-row {
  display: flex;
  justify-content: space-between;
  padding: 5px 0;
  font-size: 0.83rem;
  border-bottom: 1px dashed #f1f5f9;
}
.info-table-row:last-child {
  border-bottom: none;
}
.info-table-label {
  color: #64748b;
  font-weight: 600;
  min-width: 105px;
}
.info-table-val {
  color: #1e293b;
  font-weight: 600;
  text-align: right;
  flex: 1;
}

/* 4 Feature Badges Horizontal Strip */
.features-badge-strip {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
  padding: 22px 0 10px 0;
  border-top: 1px solid #f1f5f9;
  margin-top: 24px;
}
.badge-pill-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  gap: 6px;
}
.badge-icon-circ {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: #fffdf9;
  border: 1px solid #e2e8f0;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #b45309;
  font-size: 1.25rem;
}
.badge-pill-item span {
  font-size: 0.78rem;
  font-weight: 700;
  color: #334155;
}

/* Tabs Section */
.product-tabs-header {
  display: flex;
  gap: 8px;
  margin-top: 36px;
  margin-bottom: 24px;
  border-bottom: 2px solid #e2e8f0;
  width: 100%;
  max-width: 100%;
  box-sizing: border-box;
}
.product-tab-btn {
  padding: 10px 20px;
  border-radius: 8px 8px 0 0;
  font-weight: 700;
  font-size: 0.9rem;
  cursor: pointer;
  background: transparent;
  border: none;
  color: #64748b;
  position: relative;
  transition: all 0.2s;
  white-space: nowrap;
}
.product-tab-btn.active {
  background: #142D4E;
  color: #ffffff;
}
.product-tab-btn:hover:not(.active) {
  color: #142D4E;
  background: #f8fafc;
}

@media (max-width: 768px) {
  .product-tabs-header {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 4px;
    margin-top: 24px;
    margin-bottom: 18px;
    border-bottom: none;
    background: #f1f5f9;
    padding: 4px;
    border-radius: 10px;
  }
  .product-tab-btn {
    padding: 9px 4px;
    font-size: 0.78rem;
    font-weight: 700;
    text-align: center;
    border-radius: 8px;
    white-space: normal;
    line-height: 1.25;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .product-tab-btn.active {
    background: #142D4E;
    color: #ffffff;
    box-shadow: 0 2px 6px rgba(20, 45, 78, 0.25);
  }
}

/* Travel with Confidence Banner */
.story-banner-box {
  background: #fffefb;
  border: 1px solid #f6eedb;
  border-radius: 12px;
  padding: 28px 32px;
  margin-bottom: 40px;
}
.story-headline {
  font-family: var(--font-serif);
  font-size: 1.6rem;
  font-style: italic;
  font-weight: 700;
  color: #142D4E;
  margin-bottom: 8px;
}
.story-text {
  color: #64748b;
  font-size: 0.9rem;
  line-height: 1.6;
  margin-bottom: 0;
}
.story-icons-row {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 16px;
  text-align: center;
}
.story-icon-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
}
.story-icon-item .circle-icon {
  width: 52px;
  height: 52px;
  border-radius: 50%;
  background: #fdf6ea;
  border: 1px solid #f8e5c2;
  color: #b45309;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.35rem;
}
.story-icon-item span {
  font-size: 0.78rem;
  font-weight: 700;
  color: #334155;
  line-height: 1.25;
}

/* Related Products Grid */
.related-header {
  display: flex;
  align-items: baseline;
  justify-content: space-between;
  margin-bottom: 20px;
}
.related-tag {
  color: #C59A55;
  font-size: 0.75rem;
  font-weight: 800;
  letter-spacing: 2px;
  text-transform: uppercase;
}
.related-title {
  font-family: var(--font-serif);
  font-size: 1.65rem;
  font-weight: 700;
  color: #142D4E;
  margin: 0;
}
.view-all-link {
  color: #142D4E;
  font-weight: 700;
  font-size: 0.88rem;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.view-all-link:hover {
  color: #C59A55;
}
</style>
@endpush

@section('content')
<!-- Breadcrumb Bar matching header width -->
<div class="detail-breadcrumb-bar">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door me-1"></i>Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Shop</a></li>
    @if($product->category)
      <li class="breadcrumb-item"><a href="{{ route('shop.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
    @endif
    <li class="breadcrumb-item active text-dark fw-500">{{ Str::limit($product->name, 45) }}</li>
  </ol>
</div>

<div class="product-detail-page pt-3">
  <div class="row g-4 g-lg-5">
    
    <!-- LEFT COLUMN: Product Gallery (Col 5) -->
    <div class="col-lg-5">
      <div class="product-gallery-wrap">
        <!-- Main Card with floating elements -->
        <div class="product-main-card">
          <!-- Authorized Retailer Ribbon -->
          @if($product->brand)
          <div class="authorized-ribbon">
            <i class="bi bi-award-fill"></i>
            <span>{{ $product->brand->name }} Authorized Retailer</span>
          </div>
          @endif

          <!-- Floating Wishlist -->
          <button type="button" class="btn-floating-wishlist" onclick="toggleWishlist({{ $product->id }}, this)" title="Add to Wishlist">
            <i class="bi {{ $isWishlisted ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
          </button>

          <!-- Prev/Next arrows -->
          @if($product->images->count() > 0)
            <button type="button" class="gallery-arrow gallery-arrow-prev" onclick="prevImage()"><i class="bi bi-chevron-left"></i></button>
          @endif
          <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" id="mainImg">
          @if($product->images->count() > 0)
            <button type="button" class="gallery-arrow gallery-arrow-next" onclick="nextImage()"><i class="bi bi-chevron-right"></i></button>
          @endif
        </div>

        <!-- Thumbnails strip -->
        @if($product->images->count() > 0)
        <div class="detail-thumb-strip" id="thumbStrip">
          <div class="detail-thumb-box active" onclick="changeImage(this, '{{ $product->thumbnail_url }}', 0)">
            <img src="{{ $product->thumbnail_url }}" alt="Thumbnail">
          </div>
          @foreach($product->images as $idx => $img)
            <div class="detail-thumb-box" onclick="changeImage(this, '{{ $img->url }}', {{ $idx + 1 }})">
              <img src="{{ $img->url }}" alt="{{ $img->alt_text ?? 'Gallery Image' }}">
            </div>
          @endforeach
        </div>
        @endif
      </div>
    </div>

    <!-- RIGHT COLUMN: Product Info & Buy Strip (Col 7) -->
    <div class="col-lg-7">
      <div class="d-flex align-items-center justify-content-between mb-1">
        <div class="product-cat-tag">{{ $product->category?->name ?? 'LUGGAGE' }}</div>
        <!-- Real Brand Logo or Styled Name -->
        @if($product->brand)
          <div>
            @if($product->brand->logo_url)
              <img src="{{ $product->brand->logo_url }}" alt="{{ $product->brand->name }}" style="height:32px; max-width:120px; object-fit:contain;">
            @else
              <span class="fs-4 fw-800 fst-italic" style="color:#d9232e; letter-spacing:-0.5px;">{{ strtoupper($product->brand->name) }}</span>
            @endif
          </div>
        @endif
      </div>

      <h1 class="product-headline">{{ $product->name }}</h1>

      <!-- Rating line -->
      <div class="rating-bar">
        <div class="rating-stars">
          @php $avgRating = $product->average_rating > 0 ? round($product->average_rating) : 5; @endphp
          @for($i=1; $i<=5; $i++){{ $i <= $avgRating ? '★' : '☆' }}@endfor
        </div>
        <span class="rating-text">
          @if($product->approvedReviews->count() > 0)
            {{ number_format($product->average_rating, 1) }} ({{ $product->approvedReviews->count() }} {{ Str::plural('Review', $product->approvedReviews->count()) }})
          @else
            5.0 (0 Reviews)
          @endif
        </span>
        <span class="text-muted">|</span>
        <a href="#productTabs" class="write-review-link" onclick="openReviewsTab()">
          <i class="fa-solid fa-pen-to-square me-1"></i> Write a Review
        </a>
      </div>

      <!-- Price row -->
      <div class="pricing-row">
        <span class="price-main">₨{{ number_format($product->current_price, 2) }}</span>
        @if($product->sale_price && $product->price > $product->sale_price)
          <span class="price-cut">₨{{ number_format($product->price, 2) }}</span>
          <span class="badge-discount-tag">{{ $product->discount_percentage }}% OFF</span>
        @endif
      </div>
      <div class="tax-note mb-2">Inclusive of all taxes</div>

      <!-- Product Description -->
      @if($product->description)
      <div class="product-description-snippet mb-3" style="color:#444; font-size:0.92rem; line-height:1.6;">
        {!! preg_replace('/<p[^>]*>(\s|&nbsp;|<br\s*\/?>)*<\/p>/i', '', $product->description) !!}
      </div>
      @endif

      <!-- Product Highlights List below Description (Exact Reference Design) -->
      <div class="product-highlights-box mb-3 p-3 rounded-3" style="background:#fffdf9; border:1px solid #f6eedb;">
        <div class="fw-bold mb-2 pb-2 border-bottom d-flex align-items-center gap-2" style="color:#a87428; font-size:0.95rem;">
          <i class="fa-solid fa-wand-magic-sparkles" style="color:#c9913d;"></i>
          <span>Product Highlights</span>
        </div>
        <div class="d-flex flex-column gap-2 mb-3">
          @if($product->short_description)
            <div class="d-flex align-items-start gap-2 text-dark" style="font-size:0.87rem; line-height:1.4;">
              <i class="fa-solid fa-check mt-1" style="color:#936427; font-size:0.85rem;"></i>
              <span>{{ $product->short_description }}</span>
            </div>
          @endif
          @if($product->material)
            <div class="d-flex align-items-start gap-2 text-dark" style="font-size:0.87rem; line-height:1.4;">
              <i class="fa-solid fa-check mt-1" style="color:#936427; font-size:0.85rem;"></i>
              <span>Durable &amp; lightweight {{ strtolower($product->material) }} material</span>
            </div>
          @else
            <div class="d-flex align-items-start gap-2 text-dark" style="font-size:0.87rem; line-height:1.4;">
              <i class="fa-solid fa-check mt-1" style="color:#936427; font-size:0.85rem;"></i>
              <span>Durable &amp; lightweight soft material</span>
            </div>
          @endif
          <div class="d-flex align-items-start gap-2 text-dark" style="font-size:0.87rem; line-height:1.4;">
            <i class="fa-solid fa-check mt-1" style="color:#936427; font-size:0.85rem;"></i>
            <span>Spacious multi-compartment design</span>
          </div>
          <div class="d-flex align-items-start gap-2 text-dark" style="font-size:0.87rem; line-height:1.4;">
            <i class="fa-solid fa-check mt-1" style="color:#936427; font-size:0.85rem;"></i>
            <span>Smooth 360&deg; spinner wheels</span>
          </div>
          <div class="d-flex align-items-start gap-2 text-dark" style="font-size:0.87rem; line-height:1.4;">
            <i class="fa-solid fa-check mt-1" style="color:#936427; font-size:0.85rem;"></i>
            <span>Sturdy telescopic handle</span>
          </div>
          @if($product->warranty_details || $product->product_warranty)
            <div class="d-flex align-items-start gap-2 text-dark" style="font-size:0.87rem; line-height:1.4;">
              <i class="fa-solid fa-check mt-1" style="color:#936427; font-size:0.85rem;"></i>
              <span>{{ $product->warranty_details ?? $product->product_warranty }}</span>
            </div>
          @else
            <div class="d-flex align-items-start gap-2 text-dark" style="font-size:0.87rem; line-height:1.4;">
              <i class="fa-solid fa-check mt-1" style="color:#936427; font-size:0.85rem;"></i>
              <span>Ideal for business &amp; leisure travel</span>
            </div>
          @endif
        </div>
        <div class="pt-2 border-top d-flex justify-content-end">
          <button type="button" class="btn btn-sm btn-outline-dark px-3 py-1 d-inline-flex align-items-center gap-2" style="font-size:0.8rem; border-radius:5px; font-weight:600; border-color:#cbd5e1;" onclick="scrollToSpecifications()">
            <i class="fa-solid fa-list-check"></i> Show Specifications
          </button>
        </div>
      </div>

      <!-- Color Display (Shows ONLY the product's assigned color) -->
      @if($product->color)
      <div class="mb-3">
        <div class="fw-bold small text-dark mb-1">Color: <span class="fw-600 text-primary">{{ $product->color->name }}</span></div>
        <div class="color-swatch-list mb-0">
          <span class="color-bubble active" style="background:{{ $product->color->code ?: '#142D4E' }};" title="{{ $product->color->name }}"></span>
        </div>
      </div>
      @endif

      <!-- Size Display (Shows product's size or capacity) -->
      @if($product->size)
      <div class="mb-3">
        <div class="fw-bold small text-dark mb-1">Size: <span class="fw-600 text-dark">{{ $product->size->name }}</span></div>
        <div class="size-pill-list mb-0">
          <button type="button" class="size-pill active">
            {{ $product->size->name }} @if($product->size->code)({{ $product->size->code }})@endif
          </button>
        </div>
      </div>
      @elseif($product->capacity)
      <div class="mb-3">
        <div class="fw-bold small text-dark mb-1">Capacity: <span class="fw-600 text-dark">{{ $product->capacity }}</span></div>
        <div class="size-pill-list mb-0">
          <button type="button" class="size-pill active">
            {{ $product->capacity }}
          </button>
        </div>
      </div>
      @endif

      <!-- Action Buttons Strip -->
      <div class="action-strip">
        <div class="qty-stepper">
          <button type="button" onclick="changeQty(-1)">−</button>
          <input type="number" id="qtyInput" value="1" min="1" max="{{ $product->stock_quantity }}">
          <button type="button" onclick="changeQty(1)">+</button>
        </div>

        @if($product->isInStock())
          <button type="button" class="btn-add-cart-navy" onclick="handleAddToCart()">
            <i class="bi bi-bag-plus"></i> Add to Cart
          </button>
        @else
          <button type="button" class="btn-add-cart-navy" disabled style="opacity:0.6; cursor:not-allowed;">
            Out of Stock
          </button>
        @endif

        <button type="button" class="btn-action-outline" onclick="toggleWishlist({{ $product->id }}, this)">
          <i class="bi bi-heart"></i> Wishlist
        </button>

        <button type="button" class="btn-action-outline square" onclick="navigator.share ? navigator.share({title: '{{ $product->name }}', url: window.location.href}) : null" title="Share">
          <i class="bi bi-share"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- Tabs Navigation Header -->
  <div class="product-tabs-header" id="productTabs">
    <button type="button" class="product-tab-btn active" onclick="switchDetailTab('description', this)">Description</button>
    <button type="button" class="product-tab-btn" onclick="switchDetailTab('specifications', this)">Specifications</button>
    <button type="button" class="product-tab-btn" onclick="switchDetailTab('reviews', this)">Reviews ({{ $product->approvedReviews->count() }})</button>
  </div>

  <!-- Tab Content: Description -->
  <div id="tabContent_description" class="detail-tab-pane">
    <div class="card p-4 border rounded-3 mb-4 bg-white">
      <div class="prose" style="line-height:1.8; color:#333; font-size:0.95rem;">
        {!! preg_replace('/<p[^>]*>(\s|&nbsp;|<br\s*\/?>)*<\/p>/i', '', $product->description ?? 'No detailed description available.') !!}
      </div>
    </div>
  </div>

  <!-- Tab Content: Specifications -->
  <div id="tabContent_specifications" class="detail-tab-pane" style="display:none;">
    <div class="card p-4 border rounded-3 mb-4">
      <div class="row g-3">
        <div class="col-md-6">
          <table class="table table-sm">
            @if($product->brand)<tr><th class="text-muted" width="40%">Brand</th><td class="fw-600">{{ $product->brand->name }}</td></tr>@endif
            <tr><th class="text-muted" width="40%">Product Name</th><td class="fw-600">{{ $product->name }}</td></tr>
            @if($product->category)<tr><th class="text-muted">Category</th><td class="fw-600">{{ $product->category->name }}</td></tr>@endif
            @if($product->color)<tr><th class="text-muted">Color</th><td class="fw-600">{{ $product->color->name }}</td></tr>@endif
            @if($product->size)<tr><th class="text-muted">Size</th><td class="fw-600">{{ $product->size->name }}</td></tr>@endif
            @if($product->material)<tr><th class="text-muted">Material</th><td class="fw-600">{{ $product->material }}</td></tr>@endif
          </table>
        </div>
        <div class="col-md-6">
          <table class="table table-sm">
            @if($product->capacity)<tr><th class="text-muted" width="40%">Capacity</th><td class="fw-600">{{ $product->capacity }}</td></tr>@endif
            @if($product->dimensions)<tr><th class="text-muted" width="40%">Dimensions</th><td class="fw-600">{{ $product->dimensions }}</td></tr>@endif
            @if($product->weight)<tr><th class="text-muted" width="40%">Weight</th><td class="fw-600">{{ $product->weight }} kg</td></tr>@endif
            @if($product->hsn_code)<tr><th class="text-muted">HSN Code</th><td class="fw-600">{{ $product->hsn_code }}</td></tr>@endif
            @if($product->tax_rate)<tr><th class="text-muted">Tax Rate</th><td class="fw-600">{{ number_format($product->tax_rate, 2) }}%</td></tr>@endif
            @if($product->warranty_details || $product->product_warranty)
              <tr><th class="text-muted">Warranty</th><td class="fw-600 text-success">{{ $product->warranty_details ?? $product->product_warranty }}</td></tr>
            @endif
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Tab Content: Reviews -->
  <div id="tabContent_reviews" class="detail-tab-pane" style="display:none;">
    <div class="card p-4 border rounded-3 mb-4 bg-white shadow-sm">
      <div class="row g-4">
        <!-- Rating Breakdown & Callout -->
        <div class="col-lg-4 text-center border-end">
          <div class="p-3">
            <div class="display-4 fw-bold text-dark">{{ $product->average_rating > 0 ? number_format($product->average_rating, 1) : '5.0' }}</div>
            <div class="text-warning mb-2 fs-5">
              @for($i=1; $i<=5; $i++){{ $i <= ($product->average_rating > 0 ? round($product->average_rating) : 5) ? '★' : '☆' }}@endfor
            </div>
            <div class="text-muted small mb-3">Based on {{ $product->approvedReviews->count() }} customer {{ Str::plural('review', $product->approvedReviews->count()) }}</div>

            <div class="p-3 bg-light rounded-3 border text-start">
              <div class="small fw-bold text-dark mb-1"><i class="fa-solid fa-shield-halved text-success me-1"></i> Genuine Reviews</div>
              <p class="text-muted small mb-0" style="font-size:0.78rem; line-height:1.4;">
                Every review submitted is checked by our store team to maintain honest and authentic customer experiences.
              </p>
            </div>
          </div>
        </div>

        <!-- Customer Reviews List & Form -->
        <div class="col-lg-8">
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <!-- Write Review Form (Displayed directly) -->
          <div id="writeReviewBox" class="p-4 mb-4 rounded-3 border bg-light shadow-sm">
            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
              <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-star text-warning me-2"></i> Write a Review</h5>
              <span class="badge bg-white text-secondary border">Share Your Feedback</span>
            </div>

            <form action="{{ route('product.review', $product->id) }}" method="POST">
              @csrf
              <div class="mb-3">
                <label class="form-label fw-bold small text-dark">Your Rating <span class="text-danger">*</span></label>
                <div class="d-flex align-items-center gap-3">
                  <div class="rating-select-stars d-flex gap-1 fs-4" style="cursor:pointer; color:#cbd5e1;">
                    <i class="fa-solid fa-star star-rate" data-val="1" onclick="setReviewRating(1)"></i>
                    <i class="fa-solid fa-star star-rate" data-val="2" onclick="setReviewRating(2)"></i>
                    <i class="fa-solid fa-star star-rate" data-val="3" onclick="setReviewRating(3)"></i>
                    <i class="fa-solid fa-star star-rate" data-val="4" onclick="setReviewRating(4)"></i>
                    <i class="fa-solid fa-star star-rate" data-val="5" onclick="setReviewRating(5)"></i>
                  </div>
                  <input type="hidden" name="rating" id="reviewRatingInput" value="5" required>
                  <span id="ratingWordLabel" class="badge bg-warning text-dark fw-bold">5 Stars - Excellent</span>
                </div>
              </div>

              @guest
              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <label class="form-label fw-bold small text-dark">Your Name <span class="text-danger">*</span></label>
                  <input type="text" name="customer_name" class="form-control" placeholder="e.g. Rahul Sharma" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label fw-bold small text-dark">Your Email <span class="text-danger">*</span></label>
                  <input type="email" name="customer_email" class="form-control" placeholder="e.g. rahul@example.com" required>
                  <div class="text-muted" style="font-size:0.75rem;">Your email will remain private and won't be displayed.</div>
                </div>
              </div>
              @endguest

              <div class="mb-3">
                <label class="form-label fw-bold small text-dark">Review Headline (Optional)</label>
                <input type="text" name="title" class="form-control" placeholder="e.g. Very sturdy wheels and premium finish">
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold small text-dark">Your Review <span class="text-danger">*</span></label>
                <textarea name="body" class="form-control" rows="3" placeholder="Tell other travelers about your experience with this bag..." required minlength="5"></textarea>
              </div>

              <div class="d-flex align-items-center justify-content-end gap-2">
                <button type="button" class="btn btn-sm btn-outline-secondary px-3" onclick="toggleReviewForm()">Cancel</button>
                <button type="submit" class="btn btn-sm btn-primary px-4 py-2" style="background:#142D4E; border-color:#142D4E; font-weight:700;">
                  Submit Review For Approval
                </button>
              </div>
            </form>
          </div>

          <!-- Existing Approved Reviews -->
          @forelse($product->approvedReviews as $review)
          <div class="review-item pb-3 mb-3 border-bottom">
            <div class="d-flex justify-content-between align-items-center mb-1">
              <div class="d-flex align-items-center gap-2">
                <strong class="text-dark">{{ $review->author_name }}</strong>
                <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size:0.68rem;">
                  <i class="fa-solid fa-circle-check"></i> Verified Buyer
                </span>
              </div>
              <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
            </div>
            <div class="text-warning small mb-1">
              @for($i=1; $i<=5; $i++){{ $i <= $review->rating ? '★' : '☆' }}@endfor
            </div>
            @if($review->title)<div class="fw-bold small mb-1 text-dark">{{ $review->title }}</div>@endif
            <p class="text-muted small mb-0">{{ $review->body }}</p>
          </div>
          @empty
          <div class="text-center py-4">
            <i class="fa-regular fa-comment-dots fs-1 text-muted d-block mb-2"></i>
            <p class="text-muted mb-3">No reviews yet for this product. Be the first to share your experience!</p>
            <button type="button" class="btn btn-sm btn-outline-dark px-4 py-2" onclick="toggleReviewForm()">
              <i class="fa-solid fa-pen me-1"></i> Be the first to review
            </button>
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  <!-- Related Products Section -->
  <div class="mt-4 pt-3">
    <div class="related-header">
      <div>
        <div class="related-tag">YOU MAY ALSO LIKE</div>
        <h2 class="related-title">Related Products</h2>
      </div>
      <a href="{{ route('shop.index') }}" class="view-all-link">View All <i class="bi bi-arrow-right"></i></a>
    </div>

    <div class="row g-3 g-md-4">
      @if(isset($related) && $related->count() > 0)
        @foreach($related as $rp)
          <div class="col-6 col-md-3">
            @include('frontend.partials.product-card', ['product' => $rp])
          </div>
        @endforeach
      @else
        @foreach(\App\Models\Product::where('status', 'active')->where('id', '!=', $product->id)->take(4)->get() as $rp)
          <div class="col-6 col-md-3">
            @include('frontend.partials.product-card', ['product' => $rp])
          </div>
        @endforeach
      @endif
    </div>
  </div>
</div>
<!-- Sticky Add to Cart Bottom Bar -->
<div class="sticky-add-cart-bar" id="stickyAddCartBar">
  <div class="sticky-cart-container">
    <div class="sticky-prod-info">
      <img src="{{ $product->thumbnail_url ?: ($product->primary_image ?: asset('uploads/placeholder.png')) }}" alt="{{ $product->name }}" class="sticky-prod-img">
      <div class="sticky-prod-details">
        <h4 class="sticky-prod-title">{{ $product->name }}</h4>
        <div class="sticky-prod-price">
          <span>₹{{ number_format($product->current_price, 2) }}</span>
          @if($product->sale_price && $product->price > $product->sale_price)
            <span class="cut-price">₹{{ number_format($product->price, 2) }}</span>
          @endif
        </div>
      </div>
    </div>
    <div class="sticky-actions-wrap">
      <div class="sticky-qty-wrap">
        <button type="button" onclick="changeStickyQty(-1)">−</button>
        <input type="number" id="stickyQtyInput" value="1" min="1" max="{{ $product->stock_quantity }}">
        <button type="button" onclick="changeStickyQty(1)">+</button>
      </div>
      @if($product->isInStock())
        <button type="button" class="sticky-btn-cart" onclick="handleStickyAddToCart()">
          <i class="fa-solid fa-cart-shopping"></i>
          <span>Add to Cart</span>
        </button>
      @else
        <button type="button" class="sticky-btn-cart" disabled style="opacity:0.6; cursor:not-allowed;">
          Out of Stock
        </button>
      @endif
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
let currentGalleryIndex = 0;
const galleryImages = [
  "{{ $product->thumbnail_url }}"
  @foreach($product->images as $img)
    , "{{ $img->url }}"
  @endforeach
];

function changeImage(boxEl, url, idx) {
  document.getElementById('mainImg').src = url;
  document.querySelectorAll('.detail-thumb-box').forEach(b => b.classList.remove('active'));
  if (boxEl) boxEl.classList.add('active');
  currentGalleryIndex = idx;
}

function prevImage() {
  if (galleryImages.length <= 1) return;
  currentGalleryIndex = (currentGalleryIndex - 1 + galleryImages.length) % galleryImages.length;
  updateGalleryFromIndex();
}

function nextImage() {
  if (galleryImages.length <= 1) return;
  currentGalleryIndex = (currentGalleryIndex + 1) % galleryImages.length;
  updateGalleryFromIndex();
}

function updateGalleryFromIndex() {
  document.getElementById('mainImg').src = galleryImages[currentGalleryIndex];
  const thumbs = document.querySelectorAll('.detail-thumb-box');
  thumbs.forEach((t, i) => {
    t.classList.toggle('active', i === currentGalleryIndex);
  });
}

function changeQty(delta) {
  const inp = document.getElementById('qtyInput');
  let val = parseInt(inp.value) + delta;
  inp.value = Math.max(1, Math.min(val, {{ $product->stock_quantity }}));
}

function selectColorBubble(name, el) {
  document.querySelectorAll('.color-bubble').forEach(b => b.classList.remove('active'));
  el.classList.add('active');
  document.getElementById('selectedColorName').textContent = name;
}

function selectSizePill(label, el) {
  document.querySelectorAll('.size-pill').forEach(p => p.classList.remove('active'));
  el.classList.add('active');
  document.getElementById('selectedSizeLabel').textContent = label;
}

function handleAddToCart() {
  const qty = parseInt(document.getElementById('qtyInput').value) || 1;
  addToCart({{ $product->id }}, qty);
}

function switchDetailTab(tabKey, btnEl) {
  document.querySelectorAll('.product-tab-btn').forEach(b => b.classList.remove('active'));
  btnEl.classList.add('active');
  document.querySelectorAll('.detail-tab-pane').forEach(p => p.style.display = 'none');
  const target = document.getElementById('tabContent_' + tabKey);
  if (target) target.style.display = 'block';
}

function openReviewsTab() {
  const btn = document.querySelectorAll('.product-tab-btn')[2];
  if (btn) switchDetailTab('reviews', btn);
  setTimeout(() => {
    const tabs = document.getElementById('productTabs');
    if (tabs) {
      const headerHeight = document.getElementById('siteHeader')?.offsetHeight || 160;
      const y = tabs.getBoundingClientRect().top + window.pageYOffset - (headerHeight + 20);
      window.scrollTo({ top: Math.max(0, y), behavior: 'smooth' });
    }
  }, 50);
}

function toggleReviewForm() {
  const box = document.getElementById('writeReviewBox');
  if (box) {
    box.style.display = box.style.display === 'none' ? 'block' : 'none';
    if (box.style.display === 'block') {
      box.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  }
}

function setReviewRating(rating) {
  document.getElementById('reviewRatingInput').value = rating;
  const stars = document.querySelectorAll('.star-rate');
  const labels = ['', '1 Star - Poor', '2 Stars - Fair', '3 Stars - Good', '4 Stars - Very Good', '5 Stars - Excellent'];
  
  stars.forEach((star, idx) => {
    if (idx < rating) {
      star.style.color = '#f59e0b';
    } else {
      star.style.color = '#cbd5e1';
    }
  });

  const lbl = document.getElementById('ratingWordLabel');
  if (lbl) {
    lbl.textContent = labels[rating] || (rating + ' Stars');
  }
}

function scrollToSpecifications() {
  const specBtn = document.querySelectorAll('.product-tab-btn')[1];
  if (specBtn) {
    switchDetailTab('specifications', specBtn);
  }
  setTimeout(() => {
    const tabs = document.getElementById('productTabs');
    if (tabs) {
      const headerHeight = document.getElementById('siteHeader')?.offsetHeight || 160;
      const y = tabs.getBoundingClientRect().top + window.pageYOffset - (headerHeight + 20);
      window.scrollTo({ top: Math.max(0, y), behavior: 'smooth' });
    }
  }, 50);
}

function changeStickyQty(delta) {
  const inp = document.getElementById('stickyQtyInput');
  const mainInp = document.getElementById('qtyInput');
  let val = parseInt(inp.value) + delta;
  val = Math.max(1, Math.min(val, {{ $product->stock_quantity }}));
  inp.value = val;
  if (mainInp) mainInp.value = val;
}

function handleStickyAddToCart() {
  const qty = parseInt(document.getElementById('stickyQtyInput').value) || 1;
  addToCart({{ $product->id }}, qty);
}

// Track recently viewed product in localStorage as well
document.addEventListener('DOMContentLoaded', () => {
  try {
    const currentId = {{ $product->id }};
    let viewed = JSON.parse(localStorage.getItem('dsh_recently_viewed') || '[]');
    if (!Array.isArray(viewed)) viewed = [];
    viewed = viewed.filter(id => id !== currentId);
    viewed.unshift(currentId);
    if (viewed.length > 20) viewed = viewed.slice(0, 20);
    localStorage.setItem('dsh_recently_viewed', JSON.stringify(viewed));
  } catch (e) {}

  // Sticky Add to Cart dual scroll detection
  const stickyBar = document.getElementById('stickyAddCartBar');
  const actionStrip = document.querySelector('.action-strip');
  const productTabs = document.getElementById('productTabs');
  
  if (stickyBar) {
    function checkStickyVisibility() {
      // Trigger as soon as the main action button scrolls out OR when the user reaches the tabs/description section
      let shouldShow = false;
      if (actionStrip) {
        const stripRect = actionStrip.getBoundingClientRect();
        if (stripRect.bottom < 120) {
          shouldShow = true;
        }
      }
      if (!shouldShow && productTabs) {
        const tabsRect = productTabs.getBoundingClientRect();
        if (tabsRect.top < window.innerHeight - 80) {
          shouldShow = true;
        }
      }
      
      if (shouldShow) {
        stickyBar.classList.add('visible');
      } else {
        stickyBar.classList.remove('visible');
      }
    }

    window.addEventListener('scroll', checkStickyVisibility, { passive: true });
    window.addEventListener('resize', checkStickyVisibility, { passive: true });
    checkStickyVisibility();
  }
});
</script>
@endpush
