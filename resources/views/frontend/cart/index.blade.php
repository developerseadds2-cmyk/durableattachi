@extends('frontend.layouts.app')
@section('title', 'Shopping Cart — Durable Suitcase House Since 1960')

@push('styles')
<style>
.cart-page-wrapper {
  background: #f8fafc;
  min-height: 80vh;
  padding: 32px 0 60px;
}
.cart-heading-title {
  font-family: var(--font-serif);
  font-size: 2.25rem;
  font-weight: 700;
  color: #0f172a;
  letter-spacing: -0.5px;
  margin-bottom: 4px;
}
.cart-breadcrumb {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.85rem;
  color: #64748b;
  margin-bottom: 28px;
}
.cart-breadcrumb a {
  color: #64748b;
  text-decoration: none;
  transition: color 0.15s;
}
.cart-breadcrumb a:hover {
  color: #142D4E;
}

/* Main Cart Items Card */
.cart-items-card {
  background: #ffffff;
  border-radius: 16px;
  border: 1px solid #eef2f6;
  box-shadow: 0 4px 20px rgba(0,0,0,0.03);
  padding: 24px;
}

/* Table styles */
.cart-table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
}
.cart-table th {
  font-size: 0.75rem;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  font-weight: 700;
  color: #64748b;
  padding: 0 16px 16px 16px;
  border-bottom: 1.5px solid #f1f5f9;
}
.cart-table td {
  padding: 20px 16px;
  border-bottom: 1px solid #f1f5f9;
  vertical-align: middle;
}
.cart-table tr:last-child td {
  border-bottom: none;
}

.cart-item-img-box {
  width: 80px;
  height: 90px;
  border-radius: 10px;
  background: #f8fafc;
  border: 1px solid #eef2f6;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 6px;
  flex-shrink: 0;
}
.cart-item-img-box img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}
.cart-item-name {
  font-size: 0.96rem;
  font-weight: 600;
  color: #1e293b;
  text-decoration: none;
  line-height: 1.35;
  display: inline-block;
  transition: color 0.15s;
}
.cart-item-name:hover {
  color: #142D4E;
}
.cart-unit-price {
  font-size: 0.95rem;
  font-weight: 600;
  color: #475569;
}

.cart-qty-stepper {
  display: inline-flex;
  align-items: center;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  background: #ffffff;
  padding: 2px 4px;
}
.cart-qty-btn {
  width: 28px;
  height: 28px;
  border: none;
  background: transparent;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: #475569;
  font-size: 0.75rem;
  border-radius: 4px;
  transition: background 0.15s;
}
.cart-qty-btn:hover {
  background: #f1f5f9;
  color: #0f172a;
}
.cart-qty-val {
  min-width: 32px;
  text-align: center;
  font-weight: 700;
  font-size: 0.88rem;
  color: #1e293b;
}

.cart-line-total {
  font-size: 1.05rem;
  font-weight: 800;
  color: #0f172a;
}
.cart-remove-btn {
  background: none;
  border: none;
  color: #94a3b8;
  cursor: pointer;
  font-size: 1.05rem;
  padding: 6px;
  border-radius: 6px;
  transition: all 0.15s;
}
.cart-remove-btn:hover {
  color: #ef4444;
  background: #fee2e2;
}

.btn-continue-shop {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 0.88rem;
  font-weight: 600;
  color: #475569;
  text-decoration: none;
  transition: color 0.15s;
}
.btn-continue-shop:hover {
  color: #142D4E;
}

/* Order Summary Box */
.order-summary-box {
  background: #ffffff;
  border-radius: 16px;
  border: 1px solid #eef2f6;
  box-shadow: 0 4px 20px rgba(0,0,0,0.03);
  padding: 26px;
  position: sticky;
  top: 100px;
}
.summary-heading {
  font-family: var(--font-serif);
  font-size: 1.35rem;
  font-weight: 700;
  color: #0f172a;
  margin-bottom: 20px;
}
.coupon-input-group {
  display: flex;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  overflow: hidden;
  background: #ffffff;
  transition: border-color 0.2s;
}
.coupon-input-group:focus-within {
  border-color: #142D4E;
  box-shadow: 0 0 0 3px rgba(20,45,78,0.1);
}
.coupon-input-group input {
  flex: 1;
  border: none;
  outline: none;
  padding: 10px 14px;
  font-size: 0.88rem;
}
.coupon-input-group button {
  background: #142D4E;
  color: #ffffff;
  border: none;
  padding: 0 16px;
  font-weight: 700;
  font-size: 0.78rem;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  cursor: pointer;
  transition: background 0.15s;
}
.coupon-input-group button:hover {
  background: #0f233d;
}

.summary-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
  font-size: 0.92rem;
  color: #475569;
}
.summary-row.total-row {
  border-top: 1.5px solid #f1f5f9;
  padding-top: 16px;
  margin-top: 16px;
  font-size: 1.25rem;
  font-weight: 800;
  color: #0f172a;
}

.btn-proceed-checkout {
  background: #142D4E;
  color: #ffffff;
  border: none;
  border-radius: 10px;
  padding: 14px;
  font-weight: 700;
  font-size: 0.92rem;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  width: 100%;
  text-decoration: none;
  margin-top: 20px;
  transition: all 0.2s;
  box-shadow: 0 4px 14px rgba(20,45,78,0.25);
}
.btn-proceed-checkout:hover {
  background: #0f233d;
  color: #ffffff;
  box-shadow: 0 6px 18px rgba(20,45,78,0.35);
  transform: translateY(-1px);
}

/* Mobile List & Responsive */
.cart-mobile-card {
  background: #ffffff;
  border: 1px solid #eef2f6;
  border-radius: 14px;
  padding: 14px;
  margin-bottom: 12px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.02);
}
@media (max-width: 991px) {
  .cart-table-wrap { display: none; }
  .cart-mobile-list { display: block; }
  .order-summary-box { position: static; margin-top: 24px; }
  .cart-heading-title { font-size: 1.8rem; }
}
@media (min-width: 992px) {
  .cart-mobile-list { display: none; }
}
</style>
@endpush

@section('content')
<div class="cart-page-wrapper">
  <div class="container-xl-custom">
    <!-- Header & Breadcrumbs -->
    <h1 class="cart-heading-title">Shopping Cart</h1>
    <div class="cart-breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span>/</span>
      <span>Cart</span>
    </div>

    @if(empty($cart))
      <div class="cart-items-card text-center py-5">
        <i class="fa-solid fa-cart-shopping mb-3" style="font-size:3.5rem; color:#cbd5e1; display:block;"></i>
        <h4 style="font-family:var(--font-serif); font-size:1.6rem; color:#0f172a;" class="mb-2">Your cart is currently empty</h4>
        <p class="text-muted mb-4 small">Explore authentic suitcases, luggage, handbags, and travel essentials</p>
        <a href="{{ route('shop.index') }}" class="btn-proceed-checkout" style="max-width:220px; margin:0 auto; padding:12px 24px; font-size:0.85rem;">Continue Shopping</a>
      </div>
    @else
      <div class="row g-4 g-xl-5">
        <!-- Cart Items Column -->
        <div class="col-lg-8">
          
          <!-- Desktop Table View -->
          <div class="cart-table-wrap cart-items-card">
            <table class="cart-table">
              <thead>
                <tr>
                  <th style="width:48%;">Product</th>
                  <th style="width:16%;">Price</th>
                  <th style="width:18%;">Quantity</th>
                  <th style="width:14%;">Total</th>
                  <th style="width:4%;"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($cart as $rowId => $item)
                <tr id="row-{{ $rowId }}">
                  <td>
                    <div class="d-flex align-items-center gap-3">
                      <div class="cart-item-img-box">
                        <img src="{{ $item['thumbnail'] }}" alt="{{ $item['name'] }}">
                      </div>
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
                  <td>
                    <span class="cart-unit-price">₹{{ number_format($item['price'], 0) }}</span>
                  </td>
                  <td>
                    <div class="cart-qty-stepper">
                      <button type="button" class="cart-qty-btn" onclick="updateCartQty('{{ $rowId }}', {{ $item['quantity'] - 1 }})" aria-label="Decrease">
                        <i class="fa-solid fa-minus"></i>
                      </button>
                      <span id="qty-{{ $rowId }}" class="cart-qty-val">{{ $item['quantity'] }}</span>
                      <button type="button" class="cart-qty-btn" onclick="updateCartQty('{{ $rowId }}', {{ $item['quantity'] + 1 }})" aria-label="Increase">
                        <i class="fa-solid fa-plus"></i>
                      </button>
                    </div>
                  </td>
                  <td>
                    <span id="total-{{ $rowId }}" class="cart-line-total">₹{{ number_format($item['price'] * $item['quantity'], 0) }}</span>
                  </td>
                  <td class="text-end">
                    <button type="button" class="cart-remove-btn" onclick="removeFromCart('{{ $rowId }}')" title="Remove item">
                      <i class="fa-regular fa-trash-can"></i>
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <div class="pt-4 border-top mt-2">
              <a href="{{ route('shop.index') }}" class="btn-continue-shop">
                <i class="fa-solid fa-arrow-left me-1"></i> Continue Shopping
              </a>
            </div>
          </div>

          <!-- Mobile Card List View -->
          <div class="cart-mobile-list">
            @foreach($cart as $rowId => $item)
            <div class="cart-mobile-card" id="mobile-row-{{ $rowId }}">
              <div class="d-flex gap-3 align-items-center">
                <div class="cart-item-img-box" style="width:70px; height:76px;">
                  <img src="{{ $item['thumbnail'] }}" alt="{{ $item['name'] }}">
                </div>
                <div class="flex-grow-1 min-w-0">
                  <a href="{{ route('product.show', $item['slug']) }}" class="cart-item-name text-truncate d-block">{{ $item['name'] }}</a>
                  <div class="cart-unit-price mt-1">₹{{ number_format($item['price'], 0) }}</div>
                </div>
                <button type="button" class="cart-remove-btn ms-auto" onclick="removeFromCart('{{ $rowId }}')" title="Remove item">
                  <i class="fa-regular fa-trash-can"></i>
                </button>
              </div>

              <div class="d-flex align-items-center justify-content-between mt-3 pt-2 border-top">
                <div class="cart-qty-stepper">
                  <button type="button" class="cart-qty-btn" onclick="updateCartQty('{{ $rowId }}', {{ $item['quantity'] - 1 }})" aria-label="Decrease">
                    <i class="fa-solid fa-minus"></i>
                  </button>
                  <span id="mobile-qty-{{ $rowId }}" class="cart-qty-val">{{ $item['quantity'] }}</span>
                  <button type="button" class="cart-qty-btn" onclick="updateCartQty('{{ $rowId }}', {{ $item['quantity'] + 1 }})" aria-label="Increase">
                    <i class="fa-solid fa-plus"></i>
                  </button>
                </div>
                <div>
                  <span class="small text-muted me-1">Total:</span>
                  <span id="mobile-total-{{ $rowId }}" class="cart-line-total">
                    ₹{{ number_format($item['price'] * $item['quantity'], 0) }}
                  </span>
                </div>
              </div>
            </div>
            @endforeach

            <div class="mt-3">
              <a href="{{ route('shop.index') }}" class="btn-continue-shop">
                <i class="fa-solid fa-arrow-left me-1"></i> Continue Shopping
              </a>
            </div>
          </div>
        </div>

        <!-- Order Summary Column -->
        <div class="col-lg-4">
          <div class="order-summary-box">
            <h5 class="summary-heading">Order Summary</h5>

            <!-- Coupon Code Section -->
            <div class="mb-4">
              <label style="font-size:0.75rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:#64748b;" class="d-block mb-2">Coupon Code</label>
              <div class="coupon-input-group">
                <input type="text" id="couponCode" placeholder="Enter coupon code">
                <button type="button" onclick="applyCoupon()">Apply</button>
              </div>
              @if($coupon)
                <div class="mt-2 d-flex justify-content-between align-items-center">
                  <span class="text-success small fw-600"><i class="fa-solid fa-circle-check me-1"></i>{{ $coupon['code'] }} applied</span>
                  <button type="button" onclick="removeCoupon()" class="small text-danger" style="background:none;border:none;cursor:pointer;">Remove</button>
                </div>
              @endif
            </div>

            <!-- Price Breakdown -->
            <div class="summary-row">
              <span>Subtotal</span>
              <span id="summarySubtotal" class="fw-700 text-dark">₹{{ number_format($subtotal, 0) }}</span>
            </div>
            @if($discount > 0)
              <div class="summary-row">
                <span>Discount</span>
                <span class="text-success fw-700">-₹{{ number_format($discount, 0) }}</span>
              </div>
            @endif
            <div class="summary-row">
              <span>Shipping</span>
              <span class="text-muted">Calculated at checkout</span>
            </div>
            <div class="summary-row total-row">
              <span>Estimated Total</span>
              <span id="summaryTotal">₹{{ number_format($subtotal - $discount, 0) }}</span>
            </div>

            <a href="{{ route('checkout.index') }}" class="btn-proceed-checkout">
              <i class="fa-solid fa-lock me-1"></i> Proceed to Checkout
            </a>
            <p class="text-center text-muted small mt-3 mb-0" style="font-size:0.75rem;">
              <i class="fa-solid fa-shield-halved me-1 text-success"></i> 100% Safe &amp; Secure Checkout
            </p>
          </div>
        </div>
      </div>
    @endif
  </div>
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

        const itemTotalStr = '₹' + Number(d.item_total || 0).toLocaleString('en-IN', { maximumFractionDigits: 0 });
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
      const formattedTotal = '₹' + Number(d.subtotal).toLocaleString('en-IN', { maximumFractionDigits: 0 });
      if (subtotal) subtotal.textContent = formattedTotal;
      if (total) total.textContent = formattedTotal;

      const remainingRows = document.querySelectorAll('#cartTableWrap tr[id^="row-"], .cart-mobile-card').length;
      if (qty === 0 && (d.count === 0 || remainingRows === 0)) location.reload();
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
      if (subtotal) subtotal.textContent = '₹' + Number(d.subtotal || 0).toLocaleString('en-IN', { maximumFractionDigits: 0 });
      if (total) total.textContent = '₹' + Number(d.subtotal || 0).toLocaleString('en-IN', { maximumFractionDigits: 0 });
      
      if (!d.count) location.reload();
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



