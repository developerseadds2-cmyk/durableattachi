@extends('admin.layout.app')
@section('title', 'Payment Settings')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.settings.index') }}">Settings</a></li>
  <li class="breadcrumb-item active">Payment</li>
@endsection

@section('content')
<div class="page-header"><h4>Payment Settings</h4></div>

<ul class="nav nav-tabs mb-4">
  <li class="nav-item"><a class="nav-link" href="{{ route('admin.settings.index') }}">General</a></li>
  <li class="nav-item"><a class="nav-link active" href="{{ route('admin.settings.payment') }}">Payment</a></li>
  <li class="nav-item"><a class="nav-link" href="{{ route('admin.settings.email') }}">Email</a></li>
  <li class="nav-item"><a class="nav-link" href="{{ route('admin.settings.seo') }}">SEO</a></li>
</ul>

<form method="POST" action="{{ route('admin.settings.payment.update') }}">
  @csrf
  <div class="row g-4">
    <!-- Stripe -->
    <div class="col-lg-6">
      <div class="form-card">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
          <div class="d-flex align-items-center gap-2">
            <div style="width:32px;height:32px;background:#635bff;border-radius:6px;display:flex;align-items:center;justify-content:center;">
              <span style="color:#fff;font-weight:800;font-size:0.8rem;">S</span>
            </div>
            <h6 class="fw-bold mb-0">Stripe</h6>
          </div>
          <div class="form-check form-switch mb-0">
            <input class="form-check-input" type="checkbox" name="stripe_enabled" value="1" {{ ($settings['stripe_enabled'] ?? '') == '1' ? 'checked' : '' }}>
            <label class="form-check-label small">Enable</label>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Publishable Key</label>
          <input type="text" name="stripe_key" class="form-control" value="{{ $settings['stripe_key'] ?? '' }}" placeholder="pk_live_...">
        </div>
        <div>
          <label class="form-label">Secret Key</label>
          <input type="password" name="stripe_secret" class="form-control" value="{{ $settings['stripe_secret'] ?? '' }}" placeholder="sk_live_...">
        </div>
      </div>
    </div>

    <!-- PayPal -->
    <div class="col-lg-6">
      <div class="form-card">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
          <div class="d-flex align-items-center gap-2">
            <div style="width:32px;height:32px;background:#003087;border-radius:6px;display:flex;align-items:center;justify-content:center;">
              <span style="color:#fff;font-weight:800;font-size:0.8rem;">P</span>
            </div>
            <h6 class="fw-bold mb-0">PayPal</h6>
          </div>
          <div class="form-check form-switch mb-0">
            <input class="form-check-input" type="checkbox" name="paypal_enabled" value="1" {{ ($settings['paypal_enabled'] ?? '') == '1' ? 'checked' : '' }}>
            <label class="form-check-label small">Enable</label>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Client ID</label>
          <input type="text" name="paypal_client_id" class="form-control" value="{{ $settings['paypal_client_id'] ?? '' }}" placeholder="Client ID">
        </div>
        <div class="mb-3">
          <label class="form-label">Client Secret</label>
          <input type="password" name="paypal_secret" class="form-control" value="{{ $settings['paypal_secret'] ?? '' }}">
        </div>
        <div>
          <label class="form-label">Mode</label>
          <select name="paypal_mode" class="form-select">
            <option value="sandbox" {{ ($settings['paypal_mode'] ?? 'sandbox') == 'sandbox' ? 'selected' : '' }}>Sandbox (Testing)</option>
            <option value="live" {{ ($settings['paypal_mode'] ?? '') == 'live' ? 'selected' : '' }}>Live</option>
          </select>
        </div>
      </div>
    </div>

    <!-- COD -->
    <div class="col-lg-6">
      <div class="form-card">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
          <div class="d-flex align-items-center gap-2">
            <div style="width:32px;height:32px;background:#28a745;border-radius:6px;display:flex;align-items:center;justify-content:center;">
              <i class="bi bi-cash text-white"></i>
            </div>
            <h6 class="fw-bold mb-0">Cash on Delivery</h6>
          </div>
          <div class="form-check form-switch mb-0">
            <input class="form-check-input" type="checkbox" name="cod_enabled" value="1" {{ ($settings['cod_enabled'] ?? '1') == '1' ? 'checked' : '' }}>
            <label class="form-check-label small">Enable</label>
          </div>
        </div>
        <div>
          <label class="form-label">COD Extra Charge (₨)</label>
          <input type="number" name="cod_charge" class="form-control" value="{{ $settings['cod_charge'] ?? 0 }}" min="0">
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-end mt-4">
    <button type="submit" class="btn btn-gold px-4"><i class="bi bi-check-lg me-1"></i>Save Payment Settings</button>
  </div>
</form>
@endsection
