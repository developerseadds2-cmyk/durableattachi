@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('breadcrumb')
  <li class="breadcrumb-item active">Dashboard</li>
@endsection

@push('styles')
<style>
  .chart-container { position: relative; height: 300px; }
  .order-badge { display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 600; }

  /* Premium Stat Cards */
  .stat-card-modern {
    background: #ffffff;
    border-radius: 16px;
    padding: 22px 20px;
    height: 100%;
    border: 1px solid #edf2f7;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    transition: all 0.25s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .stat-card-modern:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(20, 45, 78, 0.08);
    border-color: #e2e8f0;
  }
  .stat-icon-wrap {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
  }
  .stat-icon-wrap.orders {
    background: #fff8eb;
    color: #d97706;
    border: 1px solid #fde68a;
  }
  .stat-icon-wrap.revenue {
    background: #ecfdf5;
    color: #059669;
    border: 1px solid #a7f3d0;
  }
  .stat-icon-wrap.customers {
    background: #eff6ff;
    color: #2563eb;
    border: 1px solid #bfdbfe;
  }
  .stat-icon-wrap.products {
    background: #fdf2f8;
    color: #db2777;
    border: 1px solid #fbcfe8;
  }

  .stat-val-text {
    font-size: 1.75rem;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.1;
    margin-bottom: 4px;
    letter-spacing: -0.5px;
  }
  .stat-lbl-text {
    font-size: 0.78rem;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.8px;
  }
  .stat-sub-info {
    font-size: 0.78rem;
    font-weight: 600;
    margin-top: 14px;
    padding-top: 10px;
    border-top: 1px dashed #f1f5f9;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .top-prod-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 8px 10px;
    border-radius: 10px;
    transition: background 0.2s;
  }
  .top-prod-item:hover {
    background: #f8fafc;
  }
  .top-prod-thumb {
    width: 44px;
    height: 44px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    background: #f8fafc;
  }
</style>
@endpush

@section('content')
<div class="page-header">
  <div>
    <h4>Dashboard</h4>
    <p class="text-muted small mb-0">Welcome back, {{ Auth::user()->name }}! Here's what's happening today.</p>
  </div>
  <div class="d-flex align-items-center gap-2">
    <span class="badge bg-white text-secondary border px-3 py-2 shadow-sm rounded-pill" style="font-weight:600;">
      <i class="fa-regular fa-calendar-days text-primary me-1"></i> {{ now()->format('D, d M Y') }}
    </span>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-gold px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-1.5">
      <i class="fa-solid fa-cart-shopping"></i>
      <span>Orders</span>
    </a>
  </div>
</div>

<!-- Stats Row -->
<div class="row g-3 g-xl-4 mb-4">
  <!-- Orders Card -->
  <div class="col-6 col-lg-3">
    <div class="stat-card-modern">
      <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="stat-icon-wrap orders">
          <i class="fa-solid fa-bag-shopping"></i>
        </div>
        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-2.5 py-1" style="font-size:0.72rem; font-weight:700;">
          <i class="fa-solid fa-clock-rotate-left me-1"></i> Orders
        </span>
      </div>
      <div>
        <div class="stat-val-text">{{ number_format($stats['total_orders']) }}</div>
        <div class="stat-lbl-text">Total Orders</div>
      </div>
      <div class="stat-sub-info text-warning-emphasis">
        <i class="fa-regular fa-clock"></i>
        <span>{{ $stats['pending_orders'] }} pending fulfillment</span>
      </div>
    </div>
  </div>

  <!-- Revenue Card -->
  <div class="col-6 col-lg-3">
    <div class="stat-card-modern">
      <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="stat-icon-wrap revenue">
          <i class="fa-solid fa-indian-rupee-sign"></i>
        </div>
        <span class="badge bg-success-subtle text-success-emphasis border border-success-subtle rounded-pill px-2.5 py-1" style="font-size:0.72rem; font-weight:700;">
          <i class="fa-solid fa-arrow-trend-up me-1"></i> Revenue
        </span>
      </div>
      <div>
        <div class="stat-val-text">₹{{ number_format($stats['total_revenue']) }}</div>
        <div class="stat-lbl-text">Total Revenue</div>
      </div>
      <div class="stat-sub-info text-success">
        <i class="fa-solid fa-calendar-day"></i>
        <span>Today: ₹{{ number_format($stats['today_revenue']) }}</span>
      </div>
    </div>
  </div>

  <!-- Customers Card -->
  <div class="col-6 col-lg-3">
    <div class="stat-card-modern">
      <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="stat-icon-wrap customers">
          <i class="fa-solid fa-users"></i>
        </div>
        <span class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle rounded-pill px-2.5 py-1" style="font-size:0.72rem; font-weight:700;">
          <i class="fa-regular fa-user me-1"></i> Users
        </span>
      </div>
      <div>
        <div class="stat-val-text">{{ number_format($stats['total_customers']) }}</div>
        <div class="stat-lbl-text">Total Customers</div>
      </div>
      <div class="stat-sub-info text-primary">
        <i class="fa-solid fa-user-plus"></i>
        <span>{{ $stats['new_customers'] }} joined this month</span>
      </div>
    </div>
  </div>

  <!-- Products Card -->
  <div class="col-6 col-lg-3">
    <div class="stat-card-modern">
      <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="stat-icon-wrap products">
          <i class="fa-solid fa-boxes-stacked"></i>
        </div>
        @if($stats['low_stock'] > 0)
          <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2.5 py-1" style="font-size:0.72rem; font-weight:700;">
            {{ $stats['low_stock'] }} Low
          </span>
        @else
          <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1" style="font-size:0.72rem; font-weight:700;">
            Healthy
          </span>
        @endif
      </div>
      <div>
        <div class="stat-val-text">{{ number_format($stats['total_products']) }}</div>
        <div class="stat-lbl-text">Total Products</div>
      </div>
      <div class="stat-sub-info {{ $stats['low_stock'] > 0 ? 'text-danger' : 'text-muted' }}">
        <i class="fa-solid {{ $stats['low_stock'] > 0 ? 'fa-triangle-exclamation' : 'fa-check' }}"></i>
        <span>{{ $stats['low_stock'] }} items low stock</span>
      </div>
    </div>
  </div>
</div>

<!-- Charts + Top Products -->
<div class="row g-4 mb-4">
  <div class="col-lg-8">
    <div class="form-card h-100">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h6 class="fw-bold mb-1 text-dark d-flex align-items-center gap-2">
            <i class="fa-solid fa-chart-line text-primary"></i> Revenue &amp; Orders Overview
          </h6>
          <span class="text-muted small">Sales trajectory over the last 6 months</span>
        </div>
        <span class="badge bg-light text-dark border px-2.5 py-1.5" style="font-size:0.75rem; font-weight:600;">
          Last 6 Months
        </span>
      </div>
      <div class="chart-container">
        <canvas id="revenueChart"></canvas>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="form-card h-100 d-flex flex-column justify-content-between">
      <div>
        <h6 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2">
          <i class="fa-solid fa-bolt text-warning"></i> Quick Actions &amp; Alerts
        </h6>
        <div class="d-flex flex-column gap-2 mb-4">
          <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 border border-slate-100">
            <div class="d-flex align-items-center gap-2.5">
              <div class="text-primary fs-5"><i class="fa-regular fa-envelope"></i></div>
              <div>
                <div class="small fw-bold text-dark">Unread Messages</div>
                <div class="small text-muted">{{ $stats['unread_contacts'] }} inquiries</div>
              </div>
            </div>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-secondary px-3" style="border-radius:6px; font-weight:600;">View</a>
          </div>

          <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 border border-slate-100">
            <div class="d-flex align-items-center gap-2.5">
              <div class="text-warning fs-5"><i class="fa-regular fa-star"></i></div>
              <div>
                <div class="small fw-bold text-dark">Pending Reviews</div>
                <div class="small text-muted">{{ $stats['pending_reviews'] }} to approve</div>
              </div>
            </div>
            <a href="{{ route('admin.reviews.index') }}" class="btn btn-sm btn-outline-secondary px-3" style="border-radius:6px; font-weight:600;">View</a>
          </div>

          <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-3 border border-slate-100">
            <div class="d-flex align-items-center gap-2.5">
              <div class="text-danger fs-5"><i class="fa-solid fa-cubes-stacked"></i></div>
              <div>
                <div class="small fw-bold text-dark">Low Stock Items</div>
                <div class="small text-danger fw-600">{{ $stats['low_stock'] }} items</div>
              </div>
            </div>
            <a href="{{ route('admin.products.index', ['stock' => 'low']) }}" class="btn btn-sm btn-outline-danger px-3" style="border-radius:6px; font-weight:600;">View</a>
          </div>
        </div>
      </div>

      <!-- Top Products -->
      @if($topProducts->count() > 0)
      <div class="pt-3 border-top">
        <h6 class="fw-bold mb-2.5 text-dark" style="font-size:0.88rem;">
          <i class="fa-solid fa-trophy text-warning me-1"></i> Top Products
        </h6>
        @foreach($topProducts as $product)
        <div class="top-prod-item">
          <img src="{{ $product->thumbnail_url }}" alt="" class="top-prod-thumb">
          <div class="flex-grow-1 small overflow-hidden">
            <div class="text-truncate fw-bold text-dark">{{ $product->name }}</div>
            <div class="text-muted" style="font-size:0.75rem;">{{ $product->order_items_count }} units sold</div>
          </div>
        </div>
        @endforeach
      </div>
      @endif
    </div>
  </div>
</div>

<!-- Recent Orders -->
<div class="admin-table">
  <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
    <div>
      <h6 class="fw-bold mb-1 text-dark d-flex align-items-center gap-2">
        <i class="fa-solid fa-receipt text-secondary"></i> Recent Orders
      </h6>
      <p class="text-muted small mb-0">Latest customer transactions</p>
    </div>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-gold px-3 py-1.5 rounded-3">
      <span>View All Orders</span>
      <i class="fa-solid fa-arrow-right ms-1"></i>
    </a>
  </div>
  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr>
          <th>Order #</th>
          <th>Customer</th>
          <th>Amount</th>
          <th>Payment</th>
          <th>Status</th>
          <th>Date</th>
          <th class="text-end">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse($recentOrders as $order)
        <tr>
          <td>
            <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}" class="fw-bold text-decoration-none text-primary">
              #{{ $order->order_number }}
            </a>
          </td>
          <td>
            <div class="fw-bold small text-dark">{{ $order->billing_first_name }} {{ $order->billing_last_name }}</div>
            <div class="text-muted" style="font-size:0.75rem;">{{ $order->billing_email }}</div>
          </td>
          <td class="fw-bold text-dark">₹{{ number_format($order->total_amount, 2) }}</td>
          <td>{!! $order->payment_status_badge !!}</td>
          <td>{!! $order->status_badge !!}</td>
          <td class="small text-muted">{{ $order->created_at->diffForHumans() }}</td>
          <td class="text-end">
            <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}" class="btn btn-sm btn-light border" title="View Order">
              <i class="fa-solid fa-eye text-secondary"></i>
            </a>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center text-muted py-4">No orders placed yet</td></tr>
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
        label: 'Revenue (₹)',
        data: revenue,
        backgroundColor: 'rgba(20, 45, 78, 0.12)',
        borderColor: '#142D4E',
        borderWidth: 2,
        borderRadius: 8,
        yAxisID: 'y',
      },
      {
        label: 'Orders',
        data: orders,
        type: 'line',
        borderColor: '#C59A55',
        backgroundColor: 'rgba(197, 154, 85, 0.15)',
        borderWidth: 2.5,
        pointBackgroundColor: '#C59A55',
        pointRadius: 4,
        tension: 0.35,
        yAxisID: 'y1',
      }
    ]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    interaction: { mode: 'index', intersect: false },
    plugins: {
      legend: { position: 'top', labels: { font: { size: 12, weight: 600 } } }
    },
    scales: {
      y: {
        type: 'linear',
        position: 'left',
        grid: { color: '#f1f5f9' },
        ticks: { callback: v => '₹' + v.toLocaleString() }
      },
      y1: {
        type: 'linear',
        position: 'right',
        grid: { drawOnChartArea: false },
        ticks: { precision: 0 }
      }
    }
  }
});
</script>
@endpush
