@extends('frontend.layouts.app')
@section('title', 'Checkout — Durable Suitcase House')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
/* Select2 Durable Suitcase House Custom Theme */
.select2-container--default .select2-selection--single {
  border: 1px solid #cbd5e1 !important;
  border-radius: 6px !important;
  height: 44px !important;
  display: flex !important;
  align-items: center !important;
  padding: 0 8px !important;
  background: #fff !important;
}
.select2-container--default .select2-selection--single:focus,
.select2-container--default.select2-container--open .select2-selection--single {
  border-color: var(--dsh-navy-light) !important;
  box-shadow: 0 0 0 3px rgba(45, 90, 39, 0.12) !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
  color: var(--dark) !important;
  font-size: 0.9rem !important;
  line-height: normal !important;
  padding-left: 4px !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 42px !important;
  right: 8px !important;
}
.select2-dropdown {
  border: 1px solid #cbd5e1 !important;
  border-radius: 8px !important;
  box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
  z-index: 9999 !important;
}
.select2-container--default .select2-search--dropdown .select2-search__field {
  border: 1px solid #cbd5e1 !important;
  border-radius: 6px !important;
  padding: 8px 12px !important;
  outline: none !important;
}
.select2-container--default .select2-search--dropdown .select2-search__field:focus {
  border-color: var(--dsh-navy-light) !important;
}
.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
  background-color: var(--dsh-navy-light) !important;
  color: #fff !important;
}
.select2-container--default .select2-results__option--selected {
  background-color: #eef4ec !important;
  color: var(--dsh-navy) !important;
  font-weight: 600 !important;
}
.select2-container {
  width: 100% !important;
}

.checkout-hero {
  background: var(--pd-ice);
  padding: 36px 0 28px;
}
.checkout-steps {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-top: 16px;
  flex-wrap: wrap;
}
.checkout-step {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.82rem;
  font-weight: 600;
  color: #718096;
}
.checkout-step.active {
  color: var(--dsh-navy);
}
.checkout-step-num {
  width: 24px;
  height: 24px;
  border-radius: 50%;
  background: #e2e8f0;
  color: #718096;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.72rem;
  font-weight: 700;
}
.checkout-step.active .checkout-step-num {
  background: var(--dsh-navy-light);
  color: #fff;
}
.checkout-step-line {
  flex: 1;
  height: 1px;
  background: #cbd5e1;
  max-width: 40px;
}

.checkout-card {
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 10px;
  padding: 24px;
  margin-bottom: 24px;
}
.checkout-card-title {
  font-family: var(--font-serif);
  font-size: 1.2rem;
  font-weight: 600;
  color: var(--dsh-navy);
  margin-bottom: 18px;
  padding-bottom: 10px;
  border-bottom: 1px solid #edf1eb;
}

.checkout-summary-card {
  background: var(--pd-ice);
  padding: 24px;
  border-radius: 10px;
  border: 1px solid rgba(27,56,43,0.08);
  position: sticky;
  top: 90px;
}

.payment-option {
  border: 1.5px solid var(--border);
  border-radius: 8px;
  padding: 14px 16px;
  margin-bottom: 12px;
  cursor: pointer;
  transition: all 0.2s;
  background: #fff;
}
.payment-option.selected {
  border-color: var(--dsh-navy-light);
  background: rgba(45, 90, 39, 0.03);
}

.shipping-option {
  border: 1.5px solid var(--border);
  border-radius: 8px;
  padding: 14px 16px;
  margin-bottom: 10px;
  cursor: pointer;
  transition: all 0.2s;
  background: #fff;
}
.shipping-option.selected {
  border-color: var(--dsh-navy-light);
  background: rgba(45, 90, 39, 0.03);
}

.form-control, .form-select {
  border-radius: 6px !important;
  border-color: #cbd5e1;
  padding: 10px 14px;
  font-size: 0.9rem;
}
.form-control:focus, .form-select:focus {
  border-color: var(--dsh-navy-light);
  box-shadow: 0 0 0 3px rgba(45, 90, 39, 0.12);
}

@media (max-width: 991px) {
  body {
    padding-bottom: 125px !important; /* Space for sticky place order bar & bottom nav */
  }
  .checkout-mobile-sticky-bar {
    display: flex !important;
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
  .checkout-mobile-sticky-total {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
  }
  .checkout-mobile-sticky-total .label {
    font-size: 0.68rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #64748b;
  }
  .checkout-mobile-sticky-total .amount {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--dsh-navy);
  }
  .checkout-mobile-sticky-btn {
    flex: 1;
    max-width: 210px;
    padding: 11px 16px;
    font-size: 0.85rem;
    border-radius: 6px;
    justify-content: center;
  }
  .checkout-card {
    padding: 18px 14px;
    margin-bottom: 16px;
  }
  .checkout-summary-card {
    position: static;
    padding: 20px 16px;
  }
  .checkout-hero {
    padding: 24px 0 20px;
  }
  .checkout-hero h1 {
    font-size: 1.6rem !important;
  }
  .checkout-step-line {
    max-width: 20px;
  }
}

.checkout-mobile-sticky-bar {
  display: none;
}
</style>
@endpush

@section('content')
<div class="checkout-hero">
  <div class="container-xl-custom">
    <h1 style="font-family:var(--font-serif);font-size:2rem;font-weight:400;margin-bottom:4px;">Checkout</h1>
    <div class="checkout-steps">
      <div class="checkout-step">
        <div class="checkout-step-num"><i class="bi bi-check"></i></div>
        <span>Cart</span>
      </div>
      <div class="checkout-step-line"></div>
      <div class="checkout-step active">
        <div class="checkout-step-num">2</div>
        <span>Details &amp; Payment</span>
      </div>
      <div class="checkout-step-line"></div>
      <div class="checkout-step">
        <div class="checkout-step-num">3</div>
        <span>Confirmation</span>
      </div>
    </div>
  </div>
</div>

<div class="container-xl-custom py-4 py-md-5">
  <form method="POST" action="{{ route('checkout.place-order') }}" id="checkoutForm">
    @csrf
    <div class="row g-4 g-lg-5">
      <!-- Left: Billing + Shipping + Payment -->
      <div class="col-lg-7">

        <!-- Billing Details -->
        <div class="checkout-card">
          <h5 class="checkout-card-title">
            <i class="bi bi-geo-alt me-1 text-ayur-leaf"></i> Billing &amp; Shipping Details
          </h5>
          <div class="row g-3">
            <div class="col-sm-6">
              <label class="small fw-600 d-block mb-1 text-muted">First Name *</label>
              <input type="text" name="billing_first_name" class="form-control" value="{{ old('billing_first_name', auth()->user()->name) }}" required>
            </div>
            <div class="col-sm-6">
              <label class="small fw-600 d-block mb-1 text-muted">Last Name *</label>
              <input type="text" name="billing_last_name" class="form-control" value="{{ old('billing_last_name') }}" required>
            </div>
            <div class="col-sm-6">
              <label class="small fw-600 d-block mb-1 text-muted">Email Address *</label>
              <input type="email" name="billing_email" class="form-control" value="{{ old('billing_email', auth()->user()->email) }}" required>
            </div>
            <div class="col-sm-6">
              <label class="small fw-600 d-block mb-1 text-muted">Phone Number *</label>
              <input type="tel" name="billing_phone" class="form-control" placeholder="+91" value="{{ old('billing_phone', auth()->user()->phone) }}" required>
            </div>
            <div class="col-12">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <label class="small fw-600 text-muted mb-0">Street Address *</label>
                <button type="button" class="btn btn-sm btn-outline-success d-inline-flex align-items-center gap-1" id="detectLocationBtn" onclick="detectCurrentLocation()" style="font-size:0.75rem;padding:3px 10px;border-radius:20px;font-weight:600;">
                  <i class="bi bi-geo-alt-fill text-success" id="detectLocationIcon"></i>
                  <span id="detectLocationText">Detect Location</span>
                </button>
              </div>
              <input type="text" name="billing_address" id="billingAddress" class="form-control" placeholder="House #, Street name, Area" value="{{ old('billing_address') }}" required>
            </div>
            <div class="col-12 col-md-4">
              <label class="small fw-600 d-block mb-1 text-muted">Country *</label>
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
              <label class="small fw-600 d-block mb-1 text-muted">State *</label>
              <select name="billing_state" id="billingStateSelect" class="form-select" required>
                <option value="">Select State</option>
              </select>
              <input type="text" name="billing_state_custom" id="billingStateInput" class="form-control d-none" placeholder="State / Province">
            </div>
            <div class="col-6 col-md-4">
              <label class="small fw-600 d-block mb-1 text-muted">City *</label>
              <select name="billing_city" id="billingCitySelect" class="form-select" required>
                <option value="">Select or Type City</option>
              </select>
            </div>
            <div class="col-12 col-md-4">
              <label class="small fw-600 d-block mb-1 text-muted">PIN Code *</label>
              <div class="position-relative">
                <input type="text" name="billing_postal_code" id="billingPostalCode" class="form-control" placeholder="6-digit PIN" maxlength="10" value="{{ old('billing_postal_code') }}" required>
                <span id="pinLoadingSpinner" class="spinner-border spinner-border-sm text-success position-absolute" style="right:12px;top:13px;display:none;"></span>
              </div>
              <small id="pinFeedback" class="text-muted" style="font-size:0.75rem;"></small>
            </div>
          </div>

          <div class="form-check mt-3 pt-1">
            <input class="form-check-input" type="checkbox" name="same_as_billing" id="sameAsBilling" value="1" checked>
            <label class="form-check-label small" for="sameAsBilling">Shipping address is the same as billing address</label>
          </div>
        </div>

        <!-- Shipping Method -->
        <div class="checkout-card">
          <h5 class="checkout-card-title">
            <i class="bi bi-truck me-1 text-ayur-leaf"></i> Shipping Method
          </h5>
          @foreach($shippingMethods as $method)
          <label class="shipping-option d-flex justify-content-between align-items-center {{ $loop->first ? 'selected' : '' }}" for="ship_{{ $method->id }}">
            <div class="d-flex align-items-center gap-3">
              <input type="radio" name="shipping_method_id" id="ship_{{ $method->id }}" value="{{ $method->id }}" {{ $loop->first ? 'checked' : '' }} required class="shipping-radio">
              <div>
                <div class="fw-600 small text-dark">{{ $method->name }}</div>
                <div class="text-muted" style="font-size:0.75rem;">{{ $method->description }} · {{ $method->estimated_days }}</div>
              </div>
            </div>
            <span class="fw-700 small">
              @if($method->free_above && $subtotal >= $method->free_above)
                <span class="text-success">Free</span>
              @else
                ₨{{ number_format($method->price, 2) }}
              @endif
            </span>
          </label>
          @endforeach
        </div>

        <!-- Payment Method -->
        <div class="checkout-card">
          <h5 class="checkout-card-title">
            <i class="bi bi-credit-card me-1 text-ayur-leaf"></i> Payment Method
          </h5>

          <!-- COD -->
          <label class="payment-option d-flex align-items-start gap-3 selected" for="pay_cod">
            <input type="radio" name="payment_method" id="pay_cod" value="cod" checked class="mt-1">
            <div class="flex-grow-1">
              <div class="d-flex align-items-center gap-2">
                <i class="bi bi-cash-stack text-success" style="font-size:1.15rem;"></i>
                <strong class="text-dark">Cash on Delivery (COD)</strong>
              </div>
              <p class="text-muted small mb-0 mt-1">Pay with cash when your package arrives at your doorstep.</p>
            </div>
          </label>

          <!-- Stripe -->
          <label class="payment-option d-flex align-items-start gap-3" for="pay_stripe">
            <input type="radio" name="payment_method" id="pay_stripe" value="stripe" class="mt-1">
            <div class="flex-grow-1">
              <div class="d-flex align-items-center gap-2">
                <i class="bi bi-credit-card text-primary" style="font-size:1.15rem;"></i>
                <strong class="text-dark">Credit / Debit Card</strong>
              </div>
              <p class="text-muted small mb-0 mt-1">Secure card payment via Stripe. Visa, Mastercard, RuPay accepted.</p>
              <div id="stripeForm" style="display:none; margin-top:12px;">
                <div id="card-element" style="border:1px solid var(--border); padding:12px; background:#fff; border-radius:6px;"></div>
                <div id="card-errors" class="text-danger small mt-1"></div>
              </div>
            </div>
          </label>

          <!-- PayPal -->
          <label class="payment-option d-flex align-items-start gap-3" for="pay_paypal">
            <input type="radio" name="payment_method" id="pay_paypal" value="paypal" class="mt-1">
            <div class="flex-grow-1">
              <div class="d-flex align-items-center gap-2">
                <i class="bi bi-paypal text-primary" style="font-size:1.15rem;"></i>
                <strong class="text-dark">PayPal</strong>
              </div>
              <p class="text-muted small mb-0 mt-1">You will be redirected safely to PayPal to complete your payment.</p>
            </div>
          </label>
        </div>

        <!-- Notes -->
        <div class="checkout-card">
          <h5 class="checkout-card-title">
            <i class="bi bi-pencil me-1 text-ayur-leaf"></i> Order Notes (Optional)
          </h5>
          <textarea name="notes" class="form-control" rows="3" placeholder="Notes about your order, delivery landmarks, etc."></textarea>
        </div>
      </div>

      <!-- Right: Order Summary -->
      <div class="col-lg-5">
        <div class="checkout-summary-card">
          <h5 style="font-family:var(--font-serif);font-size:1.25rem;font-weight:600;color:var(--dsh-navy);margin-bottom:18px;border-bottom:1px solid rgba(27,56,43,0.08);padding-bottom:10px;">
            Order Summary
          </h5>
          <div class="checkout-items-list mb-3" style="max-height:300px;overflow-y:auto;">
            @foreach($cart as $item)
            <div class="d-flex gap-3 mb-3 pb-3" style="border-bottom:1px solid #edf1eb;">
              <div style="position:relative;flex-shrink:0;">
                <img src="{{ $item['thumbnail'] }}" style="width:60px;height:65px;object-fit:contain;background:#fff;border-radius:6px;border:1px solid #e2e8f0;padding:2px;" alt="{{ $item['name'] }}">
                <span style="position:absolute;top:-6px;right:-6px;background:var(--dsh-navy);color:#fff;border-radius:50%;width:20px;height:20px;font-size:0.65rem;display:flex;align-items:center;justify-content:center;font-weight:700;">{{ $item['quantity'] }}</span>
              </div>
              <div class="flex-grow-1 min-w-0">
                <div class="fw-600 small text-truncate text-dark">{{ $item['name'] }}</div>
                <div class="text-muted small">₨{{ number_format($item['price'], 2) }} each</div>
              </div>
              <div class="fw-700 small text-end text-nowrap" style="color:var(--dsh-navy);">
                ₨{{ number_format($item['price'] * $item['quantity'], 2) }}
              </div>
            </div>
            @endforeach
          </div>

          <div class="border-top pt-3">
            <div class="d-flex justify-content-between mb-2 small">
              <span class="text-muted">Subtotal</span>
              <span class="fw-semibold">₨{{ number_format($subtotal, 2) }}</span>
            </div>
            @if($discount > 0)
            <div class="d-flex justify-content-between mb-2 small">
              <span class="text-muted">Discount ({{ $coupon['code'] }})</span>
              <span class="text-success fw-semibold">-₨{{ number_format($discount, 2) }}</span>
            </div>
            @endif
            <div class="d-flex justify-content-between mb-2 small">
              <span class="text-muted">Shipping</span>
              <span id="shippingDisplay" class="fw-semibold">—</span>
            </div>
            <div class="d-flex justify-content-between fw-bold border-top pt-3 mt-2" style="font-size:1.15rem;color:var(--dsh-navy);">
              <span>Total Amount</span>
              <span id="grandTotal">₨{{ number_format($subtotal - $discount, 2) }}</span>
            </div>
          </div>

          <button type="submit" class="btn-glamora w-100 justify-content-center mt-4 d-none d-lg-flex" style="padding:15px;font-size:0.9rem;border-radius:6px;">
            <i class="bi bi-lock me-2"></i> Place Order
          </button>
          <p class="text-center text-muted small mt-2 mb-0" style="font-size:0.75rem;">
            <i class="bi bi-shield-check me-1 text-success"></i> 100% Secure Checkout &amp; Data Privacy
          </p>
        </div>
      </div>
    </div>

    <!-- Mobile Fixed Bottom Place Order Bar -->
    <div class="checkout-mobile-sticky-bar d-lg-none">
      <div class="checkout-mobile-sticky-total">
        <span class="label">Total Amount</span>
        <span class="amount" id="mobileStickyGrandTotal">₨{{ number_format($subtotal - $discount, 2) }}</span>
      </div>
      <button type="submit" class="btn-glamora checkout-mobile-sticky-btn">
        <i class="bi bi-lock me-1"></i>
        <span>Place Order</span>
      </button>
    </div>
  </form>
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
    document.querySelectorAll('.payment-option').forEach(o => {
      o.classList.remove('selected');
    });
    this.closest('.payment-option').classList.add('selected');
    const stripeForm = document.getElementById('stripeForm');
    if (stripeForm) {
      stripeForm.style.display = this.value === 'stripe' ? 'block' : 'none';
    }
  });
});

// Shipping cost update
const shippingPrices = {
  @foreach($shippingMethods as $method)
    {{ $method->id }}: {{ ($method->free_above && $subtotal >= $method->free_above) ? 0 : $method->price }},
  @endforeach
};
const subtotal = {{ $subtotal - $discount }};

document.querySelectorAll('.shipping-radio').forEach(radio => {
  radio.addEventListener('change', function() {
    const price = shippingPrices[this.value] || 0;
    const formattedTotal = '₨' + (subtotal + price).toFixed(2);
    document.getElementById('shippingDisplay').textContent = price === 0 ? 'Free' : '₨' + price.toFixed(2);
    document.getElementById('grandTotal').textContent = formattedTotal;
    const mobileStickyTotal = document.getElementById('mobileStickyGrandTotal');
    if (mobileStickyTotal) {
      mobileStickyTotal.textContent = formattedTotal;
    }

    document.querySelectorAll('.shipping-option').forEach(o => o.classList.remove('selected'));
    this.closest('.shipping-option').classList.add('selected');
  });
});

// Set initial shipping
const firstShip = document.querySelector('.shipping-radio:checked');
if (firstShip) firstShip.dispatchEvent(new Event('change'));
</script>
@endpush


