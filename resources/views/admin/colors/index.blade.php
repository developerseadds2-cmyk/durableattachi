@extends('admin.layout.app')
@section('title', 'Colors Master')
@section('breadcrumb')
  <li class="breadcrumb-item active">Colors</li>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h4>Colors Master</h4>
    <p class="text-muted small mb-0">Manage product luggage and bag colors</p>
  </div>
  <a href="{{ route('admin.colors.create') }}" class="btn btn-gold"><i class="bi bi-plus-lg me-1"></i>Add Color</a>
</div>

<div class="admin-table">
  <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
    <span class="text-muted small">{{ $colors->total() }} colors found</span>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th>Color Preview</th>
          <th>Color Name</th>
          <th>Color Code (Hex)</th>
          <th>Products Count</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($colors as $color)
        <tr>
          <td>
            <div style="width:28px;height:28px;border-radius:50%;background:{{ $color->code ?: '#ccc' }};border:1px solid #ddd;box-shadow:0 2px 4px rgba(0,0,0,0.1);"></div>
          </td>
          <td class="fw-600">{{ $color->name }}</td>
          <td><code>{{ $color->code ?? '—' }}</code></td>
          <td><span class="badge bg-secondary">{{ $color->products_count }} products</span></td>
          <td>
            <span class="badge {{ $color->status ? 'bg-success' : 'bg-secondary' }}">
              {{ $color->status ? 'Active' : 'Inactive' }}
            </span>
          </td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('admin.colors.edit', $color) }}" class="btn btn-sm btn-light" title="Edit"><i class="bi bi-pencil"></i></a>
              <form method="POST" action="{{ route('admin.colors.destroy', $color) }}" class="d-inline" onsubmit="return confirm('Delete this color?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" title="Delete"><i class="bi bi-trash"></i></button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-4 text-muted">No colors found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="p-3">{{ $colors->links() }}</div>
</div>
@endsection
