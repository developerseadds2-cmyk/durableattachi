@extends('frontend.layouts.app')
@section('title', 'Register — Durable Suitcase House')

@section('content')
<div style="background:linear-gradient(135deg, #142D4E 0%, #0F2137 100%); padding:52px 0; text-align:center; color:#ffffff; border-bottom:2px solid #C59A55;">
  <div class="container">
    <span style="font-size:0.75rem; font-weight:800; letter-spacing:3px; text-transform:uppercase; color:#C59A55; display:block; margin-bottom:8px;">Customer Account</span>
    <h1 style="font-family:var(--font-serif); font-size:clamp(1.8rem, 3.5vw, 2.5rem); font-weight:700; color:#ffffff; margin:0;">Create Account</h1>
  </div>
</div>

<div class="container py-5" style="background:#fbf9f4; min-height:55vh;">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <form method="POST" action="{{ route('register.post') }}" style="background:#ffffff; border:1.5px solid #e2e8f0; border-radius:14px; padding:36px 32px; box-shadow:0 8px 30px rgba(20,45,78,0.08);">
        @csrf
        <h5 style="font-family:var(--font-serif); font-size:1.45rem; font-weight:700; color:#142D4E; margin-bottom:6px; text-align:center;">Join Durable Suitcase House</h5>
        <p class="text-center text-muted small mb-4">Create your account for faster checkout and order tracking</p>

        <div class="mb-3">
          <label class="small fw-bold d-block mb-1" style="color:#142D4E;">Full Name <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control" style="border:1.5px solid #cbd5e1; border-radius:8px; padding:11px 14px; font-size:0.92rem;" value="{{ old('name') }}" placeholder="e.g. Ramesh Kumar" required>
          @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="small fw-bold d-block mb-1" style="color:#142D4E;">Email Address <span class="text-danger">*</span></label>
          <input type="email" name="email" class="form-control" style="border:1.5px solid #cbd5e1; border-radius:8px; padding:11px 14px; font-size:0.92rem;" value="{{ old('email') }}" placeholder="name@example.com" required>
          @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="small fw-bold d-block mb-1" style="color:#142D4E;">Phone</label>
          <input type="tel" name="phone" class="form-control" style="border:1.5px solid #cbd5e1; border-radius:8px; padding:11px 14px; font-size:0.92rem;" value="{{ old('phone') }}" placeholder="e.g. 9914469211">
          @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
          <label class="small fw-bold d-block mb-1" style="color:#142D4E;">Password <span class="text-danger">*</span></label>
          <input type="password" name="password" class="form-control" style="border:1.5px solid #cbd5e1; border-radius:8px; padding:11px 14px; font-size:0.92rem;" placeholder="Minimum 8 characters" required minlength="8">
          @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
          <label class="small fw-bold d-block mb-1" style="color:#142D4E;">Confirm Password <span class="text-danger">*</span></label>
          <input type="password" name="password_confirmation" class="form-control" style="border:1.5px solid #cbd5e1; border-radius:8px; padding:11px 14px; font-size:0.92rem;" placeholder="Re-enter your password" required>
        </div>

        <button type="submit" class="w-100" style="background:#142D4E; color:#ffffff; border:none; border-radius:8px; padding:13px 20px; font-weight:700; font-size:0.95rem; letter-spacing:0.4px; box-shadow:0 4px 12px rgba(20,45,78,0.22); cursor:pointer;">
          Create Account
        </button>

        <p class="text-center text-muted small mt-4 mb-0">
          Already have an account? <a href="{{ route('login') }}" class="fw-bold" style="color:#142D4E;">Login</a>
        </p>
      </form>
    </div>
  </div>
</div>
@endsection
