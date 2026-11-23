<?php $__env->startSection('title', \App\Models\Setting::get('site_name', 'Durable Suitcase House') . ' — Luggage, Handbags & Travel Essentials Since 1960'); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* ============================================
   HERO SLIDER - OPTION 1 CLASSIC HERITAGE
   ============================================ */
.hero-slider {
  width: 100%;
  position: relative;
  overflow: hidden;
  background: var(--dsh-cream);
}
.hero-slider .swiper,
.hero-slider .swiper-wrapper {
  width: 100%;
  height: auto;
}
.hero-slide {
  width: 100%;
  min-height: 540px;
  max-height: 680px;
  position: relative;
  overflow: hidden;
  display: flex !important;
  align-items: center;
  background-size: cover;
  background-position: right center;
  background-repeat: no-repeat;
}
.hero-slide-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(90deg, rgba(247,243,232,0.96) 0%, rgba(247,243,232,0.85) 45%, rgba(247,243,232,0.2) 100%);
  z-index: 1;
}
.hero-slide-container {
  width: 100%;
  max-width: 100%;
  margin: 0;
  padding: 0 60px;
  position: relative;
  z-index: 2;
}
.hero-slide-content {
  max-width: 720px;
  text-align: left;
}
.hero-slide-label {
  font-size: 0.82rem;
  letter-spacing: 3.5px;
  font-weight: 800;
  text-transform: uppercase;
  color: var(--dsh-gold-dark);
  margin-bottom: 16px;
  display: inline-flex;
  align-items: center;
  gap: 12px;
}
.hero-slide-label::before {
  content: '';
  display: inline-block;
  width: 36px;
  height: 2.5px;
  background: var(--dsh-gold);
}
.hero-title {
  font-family: var(--font-serif);
  font-size: clamp(2.5rem, 4.5vw, 4.2rem);
  font-weight: 700;
  color: var(--dsh-navy);
  line-height: 1.15;
  margin-bottom: 18px;
  letter-spacing: -0.5px;
}
.hero-title em {
  font-style: italic;
  font-weight: 600;
  color: var(--dsh-gold-dark);
}
.hero-desc {
  font-size: 1.1rem;
  font-weight: 450;
  color: var(--dsh-charcoal);
  max-width: 580px;
  margin-bottom: 30px;
  line-height: 1.7;
}
.hero-btn-pill {
  background: var(--dsh-navy);
  color: #fff;
  border: 2px solid var(--dsh-navy);
  padding: 13px 34px;
  font-size: 0.92rem;
  font-weight: 700;
  letter-spacing: 0.8px;
  border-radius: 30px;
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  text-decoration: none;
}
.hero-btn-pill:hover {
  background: var(--dsh-navy-light);
  border-color: var(--dsh-navy-light);
  color: #fff;
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(20,45,78,0.25);
}
.hero-btn-outline-pill {
  background: transparent;
  color: var(--dsh-navy);
  border: 2px solid var(--dsh-navy);
  padding: 13px 30px;
  font-size: 0.92rem;
  font-weight: 700;
  letter-spacing: 0.8px;
  border-radius: 30px;
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  text-decoration: none;
}
.hero-btn-outline-pill:hover {
  background: var(--dsh-navy);
  color: #fff;
}

@media (max-width: 991px) {
  .hero-slide {
    min-height: 480px;
    padding: 40px 0;
  }
  .hero-slide-container { padding: 0 24px; }
  .hero-slide-overlay {
    background: linear-gradient(90deg, rgba(247,243,232,0.96) 0%, rgba(247,243,232,0.92) 100%);
  }
  .hero-title { font-size: clamp(2rem, 6vw, 2.6rem); }
}

@media (max-width: 575px) {
  .hero-slide {
    min-height: 400px;
    padding: 30px 0;
  }
  .hero-slide-container { padding: 0 16px; }
  .hero-slide-content { text-align: center; }
  .hero-slide-label { justify-content: center; font-size: 0.72rem; }
  .hero-title { font-size: 1.8rem; line-height: 1.25; }
  .hero-desc { font-size: 0.9rem; margin-bottom: 22px; }
  .hero-btns-wrap {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
  }
  .hero-btn-pill, .hero-btn-outline-pill {
    padding: 10px 20px;
    font-size: 0.82rem;
  }
}

/* Category Grid / Circles */
.categories-section {
  padding: 70px 0 75px;
  background: #ffffff;
}
.cat-card-heritage {
  background: var(--dsh-cream-light);
  border: 1.5px solid var(--dsh-cream-dark);
  border-radius: 12px;
  overflow: hidden;
  text-align: center;
  text-decoration: none;
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  height: 100%;
}
.cat-card-heritage:hover {
  transform: translateY(-6px);
  border-color: var(--dsh-gold);
  box-shadow: 0 12px 28px rgba(20,45,78,0.08);
}
.cat-card-img {
  width: 100%;
  aspect-ratio: 4 / 3;
  overflow: hidden;
  background: #fff;
  position: relative;
}
.cat-card-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.45s ease;
}
.cat-card-heritage:hover .cat-card-img img {
  transform: scale(1.06);
}
.cat-card-body {
  padding: 18px 14px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
  justify-content: space-between;
}
.cat-card-title {
  font-family: var(--font-serif);
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--dsh-navy);
  margin-bottom: 6px;
}
.cat-card-sub {
  font-size: 0.8rem;
  color: var(--dsh-text-muted);
  line-height: 1.4;
  margin-bottom: 12px;
}
.cat-card-link {
  font-size: 0.76rem;
  font-weight: 700;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  color: var(--dsh-gold-dark);
}

/* Heritage Highlight Strip */
.heritage-strip {
  background: var(--dsh-cream);
  border-top: 1px solid var(--dsh-cream-dark);
  border-bottom: 1px solid var(--dsh-cream-dark);
  padding: 40px 0;
}
.heritage-box {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 10px 14px;
}
.heritage-icon {
  width: 54px;
  height: 54px;
  border-radius: 50%;
  background: #fff;
  border: 1.5px solid var(--dsh-cream-dark);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  color: var(--dsh-navy);
  flex-shrink: 0;
}
.heritage-title {
  font-size: 0.95rem;
  font-weight: 700;
  color: var(--dsh-navy);
  margin-bottom: 2px;
}
.heritage-text {
  font-size: 0.82rem;
  color: var(--dsh-text-muted);
  margin-bottom: 0;
  line-height: 1.4;
}

/* Products Section */
.products-section { padding: 75px 0 85px; }
.section-header-heritage {
  text-align: center;
  margin-bottom: 44px;
}
.section-label-heritage {
  display: block;
  font-size: 0.8rem;
  font-weight: 800;
  letter-spacing: 3.5px;
  text-transform: uppercase;
  color: var(--dsh-gold-dark);
  margin-bottom: 10px;
}
.section-title-wrap {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
}
.title-line-heritage {
  display: inline-block;
  width: 50px;
  height: 2px;
  background: var(--dsh-gold);
}
.section-title-heritage {
  font-family: var(--font-serif);
  font-size: clamp(2.2rem, 4vw, 3.2rem);
  font-weight: 700;
  color: var(--dsh-navy);
  margin: 0;
  letter-spacing: -0.5px;
}
.section-sub-heritage {
  font-size: 1.05rem;
  color: var(--dsh-text-muted);
  max-width: 620px;
  margin: 12px auto 0;
}

/* Brand Grid */
.brands-section {
  padding: 60px 0;
  background: #ffffff;
  border-top: 1px solid var(--dsh-cream-dark);
  border-bottom: 1px solid var(--dsh-cream-dark);
}
.brand-pill {
  background: var(--dsh-cream-light);
  border: 1px solid var(--dsh-cream-dark);
  border-radius: 8px;
  padding: 16px 20px;
  text-align: center;
  font-weight: 700;
  font-size: 0.92rem;
  color: var(--dsh-navy);
  transition: all 0.25s;
  text-decoration: none;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 64px;
}
.brand-pill:hover {
  background: var(--dsh-navy);
  border-color: var(--dsh-navy);
  color: #fff;
  transform: translateY(-3px);
  box-shadow: 0 8px 18px rgba(20,45,78,0.12);
}

/* Promo Banner Split */
.promo-split-heritage {
  display: grid;
  grid-template-columns: 1fr 1fr;
  min-height: 520px;
  background: var(--dsh-navy);
}
.promo-split-content {
  padding: 80px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  color: #fff;
}
.promo-split-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
@media (max-width: 991px) {
  .promo-split-heritage { grid-template-columns: 1fr; }
  .promo-split-content { padding: 50px 24px; text-align: center; align-items: center; }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<section class="hero-slider">
  <div class="swiper heroSwiper">
    <div class="swiper-wrapper">
      <?php $__empty_1 = true; $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="swiper-slide hero-slide" style="background-image: url('<?php echo e($slider->image); ?>');">
        <div class="hero-slide-overlay"></div>
        <div class="hero-slide-container">
          <div class="hero-slide-content">
            <span class="hero-slide-label"><?php echo e($slider->subtitle ?: 'DURABLE SUITCASE HOUSE — SINCE 1960'); ?></span>
            <h1 class="hero-title"><?php echo $slider->title; ?></h1>
            <p class="hero-desc"><?php echo e($slider->description); ?></p>
            <div class="hero-btns-wrap">
              <a href="<?php echo e($slider->button_link ?: route('shop.index')); ?>" class="hero-btn-pill">
                <?php echo e($slider->button_text ?: 'Explore Collection'); ?> <i class="bi bi-arrow-right ms-2"></i>
              </a>
              <a href="<?php echo e(route('page.show', 'about')); ?>" class="hero-btn-outline-pill">
                Our Story Since 1960
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="swiper-slide hero-slide" style="background-image: url('https://images.unsplash.com/photo-1565026057447-bc90a3dceb87?w=1600&q=85&fit=crop');">
        <div class="hero-slide-overlay"></div>
        <div class="hero-slide-container">
          <div class="hero-slide-content">
            <span class="hero-slide-label">DURABLE SUITCASE HOUSE — PATIALA</span>
            <h1 class="hero-title">A Legacy of Trust.<br><em>A Journey Since 1960.</em></h1>
            <p class="hero-desc">Over six decades serving generations with genuine luggage, school bags, stylish ladies' handbags and bridal purses under one roof.</p>
            <div class="hero-btns-wrap">
              <a href="<?php echo e(route('shop.index', ['category' => 'luggage'])); ?>" class="hero-btn-pill">
                Shop Luggage &amp; Trolleys <i class="bi bi-arrow-right ms-2"></i>
              </a>
              <a href="<?php echo e(route('page.show', 'about')); ?>" class="hero-btn-outline-pill">
                About Our Heritage
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
    <div class="hero-pagination"></div>
  </div>
</section>


<section class="heritage-strip">
  <div class="container-xl-custom">
    <div class="row g-4">
      <div class="col-6 col-lg-3">
        <div class="heritage-box">
          <div class="heritage-icon"><i class="bi bi-clock-history"></i></div>
          <div>
            <div class="heritage-title">Since 1960</div>
            <p class="heritage-text">Over 6 decades of trust &amp; customer legacy</p>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="heritage-box">
          <div class="heritage-icon"><i class="bi bi-shield-check"></i></div>
          <div>
            <div class="heritage-title">Authorized Brands</div>
            <p class="heritage-text">100% Genuine with manufacturer warranty</p>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="heritage-box">
          <div class="heritage-icon"><i class="bi bi-stars"></i></div>
          <div>
            <div class="heritage-title">Huge Bridal Range</div>
            <p class="heritage-text">Wedding clutches, potlis &amp; festive purses</p>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="heritage-box">
          <div class="heritage-icon"><i class="bi bi-truck"></i></div>
          <div>
            <div class="heritage-title">Free Delivery</div>
            <p class="heritage-text">On orders above ₹1,999 across India</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="categories-section">
  <div class="container-xl-custom">
    <div class="section-header-heritage">
      <span class="section-label-heritage">Explore Our Offerings</span>
      <div class="section-title-wrap">
        <span class="title-line-heritage"></span>
        <h2 class="section-title-heritage">Featured Categories</h2>
        <span class="title-line-heritage"></span>
      </div>
      <p class="section-sub-heritage">Crafted for every journey, every milestone, and every stage of life.</p>
    </div>

    <div class="row g-4">
      
      <div class="col-12 col-sm-6 col-lg-3">
        <a href="<?php echo e(route('shop.index', ['category' => 'luggage'])); ?>" class="cat-card-heritage">
          <div class="cat-card-img">
            <img src="https://images.unsplash.com/photo-1565026057447-bc90a3dceb87?w=600&q=80&fit=crop" alt="Luggage &amp; Trolleys">
          </div>
          <div class="cat-card-body">
            <div>
              <h3 class="cat-card-title">Luggage &amp; Trolleys</h3>
              <p class="cat-card-sub">American Tourister, Safari, VIP, Samsonite, Swiss Military &amp; Delsey</p>
            </div>
            <span class="cat-card-link">Explore Trolleys &rarr;</span>
          </div>
        </a>
      </div>

      
      <div class="col-12 col-sm-6 col-lg-3">
        <a href="<?php echo e(route('shop.index', ['category' => 'ladies-handbags'])); ?>" class="cat-card-heritage">
          <div class="cat-card-img">
            <img src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=600&q=80&fit=crop" alt="Ladies Handbags">
          </div>
          <div class="cat-card-body">
            <div>
              <h3 class="cat-card-title">Ladies Handbags</h3>
              <p class="cat-card-sub">Aldo, Wrangler, Itti, Magnolia, Sequence, Logos &amp; Emily Loran</p>
            </div>
            <span class="cat-card-link">View Handbags &rarr;</span>
          </div>
        </a>
      </div>

      
      <div class="col-12 col-sm-6 col-lg-3">
        <a href="<?php echo e(route('shop.index', ['category' => 'school-bags'])); ?>" class="cat-card-heritage">
          <div class="cat-card-img">
            <img src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=600&q=80&fit=crop" alt="School Bags &amp; Backpacks">
          </div>
          <div class="cat-card-body">
            <div>
              <h3 class="cat-card-title">School Bags</h3>
              <p class="cat-card-sub">Safari, American Tourister, Genie, Kamiliant, Gear &amp; Swiss Military</p>
            </div>
            <span class="cat-card-link">Shop School Bags &rarr;</span>
          </div>
        </a>
      </div>

      
      <div class="col-12 col-sm-6 col-lg-3">
        <a href="<?php echo e(route('shop.index', ['category' => 'bridal-purse-collection'])); ?>" class="cat-card-heritage">
          <div class="cat-card-img">
            <img src="https://images.unsplash.com/photo-1566150905458-1bf1fc113f0d?w=600&q=80&fit=crop" alt="Bridal Purse Collection">
          </div>
          <div class="cat-card-body">
            <div>
              <h3 class="cat-card-title">Bridal Collection</h3>
              <p class="cat-card-sub">Handcrafted wedding clutches, royal zardozi potlis &amp; crystal evening purses</p>
            </div>
            <span class="cat-card-link">View Bridal Range &rarr;</span>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>


<section class="products-section" style="background:var(--dsh-cream);">
  <div class="container-xl-custom">
    <div class="section-header-heritage">
      <span class="section-label-heritage">Handpicked For You</span>
      <div class="section-title-wrap">
        <span class="title-line-heritage"></span>
        <h2 class="section-title-heritage">Featured Collection</h2>
        <span class="title-line-heritage"></span>
      </div>
      <p class="section-sub-heritage">Top-rated trolley sets, everyday designer carry bags, and wedding essentials</p>
    </div>

    <div class="row g-4">
      <?php $__empty_1 = true; $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <?php echo $__env->make('frontend.partials.product-card', ['product' => $product], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="col-12 text-center py-5">
        <p class="text-muted">No featured products currently available.</p>
      </div>
      <?php endif; ?>
    </div>

    <div class="text-center mt-5">
      <a href="<?php echo e(route('shop.index')); ?>" class="btn-glamora" style="padding:14px 40px;background:var(--dsh-navy);border-color:var(--dsh-navy);font-weight:700;">
        Explore All Products <i class="bi bi-arrow-right ms-2"></i>
      </a>
    </div>
  </div>
</section>


<section class="promo-split-heritage">
  <div class="promo-split-content">
    <div style="color:var(--dsh-gold); letter-spacing:3.5px; font-weight:800; font-size:0.8rem; margin-bottom:16px;">
      A LEGACY OF TRUST SINCE 1960
    </div>
    <h2 style="font-family:var(--font-serif); font-size:clamp(2.2rem, 3.8vw, 3.2rem); font-weight:700; line-height:1.2; margin-bottom:20px; color:#ffffff;">
      Your Journey Is Our Legacy.<br><span style="color:var(--dsh-gold);">Six Decades of Quality.</span>
    </h2>
    <p style="color:rgba(255,255,255,0.85); font-size:1.05rem; line-height:1.8; max-width:520px; margin-bottom:32px;">
      At Durable Suitcase House, we believe every journey deserves the right companion. Whether you’re preparing for a family vacation, sending your child to school, or choosing a dazzling bridal purse for a special wedding, we provide trusted products backed by genuine customer care.
    </p>
    <div>
      <a href="<?php echo e(route('page.show', 'about')); ?>" class="hero-btn-pill" style="background:var(--dsh-gold); border-color:var(--dsh-gold); color:var(--dsh-navy-dark); font-weight:700; padding:14px 34px;">
        Read Our Story <i class="bi bi-arrow-right ms-2"></i>
      </a>
    </div>
  </div>
  <div class="promo-split-image">
    <img src="https://images.unsplash.com/photo-1581553680321-4fffae59fccd?w=1000&q=80&fit=crop" alt="Durable Suitcase House Heritage">
  </div>
</section>


<section class="brands-section">
  <div class="container-xl-custom">
    <div class="text-center mb-4">
      <span class="section-label-heritage">Authorized Dealer &amp; Retailer</span>
      <h3 style="font-family:var(--font-serif); font-size:2rem; font-weight:700; color:var(--dsh-navy); margin-bottom:8px;">
        Official Partner Brands
      </h3>
      <p style="font-size:0.92rem; color:var(--dsh-text-muted);">We deal exclusively in trusted, genuine brands with manufacturer warranties</p>
    </div>

    <div class="row g-3 justify-content-center">
      <?php $__currentLoopData = ['American Tourister', 'Safari', 'VIP', 'Samsonite', 'Kamiliant', 'Swiss Military', 'Tommy Hilfiger', 'Delsey Paris', 'Aldo', 'Wrangler', 'Genie', 'Aristocrat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brandName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <a href="<?php echo e(route('shop.index', ['brand' => \Illuminate\Support\Str::slug($brandName)])); ?>" class="brand-pill">
          <?php echo e($brandName); ?>

        </a>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>


<section class="products-section">
  <div class="container-xl-custom">
    <div class="section-header-heritage">
      <span class="section-label-heritage">Fresh In Store</span>
      <div class="section-title-wrap">
        <span class="title-line-heritage"></span>
        <h2 class="section-title-heritage">New Arrivals</h2>
        <span class="title-line-heritage"></span>
      </div>
      <p class="section-sub-heritage">Latest suitcase models, school collections, and party purse releases</p>
    </div>

    <div class="row g-4">
      <?php $__empty_1 = true; $__currentLoopData = $newArrivals->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <?php echo $__env->make('frontend.partials.product-card', ['product' => $product], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="col-12 text-center py-5">
        <p class="text-muted">No new arrivals to display.</p>
      </div>
      <?php endif; ?>
    </div>

    <div class="text-center mt-5">
      <a href="<?php echo e(route('shop.index', ['new_arrival' => 1])); ?>" class="btn-glamora" style="padding:14px 40px;background:var(--dsh-navy);border-color:var(--dsh-navy);">
        View All New Arrivals
      </a>
    </div>
  </div>
</section>


<section style="padding:70px 0; background:var(--dsh-cream);">
  <div class="container-xl-custom">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <span class="section-label-heritage">Visit In Person</span>
        <h2 style="font-family:var(--font-serif); font-size:2.4rem; font-weight:700; color:var(--dsh-navy); margin-bottom:18px;">
          Experience Generations of Trust in Patiala
        </h2>
        <p style="color:var(--dsh-charcoal); font-size:1.05rem; line-height:1.75; margin-bottom:24px;">
          Located in the heart of Dharampura Bazar near Anardana Chowk, our store welcomes you with an extensive display of suitcases, school bags, fashion handbags, and our renowned bridal purse collection.
        </p>
        <div style="background:#fff; border:1px solid var(--dsh-cream-dark); border-radius:10px; padding:24px; margin-bottom:28px;">
          <div class="d-flex align-items-center gap-3 mb-3">
            <i class="bi bi-geo-alt-fill" style="font-size:1.4rem; color:var(--dsh-gold-dark);"></i>
            <div>
              <strong style="color:var(--dsh-navy);">Store Address:</strong><br>
              Near Anardana Chowk, Dharampura Bazar, Patiala, Punjab - 147001
            </div>
          </div>
          <div class="d-flex align-items-center gap-3 mb-3">
            <i class="bi bi-telephone-fill" style="font-size:1.4rem; color:var(--dsh-gold-dark);"></i>
            <div>
              <strong style="color:var(--dsh-navy);">Phone Enquiries:</strong><br>
              9914469211 &bull; 9814041822 &bull; 9914141822
            </div>
          </div>
          <div class="d-flex align-items-center gap-3">
            <i class="bi bi-whatsapp" style="font-size:1.4rem; color:#25D366;"></i>
            <div>
              <strong style="color:var(--dsh-navy);">WhatsApp Assistance:</strong><br>
              +91 9914469211 (Quick inquiries &amp; product photos)
            </div>
          </div>
        </div>
        <div class="d-flex gap-3 flex-wrap">
          <a href="https://wa.me/919914469211" target="_blank" class="hero-btn-pill" style="background:#25D366; border-color:#25D366;">
            <i class="bi bi-whatsapp me-1"></i> WhatsApp Us Now
          </a>
          <a href="<?php echo e(route('contact.index')); ?>" class="hero-btn-outline-pill">
            Get Directions
          </a>
        </div>
      </div>
      <div class="col-lg-6">
        <div style="border-radius:14px; overflow:hidden; border:2px solid var(--dsh-cream-dark); box-shadow:0 12px 32px rgba(20,45,78,0.1);">
          <img src="https://images.unsplash.com/photo-1544816155-12df9643f363?w=800&q=80&fit=crop" alt="Durable Suitcase House Storefront" style="width:100%; height:auto; display:block;">
        </div>
      </div>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
new Swiper('.heroSwiper', {
  loop: true,
  speed: 800,
  autoplay: { delay: 5000, disableOnInteraction: false },
  pagination: { el: '.hero-pagination', clickable: true },
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\durableattachi\resources\views/frontend/home/index.blade.php ENDPATH**/ ?>