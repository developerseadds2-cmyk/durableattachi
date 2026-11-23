@extends('admin.layout.app')
@section('title','Coupons')
@section('breadcrumb')
  <li class="breadcrumb-item active">Coupons</li>
@endsection

@section('content')
<div class="page-header">
  <div><h4>Coupons</h4><p class="text-muted small mb-0">Manage discount coupons</p></div>
  <a href="{{ route('admin.coupons.create') }}" class="btn btn-gold"><i class="bi bi-plus-lg me-1"></i>Add Coupon</a>
</div>

<div class="admin-table">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr><th>Code</th><th>Type</th><th>Value</th><th>Min Order</th><th>Usage</th><th>Expiry</th><th>Status</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @forelse($coupons as $coupon)
        <tr>
          <td><code class="fw-bold fs-6">{{ $coupon->code }}</code></td>
          <td><span class="badge {{ $coupon->type==='percentage'?'bg-info':'bg-warning text-dark' }}">{{ ucfirst($coupon->type) }}</span></td>
          <td class="fw-600">{{ $coupon->type==='percentage' ? $coupon->value.'%' : '₨'.number_format($coupon->value,2) }}</td>
          <td class="small">₨{{ number_format($coupon->min_order_amount,2) }}</td>
          <td class="small">{{ $coupon->used_count }} / {{ $coupon->usage_limit ?? '∞' }}</td>
          <td class="small text-muted">{{ $coupon->end_date ? $coupon->end_date->format('d M Y') : 'No expiry' }}</td>
          <td>@if($coupon->status)<span class="badge bg-success">Active</span>@else<span class="badge bg-secondary">Inactive</span>@endif</td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a>
              <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('admin.coupons.destroy', $coupon) }}')"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center py-4 text-muted">No coupons yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="p-3">{{ $coupons->links() }}</div>
</div>
<form id="deleteForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>
@endsection
@push('scripts')
<script>function confirmDelete(url){if(confirm('Delete this coupon?')){document.getElementById('deleteForm').action=url;document.getElementById('deleteForm').submit();}}</script>
@endpush
