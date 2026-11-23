@extends('admin.layout.app')
@section('title','Users')
@section('breadcrumb')
  <li class="breadcrumb-item active">Users</li>
@endsection

@section('content')
<div class="page-header">
  <div><h4>Users</h4><p class="text-muted small mb-0">Manage admins and customers</p></div>
  <a href="{{ route('admin.users.create') }}" class="btn btn-gold"><i class="bi bi-plus-lg me-1"></i>Add User</a>
</div>

<!-- Filters -->
<div class="form-card mb-4">
  <form method="GET" class="row g-2 align-items-end">
    <div class="col-md-4"><input type="text" name="search" class="form-control form-control-sm" placeholder="Name or email..." value="{{ request('search') }}"></div>
    <div class="col-md-2">
      <select name="role" class="form-select form-select-sm">
        <option value="">All Roles</option>
        <option value="admin" {{ request('role')=='admin'?'selected':'' }}>Admin</option>
        <option value="customer" {{ request('role')=='customer'?'selected':'' }}>Customer</option>
      </select>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-sm btn-gold">Filter</button>
      <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary ms-1">Reset</a>
    </div>
  </form>
</div>

<div class="admin-table">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr><th>User</th><th>Role</th><th>Phone</th><th>Status</th><th>Joined</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @forelse($users as $user)
        <tr>
          <td>
            <div class="d-flex align-items-center gap-2">
              <img src="{{ $user->avatar_url }}" class="user-avatar" alt="">
              <div>
                <div class="fw-600 small">{{ $user->name }}</div>
                <div class="text-muted" style="font-size:0.72rem;">{{ $user->email }}</div>
              </div>
            </div>
          </td>
          <td><span class="badge {{ $user->role==='admin'?'bg-primary':'bg-secondary' }}">{{ ucfirst($user->role) }}</span></td>
          <td class="small text-muted">{{ $user->phone ?? '—' }}</td>
          <td>
            <div class="form-check form-switch mb-0">
              <input class="form-check-input" type="checkbox" {{ $user->status ? 'checked':'' }} onchange="toggleUser({{ $user->id }}, this)">
            </div>
          </td>
          <td class="small text-muted">{{ $user->created_at->format('d M Y') }}</td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-light"><i class="bi bi-eye"></i></a>
              <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a>
              @if($user->id !== auth()->id())
              <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('admin.users.destroy', $user) }}')"><i class="bi bi-trash"></i></button>
              @endif
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-4 text-muted">No users found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="p-3">{{ $users->links() }}</div>
</div>
<form id="deleteForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>
@endsection

@push('scripts')
<script>
function confirmDelete(url){if(confirm('Delete this user?')){document.getElementById('deleteForm').action=url;document.getElementById('deleteForm').submit();}}
function toggleUser(id, el){
  fetch(`/admin/users/${id}/toggle-status`,{method:'POST',headers:{'X-CSRF-TOKEN':csrfToken}})
    .then(r=>r.json()).then(d=>{if(!d.success)el.checked=!el.checked;});
}
</script>
@endpush
