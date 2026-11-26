@extends('frontend.layouts.app')
@section('title', 'Login — Durable Suitcase House')

@section('content')
<div style="background:linear-gradient(135deg, #142D4E 0%, #0F2137 100%); padding:52px 0; text-align:center; color:#ffffff; border-bottom:2px solid #C59A55;">
  <div class="container">
    <span style="font-size:0.75rem; font-weight:800; letter-spacing:3px; text-transform:uppercase; color:#C59A55; display:block; margin-bottom:8px;">Customer Account</span>
    <h1 style="font-family:var(--font-serif); font-size:clamp(1.8rem, 3.5vw, 2.5rem); font-weight:700; color:#ffffff; margin:0;">Welcome Back</h1>
  </div>
</div>

<div class="container py-5" style="background:#fbf9f4; min-height:55vh;">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <form method="POST" action="{{ route('login.post') }}" style="background:#ffffff; border:1.5px solid #e2e8f0; border-radius:14px; padding:36px 32px; box-shadow:0 8px 30px rgba(20,45,78,0.08);">
        @csrf
        <h5 style="font-family:var(--font-serif); font-size:1.45rem; font-weight:700; color:#142D4E; margin-bottom:6px; text-align:center;">Sign In</h5>
        <p class="text-center text-muted small mb-4">Access your orders, wishlist, and saved addresses</p>

        @if(session('error'))
          <div class="alert alert-danger small rounded-3">{{ session('error') }}</div>
        @endif
        @if(session('success'))
          <div class="alert alert-success small rounded-3">{{ session('success') }}</div>
        @endif

        <div class="mb-3">
          <label class="small fw-bold d-block mb-1" style="color:#142D4E;">Email Address</label>
          <input type="email" name="email" class="form-control" style="border:1.5px solid #cbd5e1; border-radius:8px; padding:11px 14px; font-size:0.92rem;" value="{{ old('email') }}" placeholder="name@example.com" required autofocus>
          @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <div class="d-flex justify-content-between mb-1">
            <label class="small fw-bold" style="color:#142D4E;">Password</label>
            <a href="{{ route('password.request') }}" class="small fw-600" style="color:#A97E3B;">Forgot?</a>
          </div>
          <input type="password" name="password" class="form-control" style="border:1.5px solid #cbd5e1; border-radius:8px; padding:11px 14px; font-size:0.92rem;" placeholder="Enter your password" required>
          @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="form-check mb-4">
          <input class="form-check-input" type="checkbox" name="remember" id="remember">
          <label class="form-check-label small text-muted" for="remember">Remember me</label>
        </div>

        <button type="submit" class="w-100" style="background:#142D4E; color:#ffffff; border:none; border-radius:8px; padding:13px 20px; font-weight:700; font-size:0.95rem; letter-spacing:0.4px; box-shadow:0 4px 12px rgba(20,45,78,0.22); cursor:pointer;">
          Sign In
        </button>

        <p class="text-center text-muted small mt-4 mb-0">
          Don't have an account? <a href="{{ route('register') }}" class="fw-bold" style="color:#142D4E;">Register</a>
        </p>
      </form>
    </div>
  </div>
</div>
@endsection
