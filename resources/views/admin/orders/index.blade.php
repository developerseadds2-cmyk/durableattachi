@extends('admin.layout.app')
@section('title', 'Orders')
@section('breadcrumb')
  <li class="breadcrumb-item active">Orders</li>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h4>Orders</h4>
    <p class="text-muted small mb-0">Manage all customer orders</p>
  </div>
  <div class="d-flex gap-2">
    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-download me-1"></i>Export</button>
  </div>
</div>

<!-- Status Tabs -->
<div class="d-flex gap-2 mb-4 flex-wrap">
  @php $statuses = ['all' => 'All', 'pending' => 'Pending', 'processing' => 'Processing', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled']; @endphp
  @foreach($statuses as $key => $label)
    <a href="{{ route('admin.orders.index', ['status' => $key == 'all' ? '' : $key]) }}"
       class="btn btn-sm {{ request('status', '') === ($key == 'all' ? '' : $key) ? 'btn-gold' : 'btn-outline-secondary' }}">
      {{ $label }}
      @if(isset($statusCounts[$key])) <span class="badge bg-white text-dark ms-1">{{ $statusCounts[$key] }}</span> @endif
    </a>
  @endforeach
</div>

<!-- Filters -->
<div class="form-card mb-4">
  <form method="GET" class="row g-2 align-items-end">
    <div class="col-md-3">
      <input type="text" name="search" class="form-control form-control-sm" placeholder="Order #, email, name..." value="{{ request('search') }}">
    </div>
    <div class="col-md-2">
      <select name="payment_status" class="form-select form-select-sm">
        <option value="">Payment Status</option>
        <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
        <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
      </select>
    </div>
    <div class="col-md-2">
      <input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}" placeholder="From">
    </div>
    <div class="col-md-2">
      <input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}" placeholder="To">
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-sm btn-gold">Filter</button>
      <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary ms-1">Reset</a>
    </div>
  </form>
</div>

<div class="admin-table">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Order #</th><th>Customer</th><th>Items</th><th>Total</th>
          <th>Payment</th><th>Status</th><th>Date</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($orders as $order)
        <tr>
          <td>
            <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}" class="fw-700 text-decoration-none text-dark">#{{ $order->order_number }}</a>
            @if($order->payment_method === 'cod') <span class="badge bg-secondary" style="font-size:0.6rem;">COD</span> @endif
          </td>
          <td>
            <div class="fw-600 small">{{ $order->billing_first_name }} {{ $order->billing_last_name }}</div>
            <div class="text-muted" style="font-size:0.75rem;">{{ $order->billing_email }}</div>
          </td>
          <td class="small text-muted">{{ $order->items->count() ?? '—' }} items</td>
          <td class="fw-700">₨{{ number_format($order->total_amount, 2) }}</td>
          <td>{!! $order->payment_status_badge !!}</td>
          <td>
            <select class="form-select form-select-sm status-select" data-order="{{ $order->id }}" style="width:auto; font-size:0.75rem;">
              @foreach(['pending','processing','confirmed','shipped','delivered','cancelled','refunded'] as $s)
                <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
              @endforeach
            </select>
          </td>
          <td class="small text-muted">{{ $order->created_at->format('d M Y') }}<br><span style="font-size:0.7rem;">{{ $order->created_at->format('h:i A') }}</span></td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}" class="btn btn-sm btn-light"><i class="bi bi-eye"></i></a>
              <a href="{{ route('admin.orders.invoice', ['order' => $order->id]) }}" class="btn btn-sm btn-light" target="_blank"><i class="bi bi-printer"></i></a>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center py-5 text-muted">
          <i class="bi bi-cart-x fs-1 d-block mb-2"></i>No orders found.
        </td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="p-3">{{ $orders->links() }}</div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.status-select').forEach(sel => {
  sel.addEventListener('change', function() {
    const orderId = this.dataset.order;
    const status  = this.value;
    fetch(`/admin/orders/${orderId}/update-status`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
      body: JSON.stringify({ status })
    })
    .then(r => r.json())
    .then(d => { if (d.success) { /* toast */ } });
  });
});
</script>
@endpush
