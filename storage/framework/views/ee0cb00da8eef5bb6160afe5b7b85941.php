
<?php $__env->startSection('title', 'My Account — Durable Suitcase House'); ?>

<?php $__env->startSection('content'); ?>
<div class="account-hero">
  <div class="container-xl-custom">
    <div class="d-flex align-items-center gap-4">
      <img src="<?php echo e($user->avatar_url); ?>" alt="<?php echo e($user->name); ?>" style="width:68px;height:68px;border-radius:50%;object-fit:cover;border:2px solid #fff;box-shadow:0 4px 12px rgba(0,0,0,0.08);">
      <div>
        <h4 style="font-family:var(--font-serif);font-weight:500;margin-bottom:2px;color:var(--dsh-navy);">Hello, <?php echo e($user->name); ?></h4>
        <p class="text-muted small mb-0"><?php echo e($user->email); ?></p>
      </div>
    </div>
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
      <!-- Stats -->
      <div class="row g-3 mb-4">
        <?php $__currentLoopData = [
          ['bi-bag-check', $stats['total_orders'], 'Total Orders'],
          ['bi-clock-history', $stats['pending_orders'], 'Pending Orders'],
          ['bi-bag-heart', $stats['delivered_orders'], 'Delivered'],
          ['bi-heart', $stats['wishlist_count'], 'Wishlist Items'],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$icon, $val, $label]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 col-md-3">
          <div class="account-stat-box">
            <i class="bi <?php echo e($icon); ?>" style="font-size:1.8rem;color:var(--dsh-navy-light);display:block;margin-bottom:6px;"></i>
            <div style="font-family:var(--font-serif);font-size:1.8rem;font-weight:600;color:var(--dsh-navy);"><?php echo e($val); ?></div>
            <div class="text-muted small" style="font-size:0.75rem;"><?php echo e($label); ?></div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <!-- Recent Orders -->
      <div class="account-card">
        <h5 style="font-family:var(--font-serif);font-size:1.2rem;font-weight:600;color:var(--dsh-navy);margin-bottom:20px;">Recent Orders</h5>
        <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 py-3" style="border-bottom:1px solid var(--border);">
          <div>
            <div class="fw-600 small" style="color:var(--dsh-navy);">#<?php echo e($order->order_number); ?></div>
            <div class="text-muted small"><?php echo e($order->created_at->format('d M Y')); ?> · <?php echo e($order->items->count() ?? 0); ?> items</div>
          </div>
          <div class="d-flex align-items-center gap-2 gap-sm-3 ms-auto ms-sm-0">
            <span class="fw-700" style="color:var(--dsh-navy);">₨<?php echo e(number_format($order->total_amount, 2)); ?></span>
            <?php echo $order->status_badge; ?>

            <a href="<?php echo e(route('account.orders.detail', $order->order_number)); ?>" class="btn btn-sm btn-outline-glamora" style="padding:4px 12px; font-size:0.75rem;">View</a>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-muted mb-0">No orders yet. <a href="<?php echo e(route('shop.index')); ?>" style="color:var(--dsh-navy-light);font-weight:600;">Start shopping</a></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\durableattachi\resources\views/frontend/account/dashboard.blade.php ENDPATH**/ ?>