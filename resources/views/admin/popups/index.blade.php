@extends('admin.layout.app')

@section('title', 'Popups & Promotional Offers - Admin')

@section('content')
<div class="page-header">
  <div>
    <h4><i class="bi bi-window-stack text-warning me-2"></i> Promotional Popups</h4>
    <p class="text-muted small mb-0">Create promotional discount popups (e.g. 15% off specific categories) or simple store announcement popups.</p>
  </div>
  <a href="{{ route('admin.popups.create') }}" class="btn btn-gold">
    <i class="bi bi-plus-lg me-1"></i> Add New Popup
  </a>
</div>

<div class="admin-table">
  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr>
          <th>Popup</th>
          <th>Type</th>
          <th>Targeting</th>
          <th>Offer / Coupon</th>
          <th>Delay</th>
          <th>Status</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($popups as $popup)
        <tr>
          <td>
            <div class="d-flex align-items-center gap-3">
              @if($popup->image)
                <img src="{{ $popup->image_url }}" alt="" style="width:48px; height:48px; object-fit:cover; border-radius:8px; border:1px solid #eee;">
              @else
                <div style="width:48px; height:48px; border-radius:8px; background:#f1f5f9; display:flex; align-items:center; justify-content:center; color:#94a3b8; font-size:1.2rem;">
                  <i class="bi bi-window"></i>
                </div>
              @endif
              <div>
                <strong class="text-dark d-block">{{ $popup->title }}</strong>
                <span class="text-muted small">{{ Str::limit($popup->headline, 40) }}</span>
              </div>
            </div>
          </td>
          <td>
            @if($popup->type === 'offer')
              <span class="badge bg-success-subtle text-success border border-success-subtle">
                <i class="bi bi-tag-fill me-1"></i> Offer ({{ $popup->discount_percentage ? $popup->discount_percentage . '% OFF' : 'Discount' }})
              </span>
            @else
              <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">
                <i class="bi bi-megaphone-fill me-1"></i> Simple Popup
              </span>
            @endif
          </td>
          <td>
            @if($popup->target_type === 'all')
              <span class="badge bg-primary-subtle text-primary">All Pages</span>
            @elseif($popup->target_type === 'home_only')
              <span class="badge bg-info-subtle text-info">Homepage Only</span>
            @elseif($popup->target_type === 'category' && $popup->category)
              <span class="badge bg-warning-subtle text-warning">Category: {{ $popup->category->name }}</span>
            @elseif($popup->target_type === 'product' && $popup->product)
              <span class="badge bg-purple-subtle text-purple">Product: {{ Str::limit($popup->product->name, 25) }}</span>
            @else
              <span class="text-muted small">Global</span>
            @endif
          </td>
          <td>
            @if($popup->coupon_code)
              <code class="fw-bold px-2 py-1 bg-light border rounded text-danger">{{ $popup->coupon_code }}</code>
            @else
              <span class="text-muted small">—</span>
            @endif
          </td>
          <td>
            <span class="small text-muted">{{ $popup->delay_seconds }}s</span>
            @if($popup->show_once_per_session)
              <span class="d-block text-xs text-muted">1x / session</span>
            @endif
          </td>
          <td>
            <form action="{{ route('admin.popups.toggle-status', $popup) }}" method="POST">
              @csrf
              <button type="submit" class="badge border-0 {{ $popup->is_active ? 'bg-success text-white' : 'bg-secondary text-white' }}" style="cursor:pointer;">
                {{ $popup->is_active ? 'Active' : 'Inactive' }}
              </button>
            </form>
          </td>
          <td class="text-end">
            <div class="d-inline-flex gap-2">
              <a href="{{ route('admin.popups.edit', $popup) }}" class="btn btn-sm btn-outline-secondary" title="Edit">
                <i class="bi bi-pencil"></i>
              </a>
              <form action="{{ route('admin.popups.destroy', $popup) }}" method="POST" onsubmit="return confirm('Delete this popup?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center py-5 text-muted">
            <i class="bi bi-window fs-1 d-block mb-2 text-secondary"></i>
            No promotional popups found. Click <strong>Add New Popup</strong> to create one!
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  @if($popups->hasPages())
    <div class="p-3 border-top d-flex justify-content-end">
      {{ $popups->links() }}
    </div>
  @endif
</div>
@endsection
