@extends('frontend.layouts.app')
@section('title', 'My Wishlist — Durable Suitcase House')

@section('content')
<div class="account-hero">
  <div class="container-xl-custom">
    <h4 style="font-family:var(--font-serif);font-weight:400;margin-bottom:0;">My Wishlist</h4>
  </div>
</div>

<div class="container-xl-custom py-4 py-md-5">
  <div class="row g-4">
    <!-- Sidebar -->
    <div class="col-lg-3">
      @include('frontend.account.partials.sidebar')
    </div>

    <!-- Wishlist Items -->
    <div class="col-lg-9">
      <div class="account-card">
        <div class="d-flex align-items-center justify-content-between mb-4 pb-2" style="border-bottom:1px solid #eef2ec;">
          <h5 style="font-family:var(--font-serif);font-size:1.2rem;margin-bottom:0;color:var(--dsh-navy);">
            Saved Items <span id="wishlistSavedCount" class="text-muted" style="font-size:0.9rem;font-family:var(--font-sans);">({{ $wishlist->count() }})</span>
          </h5>
          @if($wishlist->count())
            <a href="{{ route('shop.index') }}" class="btn-outline-glamora d-none d-sm-inline-flex" style="padding:7px 16px;font-size:0.72rem;border-radius:6px;">
              <i class="bi bi-plus-lg me-1"></i> Continue Shopping
            </a>
          @endif
        </div>

        <div id="wishlistContainer">
          @forelse($wishlist as $item)
          <div class="wishlist-row d-flex flex-column flex-sm-row gap-3 py-3" style="border-bottom:1px solid #f0f0f0;">
            <!-- Image -->
            <a href="{{ route('product.show', $item->product->slug) }}" style="width:85px;height:95px;background:#f8f9fa;border-radius:8px;border:1px solid #ecefe9;flex-shrink:0;overflow:hidden;display:flex;align-items:center;justify-content:center;margin:0 auto;text-decoration:none;">
              @if($item->product->primary_image)
                <img src="{{ $item->product->primary_image }}" alt="{{ $item->product->name }}" style="max-width:100%;max-height:100%;object-fit:contain;padding:6px;">
              @else
                <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                  <i class="bi bi-image text-muted" style="font-size:1.4rem;"></i>
                </div>
              @endif
            </a>

            <!-- Info -->
            <div class="flex-grow-1 text-center text-sm-start">
              @if($item->product->category)
                <div class="text-muted small mb-1" style="font-size:0.7rem;letter-spacing:1px;text-transform:uppercase;font-weight:600;color:var(--dsh-navy-light);">
                  {{ $item->product->category->name }}
                </div>
              @endif
              <a href="{{ route('product.show', $item->product->slug) }}" style="font-family:var(--font-serif);font-size:1.08rem;font-weight:500;color:var(--dark);display:block;margin-bottom:6px;text-decoration:none;">
                {{ $item->product->name }}
              </a>
              <div class="d-flex align-items-center justify-content-center justify-content-sm-start gap-2 mb-3">
                <span style="font-weight:700;font-size:1rem;color:var(--dsh-navy);">₨{{ number_format($item->product->sale_price ?? $item->product->price, 2) }}</span>
                @if($item->product->sale_price)
                  <span style="font-size:0.85rem;color:var(--text-muted);text-decoration:line-through;">₨{{ number_format($item->product->price, 2) }}</span>
                  <span class="badge" style="background:#fef2f2;color:#dc2626;font-size:0.68rem;font-weight:700;padding:3px 6px;border-radius:4px;">
                    {{ round((($item->product->price - $item->product->sale_price) / $item->product->price) * 100) }}% OFF
                  </span>
                @endif
              </div>
              <div class="d-flex gap-2 flex-wrap justify-content-center justify-content-sm-start">
                <form method="POST" action="{{ route('cart.add') }}" class="wishlist-cart-form">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit" class="btn-glamora" style="padding:8px 20px;font-size:0.75rem;border-radius:6px;">
                    <i class="bi bi-bag-plus me-1"></i> Add to Cart
                  </button>
                </form>
                <form method="POST" action="{{ route('wishlist.toggle', $item->product->id) }}" class="wishlist-remove-form">
                  @csrf
                  <button type="submit" style="background:#fff;border:1px solid #e2e8f0;border-radius:6px;padding:8px 14px;font-size:0.75rem;color:#dc3545;cursor:pointer;font-weight:600;display:flex;align-items:center;gap:6px;transition:all 0.2s;">
                    <i class="bi bi-trash"></i> Remove
                  </button>
                </form>
              </div>
            </div>

            <!-- Stock Status -->
            <div class="text-center text-sm-end flex-shrink-0 pt-1">
              @if($item->product->stock_quantity > 0)
                <span style="font-size:0.72rem;color:#065f46;background:#d1fae5;padding:4px 10px;border-radius:20px;font-weight:600;display:inline-block;">In Stock</span>
              @else
                <span style="font-size:0.72rem;color:#991b1b;background:#fee2e2;padding:4px 10px;border-radius:20px;font-weight:600;display:inline-block;">Out of Stock</span>
              @endif
            </div>
          </div>
          @empty
          <div class="text-center py-5">
            <div style="width:72px;height:72px;background:var(--pd-ice);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
              <i class="bi bi-heart" style="font-size:2rem;color:var(--dsh-navy-light);"></i>
            </div>
            <h5 style="font-family:var(--font-serif);font-size:1.25rem;color:var(--dsh-navy);margin-bottom:6px;">Your Wishlist is Empty</h5>
            <p class="text-muted small mb-4">Explore our pure Ayurvedic wellness and herbal collection and save your favorites.</p>
            <a href="{{ route('shop.index') }}" class="btn-glamora" style="padding:11px 28px;border-radius:6px;">
              <i class="bi bi-shop me-1"></i> Browse Products
            </a>
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.wishlist-cart-form').forEach(form => {
  form.addEventListener('submit', event => {
    event.preventDefault();
    const button = form.querySelector('button');
    button.disabled = true;
    fetch(form.action, {
      method: 'POST',
      body: new FormData(form),
      headers: { 'Accept': 'application/json' }
    })
    .then(response => { if (!response.ok) throw new Error(); return response.json(); })
    .then(data => {
      if (!data.success) throw new Error(data.message || 'Cart update failed');
      const cartCount = document.getElementById('cartCount');
      const mobileCartCount = document.getElementById('mobileBottomCartCount');
      if (cartCount) cartCount.textContent = data.count;
      if (mobileCartCount) mobileCartCount.textContent = data.count;
      showToast(data.message, 'success');
      if (typeof openCart === 'function') {
        openCart();
      }
    })
    .catch(() => showToast('Unable to add this product to cart.', 'error'))
    .finally(() => { button.disabled = false; });
  });
});

document.querySelectorAll('.wishlist-remove-form').forEach(form => {
  form.addEventListener('submit', event => {
    event.preventDefault();
    const row = form.closest('.wishlist-row');
    const button = form.querySelector('button');
    button.disabled = true;
    fetch(form.action, {
      method: 'POST',
      body: new FormData(form),
      headers: { 'Accept': 'application/json' }
    })
    .then(response => { if (!response.ok) throw new Error(); return response.json(); })
    .then(data => {
      if (!data.success) throw new Error(data.message || 'Wishlist update failed');
      row.remove();
      const wishlistCount = document.getElementById('wishlistCount');
      const mobileWishlistCount = document.getElementById('mobileBottomWishlistCount');
      const savedCount = document.getElementById('wishlistSavedCount');
      if (wishlistCount) wishlistCount.textContent = data.count;
      if (mobileWishlistCount) mobileWishlistCount.textContent = data.count;
      if (savedCount) savedCount.textContent = '(' + data.count + ')';
      showToast(data.message, 'success');

      // If empty, reload to show empty state
      if (data.count === 0) {
        location.reload();
      }
    })
    .catch(() => {
      button.disabled = false;
      showToast('Unable to remove this product from wishlist.', 'error');
    });
  });
});
</script>
@endpush

