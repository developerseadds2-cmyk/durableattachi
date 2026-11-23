<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — Ayur Naman</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
  body { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); min-height: 100vh; display: flex; align-items: center; }
  .login-card { background: #fff; border-radius: 20px; padding: 48px 40px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); width: 100%; max-width: 420px; }
  .login-logo { width: 56px; height: 56px; background: #c9a96e; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.4rem; color: #1a1a2e; margin: 0 auto 16px; }
  .btn-admin { background: #c9a96e; color: #1a1a2e; font-weight: 700; border: none; padding: 12px; border-radius: 10px; width: 100%; font-size: 1rem; transition: all 0.2s; }
  .btn-admin:hover { background: #b8935a; color: #1a1a2e; transform: translateY(-1px); }
  .form-control { border-radius: 10px; padding: 12px 16px; border: 1.5px solid #e0e0e0; }
  .form-control:focus { border-color: #c9a96e; box-shadow: 0 0 0 3px rgba(201,169,110,0.15); }
  .input-group-text { border-radius: 0 10px 10px 0; border: 1.5px solid #e0e0e0; border-left: none; background: #fff; cursor: pointer; }
</style>
</head>
<body>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12">
      <div class="login-card mx-auto animate__animated animate__fadeInUp">
        <div class="text-center mb-4">
          <div class="login-logo">G</div>
          <h4 class="fw-800 mb-1" style="color:#1a1a2e;">Ayur Naman Admin</h4>
          <p class="text-muted small mb-0">Sign in to manage your store</p>
        </div>

        @if(session('error'))
          <div class="alert alert-danger alert-sm rounded-3 mb-3 py-2">
            <i class="bi bi-exclamation-circle me-1"></i>{{ session('error') }}
          </div>
        @endif
        @if(session('success'))
          <div class="alert alert-success alert-sm rounded-3 mb-3 py-2">
            <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
          </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
          @csrf
          <div class="mb-3">
            <label class="form-label fw-600 small">Email Address</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
              placeholder="admin@ayurnaman.com" value="{{ old('email') }}" required autofocus>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="mb-3">
            <label class="form-label fw-600 small">Password</label>
            <div class="input-group">
              <input type="password" name="password" id="pwdInput"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Enter your password" required style="border-radius:10px 0 0 10px; border-right:none;">
              <span class="input-group-text" onclick="togglePwd()">
                <i class="bi bi-eye" id="pwdIcon"></i>
              </span>
              @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check mb-0">
              <input class="form-check-input" type="checkbox" name="remember" id="remember">
              <label class="form-check-label small" for="remember">Remember me</label>
            </div>
          </div>
          <button type="submit" class="btn-admin">
            <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
          </button>
        </form>

        <div class="text-center mt-4">
          <a href="{{ route('home') }}" class="text-muted small text-decoration-none">
            <i class="bi bi-arrow-left me-1"></i>Back to Store
          </a>
        </div>

        <div class="mt-4 p-3 bg-light rounded-3 small">
          <strong>Demo credentials:</strong><br>
          Email: komal@punjabit.co.in<br>
          Password: komal
        </div>
      </div>
    </div>
  </div>
</div>
<script>
function togglePwd() {
  const inp = document.getElementById('pwdInput');
  const icon = document.getElementById('pwdIcon');
  inp.type = inp.type === 'password' ? 'text' : 'password';
  icon.className = inp.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
}
</script>
</body>
</html>
