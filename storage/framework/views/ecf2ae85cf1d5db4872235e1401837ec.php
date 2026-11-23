<?php $__env->startSection('title', 'Login — Ayur Naman'); ?>

<?php $__env->startSection('content'); ?>
<div style="background:var(--pd-ice);padding:60px 0;text-align:center;">
  <h1 style="font-family:var(--font-serif);font-size:2rem;font-weight:400;">Welcome Back</h1>
</div>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <form method="POST" action="<?php echo e(route('login.post')); ?>" style="background:var(--pd-ice);padding:36px;">
        <?php echo csrf_field(); ?>
        <h5 style="font-family:var(--font-serif);font-size:1.3rem;margin-bottom:24px;text-align:center;">Sign In</h5>

        <?php if(session('error')): ?>
          <div class="alert alert-danger small rounded-0"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <div class="mb-3">
          <label class="small fw-600 d-block mb-1">Email Address</label>
          <input type="email" name="email" class="form-control" style="border-radius:0;" value="<?php echo e(old('email')); ?>" required autofocus>
          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="mb-3">
          <div class="d-flex justify-content-between mb-1">
            <label class="small fw-600">Password</label>
            <a href="<?php echo e(route('password.request')); ?>" class="small text-pd-blue">Forgot?</a>
          </div>
          <input type="password" name="password" class="form-control" style="border-radius:0;" required>
        </div>
        <div class="form-check mb-4">
          <input class="form-check-input" type="checkbox" name="remember" id="remember">
          <label class="form-check-label small" for="remember">Remember me</label>
        </div>
        <button type="submit" class="btn-glamora w-100 justify-content-center" style="padding:14px;">Sign In</button>
        <p class="text-center text-muted small mt-3 mb-0">Don't have an account? <a href="<?php echo e(route('register')); ?>" class="text-pd-blue fw-600">Register</a></p>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\ayushnaman\resources\views/frontend/auth/login.blade.php ENDPATH**/ ?>