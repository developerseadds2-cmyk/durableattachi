@extends('admin.layout.app')
@section('title','Blog Posts')
@section('breadcrumb')
  <li class="breadcrumb-item active">Blog</li>
@endsection

@section('content')
<div class="page-header">
  <div><h4>Blog Posts</h4></div>
  <a href="{{ route('admin.blog.create') }}" class="btn btn-gold"><i class="bi bi-plus-lg me-1"></i>New Post</a>
</div>

<div class="admin-table">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr><th>Post</th><th>Author</th><th>Status</th><th>Views</th><th>Date</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @forelse($posts as $post)
        <tr>
          <td>
            <div class="d-flex align-items-center gap-3">
              <img src="{{ $post->thumbnail_url }}" style="width:48px;height:40px;object-fit:cover;border-radius:4px;" alt="">
              <div>
                <div class="fw-600 small">{{ Str::limit($post->title, 50) }}</div>
                @if($post->is_featured)<span class="badge bg-warning text-dark" style="font-size:0.6rem;">Featured</span>@endif
              </div>
            </div>
          </td>
          <td class="small">{{ $post->author?->name }}</td>
          <td>
            @if($post->status==='published')<span class="badge bg-success">Published</span>
            @else<span class="badge bg-warning text-dark">Draft</span>@endif
          </td>
          <td class="small text-muted">{{ number_format($post->views) }}</td>
          <td class="small text-muted">{{ $post->published_at?->format('d M Y') ?? $post->created_at->format('d M Y') }}</td>
          <td>
            <div class="d-flex gap-1">
              <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a>
              <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('admin.blog.destroy', $post) }}')"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center py-4 text-muted">No blog posts yet.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="p-3">{{ $posts->links() }}</div>
</div>
<form id="deleteForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>
@endsection
@push('scripts')
<script>function confirmDelete(url){if(confirm('Delete this post?')){document.getElementById('deleteForm').action=url;document.getElementById('deleteForm').submit();}}</script>
@endpush
