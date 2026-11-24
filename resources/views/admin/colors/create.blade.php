@extends('admin.layout.app')
@section('title', 'Add Color')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.colors.index') }}">Colors</a></li>
  <li class="breadcrumb-item active">Add Color</li>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h4>Add New Color</h4>
    <p class="text-muted small mb-0">Add a product color option</p>
  </div>
  <a href="{{ route('admin.colors.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-card">
      <form method="POST" action="{{ route('admin.colors.store') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Color Name <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. Silver, Midnight Blue, Jet Black" required>
          @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Color Code (Hex)</label>
          <div class="input-group">
            <input type="color" id="colorPicker" class="form-control form-control-color" value="#C0C0C0" title="Choose color" onchange="document.getElementById('codeText').value = this.value">
            <input type="text" name="code" id="codeText" class="form-control" value="{{ old('code', '#C0C0C0') }}" placeholder="#C0C0C0" oninput="document.getElementById('colorPicker').value = this.value">
          </div>
        </div>
        <div class="mb-3 form-check form-switch">
          <input class="form-check-input" type="checkbox" name="status" value="1" id="status" checked>
          <label class="form-check-label" for="status">Active</label>
        </div>
        <button type="submit" class="btn btn-gold">Save Color</button>
      </form>
    </div>
  </div>
</div>
@endsection
