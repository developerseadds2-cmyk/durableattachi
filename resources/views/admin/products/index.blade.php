@extends('admin.layout.app')
@section('title', 'Products')
@section('breadcrumb')
  <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h4>Products</h4>
    <p class="text-muted small mb-0">Manage your jewelry catalog</p>
  </div>
  <a href="{{ route('admin.products.create') }}" class="btn btn-gold"><i class="bi bi-plus-lg me-1"></i>Add Product</a>
</div>

<!-- Filters -->
<div class="form-card mb-4">
  <form method="GET" class="row g-2 align-items-end">
    <div class="col-md-4 col-lg-3">
      <input type="text" name="search" class="form-control form-control-sm" placeholder="Search name, SKU..." value="{{ request('search') }}">
    </div>
    <div class="col-md-3 col-lg-2">
      <select name="category_id" class="form-select form-select-sm">
        <option value="">All Categories</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @foreach($cat->children as $child)
            <option value="{{ $child->id }}" {{ request('category_id') == $child->id ? 'selected' : '' }}>&nbsp;&nbsp;{{ $child->name }}</option>
          @endforeach
        @endforeach
      </select>
    </div>
    <div class="col-md-2">
      <select name="status" class="form-select form-select-sm">
        <option value="">All Status</option>
        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
      </select>
    </div>
    <div class="col-md-2">
      <select name="stock" class="form-select form-select-sm">
        <option value="">All Stock</option>
        <option value="low" {{ request('stock') == 'low' ? 'selected' : '' }}>Low Stock</option>
        <option value="out" {{ request('stock') == 'out' ? 'selected' : '' }}>Out of Stock</option>
      </select>
    </div>
    <div class="col-md-2 col-lg-1">
      <select name="per_page" class="form-select form-select-sm" onchange="this.form.submit()">
        <option value="20" {{ request('per_page') == '20' ? 'selected' : '' }}>20 / page</option>
        <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50 / page</option>
        <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100 / page</option>
        <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>List All</option>
      </select>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-sm btn-gold">Filter</button>
      <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary ms-1">Reset</a>
    </div>
  </form>
</div>

<div class="admin-table">
  <div class="d-flex justify-content-between align-items-center p-3 border-bottom flex-wrap gap-2">
    <div class="d-flex align-items-center gap-3">
      <span class="text-muted small">{{ $products->total() }} products found</span>
      <span id="selectedCount" class="badge bg-secondary d-none">0 selected</span>
    </div>
    <div class="d-flex gap-2">
      <a href="{{ route('admin.products.index', array_merge(request()->query(), ['per_page' => 'all'])) }}" class="btn btn-sm {{ request('per_page') == 'all' ? 'btn-gold' : 'btn-outline-dark' }}">
        <i class="bi bi-list-ul me-1"></i>List All Products
      </a>
      <button type="button" id="bulkDeleteBtn" class="btn btn-sm btn-danger d-none" onclick="submitBulkDelete()">
        <i class="bi bi-trash me-1"></i>Delete Selected (<span id="deleteCount">0</span>)
      </button>
      <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-download me-1"></i>Export</button>
    </div>
  </div>
  <div class="table-responsive">
    <form id="bulkDeleteForm" method="POST" action="{{ route('admin.products.bulk-delete') }}" style="display:none;">
      @csrf
      <div id="bulkDeleteInputs"></div>
    </form>
    <table class="table">
      <thead>
        <tr>
          <th><input type="checkbox" class="form-check-input" id="checkAll"></th>
          <th>Product</th><th>SKU</th><th>Category</th>
          <th>Price</th><th>Stock</th><th>Status</th><th>Featured</th><th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $product)
        <tr>
          <td><input type="checkbox" class="form-check-input row-check" value="{{ $product->id }}"></td>
          <td>
            <div class="d-flex align-items-center gap-3">
              <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" class="img-preview" style="width:48px;height:48px;border-radius:8px;">
              <div>
                <div class="fw-600 small">{{ Str::limit($product->name, 40) }}</div>
                @if($product->is_new_arrival)<span class="badge bg-info" style="font-size:0.6rem;">NEW</span>@endif
                @if($product->is_best_seller)<span class="badge bg-warning text-dark" style="font-size:0.6rem;">BEST</span>@endif
              </div>
            </div>
          </td>
          <td class="text-muted small">{{ $product->sku ?? '—' }}</td>
          <td class="small">{{ $product->category->name ?? '—' }}</td>
          <td>
            <div class="fw-600">₨{{ number_format($product->price, 2) }}</div>
            @if($product->sale_price)
              <div class="text-success small">₨{{ number_format($product->sale_price, 2) }}</div>
            @endif
          </td>
          <td>
            @if($product->stock_quantity == 0)
              <span class="badge bg-danger">Out</span>
            @elseif($product->isLowStock())
              <span class="badge bg-warning text-dark">{{ $product->stock_quantity }} Low</span>
            @else
              <span class="text-success fw-600 small">{{ $product->stock_quantity }}</span>
            @endif
          </td>
          <td>
            @if($product->status === 'active') <span class="badge bg-success">Active</span>
            @elseif($product->status === 'inactive') <span class="badge bg-secondary">Inactive</span>
            @else <span class="badge bg-warning text-dark">Draft</span> @endif
          </td>
          <td>
            @if($product->is_featured)
              <i class="bi bi-star-fill text-warning"></i>
            @else
              <i class="bi bi-star text-muted"></i>
            @endif
          </td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-light" title="Edit"><i class="bi bi-pencil"></i></a>
              <form method="POST" action="{{ route('admin.products.duplicate', $product) }}" class="d-inline" onsubmit="return confirm('Duplicate this product?')">
                @csrf
                <button type="submit" class="btn btn-sm btn-light" title="Duplicate"><i class="bi bi-copy"></i></button>
              </form>
              <a href="{{ route('product.show', $product->slug) }}" class="btn btn-sm btn-light" target="_blank" title="View"><i class="bi bi-eye"></i></a>
              <button class="btn btn-sm btn-danger" title="Delete" onclick="confirmDelete('{{ route('admin.products.destroy', $product) }}')"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="9" class="text-center py-5 text-muted">
          <i class="bi bi-bag-x fs-1 d-block mb-2"></i>No products found.
          <a href="{{ route('admin.products.create') }}" class="btn btn-gold btn-sm mt-2">Add First Product</a>
        </td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="p-3">{{ $products->links() }}</div>
</div>

<!-- Delete Modal -->
<form id="deleteForm" method="POST" style="display:none;">
  @csrf @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
function confirmDelete(url) {
  if (confirm('Are you sure you want to delete this product?')) {
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteForm').submit();
  }
}

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
    alert('Please select at least one product to delete.');
    return;
  }
  if (confirm('Are you sure you want to delete ' + checked.length + ' selected product(s)? This action cannot be undone.')) {
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
