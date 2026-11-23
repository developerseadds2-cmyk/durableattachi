@extends('frontend.layouts.app')
@section('title', 'My Addresses — Durable Suitcase House')

@section('content')
<div class="account-hero">
  <div class="container-xl-custom">
    <h4 style="font-family:var(--font-serif);font-weight:400;margin-bottom:0;">My Addresses</h4>
  </div>
</div>

<div class="container-xl-custom py-4 py-md-5">
  <div class="row g-4">
    <!-- Sidebar -->
    <div class="col-lg-3">
      @include('frontend.account.partials.sidebar')
    </div>

    <!-- Addresses -->
    <div class="col-lg-9">

      @if(session('success'))
        <div class="alert mb-4" style="border-radius:6px;border:none;background:#d1fae5;color:#065f46;padding:14px 20px;">
          <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
      @endif

      <!-- Existing Addresses -->
      @if($addresses->count())
      <div class="row g-3 mb-4">
        @foreach($addresses as $address)
        <div class="col-md-6">
          <div class="account-card" style="height:100%;position:relative;border-color:{{ $address->is_default ? 'var(--dsh-navy-light)' : '#e7eae3' }};">
            @if($address->is_default)
              <span style="position:absolute;top:14px;right:14px;font-size:0.62rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;background:var(--dsh-navy-light);color:#fff;padding:3px 10px;border-radius:20px;">Default</span>
            @endif
            <div style="font-size:0.68rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--dsh-navy);margin-bottom:10px;">
              <i class="bi bi-geo-alt me-1 text-ayur-leaf"></i>{{ ucfirst($address->type) }}
            </div>
            <p style="font-size:0.88rem;line-height:1.8;margin-bottom:16px;color:var(--text);">
              <strong style="color:var(--dark);">{{ $address->first_name . ' ' . $address->last_name }}</strong><br>
              {{ $address->address_line1 }}<br>
              @if($address->address_line2){{ $address->address_line2 }}<br>@endif
              {{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}<br>
              {{ $address->country }}
            </p>
            <form method="POST" action="{{ route('account.addresses.delete', $address->id) }}" onsubmit="return confirm('Delete this address?')">
              @csrf @method('DELETE')
              <button type="submit" style="background:none;border:none;font-size:0.8rem;color:#dc3545;cursor:pointer;padding:0;font-weight:500;">
                <i class="bi bi-trash me-1"></i>Remove
              </button>
            </form>
          </div>
        </div>
        @endforeach
      </div>
      @endif

      <!-- Add New Address -->
      <div class="account-card">
        <h5 style="font-family:var(--font-serif);font-size:1.15rem;margin-bottom:20px;color:var(--dsh-navy);border-bottom:1px solid #eef2ec;padding-bottom:12px;">Add New Address</h5>
        <form method="POST" action="{{ route('account.addresses.store') }}">
          @csrf
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">Address Type</label>
              <select name="type" class="form-select" style="border-radius:6px;border-color:var(--border);" required>
                <option value="shipping">Shipping</option>
                <option value="billing">Billing</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">First Name</label>
              <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" style="border-radius:6px;border-color:var(--border);" required>
              @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">Last Name</label>
              <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" style="border-radius:6px;border-color:var(--border);" required>
              @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">Street Address</label>
              <input type="text" name="address_line1" placeholder="House #, Street, Area" class="form-control @error('address_line1') is-invalid @enderror" style="border-radius:6px;border-color:var(--border);" required>
              @error('address_line1')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">City</label>
              <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" style="border-radius:6px;border-color:var(--border);" required>
              @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">State</label>
              <input type="text" name="state" class="form-control @error('state') is-invalid @enderror" style="border-radius:6px;border-color:var(--border);" required>
              @error('state')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">PIN Code</label>
              <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror" style="border-radius:6px;border-color:var(--border);" required>
              @error('postal_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">Country</label>
              <input type="text" name="country" value="India" class="form-control @error('country') is-invalid @enderror" style="border-radius:6px;border-color:var(--border);" required>
              @error('country')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 d-flex align-items-end">
              <div class="form-check pb-2">
                <input class="form-check-input" type="checkbox" name="is_default" id="isDefault" value="1">
                <label class="form-check-label small" for="isDefault">Set as default address</label>
              </div>
            </div>
          </div>
          <div class="mt-4">
            <button type="submit" class="btn-glamora" style="padding:11px 28px;border-radius:6px;">
              <i class="bi bi-plus-lg me-1"></i> Add Address
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection

