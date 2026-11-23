@extends('frontend.layouts.app')
@section('title', 'Forgot Password — Durable Suitcase House')

@section('content')
<div style="background:var(--pd-ice);min-height:calc(100vh - 200px);display:flex;align-items:center;padding:60px 0;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">

        <div style="background:#fff;border:1px solid var(--border);padding:40px;">
          <div class="text-center mb-5">
            <a href="{{ route('home') }}" style="font-family:var(--font-serif);font-size:2rem;font-weight:300;font-style:italic;color:var(--dark);letter-spacing:2px;">Durable Suitcase House</a>
            <h4 style="font-family:var(--font-serif);font-weight:400;font-size:1.4rem;margin-top:20px;margin-bottom:8px;">Forgot Password?</h4>
            <p class="text-muted small">Enter your email and we'll send you a reset link.</p>
          </div>

          @if(session('status'))
            <div style="background:#d1fae5;color:#065f46;padding:14px 20px;margin-bottom:24px;font-size:0.88rem;">
              <i class="bi bi-check-circle me-2"></i>{{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-4">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">Email Address</label>
              <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" style="border-radius:0;border-color:var(--border);padding:12px 14px;" placeholder="your@email.com" required autofocus>
              @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <button type="submit" class="btn-glamora w-100 justify-content-center" style="padding:13px;">
              Send Reset Link
            </button>
          </form>

          <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-muted small" style="text-decoration:underline;">Back to Login</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection

