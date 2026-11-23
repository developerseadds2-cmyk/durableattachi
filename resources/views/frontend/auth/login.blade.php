@extends('frontend.layouts.app')
@section('title', 'Login — Durable Suitcase House')

@section('content')
<div style="background:var(--pd-ice);padding:60px 0;text-align:center;">
  <h1 style="font-family:var(--font-serif);font-size:2rem;font-weight:400;">Welcome Back</h1>
</div>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <form method="POST" action="{{ route('login.post') }}" style="background:var(--pd-ice);padding:36px;">
        @csrf
        <h5 style="font-family:var(--font-serif);font-size:1.3rem;margin-bottom:24px;text-align:center;">Sign In</h5>

        @if(session('error'))
          <div class="alert alert-danger small rounded-0">{{ session('error') }}</div>
        @endif

        <div class="mb-3">
          <label class="small fw-600 d-block mb-1">Email Address</label>
          <input type="email" name="email" class="form-control" style="border-radius:0;" value="{{ old('email') }}" required autofocus>
          @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <div class="d-flex justify-content-between mb-1">
            <label class="small fw-600">Password</label>
            <a href="{{ route('password.request') }}" class="small text-pd-blue">Forgot?</a>
          </div>
          <input type="password" name="password" class="form-control" style="border-radius:0;" required>
        </div>
        <div class="form-check mb-4">
          <input class="form-check-input" type="checkbox" name="remember" id="remember">
          <label class="form-check-label small" for="remember">Remember me</label>
        </div>
        <button type="submit" class="btn-glamora w-100 justify-content-center" style="padding:14px;">Sign In</button>
        <p class="text-center text-muted small mt-3 mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-pd-blue fw-600">Register</a></p>
      </form>
    </div>
  </div>
</div>
@endsection

