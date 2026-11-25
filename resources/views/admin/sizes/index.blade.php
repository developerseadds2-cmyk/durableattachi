@extends('admin.layout.app')
@section('title', 'Size Master')
@section('breadcrumb')
  <li class="breadcrumb-item active">Sizes</li>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h4>Size Master</h4>
    <p class="text-muted small mb-0">Manage luggage, suitcase, and bag sizes</p>
  </div>
  <a href="{{ route('admin.sizes.create') }}" class="btn btn-gold"><i class="bi bi-plus-lg me-1"></i>Add Size</a>
</div>

<div class="admin-table">
  <div class="d-flex justify-content-between align-items-center p-3 border-bottom flex-wrap gap-2">
    <div class="d-flex align-items-center gap-3">
      <span class="text-muted small">{{ $sizes->total() }} sizes found</span>
      <span id="selectedCount" class="badge bg-secondary d-none">0 selected</span>
    </div>
    <div class="d-flex gap-2">
      <button type="button" id="bulkDeleteBtn" class="btn btn-sm btn-danger d-none" onclick="submitBulkDelete()">
        <i class="bi bi-trash me-1"></i>Delete Selected (<span id="deleteCount">0</span>)
      </button>
    </div>
  </div>
  <div class="table-responsive">
    <form id="bulkDeleteForm" method="POST" action="{{ route('admin.sizes.bulk-delete') }}" style="display:none;">
      @csrf
      <div id="bulkDeleteInputs"></div>
    </form>
    <table class="table">
      <thead>
        <tr>
          <th width="40"><input type="checkbox" class="form-check-input" id="checkAll"></th>
          <th>Size Name</th>
          <th>Size Code / Tag</th>
          <th>Products Count</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($sizes as $size)
        <tr>
          <td><input type="checkbox" class="form-check-input row-check" value="{{ $size->id }}"></td>
          <td class="fw-600">{{ $size->name }}</td>
          <td><code>{{ $size->code ?? '—' }}</code></td>
          <td><span class="badge bg-secondary">{{ $size->products_count }} products</span></td>
          <td>
            <span class="badge {{ $size->status ? 'bg-success' : 'bg-secondary' }}">
              {{ $size->status ? 'Active' : 'Inactive' }}
            </span>
          </td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('admin.sizes.edit', $size) }}" class="btn btn-sm btn-light" title="Edit"><i class="bi bi-pencil"></i></a>
              <form method="POST" action="{{ route('admin.sizes.destroy', $size) }}" class="d-inline" onsubmit="return confirm('Delete this size?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" title="Delete"><i class="bi bi-trash"></i></button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-4 text-muted">No sizes found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="p-3">{{ $sizes->links() }}</div>
</div>
@endsection

@push('scripts')
<script>
const checkAll = document.getElementById('checkAll');
const rowChecks = document.querySelectorAll('.row-check');
const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
const selectedCount = document.getElementById('selectedCount');
const deleteCount = document.getElementById('deleteCount');

function updateBulkState() {
  const checked = document.querySelectorAll('.row-check:checked');
  const count = checked.length;
  if (count > 0) {
    bulkDeleteBtn.classList.remove('d-none');
    selectedCount.classList.remove('d-none');
    selectedCount.textContent = count + ' selected';
    deleteCount.textContent = count;
  } else {
    bulkDeleteBtn.classList.add('d-none');
    selectedCount.classList.add('d-none');
  }
  if (checkAll) {
    checkAll.checked = (count === rowChecks.length && rowChecks.length > 0);
  }
}

if (checkAll) {
  checkAll.addEventListener('change', function() {
    rowChecks.forEach(c => c.checked = this.checked);
    updateBulkState();
  });
}

rowChecks.forEach(c => {
  c.addEventListener('change', updateBulkState);
});

function submitBulkDelete() {
  const checked = document.querySelectorAll('.row-check:checked');
  if (checked.length === 0) {
    alert('Please select at least one size to delete.');
    return;
  }
  if (confirm('Are you sure you want to delete ' + checked.length + ' selected size(s)?')) {
    const container = document.getElementById('bulkDeleteInputs');
    container.innerHTML = '';
    checked.forEach(c => {
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'ids[]';
      input.value = c.value;
      container.appendChild(input);
    });
    document.getElementById('bulkDeleteForm').submit();
  }
}
</script>
@endpush
