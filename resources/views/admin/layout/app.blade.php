<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Dashboard') — Durable Suitcase House Admin</title>
<link rel="icon" href="{{ asset('uploads/favicon.png') }}" type="image/png">
<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<!-- Font Awesome 6 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
  :root {
    --admin-gold: #c9a96e;
    --admin-dark: #142D4E;
    --admin-sidebar: #142D4E;
    --admin-sidebar-hover: #1e3f6b;
    --admin-text: #e0e0e0;
    --admin-accent: #c9a96e;
  }
  body { background: #f0f2f5; font-family: 'Segoe UI', sans-serif; }

  /* Sidebar */
  #sidebar {
    width: 260px; height: 100vh; max-height: 100vh; background: #142D4E;
    position: fixed; top: 0; left: 0; z-index: 1000;
    transition: all 0.3s ease; overflow-x: hidden; overflow-y: auto;
    scrollbar-width: thin; scrollbar-color: rgba(255,255,255,0.28) transparent;
    border-right: 1px solid rgba(255, 255, 255, 0.08);
  }
  #sidebar.collapsed { width: 70px; }
  #sidebar.collapsed .sidebar-label, #sidebar.collapsed .sidebar-logo-text,
  #sidebar.collapsed .sidebar-category, #sidebar.collapsed .badge { display: none !important; }
  #sidebar.collapsed .nav-link { justify-content: center; padding: 12px 0; }
  #sidebar.collapsed .nav-link i { margin: 0; font-size: 1.3rem; }

  .sidebar-header {
    padding: 16px 20px; border-bottom: 1px solid rgba(255,255,255,0.1);
    display: flex; align-items: center; justify-content: center;
    background: rgba(0, 0, 0, 0.15);
  }
  .sidebar-brand-link {
    display: flex; align-items: center; justify-content: center; width: 100%; text-decoration: none;
  }
  .sidebar-brand-img {
    height: 36px; max-width: 180px; object-fit: contain; filter: brightness(0) invert(1);
  }

  .sidebar-category {
    padding: 10px 18px 4px; font-size: 0.62rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.35);
  }

  #sidebar .nav-link {
    color: rgba(255,255,255,0.78); padding: 8px 14px; border-radius: 7px;
    margin: 1px 8px; display: flex; align-items: center; gap: 10px;
    font-size: 0.85rem; font-weight: 500; transition: all 0.2s; text-decoration: none;
  }
  #sidebar .nav-link:hover, #sidebar .nav-link.active {
    background: var(--admin-sidebar-hover); color: #fff;
  }
  #sidebar .nav-link.active { background: var(--admin-gold); color: #1a1a2e; font-weight: 600; }
  #sidebar .nav-link i { font-size: 0.95rem; width: 18px; flex-shrink: 0; }

  /* Submenu */
  .submenu { display: none; padding-left: 14px; margin-bottom: 4px; }
  .submenu.show { display: block; }
  .submenu .nav-link { font-size: 0.8rem; padding: 6px 12px; margin: 1px 6px; }
  .submenu .nav-link::before { content: '›'; margin-right: 6px; }
  .has-submenu > .nav-link { position: relative; }
  .has-submenu > .nav-link .arrow { margin-left: auto; transition: transform 0.2s; font-size: 0.75rem; }
  .has-submenu.open > .nav-link .arrow { transform: rotate(90deg); }

  /* Topbar */
  #topbar {
    height: 64px; background: #fff; box-shadow: 0 1px 10px rgba(0,0,0,0.08);
    display: flex; align-items: center; padding: 0 24px; gap: 16px;
    margin-left: 260px; transition: margin-left 0.3s ease; position: sticky; top: 0; z-index: 999;
  }
  #topbar.expanded { margin-left: 70px; }
  .main-content { margin-left: 260px; transition: margin-left 0.3s ease; padding: 24px; }
  .main-content.expanded { margin-left: 70px; }

  /* Cards */
  .stat-card {
    background: #fff; border-radius: 16px; padding: 24px; height: 100%;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06); border: none; transition: transform 0.2s, box-shadow 0.2s;
  }
  .stat-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.12); }
  .stat-icon {
    width: 52px; height: 52px; border-radius: 12px; display: flex;
    align-items: center; justify-content: center; font-size: 1.4rem;
  }
  .stat-value { font-size: 1.8rem; font-weight: 700; color: #1a1a2e; }
  .stat-label { font-size: 0.8rem; color: #888; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; }

  /* Tables */
  .admin-table { background: #fff; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); overflow: hidden; }
  .admin-table .table { margin: 0; }
  .admin-table .table th { background: #f8f9ff; font-size: 0.75rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.5px; color: #666; border: none; padding: 14px 16px; }
  .admin-table .table td { padding: 14px 16px; vertical-align: middle; border-color: #f0f0f0; font-size: 0.875rem; }
  .admin-table .table tbody tr:hover { background: #fafbff; }

  /* Pagination Global Fix */
  .pagination { margin: 0; gap: 4px; display: inline-flex; }
  .pagination svg, nav svg { width: 14px !important; height: 14px !important; max-width: 16px !important; max-height: 16px !important; }
  .page-link { border: 1px solid #e2e6ef; border-radius: 7px !important; color: #596579; min-width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px; font-size: .82rem; background: #fff; }
  .page-link:hover { color: #1a1a2e; background: #fff8e8; border-color: var(--admin-gold); }
  .page-item.active .page-link { background: var(--admin-gold); border-color: var(--admin-gold); color: #1a1a2e; font-weight: 700; }
  .page-item.disabled .page-link { color: #b7bdc8; background: #f8f9fc; }
  nav p.small { margin: 0; color: #7b8494; font-size: .8rem; }

  /* Page header */
  .page-header { background: #fff; border-radius: 16px; padding: 20px 24px;
    margin-bottom: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); display: flex;
    align-items: center; justify-content: space-between; }
  .page-header h4 { font-weight: 700; color: #1a1a2e; margin: 0; }

  /* Gold button */
  .btn-gold { background: var(--admin-gold); color: #1a1a2e; border: none; font-weight: 600; }
  .btn-gold:hover { background: #b8935a; color: #1a1a2e; }

  /* Form card */
  .form-card { background: #fff; border-radius: 16px; padding: 28px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
  .form-label { font-weight: 600; font-size: 0.85rem; color: #444; }
  .form-control:focus, .form-select:focus { border-color: var(--admin-gold); box-shadow: 0 0 0 3px rgba(201,169,110,0.15); }

  /* Badge */
  .badge-gold { background: var(--admin-gold); color: #1a1a2e; }

  /* Notifications */
  .toast-container { z-index: 9999; }

  /* Avatar */
  .user-avatar { width: 36px; height: 36px; border-radius: 50%; object-fit: cover; }

  /* Scrollbar */
  #sidebar::-webkit-scrollbar { width: 7px; }
  #sidebar::-webkit-scrollbar-track { background: transparent; }
  #sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.35); border-radius: 4px; }
  #sidebar:hover::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.55); }

  @media (max-width: 768px) {
    #sidebar { transform: translateX(-100%); width: 260px !important; }
    #sidebar.mobile-open { transform: translateX(0); }
    #topbar, .main-content { margin-left: 0 !important; }
  }

  /* Image preview */
  .img-preview { width: 100px; height: 100px; object-fit: cover; border-radius: 8px;
    border: 2px solid #eee; cursor: pointer; }
  .img-preview-large { max-width: 100%; max-height: 200px; object-fit: cover; border-radius: 8px; }
</style>
@stack('styles')
</head>
<body>

<!-- Sidebar -->
<nav id="sidebar">
  <div class="sidebar-header">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand-link">
      @if(file_exists(public_path('images/brownlogo.png')))
        <img src="{{ asset('images/brownlogo.png') }}" alt="{{ config('app.name', 'Durable Suitcase House') }}" class="sidebar-brand-img">
      @else
        <span class="text-white fw-bold">Durable Suitcase House</span>
      @endif
    </a>
  </div>

  <ul class="nav flex-column py-2">
    <!-- Main -->
    <li class="nav-item">
      <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
        <i class="bi bi-grid-1x2-fill"></i> <span class="sidebar-label">Dashboard</span>
      </a>
    </li>

    <!-- Catalog -->
    <li class="sidebar-category">Catalog</li>
    <li class="nav-item has-submenu {{ request()->routeIs('admin.products*', 'admin.categories*', 'admin.brands*', 'admin.colors*', 'admin.sizes*') ? 'open' : '' }}">
      <a href="#" class="nav-link" onclick="toggleSubmenu(this); return false;">
        <i class="bi bi-bag-heart"></i> <span class="sidebar-label">Products</span>
        <i class="bi bi-chevron-right arrow sidebar-label"></i>
      </a>
      <ul class="submenu {{ request()->routeIs('admin.products*', 'admin.categories*', 'admin.brands*', 'admin.colors*', 'admin.sizes*') ? 'show' : '' }}">
        <li><a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}"><span class="sidebar-label">All Products</span></a></li>
        <li><a href="{{ route('admin.products.create') }}" class="nav-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}"><span class="sidebar-label">Add Product</span></a></li>
        <li><a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}"><span class="sidebar-label">Categories</span></a></li>
        <li><a href="{{ route('admin.brands.index') }}" class="nav-link {{ request()->routeIs('admin.brands*') ? 'active' : '' }}"><span class="sidebar-label">Brands</span></a></li>
        <li><a href="{{ route('admin.colors.index') }}" class="nav-link {{ request()->routeIs('admin.colors*') ? 'active' : '' }}"><span class="sidebar-label">Colors</span></a></li>
        <li><a href="{{ route('admin.sizes.index') }}" class="nav-link {{ request()->routeIs('admin.sizes*') ? 'active' : '' }}"><span class="sidebar-label">Sizes Master</span></a></li>
      </ul>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.reviews.index') }}" class="nav-link {{ request()->routeIs('admin.reviews*') ? 'active' : '' }}">
        <i class="bi bi-star"></i> <span class="sidebar-label">Reviews</span>
        @php $pendingReviews = \App\Models\Review::where('status','pending')->count(); @endphp
        @if($pendingReviews > 0) <span class="badge bg-warning text-dark ms-auto badge sidebar-label">{{ $pendingReviews }}</span> @endif
      </a>
    </li>

    <!-- Sales -->
    <li class="sidebar-category">Sales</li>
    <li class="nav-item">
      <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
        <i class="bi bi-cart-check"></i> <span class="sidebar-label">Orders</span>
        @php $pendingOrders = \App\Models\Order::where('status','pending')->count(); @endphp
        @if($pendingOrders > 0) <span class="badge bg-danger ms-auto sidebar-label">{{ $pendingOrders }}</span> @endif
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.coupons.index') }}" class="nav-link {{ request()->routeIs('admin.coupons*') ? 'active' : '' }}">
        <i class="bi bi-ticket-perforated"></i> <span class="sidebar-label">Coupons</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.shipping.index') }}" class="nav-link {{ request()->routeIs('admin.shipping*') ? 'active' : '' }}">
        <i class="bi bi-truck"></i> <span class="sidebar-label">Shipping</span>
      </a>
    </li>

    <!-- Customers & Enquiries -->
    <li class="sidebar-category">Customers &amp; Marketing</li>
    <li class="nav-item">
      <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> <span class="sidebar-label">Users</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
        <i class="bi bi-chat-dots"></i> <span class="sidebar-label">Messages</span>
        @php $unread = \App\Models\Contact::where('is_read',false)->count(); @endphp
        @if($unread > 0) <span class="badge bg-primary ms-auto sidebar-label">{{ $unread }}</span> @endif
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.popups.index') }}" class="nav-link {{ request()->routeIs('admin.popups*') ? 'active' : '' }}">
        <i class="bi bi-window-stack"></i> <span class="sidebar-label">Popups &amp; Offers</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.newsletters.index') }}" class="nav-link {{ request()->routeIs('admin.newsletters*') ? 'active' : '' }}">
        <i class="bi bi-envelope-paper"></i> <span class="sidebar-label">Newsletter</span>
      </a>
    </li>

    <!-- System -->
    <li class="sidebar-category">System</li>
    <li class="nav-item">
      <a href="{{ route('admin.reports.sales') }}" class="nav-link {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
        <i class="bi bi-bar-chart-line"></i> <span class="sidebar-label">Reports</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
        <i class="bi bi-gear"></i> <span class="sidebar-label">Settings</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('home') }}" class="nav-link" target="_blank">
        <i class="bi bi-box-arrow-up-right"></i> <span class="sidebar-label">View Store</span>
      </a>
    </li>
  </ul>
</nav>

<!-- Topbar -->
<div id="topbar">
  <button class="btn btn-sm btn-light" id="sidebarToggle">
    <i class="bi bi-list fs-5"></i>
  </button>

  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="d-none d-md-block">
    <ol class="breadcrumb mb-0 small">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Admin</a></li>
      @yield('breadcrumb')
    </ol>
  </nav>

  <div class="ms-auto d-flex align-items-center gap-3">
    <!-- Search -->
    <div class="d-none d-lg-block">
      <div class="input-group input-group-sm">
        <input type="text" class="form-control" placeholder="Quick search..." style="width:200px; border-radius:8px 0 0 8px;">
        <button class="btn btn-outline-secondary" style="border-radius:0 8px 8px 0;"><i class="bi bi-search"></i></button>
      </div>
    </div>

    <!-- Notifications -->
    <div class="dropdown">
      <button class="btn btn-sm btn-light position-relative" data-bs-toggle="dropdown">
        <i class="bi bi-bell fs-5"></i>
        @if(isset($pendingOrders) && $pendingOrders > 0)
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.6rem;">{{ $pendingOrders }}</span>
        @endif
      </button>
      <div class="dropdown-menu dropdown-menu-end shadow-lg border-0" style="width:300px; border-radius:12px;">
        <div class="p-3 border-bottom"><h6 class="mb-0 fw-bold">Notifications</h6></div>
        <div class="p-3 text-center text-muted small">No new notifications</div>
      </div>
    </div>

    <!-- User -->
    <div class="dropdown">
      <button class="btn btn-sm btn-light d-flex align-items-center gap-2" data-bs-toggle="dropdown">
        <img src="{{ Auth::user()->avatar_url }}" alt="" class="user-avatar">
        <span class="d-none d-md-inline fw-600 small">{{ Auth::user()->name }}</span>
        <i class="bi bi-chevron-down small"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius:12px; min-width:180px;">
        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="bi bi-gear me-2"></i>Settings</a></li>
        <li><a class="dropdown-item" href="{{ route('home') }}" target="_blank"><i class="bi bi-eye me-2"></i>View Store</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
          <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="main-content" id="mainContent">
  <!-- Flash Messages -->
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown mb-4" role="alert">
      <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeInDown mb-4" role="alert">
      <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif
  @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeInDown mb-4" role="alert">
      <i class="bi bi-exclamation-circle me-2"></i>
      <strong>Please fix the following:</strong>
      <ul class="mb-0 mt-1">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const sidebar     = document.getElementById('sidebar');
  const topbar      = document.getElementById('topbar');
  const mainContent = document.getElementById('mainContent');

  document.getElementById('sidebarToggle').addEventListener('click', function() {
    sidebar.classList.toggle('collapsed');
    topbar.classList.toggle('expanded');
    mainContent.classList.toggle('expanded');
  });

  function toggleSubmenu(el) {
    const parent = el.closest('.has-submenu');
    const submenu = parent.querySelector('.submenu');
    parent.classList.toggle('open');
    submenu.classList.toggle('show');
  }

  // Open active submenus on load
  document.querySelectorAll('.has-submenu').forEach(item => {
    if (item.classList.contains('open')) {
      item.querySelector('.submenu').classList.add('show');
    }
  });

  // Auto-dismiss alerts
  setTimeout(() => {
    document.querySelectorAll('.alert').forEach(a => {
      const bsAlert = bootstrap.Alert.getOrCreateInstance(a);
      bsAlert.close();
    });
  }, 5000);

  // CSRF setup for AJAX
  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
</script>
@stack('scripts')
</body>
</html>

