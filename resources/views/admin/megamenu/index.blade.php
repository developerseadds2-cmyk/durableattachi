@extends('admin.layout.app')
@section('title', 'Mega Menu Manager')
@section('breadcrumb')
  <li class="breadcrumb-item active">Mega Menu</li>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h4>Mega Menu Manager</h4>
    <p class="text-muted small mb-0">Manage navigation items, dropdowns and mega-menus</p>
  </div>
  <a href="{{ route('admin.megamenu.create') }}" class="btn btn-gold"><i class="bi bi-plus-lg me-1"></i>Add Menu Item</a>
</div>

<!-- Preview -->
<div class="form-card mb-4 p-3">
  <div class="d-flex align-items-center gap-2 mb-3">
    <h6 class="fw-bold mb-0">Live Preview</h6>
    <span class="badge bg-info">Frontend Navigation</span>
  </div>
  <div class="d-flex align-items-center gap-4 bg-dark rounded-3 px-4 py-3" style="overflow-x:auto;">
    @foreach($menus->where('status', true) as $menu)
      <div class="text-white small fw-600 d-flex align-items-center gap-1">
        {{ $menu->title }}
        @if($menu->badge_text) <span class="badge ms-1" style="background:{{ $menu->badge_color ?? '#c9a96e' }};font-size:0.6rem;">{{ $menu->badge_text }}</span> @endif
        @if($menu->type !== 'link') <i class="bi bi-chevron-down" style="font-size:0.7rem;"></i> @endif
      </div>
    @endforeach
  </div>
</div>

<div class="admin-table">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr><th>#</th><th>Title</th><th>Type</th><th>URL</th><th>Columns</th><th>Badge</th><th>Status</th><th>Actions</th></tr>
      </thead>
      <tbody id="sortableMenu">
        @forelse($menus->whereNull('parent_id') as $menu)
          @include('admin.megamenu._row', ['menu' => $menu, 'level' => 0])
        @empty
        <tr><td colspan="8" class="text-center py-4 text-muted">No menu items yet. <a href="{{ route('admin.megamenu.create') }}">Add first item</a></td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<form id="deleteForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>
@endsection

@push('scripts')
<style>
  .menu-row { transition: background .15s, opacity .15s; }
  .menu-row.dragging { opacity: .45; background: #fff8e8; }
  .menu-row.drag-over { border-top: 3px solid var(--admin-gold); }
  .level-badge { font-size: .65rem; color: #8a6a24; background: #fff4d8; border-radius: 4px; padding: 2px 5px; margin-right: 6px; }
  .drag-handle { cursor: grab; font-size: 1.1rem; }
  .drag-handle:active { cursor: grabbing; }
</style>
<script>
const menuTable = document.getElementById('sortableMenu');
let draggedRow = null;
let dropTarget = null;

menuTable?.querySelectorAll('.menu-row').forEach(row => {
  row.addEventListener('dragstart', event => {
    draggedRow = row;
    row.classList.add('dragging');
    event.dataTransfer.effectAllowed = 'move';
  });
  row.addEventListener('dragend', () => {
    row.classList.remove('dragging');
    menuTable.querySelectorAll('.drag-over').forEach(item => item.classList.remove('drag-over'));
    draggedRow = null;
    dropTarget = null;
    saveMenuOrder();
  });
  row.addEventListener('dragover', event => {
    event.preventDefault();
    if (!draggedRow || draggedRow === row) return;
    dropTarget = row;
    row.classList.add('drag-over');
    const rect = row.getBoundingClientRect();
    if (event.clientY < rect.top + rect.height / 2) row.before(draggedRow);
    else row.after(draggedRow);
  });
  row.addEventListener('drop', event => {
    event.preventDefault();
    if (!draggedRow || draggedRow === row) return;

    const parentId = row.dataset.id;
    let ancestor = row;
    while (ancestor) {
      if (ancestor === draggedRow) {
        dropTarget = null;
        return;
      }
      ancestor = [...menuTable.querySelectorAll('.menu-row')].find(item => item.dataset.id === ancestor.dataset.parentId);
    }

    draggedRow.dataset.parentId = parentId;
    row.after(draggedRow);
    dropTarget = row;
  });
  row.addEventListener('dragleave', () => row.classList.remove('drag-over'));
});

function saveMenuOrder() {
  const items = [...menuTable.querySelectorAll('.menu-row')].map((row, order) => {
    row.querySelector('.sort-number').textContent = order + 1;
    return { id: row.dataset.id, order: order + 1, parent_id: row.dataset.parentId || null };
  });

  fetch('{{ route('admin.megamenu.sort') }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'Accept': 'application/json'
    },
    body: JSON.stringify({ items })
  }).then(response => {
    if (!response.ok) throw new Error('Unable to save menu order');
  }).catch(() => alert('Menu order could not be saved. Please try again.'));
}

function toggleStatus(id, checkbox) {
  checkbox.disabled = true;
  fetch('{{ url('admin/megamenu') }}/' + id + '/toggle-status', {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'Accept': 'application/json'
    }
  }).then(response => {
    if (!response.ok) throw new Error('Unable to update status');
  }).catch(() => {
    checkbox.checked = !checkbox.checked;
    alert('Menu status could not be updated. Please try again.');
  }).finally(() => { checkbox.disabled = false; });
}

function confirmDelete(url) {
  if(confirm('Delete this menu item?')) {
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteForm').submit();
  }
}
</script>
@endpush
