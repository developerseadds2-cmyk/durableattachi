@extends('admin.layout.app')
@section('title', 'Add Size')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.sizes.index') }}">Sizes</a></li>
  <li class="breadcrumb-item active">Add Size</li>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h4>Add New Size</h4>
    <p class="text-muted small mb-0">Add a product size option (e.g. Cabin 55cm, Medium 68cm, 32L Backpack)</p>
  </div>
  <a href="{{ route('admin.sizes.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-card">
      <form method="POST" action="{{ route('admin.sizes.store') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Size Name <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Cabin (55 cm), Medium (68 cm), Large (79 cm), 32 Litres" required>
          @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Size Code / Short Tag</label>
          <input type="text" name="code" class="form-control" value="{{ old('code') }}" placeholder="e.g. 55CM, S, M, L, 32L">
          <small class="text-muted">Short identifier used on product tags.</small>
        </div>
        <div class="mb-3 form-check form-switch">
          <input class="form-check-input" type="checkbox" name="status" value="1" id="status" checked>
          <label class="form-check-label" for="status">Active</label>
        </div>
        <button type="submit" class="btn btn-gold">Save Size</button>
      </form>
    </div>
  </div>
</div>
@endsection
