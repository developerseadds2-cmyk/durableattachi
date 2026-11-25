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
  <div class="d-flex justify-content-between align-items-center p-3 border-bottom flex-wrap gap-2">
    <div class="d-flex align-items-center gap-3">
      <span class="text-muted small">{{ $colors->total() }} colors found</span>
      <span id="selectedCount" class="badge bg-secondary d-none">0 selected</span>
    </div>
    <div class="d-flex gap-2">
      <button type="button" id="bulkDeleteBtn" class="btn btn-sm btn-danger d-none" onclick="submitBulkDelete()">
        <i class="bi bi-trash me-1"></i>Delete Selected (<span id="deleteCount">0</span>)
      </button>
    </div>
  </div>
  <div class="table-responsive">
    <form id="bulkDeleteForm" method="POST" action="{{ route('admin.colors.bulk-delete') }}" style="display:none;">
      @csrf
      <div id="bulkDeleteInputs"></div>
    </form>
    <table class="table">
      <thead>
        <tr>
          <th width="40"><input type="checkbox" class="form-check-input" id="checkAll"></th>
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
          <td><input type="checkbox" class="form-check-input row-check" value="{{ $color->id }}"></td>
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
        <tr><td colspan="7" class="text-center py-4 text-muted">No colors found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="p-3">{{ $colors->links() }}</div>
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
    alert('Please select at least one color to delete.');
    return;
  }
  if (confirm('Are you sure you want to delete ' + checked.length + ' selected color(s)?')) {
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
