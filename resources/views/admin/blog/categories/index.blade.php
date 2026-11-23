@extends('admin.layout.app')
@section('title', 'Blog Categories')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blog</a></li>
  <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
<div class="page-header">
  <div><h4>Blog Categories</h4><p class="text-muted small mb-0">Organize published articles</p></div>
  <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-gold"><i class="bi bi-plus-lg me-1"></i>Add Category</a>
</div>
<div class="admin-table">
  <div class="table-responsive">
    <table class="table">
      <thead><tr><th>Name</th><th>Slug</th><th>Posts</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
      @forelse($categories as $category)
        <tr>
          <td class="fw-semibold">{{ $category->name }}</td>
          <td><code>{{ $category->slug }}</code></td>
          <td>{{ $category->posts_count }}</td>
          <td><span class="badge {{ $category->status ? 'bg-success' : 'bg-secondary' }}">{{ $category->status ? 'Active' : 'Inactive' }}</span></td>
          <td>
            <a href="{{ route('admin.blog-categories.edit', $category) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a>
            <form action="{{ route('admin.blog-categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="5" class="text-center py-4 text-muted">No blog categories yet.</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
  <div class="p-3">{{ $categories->links() }}</div>
</div>
@endsection