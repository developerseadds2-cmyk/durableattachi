@extends('admin.layout.app')
@section('title', 'Edit Color')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.colors.index') }}">Colors</a></li>
  <li class="breadcrumb-item active">Edit Color</li>
@endsection

@section('content')
<div class="page-header">
  <div>
    <h4>Edit Color</h4>
    <p class="text-muted small mb-0">{{ $color->name }}</p>
  </div>
  <a href="{{ route('admin.colors.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left me-1"></i>Back</a>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="form-card">
      <form method="POST" action="{{ route('admin.colors.update', $color) }}">
        @csrf @method('PUT')
        <div class="mb-3">
          <label class="form-label">Color Name <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $color->name) }}" required>
          @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Color Code (Hex)</label>
          <div class="input-group">
            <input type="color" id="colorPicker" class="form-control form-control-color" value="{{ $color->code ?: '#C0C0C0' }}" title="Choose color" onchange="document.getElementById('codeText').value = this.value">
            <input type="text" name="code" id="codeText" class="form-control" value="{{ old('code', $color->code) }}" placeholder="#C0C0C0" oninput="document.getElementById('colorPicker').value = this.value">
          </div>
        </div>
        <div class="mb-3 form-check form-switch">
          <input class="form-check-input" type="checkbox" name="status" value="1" id="status" {{ $color->status ? 'checked' : '' }}>
          <label class="form-check-label" for="status">Active</label>
        </div>
        <button type="submit" class="btn btn-gold">Update Color</button>
      </form>
    </div>
  </div>
</div>
@endsection
