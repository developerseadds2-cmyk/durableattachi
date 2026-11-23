
<div class="account-sidebar-box d-none d-lg-block">
  <ul class="list-unstyled mb-0 account-nav-list">
    <?php $__currentLoopData = [
      [route('account.dashboard'), 'bi-grid', 'Dashboard', request()->routeIs('account.dashboard')],
      [route('account.profile'), 'bi-person', 'My Profile', request()->routeIs('account.profile')],
      [route('account.orders'), 'bi-bag', 'My Orders', request()->routeIs('account.orders*')],
      [route('account.addresses'), 'bi-geo-alt', 'Addresses', request()->routeIs('account.addresses')],
      [route('wishlist.index'), 'bi-heart', 'Wishlist', request()->routeIs('wishlist*')],
    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$url, $icon, $label, $active]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="account-nav-item mb-1">
      <a href="<?php echo e($url); ?>" class="account-nav-link <?php echo e($active ? 'active' : ''); ?>">
        <i class="bi <?php echo e($icon); ?>"></i> <span><?php echo e($label); ?></span>
      </a>
    </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <li class="account-nav-item mt-3 pt-3" style="border-top:1px solid var(--border);">
      <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="account-nav-link text-danger border-0 w-100 bg-transparent text-start">
          <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
        </button>
      </form>
    </li>
  </ul>
</div>


<div class="account-mobile-nav d-lg-none mb-4">
  <?php
    $navOptions = [
      [route('account.dashboard'), 'bi-grid', 'Dashboard', request()->routeIs('account.dashboard')],
      [route('account.profile'), 'bi-person', 'My Profile', request()->routeIs('account.profile')],
      [route('account.orders'), 'bi-bag', 'My Orders', request()->routeIs('account.orders*')],
      [route('account.addresses'), 'bi-geo-alt', 'Addresses', request()->routeIs('account.addresses')],
      [route('wishlist.index'), 'bi-heart', 'Wishlist', request()->routeIs('wishlist*')],
    ];
    $currentOption = collect($navOptions)->firstWhere(3, true) ?? $navOptions[0];
  ?>

  <div class="account-mobile-select-wrap">
    <div class="account-mobile-current" onclick="document.getElementById('accountMobileDropdown').classList.toggle('show')">
      <div class="d-flex align-items-center gap-2">
        <i class="bi <?php echo e($currentOption[1]); ?> text-success"></i>
        <span class="fw-bold"><?php echo e($currentOption[2]); ?></span>
      </div>
      <div class="d-flex align-items-center gap-1 text-muted small">
        <span>Menu</span>
        <i class="bi bi-chevron-expand"></i>
      </div>
    </div>

    <div class="account-mobile-dropdown-menu" id="accountMobileDropdown">
      <?php $__currentLoopData = $navOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$url, $icon, $label, $active]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a href="<?php echo e($url); ?>" class="account-mobile-dropdown-item <?php echo e($active ? 'active' : ''); ?>">
        <div class="d-flex align-items-center gap-2">
          <i class="bi <?php echo e($icon); ?>"></i>
          <span><?php echo e($label); ?></span>
        </div>
        <?php if($active): ?> <i class="bi bi-check2 text-success"></i> <?php endif; ?>
      </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <div class="border-top my-1"></div>
      <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="account-mobile-dropdown-item text-danger border-0 w-100 bg-transparent text-start">
          <i class="bi bi-box-arrow-right"></i> Logout
        </button>
      </form>
    </div>
  </div>
</div>
<?php /**PATH C:\xampp8.2\htdocs\ayushnaman\resources\views/frontend/account/partials/sidebar.blade.php ENDPATH**/ ?>