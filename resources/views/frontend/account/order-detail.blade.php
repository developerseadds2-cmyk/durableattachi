@extends('frontend.layouts.app')
@section('title', 'Order #{{ $order->order_number }} — Ayur Naman')

@section('content')
<div class="account-hero">
  <div class="container-xl-custom">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
      <div>
        <h4 style="font-family:var(--font-serif);font-weight:400;margin-bottom:4px;">Order #{{ $order->order_number }}</h4>
        <p class="text-muted small mb-0">Placed on {{ $order->created_at->format('d M Y, h:i A') }}</p>
      </div>
      <a href="{{ route('account.orders') }}" class="btn-outline-glamora" style="padding:9px 20px;font-size:0.75rem;border-radius:6px;">
        <i class="bi bi-arrow-left me-1"></i> Back to Orders
      </a>
    </div>
  </div>
</div>

<div class="container-xl-custom py-4 py-md-5">
  <div class="row g-4">
    <!-- Sidebar -->
    <div class="col-lg-3">
      @include('frontend.account.partials.sidebar')
    </div>

    <!-- Order Detail -->
    <div class="col-lg-9">

      <!-- Status Bar -->
      <div class="account-card mb-4" style="padding:18px 24px;">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
          <div class="d-flex align-items-center gap-3">
            <span class="text-muted small fw-semibold">Status:</span>
            {!! $order->status_badge !!}
          </div>
          <div class="d-flex align-items-center gap-3">
            <span class="text-muted small fw-semibold">Payment:</span>
            <span class="badge" style="background:{{ $order->payment_status === 'paid' ? '#d1fae5' : '#fee2e2' }};color:{{ $order->payment_status === 'paid' ? '#065f46' : '#991b1b' }};font-size:0.75rem;padding:5px 12px;border-radius:20px;font-weight:600;text-transform:capitalize;">
              {{ ucfirst($order->payment_status ?? 'pending') }}
            </span>
          </div>
        </div>
      </div>

      <!-- Order Items -->
      <div class="account-card mb-4">
        <h5 style="font-family:var(--font-serif);font-size:1.15rem;margin-bottom:20px;color:var(--ayur-green-dark);border-bottom:1px solid #eef2ec;padding-bottom:12px;">Items Ordered</h5>
        @foreach($order->items as $item)
        <div class="d-flex gap-3 py-3" style="border-bottom:1px solid #f0f0f0;">
          <div style="width:70px;height:75px;background:#f8f9fa;border-radius:6px;flex-shrink:0;overflow:hidden;border:1px solid #ecefe9;">
            @if($item->product && $item->product->primary_image)
              <img src="{{ $item->product->primary_image }}" alt="{{ $item->product_name }}" style="width:100%;height:100%;object-fit:cover;">
            @else
              <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                <i class="bi bi-image text-muted" style="font-size:1.4rem;"></i>
              </div>
            @endif
          </div>
          <div class="flex-grow-1">
            <div style="font-weight:600;font-size:0.92rem;margin-bottom:4px;color:var(--dark);">{{ $item->product_name }}</div>
            @if($item->variant_info)
              <div class="text-muted small mb-2">{{ $item->variant_info }}</div>
            @endif
            <div class="text-muted small">Qty: {{ $item->quantity }} × ₨{{ number_format($item->unit_price, 2) }}</div>
          </div>
          <div style="font-weight:700;font-size:0.95rem;color:var(--ayur-green-dark);white-space:nowrap;">₨{{ number_format($item->total_price, 2) }}</div>
        </div>
        @endforeach

        <!-- Totals -->
        <div class="mt-4 pt-2">
          <div class="d-flex justify-content-between py-2 small">
            <span class="text-muted">Subtotal</span>
            <span class="fw-semibold">₨{{ number_format($order->subtotal, 2) }}</span>
          </div>
          @if($order->discount_amount > 0)
          <div class="d-flex justify-content-between py-2 small">
            <span class="text-muted">Discount</span>
            <span style="color:#dc3545;font-weight:600;">−₨{{ number_format($order->discount_amount, 2) }}</span>
          </div>
          @endif
          <div class="d-flex justify-content-between py-2 small">
            <span class="text-muted">Shipping</span>
            <span class="fw-semibold">{{ $order->shipping_amount > 0 ? '₨'.number_format($order->shipping_amount, 2) : 'Free' }}</span>
          </div>
          @if($order->tax_amount > 0)
          <div class="d-flex justify-content-between py-2 small">
            <span class="text-muted">Tax</span>
            <span class="fw-semibold">₨{{ number_format($order->tax_amount, 2) }}</span>
          </div>
          @endif
          <div class="d-flex justify-content-between py-3 mt-2" style="border-top:2px solid var(--border);">
            <span style="font-weight:700;font-size:1rem;color:var(--dark);">Total</span>
            <span style="font-weight:700;font-size:1.15rem;color:var(--ayur-green-dark);">₨{{ number_format($order->total_amount, 2) }}</span>
          </div>
        </div>
      </div>

      <!-- Shipping & Billing -->
      <div class="row g-4">
        <div class="col-md-6">
          <div class="account-card h-100">
            <h6 style="font-size:0.75rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--ayur-green-dark);margin-bottom:14px;border-bottom:1px solid #eef2ec;padding-bottom:10px;">
              <i class="bi bi-geo-alt me-1 text-ayur-leaf"></i> Shipping Address
            </h6>
            @if($order->shipping_address)
              @php $addr = is_array($order->shipping_address) ? $order->shipping_address : json_decode($order->shipping_address, true); @endphp
              <p style="font-size:0.88rem;line-height:1.8;margin:0;color:var(--text);">
                <strong>{{ ($addr['first_name'] ?? '') . ' ' . ($addr['last_name'] ?? '') }}</strong><br>
                {{ $addr['address_line1'] ?? '' }}<br>
                @if(!empty($addr['address_line2'])){{ $addr['address_line2'] }}<br>@endif
                {{ ($addr['city'] ?? '') . ', ' . ($addr['state'] ?? '') . ' ' . ($addr['postal_code'] ?? '') }}<br>
                {{ $addr['country'] ?? '' }}
              </p>
            @else
              <p class="text-muted small">No shipping address on record.</p>
            @endif
          </div>
        </div>
        <div class="col-md-6">
          <div class="account-card h-100">
            <h6 style="font-size:0.75rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--ayur-green-dark);margin-bottom:14px;border-bottom:1px solid #eef2ec;padding-bottom:10px;">
              <i class="bi bi-credit-card me-1 text-ayur-leaf"></i> Payment Method
            </h6>
            @if($order->payments->count())
              @php $payment = $order->payments->first(); @endphp
              <p style="font-size:0.88rem;line-height:1.8;margin:0;color:var(--text);">
                <strong>{{ ucfirst(str_replace('_', ' ', $payment->payment_method ?? 'N/A')) }}</strong><br>
                <span class="text-muted">{{ ucfirst($payment->status ?? 'pending') }}</span>
              </p>
            @else
              <p class="text-muted small">No payment info available.</p>
            @endif
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection