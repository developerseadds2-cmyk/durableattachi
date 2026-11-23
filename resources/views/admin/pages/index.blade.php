@extends('admin.layout.app')
@section('title','CMS Pages')
@section('breadcrumb')
  <li class="breadcrumb-item active">Pages</li>
@endsection

@section('content')
<div class="page-header">
  <div><h4>CMS Pages</h4><p class="text-muted small mb-0">Manage static content pages</p></div>
  <a href="{{ route('admin.pages.create') }}" class="btn btn-gold"><i class="bi bi-plus-lg me-1"></i>Add Page</a>
</div>

<div class="admin-table">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr><th>Title</th><th>Slug</th><th>Status</th><th>Updated</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @forelse($pages as $page)
        <tr>
          <td class="fw-600">{{ $page->title }}</td>
          <td><code class="small">{{ url('/page/' . $page->slug) }}</code></td>
          <td>@if($page->status)<span class="badge bg-success">Active</span>@else<span class="badge bg-secondary">Inactive</span>@endif</td>
          <td class="small text-muted">{{ $page->updated_at->format('d M Y') }}</td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a>
              <a href="{{ route('page.show', $page->slug) }}" class="btn btn-sm btn-light" target="_blank"><i class="bi bi-eye"></i></a>
              <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('admin.pages.destroy', $page) }}')"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center py-4 text-muted">No pages yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="p-3">{{ $pages->links() }}</div>
</div>
<form id="deleteForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>
@endsection
@push('scripts')
<script>function confirmDelete(url){if(confirm('Delete this page?')){document.getElementById('deleteForm').action=url;document.getElementById('deleteForm').submit();}}</script>
@endpush
