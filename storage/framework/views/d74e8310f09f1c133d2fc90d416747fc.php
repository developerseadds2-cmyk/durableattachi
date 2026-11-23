<?php $__env->startSection('title', 'My Profile — Ayur Naman'); ?>

<?php $__env->startSection('content'); ?>
<div class="account-hero">
  <div class="container-xl-custom">
    <h4 style="font-family:var(--font-serif);font-weight:500;color:var(--ayur-green-dark);margin:0;">My Profile</h4>
  </div>
</div>

<div class="container-xl-custom py-4 py-md-5">
  <div class="row g-4">
    <!-- Sidebar -->
    <div class="col-lg-3">
      <?php echo $__env->make('frontend.account.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Content -->
    <div class="col-lg-9">

      <?php if(session('success')): ?>
        <div class="alert alert-success mb-4" style="border-radius:0;border:none;background:#d1fae5;color:#065f46;padding:14px 20px;">
          <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

        </div>
      <?php endif; ?>
      <?php if(session('error')): ?>
        <div class="alert alert-danger mb-4" style="border-radius:0;border:none;background:#fee2e2;color:#991b1b;padding:14px 20px;">
          <i class="bi bi-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

        </div>
      <?php endif; ?>

      <!-- Profile Info -->
      <div style="background:#fff;border:1px solid var(--border);padding:28px;margin-bottom:24px;">
        <h5 style="font-family:var(--font-serif);font-size:1.2rem;margin-bottom:24px;">Personal Information</h5>
        <form method="POST" action="<?php echo e(route('account.profile.update')); ?>" enctype="multipart/form-data">
          <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">Full Name</label>
              <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="border-radius:0;border-color:var(--border);" required>
              <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">Email Address</label>
              <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="border-radius:0;border-color:var(--border);" required>
              <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">Phone Number</label>
              <input type="text" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>" class="form-control" style="border-radius:0;border-color:var(--border);">
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
        <form method="POST" action="<?php echo e(route('account.password.change')); ?>">
          <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
          <div class="row g-3">
            <div class="col-md-12">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">Current Password</label>
              <input type="password" name="current_password" class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="border-radius:0;border-color:var(--border);" required>
              <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.78rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--text-muted);">New Password</label>
              <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="border-radius:0;border-color:var(--border);" required>
              <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\ayushnaman\resources\views/frontend/account/profile.blade.php ENDPATH**/ ?>