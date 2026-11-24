@extends('frontend.layouts.app')
@section('title', $q ? 'Search: '.$q.' — Durable Suitcase House' : 'Search — Durable Suitcase House')

@push('styles')
<style>
.search-hero {
  background: var(--pd-ice);
  padding: 45px 0 35px;
  text-align: center;
}
.search-form-wrap {
  max-width: 580px;
  margin: 20px auto 0;
  display: flex;
  gap: 8px;
}
.search-input-custom {
  border-radius: 8px;
  border: 1.5px solid #dcdfd8;
  padding: 12px 18px;
  font-size: 0.95rem;
}
.search-input-custom:focus {
  border-color: var(--dsh-navy-light);
  box-shadow: 0 0 0 3px rgba(45, 90, 39, 0.12);
}
.search-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 300px));
  gap: 24px;
}
.search-grid-item {
  width: 100%;
}

@media (max-width: 768px) {
  .search-hero {
    padding: 30px 16px 25px;
  }
  .search-hero h1 {
    font-size: 1.85rem !important;
  }
  .search-form-wrap {
    flex-direction: column;
    gap: 10px;
  }
  .search-form-wrap button {
    width: 100%;
    justify-content: center;
  }
}

@media (max-width: 576px) {
  .search-grid {
    grid-template-columns: 1fr;
    gap: 16px;
  }
  .search-grid-item {
    max-width: 360px;
    margin: 0 auto;
  }
  .product-card {
    padding: 14px;
    border-radius: 14px;
  }
  .product-card-body {
    padding: 12px 6px 6px;
  }
  .product-card-name {
    font-size: 1rem;
    line-height: 1.35;
  }
  .price-current {
    font-size: 1.05rem;
  }
}
</style>
@endpush

@section('content')
<div class="search-hero">
  <div class="container-xl-custom">
    <span class="section-label">Find Your Favorite</span>
    <h1 style="font-family:var(--font-serif);font-size:2.5rem;font-weight:400;margin-bottom:6px;">Search Results</h1>
    <form action="{{ route('search') }}" method="GET" class="search-form-wrap">
      <input type="search" name="q" value="{{ $q }}" class="form-control search-input-custom" placeholder="Search suitcases, backpacks, handbags..." required minlength="2">
      <button class="btn-glamora" style="padding:11px 26px;border-radius:8px;">
        <i class="bi bi-search me-1"></i> Search
      </button>
    </form>
  </div>
</div>

<div class="container-xl-custom py-4 py-md-5">
  @if($q && $products->count())
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3" style="border-bottom:1px solid var(--border);">
      <span class="text-muted small">
        Results for <strong class="text-dark">"{{ $q }}"</strong> ({{ $products->total() }})
      </span>
      <a href="{{ route('shop.index') }}" class="btn-outline-glamora" style="padding:7px 16px;font-size:0.72rem;border-radius:6px;">
        <i class="bi bi-grid me-1"></i> Shop All
      </a>
    </div>

    <div class="search-grid">
      @foreach($products as $product)
        <div class="search-grid-item" data-aos="fade-up" data-aos-delay="{{ $loop->index % 6 * 60 }}">
          @include('frontend.partials.product-card', ['product' => $product])
        </div>
      @endforeach
    </div>

    <div class="mt-5 d-flex justify-content-center">
      {{ $products->links() }}
    </div>
  @else
    <div class="text-center py-5">
      <div style="width:72px;height:72px;background:var(--pd-ice);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
        <i class="bi bi-search" style="font-size:2rem;color:var(--dsh-navy-light);"></i>
      </div>
      <h5 style="font-family:var(--font-serif);font-size:1.35rem;color:var(--dsh-navy);margin-bottom:8px;">
        {{ $q ? 'No products found for "'.e($q).'"' : 'What are you looking for?' }}
      </h5>
      <p class="text-muted small mb-4">
        {{ $q ? 'Try another product name or category.' : 'Search our collection by product name or category.' }}
      </p>
      <a href="{{ route('shop.index') }}" class="btn-glamora" style="padding:11px 28px;border-radius:6px;">
        <i class="bi bi-shop me-1"></i> Browse All Products
      </a>
    </div>
  @endif
</div>
@endsection


