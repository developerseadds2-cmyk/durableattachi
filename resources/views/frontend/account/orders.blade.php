@extends('frontend.layouts.app')
@section('title', 'My Orders — Ayur Naman')

@section('content')
<div class="account-hero">
  <div class="container-xl-custom">
    <h4 style="font-family:var(--font-serif);font-weight:500;color:var(--ayur-green-dark);margin:0;">My Orders</h4>
  </div>
</div>

<div class="container-xl-custom py-4 py-md-5">
  <div class="row g-4">
    <!-- Sidebar -->
    <div class="col-lg-3">
      @include('frontend.account.partials.sidebar')
    </div>

    <!-- Orders List -->
    <div class="col-lg-9">
      <div style="background:#fff;border:1px solid var(--border);padding:28px;">
        <h5 style="font-family:var(--font-serif);font-size:1.2rem;margin-bottom:24px;">Order History</h5>

        @forelse($orders as $order)
        <div style="border:1px solid var(--border);padding:20px;margin-bottom:16px;">
          <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
            <div>
              <div class="d-flex align-items-center gap-3 mb-1">
                <span style="font-weight:600;font-size:0.9rem;">#{{ $order->order_number }}</span>
                {!! $order->status_badge !!}
              </div>
              <div class="text-muted small">Placed on {{ $order->created_at->format('d M Y') }}</div>
              <div class="text-muted small mt-1">{{ $order->items->count() }} item(s)</div>
            </div>
            <div class="text-end">
              <div style="font-size:1.1rem;font-weight:700;color:var(--dark);">₨{{ number_format($order->total_amount, 2) }}</div>
              <a href="{{ route('account.orders.detail', $order->order_number) }}" class="btn-outline-glamora d-inline-flex mt-2" style="padding:7px 18px;font-size:0.72rem;">
                View Details
              </a>
            </div>
          </div>

          @if($order->items->count())
          <div class="d-flex gap-2 mt-3 flex-wrap">
            @foreach($order->items->take(4) as $item)
            <div style="width:54px;height:60px;background:var(--pd-ice);overflow:hidden;flex-shrink:0;">
              @if($item->product && $item->product->primary_image)
                <img src="{{ $item->product->primary_image }}" alt="{{ $item->product_name }}" style="width:100%;height:100%;object-fit:cover;">
              @else
                <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                  <i class="bi bi-image text-muted" style="font-size:1.2rem;"></i>
                </div>
              @endif
            </div>
            @endforeach
            @if($order->items->count() > 4)
              <div style="width:54px;height:60px;background:var(--pd-ice);display:flex;align-items:center;justify-content:center;font-size:0.8rem;color:var(--text-muted);">
                +{{ $order->items->count() - 4 }}
              </div>
            @endif
          </div>
          @endif
        </div>
        @empty
        <div class="text-center py-5">
          <i class="bi bi-bag" style="font-size:3rem;color:var(--border);display:block;margin-bottom:16px;"></i>
          <p class="text-muted mb-3">You haven't placed any orders yet.</p>
          <a href="{{ route('shop.index') }}" class="btn-glamora" style="padding:11px 28px;">Start Shopping</a>
        </div>
        @endforelse

        @if($orders->hasPages())
        <div class="mt-4">{{ $orders->links() }}</div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
