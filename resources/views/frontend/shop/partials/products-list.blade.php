@if($products->count() > 0)
  <div class="shop-products-grid" id="productsGridContainer">
    @foreach($products as $product)
      <div class="shop-product-item">
        @include('frontend.partials.product-card', ['product' => $product])
      </div>
    @endforeach
  </div>

  <div class="mt-5 d-flex justify-content-center" id="paginationWrap">
    {{ $products->links() }}
  </div>
@else
  <div class="text-center py-5 bg-white rounded-3 border p-5">
    <i class="fa-solid fa-suitcase-rolling fs-1 text-muted mb-3 d-block"></i>
    <h5 class="fw-bold text-dark">No Products Found</h5>
    <p class="text-muted small mb-4">Try clearing or adjusting your selected filters.</p>
    <button type="button" onclick="resetAllFilters()" class="btn btn-dark px-4 py-2" style="border-radius:6px; font-weight:600;">
      Reset Filters
    </button>
  </div>
@endif
