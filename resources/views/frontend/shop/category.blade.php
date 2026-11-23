@extends('frontend.layouts.app')
@section('title', $category->name . ' — Durable Suitcase House')
@section('content')
<div class="shop-hero"><div class="container"><span class="section-label">Collection</span><h1 style="font-family:var(--font-serif);font-size:2.5rem;font-weight:400;">{{ $category->name }}</h1><nav aria-label="breadcrumb" class="mt-3"><ol class="breadcrumb justify-content-center small text-muted" style="background:none;padding:0;margin:0;"><li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li><li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Shop</a></li><li class="breadcrumb-item active">{{ $category->name }}</li></ol></nav></div></div>
<div class="container-xl-custom py-5"><div class="d-flex justify-content-between align-items-center mb-4 pb-3" style="border-bottom:1px solid var(--border);"><span class="small text-muted">Showing <strong>{{ $products->total() }}</strong> products</span><a href="{{ route('shop.index') }}" class="btn-outline-glamora" style="padding:8px 16px;font-size:.7rem;">All Collections</a></div>
@if($products->count())
  <div class="shop-grid">
    @foreach($products as $product)
      <div class="shop-grid-item" data-aos="fade-up" data-aos-delay="{{ $loop->index % 6 * 60 }}">
        @include('frontend.partials.product-card', ['product' => $product])
      </div>
    @endforeach
  </div>
  <div class="mt-5 d-flex justify-content-center">{{ $products->links() }}</div>
@else<div class="text-center py-5"><i class="bi bi-search" style="font-size:3rem;color:var(--border);display:block;margin-bottom:16px;"></i><h5 style="font-family:var(--font-serif);">No products found</h5><p class="text-muted">There are no products in this category yet.</p><a href="{{ route('shop.index') }}" class="btn-gold" style="padding:12px 28px;font-size:.78rem;">Browse Collection</a></div>@endif</div>
@push('styles')
<style>
.shop-hero {
  background: var(--pd-ice);
  padding: 50px 0;
  text-align: center;
}
.shop-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 300px));
  gap: 24px;
}
.shop-grid-item {
  width: 100%;
}
@media (max-width: 576px) {
  .shop-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }
  .shop-grid-item {
    max-width: 360px;
    margin: 0 auto;
  }
}
</style>
@endpush
@endsection
