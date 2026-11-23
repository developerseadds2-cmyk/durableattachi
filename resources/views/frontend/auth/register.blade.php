@extends('frontend.layouts.app')
@section('title', 'Register — Ayur Naman')

@section('content')
<div style="background:var(--pd-ice);padding:60px 0;text-align:center;">
  <h1 style="font-family:var(--font-serif);font-size:2rem;font-weight:400;">Create Account</h1>
</div>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <form method="POST" action="{{ route('register.post') }}" style="background:var(--pd-ice);padding:36px;">
        @csrf
        <h5 style="font-family:var(--font-serif);font-size:1.3rem;margin-bottom:24px;text-align:center;">Join Ayur Naman</h5>
        <div class="mb-3">
          <label class="small fw-600 d-block mb-1">Full Name *</label>
          <input type="text" name="name" class="form-control" style="border-radius:0;" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
          <label class="small fw-600 d-block mb-1">Email Address *</label>
          <input type="email" name="email" class="form-control" style="border-radius:0;" value="{{ old('email') }}" required>
          @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="small fw-600 d-block mb-1">Phone</label>
          <input type="tel" name="phone" class="form-control" style="border-radius:0;" value="{{ old('phone') }}">
        </div>
        <div class="mb-3">
          <label class="small fw-600 d-block mb-1">Password *</label>
          <input type="password" name="password" class="form-control" style="border-radius:0;" required minlength="8">
        </div>
        <div class="mb-4">
          <label class="small fw-600 d-block mb-1">Confirm Password *</label>
          <input type="password" name="password_confirmation" class="form-control" style="border-radius:0;" required>
          @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn-glamora w-100 justify-content-center" style="padding:14px;">Create Account</button>
        <p class="text-center text-muted small mt-3 mb-0">Already have an account? <a href="{{ route('login') }}" class="text-pd-blue fw-600">Login</a></p>
      </form>
    </div>
  </div>
</div>
@endsection
