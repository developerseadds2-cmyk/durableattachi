@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('breadcrumb')
  <li class="breadcrumb-item active">Dashboard</li>
@endsection

@push('styles')
<style>
  .chart-container { position: relative; height: 280px; }
  .order-badge { display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 600; }
</style>
@endpush

@section('content')
<div class="page-header">
  <div>
    <h4>Dashboard</h4>
    <p class="text-muted small mb-0">Welcome back, {{ Auth::user()->name }}! Here's what's happening.</p>
  </div>
  <div class="d-flex gap-2">
    <span class="badge bg-light text-dark border px-3 py-2">
      <i class="bi bi-calendar3 me-1"></i>{{ now()->format('D, d M Y') }}
    </span>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-gold btn-sm px-3">
      <i class="bi bi-cart-plus me-1"></i>New Order
    </a>
  </div>
</div>

<!-- Stats Row -->
<div class="row g-4 mb-4">
  <div class="col-6 col-md-3">
    <div class="stat-card">
      <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="stat-icon bg-warning bg-opacity-15"><i class="bi bi-cart-check text-warning fs-4"></i></div>
        <span class="badge bg-success bg-opacity-15 text-success small">Today</span>
      </div>
      <div class="stat-value">{{ number_format($stats['total_orders']) }}</div>
      <div class="stat-label">Total Orders</div>
      <div class="mt-2 small text-warning"><i class="bi bi-clock me-1"></i>{{ $stats['pending_orders'] }} pending</div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="stat-card">
      <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="stat-icon bg-success bg-opacity-15"><i class="bi bi-currency-dollar text-success fs-4"></i></div>
        <span class="badge bg-success bg-opacity-15 text-success small">+12%</span>
      </div>
      <div class="stat-value">₨{{ number_format($stats['total_revenue']) }}</div>
      <div class="stat-label">Total Revenue</div>
      <div class="mt-2 small text-success"><i class="bi bi-arrow-up me-1"></i>Today: ₨{{ number_format($stats['today_revenue']) }}</div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="stat-card">
      <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="stat-icon bg-primary bg-opacity-15"><i class="bi bi-people text-primary fs-4"></i></div>
        <span class="badge bg-primary bg-opacity-15 text-primary small">New</span>
      </div>
      <div class="stat-value">{{ number_format($stats['total_customers']) }}</div>
      <div class="stat-label">Customers</div>
      <div class="mt-2 small text-primary"><i class="bi bi-person-plus me-1"></i>{{ $stats['new_customers'] }} this month</div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="stat-card">
      <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="stat-icon bg-danger bg-opacity-15"><i class="bi bi-bag-heart text-danger fs-4"></i></div>
        <span class="badge bg-danger bg-opacity-15 text-danger small">{{ $stats['low_stock'] }} Low</span>
      </div>
      <div class="stat-value">{{ number_format($stats['total_products']) }}</div>
      <div class="stat-label">Products</div>
      <div class="mt-2 small text-danger"><i class="bi bi-exclamation-triangle me-1"></i>{{ $stats['low_stock'] }} low stock</div>
    </div>
  </div>
</div>

<!-- Charts + Top Products -->
<div class="row g-4 mb-4">
  <div class="col-lg-8">
    <div class="form-card">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">Revenue Overview</h6>
        <span class="text-muted small">Last 6 months</span>
      </div>
      <div class="chart-container">
        <canvas id="revenueChart"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="form-card h-100">
      <h6 class="fw-bold mb-3">Quick Stats</h6>
      <div class="d-flex flex-column gap-3">
        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3">
          <div><div class="small text-muted">Unread Messages</div><div class="fw-bold">{{ $stats['unread_contacts'] }}</div></div>
          <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-secondary">View</a>
        </div>
        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3">
          <div><div class="small text-muted">Pending Reviews</div><div class="fw-bold">{{ $stats['pending_reviews'] }}</div></div>
          <a href="{{ route('admin.reviews.index') }}" class="btn btn-sm btn-outline-secondary">View</a>
        </div>
        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3">
          <div><div class="small text-muted">Low Stock Items</div><div class="fw-bold text-danger">{{ $stats['low_stock'] }}</div></div>
          <a href="{{ route('admin.products.index', ['stock' => 'low']) }}" class="btn btn-sm btn-outline-danger">View</a>
        </div>
      </div>

      <!-- Top Products -->
      <h6 class="fw-bold mt-4 mb-3">Top Products</h6>
      @foreach($topProducts as $product)
      <div class="d-flex align-items-center gap-2 mb-2">
        <img src="{{ $product->thumbnail_url }}" alt="" style="width:36px;height:36px;object-fit:cover;border-radius:6px;">
        <div class="flex-grow-1 small overflow-hidden">
          <div class="text-truncate fw-600" style="max-width:140px;">{{ $product->name }}</div>
          <div class="text-muted">{{ $product->order_items_count }} sales</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

<!-- Recent Orders -->
<div class="admin-table">
  <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
    <h6 class="fw-bold mb-0">Recent Orders</h6>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-gold">View All</a>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Order #</th><th>Customer</th><th>Amount</th>
          <th>Payment</th><th>Status</th><th>Date</th><th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recentOrders as $order)
        <tr>
          <td><a href="{{ route('admin.orders.show', ['order' => $order->id]) }}" class="fw-600 text-decoration-none text-dark">#{{ $order->order_number }}</a></td>
          <td>
            <div class="fw-600 small">{{ $order->billing_first_name }} {{ $order->billing_last_name }}</div>
            <div class="text-muted" style="font-size:0.75rem;">{{ $order->billing_email }}</div>
          </td>
          <td class="fw-600">₨{{ number_format($order->total_amount, 2) }}</td>
          <td>{!! $order->payment_status_badge !!}</td>
          <td>{!! $order->status_badge !!}</td>
          <td class="small text-muted">{{ $order->created_at->diffForHumans() }}</td>
          <td>
            <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}" class="btn btn-sm btn-light">
              <i class="bi bi-eye"></i>
            </a>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center text-muted py-4">No orders yet</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const chartData = @json($chartData);
const labels    = chartData.map(d => d.month);
const revenue   = chartData.map(d => parseFloat(d.revenue));
const orders    = chartData.map(d => parseInt(d.orders));

const ctx = document.getElementById('revenueChart').getContext('2d');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels,
    datasets: [
      {
        label: 'Revenue (₨)',
        data: revenue,
        backgroundColor: 'rgba(201,169,110,0.2)',
        borderColor: '#c9a96e',
        borderWidth: 2,
        borderRadius: 6,
        yAxisID: 'y',
      },
      {
        label: 'Orders',
        data: orders,
        type: 'line',
        borderColor: '#0f3460',
        backgroundColor: 'rgba(15,52,96,0.1)',
        borderWidth: 2,
        pointBackgroundColor: '#0f3460',
        tension: 0.4,
        yAxisID: 'y1',
      }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    interaction: { mode: 'index', intersect: false },
    plugins: { legend: { position: 'top', labels: { font: { size: 12 } } } },
    scales: {
      y: { type: 'linear', position: 'left', grid: { color: '#f0f0f0' },
        ticks: { callback: v => '₨' + v.toLocaleString() } },
      y1: { type: 'linear', position: 'right', grid: { drawOnChartArea: false },
        ticks: { precision: 0 } }
    }
  }
});
</script>
@endpush
