@extends('admin.layout.app')
@section('title','Sliders')
@section('breadcrumb')
  <li class="breadcrumb-item active">Sliders</li>
@endsection

@section('content')
<div class="page-header">
  <div><h4>Sliders</h4><p class="text-muted small mb-0">Manage homepage hero sliders</p></div>
  <a href="{{ route('admin.sliders.create') }}" class="btn btn-gold"><i class="bi bi-plus-lg me-1"></i>Add Slider</a>
</div>

<div class="row g-4">
  @forelse($sliders as $slider)
  <div class="col-md-6 col-lg-4">
    <div class="form-card">
      <img src="{{ $slider->image_url }}" alt="{{ $slider->title }}" style="width:100%;height:200px;object-fit:cover;border-radius:8px;margin-bottom:16px;">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <h6 class="fw-bold mb-1">{{ $slider->title ?? 'Untitled Slider' }}</h6>
          <p class="text-muted small mb-0">{{ Str::limit($slider->subtitle, 60) }}</p>
          <div class="mt-2">
            @if($slider->status)<span class="badge bg-success">Active</span>@else<span class="badge bg-secondary">Inactive</span>@endif
            <span class="badge bg-light text-dark ms-1">Order: {{ $slider->sort_order }}</span>
          </div>
        </div>
        <div class="d-flex gap-1">
          <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a>
          <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('admin.sliders.destroy', $slider) }}')"><i class="bi bi-trash"></i></button>
        </div>
      </div>
    </div>
  </div>
  @empty
  <div class="col-12"><div class="form-card text-center py-5 text-muted">
    <i class="bi bi-images fs-1 d-block mb-2"></i>No sliders yet.
    <a href="{{ route('admin.sliders.create') }}" class="btn btn-gold btn-sm mt-2">Add First Slider</a>
  </div></div>
  @endforelse
</div>

<form id="deleteForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>
@endsection
@push('scripts')
<script>function confirmDelete(url){if(confirm('Delete this slider?')){document.getElementById('deleteForm').action=url;document.getElementById('deleteForm').submit();}}</script>
@endpush
