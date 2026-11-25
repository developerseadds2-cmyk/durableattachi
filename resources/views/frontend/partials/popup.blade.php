@php
  use App\Models\Popup;

  $currentCategory = isset($category) ? $category : null;
  $currentProduct = isset($product) ? $product : null;
  $isHomePage = request()->routeIs('home');

  // Query active popups valid for now
  $now = now();
  $activePopups = Popup::where('is_active', true)
    ->where(function($q) use ($now) {
      $q->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
    })
    ->where(function($q) use ($now) {
      $q->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
    })
    ->get();

  // Find best matching popup according to current page
  $matchedPopup = null;

  // 1. Check product specific
  if ($currentProduct) {
    $matchedPopup = $activePopups->firstWhere('product_id', $currentProduct->id);
    if (!$matchedPopup && $currentProduct->category_id) {
      $matchedPopup = $activePopups->firstWhere('category_id', $currentProduct->category_id);
    }
  }

  // 2. Check category specific
  if (!$matchedPopup && $currentCategory) {
    $matchedPopup = $activePopups->firstWhere('category_id', $currentCategory->id);
  }

  // 3. Check home_only
  if (!$matchedPopup && $isHomePage) {
    $matchedPopup = $activePopups->firstWhere('target_type', 'home_only');
  }

  // 4. Fallback to all pages
  if (!$matchedPopup) {
    $matchedPopup = $activePopups->firstWhere('target_type', 'all');
  }
@endphp

@if($matchedPopup)
<style>
/* Promotional & Offer Popup Modal Styles */
.site-promo-popup-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(15, 23, 42, 0.72);
  backdrop-filter: blur(4px);
  z-index: 999999;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 16px;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.35s ease, visibility 0.35s ease;
}
.site-promo-popup-backdrop.show {
  opacity: 1;
  visibility: visible;
}
.site-promo-popup-card {
  background: #ffffff;
  border-radius: 20px;
  max-width: 540px;
  width: 100%;
  position: relative;
  overflow: hidden;
  box-shadow: 0 25px 60px -15px rgba(20, 45, 78, 0.35);
  transform: scale(0.92) translateY(20px);
  transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
}
.site-promo-popup-backdrop.show .site-promo-popup-card {
  transform: scale(1) translateY(0);
}
.promo-popup-close-btn {
  position: absolute;
  top: 14px;
  right: 14px;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.9);
  border: 1px solid rgba(0, 0, 0, 0.08);
  color: #475569;
  font-size: 1.1rem;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  z-index: 10;
  box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  transition: all 0.2s;
}
.promo-popup-close-btn:hover {
  background: #142D4E;
  color: #ffffff;
  transform: rotate(90deg);
}
.promo-popup-img-wrap {
  width: 100%;
  max-height: 260px;
  overflow: hidden;
  position: relative;
  background: #f8fafc;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 12px 16px 0;
}
.promo-popup-img {
  width: auto;
  max-width: 100%;
  max-height: 240px;
  object-fit: contain;
  display: block;
  border-radius: 12px;
}
.promo-popup-content {
  padding: 32px 30px;
  text-align: center;
}
.promo-popup-badge {
  display: inline-block;
  background: #fef3c7;
  color: #92400e;
  border: 1px solid #fde68a;
  font-size: 0.75rem;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1.2px;
  padding: 4px 12px;
  border-radius: 50px;
  margin-bottom: 14px;
}
.promo-popup-title {
  font-family: var(--font-serif, "Playfair Display", Georgia, serif);
  font-size: 1.85rem;
  font-weight: 800;
  color: #142D4E;
  line-height: 1.25;
  margin-bottom: 10px;
}
.promo-popup-desc {
  font-size: 0.93rem;
  color: #64748b;
  line-height: 1.6;
  margin-bottom: 20px;
}
.promo-coupon-box {
  background: #f8fafc;
  border: 2px dashed #cbd5e1;
  border-radius: 12px;
  padding: 12px 18px;
  margin-bottom: 22px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  cursor: pointer;
  transition: all 0.2s;
}
.promo-coupon-box:hover {
  border-color: #142D4E;
  background: #eff6ff;
}
.promo-coupon-code {
  font-family: monospace;
  font-size: 1.25rem;
  font-weight: 800;
  letter-spacing: 1.5px;
  color: #142D4E;
}
.promo-copy-tag {
  font-size: 0.78rem;
  font-weight: 700;
  color: #0369a1;
  background: #e0f2fe;
  padding: 4px 10px;
  border-radius: 6px;
  white-space: nowrap;
}
.promo-action-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  width: 100%;
  padding: 14px 24px;
  background: #142D4E;
  color: #ffffff !important;
  font-size: 0.95rem;
  font-weight: 700;
  border-radius: 10px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  text-decoration: none;
  box-shadow: 0 4px 14px rgba(20, 45, 78, 0.25);
  transition: all 0.2s;
}
.promo-action-btn:hover {
  background: #1e3f6b;
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(20, 45, 78, 0.35);
}
.promo-dismiss-link {
  display: inline-block;
  margin-top: 14px;
  font-size: 0.8rem;
  color: #94a3b8;
  cursor: pointer;
  text-decoration: underline;
  transition: color 0.2s;
}
.promo-dismiss-link:hover {
  color: #475569;
}
</style>

<div id="sitePromoPopupBackdrop" class="site-promo-popup-backdrop" onclick="handleBackdropClick(event)">
  <div class="site-promo-popup-card {{ $matchedPopup->type === 'image_only' ? 'image-only-card' : '' }}" style="{{ $matchedPopup->type === 'image_only' ? 'background:transparent; box-shadow:none; max-width:480px; text-align:center;' : '' }}">
    <button type="button" class="promo-popup-close-btn" onclick="closePromoPopup()" aria-label="Close popup" style="{{ $matchedPopup->type === 'image_only' ? 'top:6px; right:6px;' : '' }}">
      <i class="fa-solid fa-xmark"></i>
    </button>

    @if($matchedPopup->type === 'image_only' && $matchedPopup->image)
      <!-- Pure Image-Only Popup (Clean clickable banner) -->
      <div style="border-radius:18px; overflow:hidden; box-shadow:0 25px 60px rgba(0,0,0,0.35); position:relative;">
        @if($matchedPopup->button_url)
          <a href="{{ $matchedPopup->button_url }}" onclick="closePromoPopup()" style="display:block;">
            <img src="{{ $matchedPopup->image_url }}" alt="{{ $matchedPopup->title }}" style="width:100%; height:auto; display:block; border-radius:18px;">
          </a>
        @else
          <img src="{{ $matchedPopup->image_url }}" alt="{{ $matchedPopup->title }}" style="width:100%; height:auto; display:block; border-radius:18px;">
        @endif
      </div>
    @else
      @if($matchedPopup->image)
        <div class="promo-popup-img-wrap">
          <img src="{{ $matchedPopup->image_url }}" alt="{{ $matchedPopup->title }}" class="promo-popup-img">
        </div>
      @endif

      <div class="promo-popup-content">
        @if($matchedPopup->badge_text)
          <span class="promo-popup-badge">
            @if($matchedPopup->type === 'offer')
              <i class="fa-solid fa-bolt text-warning me-1"></i>
            @endif
            {{ $matchedPopup->badge_text }}
          </span>
        @endif

        @if($matchedPopup->headline)
          <h3 class="promo-popup-title">{{ $matchedPopup->headline }}</h3>
        @elseif($matchedPopup->title)
          <h3 class="promo-popup-title">{{ $matchedPopup->title }}</h3>
        @endif

        @if($matchedPopup->description)
          <p class="promo-popup-desc">{{ $matchedPopup->description }}</p>
        @endif

        @if($matchedPopup->type === 'offer' && $matchedPopup->coupon_code)
          <div class="promo-coupon-box" onclick="copyPromoCoupon('{{ $matchedPopup->coupon_code }}')" title="Click to copy coupon code">
            <div class="text-start">
              <span class="d-block text-xs text-muted text-uppercase fw-bold" style="font-size:0.7rem; letter-spacing:0.5px;">Discount Code</span>
              <span class="promo-coupon-code" id="promoCodeDisplay">{{ $matchedPopup->coupon_code }}</span>
            </div>
            <span class="promo-copy-tag" id="promoCopyBadge">
              <i class="fa-regular fa-copy me-1"></i> Copy Code
            </span>
          </div>
        @endif

        @if($matchedPopup->button_text && $matchedPopup->button_url)
          <a href="{{ $matchedPopup->button_url }}" class="promo-action-btn" onclick="closePromoPopup()">
            <span>{{ $matchedPopup->button_text }}</span>
            <i class="fa-solid fa-arrow-right"></i>
          </a>
        @endif

        <div>
          <span class="promo-dismiss-link" onclick="closePromoPopup()">No thanks, I will browse first</span>
        </div>
      </div>
    @endif
  </div>
</div>

<script>
(function() {
  const popupId = {{ $matchedPopup->id }};
  const delaySec = {{ $matchedPopup->delay_seconds ?? 2 }};
  const showOnce = {{ $matchedPopup->show_once_per_session ? 'true' : 'false' }};
  const sessionKey = 'dsh_promo_popup_seen_' + popupId;

  if (showOnce && sessionStorage.getItem(sessionKey)) {
    return; // Already seen in this session
  }

  window.closePromoPopup = function() {
    const el = document.getElementById('sitePromoPopupBackdrop');
    if (el) {
      el.classList.remove('show');
    }
    if (showOnce) {
      sessionStorage.setItem(sessionKey, '1');
    }
  };

  window.handleBackdropClick = function(e) {
    if (e.target && e.target.id === 'sitePromoPopupBackdrop') {
      window.closePromoPopup();
    }
  };

  window.copyPromoCoupon = function(code) {
    if (navigator.clipboard) {
      navigator.clipboard.writeText(code).then(() => {
        const badge = document.getElementById('promoCopyBadge');
        if (badge) {
          badge.innerHTML = '<i class="fa-solid fa-check me-1"></i> Copied!';
          badge.style.background = '#dcfce7';
          badge.style.color = '#15803d';
          setTimeout(() => {
            badge.innerHTML = '<i class="fa-regular fa-copy me-1"></i> Copy Code';
            badge.style.background = '#e0f2fe';
            badge.style.color = '#0369a1';
          }, 2500);
        }
      });
    }
  };

  // Trigger popup after delay
  window.addEventListener('load', function() {
    setTimeout(function() {
      const el = document.getElementById('sitePromoPopupBackdrop');
      if (el) {
        el.classList.add('show');
      }
    }, delaySec * 1000);
  });
})();
</script>
@endif
