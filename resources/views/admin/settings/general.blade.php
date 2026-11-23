@extends('admin.layout.app')
@section('title', 'General Settings')
@section('breadcrumb')
  <li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')
<div class="page-header">
  <h4>Settings</h4>
</div>

<!-- Tabs -->
<ul class="nav nav-tabs mb-4">
  <li class="nav-item"><a class="nav-link active" href="{{ route('admin.settings.index') }}">General</a></li>
  <li class="nav-item"><a class="nav-link" href="{{ route('admin.settings.payment') }}">Payment</a></li>
  <li class="nav-item"><a class="nav-link" href="{{ route('admin.settings.email') }}">Email</a></li>
  <li class="nav-item"><a class="nav-link" href="{{ route('admin.settings.seo') }}">SEO</a></li>
</ul>

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
  @csrf
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-4 pb-2 border-bottom">Site Information</h6>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Site Name</label>
            <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? 'Ayur Naman' }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Contact Email</label>
            <input type="email" name="site_email" class="form-control" value="{{ $settings['site_email'] ?? '' }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Phone Number</label>
            <input type="text" name="site_phone" class="form-control" value="{{ $settings['site_phone'] ?? '' }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Currency</label>
            <div class="input-group">
              <input type="text" name="currency" class="form-control" value="{{ $settings['currency'] ?? 'PKR' }}" placeholder="PKR">
              <input type="text" name="currency_symbol" class="form-control" value="{{ $settings['currency_symbol'] ?? '₨' }}" placeholder="₨" style="max-width:70px;">
            </div>
          </div>
          <div class="col-12">
            <label class="form-label">Address</label>
            <textarea name="site_address" class="form-control" rows="2">{{ $settings['site_address'] ?? '' }}</textarea>
          </div>
        </div>
      </div>

      <div class="form-card mb-4">
        <h6 class="fw-bold mb-4 pb-2 border-bottom">Shipping & Tax</h6>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Free Shipping Above (₨)</label>
            <input type="number" name="free_shipping_above" class="form-control" value="{{ $settings['free_shipping_above'] ?? 5000 }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Tax Rate (%)</label>
            <input type="number" name="tax_rate" class="form-control" value="{{ $settings['tax_rate'] ?? 0 }}" step="0.01" min="0">
          </div>
        </div>
      </div>

      <div class="form-card">
        <h6 class="fw-bold mb-4 pb-2 border-bottom">Social Media</h6>
        <div class="row g-3">
          @foreach(['facebook_url' => 'Facebook', 'instagram_url' => 'Instagram', 'twitter_url' => 'Twitter', 'youtube_url' => 'YouTube'] as $key => $label)
          <div class="col-md-6">
            <label class="form-label">{{ $label }}</label>
            <input type="url" name="{{ $key }}" class="form-control" value="{{ $settings[$key] ?? '' }}" placeholder="https://...">
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-card mb-4">
        <h6 class="fw-bold mb-3 pb-2 border-bottom">Logo & Favicon</h6>
        <div class="mb-4 text-center">
          <label class="form-label d-block">Site Logo</label>
          <img id="logoPreview" src="{{ asset('uploads/' . ($settings['site_logo'] ?? 'logo.png')) }}" alt="Logo"
            style="max-height:60px; max-width:180px; object-fit:contain;" class="mb-2">
          <input type="file" name="site_logo" class="form-control form-control-sm" accept="image/*"
            onchange="this.previousElementSibling.previousElementSibling.src = URL.createObjectURL(this.files[0])">
        </div>
        <div class="text-center">
          <label class="form-label d-block">Favicon</label>
          <input type="file" name="site_favicon" class="form-control form-control-sm" accept="image/*">
          <small class="text-muted">ICO, PNG 32×32px recommended</small>
        </div>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-end mt-4">
    <button type="submit" class="btn btn-gold px-4"><i class="bi bi-check-lg me-1"></i>Save Settings</button>
  </div>
</form>
@endsection
