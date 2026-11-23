@extends('frontend.layouts.app')
@section('title', 'Reset Password — Ayur Naman')

@section('content')
<div style="background:var(--pd-ice);min-height:calc(100vh - 200px);display:flex;align-items:center;padding:60px 0;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">

        <div style="background:#fff;border:1px solid var(--border);padding:40px;">
          <div class="text-center mb-5">
            <a href="{{ route('home') }}" style="font-family:var(--font-serif);font-size:2rem;font-weight:300;font-style:italic;color:var(--dark);letter-spacing:2px;">Ayur Naman</a>
            <h4 style="font-family:var(--font-serif);font-weight:400;font-size:1.4rem;margin-top:20px;margin-bottom:8px;">Reset Password</h4>
            <p class="text-muted small">Choose a new secure password.</p>
          </div>

          <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-4">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">Email Address</label>
              <input type="email" name="email" value="{{ old('email', request()->email) }}" class="form-control @error('email') is-invalid @enderror" style="border-radius:0;border-color:var(--border);padding:12px 14px;" required>
              @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">New Password</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" style="border-radius:0;border-color:var(--border);padding:12px 14px;" required>
              @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-5">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">Confirm New Password</label>
              <input type="password" name="password_confirmation" class="form-control" style="border-radius:0;border-color:var(--border);padding:12px 14px;" required>
            </div>

            <button type="submit" class="btn-glamora w-100 justify-content-center" style="padding:13px;">
              Reset Password
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
