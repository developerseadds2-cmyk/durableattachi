@extends('frontend.layouts.app')
@section('title', 'My Profile — Durable Suitcase House')

@section('content')
<div class="account-hero">
  <div class="container-xl-custom">
    <h4 style="font-family:var(--font-serif);font-weight:500;color:var(--dsh-navy);margin:0;">My Profile</h4>
  </div>
</div>

<div class="container-xl-custom py-4 py-md-5">
  <div class="row g-4">
    <!-- Sidebar -->
    <div class="col-lg-3">
      @include('frontend.account.partials.sidebar')
    </div>

    <!-- Content -->
    <div class="col-lg-9">

      @if(session('success'))
        <div class="alert alert-success mb-4" style="border-radius:0;border:none;background:#d1fae5;color:#065f46;padding:14px 20px;">
          <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger mb-4" style="border-radius:0;border:none;background:#fee2e2;color:#991b1b;padding:14px 20px;">
          <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
        </div>
      @endif

      <!-- Profile Info -->
      <div style="background:#fff;border:1px solid var(--border);padding:28px;margin-bottom:24px;">
        <h5 style="font-family:var(--font-serif);font-size:1.2rem;margin-bottom:24px;">Personal Information</h5>
        <form method="POST" action="{{ route('account.profile.update') }}" enctype="multipart/form-data">
          @csrf @method('PUT')
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">Full Name</label>
              <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" style="border-radius:0;border-color:var(--border);" required>
              @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">Email Address</label>
              <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" style="border-radius:0;border-color:var(--border);" required>
              @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">Phone Number</label>
              <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control" style="border-radius:0;border-color:var(--border);">
            </div>
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">Profile Photo</label>
              <input type="file" name="avatar" accept="image/*" class="form-control" style="border-radius:0;border-color:var(--border);">
            </div>
          </div>
          <div class="mt-4">
            <button type="submit" class="btn-glamora" style="padding:11px 28px;">
              <i class="bi bi-check-lg me-1"></i> Save Changes
            </button>
          </div>
        </form>
      </div>

      <!-- Change Password -->
      <div style="background:#fff;border:1px solid var(--border);padding:28px;">
        <h5 style="font-family:var(--font-serif);font-size:1.2rem;margin-bottom:24px;">Change Password</h5>
        <form method="POST" action="{{ route('account.password.change') }}">
          @csrf @method('PUT')
          <div class="row g-3">
            <div class="col-md-12">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">Current Password</label>
              <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" style="border-radius:0;border-color:var(--border);" required>
              @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">New Password</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" style="border-radius:0;border-color:var(--border);" required>
              @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">Confirm New Password</label>
              <input type="password" name="password_confirmation" class="form-control" style="border-radius:0;border-color:var(--border);" required>
            </div>
          </div>
          <div class="mt-4">
            <button type="submit" class="btn-glamora" style="padding:11px 28px;">
              <i class="bi bi-shield-lock me-1"></i> Update Password
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection


