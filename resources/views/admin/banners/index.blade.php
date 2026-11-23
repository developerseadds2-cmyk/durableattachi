@extends('admin.layout.app')
@section('title', 'Banners')
@section('breadcrumb')
  <li class="breadcrumb-item active">Banners</li>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h4>Banners</h4>
    <p class="text-muted small mb-0">Manage promotional banners for your store</p>
  </div>
  <a href="{{ route('admin.banners.create') }}" class="btn btn-gold"><i class="bi bi-plus-lg me-1"></i>Add Banner</a>
</div>

<div class="admin-table">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Image</th><th>Title</th><th>Type</th><th>Link</th><th>Sort</th><th>Status</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($banners as $banner)
        <tr>
          <td>
            <img src="{{ $banner->image_url ?? asset('uploads/banners/'.$banner->image) }}"
                 alt="{{ $banner->title }}" style="width:100px;height:60px;object-fit:cover;border-radius:8px;">
          </td>
          <td>
            <div class="fw-600 small">{{ $banner->title ?? '—' }}</div>
            @if($banner->subtitle)<div class="text-muted small">{{ Str::limit($banner->subtitle,40) }}</div>@endif
          </td>
          <td><span class="badge bg-secondary">{{ ucfirst($banner->type ?? 'promo') }}</span></td>
          <td>
            @if($banner->link)
              <a href="{{ $banner->link }}" target="_blank" class="small text-primary">{{ Str::limit($banner->link,30) }}</a>
            @else
              <span class="text-muted small">—</span>
            @endif
          </td>
          <td class="small text-muted">{{ $banner->sort_order ?? 0 }}</td>
          <td>
            @if($banner->status)
              <span class="badge bg-success">Active</span>
            @else
              <span class="badge bg-secondary">Inactive</span>
            @endif
          </td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-light" title="Edit"><i class="bi bi-pencil"></i></a>
              <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('admin.banners.destroy', $banner) }}')" title="Delete"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center py-5 text-muted">
          <i class="bi bi-card-image fs-1 d-block mb-2"></i>No banners found.
          <a href="{{ route('admin.banners.create') }}" class="btn btn-gold btn-sm mt-2">Add First Banner</a>
        </td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<form id="deleteForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>
@endsection
@push('scripts')
<script>
function confirmDelete(url) {
  if (confirm('Delete this banner?')) {
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteForm').submit();
  }
}
</script>
@endpush
