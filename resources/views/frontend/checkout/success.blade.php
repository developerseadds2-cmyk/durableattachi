@extends('frontend.layouts.app')
@section('title', 'Order Confirmed — Ayur Naman')

@push('styles')
<style>
.success-card {
  max-width: 680px;
  margin: 30px auto;
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 40px 32px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.04);
}
.success-icon-wrap {
  width: 76px;
  height: 76px;
  background: linear-gradient(135deg, var(--ayur-green), var(--ayur-green-dark));
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  animation: scaleIn 0.5s ease;
  box-shadow: 0 8px 24px rgba(45, 90, 39, 0.25);
}
.order-meta-box {
  background: var(--pd-ice);
  padding: 20px 16px;
  border-radius: 8px;
  margin: 28px 0;
  border: 1px solid rgba(27,56,43,0.06);
}
.order-meta-item {
  text-align: center;
  padding: 6px;
}
.order-meta-label {
  font-size: 0.72rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: #718096;
  margin-bottom: 4px;
}
.order-meta-value {
  font-size: 0.95rem;
  font-weight: 700;
  color: var(--dark);
  word-break: break-word;
}
.success-item-img {
  width: 60px;
  height: 68px;
  object-fit: contain;
  background: #f8faf7;
  border: 1px solid #edf1eb;
  border-radius: 6px;
  padding: 2px;
  flex-shrink: 0;
}
.success-actions {
  display: flex;
  gap: 12px;
  justify-content: center;
  flex-wrap: wrap;
  margin-top: 32px;
}
.success-actions a {
  border-radius: 6px;
  padding: 12px 26px;
  font-size: 0.82rem;
  font-weight: 600;
  display: inline-flex;
  align-items: center;
  justify-content: center;
}

@media (max-width: 576px) {
  .success-card {
    padding: 28px 16px;
    margin: 16px auto;
    border-radius: 8px;
  }
  .success-card h1 {
    font-size: 1.85rem !important;
  }
  .order-meta-value {
    font-size: 0.88rem;
  }
  .success-actions {
    flex-direction: column;
  }
  .success-actions a {
    width: 100%;
  }
}
@keyframes scaleIn {
  from { transform: scale(0); opacity: 0; }
  to   { transform: scale(1); opacity: 1; }
}
</style>
@endpush

@section('content')
<div class="container-xl-custom py-4 py-md-5">
  <div class="success-card text-center">

    <div class="success-icon-wrap">
      <i class="bi bi-check-lg text-white" style="font-size:2.2rem;"></i>
    </div>

    <span class="section-label" style="color:var(--ayur-green);">Thank You</span>
    <h1 style="font-family:var(--font-serif);font-size:2.4rem;font-weight:400;margin-bottom:6px;color:var(--ayur-green-dark);">
      Order Confirmed!
    </h1>
    <p class="text-muted small mb-0">
      Your herbal wellness order has been placed successfully. A confirmation message has been sent to your account.
    </p>

    <!-- Order Quick Info -->
    <div class="order-meta-box">
      <div class="row g-2">
        <div class="col-6 col-sm-3 order-meta-item">
          <div class="order-meta-label">Order Number</div>
          <div class="order-meta-value">#{{ $order->order_number }}</div>
        </div>
        <div class="col-6 col-sm-3 order-meta-item">
          <div class="order-meta-label">Order Date</div>
          <div class="order-meta-value">{{ $order->created_at->format('d M Y') }}</div>
        </div>
        <div class="col-6 col-sm-3 order-meta-item">
          <div class="order-meta-label">Payment</div>
          <div class="order-meta-value text-capitalize">{{ str_replace('_', ' ', $order->payment_method ?? 'COD') }}</div>
        </div>
        <div class="col-6 col-sm-3 order-meta-item">
          <div class="order-meta-label">Total Amount</div>
          <div class="order-meta-value" style="color:var(--ayur-green-dark);">₨{{ number_format($order->total_amount, 2) }}</div>
        </div>
      </div>
    </div>

    <!-- Items Ordered -->
    <div class="text-start mt-4">
      <h5 style="font-family:var(--font-serif);font-size:1.15rem;font-weight:600;color:var(--ayur-green-dark);margin-bottom:14px;border-bottom:1px solid #edf1eb;padding-bottom:8px;">
        Items in This Order
      </h5>
      @foreach($order->items as $item)
      <div class="d-flex justify-content-between align-items-center py-3 gap-3" style="border-bottom:1px solid #f2f5f1;">
        <div class="d-flex align-items-center gap-3 flex-grow-1" style="min-width:0; overflow:hidden;">
          <img src="{{ $item->product?->primary_image ?: asset('uploads/placeholder.png') }}" class="success-item-img" alt="{{ $item->product_name }}">
          <div style="min-width:0; flex:1;">
            <div class="fw-600 small text-dark" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;line-height:1.35;">{{ $item->product_name }}</div>
            @if($item->variant_info)
              <div class="text-muted small" style="font-size:0.75rem;">{{ $item->variant_info }}</div>
            @endif
            <div class="text-muted small" style="font-size:0.75rem;">Qty: {{ $item->quantity }} × ₨{{ number_format($item->unit_price, 2) }}</div>
          </div>
        </div>
        <div class="fw-700 text-nowrap text-end flex-shrink-0" style="color:var(--ayur-green-dark);font-size:0.95rem;">
          ₨{{ number_format($item->total_price, 2) }}
        </div>
      </div>
      @endforeach

      <!-- Pricing Summary Breakdown -->
      <div class="pt-3">
        <div class="d-flex justify-content-between small py-1">
          <span class="text-muted">Subtotal</span>
          <span class="fw-semibold">₨{{ number_format($order->subtotal, 2) }}</span>
        </div>
        @if($order->discount_amount > 0)
        <div class="d-flex justify-content-between small py-1">
          <span class="text-muted">Discount</span>
          <span class="text-danger fw-semibold">-₨{{ number_format($order->discount_amount, 2) }}</span>
        </div>
        @endif
        <div class="d-flex justify-content-between small py-1">
          <span class="text-muted">Shipping</span>
          <span class="fw-semibold">{{ $order->shipping_amount > 0 ? '₨'.number_format($order->shipping_amount, 2) : 'Free' }}</span>
        </div>
        <div class="d-flex justify-content-between fw-bold border-top pt-2 mt-2" style="font-size:1.1rem;color:var(--ayur-green-dark);">
          <span>Total Paid</span>
          <span>₨{{ number_format($order->total_amount, 2) }}</span>
        </div>
      </div>
    </div>

    <!-- Actions -->
    <div class="success-actions">
      <a href="{{ route('account.orders') }}" class="btn-glamora">
        <i class="bi bi-bag-check me-2"></i> Track Your Order
      </a>
      <a href="{{ route('shop.index') }}" class="btn-outline-glamora">
        <i class="bi bi-shop me-2"></i> Continue Shopping
      </a>
    </div>

  </div>
</div>
@endsection
