<?php $__env->startSection('title', 'My Addresses — Ayur Naman'); ?>

<?php $__env->startSection('content'); ?>
<div class="account-hero">
  <div class="container-xl-custom">
    <h4 style="font-family:var(--font-serif);font-weight:400;margin-bottom:0;">My Addresses</h4>
  </div>
</div>

<div class="container-xl-custom py-4 py-md-5">
  <div class="row g-4">
    <!-- Sidebar -->
    <div class="col-lg-3">
      <?php echo $__env->make('frontend.account.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Addresses -->
    <div class="col-lg-9">

      <?php if(session('success')): ?>
        <div class="alert mb-4" style="border-radius:6px;border:none;background:#d1fae5;color:#065f46;padding:14px 20px;">
          <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

        </div>
      <?php endif; ?>

      <!-- Existing Addresses -->
      <?php if($addresses->count()): ?>
      <div class="row g-3 mb-4">
        <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6">
          <div class="account-card" style="height:100%;position:relative;border-color:<?php echo e($address->is_default ? 'var(--ayur-green)' : '#e7eae3'); ?>;">
            <?php if($address->is_default): ?>
              <span style="position:absolute;top:14px;right:14px;font-size:0.62rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;background:var(--ayur-green);color:#fff;padding:3px 10px;border-radius:20px;">Default</span>
            <?php endif; ?>
            <div style="font-size:0.68rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--ayur-green-dark);margin-bottom:10px;">
              <i class="bi bi-geo-alt me-1 text-ayur-leaf"></i><?php echo e(ucfirst($address->type)); ?>

            </div>
            <p style="font-size:0.88rem;line-height:1.8;margin-bottom:16px;color:var(--text);">
              <strong style="color:var(--dark);"><?php echo e($address->first_name . ' ' . $address->last_name); ?></strong><br>
              <?php echo e($address->address_line1); ?><br>
              <?php if($address->address_line2): ?><?php echo e($address->address_line2); ?><br><?php endif; ?>
              <?php echo e($address->city); ?>, <?php echo e($address->state); ?> <?php echo e($address->postal_code); ?><br>
              <?php echo e($address->country); ?>

            </p>
            <form method="POST" action="<?php echo e(route('account.addresses.delete', $address->id)); ?>" onsubmit="return confirm('Delete this address?')">
              <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
              <button type="submit" style="background:none;border:none;font-size:0.8rem;color:#dc3545;cursor:pointer;padding:0;font-weight:500;">
                <i class="bi bi-trash me-1"></i>Remove
              </button>
            </form>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php endif; ?>

      <!-- Add New Address -->
      <div class="account-card">
        <h5 style="font-family:var(--font-serif);font-size:1.15rem;margin-bottom:20px;color:var(--ayur-green-dark);border-bottom:1px solid #eef2ec;padding-bottom:12px;">Add New Address</h5>
        <form method="POST" action="<?php echo e(route('account.addresses.store')); ?>">
          <?php echo csrf_field(); ?>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">Address Type</label>
              <select name="type" class="form-select" style="border-radius:6px;border-color:var(--border);" required>
                <option value="shipping">Shipping</option>
                <option value="billing">Billing</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">First Name</label>
              <input type="text" name="first_name" class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="border-radius:6px;border-color:var(--border);" required>
              <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">Last Name</label>
              <input type="text" name="last_name" class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="border-radius:6px;border-color:var(--border);" required>
              <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-12">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">Street Address</label>
              <input type="text" name="address_line1" placeholder="House #, Street, Area" class="form-control <?php $__errorArgs = ['address_line1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="border-radius:6px;border-color:var(--border);" required>
              <?php $__errorArgs = ['address_line1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-4">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">City</label>
              <input type="text" name="city" class="form-control <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="border-radius:6px;border-color:var(--border);" required>
              <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-4">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">State</label>
              <input type="text" name="state" class="form-control <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="border-radius:6px;border-color:var(--border);" required>
              <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-4">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">PIN Code</label>
              <input type="text" name="postal_code" class="form-control <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="border-radius:6px;border-color:var(--border);" required>
              <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6">
              <label class="form-label" style="font-size:0.75rem;font-weight:600;letter-spacing:0.8px;text-transform:uppercase;color:var(--text-muted);">Country</label>
              <input type="text" name="country" value="India" class="form-control <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="border-radius:6px;border-color:var(--border);" required>
              <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 d-flex align-items-end">
              <div class="form-check pb-2">
                <input class="form-check-input" type="checkbox" name="is_default" id="isDefault" value="1">
                <label class="form-check-label small" for="isDefault">Set as default address</label>
              </div>
            </div>
          </div>
          <div class="mt-4">
            <button type="submit" class="btn-glamora" style="padding:11px 28px;border-radius:6px;">
              <i class="bi bi-plus-lg me-1"></i> Add Address
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\ayushnaman\resources\views/frontend/account/addresses.blade.php ENDPATH**/ ?>