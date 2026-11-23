@extends('admin.layout.app')
@section('title', 'Order #' . $order->order_number)
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
  <li class="breadcrumb-item active">#{{ $order->order_number }}</li>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h4>Order #{{ $order->order_number }}</h4>
    <p class="text-muted small mb-0">Placed {{ $order->created_at->format('d M Y, h:i A') }}</p>
  </div>
  <div class="d-flex gap-2">
    <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="bi bi-printer me-1"></i>Invoice</a>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Back</a>
  </div>
</div>

<div class="row g-4">
  <!-- Order Items -->
  <div class="col-lg-8">
    <div class="form-card mb-4">
      <h6 class="fw-bold mb-3 pb-2 border-bottom">Order Items</h6>
      @foreach($order->items as $item)
      <div class="d-flex gap-3 mb-3 pb-3 border-bottom">
        <img src="{{ $item->product ? $item->product->thumbnail_url : asset('images/product-placeholder.jpg') }}"
          alt="{{ $item->product_name }}" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">
        <div class="flex-grow-1">
          <div class="fw-600">{{ $item->product_name }}</div>
          <div class="text-muted small">SKU: {{ $item->product_sku ?? '—' }}</div>
          @if($item->attributes)
            @foreach($item->attributes as $k => $v)
              <span class="badge bg-light text-dark small">{{ $k }}: {{ $v }}</span>
            @endforeach
          @endif
        </div>
        <div class="text-end">
          <div class="fw-600">₨{{ number_format($item->total_price, 2) }}</div>
          <div class="text-muted small">₨{{ number_format($item->unit_price, 2) }} × {{ $item->quantity }}</div>
        </div>
      </div>
      @endforeach

      <!-- Totals -->
      <div class="ms-auto" style="max-width:300px;">
        <div class="d-flex justify-content-between mb-1 small">
          <span class="text-muted">Subtotal</span>
          <span>₨{{ number_format($order->subtotal, 2) }}</span>
        </div>
        @if($order->discount_amount > 0)
        <div class="d-flex justify-content-between mb-1 small">
          <span class="text-muted">Discount ({{ $order->coupon_code }})</span>
          <span class="text-success">-₨{{ number_format($order->discount_amount, 2) }}</span>
        </div>
        @endif
        <div class="d-flex justify-content-between mb-1 small">
          <span class="text-muted">Shipping</span>
          <span>{{ $order->shipping_amount > 0 ? '₨'.number_format($order->shipping_amount, 2) : 'Free' }}</span>
        </div>
        <div class="d-flex justify-content-between fw-bold pt-2 border-top">
          <span>Total</span>
          <span>₨{{ number_format($order->total_amount, 2) }}</span>
        </div>
      </div>
    </div>

    <!-- Update Order -->
    <div class="form-card">
      <h6 class="fw-bold mb-3 pb-2 border-bottom">Update Order</h6>
      <form method="POST" action="{{ route('admin.orders.update', $order) }}">
        @csrf @method('PUT')
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Order Status</label>
            <select name="status" class="form-select form-select-sm">
              @foreach(['pending','processing','confirmed','shipped','delivered','cancelled','refunded'] as $s)
                <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Tracking Number</label>
            <input type="text" name="tracking_number" class="form-control form-control-sm" value="{{ $order->tracking_number }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">Admin Notes</label>
            <input type="text" name="notes" class="form-control form-control-sm" value="{{ $order->notes }}">
          </div>
        </div>
        <button type="submit" class="btn btn-gold btn-sm mt-3"><i class="bi bi-check-lg me-1"></i>Update Order</button>
      </form>
    </div>
  </div>

  <!-- Right Side -->
  <div class="col-lg-4">
    <!-- Status -->
    <div class="form-card mb-4">
      <h6 class="fw-bold mb-3 pb-2 border-bottom">Order Status</h6>
      <div class="d-flex justify-content-between mb-2">
        <span class="small text-muted">Order Status</span>
        {!! $order->status_badge !!}
      </div>
      <div class="d-flex justify-content-between mb-2">
        <span class="small text-muted">Payment</span>
        {!! $order->payment_status_badge !!}
      </div>
      <div class="d-flex justify-content-between">
        <span class="small text-muted">Method</span>
        <span class="small fw-600 text-uppercase">{{ $order->payment_method }}</span>
      </div>
    </div>

    <!-- Customer -->
    <div class="form-card mb-4">
      <h6 class="fw-bold mb-3 pb-2 border-bottom">Customer</h6>
      @if($order->user)
        <div class="d-flex align-items-center gap-2 mb-2">
          <img src="{{ $order->user->avatar_url }}" class="user-avatar" alt="">
          <div><div class="fw-600 small">{{ $order->user->name }}</div><div class="text-muted" style="font-size:0.75rem;">{{ $order->user->email }}</div></div>
        </div>
        <a href="{{ route('admin.users.show', $order->user) }}" class="btn btn-sm btn-outline-secondary w-100 mt-2">View Profile</a>
      @else
        <p class="text-muted small mb-0">Guest checkout</p>
      @endif
    </div>

    <!-- Billing -->
    <div class="form-card mb-4">
      <h6 class="fw-bold mb-3 pb-2 border-bottom">Billing Address</h6>
      <div class="small">
        <strong>{{ $order->billing_first_name }} {{ $order->billing_last_name }}</strong><br>
        {{ $order->billing_address }}<br>
        {{ $order->billing_city }}, {{ $order->billing_state }} {{ $order->billing_postal_code }}<br>
        {{ $order->billing_country }}<br>
        <i class="bi bi-phone me-1"></i>{{ $order->billing_phone }}<br>
        <i class="bi bi-envelope me-1"></i>{{ $order->billing_email }}
      </div>
    </div>

    <!-- Shipping -->
    @if($order->shipping_address)
    <div class="form-card">
      <h6 class="fw-bold mb-3 pb-2 border-bottom">Shipping Address</h6>
      <div class="small">
        <strong>{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</strong><br>
        {{ $order->shipping_address }}<br>
        {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_postal_code }}<br>
        {{ $order->shipping_country }}
        @if($order->tracking_number)
          <div class="mt-2 p-2 bg-light rounded"><i class="bi bi-truck me-1"></i><strong>Tracking:</strong> {{ $order->tracking_number }}</div>
        @endif
      </div>
    </div>
    @endif
  </div>
</div>
@endsection
