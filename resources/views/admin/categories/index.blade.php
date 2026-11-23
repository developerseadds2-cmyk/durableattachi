@extends('admin.layout.app')
@section('title','Categories')
@section('breadcrumb')
  <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
<div class="page-header">
  <div><h4>Categories</h4><p class="text-muted small mb-0">Manage product categories</p></div>
  <a href="{{ route('admin.categories.create') }}" class="btn btn-gold"><i class="bi bi-plus-lg me-1"></i>Add Category</a>
</div>

<form method="GET" class="form-card mb-4">
  <div class="row g-2 align-items-end">
    <div class="col-md-5"><label class="form-label">Search</label><input name="search" class="form-control" value="{{ request('search') }}" placeholder="Category name"></div>
    <div class="col-md-3"><label class="form-label">Parent</label><select name="parent_id" class="form-select"><option value="">All parents</option>@foreach($parents as $parent)<option value="{{ $parent->id }}" @selected(request('parent_id') == $parent->id)>{{ $parent->name }}</option>@endforeach</select></div>
    <div class="col-md-2"><label class="form-label">Status</label><select name="status" class="form-select"><option value="">All</option><option value="active" @selected(request('status')==='active')>Active</option><option value="inactive" @selected(request('status')==='inactive')>Inactive</option></select></div>
    <div class="col-md-2 d-flex gap-2"><button class="btn btn-gold">Filter</button><a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Reset</a></div>
  </div>
</form>

<div class="admin-table">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr><th>Category</th><th>Parent</th><th>Products</th><th>Sort</th><th>Status</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @forelse($categories as $cat)
        <tr>
          <td>
            <div class="d-flex align-items-center gap-2">
              @if($cat->image)<img src="{{ $cat->image_url }}" style="width:36px;height:36px;object-fit:cover;border-radius:6px;" alt="">@endif
              <span class="fw-600">{{ $cat->name }}</span>
            </div>
          </td>
          <td class="text-muted small">{{ $cat->parent?->name ?? '—' }}</td>
          <td><span class="badge bg-light text-dark">{{ $cat->products_count }}</span></td>
          <td class="small">{{ $cat->sort_order }}</td>
          <td>
            @if($cat->status)<span class="badge bg-success">Active</span>
            @else<span class="badge bg-secondary">Inactive</span>@endif
          </td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a>
              <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('admin.categories.destroy', $cat) }}')"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-4 text-muted">No categories found. <a href="{{ route('admin.categories.create') }}">Add one</a></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="category-pagination">
    <div class="small text-muted">Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} categories</div>
    <div>{{ $categories->links('pagination::bootstrap-5') }}</div>
  </div>
</div>
<form id="deleteForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>
@endsection
@push('scripts')
<style>
  .category-pagination { display:flex; align-items:center; justify-content:space-between; gap:16px; padding:16px; border-top:1px solid #eef0f5; }
  .category-pagination .pagination { margin:0; justify-content:flex-end; gap:4px; }
  .category-pagination .page-link { min-width:36px; padding:7px 11px; border-radius:7px !important; border-color:#e2e6ef; color:#596579; text-align:center; font-size:.8rem; }
  .category-pagination .page-item.active .page-link { background:#c9a96e; border-color:#c9a96e; color:#1a1a2e; font-weight:700; }
  .category-pagination .page-link:hover { background:#fff8e8; border-color:#c9a96e; color:#1a1a2e; }
  .category-pagination .page-item.disabled .page-link { color:#b7bdc8; background:#f8f9fc; }
  @media (max-width:576px) { .category-pagination { align-items:flex-start; flex-direction:column; } }
</style>
<script>function confirmDelete(url){if(confirm('Delete this category?')){document.getElementById('deleteForm').action=url;document.getElementById('deleteForm').submit();}}</script>
@endpush
