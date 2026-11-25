@extends('frontend.layouts.app')
@section('title', 'Checkout — Durable Suitcase House Since 1960')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
/* Select2 Durable Suitcase House Custom Theme */
.select2-container--default .select2-selection--single {
  border: 1px solid #cbd5e1 !important;
  border-radius: 8px !important;
  height: 46px !important;
  display: flex !important;
  align-items: center !important;
  padding: 0 10px !important;
  background: #ffffff !important;
}
.select2-container--default .select2-selection--single:focus,
.select2-container--default.select2-container--open .select2-selection--single {
  border-color: #142D4E !important;
  box-shadow: 0 0 0 3px rgba(20, 45, 78, 0.12) !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
  color: #0f172a !important;
  font-size: 0.9rem !important;
  font-weight: 500 !important;
  padding-left: 4px !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 44px !important;
  right: 10px !important;
}
.select2-dropdown {
  border: 1px solid #cbd5e1 !important;
  border-radius: 10px !important;
  box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
  z-index: 9999 !important;
  overflow: hidden;
}
.select2-container--default .select2-search--dropdown .select2-search__field {
  border: 1px solid #cbd5e1 !important;
  border-radius: 6px !important;
  padding: 8px 12px !important;
  outline: none !important;
}
.select2-container--default .select2-search--dropdown .select2-search__field:focus {
  border-color: #142D4E !important;
}
.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
  background-color: #142D4E !important;
  color: #ffffff !important;
}
.select2-container--default .select2-results__option--selected {
  background-color: #e2e8f0 !important;
  color: #142D4E !important;
  font-weight: 600 !important;
}
.select2-container {
  width: 100% !important;
}

.checkout-page-wrapper {
  background: #f8fafc;
  min-height: 85vh;
  padding: 32px 0 60px;
}
.checkout-heading-title {
  font-family: var(--font-serif);
  font-size: 2.25rem;
  font-weight: 700;
  color: #0f172a;
  letter-spacing: -0.5px;
  margin-bottom: 4px;
}
.checkout-breadcrumb {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.85rem;
  color: #64748b;
  margin-bottom: 24px;
}
.checkout-breadcrumb a {
  color: #64748b;
  text-decoration: none;
}
.checkout-breadcrumb a:hover {
  color: #142D4E;
}

/* Steps Bar */
.checkout-steps-bar {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 32px;
  padding: 14px 20px;
  background: #ffffff;
  border-radius: 12px;
  border: 1px solid #eef2f6;
  width: fit-content;
}
.checkout-step-pill {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.85rem;
  font-weight: 600;
  color: #94a3b8;
}
.checkout-step-pill.active {
  color: #142D4E;
}
.checkout-step-pill.completed {
  color: #059669;
}
.checkout-step-badge {
  width: 26px;
  height: 26px;
  border-radius: 50%;
  background: #f1f5f9;
  color: #64748b;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.75rem;
  font-weight: 700;
}
.checkout-step-pill.active .checkout-step-badge {
  background: #142D4E;
  color: #ffffff;
}
.checkout-step-pill.completed .checkout-step-badge {
  background: #ecfdf5;
  color: #059669;
}
.checkout-step-sep {
  width: 32px;
  height: 1px;
  background: #cbd5e1;
}

/* Form Cards */
.checkout-box {
  background: #ffffff;
  border-radius: 16px;
  border: 1px solid #eef2f6;
  box-shadow: 0 4px 20px rgba(0,0,0,0.03);
  padding: 24px 26px;
  margin-bottom: 24px;
}
.checkout-box-title {
  font-family: var(--font-serif);
  font-size: 1.25rem;
  font-weight: 700;
  color: #0f172a;
  margin-bottom: 20px;
  padding-bottom: 12px;
  border-bottom: 1.5px solid #f1f5f9;
  display: flex;
  align-items: center;
  gap: 10px;
}
.checkout-box-title i {
  color: #142D4E;
  font-size: 1.15rem;
}

.checkout-label {
  font-size: 0.84rem;
  font-weight: 600;
  color: #334155;
  margin-bottom: 6px;
  display: block;
}

.form-control, .form-select {
  border-radius: 8px !important;
  border: 1px solid #cbd5e1;
  padding: 10px 14px;
  font-size: 0.9rem;
  color: #0f172a;
  transition: all 0.2s;
  background-color: #ffffff;
}
.form-control:focus, .form-select:focus {
  border-color: #142D4E;
  box-shadow: 0 0 0 3px rgba(20, 45, 78, 0.12);
}

/* Shipping & Payment Cards */
.shipping-pill-card, .payment-pill-card {
  border: 1.5px solid #e2e8f0;
  border-radius: 12px;
  padding: 16px 18px;
  margin-bottom: 12px;
  cursor: pointer;
  transition: all 0.2s ease;
  background: #ffffff;
  display: flex;
  align-items: flex-start;
  gap: 14px;
}
.shipping-pill-card:hover, .payment-pill-card:hover {
  border-color: #cbd5e1;
  background: #fafafa;
}
.shipping-pill-card.selected, .payment-pill-card.selected {
  border-color: #142D4E;
  background: rgba(20, 45, 78, 0.02);
  box-shadow: 0 2px 10px rgba(20, 45, 78, 0.06);
}
.custom-radio {
  accent-color: #142D4E;
  width: 18px;
  height: 18px;
  margin-top: 2px;
  cursor: pointer;
}

/* Right Summary Card */
.checkout-summary-box {
  background: #ffffff;
  border-radius: 16px;
  border: 1px solid #eef2f6;
  box-shadow: 0 4px 20px rgba(0,0,0,0.03);
  padding: 26px;
  position: sticky;
  top: 100px;
}
.summary-items-scroll {
  max-height: 280px;
  overflow-y: auto;
  padding-right: 6px;
  margin-bottom: 18px;
}
.summary-item-row {
  display: flex;
  gap: 14px;
  padding-bottom: 14px;
  margin-bottom: 14px;
  border-bottom: 1px solid #f1f5f9;
  align-items: center;
}
.summary-item-row:last-child {
  border-bottom: none;
  margin-bottom: 0;
  padding-bottom: 0;
}
.summary-item-thumb {
  width: 60px;
  height: 65px;
  border-radius: 8px;
  background: #f8fafc;
  border: 1px solid #eef2f6;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  flex-shrink: 0;
  padding: 4px;
}
.summary-item-thumb img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}
.summary-qty-bubble {
  position: absolute;
  top: -6px;
  right: -6px;
  background: #142D4E;
  color: #ffffff;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  font-size: 0.68rem;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.summary-calc-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 0.92rem;
  color: #475569;
  margin-bottom: 12px;
}
.summary-total-row {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
  border-top: 1.5px solid #f1f5f9;
  padding-top: 16px;
  margin-top: 14px;
  font-size: 1.35rem;
  font-weight: 800;
  color: #0f172a;
}

.btn-place-order {
  background: #142D4E;
  color: #ffffff;
  border: none;
  border-radius: 10px;
  padding: 15px;
  font-size: 0.92rem;
  font-weight: 700;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  width: 100%;
  margin-top: 22px;
  transition: all 0.2s;
  box-shadow: 0 4px 14px rgba(20,45,78,0.25);
  cursor: pointer;
}
.btn-place-order:hover {
  background: #0f233d;
  color: #ffffff;
  box-shadow: 0 6px 18px rgba(20,45,78,0.35);
  transform: translateY(-1px);
}

/* Mobile Sticky Checkout Bar */
.checkout-mobile-sticky-bar {
  display: none;
}

@media (max-width: 991px) {
  body {
    padding-bottom: 130px !important;
  }
  .checkout-summary-box {
    position: static;
    margin-top: 24px;
  }
  .checkout-mobile-sticky-bar {
    display: flex !important;
    position: fixed;
    bottom: 60px;
    left: 0;
    right: 0;
    background: #ffffff;
    border-top: 1px solid #e2e8f0;
    padding: 12px 18px;
    box-shadow: 0 -4px 20px rgba(0,0,0,0.08);
    z-index: 9985;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
  }
  .checkout-mobile-sticky-total .label {
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #64748b;
    display: block;
  }
  .checkout-mobile-sticky-total .amount {
    font-size: 1.25rem;
    font-weight: 800;
    color: #142D4E;
  }
  .checkout-mobile-sticky-btn {
    flex: 1;
    max-width: 200px;
    padding: 12px 16px;
    font-size: 0.88rem;
    font-weight: 700;
    border-radius: 8px;
    background: #142D4E;
    color: #ffffff;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }
  .checkout-box {
    padding: 18px 16px;
  }
  .checkout-steps-bar {
    width: 100%;
    justify-content: space-between;
  }
}
</style>
@endpush

@section('content')
<div class="checkout-page-wrapper">
  <div class="container-xl-custom">
    <!-- Header & Breadcrumbs -->
    <h1 class="checkout-heading-title">Checkout</h1>
    <div class="checkout-breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span>/</span>
      <a href="{{ route('cart.index') }}">Cart</a>
      <span>/</span>
      <span>Checkout</span>
    </div>

    <!-- Steps indicator -->
    <div class="checkout-steps-bar">
      <div class="checkout-step-pill completed">
        <div class="checkout-step-badge"><i class="fa-solid fa-check"></i></div>
        <span>Cart</span>
      </div>
      <div class="checkout-step-sep"></div>
      <div class="checkout-step-pill active">
        <div class="checkout-step-badge">2</div>
        <span>Shipping &amp; Payment</span>
      </div>
      <div class="checkout-step-sep"></div>
      <div class="checkout-step-pill">
        <div class="checkout-step-badge">3</div>
        <span>Confirmation</span>
      </div>
    </div>

    <form method="POST" action="{{ route('checkout.place-order') }}" id="checkoutForm">
      @csrf
      <div class="row g-4 g-xl-5">
        <!-- Left Column: Forms -->
        <div class="col-lg-7">

          <!-- Billing & Shipping Details -->
          <div class="checkout-box">
            <h5 class="checkout-box-title">
              <i class="fa-solid fa-location-dot"></i> Billing &amp; Shipping Details
            </h5>
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="checkout-label">First Name *</label>
                <input type="text" name="billing_first_name" class="form-control" value="{{ old('billing_first_name', auth()->user()->name ?? '') }}" required>
              </div>
              <div class="col-sm-6">
                <label class="checkout-label">Last Name *</label>
                <input type="text" name="billing_last_name" class="form-control" value="{{ old('billing_last_name') }}" required>
              </div>
              <div class="col-sm-6">
                <label class="checkout-label">Email Address *</label>
                <input type="email" name="billing_email" class="form-control" value="{{ old('billing_email', auth()->user()->email ?? '') }}" required>
              </div>
              <div class="col-sm-6">
                <label class="checkout-label">Phone Number *</label>
                <input type="tel" name="billing_phone" class="form-control" placeholder="+91" value="{{ old('billing_phone', auth()->user()->phone ?? '') }}" required>
              </div>
              <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <label class="checkout-label mb-0">Street Address *</label>
                  <button type="button" class="btn btn-sm btn-outline-success d-inline-flex align-items-center gap-1" id="detectLocationBtn" onclick="detectCurrentLocation()" style="font-size:0.75rem;padding:3px 10px;border-radius:20px;font-weight:600;">
                    <i class="fa-solid fa-location-crosshairs" id="detectLocationIcon"></i>
                    <span id="detectLocationText">Detect Location</span>
                  </button>
                </div>
                <input type="text" name="billing_address" id="billingAddress" class="form-control" placeholder="House / Flat #, Street name, Area" value="{{ old('billing_address') }}" required>
              </div>
              <div class="col-12 col-md-4">
                <label class="checkout-label">Country *</label>
                <select name="billing_country" id="billingCountry" class="form-select" required>
                  <option value="India" selected>India</option>
                  <option value="United States">United States</option>
                  <option value="United Kingdom">United Kingdom</option>
                  <option value="UAE">UAE</option>
                  <option value="Canada">Canada</option>
                  <option value="Australia">Australia</option>
                </select>
              </div>
              <div class="col-6 col-md-4">
                <label class="checkout-label">State *</label>
                <select name="billing_state" id="billingStateSelect" class="form-select" required>
                  <option value="">Select State</option>
                </select>
                <input type="text" name="billing_state_custom" id="billingStateInput" class="form-control d-none" placeholder="State / Province">
              </div>
              <div class="col-6 col-md-4">
                <label class="checkout-label">City *</label>
                <select name="billing_city" id="billingCitySelect" class="form-select" required>
                  <option value="">Select or Type City</option>
                </select>
              </div>
              <div class="col-12 col-md-4">
                <label class="checkout-label">PIN Code *</label>
                <div class="position-relative">
                  <input type="text" name="billing_postal_code" id="billingPostalCode" class="form-control" placeholder="6-digit PIN" maxlength="10" value="{{ old('billing_postal_code') }}" required>
                  <span id="pinLoadingSpinner" class="spinner-border spinner-border-sm text-success position-absolute" style="right:12px;top:14px;display:none;"></span>
                </div>
                <small id="pinFeedback" class="text-muted d-block mt-1" style="font-size:0.75rem;"></small>
              </div>
            </div>

            <div class="form-check mt-3 pt-2">
              <input class="form-check-input custom-radio" type="checkbox" name="same_as_billing" id="sameAsBilling" value="1" checked>
              <label class="form-check-label small fw-500 ms-1" for="sameAsBilling">Shipping address is the same as billing address</label>
            </div>
          </div>

          <!-- Shipping Method -->
          <div class="checkout-box">
            <h5 class="checkout-box-title">
              <i class="fa-solid fa-truck-fast"></i> Shipping Method
            </h5>
            @foreach($shippingMethods as $method)
            <label class="shipping-pill-card d-flex justify-content-between align-items-center {{ $loop->first ? 'selected' : '' }}" for="ship_{{ $method->id }}">
              <div class="d-flex align-items-center gap-3">
                <input type="radio" name="shipping_method_id" id="ship_{{ $method->id }}" value="{{ $method->id }}" {{ $loop->first ? 'checked' : '' }} required class="custom-radio">
                <div>
                  <div class="fw-700 small text-dark">{{ $method->name }}</div>
                  <div class="text-muted" style="font-size:0.75rem;">{{ $method->description }} · {{ $method->estimated_days }}</div>
                </div>
              </div>
              <span class="fw-800 small text-dark">
                @if($method->free_above && $subtotal >= $method->free_above)
                  <span class="text-success fw-700">Free</span>
                @else
                  ₹{{ number_format($method->price, 0) }}
                @endif
              </span>
            </label>
            @endforeach
          </div>

          <!-- Payment Method -->
          <div class="checkout-box">
            <h5 class="checkout-box-title">
              <i class="fa-solid fa-credit-card"></i> Payment Method
            </h5>

            <!-- COD -->
            <label class="payment-pill-card selected" for="pay_cod">
              <input type="radio" name="payment_method" id="pay_cod" value="cod" checked class="custom-radio">
              <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2">
                  <i class="fa-solid fa-money-bill-wave text-success fs-6"></i>
                  <strong class="text-dark">Cash on Delivery (COD)</strong>
                </div>
                <p class="text-muted small mb-0 mt-1">Pay comfortably in cash or UPI upon delivery at your doorstep.</p>
              </div>
            </label>

            <!-- Razorpay (UPI, QR, Cards, NetBanking) -->
            <label class="payment-pill-card" for="pay_razorpay">
              <input type="radio" name="payment_method" id="pay_razorpay" value="razorpay" class="custom-radio">
              <div class="flex-grow-1">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                  <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-bolt text-warning fs-6"></i>
                    <strong class="text-dark">Razorpay (Instant UPI / Cards / NetBanking)</strong>
                  </div>
                  <span class="badge bg-light text-dark border px-2 py-1" style="font-size:0.75rem; font-weight:700;">
                    <i class="fa-solid fa-qrcode text-primary me-1"></i> UPI / GPay / PhonePe / Paytm
                  </span>
                </div>
                <p class="text-muted small mb-0 mt-1">Instant payment via UPI QR, Google Pay, PhonePe, Paytm, RuPay, All Debit &amp; Credit Cards.</p>
              </div>
            </label>

            <!-- Stripe -->
            <label class="payment-pill-card" for="pay_stripe">
              <input type="radio" name="payment_method" id="pay_stripe" value="stripe" class="custom-radio">
              <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2">
                  <i class="fa-brands fa-cc-visa text-primary fs-6"></i>
                  <i class="fa-brands fa-cc-mastercard text-warning fs-6"></i>
                  <strong class="text-dark">Credit / Debit Card</strong>
                </div>
                <p class="text-muted small mb-0 mt-1">Pay securely online via Stripe. Supports Visa, MasterCard, RuPay, and NetBanking.</p>
              </div>
            </label>

            <!-- PayPal -->
            <label class="payment-pill-card" for="pay_paypal">
              <input type="radio" name="payment_method" id="pay_paypal" value="paypal" class="custom-radio">
              <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2">
                  <i class="fa-brands fa-paypal text-primary fs-6"></i>
                  <strong class="text-dark">PayPal</strong>
                </div>
                <p class="text-muted small mb-0 mt-1">Pay securely through your PayPal wallet or connected cards.</p>
              </div>
            </label>
          </div>

          <!-- Notes -->
          <div class="checkout-box">
            <h5 class="checkout-box-title">
              <i class="fa-regular fa-note-sticky"></i> Order Notes (Optional)
            </h5>
            <textarea name="notes" class="form-control" rows="3" placeholder="Special delivery instructions, landmarks, or preferences..."></textarea>
          </div>

          <!-- Bottom Action Buttons in Form Flow -->
          <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mt-4 mb-4">
            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius:8px; font-weight:600; text-decoration:none;">
              <i class="fa-solid fa-arrow-left me-1"></i> Return to Cart
            </a>
            <button type="submit" class="btn btn-primary px-5 py-3 d-inline-flex align-items-center gap-2" style="background:#142D4E; border-color:#142D4E; border-radius:8px; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; font-size:0.95rem; box-shadow:0 4px 14px rgba(20,45,78,0.25);">
              <span>Place Order</span>
              <i class="fa-solid fa-arrow-right"></i>
            </button>
          </div>
        </div>

        <!-- Right Column: Order Summary -->
        <div class="col-lg-5">
          <div class="checkout-summary-box">
            <h5 class="checkout-box-title" style="margin-bottom:16px;">Order Summary</h5>
            
            <div class="summary-items-scroll">
              @foreach($cart as $item)
              <div class="summary-item-row">
                <div class="summary-item-thumb">
                  <img src="{{ $item['thumbnail'] }}" alt="{{ $item['name'] }}">
                  <span class="summary-qty-bubble">{{ $item['quantity'] }}</span>
                </div>
                <div class="flex-grow-1 min-w-0">
                  <div class="fw-600 small text-truncate text-dark" title="{{ $item['name'] }}">{{ $item['name'] }}</div>
                  <div class="text-muted small">₹{{ number_format($item['price'], 0) }} each</div>
                </div>
                <div class="fw-800 small text-end text-dark text-nowrap">
                  ₹{{ number_format($item['price'] * $item['quantity'], 0) }}
                </div>
              </div>
              @endforeach
            </div>

            <!-- Price Breakdown -->
            <div class="pt-2 border-top">
              <div class="summary-calc-row">
                <span>Subtotal</span>
                <span class="fw-700 text-dark">₹{{ number_format($subtotal, 0) }}</span>
              </div>
              @if($discount > 0)
              <div class="summary-calc-row">
                <span>Discount ({{ $coupon['code'] }})</span>
                <span class="text-success fw-700">-₹{{ number_format($discount, 0) }}</span>
              </div>
              @endif
              <div class="summary-calc-row">
                <span>Shipping</span>
                <span id="shippingDisplay" class="fw-700 text-dark">—</span>
              </div>
              <div class="summary-total-row">
                <span>Total Amount</span>
                <span id="grandTotal">₹{{ number_format($subtotal - $discount, 0) }}</span>
              </div>
            </div>

            <button type="submit" class="btn-place-order d-none d-lg-flex">
              <i class="fa-solid fa-lock me-1"></i> Place Order Now
            </button>
            <p class="text-center text-muted small mt-3 mb-0" style="font-size:0.75rem;">
              <i class="fa-solid fa-shield-halved me-1 text-success"></i> 100% Secure Checkout &amp; Data Privacy
            </p>
          </div>
        </div>
      </div>

      <!-- Mobile Fixed Bottom Place Order Bar -->
      <div class="checkout-mobile-sticky-bar d-lg-none">
        <div class="checkout-mobile-sticky-total">
          <span class="label">Total Amount</span>
          <span class="amount" id="mobileStickyGrandTotal">₹{{ number_format($subtotal - $discount, 0) }}</span>
        </div>
        <button type="submit" class="checkout-mobile-sticky-btn">
          <i class="fa-solid fa-lock me-1"></i>
          <span>Place Order</span>
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
// India States & UTs List
const indianStates = [
  "Andaman and Nicobar Islands", "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar",
  "Chandigarh", "Chhattisgarh", "Dadra and Nagar Haveli and Daman and Diu", "Delhi", "Goa",
  "Gujarat", "Haryana", "Himachal Pradesh", "Jammu and Kashmir", "Jharkhand", "Karnataka",
  "Kerala", "Ladakh", "Lakshadweep", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya",
  "Mizoram", "Nagaland", "Odisha", "Puducherry", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu",
  "Telangana", "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal"
];

const stateSelect = document.getElementById('billingStateSelect');
const stateInput  = document.getElementById('billingStateInput');
const countrySelect = document.getElementById('billingCountry');
const citySelect  = document.getElementById('billingCitySelect');
const pinInput    = document.getElementById('billingPostalCode');
const pinSpinner  = document.getElementById('pinLoadingSpinner');
const pinFeedback = document.getElementById('pinFeedback');

// Populate Indian states
function populateStates(selectedState = '{{ old("billing_state", "Punjab") }}') {
  stateSelect.innerHTML = '<option value="">Select State</option>';
  indianStates.forEach(state => {
    const opt = document.createElement('option');
    opt.value = state;
    opt.textContent = state;
    if (state.toLowerCase() === (selectedState || '').toLowerCase()) {
      opt.selected = true;
    }
    stateSelect.appendChild(opt);
  });
}
populateStates();

// Global cache of cities by state
const citiesCache = {};

// Fetch and populate cities for selected Indian State
function loadCitiesForState(stateName, preselectedCity = '') {
  if (!stateName || countrySelect.value !== 'India') return;
  const $city = $('#billingCitySelect');

  // If already cached, populate immediately
  if (citiesCache[stateName]) {
    renderCitiesOptions(citiesCache[stateName], preselectedCity);
    return;
  }

  $city.empty().append(new Option('Loading cities...', '', false, false));
  $city.trigger('change');

  fetch('https://countriesnow.space/api/v0.1/countries/state/cities', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ country: 'India', state: stateName })
  })
  .then(r => r.json())
  .then(res => {
    if (res && !res.error && res.data && res.data.length > 0) {
      citiesCache[stateName] = res.data.sort();
      renderCitiesOptions(citiesCache[stateName], preselectedCity);
    } else {
      renderCitiesOptions([], preselectedCity);
    }
  })
  .catch(() => {
    renderCitiesOptions([], preselectedCity);
  });
}

function renderCitiesOptions(cityList, preselectedCity = '') {
  const $city = $('#billingCitySelect');
  $city.empty().append(new Option('Search or Select City', '', false, false));

  let matched = false;
  const normalizedPre = (preselectedCity || '').trim().toLowerCase();

  cityList.forEach(cityName => {
    const isSelected = normalizedPre && (cityName.toLowerCase() === normalizedPre);
    if (isSelected) matched = true;
    const opt = new Option(cityName, cityName, isSelected, isSelected);
    $city.append(opt);
  });

  // If preselectedCity wasn't in list (or list was empty), add it and select it
  if (preselectedCity && !matched) {
    const customOpt = new Option(preselectedCity, preselectedCity, true, true);
    $city.append(customOpt);
  }

  $city.trigger('change');
}

// Initialize Select2 on State, Country, and City (all fully searchable)
$(document).ready(function() {
  $('#billingCountry').select2({
    placeholder: 'Select Country',
    width: '100%'
  });

  $('#billingStateSelect').select2({
    placeholder: 'Search or Select State',
    width: '100%'
  });

  $('#billingCitySelect').select2({
    placeholder: 'Search or Select City',
    tags: false, // Only allow selecting valid cities from the list
    width: '100%'
  });

  // When State changes, auto-load cities of that State
  $('#billingStateSelect').on('change', function() {
    const selectedState = $(this).val();
    loadCitiesForState(selectedState);
  });

  // Initial load of cities for default selected state (e.g. Punjab)
  const initialSelectedState = $('#billingStateSelect').val();
  if (initialSelectedState) {
    loadCitiesForState(initialSelectedState);
  }

  // Country change handler
  $('#billingCountry').on('change', function() {
    const val = $(this).val();
    if (val === 'India') {
      $('#billingStateSelect').next('.select2-container').show();
      $('#billingStateSelect').prop('required', true).attr('name', 'billing_state');
      $('#billingStateInput').addClass('d-none').prop('required', false).attr('name', 'billing_state_custom');
      loadCitiesForState($('#billingStateSelect').val());
    } else {
      $('#billingStateSelect').next('.select2-container').hide();
      $('#billingStateSelect').prop('required', false).attr('name', 'billing_state_dropdown');
      $('#billingStateInput').removeClass('d-none').prop('required', true).attr('name', 'billing_state');
    }
  });
});

// Auto-fill City & State using free Postal Pincode API
let pinDebounceTimer;
pinInput.addEventListener('input', function() {
  const pin = this.value.trim().replace(/\D/g, '');
  if (countrySelect.value !== 'India' || pin.length !== 6) {
    pinFeedback.textContent = '';
    return;
  }

  clearTimeout(pinDebounceTimer);
  pinDebounceTimer = setTimeout(() => {
    pinSpinner.style.display = 'inline-block';
    pinFeedback.textContent = 'Looking up pincode...';
    pinFeedback.className = 'text-muted';

    fetch(`https://api.postalpincode.in/pincode/${pin}`)
      .then(r => r.json())
      .then(data => {
        pinSpinner.style.display = 'none';
        if (data && data[0] && data[0].Status === 'Success' && data[0].PostOffice && data[0].PostOffice.length > 0) {
          const poList = data[0].PostOffice;
          const firstPO = poList[0];
          const stateName = firstPO.State;
          const districtName = firstPO.District;

          // Select matching state & notify Select2
          Array.from(stateSelect.options).forEach(opt => {
            if (opt.value.toLowerCase() === stateName.toLowerCase()) {
              opt.selected = true;
            }
          });
          $('#billingStateSelect').trigger('change');

          // Populate searchable Select2 City options with local post office areas & district
          const $city = $('#billingCitySelect');
          $city.empty().append(new Option('Select or Type City', '', false, false));

          // Add district itself as default option
          const districtOpt = new Option(districtName, districtName, true, true);
          $city.append(districtOpt);

          const uniquePlaces = new Set();
          uniquePlaces.add(districtName.toLowerCase());

          poList.forEach(po => {
            if (po.Name && !uniquePlaces.has(po.Name.toLowerCase())) {
              uniquePlaces.add(po.Name.toLowerCase());
              const label = `${po.Name}, ${districtName}`;
              const opt = new Option(label, label, false, false);
              $city.append(opt);
            }
          });

          // Trigger Select2 update
          $city.trigger('change');

          pinFeedback.textContent = `✓ ${districtName}, ${stateName}`;
          pinFeedback.className = 'text-success';
        } else {
          pinFeedback.textContent = 'Pincode not found. Please select or type city manually.';
          pinFeedback.className = 'text-danger';
        }
      })
      .catch(() => {
        pinSpinner.style.display = 'none';
        pinFeedback.textContent = '';
      });
  }, 350);
});

// If pincode already prefilled, trigger lookup
if (pinInput.value.trim().length === 6) {
  pinInput.dispatchEvent(new Event('input'));
}

// Reverse geocode lat/lon and fill fields
function reverseGeocodeAndFill(lat, lon, btn, icon, label, addressField) {
  fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`)
    .then(r => r.json())
    .then(data => {
      btn.disabled = false;
      label.textContent = 'Detect Location';
      icon.className = 'bi bi-geo-alt-fill text-success';

      if (data && data.address) {
        const addr = data.address;
        
        // Build detailed street address
        const streetParts = [
          addr.road || addr.street || addr.neighbourhood || addr.suburb || '',
          addr.residential || addr.city_district || ''
        ].filter(Boolean);
        if (streetParts.length > 0) {
          addressField.value = streetParts.join(', ');
        } else if (data.display_name) {
          addressField.value = data.display_name.split(',').slice(0, 3).join(',').trim();
        }

        // Fill Country
        if (addr.country) {
          $('#billingCountry').val('India').trigger('change');
        }

        // Detect City name
        const detectedCity = addr.city || addr.town || addr.village || addr.county || addr.district || '';

        // Fill State & pass City to be preselected once state cities load
        const state = addr.state;
        if (state) {
          Array.from(stateSelect.options).forEach(opt => {
            if (opt.value.toLowerCase() === state.toLowerCase()) {
              opt.selected = true;
            }
          });
          $('#billingStateSelect').trigger('change');
          loadCitiesForState(state, detectedCity);
        } else if (detectedCity) {
          const currentSt = $('#billingStateSelect').val();
          loadCitiesForState(currentSt, detectedCity);
        }

        // Fill PIN code
        if (addr.postcode) {
          const cleanPin = addr.postcode.replace(/\D/g, '').slice(0, 6);
          if (cleanPin.length === 6) {
            pinInput.value = cleanPin;
            pinInput.dispatchEvent(new Event('input'));
          }
        }

        showToast('Location detected successfully!', 'success');
      } else {
        showToast('Could not fetch address details for this location.', 'error');
      }
    })
    .catch(() => {
      btn.disabled = false;
      label.textContent = 'Detect Location';
      icon.className = 'bi bi-geo-alt-fill text-success';
      showToast('Failed to connect to location services.', 'error');
    });
}

// Fallback to IP geolocation if GPS hardware/satellite times out on phone
function fallbackIpLocation(btn, icon, label, addressField) {
  fetch('https://ipapi.co/json/')
    .then(r => r.json())
    .then(data => {
      btn.disabled = false;
      label.textContent = 'Detect Location';
      icon.className = 'bi bi-geo-alt-fill text-success';

      if (data && (data.city || data.region)) {
        if (data.city && addressField && !addressField.value) {
          addressField.value = data.city;
        }
        if (data.country_name === 'India') {
          $('#billingCountry').val('India').trigger('change');
        }
        if (data.postal) {
          const cleanPin = data.postal.replace(/\D/g, '').slice(0, 6);
          if (cleanPin.length === 6) {
            pinInput.value = cleanPin;
            pinInput.dispatchEvent(new Event('input'));
          }
        }
        if (data.region) {
          Array.from(stateSelect.options).forEach(opt => {
            if (opt.value.toLowerCase() === data.region.toLowerCase()) {
              opt.selected = true;
            }
          });
          $('#billingStateSelect').trigger('change');
          loadCitiesForState(data.region, data.city || '');
        }
        showToast('Approximate location detected via network!', 'success');
      } else {
        alert('Unable to retrieve location. Please check your GPS or internet connection.');
      }
    })
    .catch(() => {
      btn.disabled = false;
      label.textContent = 'Detect Location';
      icon.className = 'bi bi-geo-alt-fill text-success';
      alert('Unable to retrieve location. Please check your GPS or internet connection.');
    });
}

// Detect Current Location using HTML5 Geolocation with automatic low-accuracy & IP fallback
function detectCurrentLocation() {
  const btn = document.getElementById('detectLocationBtn');
  const icon = document.getElementById('detectLocationIcon');
  const label = document.getElementById('detectLocationText');
  const addressField = document.getElementById('billingAddress');

  if (!navigator.geolocation) {
    fallbackIpLocation(btn, icon, label, addressField);
    return;
  }

  btn.disabled = true;
  label.textContent = 'Detecting...';
  icon.className = 'spinner-border spinner-border-sm';

  // Try GPS with high accuracy first
  navigator.geolocation.getCurrentPosition(
    function(pos) {
      reverseGeocodeAndFill(pos.coords.latitude, pos.coords.longitude, btn, icon, label, addressField);
    },
    function(err) {
      if (err.code === 1) { // PERMISSION_DENIED
        btn.disabled = false;
        label.textContent = 'Detect Location';
        icon.className = 'bi bi-geo-alt-fill text-success';
        alert('Location permission was denied. Please allow location access in your phone browser settings.');
        return;
      }

      // If high accuracy failed (e.g. timeout indoors on phones), try low accuracy (cell tower / wifi triangulation)
      navigator.geolocation.getCurrentPosition(
        function(pos2) {
          reverseGeocodeAndFill(pos2.coords.latitude, pos2.coords.longitude, btn, icon, label, addressField);
        },
        function(err2) {
          // If browser geolocation still fails, fallback smoothly to IP geolocation
          fallbackIpLocation(btn, icon, label, addressField);
        },
        { enableHighAccuracy: false, timeout: 8000, maximumAge: 60000 }
      );
    },
    { enableHighAccuracy: true, timeout: 6000, maximumAge: 30000 }
  );
}

// Payment method selection UI
document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
  radio.addEventListener('change', function() {
    document.querySelectorAll('.payment-pill-card').forEach(o => {
      o.classList.remove('selected');
    });
    const parentCard = this.closest('.payment-pill-card');
    if (parentCard) parentCard.classList.add('selected');
  });
});

// Shipping cost update
const shippingPrices = {
  @foreach($shippingMethods as $method)
    {{ $method->id }}: {{ ($method->free_above && $subtotal >= $method->free_above) ? 0 : $method->price }},
  @endforeach
};
const subtotal = {{ $subtotal - $discount }};

document.querySelectorAll('input[name="shipping_method_id"]').forEach(radio => {
  radio.addEventListener('change', function() {
    const price = shippingPrices[this.value] || 0;
    const formattedTotal = '₹' + Math.round(subtotal + price).toLocaleString('en-IN');
    document.getElementById('shippingDisplay').textContent = price === 0 ? 'Free' : '₹' + Math.round(price).toLocaleString('en-IN');
    document.getElementById('grandTotal').textContent = formattedTotal;
    const mobileStickyTotal = document.getElementById('mobileStickyGrandTotal');
    if (mobileStickyTotal) {
      mobileStickyTotal.textContent = formattedTotal;
    }

    document.querySelectorAll('.shipping-pill-card').forEach(o => o.classList.remove('selected'));
    const parentCard = this.closest('.shipping-pill-card');
    if (parentCard) parentCard.classList.add('selected');
  });
});

// Set initial shipping
const firstShip = document.querySelector('input[name="shipping_method_id"]:checked');
if (firstShip) firstShip.dispatchEvent(new Event('change'));
</script>
@endpush


