<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo $__env->yieldContent('title', \App\Models\Setting::get('meta_title', 'Durable Suitcase House — Luggage & Travel Store Since 1960')); ?></title>
<meta name="description" content="<?php echo $__env->yieldContent('meta_description', \App\Models\Setting::get('meta_description', 'Your trusted destination for bags, luggage & travel essentials since 1960.')); ?>">

<link rel="icon" href="<?php echo e(asset('images/logo.png')); ?>" type="image/png">

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,600&display=swap" rel="stylesheet">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<!-- Swiper -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<!-- GSAP & ScrollTrigger -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

<style>
/* ============================================
   DURABLE SUITCASE HOUSE - Option 1: Classic Heritage
   Navy Blue: #142D4E | Cream: #F7F3E8 | Gold: #C59A55 | Charcoal: #333333 | Taupe: #B9A391
   ============================================ */
:root {
  /* Option 1 Brand Colors */
  --dsh-navy:          #142D4E;   /* Navy Blue – Timeless, trustworthy & premium */
  --dsh-navy-dark:     #0F2137;   /* Deep Navy for headers, footers & hero buttons */
  --dsh-navy-light:    #1F4068;   /* Medium Navy for links & subtle states */
  --dsh-navy-subtle:   #E9EFF6;   /* Ice Navy Background for badges & active tabs */

  --dsh-cream:         #F7F3E8;   /* Warm Heritage Cream background */
  --dsh-cream-light:   #FCFBF7;   /* Soft Sand / Card background */
  --dsh-cream-dark:    #E5DEC9;   /* Subtle borders, card outlines */

  --dsh-gold:          #C59A55;   /* Warm Heritage Gold – Accents, stars, highlight badges */
  --dsh-gold-dark:     #A97E3B;   /* Deep Gold hover */
  --dsh-gold-light:    #FBF6ED;   /* Pale Gold / highlight background */

  --dsh-charcoal:      #333333;   /* Charcoal – Body text & prominent headings */
  --dsh-taupe:         #B9A391;   /* Taupe – Warm muted neutral */
  --dsh-text-muted:    #666666;   /* Muted secondary labels */
  --dsh-white:         #FFFFFF;   /* Pure White */

  /* Aliases for consistency across application */
  --dsh-navy:   var(--dsh-navy);
  --dsh-navy-light:        var(--dsh-navy-light);
  --dsh-gold:  var(--dsh-gold);
  --dsh-navy-subtle: var(--dsh-navy-subtle);
  --dsh-cream:        var(--dsh-cream);
  --dsh-cream-light:  var(--dsh-cream-light);
  --dsh-cream-dark:   var(--dsh-cream-dark);
  --dsh-gold:         var(--dsh-gold);
  --dsh-gold-dark:    var(--dsh-gold-dark);
  --dsh-gold-light:   var(--dsh-gold-light);
  --dsh-charcoal:     var(--dsh-charcoal);
  --dsh-text-muted:   var(--dsh-text-muted);
  --dsh-white:        var(--dsh-white);

  --pd-blue:           var(--dsh-navy);
  --pd-ocean:          var(--dsh-navy-light);
  --pd-sapphire:       var(--dsh-gold);
  --pd-aqua:           var(--dsh-gold);
  --pd-ice:            var(--dsh-cream);
  --pd-navy:           var(--dsh-navy-dark);
  --pd-slate:          var(--dsh-text-muted);
  --pd-silver:         var(--dsh-cream-dark);
  --pd-white:          #FFFFFF;

  /* Gradients */
  --pd-grad-dark:      linear-gradient(135deg, #142D4E 0%, #1F4068 100%);
  --pd-grad-ocean:     linear-gradient(135deg, #142D4E 0%, #C59A55 100%);
  --pd-grad-sky:       linear-gradient(135deg, #1F4068 0%, #C59A55 100%);
  --pd-grad-full:      linear-gradient(90deg, #142D4E 0%, #1F4068 40%, #C59A55 75%, #B9A391 100%);

  /* Global Theme Variables */
  --gold:              var(--dsh-gold);
  --gold-dark:         var(--dsh-gold-dark);
  --gold-light:        var(--dsh-gold-light);
  --cream:             var(--dsh-cream);
  --cream-dark:        var(--dsh-cream-dark);
  --dark:              var(--dsh-charcoal);
  --text:              var(--dsh-charcoal);
  --text-muted:        var(--dsh-text-muted);
  --border:            var(--dsh-cream-dark);

  --font-serif: 'Playfair Display', Georgia, serif;
  --font-sans:  'Plus Jakarta Sans', system-ui, sans-serif;
}

html, body {
  margin: 0;
  padding: 0;
}

*, *::before, *::after { box-sizing: border-box; }

body {
  font-family: var(--font-sans);
  color: var(--text);
  background: #fff;
  font-size: 16px;
  line-height: 1.6;
  overflow-x: hidden;
}

main { display: block; margin: 0; padding: 0; }

h1,h2,h3,h4,h5,h6 { font-family: var(--font-serif); font-weight: 500; color: var(--dark); }

a { color: inherit; text-decoration: none; transition: all 0.25s; }
a:hover { color: var(--gold); }

img { max-width: 100%; }

.text-gold  { color: var(--pd-blue)    !important; }
.bg-gold    { background: var(--pd-grad-dark) !important; }
.bg-cream   { background: var(--pd-ice)  !important; }
.border-gold{ border-color: var(--pd-aqua) !important; }

/* ============================================
   TOP BAR
   ============================================ */
.topbar {
  background: var(--pd-blue);
  color: rgba(255,255,255,0.85);
  font-size: 0.78rem;
  padding: 8px 0;
  letter-spacing: 0.3px;
}
.topbar a { color: rgba(255,255,255,0.85); }
.topbar a:hover { color: var(--pd-aqua); }

/* ============================================
   MARQUEE STRIP
   ============================================ */
.marquee-strip {
  background: var(--pd-grad-ocean);
  overflow: hidden;
  padding: 7px 0;
  position: relative;
}
.marquee-track {
  display: flex;
  width: 100%;
  overflow: hidden;
}
.marquee-content {
  display: flex;
  flex-shrink: 0;
  align-items: center;
  gap: 0;
  animation: marqueeScroll 30s linear infinite;
  white-space: nowrap;
}
.marquee-content span {
  font-size: 0.75rem;
  font-weight: 600;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: #fff;
  padding: 0 40px;
  position: relative;
}
.marquee-content span::after {
  content: '';
  position: absolute;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
  width: 4px;
  height: 4px;
  background: rgba(255,255,255,0.5);
  border-radius: 50%;
}
@keyframes marqueeScroll {
  0%   { transform: translateX(0); }
  100% { transform: translateX(-100%); }
}
.marquee-strip:hover .marquee-content {
  animation-play-state: paused;
}

/*    HEADER - OPTION 1: CLASSIC HERITAGE (WHITE / CREAM & NAVY)
   ============================================ */
.site-header {
  position: sticky; top: 0; z-index: 999;
  background: #ffffff;
  border-bottom: 1.5px solid var(--dsh-cream-dark);
  box-shadow: 0 4px 20px rgba(20, 45, 78, 0.08);
}
.site-header.scrolled {
  background: #ffffff;
  box-shadow: 0 6px 24px rgba(20, 45, 78, 0.12);
}

/* --- ROW 1 --- */
.header-row1 {
  border-bottom: 2px solid var(--dsh-cream-dark, #E5DEC9);
  padding: 0 32px;
  background: #ffffff;
  position: relative;
  z-index: 2;
}
.header-row1-inner { display: flex; align-items: center; justify-content: space-between; gap: 24px; min-height: 82px; padding: 6px 0; }

/* Logo */
.site-logo {
  flex-shrink: 0;
  display: flex;
  align-items: center;
  text-decoration: none;
  min-width: 170px;
}
.site-logo img {
  height: 72px;
  max-height: 78px;
  width: auto;
  display: block;
  object-fit: contain;
  transition: transform 0.2s ease, opacity 0.2s ease;
}
.site-header-logo-img {
  height: 72px !important;
  max-height: 78px !important;
  width: auto !important;
  object-fit: contain;
}
@media (max-width: 991px) {
  .header-row1-inner { 
    min-height: 64px; 
    justify-content: space-between;
  }
  .site-logo {
    min-width: auto;
    margin-right: auto;
  }
  .site-logo img, .site-header-logo-img { height: 52px !important; max-height: 56px !important; }
}
.site-logo-fallback {
  display: flex;
  flex-direction: column;
  line-height: 1;
}
.logo-pacific  { font-size:0.58rem; font-weight:400; letter-spacing:5px; text-transform:uppercase; color:#999; font-family:var(--font-sans); }
.logo-diamonds { font-size:1.5rem; font-weight:600; font-style:italic; color:var(--dark); font-family:var(--font-serif); letter-spacing:0.5px; margin-top:-1px; }
.site-logo:hover .logo-diamonds { color: var(--gold); }
.site-logo:hover img { opacity: 0.85; }

/* Search Bar - High Contrast Option 1 */
.header-search-bar { flex:1; max-width:540px; margin:0 auto; }
.header-search-form {
  display:flex; align-items:center; border:2px solid #C59A55;
  border-radius:28px; padding:0 18px; height:46px; background:#ffffff;
  gap:10px; transition:border-color 0.2s, background 0.2s, box-shadow 0.2s;
  width: 100%;
  box-shadow: 0 2px 8px rgba(20, 45, 78, 0.05);
}
.header-search-form:focus-within { border-color: var(--dsh-navy, #142D4E); background:#fff; box-shadow:0 0 0 4px rgba(20,45,78,0.12); }
.header-search-icon { color:var(--dsh-navy, #142D4E); font-size:1.05rem; flex-shrink:0; }
.header-search-input { flex:1; border:none; outline:none; background:transparent; font-size:0.88rem; color:var(--dsh-charcoal, #333333); font-family:var(--font-sans); }
.header-search-input::placeholder { color:#777777; font-weight:500; }
.header-search-btn { background:none; border:none; cursor:pointer; color:var(--dsh-navy, #142D4E); font-size:1.1rem; padding:0 3px; transition:color 0.2s; flex-shrink:0; display:flex; align-items:center; line-height:1; }
.header-search-btn:hover { color:var(--dsh-gold-dark, #A97E3B); }
.header-search-btn + .header-search-btn { border-left:1.5px solid #C59A55; padding-left:10px; margin-left:4px; }

/* Mic recording state */
.mic-btn { transition: color 0.2s, transform 0.2s; }
.mic-btn.mic-recording {
  color: #e53935 !important;
  animation: micPulse 0.7s ease infinite alternate;
}
@keyframes micPulse {
  from { transform: scale(1);   opacity: 1; }
  to   { transform: scale(1.35); opacity: 0.65; }
}

/* Live search dropdown results */
.search-results-dropdown {
  position: absolute;
  top: calc(100% + 6px);
  left: 0;
  right: 0;
  background: #fff;
  border-radius: 12px;
  border: 1px solid #e2e8f0;
  box-shadow: 0 12px 30px rgba(0,0,0,0.14);
  z-index: 1050;
  max-height: 380px;
  overflow-y: auto;
  display: none;
}
.search-results-dropdown.show {
  display: block;
}
.search-result-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 14px;
  border-bottom: 1px solid #f1f5f0;
  text-decoration: none;
  color: var(--dark);
  transition: background 0.15s;
}
.search-result-item:last-child {
  border-bottom: none;
}
.search-result-item:hover,
.search-result-item:active {
  background: #f8faf7;
}
.search-result-img {
  width: 44px;
  height: 44px;
  border-radius: 6px;
  object-fit: contain;
  background: #fafafa;
  border: 1px solid #edf0ec;
  flex-shrink: 0;
  padding: 2px;
}
.search-result-title {
  font-size: 0.88rem;
  font-weight: 600;
  margin-bottom: 2px;
  line-height: 1.3;
  color: var(--dark);
}
.search-result-category {
  font-size: 0.7rem;
  color: #718096;
  text-transform: capitalize;
  margin-bottom: 3px;
}
.search-result-price {
  font-size: 0.84rem;
  font-weight: 700;
  color: var(--dsh-navy);
}
.search-result-footer {
  padding: 10px 14px;
  background: var(--pd-ice);
  text-align: center;
  border-top: 1px solid #e7eae3;
}
.search-result-footer a {
  font-size: 0.78rem;
  font-weight: 600;
  color: var(--dsh-navy);
}

/* Mobile search */
.header-search-mobile {
  padding: 10px 16px;
  background: #fff;
  border-bottom: 1px solid #eef2ec;
  display: none;
  position: relative;
  animation: slideDownMobileSearch 0.2s ease;
}
.header-search-mobile.show {
  display: block;
}
@media (max-width: 991px) {
  .header-search-mobile .search-results-dropdown {
    position: static !important;
    display: none;
    margin-top: 8px !important;
    width: 100% !important;
    max-height: 60vh !important;
    overflow-y: auto !important;
    -webkit-overflow-scrolling: touch;
    box-shadow: 0 4px 16px rgba(0,0,0,0.08) !important;
  }
  .header-search-mobile .search-results-dropdown.show {
    display: block !important;
  }
}
@keyframes slideDownMobileSearch {
  from { opacity: 0; transform: translateY(-8px); }
  to   { opacity: 1; transform: translateY(0); }
}
.header-search-mobile .header-search-form { height:40px; border-radius:20px; }

.mobile-header-actions {
  display: flex;
  align-items: center;
  gap: 4px;
}
.mobile-header-btn {
  background: none;
  border: none;
  cursor: pointer;
  color: var(--dark);
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.35rem;
  padding: 0;
  border-radius: 50%;
  transition: background 0.15s, color 0.15s;
}
.mobile-header-btn:hover,
.mobile-header-btn.active {
  background: var(--pd-ice);
  color: var(--dsh-navy);
}

/* Icons with label - High Contrast Navy on White */
.header-icons { display:flex; align-items:center; gap:10px; flex-shrink:0; }
.header-icon-btn {
  display:flex; flex-direction:column; align-items:center; justify-content:center;
  min-width:48px; height:54px; padding:0 6px;
  background:none; border:none; cursor:pointer; color:var(--dsh-navy, #142D4E) !important; font-size:1.25rem;
  transition:all 0.2s ease; position:relative; text-decoration:none; gap:3px;
}
.header-icon-btn i { color:var(--dsh-navy, #142D4E) !important; font-size:1.25rem; }
.header-icon-btn:hover { color:var(--dsh-gold-dark, #A97E3B) !important; }
.header-icon-btn:hover i { color:var(--dsh-gold-dark, #A97E3B) !important; }
.header-icon-label {
  font-size:0.65rem; font-weight:700; letter-spacing:0.5px; text-transform:uppercase;
  color:var(--dsh-charcoal, #333333) !important; white-space:nowrap; line-height:1;
}
.header-icon-btn:hover .header-icon-label { color:var(--dsh-gold-dark, #A97E3B) !important; }
.header-icon-btn .cart-badge {
  position:absolute; top:4px; right:4px;
  background:var(--dsh-navy, #142D4E); color:#ffffff;
  font-size:0.6rem; min-width:18px; height:18px; line-height:18px; border-radius:50%; font-weight:800;
}
.header-icon-btn .wishlist-badge {
  position:absolute; top:4px; right:2px;
  min-width:18px; height:18px; padding:0 4px; border-radius:50%;
  background:#dc3545; color:#fff; font-size:.58rem; line-height:18px; text-align:center; font-weight:700;
}

/* WhatsApp Header CTA */
.header-wa-btn {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: rgba(37, 211, 102, 0.12);
  border: 1.5px solid #25D366;
  color: #128C7E;
  padding: 8px 18px;
  border-radius: 30px;
  font-size: 0.78rem;
  font-weight: 700;
  letter-spacing: 0.8px;
  text-transform: uppercase;
  text-decoration: none;
  transition: all 0.2s ease;
  margin-left: 6px;
}
.header-wa-btn:hover {
  background: #25D366;
  color: #ffffff;
  box-shadow: 0 4px 14px rgba(37, 211, 102, 0.35);
}

/* Mobile hamburger */
.header-btn { background:none; border:none; cursor:pointer; color:var(--dsh-navy); padding:6px; display:flex; align-items:center; transition:color 0.2s; }
.header-btn:hover { color:var(--dsh-gold-dark); }

/* ============================================
   ROW 2 — CATEGORY NAV (ALIGNED WITH LOGO & ICONS HEADER WIDTH)
   ============================================ */
.header-catnav {
  background: #FBF8F0; /* Warm heritage tone for distinct separation from pure white row 1 */
  border-top: 1px solid rgba(197, 154, 85, 0.45); /* Elegant warm gold partition hairline */
  border-bottom: 2px solid var(--dsh-cream-dark, #E5DEC9); /* Clear boundary separating header from hero below */
  padding: 0 32px;
  width: 100%;
  position: relative;
  z-index: 100;
  box-shadow: inset 0 2px 4px rgba(20, 45, 78, 0.03), 0 3px 8px rgba(20, 45, 78, 0.05);
}
.header-catnav-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  padding: 0;
  overflow: visible !important;
}
.catnav-list {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
  width: 100%;
  justify-content: space-between;
  gap: 16px;
  white-space: nowrap;
  align-items: stretch;
}
.catnav-item { position: relative; display: flex; align-items: stretch; }
.catnav-link {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 13px 8px;
  font-size: 0.92rem;
  font-weight: 600;
  letter-spacing: 0.2px;
  text-transform: capitalize;
  color: var(--dsh-navy, #142D4E);
  text-decoration: none;
  white-space: nowrap;
  transition: all 0.2s ease;
  border-bottom: 2.5px solid transparent;
  position: relative;
}
.catnav-link:hover, .catnav-link.active { color: var(--dsh-gold-dark, #A97E3B); border-bottom-color: var(--dsh-gold-dark, #A97E3B); }
.catnav-text { font-size: 0.92rem; font-weight: 600; line-height: 1; text-transform: capitalize; transition: transform 0.2s ease; }
.catnav-item:hover .catnav-text { transform: translateY(-2px); }
.catnav-badge { position: absolute; top: 4px; right: 4px; font-size: 0.5rem; font-weight: 700; text-transform: uppercase; padding: 1px 4px; border-radius: 2px; color: #fff; }
.catnav-item:hover > .tanishq-megamenu {
  display: flex !important;
  opacity: 1 !important;
  visibility: visible !important;
  transform: translateY(0) !important;
  pointer-events: auto !important;
}
.catnav-item:hover > .catnav-link { color: var(--dsh-gold-dark, #A97E3B); border-bottom-color: var(--dsh-gold-dark, #A97E3B); }

/* ============================================
   CLEAN LUXURY MEGA MENU DROPDOWN
   ============================================ */
.tanishq-megamenu {
  display: none;
  opacity: 0;
  visibility: hidden;
  transform: translateY(6px);
  pointer-events: none;
  position: fixed;
  top: auto;
  left: 0;
  right: 0;
  width: 100%;
  background: #ffffff;
  border-top: 2px solid var(--dsh-gold, #C59A55);
  border-bottom: 2px solid var(--dsh-cream-dark, #E5DEC9);
  box-shadow: 0 20px 50px rgba(20, 45, 78, 0.14);
  z-index: 1050;
  transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s;
  padding: 0;
}
.megamenu-inner-container {
  width: 100%;
  max-width: 1480px;
  margin: 0 auto;
  padding: 24px 32px 14px;
}
.megamenu-columns-wrapper {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)) 300px;
  gap: 32px;
  align-items: start;
}
.mm-column-card {
  display: flex;
  flex-direction: column;
}
.mm-column-header {
  border-bottom: 2px solid var(--dsh-cream, #F7F3E8);
  padding-bottom: 10px;
  margin-bottom: 14px;
}
.mm-column-title {
  font-family: var(--font-sans);
  font-size: 0.76rem;
  font-weight: 800;
  letter-spacing: 1.8px;
  text-transform: uppercase;
  color: var(--dsh-navy, #142D4E);
  display: inline-block;
  border-left: 3px solid var(--dsh-gold, #C59A55);
  padding-left: 10px;
  line-height: 1.2;
}
.mm-column-items {
  display: flex;
  flex-direction: column;
  gap: 4px;
}
.mm-item-link {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 7px 10px;
  border-radius: 6px;
  text-decoration: none;
  color: var(--dsh-charcoal, #333333);
  transition: all 0.18s ease;
  font-size: 0.92rem;
  font-weight: 500;
}
.mm-item-link:hover {
  background: var(--dsh-cream, #F7F3E8);
  color: var(--dsh-navy, #142D4E);
  transform: translateX(4px);
}
.mm-item-ico {
  font-size: 0.85rem;
  color: var(--dsh-gold-dark, #A97E3B);
  transition: transform 0.18s ease;
}
.mm-item-link:hover .mm-item-ico {
  transform: scale(1.15);
  color: var(--dsh-navy, #142D4E);
}
.mm-item-txt {
  line-height: 1.3;
}
.mm-item-txt.highlighted {
  font-weight: 700;
  color: var(--dsh-navy, #142D4E);
}

/* Feature Showcase Card */
.mm-feature-card {
  background: var(--dsh-cream-light, #FCFBF7);
  border: 1.5px solid var(--dsh-cream-dark, #E5DEC9);
  border-radius: 12px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  box-shadow: 0 6px 18px rgba(20, 45, 78, 0.05);
}
.mm-feature-thumb {
  width: 100%;
  height: 145px;
  overflow: hidden;
  background: #ffffff;
}
.mm-feature-thumb img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}
.mm-feature-card:hover .mm-feature-thumb img {
  transform: scale(1.05);
}
.mm-feature-info {
  padding: 14px 16px;
  display: flex;
  flex-direction: column;
  gap: 4px;
}
.mm-feature-badge {
  font-size: 0.65rem;
  font-weight: 800;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: var(--dsh-gold-dark, #A97E3B);
}
.mm-feature-heading {
  font-family: var(--font-serif);
  font-size: 1.15rem;
  font-weight: 700;
  color: var(--dsh-navy, #142D4E);
  margin: 0;
}
.mm-feature-cta {
  font-size: 0.82rem;
  font-weight: 700;
  color: var(--dsh-navy, #142D4E);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  margin-top: 6px;
  transition: gap 0.2s ease, color 0.2s ease;
}
.mm-feature-cta:hover {
  color: var(--dsh-gold-dark, #A97E3B);
  gap: 10px;
}

/* Bottom Bar */
.megamenu-bottom-bar {
  border-top: 1px solid var(--dsh-cream-dark, #E5DEC9);
  margin-top: 18px;
  padding-top: 12px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.mm-guarantee-pill {
  font-size: 0.8rem;
  font-weight: 600;
  color: var(--dsh-navy, #142D4E);
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.mm-guarantee-pill i {
  color: var(--dsh-gold-dark, #A97E3B);
}
.mm-view-all-link {
  font-size: 0.82rem;
  font-weight: 700;
  color: var(--dsh-gold-dark, #A97E3B);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
.mm-view-all-link:hover {
  color: var(--dsh-navy, #142D4E);
  text-decoration: underline;
}

/* Simple Dropdown */
.dropdown-nav { position:absolute; top:100%; left:0; min-width:200px; background:#fff; border:1px solid var(--border); box-shadow:0 10px 40px rgba(0,0,0,0.1); padding:8px 0; display:none; z-index:1000; }
.catnav-item:hover .dropdown-nav { display:block; }
.dropdown-nav a { display:block; padding:8px 20px; font-size:0.82rem; color:var(--text); }
.dropdown-nav a:hover { background:var(--cream); color:var(--gold); }

.nav-badge { font-size:0.55rem; background:var(--pd-sapphire); color:#fff; padding:2px 5px; border-radius:3px; font-weight:700; letter-spacing:0.5px; vertical-align:middle; }

.cart-badge {
  position: absolute;
  top: 2px; right: 2px;
  background: var(--pd-blue);
  color: #fff;
  font-size: 0.6rem;
  min-width: 16px;
  height: 16px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
}

/* Cart Drawer */
.cart-drawer {
  position: fixed;
  top: 0; right: 0;
  width: 400px;
  height: 100vh;
  background: #fff;
  z-index: 9998;
  box-shadow: -10px 0 50px rgba(0,0,0,0.15);
  transform: translateX(100%);
  transition: transform 0.35s ease;
  display: flex;
  flex-direction: column;
}
.cart-drawer.open { transform: translateX(0); }
.cart-overlay {
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0,0,0,0.5);
  z-index: 9997;
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s;
}
.cart-overlay.active { opacity: 1; visibility: visible; }
.cart-header { padding: 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
.cart-body { flex: 1; overflow-y: auto; padding: 16px; }
.cart-footer { padding: 20px; border-top: 1px solid var(--border); }
.cart-item { display: flex; gap: 12px; padding: 12px 0; border-bottom: 1px solid var(--border); }
.cart-item-img { width: 70px; height: 80px; object-fit: cover; flex-shrink: 0; }
.cart-item-remove { background: none; border: none; color: var(--text-muted); cursor: pointer; font-size: 1rem; padding: 0; }
.cart-item-remove:hover { color: #dc3545; }
.cart-quantity { display:flex; align-items:center; gap:7px; margin-top:7px; }
.cart-quantity button { width:22px; height:22px; padding:0; border:1px solid var(--border); background:#fff; color:var(--text); line-height:1; cursor:pointer; }
.cart-quantity button:hover { border-color:var(--pd-blue); color:var(--pd-blue); }
.cart-quantity span { min-width:18px; text-align:center; font-size:.78rem; }

/* ============================================
   BUTTONS
   ============================================ */
.btn-glamora {
  background: var(--pd-blue);
  color: #fff;
  border: 2px solid var(--pd-blue);
  padding: 12px 32px;
  font-size: 0.78rem;
  font-weight: 600;
  letter-spacing: 2px;
  text-transform: uppercase;
  transition: all 0.3s;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  border-radius: 0;
}
.btn-glamora:hover { background: var(--pd-ocean); border-color: var(--pd-ocean); color: #fff; }

.btn-gold {
  background: var(--pd-grad-dark);
  color: #fff;
  border: 2px solid var(--pd-blue);
  padding: 12px 32px;
  font-size: 0.78rem;
  font-weight: 600;
  letter-spacing: 2px;
  text-transform: uppercase;
  transition: all 0.3s;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  border-radius: 0;
}
.btn-gold:hover { background: transparent; color: var(--pd-blue); border-color: var(--pd-blue); }

.btn-outline-glamora {
  background: transparent;
  color: var(--pd-blue);
  border: 1.5px solid var(--pd-blue);
  padding: 11px 30px;
  font-size: 0.78rem;
  font-weight: 600;
  letter-spacing: 2px;
  text-transform: uppercase;
  transition: all 0.3s;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  border-radius: 0;
}
.btn-outline-glamora:hover { background: var(--pd-blue); color: #fff; }

/* ============================================
   PRODUCT CARD
   ============================================ */
.product-card {
  position: relative;
  overflow: hidden;
  background: #fff;
  border-radius: 16px;
  padding: 14px;
  border: 1px solid rgba(0,0,0,0.06);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}
.product-card-img {
  position: relative;
  overflow: hidden;
  background: #fcfbf7;
  aspect-ratio: 1 / 1;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0;
}
.product-card-img a {
  display: block;
  width: 100%;
  height: 100%;
  position: relative;
}
.product-card-img img {
  width: 100%;
  height: 100%;
  object-fit: cover !important;
  object-position: center;
  transition: transform 0.45s ease, opacity 0.45s ease;
  display: block;
}
.product-card-img .product-img-primary {
  position: relative;
  z-index: 1;
}
.product-card-img .product-img-secondary {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover !important;
  opacity: 0;
  z-index: 2;
  transition: opacity 0.45s ease, transform 0.45s ease;
}
.product-card:hover .product-card-img.has-hover-image .product-img-secondary {
  opacity: 1;
  transform: scale(1.06);
}
.product-card:hover .product-card-img.has-hover-image .product-img-primary {
  opacity: 0;
}
.product-card:hover .product-card-img:not(.has-hover-image) img {
  transform: scale(1.06);
}

/* Global Pagination Fix */
.pagination {
  display: inline-flex !important;
  gap: 6px !important;
  margin: 0 !important;
  padding: 0 !important;
  list-style: none !important;
  align-items: center !important;
}
.pagination svg, nav svg {
  width: 14px !important;
  height: 14px !important;
  max-width: 16px !important;
  max-height: 16px !important;
  display: inline-block !important;
}
.page-link {
  display: inline-flex !important;
  align-items: center !important;
  justify-content: center !important;
  min-width: 38px !important;
  height: 38px !important;
  padding: 6px 12px !important;
  font-size: 0.88rem !important;
  font-weight: 500 !important;
  color: var(--dsh-navy, #142D4E) !important;
  background: #ffffff !important;
  border: 1px solid #e0dfd5 !important;
  border-radius: 8px !important;
  text-decoration: none !important;
  transition: all 0.2s ease !important;
}
.page-link:hover {
  background: var(--dsh-cream, #F7F3E8) !important;
  border-color: var(--dsh-gold, #C59A55) !important;
  color: var(--dsh-navy, #142D4E) !important;
}
.page-item.active .page-link {
  background: var(--dsh-navy, #142D4E) !important;
  border-color: var(--dsh-navy, #142D4E) !important;
  color: #ffffff !important;
  font-weight: 700 !important;
}
.page-item.disabled .page-link {
  background: #f8f9fa !important;
  border-color: #eee !important;
  color: #aaa !important;
  cursor: not-allowed !important;
}
nav p.small {
  margin: 0 !important;
  color: #666 !important;
  font-size: 0.85rem !important;
}

.product-card-badges {
  position: absolute;
  top: 12px;
  left: 12px;
  display: flex;
  flex-direction: column;
  gap: 4px;
  z-index: 2;
}
.product-badge {
  font-size: 0.62rem;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 3px 8px;
}
.badge-new  { background: var(--pd-blue);    color: #fff; }
.badge-sale { background: #dc3545;           color: #fff; }
.badge-best { background: var(--pd-ocean);   color: #fff; }

.product-card-actions {
  position: absolute;
  bottom: -60px;
  left: 0; right: 0;
  display: flex;
  gap: 8px;
  padding: 12px;
  background: rgba(255,255,255,0.95);
  transition: bottom 0.3s ease;
  z-index: 2;
}
.product-card:hover .product-card-actions { bottom: 0; }

.product-action-btn {
  flex: 1;
  background: var(--dsh-navy, #142D4E) !important;
  color: #ffffff !important;
  border: 1px solid var(--dsh-navy, #142D4E) !important;
  border-radius: 6px;
  padding: 10px 14px;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 0.8px;
  text-transform: uppercase;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  transition: all 0.25s ease;
  box-shadow: 0 4px 12px rgba(20, 45, 78, 0.2);
}
.product-action-btn:hover {
  background: var(--dsh-gold, #C59A55) !important;
  border-color: var(--dsh-gold, #C59A55) !important;
  color: #0F2137 !important;
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(197, 154, 85, 0.35);
}
.product-action-btn.wishlist-btn {
  flex: 0 0 42px;
  background: #ffffff !important;
  color: var(--dsh-charcoal, #333333) !important;
  border: 1px solid var(--dsh-cream-dark, #E5DEC9) !important;
  font-size: 1.05rem;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
.product-action-btn.wishlist-btn:hover,
.product-action-btn.wishlist-btn.active {
  color: #dc3545 !important;
  border-color: #dc3545 !important;
  background: #FFF5F5 !important;
}

.product-card-wish-top {
  position: absolute;
  top: 10px;
  right: 10px;
  z-index: 3;
}
.product-card-wish-top .wishlist-btn {
  width: 36px;
  height: 36px;
  border-radius: 50% !important;
  background: rgba(255, 255, 255, 0.92) !important;
  border: 1px solid var(--dsh-cream-dark, #E5DEC9) !important;
  color: var(--dsh-charcoal, #333333) !important;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  transition: all 0.2s ease;
}
.product-card-wish-top .wishlist-btn:hover,
.product-card-wish-top .wishlist-btn.active {
  color: #dc3545 !important;
  border-color: #dc3545 !important;
  background: #ffffff !important;
  transform: scale(1.1);
}

.product-card-body {
  padding: 12px 2px 4px;
}
.product-card-cat {
  font-size: 0.68rem;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  color: var(--dsh-text-muted, #777777);
  margin-bottom: 4px;
}
.product-card-name {
  font-family: var(--font-serif);
  font-size: 1rem;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 6px;
  line-height: 1.35;
  white-space: nowrap !important;
  overflow: hidden !important;
  text-overflow: ellipsis !important;
  display: block !important;
}
.product-card-price {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 2px;
}
.price-current {
  font-size: 1.02rem;
  font-weight: 700;
  color: var(--dsh-navy, #142D4E);
}
.price-original {
  font-size: 0.85rem;
  color: var(--dsh-text-muted, #888888);
  text-decoration: line-through;
}
.price-badge {
  font-size: 0.65rem;
  background: #dc3545;
  color: #fff;
  padding: 2px 6px;
  font-weight: 700;
  border-radius: 3px;
}

.product-card-bottom-actions {
  display: block;
}
.product-card-bottom-actions .product-action-btn {
  width: 100%;
}

/* Stars */
.stars { color: var(--pd-sapphire); font-size: 0.75rem; letter-spacing: 1px; }
.stars-count { font-size: 0.7rem; color: var(--text-muted); margin-left: 4px; }

/* ============================================
   SECTION STYLES
   ============================================ */
.section-header { text-align: center; margin-bottom: 48px; }
.section-label {
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 4px;
  text-transform: uppercase;
  color: var(--pd-sapphire);
  margin-bottom: 10px;
  display: block;
}
.section-title { font-family: var(--font-serif); font-size: 2.5rem; font-weight: 400; color: var(--dark); line-height: 1.2; margin-bottom: 12px; }
.section-subtitle { font-size: 0.9rem; color: var(--text-muted); max-width: 500px; margin: 0 auto; }

/* ============================================
   FOOTER
   ============================================ */
.site-footer {
  background: var(--pd-navy);
  color: rgba(255,255,255,0.7);
  padding-top: 64px;
}
.footer-brand { font-family: var(--font-serif); font-size: 2rem; font-weight: 300; color: #fff; font-style: italic; letter-spacing: 2px; }
.footer-desc { font-size: 0.85rem; line-height: 1.7; margin-top: 12px; max-width: 300px; }
.footer-heading { font-size: 0.72rem; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: var(--pd-aqua); margin-bottom: 20px; }
.footer-links { list-style: none; padding: 0; }
.footer-links li { margin-bottom: 8px; }
.footer-links a { font-size: 0.85rem; color: rgba(255,255,255,0.6); transition: all 0.2s; }
.footer-links a:hover { color: var(--pd-aqua); padding-left: 4px; }
.footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding: 22px 0; margin-top: 48px; }
.footer-bottom-text { font-size: 0.78rem; color: rgba(255,255,255,0.5); }
.footer-dev-link { color: rgba(255,255,255,0.65); text-decoration: none; font-weight: 600; transition: color 0.2s; }
.footer-dev-link:hover { color: var(--dsh-gold); text-decoration: underline; }
@media (max-width: 768px) {
  .footer-bottom {
    margin-top: 32px;
    padding: 24px 0 20px;
    text-align: center;
  }
  .footer-bottom .container-xl-custom > div {
    gap: 14px !important;
  }
  .footer-bottom-text {
    font-size: 0.8rem;
    line-height: 1.5;
  }
}
.social-links { display: flex; gap: 12px; margin-top: 20px; }
.social-link {
  width: 36px; height: 36px; border: 1px solid rgba(255,255,255,0.2);
  display: flex; align-items: center; justify-content: center;
  color: rgba(255,255,255,0.6); font-size: 0.9rem; transition: all 0.2s;
}
.social-link:hover { border-color: var(--pd-aqua); color: var(--pd-aqua); background: rgba(77,163,230,0.1); }

/* Newsletter */
.newsletter-input {
  width: 100%;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.2);
  padding: 12px 16px;
  color: #fff;
  font-size: 0.85rem;
  outline: none;
  transition: border 0.2s;
}
.newsletter-input::placeholder { color: rgba(255,255,255,0.4); }
.newsletter-input:focus { border-color: var(--pd-aqua); }
.newsletter-btn {
  background: var(--pd-blue);
  border: none;
  padding: 12px 20px;
  color: #fff;
  font-size: 0.78rem;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  cursor: pointer;
  transition: background 0.2s;
  white-space: nowrap;
}
.newsletter-btn:hover { background: var(--pd-ocean); }

/* ============================================
   MOBILE NAV
   ============================================ */
.mobile-menu-overlay {
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0,0,0,0.5);
  z-index: 9995;
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s;
}
.mobile-menu-overlay.active { opacity: 1; visibility: visible; }
.mobile-nav {
  position: fixed;
  top: 0; right: -100%; left: auto;
  bottom: 0;
  width: 290px;
  height: 100%;
  max-height: 100vh;
  background: #fff;
  z-index: 9996;
  overflow-y: auto;
  transition: right 0.3s ease;
  padding: 0;
  display: flex;
  flex-direction: column;
}
.mobile-nav.open { right: 0; left: auto; }
.mobile-nav-header { padding: 12px 18px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; flex-shrink: 0; }
.mobile-nav-logo { font-family: var(--font-serif); font-size: 1.6rem; font-style: italic; color: var(--dark); }
.mobile-nav ul { list-style: none; padding: 0; margin: 0; display: block; }
.mobile-nav ul li a { display: block; padding: 8px 18px; font-size: 0.84rem; line-height: 1.25; font-weight: 500; color: var(--text); border-bottom: 1px solid var(--border); letter-spacing: 0.3px; }
.mobile-nav ul li a:hover { color: var(--gold); background: var(--cream); }
.mobile-sub {
  background: var(--cream);
  display: block;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.35s ease;
  border-bottom: none;
}
.mobile-sub.open { display: block; }
.mobile-sub a {
  padding: 6px 18px 6px 36px !important;
  font-size: 0.78rem !important;
  line-height: 1.25 !important;
  color: var(--text-muted) !important;
  border-bottom: 1px solid rgba(0,0,0,0.05) !important;
  display: block;
}
.mobile-sub a:last-child { border-bottom: none !important; }
.mobile-sub a:hover { color: var(--gold) !important; background: #fff !important; }

.mobile-nav-item { position: relative; }
.mobile-nav-item > .mobile-nav-link {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 8px 18px;
  font-size: 0.84rem;
  line-height: 1.25;
  font-weight: 500;
  color: var(--text);
  border-bottom: 1px solid var(--border);
  letter-spacing: 0.3px;
  cursor: pointer;
  text-decoration: none;
  transition: all 0.2s;
  background: #fff;
}
.mobile-nav-item > .mobile-nav-link:hover { color: var(--gold); background: var(--cream); }
.mobile-dropdown-arrow {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 28px; height: 28px;
  background: var(--cream);
  border-radius: 4px;
  transition: transform 0.3s ease, background 0.2s;
  flex-shrink: 0;
}
.mobile-dropdown-arrow i { font-size: 0.75rem; color: var(--text-muted); transition: color 0.2s; }
.mobile-nav-item.open > .mobile-nav-link .mobile-dropdown-arrow {
  transform: rotate(180deg);
  background: var(--pd-blue);
}
.mobile-nav-item.open > .mobile-nav-link .mobile-dropdown-arrow i { color: #fff; }
.mobile-sub-header {
  padding: 8px 20px 6px 40px;
  font-size: 0.65rem;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: var(--gold);
  background: var(--cream);
  border-bottom: 1px solid rgba(0,0,0,0.05);
}

/* ============================================
   ANIMATIONS
   ============================================ */
[data-aos] { opacity: 0; transition: opacity 0.6s ease, transform 0.6s ease; }
[data-aos].aos-animate { opacity: 1; transform: none !important; }
[data-aos="fade-up"] { transform: translateY(30px); }
[data-aos="fade-in"] { opacity: 0; }
[data-aos="zoom-in"] { transform: scale(0.9); }

/* ============================================
   UTILITIES
   ============================================ */
.divider-gold {
  width: 60px; height: 2px; background: var(--pd-grad-sky); margin: 16px auto;
}
.divider-gold-left { margin-left: 0; }

.container-xl-custom { max-width: 100%; margin: 0 auto; padding: 0 24px; }

@media (max-width: 1200px) { 
  .header-row1 { padding: 0 20px; } 
  .header-catnav { padding: 0 20px; }
  .header-catnav-inner { padding: 0; } 
}
@media (max-width: 992px) {
  .header-row1 { padding: 0 16px; }
  .header-catnav { padding: 0 16px; }
  .container-xl-custom { padding: 0 16px; }
  .section-title { font-size: 1.9rem; }
}
@media (max-width: 576px) {
  .cart-drawer { width: 100%; }
  .section-title { font-size: 1.6rem; }
  .container-xl-custom { padding: 0 12px; }
  .header-row1 { padding: 0 12px; }
  .header-row1-inner { height: 56px; }

  /* Compact Product Card on Phones */
  .product-card {
    max-width: 320px;
    margin: 0 auto;
    padding: 10px;
    border-radius: 12px;
  }
  .product-card-img {
    padding: 0;
    border-radius: 10px;
  }
  .product-card-body {
    padding: 10px 2px 4px;
  }
  .product-card-name {
    font-size: 0.95rem;
    margin-bottom: 4px;
  }
  .product-card-cat {
    font-size: 0.62rem;
    margin-bottom: 2px;
  }

  /* Hide hover actions on mobile */
  .product-card-img .product-card-actions {
    display: none !important;
  }
  /* Mobile dedicated bottom buttons */
  .product-card-mobile-actions {
    display: flex !important;
    gap: 6px;
    margin-top: 8px;
  }
  .product-card-mobile-actions .product-action-btn {
    border-radius: 6px;
    padding: 9px 14px;
    font-size: 0.78rem;
    font-weight: 700;
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--dsh-navy, #142D4E) !important;
    color: #ffffff !important;
    border: 1px solid var(--dsh-navy, #142D4E) !important;
  }
  .product-card-mobile-actions .wishlist-btn {
    border-radius: 6px;
    flex: 0 0 38px;
    height: 38px;
    background: #ffffff !important;
    border: 1px solid var(--dsh-cream-dark, #E5DEC9) !important;
    color: var(--dsh-charcoal, #333333) !important;
  }
  .product-card-mobile-actions .wishlist-btn.active,
  .product-card-mobile-actions .wishlist-btn:hover {
    color: #dc3545;
    border-color: #dc3545;
  }
}

/* ============================================
   ACCOUNT PAGES RESPONSIVE STYLES
   ============================================ */
.account-hero {
  background: var(--pd-ice);
  padding: 36px 0;
}
.account-sidebar-box {
  background: var(--pd-ice);
  padding: 20px;
  border-radius: 8px;
  border: 1px solid rgba(27,56,43,0.06);
}
.account-nav-link {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 14px;
  font-size: 0.88rem;
  font-weight: 500;
  color: var(--text-muted);
  background: transparent;
  border-left: 2px solid transparent;
  transition: all 0.2s;
  text-decoration: none;
  border-radius: 4px;
}
.account-nav-link:hover, .account-nav-link.active {
  color: var(--dsh-navy);
  background: #fff;
  border-left: 2px solid var(--dsh-navy-light);
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
}
.account-card {
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 28px;
}
.account-stat-box {
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 20px 14px;
  text-align: center;
  transition: transform 0.2s;
}
.account-stat-box:hover {
  transform: translateY(-3px);
  border-color: var(--dsh-navy-light);
}

/* Mobile Clean Segmented Menu */
.account-mobile-select-wrap {
  position: relative;
}
.account-mobile-current {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #fff;
  border: 1.5px solid var(--border);
  border-radius: 8px;
  padding: 12px 16px;
  cursor: pointer;
  box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}
.account-mobile-dropdown-menu {
  display: none;
  position: absolute;
  top: calc(100% + 6px);
  left: 0;
  right: 0;
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 8px;
  box-shadow: 0 8px 24px rgba(0,0,0,0.1);
  padding: 6px;
  z-index: 100;
}
.account-mobile-dropdown-menu.show {
  display: block;
}
.account-mobile-dropdown-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 14px;
  font-size: 0.88rem;
  color: var(--dark);
  text-decoration: none;
  border-radius: 6px;
  transition: background 0.15s;
}
.account-mobile-dropdown-item:hover,
.account-mobile-dropdown-item.active {
  background: var(--pd-ice);
  color: var(--dsh-navy);
  font-weight: 600;
}

@media (max-width: 991px) {
  .account-card {
    padding: 20px 16px;
  }
  .account-stat-box {
    padding: 16px 10px;
  }
  @media (max-width: 991px) {
    body {
      padding-bottom: 64px; /* Space for mobile bottom bar */
    }
  }

  /* Mobile Bottom Navigation Bar */
  .mobile-bottom-nav {
    display: none;
  }
  @media (max-width: 991px) {
    .mobile-bottom-nav {
      display: flex;
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      height: 60px;
      background: #ffffff;
      border-top: 1px solid #e7eae3;
      box-shadow: 0 -3px 16px rgba(0,0,0,0.06);
      z-index: 9990;
      align-items: center;
      justify-content: space-around;
      padding: 0 8px;
    }
    .mobile-bottom-item {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      color: #64748b;
      font-size: 0.68rem;
      font-weight: 500;
      padding: 6px 0;
      position: relative;
      transition: color 0.2s;
      background: none;
      border: none;
      cursor: pointer;
    }
    .mobile-bottom-item i {
      font-size: 1.25rem;
      line-height: 1.2;
      margin-bottom: 2px;
      transition: transform 0.2s;
    }
    .mobile-bottom-item:active i {
      transform: scale(0.9);
    }
    .mobile-bottom-item.active,
    .mobile-bottom-item:hover {
      color: var(--dsh-navy);
      font-weight: 600;
    }
    .mobile-bottom-badge {
      position: absolute;
      top: 3px;
      right: 50%;
      margin-right: -18px;
      background: var(--dsh-navy-light);
      color: #fff;
      font-size: 0.58rem;
      font-weight: 700;
      min-width: 16px;
      height: 16px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0 4px;
      line-height: 1;
    }
    .mobile-bottom-badge.badge-danger {
      background: #dc3545;
    }
  }

  .account-hero {
    padding: 22px 0;
    text-align: center;
  }
  .account-hero .d-flex {
    flex-direction: column;
    text-align: center;
    gap: 10px !important;
  }
}
</style>
<?php echo $__env->yieldPushContent('styles'); ?>

<style>
/* ============================================
   PRELOADER
   ============================================ */
#preloader {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: #fff;
  z-index: 99999;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  transition: opacity 0.5s ease, visibility 0.5s ease;
}
#preloader.hide {
  opacity: 0;
  visibility: hidden;
}
.preloader-logo {
  font-family: 'Cormorant Garamond', serif;
  font-size: 2.6rem;
  font-weight: 300;
  font-style: italic;
  letter-spacing: 3px;
  color: #1a1005;
  margin-bottom: 28px;
  animation: preloaderFade 1s ease infinite alternate;
}
.preloader-logo span {
  color: var(--pd-sapphire);
}
@keyframes preloaderFade {
  from { opacity: 0.4; }
  to   { opacity: 1; }
}
.preloader-diamonds {
  display: flex;
  align-items: center;
  gap: 10px;
}
.preloader-diamond {
  width: 10px;
  height: 10px;
  background: var(--pd-sapphire);
  transform: rotate(45deg);
  animation: preloaderBounce 1.2s ease infinite;
}
.preloader-diamond:nth-child(1) { animation-delay: 0s; }
.preloader-diamond:nth-child(2) { animation-delay: 0.2s; }
.preloader-diamond:nth-child(3) { animation-delay: 0.4s; }
.preloader-diamond:nth-child(4) { animation-delay: 0.6s; }
.preloader-diamond:nth-child(5) { animation-delay: 0.8s; }

@keyframes preloaderBounce {
  0%, 80%, 100% { transform: rotate(45deg) scale(0.6); opacity: 0.4; }
  40%           { transform: rotate(45deg) scale(1.2); opacity: 1; }
}
</style>
</head>
<body>

<!-- Preloader -->
<div id="preloader">
  <?php
    $siteLogo = \App\Models\Setting::get('site_logo', 'logo.png');
    $logoSrc = null;
    if ($siteLogo && file_exists(public_path('uploads/' . $siteLogo))) {
      $logoSrc = asset('uploads/' . $siteLogo);
    } elseif ($siteLogo && file_exists(public_path('uploads/logo/' . $siteLogo))) {
      $logoSrc = asset('uploads/logo/' . $siteLogo);
    } elseif (file_exists(public_path('uploads/logo.png'))) {
      $logoSrc = asset('uploads/logo.png');
    } elseif (file_exists(public_path('uploads/logo/logo.png'))) {
      $logoSrc = asset('uploads/logo/logo.png');
    }
    $siteName = \App\Models\Setting::get('site_name', 'Durable Suitcase House');
  ?>
  <?php if($logoSrc): ?>
    <img src="<?php echo e($logoSrc); ?>" alt="<?php echo e($siteName); ?>" style="height:60px;width:auto;margin-bottom:24px;animation:preloaderFade 1s ease infinite alternate;object-fit:contain;">
  <?php else: ?>
    <div class="preloader-logo"><?php echo e($siteName); ?></div>
  <?php endif; ?>
  <div class="preloader-diamonds">
    <div class="preloader-diamond"></div>
    <div class="preloader-diamond"></div>
    <div class="preloader-diamond"></div>
    <div class="preloader-diamond"></div>
    <div class="preloader-diamond"></div>
  </div>
</div>

<!-- Top Bar -->
<!-- <div class="topbar">
  <div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center">
      <div class="d-none d-md-flex gap-4">
        <span><i class="bi bi-telephone me-1"></i><?php echo e(\App\Models\Setting::get('site_phone', '+92-300-1234567')); ?></span>
        <span><i class="bi bi-envelope me-1"></i><?php echo e(\App\Models\Setting::get('site_email', 'info@ayurnaman.com')); ?></span>
      </div>
      <div class="d-none d-md-flex align-items-center gap-3">
        <?php if(auth()->guard()->check()): ?>
          <a href="<?php echo e(route('account.dashboard')); ?>">My Account</a>
        <?php else: ?>
          <a href="<?php echo e(route('login')); ?>">Login</a>
          <a href="<?php echo e(route('register')); ?>">Register</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div> -->

<!-- Header -->
<header class="site-header" id="siteHeader">

  <!-- Top Announcement Strip (Option 1 Navy & Gold) -->
  <div class="marquee-strip" style="background:#142D4E;border-bottom:1px solid rgba(255,255,255,0.12);padding:9px 0;">
    <div class="marquee-track">
      <div class="marquee-content" style="color:#ffffff;font-size:0.78rem;letter-spacing:1px;font-weight:600;">
        <span><i class="bi bi-award-fill me-1" style="color:#C59A55;"></i> 68+ YEARS OF TRUST &bull; SINCE 1960</span>
        <span><i class="bi bi-shield-check me-1" style="color:#C59A55;"></i> AUTHORIZED DEALER: VIP, AMERICAN TOURISTER, SAFARI, SAMSONITE</span>
        <span><i class="bi bi-truck me-1" style="color:#C59A55;"></i> FREE DELIVERY ON ORDERS ABOVE ₹<?php echo e(number_format(\App\Models\Setting::get('free_shipping_above', 1999))); ?></span>
        <span><i class="bi bi-stars me-1" style="color:#C59A55;"></i> EXCLUSIVE BRIDAL &amp; WEDDING PURSE COLLECTION</span>
        <span><i class="bi bi-geo-alt-fill me-1" style="color:#C59A55;"></i> DHARAMPURA BAZAR, NEAR ANARDANA CHOWK, PATIALA</span>
      </div>
      <!-- Duplicate for seamless loop -->
      <div class="marquee-content" aria-hidden="true" style="color:#ffffff;font-size:0.78rem;letter-spacing:1px;font-weight:600;">
        <span><i class="bi bi-award-fill me-1" style="color:#C59A55;"></i> 68+ YEARS OF TRUST &bull; SINCE 1960</span>
        <span><i class="bi bi-shield-check me-1" style="color:#C59A55;"></i> AUTHORIZED DEALER: VIP, AMERICAN TOURISTER, SAFARI, SAMSONITE</span>
        <span><i class="bi bi-truck me-1" style="color:#C59A55;"></i> FREE DELIVERY ON ORDERS ABOVE ₹<?php echo e(number_format(\App\Models\Setting::get('free_shipping_above', 1999))); ?></span>
        <span><i class="bi bi-stars me-1" style="color:#C59A55;"></i> EXCLUSIVE BRIDAL &amp; WEDDING PURSE COLLECTION</span>
        <span><i class="bi bi-geo-alt-fill me-1" style="color:#C59A55;"></i> DHARAMPURA BAZAR, NEAR ANARDANA CHOWK, PATIALA</span>
      </div>
    </div>
  </div>

  
  <div class="header-row1">
    <div class="header-row1-inner">

      
      <div class="mobile-header-actions d-lg-none order-last">
        <button type="button" class="mobile-header-btn" id="mobileSearchToggleBtn" aria-label="Search" onclick="toggleMobileSearch()">
          <i class="bi bi-search" id="mobileSearchToggleIcon" style="font-size:1.15rem;"></i>
        </button>
        <button class="mobile-header-btn" id="mobileMenuBtn" aria-label="Menu" onclick="openMobileMenu()">
          <i class="bi bi-list" style="font-size:1.65rem;"></i>
        </button>
      </div>

      
      <a href="<?php echo e(route('home')); ?>" class="site-logo">
        <?php
          $logoUrl = null;
          if (file_exists(public_path('images/logo.png'))) {
            $logoUrl = asset('images/logo.png');
          } elseif (file_exists(public_path('Durable Suitcase House Logo.png'))) {
            $logoUrl = asset('Durable Suitcase House Logo.png');
          }
          $siteName = \App\Models\Setting::get('site_name', 'Durable Suitcase House');
        ?>
        <?php if($logoUrl): ?>
          <img src="<?php echo e($logoUrl); ?>" alt="<?php echo e($siteName); ?>" class="site-header-logo-img">
        <?php else: ?>
          <span class="site-logo-fallback">
            <span class="logo-pacific" style="color:var(--dsh-navy);font-size:1.15rem;font-weight:800;letter-spacing:1px;"><?php echo e($siteName); ?></span>
            <small style="font-size:0.65rem;color:var(--dsh-gold);letter-spacing:2px;text-transform:uppercase;font-weight:700;">Since 1960</small>
          </span>
        <?php endif; ?>
      </a>

      
      <div class="header-search-bar d-none d-lg-flex position-relative">
        <form action="<?php echo e(route('search')); ?>" method="GET" class="header-search-form" autocomplete="off">
          <i class="bi bi-search header-search-icon"></i>
          <input type="text" name="q" placeholder="Search suitcases, trolley bags, school bags, handbags, bridal purses..." class="header-search-input live-search-input" id="desktopSearchInput" data-target="desktopSearchResults">
          <button type="button" class="header-search-btn mic-btn" title="Voice Search" onclick="startVoiceSearch('desktopSearchInput', this)">
            <i class="bi bi-mic"></i>
          </button>
        </form>
        <div class="search-results-dropdown" id="desktopSearchResults"></div>
      </div>

      
      <div class="header-icons d-none d-lg-flex">
        <?php if(auth()->guard()->check()): ?>
          <a href="<?php echo e(route('wishlist.index')); ?>" class="header-icon-btn" title="Wishlist">
            <i class="bi bi-heart"></i>
            <span class="wishlist-badge" id="wishlistCount"><?php echo e(auth()->user()->wishlists()->count()); ?></span>
            <span class="header-icon-label">Wishlist</span>
          </a>
          <a href="<?php echo e(route('account.dashboard')); ?>" class="header-icon-btn" title="My Account">
            <i class="bi bi-person"></i>
            <span class="header-icon-label">Account</span>
          </a>
        <?php else: ?>
          <a href="<?php echo e(route('login')); ?>" class="header-icon-btn" title="Login">
            <i class="bi bi-person"></i>
            <span class="header-icon-label">Account</span>
          </a>
        <?php endif; ?>
        <button class="header-icon-btn position-relative" onclick="openCart()" title="Cart">
          <i class="bi bi-bag"></i>
          <span class="cart-badge" id="cartCount">0</span>
          <span class="header-icon-label">Cart</span>
        </button>

        <a href="https://wa.me/919914469211?text=<?php echo e(urlencode('Hi Durable Suitcase House, I have an inquiry.')); ?>" target="_blank" class="header-wa-btn d-none d-xl-inline-flex" title="WhatsApp Enquiry">
          <i class="bi bi-whatsapp"></i>
          <span>Enquire</span>
        </a>
      </div>

    </div>
  </div>

  
  <div class="header-search-mobile d-lg-none" id="mobileSearchBox">
    <form action="<?php echo e(route('search')); ?>" method="GET" class="header-search-form" autocomplete="off">
      <i class="bi bi-search header-search-icon"></i>
      <input type="text" name="q" placeholder="Search suitcases, trolleys, school bags, handbags..." class="header-search-input live-search-input" id="mobileSearchInput" data-target="mobileSearchResults">
      <button type="button" class="header-search-btn mic-btn" title="Voice Search" onclick="startVoiceSearch('mobileSearchInput', this)">
        <i class="bi bi-mic"></i>
      </button>
    </form>
    <div class="search-results-dropdown" id="mobileSearchResults"></div>
  </div>

  
  <?php $menus = \App\Models\Megamenu::active()->with('columns.items','banner')->get(); ?>
  <nav class="header-catnav d-none d-lg-block">
    <div class="header-catnav-inner">
      <ul class="catnav-list">
        <?php $catNavItems = $menus->whereNull('parent_id'); ?>

        <?php $__currentLoopData = $catNavItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $navUrl = $nav->url ? trim($nav->url) : '';
          $currentPath = '/' . ltrim(request()->path(), '/');
          $navPath = parse_url($navUrl, PHP_URL_PATH) ?: $navUrl;
          $navPath = '/' . ltrim($navPath, '/');
          $isActive = false;

          if ($navUrl && $navUrl !== '#') {
            if ($navPath === '/') {
              $isActive = request()->routeIs('home') || $currentPath === '/';
            } elseif ($navPath === '/shop') {
              $isActive = request()->routeIs('shop.index') && !request()->route('slug');
            } else {
              $isActive = ($currentPath === $navPath) || (url()->current() === url($navUrl));
            }
          }
        ?>
        <li class="catnav-item">
          <a href="<?php echo e($nav->url ?? '#'); ?>" target="<?php echo e($nav->target ?? '_self'); ?>" class="catnav-link <?php echo e($isActive ? 'active' : ''); ?>">
            <span class="catnav-text"><?php echo e($nav->title); ?></span>
          </a>

          <?php if($nav->type === 'megamenu'): ?>
          
          <div class="tanishq-megamenu">
            <div class="megamenu-inner-container">
              <div class="megamenu-columns-wrapper">
                <?php $__currentLoopData = $nav->columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mm-column-card">
                  <div class="mm-column-header">
                    <span class="mm-column-title"><?php echo e($column->title); ?></span>
                  </div>
                  <div class="mm-column-items">
                    <?php $__currentLoopData = $column->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($item->url); ?>" class="mm-item-link">
                      <i class="bi <?php echo e($item->icon ?? 'bi-arrow-right-short'); ?> mm-item-ico"></i>
                      <span class="mm-item-txt <?php echo e($item->is_highlighted ? 'highlighted' : ''); ?>"><?php echo e($item->label); ?></span>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <div class="mm-feature-card">
                  <?php
                    $panelImg = asset('images/personbag.png');
                    if ($nav->title === 'Ladies Handbags') {
                      $panelImg = 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=700&q=80&fit=crop';
                    } elseif ($nav->title === 'School Bags') {
                      $panelImg = 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=700&q=80&fit=crop';
                    } elseif ($nav->title === 'Bridal Purse Collection') {
                      $panelImg = 'https://images.unsplash.com/photo-1566150905458-1bf1fc113f0d?w=700&q=80&fit=crop';
                    }
                  ?>
                  <div class="mm-feature-thumb">
                    <img src="<?php echo e($panelImg); ?>" alt="<?php echo e($nav->title); ?>">
                  </div>
                  <div class="mm-feature-info">
                    <span class="mm-feature-badge">AUTHENTIC STORE</span>
                    <h4 class="mm-feature-heading"><?php echo e($nav->title); ?></h4>
                    <a href="<?php echo e($nav->url ?? route('shop.index')); ?>" class="mm-feature-cta">
                      Explore All <i class="bi bi-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </div>

              
              <div class="megamenu-bottom-bar">
                <div class="d-flex align-items-center gap-3">
                  <span class="mm-guarantee-pill"><i class="bi bi-shield-check"></i> 100% Genuine Brands</span>
                  <span class="mm-guarantee-pill"><i class="bi bi-award"></i> Since 1960 in Patiala</span>
                  <span class="mm-guarantee-pill"><i class="bi bi-truck"></i> Free Shipping Available</span>
                </div>
                <a href="<?php echo e($nav->url ?? route('shop.index')); ?>" class="mm-view-all-link">
                  View Full <?php echo e($nav->title); ?> Range <i class="bi bi-chevron-right"></i>
                </a>
              </div>
            </div>
          </div>
          <?php elseif($nav->type === 'dropdown'): ?>
          <div class="dropdown-nav">
            <a href="<?php echo e(route('blog.index')); ?>">Blog</a>
            <a href="<?php echo e(route('contact.index')); ?>">Contact</a>
            <a href="<?php echo e(route('shop.index')); ?>">All Collections</a>
          </div>
          <?php endif; ?>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </ul>
    </div>
  </nav>

</header>

<!-- Search Overlay -->
<!-- Cart Drawer -->
<div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>
<div class="cart-drawer" id="cartDrawer">
  <div class="cart-header">
    <div>
      <h5 class="mb-0" style="font-family:var(--font-serif);">Your Cart</h5>
      <span class="small text-muted" id="cartItemCount">0 items</span>
    </div>
    <button onclick="closeCart()" style="background:none; border:none; font-size:1.5rem; cursor:pointer; color:var(--text);">&times;</button>
  </div>
  <div class="cart-body" id="cartBody">
    <div class="text-center py-5" id="emptyCart">
      <i class="bi bi-bag" style="font-size:3rem; color:var(--border); display:block; margin-bottom:16px;"></i>
      <p class="text-muted">Your cart is empty</p>
      <a href="<?php echo e(route('shop.index')); ?>" class="btn-glamora" style="padding:10px 24px; font-size:0.72rem;" onclick="closeCart()">Shop Now</a>
    </div>
    <div id="cartItems"></div>
  </div>
  <div class="cart-footer">
    <div class="d-flex justify-content-between mb-3">
      <span class="fw-600">Subtotal</span>
      <span class="fw-700" id="cartSubtotal">₨0.00</span>
    </div>
    <div class="d-grid gap-2">
      <a href="<?php echo e(route('cart.index')); ?>" class="btn-outline-glamora justify-content-center" onclick="closeCart()">View Cart</a>
      <a href="<?php echo e(route('checkout.index')); ?>" class="btn-glamora justify-content-center" onclick="closeCart()">Checkout</a>
    </div>
    <p class="text-center text-muted small mt-2 mb-0">
      <i class="bi bi-shield-lock me-1"></i>Secure Checkout
    </p>
  </div>
</div>

<!-- Mobile Nav -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay" onclick="closeMobileMenu()"></div>
<div class="mobile-nav" id="mobileNav">

  <!-- Header -->
  <div class="mobile-nav-header">
    <a href="<?php echo e(route('home')); ?>" class="mobile-nav-logo" onclick="closeMobileMenu()">
      <?php if(!empty($logoUrl)): ?>
        <img src="<?php echo e($logoUrl); ?>" alt="<?php echo e($siteName); ?>" style="height:40px;width:auto;object-fit:contain;">
      <?php else: ?>
        <span style="color:var(--dsh-navy);font-weight:700;font-size:1.1rem;"><?php echo e($siteName); ?></span>
      <?php endif; ?>
    </a>
    <button onclick="closeMobileMenu()" style="background:none;border:none;font-size:1.6rem;color:var(--text);line-height:1;">&times;</button>
  </div>

  <!-- Nav Items -->
  <ul class="list-unstyled mb-0">
    <?php $__currentLoopData = $menus->whereNull('parent_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($menu->type === 'megamenu' || $menu->type === 'dropdown'): ?>
        
        <li class="mobile-nav-item">
          <div class="mobile-nav-link" onclick="toggleMobileDropdown(this)">
            <span>
              <?php echo e($menu->title); ?>

              <?php if($menu->badge_text): ?>
                <span class="nav-badge ms-2" style="background:<?php echo e($menu->badge_color ?? 'var(--gold)'); ?>"><?php echo e($menu->badge_text); ?></span>
              <?php endif; ?>
            </span>
            <span class="mobile-dropdown-arrow"><i class="bi bi-chevron-down"></i></span>
          </div>
          <ul class="mobile-sub list-unstyled mb-0">
            <?php if($menu->type === 'megamenu'): ?>
              <?php $__currentLoopData = $menu->columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($col->title): ?>
                  <li class="mobile-sub-header"><?php echo e($col->title); ?></li>
                <?php endif; ?>
                <?php $__currentLoopData = $col->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><a href="<?php echo e($item->url); ?>" onclick="closeMobileMenu()"><?php echo e($item->label); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
          </ul>
        </li>
      <?php else: ?>
        
        <li class="mobile-nav-item">
          <a href="<?php echo e($menu->url ?? '#'); ?>" class="mobile-nav-link" onclick="closeMobileMenu()">
            <span>
              <?php echo e($menu->title); ?>

              <?php if($menu->badge_text): ?>
                <span class="nav-badge ms-2" style="background:<?php echo e($menu->badge_color ?? 'var(--gold)'); ?>"><?php echo e($menu->badge_text); ?></span>
              <?php endif; ?>
            </span>
          </a>
        </li>
      <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <li style="height:1px;background:var(--border);margin:8px 0;"></li>

    
    <?php if(auth()->guard()->check()): ?>
      <li class="mobile-nav-item">
        <a href="<?php echo e(route('account.dashboard')); ?>" class="mobile-nav-link" onclick="closeMobileMenu()">
          <span><i class="bi bi-person me-2 text-gold"></i>My Account</span>
        </a>
      </li>
      <li class="mobile-nav-item">
        <a href="<?php echo e(route('wishlist.index')); ?>" class="mobile-nav-link" onclick="closeMobileMenu()">
          <span><i class="bi bi-heart me-2 text-gold"></i>Wishlist</span>
        </a>
      </li>
      <li class="mobile-nav-item">
        <form method="POST" action="<?php echo e(route('logout')); ?>">
          <?php echo csrf_field(); ?>
          <button type="submit" class="mobile-nav-link w-100" style="border:none;text-align:left;cursor:pointer;">
            <span><i class="bi bi-box-arrow-right me-2 text-gold"></i>Logout</span>
          </button>
        </form>
      </li>
    <?php else: ?>
      <li class="mobile-nav-item">
        <a href="<?php echo e(route('login')); ?>" class="mobile-nav-link" onclick="closeMobileMenu()">
          <span><i class="bi bi-person me-2 text-gold"></i>Login</span>
        </a>
      </li>
      <li class="mobile-nav-item">
        <a href="<?php echo e(route('register')); ?>" class="mobile-nav-link" onclick="closeMobileMenu()">
          <span><i class="bi bi-person-plus me-2 text-gold"></i>Register</span>
        </a>
      </li>
    <?php endif; ?>
  </ul>
</div>

<!-- Flash Messages -->
<?php if(session('success')): ?>
<div style="position:fixed;bottom:24px;right:24px;z-index:9999;max-width:360px;"
     class="alert alert-success alert-dismissible shadow-lg border-0 rounded-3 animate__animated animate__fadeInUp" role="alert">
  <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>
<?php if(session('error')): ?>
<div style="position:fixed;bottom:24px;right:24px;z-index:9999;max-width:360px;"
     class="alert alert-danger alert-dismissible shadow-lg border-0 rounded-3 animate__animated animate__fadeInUp" role="alert">
  <i class="bi bi-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<!-- Main Content -->
<main>
  <?php echo $__env->yieldContent('content'); ?>
</main>

<!-- Footer -->
<footer class="site-footer">
  <div class="container-xl-custom">
    <div class="row g-4 g-lg-5">
      <!-- Brand -->
      <div class="col-lg-4 col-md-6">
        <?php if(!empty($logoUrl)): ?>
          <div class="mb-3">
            <img src="<?php echo e($logoUrl); ?>" alt="<?php echo e($siteName); ?>" style="max-height:64px;max-width:230px;object-fit:contain;background:#fff;padding:6px 12px;border-radius:6px;">
          </div>
        <?php else: ?>
          <div class="footer-brand"><?php echo e($siteName); ?></div>
        <?php endif; ?>
        <p class="footer-desc"><?php echo e(\App\Models\Setting::get('site_description', 'A Legacy of Trust. A Journey Since 1960. Your trusted destination for bags, luggage & travel essentials.')); ?></p>
        <div class="social-links">
          <a href="https://wa.me/919914469211" class="social-link" target="_blank" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
          <a href="tel:9914469211" class="social-link" title="Call Store"><i class="bi bi-telephone"></i></a>
          <a href="mailto:durablesuitcasehouse@gmail.com" class="social-link" title="Email Us"><i class="bi bi-envelope"></i></a>
          <?php $__currentLoopData = ['facebook' => 'bi-facebook', 'instagram' => 'bi-instagram', 'twitter' => 'bi-twitter-x', 'youtube' => 'bi-youtube']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($url = \App\Models\Setting::get("{$platform}_url")): ?>
              <a href="<?php echo e($url); ?>" class="social-link" target="_blank"><i class="bi <?php echo e($icon); ?>"></i></a>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-lg-2 col-md-3 col-6">
        <h6 class="footer-heading">Categories</h6>
        <ul class="footer-links">
          <li><a href="<?php echo e(route('shop.index', ['category' => 'luggage'])); ?>">Luggage &amp; Trolleys</a></li>
          <li><a href="<?php echo e(route('shop.index', ['category' => 'ladies-handbags'])); ?>">Ladies Handbags</a></li>
          <li><a href="<?php echo e(route('shop.index', ['category' => 'school-bags'])); ?>">School Bags</a></li>
          <li><a href="<?php echo e(route('shop.index', ['category' => 'bridal-purse-collection'])); ?>">Bridal Purses</a></li>
          <li><a href="<?php echo e(route('shop.index', ['category' => 'travel-accessories'])); ?>">Travel Accessories</a></li>
          <li><a href="<?php echo e(route('page.show', 'about')); ?>">About Us (Since 1960)</a></li>
        </ul>
      </div>

      <!-- Customer Service -->
      <div class="col-lg-2 col-md-3 col-6">
        <h6 class="footer-heading">Customer Care</h6>
        <ul class="footer-links">
          <li><a href="<?php echo e(route('page.show', 'refund')); ?>">Warranty &amp; Refunds</a></li>
          <li><a href="<?php echo e(route('page.show', 'terms')); ?>">Terms &amp; Conditions</a></li>
          <li><a href="<?php echo e(route('page.show', 'privacy')); ?>">Privacy Policy</a></li>
          <li><a href="<?php echo e(route('contact.index')); ?>">Store Location</a></li>
          <li><a href="<?php echo e(route('account.orders')); ?>">Track Order</a></li>
        </ul>
      </div>

      <!-- Newsletter -->
      <div class="col-lg-4 col-md-6">
        <h6 class="footer-heading">Join Our Heritage Journey</h6>
        <p class="small mb-3" style="color:rgba(255,255,255,0.7);">Subscribe for exclusive brand launches, seasonal luggage discounts, and travel guides.</p>
        <form action="<?php echo e(route('newsletter.subscribe')); ?>" method="POST">
          <?php echo csrf_field(); ?>
          <div class="d-flex">
            <input type="email" name="email" class="newsletter-input" placeholder="Your email address" required>
            <button type="submit" class="newsletter-btn">Subscribe</button>
          </div>
        </form>
        <div class="mt-4">
          <div class="footer-heading mb-2">Store Details</div>
          <div class="small" style="color:rgba(255,255,255,0.7); line-height:1.8;">
            <i class="bi bi-geo-alt me-1 text-gold"></i><?php echo e(\App\Models\Setting::get('site_address', 'Near Anardana Chowk, Dharampura Bazar, Patiala, Punjab - 147001')); ?><br>
            <i class="bi bi-telephone me-1 text-gold"></i><?php echo e(\App\Models\Setting::get('site_phone', '9914469211')); ?> / <?php echo e(\App\Models\Setting::get('site_phone_alt', '9814041822')); ?><br>
            <i class="bi bi-whatsapp me-1 text-gold"></i>WhatsApp: <?php echo e(\App\Models\Setting::get('site_whatsapp', '9914469211')); ?><br>
            <i class="bi bi-envelope me-1 text-gold"></i><?php echo e(\App\Models\Setting::get('site_email', 'durablesuitcasehouse@gmail.com')); ?>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer Bottom -->
  <div class="footer-bottom">
    <div class="container-xl-custom">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <div class="footer-bottom-text text-center text-md-start">
          <span>© <?php echo e(date('Y')); ?> Durable Suitcase House. All rights reserved.</span>
          <span class="d-block d-sm-inline ms-sm-2 mt-1 mt-sm-0 text-white-50">
            Designed &amp; Developed by <a href="https://punjabit.co/" target="_blank" rel="noopener" class="footer-dev-link">punjabit</a>
          </span>
        </div>
        <div class="d-flex gap-3 flex-wrap justify-content-center">
          <a href="<?php echo e(route('page.show', 'privacy')); ?>" class="footer-bottom-text text-decoration-none">Privacy Policy</a>
          <a href="<?php echo e(route('page.show', 'terms')); ?>" class="footer-bottom-text text-decoration-none">Terms of Service</a>
          <a href="<?php echo e(route('page.show', 'refund')); ?>" class="footer-bottom-text text-decoration-none">Refund Policy</a>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Mobile Bottom Navigation Bar (Phone only) -->
<nav class="mobile-bottom-nav d-lg-none" aria-label="Mobile Bottom Navigation">
  <a href="<?php echo e(route('home')); ?>" class="mobile-bottom-item <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">
    <i class="bi bi-house<?php echo e(request()->routeIs('home') ? '-door-fill' : ''); ?>"></i>
    <span>Home</span>
  </a>

  <a href="<?php echo e(route('shop.index')); ?>" class="mobile-bottom-item <?php echo e(request()->routeIs('shop*') ? 'active' : ''); ?>">
    <i class="bi bi-grid<?php echo e(request()->routeIs('shop*') ? '-fill' : ''); ?>"></i>
    <span>Shop</span>
  </a>

  <?php if(auth()->guard()->check()): ?>
    <a href="<?php echo e(route('wishlist.index')); ?>" class="mobile-bottom-item <?php echo e(request()->routeIs('wishlist*') ? 'active' : ''); ?>">
      <i class="bi bi-heart<?php echo e(request()->routeIs('wishlist*') ? '-fill' : ''); ?>"></i>
      <span class="mobile-bottom-badge badge-danger" id="mobileBottomWishlistCount"><?php echo e(auth()->user()->wishlists()->count()); ?></span>
      <span>Wishlist</span>
    </a>

    <a href="<?php echo e(route('account.dashboard')); ?>" class="mobile-bottom-item <?php echo e(request()->routeIs('account*') ? 'active' : ''); ?>">
      <i class="bi bi-person<?php echo e(request()->routeIs('account*') ? '-fill' : ''); ?>"></i>
      <span>Account</span>
    </a>
  <?php else: ?>
    <a href="<?php echo e(route('login')); ?>" class="mobile-bottom-item <?php echo e(request()->routeIs('login') ? 'active' : ''); ?>">
      <i class="bi bi-person"></i>
      <span>Account</span>
    </a>
  <?php endif; ?>

  <button type="button" class="mobile-bottom-item" onclick="openCart()" aria-label="View Cart">
    <i class="bi bi-bag"></i>
    <span class="mobile-bottom-badge" id="mobileBottomCartCount">0</span>
    <span>Cart</span>
  </button>
</nav>

<!-- jQuery & Select2 -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

// ---- Voice Search ----
function startVoiceSearch(inputId, btn) {
  if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
    alert('Your browser does not support voice search. Please use Chrome or Edge.');
    return;
  }

  const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
  const recognition = new SpeechRecognition();
  const input = document.getElementById(inputId);
  const icon  = btn.querySelector('i');

  recognition.lang = 'en-US';
  recognition.continuous = false;
  recognition.interimResults = true;

  // Recording start — pulse animation
  btn.classList.add('mic-recording');
  icon.className = 'bi bi-mic-fill';
  input.placeholder = 'Listening...';

  recognition.onresult = function(event) {
    let transcript = '';
    for (let i = event.resultIndex; i < event.results.length; i++) {
      transcript += event.results[i][0].transcript;
    }
    input.value = transcript;
  };

  recognition.onerror = function(event) {
    stopMic(btn, icon, input);
    if (event.error === 'not-allowed') {
      alert('Microphone access denied. Please allow microphone permission in your browser.');
    }
  };

  recognition.onend = function() {
    stopMic(btn, icon, input);
    // Auto-submit if something was captured
    if (input.value.trim()) {
      input.closest('form').submit();
    }
  };

  recognition.start();

  function stopMic(btn, icon, input) {
    btn.classList.remove('mic-recording');
    icon.className = 'bi bi-mic';
    input.placeholder = inputId === 'desktopSearchInput'
      ? 'Search for gold necklace, diamond rings...'
      : 'Search for gold necklace...';
  }
}

// ---- Header scroll effect ----
window.addEventListener('scroll', () => {
  document.getElementById('siteHeader').classList.toggle('scrolled', window.scrollY > 50);
});

// ---- Live Search with Debounce ----
function debounce(func, wait) {
  let timeout;
  return function(...args) {
    clearTimeout(timeout);
    timeout = setTimeout(() => func.apply(this, args), wait);
  };
}

const searchEndpoint = '<?php echo e(route("search")); ?>';

function performLiveSearch(query, resultsContainer) {
  console.log('[LiveSearch] performLiveSearch called with query:', query, 'Container:', resultsContainer);

  if (!query || query.trim().length < 2) {
    console.log('[LiveSearch] Query too short (< 2 chars), clearing results.');
    resultsContainer.innerHTML = '';
    resultsContainer.classList.remove('show');
    return;
  }

  const url = `${searchEndpoint}?q=${encodeURIComponent(query.trim())}`;
  console.log('[LiveSearch] Fetching from URL:', url);

  fetch(url, {
    headers: {
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest'
    }
  })
  .then(response => {
    console.log('[LiveSearch] Fetch HTTP status:', response.status);
    if (!response.ok) throw new Error('HTTP ' + response.status);
    return response.json();
  })
  .then(data => {
    console.log('[LiveSearch] Received JSON data:', data);

    if (!data.success || !data.products || data.products.length === 0) {
      console.log('[LiveSearch] No products matched.');
      resultsContainer.innerHTML = `
        <div class="p-3 text-center text-muted small">
          <i class="bi bi-search me-1"></i> No products found for "<strong>${escapeCartText(query)}</strong>"
        </div>
      `;
      resultsContainer.classList.add('show');
      return;
    }

    console.log(`[LiveSearch] Rendering ${data.products.length} products to container.`);
    let html = '';
    data.products.slice(0, 6).forEach(product => {
      html += `
        <a href="${escapeCartText(product.url)}" class="search-result-item">
          <img src="${escapeCartText(product.image)}" alt="${escapeCartText(product.name)}" class="search-result-img">
          <div class="flex-grow-1 min-w-0">
            <div class="search-result-title text-truncate">${escapeCartText(product.name)}</div>
            ${product.category ? `<div class="search-result-category">${escapeCartText(product.category)}</div>` : ''}
            <div class="search-result-price">₨${product.sale_price || product.price}</div>
          </div>
        </a>
      `;
    });

    html += `
      <div class="search-result-footer">
        <a href="${searchEndpoint}?q=${encodeURIComponent(query.trim())}">
          View all results for "<strong>${escapeCartText(query)}</strong>" →
        </a>
      </div>
    `;

    resultsContainer.innerHTML = html;
    resultsContainer.classList.add('show');
    console.log('[LiveSearch] Results container updated and .show added successfully.');
  })
  .catch(err => {
    console.error('[LiveSearch] Fetch error:', err);
    resultsContainer.classList.remove('show');
  });
}

function initLiveSearch() {
  const inputs = document.querySelectorAll('.live-search-input');
  console.log('[LiveSearch] Initializing inputs found:', inputs.length);

  inputs.forEach((input, index) => {
    const targetId = input.dataset.target;
    const container = document.getElementById(targetId);
    console.log(`[LiveSearch] Input #${index} (id: ${input.id}) binds to target #${targetId}:`, container);

    if (!container) {
      console.warn(`[LiveSearch] Container #${targetId} not found!`);
      return;
    }

    const debouncedSearch = debounce(function() {
      console.log(`[LiveSearch] Input event fired on #${input.id}, value:`, input.value);
      performLiveSearch(input.value, container);
    }, 300);

    input.addEventListener('input', debouncedSearch);
    input.addEventListener('keyup', debouncedSearch);

    input.addEventListener('focus', function() {
      console.log(`[LiveSearch] Focus on #${input.id}, current value:`, input.value);
      if (input.value.trim().length >= 2) {
        if (container.children.length > 0) {
          container.classList.add('show');
        } else {
          performLiveSearch(input.value, container);
        }
      }
    });
  });
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initLiveSearch);
} else {
  initLiveSearch();
}

// Close search dropdowns when clicking outside
document.addEventListener('click', function(e) {
  if (!e.target.closest('.header-search-bar') && !e.target.closest('.header-search-mobile')) {
    document.querySelectorAll('.search-results-dropdown').forEach(dropdown => {
      dropdown.classList.remove('show');
    });
  }
});

// ---- Megamenu positioning ----
function positionMegamenus() {
  const header = document.getElementById('siteHeader');
  if (!header) return;
  const bottom = Math.round(header.getBoundingClientRect().bottom);
  document.querySelectorAll('.tanishq-megamenu').forEach(mm => {
    mm.style.top = bottom + 'px';
  });
}
window.addEventListener('scroll', positionMegamenus, { passive: true });
window.addEventListener('resize', positionMegamenus);
document.addEventListener('DOMContentLoaded', positionMegamenus);
document.querySelectorAll('.catnav-item').forEach(item => {
  item.addEventListener('mouseenter', positionMegamenus);
});

document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeCart(); } });

// ---- Mobile Search Toggle ----
function toggleMobileSearch() {
  const searchBox = document.getElementById('mobileSearchBox');
  const toggleBtn = document.getElementById('mobileSearchToggleBtn');
  const toggleIcon = document.getElementById('mobileSearchToggleIcon');
  if (!searchBox) return;

  const isShowing = searchBox.classList.toggle('show');
  if (toggleBtn) toggleBtn.classList.toggle('active', isShowing);
  if (toggleIcon) {
    toggleIcon.className = isShowing ? 'bi bi-x-lg' : 'bi bi-search';
  }
  if (isShowing) {
    const input = document.getElementById('mobileSearchInput');
    if (input) setTimeout(() => input.focus(), 100);
  }
}

// ---- Mobile Menu ----
function openMobileMenu() {
  document.getElementById('mobileNav').classList.add('open');
  document.getElementById('mobileMenuOverlay').classList.add('active');
  document.body.style.overflow = 'hidden';
}
function closeMobileMenu() {
  document.getElementById('mobileNav').classList.remove('open');
  document.getElementById('mobileMenuOverlay').classList.remove('active');
  document.body.style.overflow = '';
}

function toggleMobileDropdown(el) {
  const item    = el.closest('.mobile-nav-item');
  const sub     = item.querySelector('.mobile-sub');
  const isOpen  = item.classList.contains('open');

  // Close all other open dropdowns
  document.querySelectorAll('.mobile-nav-item.open').forEach(function(openItem) {
    if (openItem !== item) {
      openItem.classList.remove('open');
      const s = openItem.querySelector('.mobile-sub');
      if (s) { s.style.maxHeight = null; s.classList.remove('open'); }
    }
  });

  // Toggle current
  if (isOpen) {
    item.classList.remove('open');
    if (sub) { sub.style.maxHeight = null; sub.classList.remove('open'); }
  } else {
    item.classList.add('open');
    if (sub) {
      sub.classList.add('open');
      sub.style.maxHeight = sub.scrollHeight + 'px';
    }
  }
}
document.getElementById('mobileMenuBtn').addEventListener('click', openMobileMenu);

// ---- Cart Drawer ----
function openCart() {
  document.getElementById('cartDrawer').classList.add('open');
  document.getElementById('cartOverlay').classList.add('active');
  document.body.style.overflow = 'hidden';
  loadCart();
}
function closeCart() {
  document.getElementById('cartDrawer').classList.remove('open');
  document.getElementById('cartOverlay').classList.remove('active');
  document.body.style.overflow = '';
}

function loadCart() {
  fetch('<?php echo e(route("cart.data")); ?>', { headers: { 'Accept': 'application/json' } })
    .then(response => { if (!response.ok) throw new Error(); return response.json(); })
    .then(data => renderCart(data))
    .catch(() => showToast('Unable to load cart.', 'error'));
}

function escapeCartText(value) {
  return String(value ?? '').replace(/[&<>'"]/g, character => ({
    '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#039;', '"': '&quot;'
  }[character]));
}

function renderCart(data) {
  const emptyCart = document.getElementById('emptyCart');
  const cartItems = document.getElementById('cartItems');
  const itemCount = document.getElementById('cartItemCount');
  const subtotal = document.getElementById('cartSubtotal');
  const cartBadge = document.getElementById('cartCount');
  const mobileCartBadge = document.getElementById('mobileBottomCartCount');
  const items = data.items || [];

  if (cartBadge) cartBadge.textContent = data.count || 0;
  if (mobileCartBadge) mobileCartBadge.textContent = data.count || 0;
  if (itemCount) itemCount.textContent = `${data.count || 0} item${data.count === 1 ? '' : 's'}`;
  if (subtotal) subtotal.textContent = '₨' + Number(data.subtotal || 0).toLocaleString('en-PK', { minimumFractionDigits: 2 });
  if (emptyCart) emptyCart.style.display = items.length ? 'none' : 'block';

  cartItems.innerHTML = items.map(item => `
    <div class="cart-item" data-row-id="${escapeCartText(item.row_id)}">
      <img src="${escapeCartText(item.thumbnail)}" alt="${escapeCartText(item.name)}" class="cart-item-img">
      <div class="flex-grow-1">
        <a href="${escapeCartText(item.slug ? '<?php echo e(url('/product')); ?>/' + item.slug : '#')}" class="small fw-600 d-block">${escapeCartText(item.name)}</a>
        <div class="text-muted small">${item.quantity} × ₨${Number(item.price).toLocaleString('en-PK', { minimumFractionDigits: 2 })}</div>
        <div class="cart-quantity">
          <button type="button" onclick="updateCartItem('${escapeCartText(item.row_id)}', ${item.quantity - 1})" aria-label="Decrease quantity">−</button>
          <span>${item.quantity}</span>
          <button type="button" onclick="updateCartItem('${escapeCartText(item.row_id)}', ${item.quantity + 1})" aria-label="Increase quantity">+</button>
        </div>
        <div class="fw-700 small mt-1">₨${Number(item.total).toLocaleString('en-PK', { minimumFractionDigits: 2 })}</div>
      </div>
      <button type="button" class="cart-item-remove" title="Remove" onclick="removeCartItem('${escapeCartText(item.row_id)}')"><i class="bi bi-trash"></i></button>
    </div>
  `).join('');
}

function updateCartItem(rowId, quantity) {
  if (quantity < 1) {
    removeCartItem(rowId);
    return;
  }

  fetch('<?php echo e(route("cart.update")); ?>', {
    method: 'PATCH',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    },
    body: JSON.stringify({ row_id: rowId, quantity })
  })
    .then(response => { if (!response.ok) throw new Error(); return response.json(); })
    .then(() => loadCart())
    .catch(() => showToast('Unable to update cart quantity.', 'error'));
}

function removeCartItem(rowId) {
  const removeUrl = <?php echo json_encode(route('cart.remove', ['rowId' => '__ROW_ID__']), 512) ?>;
  fetch(removeUrl.replace('__ROW_ID__', encodeURIComponent(rowId)), {
    method: 'DELETE',
    headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
  })
    .then(response => { if (!response.ok) throw new Error(); return response.json(); })
    .then(() => loadCart())
    .catch(() => showToast('Unable to remove cart item.', 'error'));
}

function updateCartCount() {
  fetch('<?php echo e(route("cart.count")); ?>')
    .then(r => r.json())
    .then(d => {
      const badge = document.getElementById('cartCount');
      if (badge) badge.textContent = d.count;
    });
}

// ---- Add to Cart ----
function addToCart(productId, quantity = 1, attributes = {}) {
  fetch('<?php echo e(route("cart.add")); ?>', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
    body: JSON.stringify({ product_id: productId, quantity, attributes })
  })
  .then(r => r.json())
  .then(d => {
    if (d.success) {
      document.getElementById('cartCount').textContent = d.count;
      loadCart();
      showToast(d.message, 'success');
    } else {
      showToast(d.message, 'error');
    }
  });
}

// ---- Wishlist Toggle ----
function toggleWishlist(productId, btn) {
  const wishlistUrl = <?php echo json_encode(route('wishlist.toggle', ['productId' => '__PRODUCT_ID__']), 512) ?>;
  fetch(wishlistUrl.replace('__PRODUCT_ID__', productId), {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': csrfToken,
      'Accept': 'application/json'
    }
  })
  .then(r => {
    if (!r.ok) throw new Error('Wishlist request failed');
    return r.json();
  })
  .then(d => {
    if (d.success) {
      btn.classList.toggle('active', d.wishlisted);
      btn.querySelector('i').className = d.wishlisted ? 'bi bi-heart-fill' : 'bi bi-heart';
      const wishlistCount = document.getElementById('wishlistCount');
      if (wishlistCount) wishlistCount.textContent = d.count;
      showToast(d.message);
    }
  })
  .catch(() => showToast('Unable to update wishlist. Please try again.', 'error'));
}

// ---- Toast Notification ----
function showToast(msg, type = 'success') {
  const toast = document.createElement('div');
  toast.className = `alert alert-${type === 'error' ? 'danger' : 'success'} shadow-lg border-0 rounded-3`;
  toast.style.cssText = 'position:fixed;bottom:24px;right:24px;z-index:99999;max-width:340px;animation:slideInUp 0.3s ease;';
  toast.innerHTML = `<i class="bi bi-${type === 'error' ? 'exclamation' : 'check'}-circle me-2"></i>${msg}`;
  document.body.appendChild(toast);
  setTimeout(() => { toast.style.opacity='0'; toast.style.transition='opacity 0.3s'; setTimeout(() => toast.remove(), 300); }, 3000);
}

// ---- AOS (simple intersection observer) ----
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) { entry.target.classList.add('aos-animate'); }
  });
}, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

document.querySelectorAll('[data-aos]').forEach(el => observer.observe(el));

// Update cart count on page load
document.addEventListener('DOMContentLoaded', updateCartCount);

// Preloader
window.addEventListener('load', function () {
  const preloader = document.getElementById('preloader');
  if (preloader) {
    preloader.classList.add('hide');
    setTimeout(() => preloader.remove(), 600);
  }
});
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>


<?php /**PATH C:\xampp8.2\htdocs\durableattachi\resources\views/frontend/layouts/app.blade.php ENDPATH**/ ?>