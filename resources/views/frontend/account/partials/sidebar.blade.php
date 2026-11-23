{{-- Desktop Vertical Sidebar --}}
<div class="account-sidebar-box d-none d-lg-block">
  <ul class="list-unstyled mb-0 account-nav-list">
    @foreach([
      [route('account.dashboard'), 'bi-grid', 'Dashboard', request()->routeIs('account.dashboard')],
      [route('account.profile'), 'bi-person', 'My Profile', request()->routeIs('account.profile')],
      [route('account.orders'), 'bi-bag', 'My Orders', request()->routeIs('account.orders*')],
      [route('account.addresses'), 'bi-geo-alt', 'Addresses', request()->routeIs('account.addresses')],
      [route('wishlist.index'), 'bi-heart', 'Wishlist', request()->routeIs('wishlist*')],
    ] as [$url, $icon, $label, $active])
    <li class="account-nav-item mb-1">
      <a href="{{ $url }}" class="account-nav-link {{ $active ? 'active' : '' }}">
        <i class="bi {{ $icon }}"></i> <span>{{ $label }}</span>
      </a>
    </li>
    @endforeach
    <li class="account-nav-item mt-3 pt-3" style="border-top:1px solid var(--border);">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="account-nav-link text-danger border-0 w-100 bg-transparent text-start">
          <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
        </button>
      </form>
    </li>
  </ul>
</div>

{{-- Mobile Dropdown Selector & Navigation --}}
<div class="account-mobile-nav d-lg-none mb-4">
  @php
    $navOptions = [
      [route('account.dashboard'), 'bi-grid', 'Dashboard', request()->routeIs('account.dashboard')],
      [route('account.profile'), 'bi-person', 'My Profile', request()->routeIs('account.profile')],
      [route('account.orders'), 'bi-bag', 'My Orders', request()->routeIs('account.orders*')],
      [route('account.addresses'), 'bi-geo-alt', 'Addresses', request()->routeIs('account.addresses')],
      [route('wishlist.index'), 'bi-heart', 'Wishlist', request()->routeIs('wishlist*')],
    ];
    $currentOption = collect($navOptions)->firstWhere(3, true) ?? $navOptions[0];
  @endphp

  <div class="account-mobile-select-wrap">
    <div class="account-mobile-current" onclick="document.getElementById('accountMobileDropdown').classList.toggle('show')">
      <div class="d-flex align-items-center gap-2">
        <i class="bi {{ $currentOption[1] }} text-success"></i>
        <span class="fw-bold">{{ $currentOption[2] }}</span>
      </div>
      <div class="d-flex align-items-center gap-1 text-muted small">
        <span>Menu</span>
        <i class="bi bi-chevron-expand"></i>
      </div>
    </div>

    <div class="account-mobile-dropdown-menu" id="accountMobileDropdown">
      @foreach($navOptions as [$url, $icon, $label, $active])
      <a href="{{ $url }}" class="account-mobile-dropdown-item {{ $active ? 'active' : '' }}">
        <div class="d-flex align-items-center gap-2">
          <i class="bi {{ $icon }}"></i>
          <span>{{ $label }}</span>
        </div>
        @if($active) <i class="bi bi-check2 text-success"></i> @endif
      </a>
      @endforeach
      <div class="border-top my-1"></div>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="account-mobile-dropdown-item text-danger border-0 w-100 bg-transparent text-start">
          <i class="bi bi-box-arrow-right"></i> Logout
        </button>
      </form>
    </div>
  </div>
</div>
