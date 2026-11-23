@extends('frontend.layouts.app')
@section('title', 'Shopping Cart — Durable Suitcase House')

@push('styles')
<style>
.cart-hero {
  background: var(--pd-ice);
  padding: 36px 0;
}
.cart-table-wrap {
  background: #fff;
}
/* Desktop Table */
.cart-table {
  width: 100%;
  border-collapse: collapse;
}
.cart-table th {
  font-size: 0.72rem;
  letter-spacing: 2px;
  text-transform: uppercase;
  font-weight: 700;
  color: var(--text-muted);
  padding: 14px 10px;
  border-bottom: 2px solid var(--border);
}
.cart-table td {
  padding: 20px 10px;
  border-bottom: 1px solid var(--border);
  vertical-align: middle;
}
.cart-item-img {
  width: 72px;
  height: 80px;
  object-fit: cover;
  border-radius: 6px;
  background: #f8f9fa;
  flex-shrink: 0;
}
.cart-item-name {
  font-family: var(--font-serif);
  font-size: 1.05rem;
  font-weight: 600;
  color: var(--dsh-navy);
  text-decoration: none;
  line-height: 1.3;
  display: block;
}
.cart-item-name:hover {
  color: var(--dsh-navy-light);
}
.cart-qty-box {
  display: inline-flex;
  align-items: center;
  border: 1px solid var(--border);
  border-radius: 4px;
  overflow: hidden;
  background: #fff;
}
.cart-qty-btn {
  width: 32px;
  height: 32px;
  border: none;
  background: #fff;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 1rem;
  color: var(--dark);
  transition: background 0.15s;
}
.cart-qty-btn:hover {
  background: #f1f3f2;
}
.cart-qty-val {
  width: 36px;
  text-align: center;
  font-weight: 700;
  font-size: 0.88rem;
  color: var(--dark);
}
.cart-remove-btn {
  background: none;
  border: none;
  color: #a0aec0;
  cursor: pointer;
  font-size: 1.25rem;
  line-height: 1;
  padding: 6px;
  transition: color 0.2s;
}
.cart-remove-btn:hover {
  color: #e53e3e;
}

/* Mobile Cart Card List */
.cart-mobile-list {
  display: none;
}
.cart-mobile-card {
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 10px;
  padding: 14px;
  margin-bottom: 14px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.03);
}
.cart-mobile-card .cart-item-img {
  width: 76px;
  height: 84px;
}
.cart-mobile-details {
  flex: 1;
  min-width: 0;
}
.cart-mobile-title {
  font-family: var(--font-serif);
  font-size: 1rem;
  font-weight: 600;
  color: var(--dsh-navy);
  text-decoration: none;
  display: block;
  line-height: 1.3;
  margin-bottom: 4px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.cart-mobile-price {
  font-size: 0.95rem;
  font-weight: 700;
  color: var(--dsh-navy-light);
  margin-bottom: 8px;
}
.cart-mobile-bottom {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 10px;
  padding-top: 10px;
  border-top: 1px dashed var(--border);
}

.cart-summary-card {
  background: var(--pd-ice);
  padding: 28px 24px;
  border-radius: 8px;
  border: 1px solid rgba(27,56,43,0.08);
  position: sticky;
  top: 100px;
  z-index: 10;
}

/* Mobile Sticky Checkout Bar */
.cart-mobile-sticky-checkout {
  display: none;
}

@media (max-width: 991px) {
  .cart-summary-card {
    position: static;
    margin-top: 24px;
  }
  .cart-mobile-sticky-checkout {
    display: flex;
    position: fixed;
    bottom: 60px; /* Above the mobile bottom navigation bar */
    left: 0;
    right: 0;
    background: #ffffff;
    border-top: 1px solid #e7eae3;
    padding: 10px 16px;
    box-shadow: 0 -4px 18px rgba(0,0,0,0.08);
    z-index: 9980;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
  }
  .cart-mobile-sticky-total {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
  }
  .cart-mobile-sticky-total .label {
    font-size: 0.68rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #64748b;
  }
  .cart-mobile-sticky-total .amount {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--dsh-navy);
  }
  .cart-mobile-sticky-btn {
    flex: 1;
    max-width: 200px;
    padding: 10px 16px;
    font-size: 0.82rem;
    border-radius: 6px;
    justify-content: center;
  }
  body {
    padding-bottom: 125px !important; /* Space for both mobile sticky checkout bar and bottom nav */
  }
}

@media (max-width: 768px) {
  .cart-table-wrap {
    display: none;
  }
  .cart-mobile-list {
    display: block;
  }
  .cart-hero {
    padding: 24px 0;
    text-align: center;
  }
  .cart-hero h1 {
    font-size: 1.6rem !important;
    margin-bottom: 4px;
  }
  .cart-hero .breadcrumb {
    justify-content: center;
  }
  .cart-summary-card {
    padding: 20px 16px;
    margin-top: 10px;
  }
}
</style>
@endpush

@section('content')
<div class="cart-hero">
  <div class="container-xl-custom">
    <h1 style="font-family:var(--font-serif); font-size:2rem; font-weight:500; color:var(--dsh-navy);">Shopping Cart</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb small text-muted mb-0" style="background:none;padding:0;">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:var(--dsh-navy-light);">Home</a></li>
        <li class="breadcrumb-item active">Cart</li>
      </ol>
    </nav>
  </div>
</div>

<div class="container-xl-custom py-4 py-md-5">
  @if(empty($cart))
    <div class="text-center py-5">
      <i class="bi bi-bag" style="font-size:4rem;color:var(--border);display:block;margin-bottom:20px;"></i>
      <h4 style="font-family:var(--font-serif); color:var(--dsh-navy);">Your cart is empty</h4>
      <p class="text-muted">Explore authentic Ayurvedic wellness and herbal remedies</p>
      <a href="{{ route('shop.index') }}" class="btn-glamora" style="padding:14px 36px;">Continue Shopping</a>
    </div>
  @else
    <div class="row g-4 g-lg-5">
      <!-- Cart Items Section -->
      <div class="col-lg-8">
        
        <!-- Desktop Table View -->
        <div class="cart-table-wrap">
          <table class="cart-table">
            <thead>
              <tr>
                <th style="width:45%;">Product</th>
                <th style="width:18%;">Price</th>
                <th style="width:18%;">Qty</th>
                <th style="width:14%;">Total</th>
                <th style="width:5%;"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($cart as $rowId => $item)
              <tr id="row-{{ $rowId }}">
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ $item['thumbnail'] }}" alt="{{ $item['name'] }}" class="cart-item-img">
                    <div>
                      <a href="{{ route('product.show', $item['slug']) }}" class="cart-item-name">{{ $item['name'] }}</a>
                      @if(!empty($item['attributes']))
                        @foreach($item['attributes'] as $k => $v)
                          <div class="small text-muted">{{ $k }}: {{ $v }}</div>
                        @endforeach
                      @endif
                    </div>
                  </div>
                </td>
                <td class="fw-600">₨{{ number_format($item['price'], 2) }}</td>
                <td>
                  <div class="cart-qty-box">
                    <button class="cart-qty-btn" onclick="updateCartQty('{{ $rowId }}', {{ $item['quantity'] - 1 }})" aria-label="Decrease">−</button>
                    <span id="qty-{{ $rowId }}" class="cart-qty-val">{{ $item['quantity'] }}</span>
                    <button class="cart-qty-btn" onclick="updateCartQty('{{ $rowId }}', {{ $item['quantity'] + 1 }})" aria-label="Increase">+</button>
                  </div>
                </td>
                <td id="total-{{ $rowId }}" class="fw-700" style="color:var(--dsh-navy);">₨{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                <td class="text-end">
                  <button class="cart-remove-btn" onclick="removeFromCart('{{ $rowId }}')" title="Remove item">
                    <i class="bi bi-trash3"></i>
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Mobile Card List View -->
        <div class="cart-mobile-list">
          @foreach($cart as $rowId => $item)
          <div class="cart-mobile-card" id="mobile-row-{{ $rowId }}">
            <div class="d-flex gap-3 align-items-center">
              <img src="{{ $item['thumbnail'] }}" alt="{{ $item['name'] }}" class="cart-item-img">
              <div class="cart-mobile-details">
                <a href="{{ route('product.show', $item['slug']) }}" class="cart-mobile-title">{{ $item['name'] }}</a>
                @if(!empty($item['attributes']))
                  @foreach($item['attributes'] as $k => $v)
                    <div class="small text-muted">{{ $k }}: {{ $v }}</div>
                  @endforeach
                @endif
                <div class="cart-mobile-price">₨{{ number_format($item['price'], 2) }}</div>
              </div>
              <button class="cart-remove-btn ms-auto" onclick="removeFromCart('{{ $rowId }}')" title="Remove item">
                <i class="bi bi-trash3" style="font-size:1.1rem;"></i>
              </button>
            </div>

            <div class="cart-mobile-bottom">
              <div class="cart-qty-box">
                <button class="cart-qty-btn" onclick="updateCartQty('{{ $rowId }}', {{ $item['quantity'] - 1 }})" aria-label="Decrease">−</button>
                <span id="mobile-qty-{{ $rowId }}" class="cart-qty-val">{{ $item['quantity'] }}</span>
                <button class="cart-qty-btn" onclick="updateCartQty('{{ $rowId }}', {{ $item['quantity'] + 1 }})" aria-label="Increase">+</button>
              </div>
              <div class="text-end">
                <span class="small text-muted d-block" style="font-size:0.7rem; letter-spacing:1px; text-transform:uppercase;">Item Total</span>
                <span id="mobile-total-{{ $rowId }}" class="fw-700" style="color:var(--dsh-navy); font-size:1.05rem;">
                  ₨{{ number_format($item['price'] * $item['quantity'], 2) }}
                </span>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3 mt-md-4">
          <a href="{{ route('shop.index') }}" class="btn-outline-glamora" style="padding:10px 22px; font-size:0.78rem; text-decoration:none;">
            ← Continue Shopping
          </a>
        </div>
      </div>

      <!-- Order Summary -->
      <div class="col-lg-4">
        <div class="cart-summary-card">
          <h5 style="font-family:var(--font-serif); font-size:1.25rem; font-weight:600; color:var(--dsh-navy); margin-bottom:20px;">Order Summary</h5>

          <!-- Coupon -->
          <div class="mb-4">
            <label style="font-size:0.72rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--text-muted);" class="d-block mb-2">Coupon Code</label>
            <div class="d-flex">
              <input type="text" id="couponCode" placeholder="Enter coupon code" style="flex:1;border:1px solid var(--border);border-radius:4px 0 0 4px;padding:10px 14px;font-size:0.85rem;outline:none;background:#fff;">
              <button onclick="applyCoupon()" style="background:var(--dsh-navy);color:#fff;border:none;border-radius:0 4px 4px 0;padding:10px 16px;font-size:0.78rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;cursor:pointer;">Apply</button>
            </div>
            @if($coupon)
              <div class="mt-2 d-flex justify-content-between align-items-center">
                <span class="text-success small fw-600"><i class="bi bi-check-circle me-1"></i>{{ $coupon['code'] }} applied</span>
                <button onclick="removeCoupon()" class="small text-danger" style="background:none;border:none;cursor:pointer;">Remove</button>
              </div>
            @endif
          </div>

          <div class="border-top pt-3">
            <div class="d-flex justify-content-between mb-2 small">
              <span class="text-muted">Subtotal</span>
              <span id="summarySubtotal" class="fw-600">₨{{ number_format($subtotal, 2) }}</span>
            </div>
            @if($discount > 0)
            <div class="d-flex justify-content-between mb-2 small">
              <span class="text-muted">Discount</span>
              <span class="text-success">-₨{{ number_format($discount, 2) }}</span>
            </div>
            @endif
            <div class="d-flex justify-content-between mb-2 small">
              <span class="text-muted">Shipping</span>
              <span class="text-muted">Calculated at checkout</span>
            </div>
            <div class="d-flex justify-content-between fw-bold border-top pt-3 mt-2" style="font-size:1.1rem; color:var(--dsh-navy);">
              <span>Estimated Total</span>
              <span id="summaryTotal">₨{{ number_format($subtotal - $discount, 2) }}</span>
            </div>
          </div>

          <a href="{{ route('checkout.index') }}" class="btn-glamora w-100 justify-content-center mt-4" style="padding:14px;font-size:0.85rem;text-decoration:none;border-radius:6px;">
            <i class="bi bi-lock me-2"></i>Proceed to Checkout
          </a>
          <p class="text-center text-muted small mt-2 mb-0" style="font-size:0.75rem;">
            <i class="bi bi-shield-lock me-1 text-success"></i>100% Safe &amp; Secure Checkout
          </p>
        </div>
      </div>
    </div>

    <!-- Mobile Fixed Bottom Checkout Bar -->
    <div class="cart-mobile-sticky-checkout d-lg-none">
      <div class="cart-mobile-sticky-total">
        <span class="label">Total Amount</span>
        <span class="amount" id="mobileStickyTotal">₨{{ number_format($subtotal - $discount, 2) }}</span>
      </div>
      <a href="{{ route('checkout.index') }}" class="btn-glamora cart-mobile-sticky-btn">
        <span>Checkout</span>
        <i class="bi bi-arrow-right ms-1"></i>
      </a>
    </div>
  @endif
</div>
@endsection

@push('scripts')
<script>
function updateCartQty(rowId, qty) {
  if (qty < 0) qty = 0;
  fetch('{{ route("cart.update") }}', {
    method: 'PATCH',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
    body: JSON.stringify({ row_id: rowId, quantity: qty })
  })
  .then(r => r.json())
  .then(d => {
    if (d.success) {
      if (qty === 0) {
        document.getElementById('row-' + rowId)?.remove();
        document.getElementById('mobile-row-' + rowId)?.remove();
      } else {
        const desktopQty = document.getElementById('qty-' + rowId);
        const mobileQty = document.getElementById('mobile-qty-' + rowId);
        if (desktopQty) desktopQty.textContent = qty;
        if (mobileQty) mobileQty.textContent = qty;

        const itemTotalStr = '₨' + Number(d.item_total || 0).toLocaleString('en-PK', { minimumFractionDigits: 2 });
        const desktopTotal = document.getElementById('total-' + rowId);
        const mobileTotal = document.getElementById('mobile-total-' + rowId);
        if (d.item_total !== undefined) {
          if (desktopTotal) desktopTotal.textContent = itemTotalStr;
          if (mobileTotal) mobileTotal.textContent = itemTotalStr;
        }
      }
      
      const cartCountEl = document.getElementById('cartCount');
      if (cartCountEl) cartCountEl.textContent = d.count;

      const subtotal = document.getElementById('summarySubtotal');
      const total = document.getElementById('summaryTotal');
      const mobileStickyTotal = document.getElementById('mobileStickyTotal');
      const formattedTotal = '₨' + Number(d.subtotal).toLocaleString('en-PK', { minimumFractionDigits: 2 });
      if (subtotal) subtotal.textContent = formattedTotal;
      if (total) total.textContent = formattedTotal;
      if (mobileStickyTotal) mobileStickyTotal.textContent = formattedTotal;

      const remainingRows = document.querySelectorAll('.cart-mobile-card').length;
      if (qty === 0 && remainingRows === 0) location.reload();
    }
  });
}

function removeFromCart(rowId) {
  const removeUrl = @json(route('cart.remove', ['rowId' => '__ROW_ID__']));
  fetch(removeUrl.replace('__ROW_ID__', encodeURIComponent(rowId)), {
    method: 'DELETE',
    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
  })
  .then(r => { if (!r.ok) throw new Error(); return r.json(); })
  .then(d => {
    if (d.success) {
      document.getElementById('row-' + rowId)?.remove();
      document.getElementById('mobile-row-' + rowId)?.remove();
      
      const cartCountEl = document.getElementById('cartCount');
      if (cartCountEl) cartCountEl.textContent = d.count;

      const subtotal = document.getElementById('summarySubtotal');
      const total = document.getElementById('summaryTotal');
      const remainingRows = document.querySelectorAll('.cart-mobile-card').length;
      if (subtotal) subtotal.textContent = '₨' + Number(d.subtotal || 0).toLocaleString('en-PK', { minimumFractionDigits: 2 });
      if (total) total.textContent = '₨' + Number(d.subtotal || 0).toLocaleString('en-PK', { minimumFractionDigits: 2 });
      if (!remainingRows) location.reload();
    }
  })
  .catch(() => showToast('Unable to remove this product from cart.', 'error'));
}

function applyCoupon() {
  const code = document.getElementById('couponCode').value.trim();
  if (!code) return;
  fetch('{{ route("cart.coupon") }}', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
    body: JSON.stringify({ code })
  })
  .then(r => r.json())
  .then(d => {
    showToast(d.message, d.success ? 'success' : 'error');
    if (d.success) location.reload();
  });
}

function removeCoupon() {
  fetch('{{ route("cart.coupon.remove") }}', {
    method: 'DELETE',
    headers: { 'X-CSRF-TOKEN': csrfToken }
  })
  .then(() => location.reload());
}
</script>
@endpush


