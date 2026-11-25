@extends('admin.layout.app')
@section('title','Reviews')
@section('breadcrumb')
  <li class="breadcrumb-item active">Reviews</li>
@endsection

@section('content')
<div class="page-header">
  <div><h4>Product Reviews</h4></div>
  <div>
    <a href="{{ route('admin.reviews.index') }}" class="btn btn-sm {{ !request('status') ? 'btn-gold' : 'btn-outline-secondary' }}">All</a>
    <a href="{{ route('admin.reviews.index', ['status'=>'pending']) }}" class="btn btn-sm {{ request('status')==='pending' ? 'btn-gold' : 'btn-outline-secondary' }}">Pending</a>
    <a href="{{ route('admin.reviews.index', ['status'=>'approved']) }}" class="btn btn-sm {{ request('status')==='approved' ? 'btn-gold' : 'btn-outline-secondary' }}">Approved</a>
  </div>
</div>

<form method="GET" class="form-card mb-4"><div class="row g-2 align-items-end"><div class="col-md-4"><label class="form-label">Search</label><input name="search" class="form-control" value="{{ request('search') }}" placeholder="Product, customer or review"></div><div class="col-md-2"><label class="form-label">Status</label><select name="status" class="form-select"><option value="">All</option><option value="pending" @selected(request('status')==='pending')>Pending</option><option value="approved" @selected(request('status')==='approved')>Approved</option><option value="rejected" @selected(request('status')==='rejected')>Rejected</option></select></div><div class="col-md-2"><label class="form-label">Rating</label><select name="rating" class="form-select"><option value="">All ratings</option>@for($rating=5;$rating>=1;$rating--)<option value="{{ $rating }}" @selected(request('rating')==$rating)>{{ $rating }} stars</option>@endfor</select></div><div class="col-md-4 d-flex gap-2"><button class="btn btn-gold">Filter</button><a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary">Reset</a></div></div></form>

<div class="admin-table">
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr><th>Product</th><th>Customer</th><th>Rating</th><th>Review</th><th>Status</th><th>Date</th><th>Actions</th></tr>
      </thead>
      <tbody>
        @forelse($reviews as $review)
        <tr>
          <td class="small fw-600">{{ $review->product?->name }}</td>
          <td class="small">
            <div class="fw-bold text-dark">{{ $review->author_name }}</div>
            @if($review->customer_email)<div class="text-muted" style="font-size:0.75rem;">{{ $review->customer_email }}</div>@endif
          </td>
          <td><span style="color:#c9a96e;">{{ str_repeat('★', $review->rating) }}</span></td>
          <td class="small"><strong>{{ $review->title }}</strong><br>{{ Str::limit($review->body, 80) }}</td>
          <td>
            @if($review->status==='approved')<span class="badge bg-success">Approved</span>
            @elseif($review->status==='rejected')<span class="badge bg-danger">Rejected</span>
            @else<span class="badge bg-warning text-dark">Pending</span>@endif
          </td>
          <td class="small text-muted">{{ $review->created_at->format('d M Y') }}</td>
          <td>
            <div class="d-flex gap-1 flex-wrap">
              @if($review->status !== 'approved')
                <form action="{{ route('admin.reviews.approve', $review) }}" method="POST">@csrf<button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check"></i></button></form>
              @endif
              @if($review->status !== 'rejected')
                <form action="{{ route('admin.reviews.reject', $review) }}" method="POST">@csrf<button type="submit" class="btn btn-sm btn-warning"><i class="bi bi-x"></i></button></form>
              @endif
              <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('admin.reviews.destroy', $review) }}')"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center py-4 text-muted">No reviews found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="p-3">{{ $reviews->links() }}</div>
</div>
<form id="deleteForm" method="POST" style="display:none;">@csrf @method('DELETE')</form>
@endsection
@push('scripts')
<script>function confirmDelete(url){if(confirm('Delete this review?')){document.getElementById('deleteForm').action=url;document.getElementById('deleteForm').submit();}}</script>
@endpush
