<?php $__env->startSection('title', \App\Models\Setting::get('site_name', 'Ayurnaman') . ' — Authentic Ayurvedic Wellness'); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* ============================================
   HERO SLIDER - FULL WIDTH, SHORT HEIGHT, LEFT TEXT
   ============================================ */
.hero-slider {
  width: 100%;
  position: relative;
  overflow: hidden;
  background: #dfece3;
}
.hero-slider .swiper,
.hero-slider .swiper-wrapper {
  width: 100%;
  height: auto;
}
.hero-slide {
  width: 100%;
  aspect-ratio: 1774 / 887;
  min-height: 520px;
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
  display: none !important;
}
.hero-slide-container {
  width: 100%;
  max-width: 100%;
  margin: 0;
  padding: 0 40px;
  position: relative;
  z-index: 2;
}
.hero-slide-content {
  max-width: 760px; /* Wider content zone to bring text right up to product bottles */
  text-align: left;
}
.hero-slide-label {
  font-size: 0.88rem; /* Bigger overline */
  letter-spacing: 4px;
  font-weight: 800;
  text-transform: uppercase;
  color: #1b382b;
  margin-bottom: 18px;
  display: inline-flex;
  align-items: center;
  gap: 14px;
}
.hero-slide-label::before {
  content: '';
  display: inline-block;
  width: 40px;
  height: 3px;
  background: #2e5a44;
}
.hero-title {
  font-family: var(--font-serif);
  font-size: clamp(3rem, 5vw, 4.6rem); /* Substantially bigger & impactful */
  font-weight: 700;
  color: #0b1a13;
  line-height: 1.1;
  margin-bottom: 22px;
  letter-spacing: -0.5px;
  text-shadow: 0 1px 3px rgba(255,255,255,0.9);
}
.hero-title em {
  font-style: italic;
  font-weight: 600;
  color: #1b382b;
}
.hero-desc {
  font-size: 1.2rem; /* Noticeably bigger and highly readable */
  font-weight: 450;
  color: #24332b;
  max-width: 600px;
  margin-bottom: 34px;
  line-height: 1.7;
}
.hero-btn-pill {
  background: var(--ayur-green-dark);
  color: #fff;
  border: 2px solid var(--ayur-green-dark);
  padding: 14px 36px;
  font-size: 0.95rem;
  font-weight: 600;
  letter-spacing: 1px;
  border-radius: 35px;
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  text-decoration: none;
}
.hero-btn-pill:hover {
  background: var(--ayur-green);
  border-color: var(--ayur-green);
  color: #fff;
  transform: translateY(-2px);
  box-shadow: 0 8px 22px rgba(27,56,43,0.25);
}
.hero-btn-outline-pill {
  background: transparent;
  color: var(--ayur-green-dark);
  border: 2px solid var(--ayur-green-dark);
  padding: 14px 34px;
  font-size: 0.95rem;
  font-weight: 600;
  letter-spacing: 1px;
  border-radius: 35px;
  transition: all 0.25s ease;
  display: inline-flex;
  align-items: center;
  gap: 10px;
  text-decoration: none;
}
.hero-btn-outline-pill:hover {
  background: var(--ayur-green-dark);
  color: #fff;
}
@media (max-width: 991px) {
  .hero-slide { 
    min-height: 480px; 
    aspect-ratio: auto; 
    height: auto; 
    padding: 40px 0;
    background-position: center right; 
    background-size: cover;
    position: relative;
  }
  .hero-slide::before {
    display: none !important;
  }
  .hero-slide-container { 
    padding: 0 20px; 
    position: relative;
    z-index: 2;
  }
  .hero-slide-content { 
    max-width: 100%; 
  }
  .hero-slide-label {
    font-size: 0.72rem;
    letter-spacing: 2px;
    margin-bottom: 12px;
  }
  .hero-slide-label::before {
    width: 24px;
    height: 2px;
  }
  .hero-title {
    font-size: clamp(2rem, 6vw, 2.8rem);
    line-height: 1.15;
    margin-bottom: 14px;
  }
  .hero-desc {
    font-size: 0.92rem;
    line-height: 1.55;
    max-width: 100%;
    margin-bottom: 22px;
  }
  .hero-btn-pill, .hero-btn-outline-pill {
    padding: 10px 22px;
    font-size: 0.84rem;
  }
}
@media (max-width: 575px) {
  .hero-slide { 
    min-height: 380px;
    height: auto;
    aspect-ratio: 750 / 800;
    padding: 0;
    align-items: flex-start !important;
    background-image: url('<?php echo e(asset('images/phone resonsive  (750 x 800 px).webp')); ?>') !important;
    background-position: center center !important;
    background-size: cover !important;
  }
  .hero-slide::before {
    display: none !important;
  }
  .hero-slide-container {
    padding: 24px 16px 0;
    width: 100%;
  }
  .hero-title { 
    font-family: var(--font-sans) !important;
    font-size: clamp(1.15rem, 5vw, 1.55rem);
    font-weight: 800 !important;
    color: #0b1a13 !important;
    white-space: nowrap !important;
    line-height: 1.2;
    margin-bottom: 6px;
    letter-spacing: -0.3px;
  }
  .hero-title br {
    display: none !important;
  }
  .hero-title em {
    font-family: var(--font-sans) !important;
    font-weight: 800 !important;
    font-style: normal !important;
    margin-left: 4px;
  }
  .hero-desc { 
    font-size: 0.88rem; 
    font-weight: 500;
    line-height: 1.4;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .hero-slide-label {
    font-size: 0.65rem;
    font-weight: 800;
    letter-spacing: 1.5px;
    margin-bottom: 4px;
  }
  .hero-btns-wrap {
    display: flex !important;
    flex-direction: row !important;
    flex-wrap: nowrap !important;
    justify-content: center !important;
    align-items: center !important;
    gap: 8px !important;
    width: 100% !important;
  }
  .hero-btn-pill, .hero-btn-outline-pill {
    padding: 8px 16px !important;
    font-size: 0.78rem !important;
    font-weight: 700 !important;
    white-space: nowrap !important;
    letter-spacing: 0.2px !important;
    flex: 0 1 auto !important;
    text-align: center !important;
  }
  .hero-slide-content {
    text-align: center;
    padding: 43px 24px !important;
  }
  .hero-slide-label {
    justify-content: center;
  }
}
  border: 6px solid #fff;
  box-shadow: 0 10px 40px rgba(0,0,0,0.15);
  z-index: 2;
}

/* Swiper overrides */
.hero-pagination { position: absolute; bottom: 32px; left: 60px; z-index: 10; }
.hero-pagination .swiper-pagination-bullet {
  width: 24px; height: 3px; border-radius: 0; background: var(--text-muted); opacity: 0.5;
}
.hero-pagination .swiper-pagination-bullet-active { background: var(--pd-blue); opacity: 1; width: 40px; }

.hero-arrows .swiper-button-next,
.hero-arrows .swiper-button-prev {
  width: 48px; height: 48px;
  background: rgba(255,255,255,0.9);
  color: var(--dark);
  border-radius: 0;
  margin-top: 0;
  top: auto;
  bottom: 20px;
}
.hero-arrows .swiper-button-next::after,
.hero-arrows .swiper-button-prev::after { font-size: 0.9rem; font-weight: 700; }
.hero-arrows .swiper-button-next { right: 40px; }
.hero-arrows .swiper-button-prev { right: 100px; left: auto; }

/* ============================================
   CATEGORY CIRCLES
   ============================================ */
.categories-section {
  padding: 64px 0 72px;
  background: #ffffff !important; /* Pure white background */
}

/* ── Section heading – matches screenshot typography & center borders ── */
.cat-section-header {
  text-align: center;
  margin-bottom: 44px;
}
.cat-section-label {
  display: block;
  font-size: 0.8rem;
  font-weight: 800; /* Sub heading bold */
  letter-spacing: 3.5px;
  text-transform: uppercase;
  color: #c6956a;
  margin-bottom: 12px;
}
.cat-section-title-wrap {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
}
.cat-title-line {
  display: inline-block;
  width: 50px;
  height: 1.5px;
  background: #c6956a;
  opacity: 0.7;
}
.cat-section-title {
  font-family: var(--font-serif);
  font-size: clamp(2.2rem, 4vw, 3rem);
  font-weight: 700; /* Heading bold, non-italic */
  color: #1b382b;   /* Deep herbal green tone */
  font-style: normal !important;
  line-height: 1.15;
  margin: 0;
  letter-spacing: -0.5px;
}

/* ── Slide wrapper ── */
.cat-slide {
  display: flex;
  justify-content: center;
}

/* ── Category item ── */
.cat-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-decoration: none;
  cursor: pointer;
  gap: 14px;
}

/* ── Circle image (Bigger circle, no border) ── */
.cat-img-wrap {
  width: 190px;  /* Bigger circle */
  height: 190px;
  border-radius: 50%;
  overflow: hidden;
  background: transparent;
  border: none !important; /* No border */
  box-shadow: 0 8px 24px rgba(0,0,0,0.06);
  transition: transform 0.35s ease, box-shadow 0.35s ease;
  flex-shrink: 0;
}
.cat-img-wrap img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
  display: block;
}
.cat-item:hover .cat-img-wrap {
  transform: translateY(-5px) scale(1.03);
  box-shadow: 0 14px 32px rgba(0,0,0,0.12);
}

/* ── Label ── */
.cat-label {
  font-family: var(--font-sans);
  font-size: 0.76rem;
  font-weight: 700; /* Bold label */
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #1e2220;
  text-align: center;
  line-height: 1.3;
  transition: color 0.2s;
}
.cat-item:hover .cat-label { color: var(--ayur-green); }

/* ── Swiper overrides ── */
.categorySwiper {
  padding: 8px 0 16px !important;
  overflow: hidden !important;
}
.categorySwiper .swiper-slide {
  height: auto;
}

/* responsive circle sizes */
@media (max-width: 991px) {
  .cat-img-wrap { width: 160px; height: 160px; }
  .cat-title-line { width: 35px; }
}
@media (max-width: 767px) {
  .cat-img-wrap { width: 140px; height: 140px; }
  .cat-section-title { font-size: 1.9rem; }
  .cat-title-line { width: 25px; }
}
@media (max-width: 480px) {
  .cat-img-wrap { width: 125px; height: 125px; }
}

/* ============================================
   FEATURED PRODUCTS
   ============================================ */
.products-section { padding: 70px 0 85px; }
.featured-collection-section { 
  background: #ECEABD !important; /* Specific #ECEABD background */
}
.featured-header {
  text-align: center;
  margin-bottom: 38px;
}
.featured-label {
  display: block;
  font-size: 0.84rem;
  font-weight: 800; /* Bold sub heading */
  letter-spacing: 3.5px;
  text-transform: uppercase;
  color: #7b5936; /* Warm rich terracotta */
  margin-bottom: 12px;
}
.featured-title-wrap {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 24px;
}
.featured-title-line {
  display: inline-block;
  width: 55px;
  height: 2px;
  background: #7b5936;
  opacity: 0.75;
}
.featured-title {
  font-family: var(--font-serif);
  font-size: clamp(2.4rem, 4.2vw, 3.4rem);
  font-weight: 700 !important; /* Bold heading */
  font-style: normal !important; /* No italics */
  color: #12281e; /* Deep dark botanical tone with high contrast */
  line-height: 1.15;
  margin: 0;
  letter-spacing: -0.5px;
  white-space: nowrap !important;
}

/* Headings on 1 line across all viewports */
.section-title,
.cat-section-title {
  white-space: nowrap !important;
}
.featured-title-wrap,
.cat-section-title-wrap {
  flex-wrap: nowrap !important;
}
@media (max-width: 768px) {
  .featured-title,
  .section-title,
  .cat-section-title {
    font-size: 30px !important;
  }
  .featured-title-wrap {
    gap: 12px !important;
  }
  .featured-title-line {
    width: 25px !important;
  }
}
@media (max-width: 480px) {
  .featured-title,
  .section-title,
  .cat-section-title {
    font-size: 30px !important;
  }
  .featured-title-wrap {
    gap: 8px !important;
  }
  .featured-title-line {
    width: 16px !important;
  }
}
.featured-subtitle {
  font-size: 1.05rem;
  font-weight: 500;
  color: #2e3a33; /* High readability */
  max-width: 580px;
  margin: 14px auto 0;
  line-height: 1.6;
}

/* Category & Filter Pill Tabs on #ECEABD */
.tab-pills-wrap {
  display: flex;
  justify-content: center;
  gap: 12px;
  flex-wrap: wrap;
  margin-bottom: 40px;
}
.tab-pill {
  background: #fff;
  border: 1.5px solid #dcd9a6;
  padding: 10px 24px;
  font-size: 0.82rem;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: #1b382b;
  cursor: pointer;
  transition: all 0.25s ease;
  border-radius: 30px; /* Pill shape */
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.tab-pill:hover {
  background: #f7f6e4;
  border-color: #1b382b;
  color: #1b382b;
}
.tab-pill.active {
  background: #1B382B !important;
  border-color: #1B382B !important;
  color: #fff !important;
  box-shadow: 0 4px 14px rgba(27,56,43,0.25);
}

/* Product Grid Swiper */
.products-swiper .swiper-slide { height: auto; }

/* ============================================
   PROMO BANNER (brown section like screenshot)
   ============================================ */
.promo-split {
  display: grid;
  grid-template-columns: 1fr 1fr;
  min-height: 520px;
}
.promo-split-content {
  background: #1B382B;
  padding: 80px 80px 80px 100px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  color: #fff;
}
@media (max-width: 991px) {
  .promo-split {
    grid-template-columns: 1fr;
  }
  .promo-split-content {
    padding: 60px 30px;
  }
}
@media (max-width: 768px) {
  .promo-split-content {
    padding: 44px 20px;
    align-items: center;
    text-align: center;
  }
  .promo-split-title {
    font-size: 30px !important;
    white-space: nowrap !important;
    text-align: center !important;
    margin-bottom: 14px !important;
  }
  .promo-split-title br {
    display: none !important;
  }
  .promo-split-title span {
    display: inline !important;
    margin-left: 6px;
  }
  .promo-split-label {
    text-align: center;
    margin-bottom: 12px;
  }
  .promo-split-desc {
    font-size: 0.85rem !important;
    line-height: 1.6 !important;
    color: rgba(255,255,255,0.8) !important;
    text-align: center;
    max-width: 320px !important;
    margin: 0 auto 24px auto !important;
  }
}
@media (max-width: 480px) {
  .promo-split-content {
    padding: 36px 16px;
  }
  .promo-split-title {
    font-size: clamp(1.2rem, 5vw, 30px) !important;
  }
  .promo-split-desc {
    font-size: 0.82rem !important;
    line-height: 1.55 !important;
    max-width: 300px !important;
    margin: 0 auto 20px auto !important;
  }
}
.promo-split-label {
  font-size: 0.65rem;
  letter-spacing: 4px;
  text-transform: uppercase;
  color: var(--gold-light);
  margin-bottom: 16px;
}
.promo-split-title {
  font-family: var(--font-serif);
  font-size: 2.8rem;
  font-weight: 400;
  line-height: 1.2;
  margin-bottom: 16px;
  color:var(--bs-light);
}
.promo-split-desc { font-size: 0.9rem; opacity: 0.75; margin-bottom: 32px; max-width: 340px; }
.promo-split-image { position: relative; overflow: hidden; }
.promo-split-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s; }
.promo-split:hover .promo-split-image img { transform: scale(1.03); }

/* ============================================
   MINI BANNERS
   ============================================ */
.mini-banners { padding: 60px 0; }
.mini-banner {
  position: relative;
  overflow: hidden;
  aspect-ratio: 4/3;
  cursor: pointer;
}
.mini-banner img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
.mini-banner:hover img { transform: scale(1.05); }
.mini-banner-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0,0,0,0.5) 0%, transparent 60%);
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  padding: 24px;
}
.mini-banner-label { font-size: 0.65rem; letter-spacing: 2px; text-transform: uppercase; color: var(--gold-light); margin-bottom: 4px; }
.mini-banner-title { font-family: var(--font-serif); font-size: 1.4rem; color: #fff; font-weight: 400; }
.mini-banner-btn {
  display: inline-block;
  margin-top: 10px;
  font-size: 0.7rem;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  font-weight: 600;
  color: #fff;
  border-bottom: 1px solid rgba(255,255,255,0.5);
  padding-bottom: 1px;
  transition: border-color 0.2s, color 0.2s;
}
.mini-banner:hover .mini-banner-btn { color: var(--pd-blue); border-color: var(--pd-blue); }

/* ============================================
   TESTIMONIALS
   ============================================ */
.testimonials-section { padding: 80px 0; background: #ffffff !important; }
.testimonial-card {
  background: #fbfaf5;
  padding: 36px 32px;
  border-top: 3px solid var(--ayur-gold);
  border-radius: 8px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.04);
  text-align: center;
}
.testimonial-text { font-family: var(--font-serif); font-size: 1.1rem; font-style: italic; color: var(--text); line-height: 1.7; margin-bottom: 20px; }
.testimonial-avatar { width: 52px; height: 52px; border-radius: 50%; object-fit: cover; margin: 0 auto 10px; }
.testimonial-name { font-weight: 600; font-size: 0.85rem; color: var(--dark); }
.testimonial-role { font-size: 0.72rem; color: var(--text-muted); }

.instagram-gallery-section {
  padding: 80px 0;
  background: #fff;
}
@media (max-width: 768px) {
  .testimonials-section {
    padding: 35px 0 15px 0 !important;
  }
  .testimonials-section .section-header {
    margin-bottom: 24px !important;
  }
  .instagram-gallery-section {
    padding: 15px 0 35px 0 !important;
  }
  .instagram-gallery-section .section-header {
    margin-bottom: 24px !important;
  }
}

/* ============================================
   PHOTO GALLERY (grid)
   ============================================ */
.gallery-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
  align-items: stretch;
}
.gallery-item {
  overflow: hidden;
  position: relative;
  display: block;
  text-decoration: none;
  border-radius: 8px;
  background: #f8f9fa;
  box-shadow: 0 4px 15px rgba(0,0,0,0.05);
  aspect-ratio: 1 / 1;
  width: 100%;
}
.gallery-item:first-child {
  grid-row: span 2;
  aspect-ratio: auto;
  min-height: 100%;
  overflow: hidden;
  background: #000;
  border-radius: 8px;
}
.gallery-item-embed {
  width: 100%;
  height: 100%;
  position: relative;
  overflow: hidden;
  background: #000;
}
.gallery-item-embed iframe {
  width: 100% !important;
  height: 100% !important;
  border: 0 !important;
  display: block;
}
/* First spot: tall 9:16 reel spanning 2 rows */
.gallery-item:first-child .gallery-item-embed iframe {
  width: 140% !important;
  height: calc(100% + 140px) !important;
  min-height: 100% !important;
  margin-top: -65px !important;
  margin-left: -20% !important;
}

/* Spot 2: Reel (Ayurnaman Diabs Capsule) */
.gallery-item:nth-child(2) .gallery-item-embed iframe {
  width: 140% !important;
  height: calc(100% + 220px) !important;
  margin-top: -190px !important;
  margin-left: -20% !important;
}

.gallery-item-embed-overlay {
  position: absolute;
  inset: 0;
  background: rgba(27, 56, 43, 0.55);
  opacity: 0;
  transition: opacity 0.3s ease;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 8px;
  text-decoration: none;
  z-index: 10;
  cursor: pointer;
}
.gallery-item:hover .gallery-item-embed-overlay {
  opacity: 1 !important;
}
.gallery-item-embed-overlay i {
  color: #fff;
  font-size: 2rem;
  filter: drop-shadow(0 2px 8px rgba(0,0,0,0.4));
}
.gallery-item-embed-overlay span {
  color: #fff;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
}
.gallery-item video {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}
.gallery-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.5s ease;
}
.gallery-item:hover img {
  transform: scale(1.05);
}
.gallery-item-overlay {
  position: absolute;
  inset: 0;
  background: rgba(27, 56, 43, 0.45);
  opacity: 0;
  transition: opacity 0.3s ease;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 8px;
}
.gallery-item:hover .gallery-item-overlay {
  opacity: 1;
}
.gallery-item-overlay i {
  color: #fff;
  font-size: 2rem;
  filter: drop-shadow(0 2px 8px rgba(0,0,0,0.4));
}
.gallery-item-overlay span {
  color: #fff;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
}
@media (max-width: 991px) {
  .gallery-grid {
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: auto;
  }
  .gallery-item:first-child {
    grid-row: span 1;
    min-height: 480px;
  }
}
@media (max-width: 768px) {
  .gallery-grid {
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: auto;
  }
}
@media (max-width: 576px) {
  .gallery-grid {
    grid-template-columns: 1fr !important;
    gap: 18px !important;
    max-width: 330px;
    margin: 0 auto;
  }
  .gallery-item {
    aspect-ratio: 1 / 1 !important;
    width: 100% !important;
  }
  .gallery-item:first-child {
    aspect-ratio: 9 / 16 !important;
    min-height: 520px !important;
  }
  .gallery-item:nth-child(2) {
    aspect-ratio: 1 / 1 !important;
  }
  .gallery-item:nth-child(2) .gallery-item-embed iframe {
    width: 130% !important;
    height: 100% !important;
    min-height: 100% !important;
    margin-top: -60px !important;
    margin-left: -15% !important;
  }
}

/* ============================================
   BLOG SECTION
   ============================================ */
.blog-section { padding: 80px 0; background: #fff; }
.blog-card { border: none; border-radius: 0; overflow: hidden; }
.blog-card-img { aspect-ratio: 16/10; overflow: hidden; }
.blog-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
.blog-card:hover .blog-card-img img { transform: scale(1.05); }
.blog-card-body { padding: 20px 0; }
.blog-cat { font-size: 0.65rem; letter-spacing: 2px; text-transform: uppercase; color: var(--pd-blue); margin-bottom: 8px; }
.blog-title { font-family: var(--font-serif); font-size: 1.3rem; font-weight: 400; color: var(--dark); line-height: 1.3; margin-bottom: 8px; }
.blog-title:hover { color: var(--pd-blue); }
.blog-date { font-size: 0.75rem; color: var(--text-muted); }

/* ============================================
   BRANDS MARQUEE
   ============================================ */
.brands-marquee { padding: 40px 0; border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); overflow: hidden; }
.marquee-track {
  display: flex;
  gap: 60px;
  animation: marqueeScroll 25s linear infinite;
  width: max-content;
}
@keyframes marqueeScroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }
.marquee-item { font-family: var(--font-serif); font-size: 1.4rem; color: var(--bs-black); font-weight: 500; white-space: nowrap; letter-spacing: 2px; }

/* ============================================
   TRUST BADGES / FEATURES SECTION
   ============================================ */
.trust-badges-section {
  padding: 60px 0;
  border-bottom: 1px solid var(--border);
  background: #fff;
}
.trust-badge-card {
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  transition: transform 0.3s ease;
}
.trust-badge-card:hover {
  transform: translateY(-3px);
}
.trust-badge-icon {
  font-size: 2.2rem;
  color: var(--ayur-green);
  display: block;
  margin-bottom: 12px;
  line-height: 1;
}
.trust-badge-title {
  font-family: var(--font-sans);
  font-size: 1rem;
  font-weight: 700;
  color: var(--ayur-green-dark);
  margin-bottom: 6px;
}
.trust-badge-desc {
  font-size: 0.84rem;
  line-height: 1.45;
  color: var(--text-muted);
  margin-bottom: 0;
}

@media (max-width: 576px) {
  .trust-badges-section {
    padding: 36px 12px;
    background: #fbfdfc;
  }
  .trust-badges-grid {
    --bs-gutter-x: 10px;
    --bs-gutter-y: 12px;
  }
  .trust-badge-col {
    padding-left: 5px !important;
    padding-right: 5px !important;
  }
  .trust-badge-card {
    background: rgba(255, 255, 255, 0.75);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border: 1px solid rgba(27, 56, 43, 0.12);
    border-radius: 12px;
    padding: 18px 10px 16px !important;
    box-shadow: 0 4px 14px rgba(27, 56, 43, 0.04);
    min-height: 165px;
  }
  .trust-badge-icon {
    font-size: 1.85rem;
    margin-bottom: 8px;
    filter: drop-shadow(0 2px 4px rgba(45, 90, 39, 0.15));
  }
  .trust-badge-title {
    font-size: 0.84rem;
    line-height: 1.25;
    margin-bottom: 6px;
    font-weight: 700;
    min-height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
  }
  .trust-badge-desc {
    font-size: 0.72rem;
    line-height: 1.35;
    color: #66756e;
    text-align: center;
  }
}

/* ============================================
   RESPONSIVE
   ============================================ */
@media (max-width: 992px) {
  .hero-slide { grid-template-columns: 1fr; }
  .hero-slide-images { display: none; }
  .hero-slide-content { padding: 60px 24px; text-align: center; align-items: center; }
  .hero-slide-label::before { display: none; }
  .hero-discount-badge { top: 20px; right: 20px; width: 80px; height: 80px; }
  .promo-split { grid-template-columns: 1fr; }
}
@media (max-width: 768px) {
  .hero-slider { height: auto; min-height: 0; }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<section class="hero-slider">
  <div class="swiper heroSwiper" style="height:100%; width:100%;">
    <div class="swiper-wrapper">
      <?php $__empty_1 = true; $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="swiper-slide">
        <div class="hero-slide" style="background-image: url('<?php echo e($slider->image_url); ?>');">
          <div class="hero-slide-container">
            <div class="hero-slide-content" data-aos="fade-right">
              <?php if($slider->subtitle): ?>
                <div class="hero-slide-label"><?php echo e($slider->subtitle); ?></div>
              <?php endif; ?>
              <h1 class="hero-title"><?php echo $slider->title; ?></h1>
              <?php if($slider->description): ?>
                <p class="hero-desc"><?php echo e($slider->description); ?></p>
              <?php endif; ?>
              <div class="d-flex gap-3 flex-wrap align-items-center hero-btns-wrap">
                <a href="<?php echo e($slider->button_link ?: route('shop.index')); ?>" class="hero-btn-pill">
                  <?php echo e($slider->button_text ?: 'Shop Now'); ?> <i class="bi bi-arrow-right"></i>
                </a>
                <a href="<?php echo e(route('shop.index')); ?>" class="hero-btn-outline-pill">
                  Explore Collections
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <div class="swiper-slide">
        <div class="hero-slide" style="background-image: url('<?php echo e(asset('uploads/sliders/face.webp')); ?>');">
          <div class="hero-slide-container">
            <div class="hero-slide-content" data-aos="fade-right">
              <div class="hero-slide-label">Pure Ayurveda For A Healthier You</div>
              <h1 class="hero-title">Nature's Healing<br><em>For Modern Life</em></h1>
              <p class="hero-desc">Ayurvedic wellness, eye care, skin care and daily health support — naturally crafted with pure herbal actives.</p>
              <div class="d-flex gap-3 flex-wrap align-items-center hero-btns-wrap">
                <a href="<?php echo e(route('shop.index')); ?>" class="hero-btn-pill">Shop Now <i class="bi bi-arrow-right"></i></a>
                <a href="<?php echo e(route('shop.index')); ?>" class="hero-btn-outline-pill">Explore Collections</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
    <?php if(count($sliders) > 1): ?>
      <div class="hero-arrows">
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
      <div class="swiper-pagination hero-pagination"></div>
    <?php endif; ?>
  </div>
</section>


<section class="categories-section">
  <div class="container-xl-custom">

    
    <div class="cat-section-header" data-aos="fade-up">
      <span class="cat-section-label">Explore Our Range</span>
      <div class="cat-section-title-wrap">
        <span class="cat-title-line"></span>
        <h2 class="cat-section-title">Shop by Collection</h2>
        <span class="cat-title-line"></span>
      </div>
    </div>

    
    <div class="swiper categorySwiper" data-aos="fade-up" data-aos-delay="100">
      <div class="swiper-wrapper">

        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="swiper-slide cat-slide">
          <a href="<?php echo e(route('shop.category', $cat->slug)); ?>" class="cat-item">
            <div class="cat-img-wrap">
              <img
                src="<?php echo e($cat->image_url); ?>"
                alt="<?php echo e($cat->name); ?>"
                loading="lazy">
            </div>
            <span class="cat-label"><?php echo e(strtoupper($cat->name)); ?></span>
            <?php if(isset($cat->products_count) && $cat->products_count > 0): ?>
              <span class="text-muted d-block" style="font-size:0.75rem;"><?php echo e($cat->products_count); ?> <?php echo e(Str::plural('Product', $cat->products_count)); ?></span>
            <?php endif; ?>
          </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 text-center py-4">
          <p class="text-muted">No collections available yet.</p>
        </div>
        <?php endif; ?>

      </div>
    </div>

  </div>
</section>


<section class="products-section featured-collection-section">
  <div class="container-xl-custom">
    <div class="featured-header" data-aos="fade-up">
      <span class="featured-label">Handpicked for You</span>
      <div class="featured-title-wrap">
        <span class="featured-title-line"></span>
        <h2 class="featured-title">Featured Collection</h2>
        <span class="featured-title-line"></span>
      </div>
      <p class="featured-subtitle">Ayurvedic bestsellers for your everyday wellness and self-care</p>
    </div>

    <div class="row g-4" data-aos="fade-up" id="featured-grid">
      <?php $__empty_1 = true; $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <?php echo $__env->make('frontend.partials.product-card', ['product' => $product], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <?php
        $placeholderImgs = [
          'https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=400&q=80&fit=crop',
          'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=400&q=80&fit=crop',
          'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=400&q=80&fit=crop',
          'https://images.unsplash.com/photo-1611652022419-a9419f74343d?w=400&q=80&fit=crop',
        ];
      ?>
      <?php for($i=1; $i<=4; $i++): ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="product-card">
          <div class="product-card-img">
            <img src="<?php echo e($placeholderImgs[$i-1]); ?>" alt="Jewelry Piece" loading="lazy" style="width:100%;height:100%;object-fit:cover;">
          </div>
          <div class="product-card-body">
            <div class="product-card-cat">Featured</div>
            <div class="product-card-name">Diamond Jewelry Piece</div>
            <div class="product-card-price"><span class="price-current">₨5,999</span></div>
          </div>
        </div>
      </div>
      <?php endfor; ?>
      <?php endif; ?>
    </div>

    <div class="text-center mt-5" data-aos="fade-up">
      <a href="<?php echo e(route('shop.index')); ?>" class="btn-outline-glamora" style="padding:14px 40px;">View All Products</a>
    </div>
  </div>
</section>


<section class="promo-split" data-aos="fade-in" style="background:#1B382B;">
  <div class="promo-split-content" style="background:#1B382B;">
    <div class="promo-split-label" data-aos="fade-right" data-aos-delay="100" style="color:var(--ayur-gold); letter-spacing:3.5px; font-weight:800; font-size:0.8rem; margin-bottom:18px;">THE AYURNAMAN PROMISE</div>
    <h2 class="promo-split-title" data-aos="fade-right" data-aos-delay="150" style="color:#ffffff; font-family:var(--font-serif); font-size:clamp(2.4rem, 4vw, 3.6rem); font-weight:700; font-style:normal; line-height:1.2; letter-spacing:-0.5px; margin-bottom:20px;">Pure Herbs, Real Care.<br><span style="color:var(--ayur-gold); font-weight:700; font-style:normal;">Complete Wellness.</span></h2>
    <p class="promo-split-desc" data-aos="fade-right" data-aos-delay="200" style="color:rgba(255,255,255,0.92); font-size:1.05rem; font-weight:400; max-width:520px; line-height:1.8; margin-bottom:34px;">Harness the power of authentic Ayurveda with herbal, effective, and safe formulations designed for your everyday vitality and healthy self-care ritual.</p>
    <div data-aos="fade-right" data-aos-delay="250">
      <a href="<?php echo e(route('page.show', 'about')); ?>" class="hero-btn-pill" style="background:var(--ayur-gold); border-color:var(--ayur-gold); color:#1B382B; font-weight:700; padding:14px 34px; font-size:0.92rem;">Explore Our Story <i class="bi bi-arrow-right ms-2"></i></a>
    </div>
  </div>
  <div class="promo-split-image" style="background:#142A20; padding:0;">
    <img src="<?php echo e(asset('images/products/f1.webp')); ?>" alt="Ayurnaman Ayurvedic Formulation" style="width:100%; height:100%; object-fit:cover; display:block;">
  </div>
</section>


<section class="products-section">
  <div class="container-xl-custom">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Just Arrived</span>
      <h2 class="section-title">New Arrivals</h2>
      <div class="divider-gold"></div>
    </div>
    <div class="row g-4">
      <?php $__empty_1 = true; $__currentLoopData = $newArrivals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 60); ?>">
        <?php echo $__env->make('frontend.partials.product-card', ['product' => $product], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <?php
        $arrivalImgs = [
          'https://dt-glamora.myshopify.com/cdn/shop/files/grid-banner-1.png?v=1689751925&width=1500',
          'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=400&q=80&fit=crop',
          'https://images.unsplash.com/photo-1584302179602-e4c3d3fd629d?w=400&q=80&fit=crop',
          'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=400&q=80&fit=crop',
        ];
      ?>
      <?php for($i=1; $i<=4; $i++): ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3" data-aos="fade-up">
        <div class="product-card">
          <div class="product-card-img">
            <img src="<?php echo e($arrivalImgs[$i-1]); ?>" alt="New Arrival" loading="lazy" style="width:100%;height:100%;object-fit:cover;">
            <div class="product-card-badges"><span class="product-badge badge-new">New</span></div>
          </div>
          <div class="product-card-body">
            <div class="product-card-cat">New Arrival</div>
            <div class="product-card-name">New Jewelry Piece</div>
            <div class="product-card-price"><span class="price-current">₨7,999</span></div>
          </div>
        </div>
      </div>
      <?php endfor; ?>
      <?php endif; ?>
    </div>
    <div class="text-center mt-5" data-aos="fade-up">
      <a href="<?php echo e(route('shop.index', ['new_arrival' => 1])); ?>" class="btn-glamora" style="padding:14px 40px;">Shop New Arrivals</a>
    </div>
  </div>
</section>


<section class="products-section bg-cream">
  <div class="container-xl-custom">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Customer Favorites</span>
      <h2 class="section-title">Best Sellers</h2>
      <div class="divider-gold"></div>
    </div>
    <div class="row g-4">
      <?php $__empty_1 = true; $__currentLoopData = $bestSellers->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 60); ?>">
        <?php echo $__env->make('frontend.partials.product-card', ['product' => $product], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <?php
        $bestImgs = [
          'https://images.unsplash.com/photo-1611652022419-a9419f74343d?w=400&q=80&fit=crop',
          'https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=400&q=80&fit=crop',
          'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=400&q=80&fit=crop',
          'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=400&q=80&fit=crop',
        ];
      ?>
      <?php for($i=1; $i<=4; $i++): ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3" data-aos="fade-up">
        <div class="product-card">
          <div class="product-card-img">
            <img src="<?php echo e($bestImgs[$i-1]); ?>" alt="Best Seller" loading="lazy" style="width:100%;height:100%;object-fit:cover;">
            <div class="product-card-badges"><span class="product-badge badge-best">Best</span></div>
          </div>
          <div class="product-card-body">
            <div class="product-card-cat">Best Seller</div>
            <div class="product-card-name">Popular Jewelry Piece</div>
            <div class="product-card-price"><span class="price-current">₨9,500</span></div>
          </div>
        </div>
      </div>
      <?php endfor; ?>
      <?php endif; ?>
    </div>
  </div>
</section>


<section class="testimonials-section">
  <div class="container-xl-custom">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">What They Say</span>
      <h2 class="section-title">Customer Reviews</h2>
      <div class="divider-gold"></div>
    </div>
    <div class="swiper testimonialsSwiper" data-aos="fade-up">
      <div class="swiper-wrapper">
        <?php $__currentLoopData = [
          ['name' => 'Priya Sharma',  'role' => 'Verified Buyer',   'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=80&q=80&fit=crop&crop=face', 'text' => 'The Hair Masque is fantastic! My hair feels noticeably softer, stronger and healthier within two weeks.', 'stars' => 5],
          ['name' => 'Aditi Rao',    'role' => 'Verified Buyer',   'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=80&q=80&fit=crop&crop=face', 'text' => 'The 24K Face Serum gives a beautiful, healthy glow. It feels luxurious, absorbs fast, and is very light on the skin.', 'stars' => 5],
          ['name' => 'Rohan Mehta',  'role' => 'Verified Buyer',   'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80&q=80&fit=crop&crop=face', 'text' => 'DIABS Capsules have been a great natural addition to my everyday wellness routine. Feel much more balanced and energetic!', 'stars' => 5],
          ['name' => 'Kavita Nair',  'role' => 'Repeat Customer',  'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=80&q=80&fit=crop&crop=face', 'text' => 'The herbal eye drop provides soothing instant relief from screen fatigue. Natural, refreshing, and gentle!', 'stars' => 5],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="swiper-slide">
          <div class="testimonial-card">
            <div class="stars mb-3"><?php echo e(str_repeat('★', $review['stars'])); ?><?php echo e(str_repeat('☆', 5 - $review['stars'])); ?></div>
            <p class="testimonial-text">"<?php echo e($review['text']); ?>"</p>
            <div class="d-flex align-items-center gap-3 mt-3">
              <img src="<?php echo e($review['avatar']); ?>" alt="<?php echo e($review['name']); ?>" style="width:48px;height:48px;border-radius:50%;object-fit:cover;border:2px solid var(--pd-blue);">
              <div>
                <div class="testimonial-name"><?php echo e($review['name']); ?></div>
                <div class="testimonial-role"><?php echo e($review['role']); ?></div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <div class="swiper-pagination testimonials-pagination" style="position:relative; margin-top:24px;"></div>
    </div>
  </div>
</section>


<section class="instagram-gallery-section">
  <div class="container-xl-custom">
    <div class="section-header" data-aos="fade-up">
      <span class="section-label">Instagram Community</span>
      <h2 class="section-title">From Our Collection</h2>
      <div class="divider-gold"></div>
    </div>
    
    <div class="gallery-grid" data-aos="fade-up">
      
      <a href="https://www.instagram.com/reel/DfRpVQ_PPsK/" target="_blank" rel="noopener" class="gallery-item">
        <video 
          src="<?php echo e(asset('images/instagram/reel_glow.mp4')); ?>" 
          autoplay 
          muted 
          loop 
          playsinline 
          preload="auto"
          style="width:100%; height:100%; object-fit:cover; display:block;">
        </video>
        <div class="gallery-item-overlay">
          <i class="bi bi-instagram"></i>
          <span>View on Instagram</span>
        </div>
      </a>

      
      <a href="https://www.instagram.com/p/DcArDzGvX_c/?hl=en" target="_blank" rel="noopener" class="gallery-item">
        <img src="<?php echo e(asset('images/instagram/diabs_capsule.jpg')); ?>" alt="Ayurnaman Diabs Capsule" loading="lazy">
        <div class="gallery-item-overlay">
          <i class="bi bi-instagram"></i>
          <span>View on Instagram</span>
        </div>
      </a>

      
      <a href="https://www.instagram.com/p/DbsfhS9Pw3F/" target="_blank" rel="noopener" class="gallery-item">
        <img src="<?php echo e(asset('images/instagram/gutswastha.jpg')); ?>" alt="Ayurnaman Gutswastha" loading="lazy">
        <div class="gallery-item-overlay">
          <i class="bi bi-instagram"></i>
          <span>View on Instagram</span>
        </div>
      </a>

      
      <a href="https://www.instagram.com/p/DbLdfrrD1wr/" target="_blank" rel="noopener" class="gallery-item">
        <img src="<?php echo e(asset('images/instagram/glow_naturally.jpg')); ?>" alt="Ayurnaman Glow Naturally" loading="lazy">
        <div class="gallery-item-overlay">
          <i class="bi bi-instagram"></i>
          <span>View on Instagram</span>
        </div>
      </a>

      
      <a href="https://www.instagram.com/p/DZSygYPD4Nr/" target="_blank" rel="noopener" class="gallery-item">
        <img src="<?php echo e(asset('images/instagram/vitaminc.jpg')); ?>" alt="Ayurnaman Vitamin C Face Serum" loading="lazy">
        <div class="gallery-item-overlay">
          <i class="bi bi-instagram"></i>
          <span>View on Instagram</span>
        </div>
      </a>

      
      <a href="https://www.instagram.com/p/DZDHyEPD_z9/" target="_blank" rel="noopener" class="gallery-item">
        <img src="<?php echo e(asset('images/instagram/anti_ageing.jpg')); ?>" alt="Ayurnaman Anti Ageing Cream" loading="lazy">
        <div class="gallery-item-overlay">
          <i class="bi bi-instagram"></i>
          <span>View on Instagram</span>
        </div>
      </a>

      
      <a href="https://www.instagram.com/p/DZmDM3FPeEH/" target="_blank" rel="noopener" class="gallery-item">
        <img src="<?php echo e(asset('images/instagram/blueberry_tea.jpg')); ?>" alt="Ayurnaman Freshly Blueberry Tea" loading="lazy">
        <div class="gallery-item-overlay">
          <i class="bi bi-instagram"></i>
          <span>View on Instagram</span>
        </div>
      </a>
    </div>

    <div class="text-center mt-4" data-aos="fade-up">
      <p class="text-muted small">Follow us on Instagram <a href="https://www.instagram.com/ayurnaman/?hl=en" target="_blank" class="fw-600" style="color:var(--ayur-green-dark);">@ayurnaman</a></p>
    </div>
  </div>
</section>


<div class="brands-marquee">
  <div class="marquee-track">
    <?php $__currentLoopData = ['100% AYURVEDIC', 'HERBAL & PURE', 'NATURAL ACTIVES', 'CRUELTY FREE', 'TOXIN FREE', 'TIME-TESTED REMEDIES', 'HOLISTIC WELLNESS', 'MADE WITH LOVE', 'ORGANIC BOTANICALS']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <span class="marquee-item"><?php echo e($brand); ?></span>
      <span class="marquee-item" style="color:var(--ayur-green);">🌿</span>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <!-- Duplicate for seamless loop -->
    <?php $__currentLoopData = ['100% AYURVEDIC', 'HERBAL & PURE', 'NATURAL ACTIVES', 'CRUELTY FREE', 'TOXIN FREE', 'TIME-TESTED REMEDIES', 'HOLISTIC WELLNESS', 'MADE WITH LOVE', 'ORGANIC BOTANICALS']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <span class="marquee-item"><?php echo e($brand); ?></span>
      <span class="marquee-item" style="color:var(--ayur-green);">🌿</span>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>


<section class="trust-badges-section">
  <div class="container-xl-custom">
    <div class="row g-4 text-center trust-badges-grid">
      <?php $__currentLoopData = [
        ['bi-flower2', '100% Natural Ingredients', 'Powered by time-tested Ayurvedic herbs'],
        ['bi-patch-check', 'Premium Quality', 'High standards, pure and effective formulations'],
        ['bi-shield-lock', 'Secure Checkout', 'Safe, simple and hassle-free shopping'],
        ['bi-headset', 'Customer Support', 'Here to help you anytime with care & expertise'],
      ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-6 col-md-3 trust-badge-col" data-aos="fade-up" data-aos-delay="<?php echo e($i * 80); ?>">
        <div class="p-3 trust-badge-card">
          <i class="bi <?php echo e($feature[0]); ?> trust-badge-icon"></i>
          <h6 class="trust-badge-title"><?php echo e($feature[1]); ?></h6>
          <p class="trust-badge-desc"><?php echo e($feature[2]); ?></p>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.tab-btn {
  background: none;
  border: 1px solid var(--border);
  padding: 8px 20px;
  font-size: 0.78rem;
  font-weight: 600;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: var(--text-muted);
  cursor: pointer;
  transition: all 0.2s;
  border-radius: 0;
}
.tab-btn.active, .tab-btn:hover {
  background: var(--dark);
  border-color: var(--dark);
  color: #fff;
}
.products-next, .products-prev {
  width: 40px !important;
  height: 40px !important;
  background: #fff !important;
  border: 1px solid var(--border) !important;
  color: var(--dark) !important;
  border-radius: 0 !important;
  box-shadow: 0 2px 10px rgba(0,0,0,0.08) !important;
  top: 40% !important;
}
.products-next::after, .products-prev::after { font-size: 0.85rem !important; font-weight: 800 !important; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// Hero Swiper
new Swiper('.heroSwiper', {
  loop: true,
  speed: 800,
  autoplay: { delay: 5000, disableOnInteraction: false },
  pagination: { el: '.hero-pagination', clickable: true },
  navigation: { nextEl: '.hero-arrows .swiper-button-next', prevEl: '.hero-arrows .swiper-button-prev' },
  effect: 'slide',
});

// Category Swiper — 6 desktop / 2 mobile, tighter gaps
new Swiper('.categorySwiper', {
  loop: true,
  grabCursor: true,
  centeredSlides: false,
  slidesPerView: 2,
  spaceBetween: 14, /* Reduced gap between circles */
  speed: 3500,
  autoplay: {
    delay: 0,
    disableOnInteraction: false,
    pauseOnMouseEnter: true,
  },
  breakpoints: {
    480:  { slidesPerView: 3, spaceBetween: 16 },
    768:  { slidesPerView: 4, spaceBetween: 18 },
    992:  { slidesPerView: 5, spaceBetween: 20 },
    1200: { slidesPerView: 6, spaceBetween: 22 },
    1400: { slidesPerView: 6, spaceBetween: 24 },
  },
});

// Products Swiper
new Swiper('.productsSwiper', {
  slidesPerView: 1,
  spaceBetween: 20,
  navigation: { nextEl: '.products-next', prevEl: '.products-prev' },
  breakpoints: {
    576: { slidesPerView: 2 },
    768: { slidesPerView: 3 },
    1200: { slidesPerView: 4 },
  }
});

// Testimonials Swiper
new Swiper('.testimonialsSwiper', {
  slidesPerView: 1,
  spaceBetween: 24,
  loop: true,
  autoplay: { delay: 4000 },
  pagination: { el: '.testimonials-pagination', clickable: true },
  breakpoints: {
    768: { slidesPerView: 2 },
    1200: { slidesPerView: 3 },
  }
});

// Process Instagram embeds if already loaded or on script load
if (window.instgrm) {
  window.instgrm.Embeds.process();
}
</script>
<script async src="//www.instagram.com/embed.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\ayushnaman\resources\views/frontend/home/index.blade.php ENDPATH**/ ?>