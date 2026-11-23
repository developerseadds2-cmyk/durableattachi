@extends('admin.layout.app')
@php($editing = isset($coupon))
@section('title', $editing ? 'Edit Coupon' : 'Add Coupon')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.coupons.index') }}">Coupons</a></li>
  <li class="breadcrumb-item active">{{ $editing ? 'Edit' : 'Add' }}</li>
@endsection
@section('content')
<div class="page-header"><h4>{{ $editing ? 'Edit Coupon' : 'Add Coupon' }}</h4><a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a></div>
<form method="POST" action="{{ $editing ? route('admin.coupons.update', $coupon) : route('admin.coupons.store') }}">
  @csrf @if($editing) @method('PUT') @endif
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="form-card">
        <h6 class="fw-bold mb-3 pb-2 border-bottom">Discount Details</h6>
        <div class="row g-3">
          <div class="col-md-6"><label class="form-label">Coupon Code <span class="text-danger">*</span></label><input name="code" class="form-control text-uppercase" value="{{ old('code', $coupon->code ?? '') }}" required placeholder="WELCOME10"></div>
          <div class="col-md-6"><label class="form-label">Discount Type <span class="text-danger">*</span></label><select name="type" class="form-select" required><option value="percentage" @selected(old('type', $coupon->type ?? 'percentage') === 'percentage')>Percentage (%)</option><option value="fixed" @selected(old('type', $coupon->type ?? '') === 'fixed')>Fixed Amount (₨)</option></select></div>
          <div class="col-md-4"><label class="form-label">Discount Value <span class="text-danger">*</span></label><input type="number" name="value" class="form-control" value="{{ old('value', $coupon->value ?? '') }}" min="0" step="0.01" required></div>
          <div class="col-md-4"><label class="form-label">Minimum Order</label><input type="number" name="min_order_amount" class="form-control" value="{{ old('min_order_amount', $coupon->min_order_amount ?? 0) }}" min="0" step="0.01"></div>
          <div class="col-md-4"><label class="form-label">Maximum Discount</label><input type="number" name="max_discount_amount" class="form-control" value="{{ old('max_discount_amount', $coupon->max_discount_amount ?? '') }}" min="0" step="0.01"></div>
        </div>
      </div>
      <div class="form-card mt-4">
        <h6 class="fw-bold mb-3 pb-2 border-bottom">Validity</h6>
        <div class="row g-3">
          <div class="col-md-6"><label class="form-label">Start Date</label><input type="date" name="start_date" class="form-control" value="{{ old('start_date', isset($coupon) && $coupon->start_date ? $coupon->start_date->format('Y-m-d') : '') }}"></div>
          <div class="col-md-6"><label class="form-label">End Date</label><input type="date" name="end_date" class="form-control" value="{{ old('end_date', isset($coupon) && $coupon->end_date ? $coupon->end_date->format('Y-m-d') : '') }}"></div>
          <div class="col-md-6"><label class="form-label">Usage Limit</label><input type="number" name="usage_limit" class="form-control" value="{{ old('usage_limit', $coupon->usage_limit ?? '') }}" min="1" placeholder="Unlimited if blank"></div>
        </div>
      </div>
    </div>
    <div class="col-lg-4"><div class="form-card"><h6 class="fw-bold mb-3 pb-2 border-bottom">Settings</h6><div class="form-check form-switch mb-3"><input class="form-check-input" type="checkbox" name="status" value="1" @checked(old('status', $coupon->status ?? true))><label class="form-check-label">Active</label></div><button class="btn btn-gold w-100"><i class="bi bi-check-lg me-1"></i>{{ $editing ? 'Update Coupon' : 'Create Coupon' }}</button></div></div>
  </div>
</form>
@endsection
