@extends('frontend.layouts.app')
@section('title', \App\Models\Setting::get('site_name', 'Durable Suitcase House') . ' — Luggage, Handbags & Travel Essentials Since 1960')

@push('styles')
<style>
/* ============================================================
   CINEMATIC SCROLL-DRIVEN HERO SECTION
   ============================================================ */
:root {
  --hero-bg-deep: var(--dsh-navy-dark, #0F2137);
  --hero-bg-charcoal: var(--dsh-navy, #142D4E);
  --hero-gold: var(--dsh-gold, #C59A55);
  --hero-gold-bright: #D4AF37;
  --hero-gold-glow: rgba(197, 154, 85, 0.35);
  --hero-cream: var(--dsh-cream, #F7F3E8);
  --hero-silver: #E5DEC9;
}

/* ============================================================
   DESKTOP CINEMATIC SCROLL-DRIVEN HERO (GSAP SCROLLTRIGGER PINNED)
   ============================================================ */
.cinematic-hero-wrapper {
  position: relative;
  width: 100%;
  height: 200vh;
  background: var(--dsh-navy-dark, #0F2137);
  overflow: visible;
}

.cinematic-hero-viewport {
  position: sticky;
  top: 130px;
  left: 0;
  width: 100%;
  height: calc(100vh - 130px);
  min-height: 520px;
  max-height: 700px;
  overflow: hidden;
  background: var(--dsh-navy-dark, #0F2137);
  display: flex;
  align-items: center;
  justify-content: center;
}

/* ============================================================
   MOBILE STANDALONE HERO CAROUSEL (d-lg-none)
   Zero scroll pinning, instant swipe, native Swiper arrows & dots
   ============================================================ */
.mobile-hero-slider-wrap {
  display: none;
}

@media (max-width: 991px) {
  .mobile-hero-slider-wrap {
    display: block;
    position: relative;
    width: 100%;
    background: #0F2137;
    overflow: hidden;
  }
  .mobile-hero-swiper {
    width: 100%;
    height: 56.25vw; /* 16:9 standard */
    min-height: 200px;
    max-height: 320px;
    position: relative;
  }
  .mobile-slide-box {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #0F2137;
    overflow: hidden;
  }
  .mobile-slide-bg-blur {
    position: absolute;
    inset: -10px;
    width: calc(100% + 20px);
    height: calc(100% + 20px);
    object-fit: cover;
    filter: blur(20px) brightness(0.6);
    opacity: 0.6;
    pointer-events: none;
  }
  .mobile-slide-img {
    position: relative;
    width: 100%;
    height: 100%;
    object-fit: contain;
    object-position: center;
    z-index: 1;
  }
  .mobile-slide-card {
    position: absolute;
    bottom: 12px;
    left: 12px;
    right: 12px;
    z-index: 5;
    background: linear-gradient(135deg, rgba(11, 14, 18, 0.88) 0%, rgba(15, 33, 55, 0.85) 100%);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border: 1px solid rgba(197, 154, 85, 0.4);
    border-radius: 8px;
    padding: 6px 12px;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.6);
  }
  .mobile-slide-card-text {
    flex: 1;
    min-width: 0;
  }
  .mobile-slide-tag {
    color: var(--dsh-gold-bright, #D4AF37);
    font-size: 0.52rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    font-weight: 700;
    display: block;
    line-height: 1.1;
    margin-bottom: 2px;
  }
  .mobile-slide-title {
    font-family: var(--font-serif);
    font-size: 0.78rem;
    font-weight: 700;
    color: #ffffff;
    line-height: 1.15;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .mobile-slide-title-gold {
    color: var(--dsh-gold-bright, #D4AF37);
  }
  .mobile-slide-sub {
    display: none; /* Hide multi-line paragraph on phone so banner is completely visible */
  }
  .mobile-slide-btn {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.62rem;
    font-weight: 700;
    text-transform: uppercase;
    text-decoration: none;
    white-space: nowrap;
    flex-shrink: 0;
  }
  .mobile-swiper-prev,
  .mobile-swiper-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 20;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: rgba(15, 33, 55, 0.75);
    border: 1px solid var(--dsh-gold, #C59A55);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
  }
  .mobile-swiper-prev { left: 6px; }
  .mobile-swiper-next { right: 6px; }
  .mobile-swiper-pagination {
    position: absolute;
    bottom: auto !important;
    top: 8px !important;
    right: 12px !important;
    left: auto !important;
    width: auto !important;
    display: flex;
    justify-content: flex-end;
    gap: 5px;
    z-index: 20;
  }
  .mobile-swiper-pagination .swiper-pagination-bullet {
    width: 5px;
    height: 5px;
    background: rgba(255, 255, 255, 0.4);
    opacity: 1;
    transition: all 0.2s ease;
  }
  .mobile-swiper-pagination .swiper-pagination-bullet-active {
    background: var(--dsh-gold, #C59A55);
    box-shadow: 0 0 6px var(--dsh-gold);
    transform: scale(1.3);
  }
}

@media (max-width: 576px) {
  .mobile-hero-swiper {
    height: 56.25vw;
    min-height: 190px;
    max-height: 240px;
  }
  .mobile-slide-card {
    bottom: 8px;
    left: 8px;
    right: 8px;
    padding: 5px 10px;
  }
  .mobile-slide-title {
    font-size: 0.74rem;
  }
  .mobile-slide-btn {
    padding: 4px 9px;
    font-size: 0.58rem;
  }
}

/* Ambient Film Grain & Vignette - Clean, high contrast */
.cinematic-vignette {
  position: absolute;
  inset: 0;
  pointer-events: none;
  z-index: 10;
  background: linear-gradient(to bottom, rgba(15, 33, 55, 0.25) 0%, transparent 12%, transparent 88%, rgba(15, 33, 55, 0.35) 100%);
}

/* Individual Scene Canvas */
.hero-scene {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  will-change: transform, opacity;
  background: #0F2137;
}

/* Blurred ambient background mirror for zero edge cut-off on ultra-wide / tall displays */
.hero-scene-bg-blur {
  position: absolute;
  inset: -20px;
  width: calc(100% + 40px);
  height: calc(100% + 40px);
  object-fit: cover;
  filter: blur(28px) brightness(0.6);
  opacity: 0.65;
  pointer-events: none;
}

.hero-scene-bg {
  position: relative;
  width: 100%;
  height: 100%;
  object-fit: contain;
  object-position: center center;
  filter: brightness(0.98) contrast(1.04);
  will-change: transform, opacity;
  z-index: 1;
}

/* Golden luxury atmosphere glow */
.scene-atmosphere-glow {
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 60% 40%, rgba(197, 154, 85, 0.1) 0%, transparent 65%);
  mix-blend-mode: screen;
  pointer-events: none;
  z-index: 2;
}

/* Scene 1 Elements */
.scene-1-content {
  position: relative;
  z-index: 15;
  text-align: center;
  max-width: 900px;
  padding: 0 24px;
}

.hero-pill-tag {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 8px 22px;
  border-radius: 50px;
  background: rgba(197, 154, 85, 0.12);
  border: 1px solid rgba(197, 154, 85, 0.4);
  color: var(--hero-gold-bright);
  font-size: 0.8rem;
  letter-spacing: 3.5px;
  text-transform: uppercase;
  font-weight: 700;
  margin-bottom: 24px;
  backdrop-filter: blur(8px);
}
.hero-pill-tag::before {
  content: '';
  display: inline-block;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: var(--hero-gold-bright);
  box-shadow: 0 0 10px var(--hero-gold-bright);
}

.cinematic-headline-1 {
  font-family: var(--font-serif);
  font-size: clamp(2.8rem, 6.5vw, 5.5rem);
  font-weight: 700;
  color: #ffffff;
  line-height: 1.08;
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-bottom: 20px;
  text-shadow: 0 15px 40px rgba(0,0,0,0.8);
}
.cinematic-headline-1 em {
  font-style: italic;
  color: var(--hero-gold-bright);
  font-weight: 400;
}

.cinematic-sub-1 {
  font-size: clamp(1.1rem, 2vw, 1.4rem);
  color: rgba(247, 243, 232, 0.9);
  font-weight: 300;
  letter-spacing: 1px;
  margin-bottom: 34px;
}

/* Scene 2 Elements */
.scene-2-content {
  position: relative;
  z-index: 15;
  text-align: center;
  max-width: 860px;
  padding: 0 24px;
}

.cinematic-headline-2 {
  font-family: var(--font-serif);
  font-size: clamp(2.6rem, 6vw, 5.2rem);
  font-weight: 700;
  color: #ffffff;
  line-height: 1.1;
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-bottom: 18px;
  text-shadow: 0 15px 45px rgba(0,0,0,0.9);
}

.cinematic-badge-gold {
  color: var(--hero-gold-bright);
  font-size: 0.82rem;
  letter-spacing: 4px;
  text-transform: uppercase;
  font-weight: 700;
  margin-bottom: 16px;
  display: block;
}

/* Scene 3 & 4 (Traveler & Dynamic Synchronized Text) */
.scene-traveler-bg {
  position: relative;
  width: 100%;
  height: 100%;
  object-fit: contain;
  object-position: center center;
  filter: brightness(0.98) contrast(1.04);
  will-change: transform;
  z-index: 1;
}

/* Right-positioned text column (for Scene 3 SikhTravelerat) */
.scene-text-column-right {
  position: absolute;
  top: 50%;
  right: 5%;
  transform: translateY(-50%);
  width: 90%;
  max-width: 500px;
  z-index: 20;
  text-align: left;
  display: flex;
  flex-direction: column;
  gap: 12px;
  padding: 26px 30px;
  background: rgba(11, 14, 18, 0.78);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1.5px solid rgba(197, 154, 85, 0.35);
  border-radius: 14px;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

/* Left-positioned text column (for Scene 4 Bridal Panorama) */
.scene-text-column-left {
  position: absolute;
  top: 50%;
  left: 5%;
  transform: translateY(-50%);
  width: 90%;
  max-width: 500px;
  z-index: 20;
  text-align: left;
  display: flex;
  flex-direction: column;
  gap: 12px;
  padding: 26px 30px;
  background: rgba(11, 14, 18, 0.78);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1.5px solid rgba(197, 154, 85, 0.35);
  border-radius: 14px;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

/* Clean base transition without media query override conflict */

.story-line {
  font-family: var(--font-serif);
  font-size: clamp(1.6rem, 2.8vw, 2.4rem);
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: #ffffff;
  line-height: 1.2;
  margin: 0;
  opacity: 0;
  transform: translateX(-30px);
  transition: all 0.25s ease;
}

.story-line.active {
  opacity: 1;
  transform: translateX(0);
}

.story-line-gold {
  color: var(--hero-gold-bright);
}

.story-supporting {
  font-size: 0.95rem;
  color: rgba(247, 243, 232, 0.85);
  font-weight: 400;
  line-height: 1.5;
  letter-spacing: 0.5px;
  border-top: 1px solid rgba(197, 154, 85, 0.25);
  padding-top: 14px;
  margin-top: 4px;
  opacity: 0;
  transform: translateY(15px);
}

.hero-cta-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  background: var(--dsh-navy, #142D4E);
  color: #ffffff !important;
  border: 2px solid var(--dsh-navy, #142D4E);
  padding: 13px 32px;
  border-radius: 50px;
  font-weight: 700;
  font-size: 0.88rem;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  text-decoration: none;
  box-shadow: 0 6px 18px rgba(20, 45, 78, 0.2);
  transition: all 0.25s ease;
  margin-top: 6px;
  width: fit-content;
  opacity: 0;
  transform: translateY(15px);
}
.hero-cta-btn:hover {
  background: var(--dsh-gold-dark, #A97E3B);
  border-color: var(--dsh-gold-dark, #A97E3B);
  color: #ffffff !important;
  transform: translateY(-2px);
  box-shadow: 0 10px 24px rgba(169, 126, 59, 0.3);
}
.hero-cta-btn:hover {
  transform: translateY(-3px) scale(1.02);
  box-shadow: 0 15px 40px rgba(229, 185, 111, 0.6);
  color: #000;
}

/* Scroll Indicator Bar */
.scroll-progress-hud {
  position: absolute;
  bottom: 28px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 25;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  pointer-events: none;
}
.scroll-pill-track {
  width: 140px;
  height: 3px;
  background: rgba(255, 255, 255, 0.15);
  border-radius: 10px;
  overflow: hidden;
}
.scroll-pill-bar {
  width: 0%;
  height: 100%;
  background: var(--hero-gold-bright);
  box-shadow: 0 0 8px var(--hero-gold-bright);
}
.scroll-hud-text {
  font-size: 0.68rem;
  letter-spacing: 3px;
  text-transform: uppercase;
  color: rgba(247, 243, 232, 0.65);
  font-weight: 600;
}

/* Scene step markers */
.scene-step-dots {
  position: absolute;
  left: 36px;
  top: 50%;
  transform: translateY(-50%);
  z-index: 25;
  display: flex;
  flex-direction: column;
  gap: 14px;
}
.step-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.25);
  transition: all 0.3s ease;
}
.step-dot.active {
  background: var(--hero-gold-bright);
  box-shadow: 0 0 12px var(--hero-gold-bright);
  transform: scale(1.4);
}

@media (max-width: 991px) {
  .scene-step-dots { display: none; }
}

/* ============================================================
   EDITORIAL SECTIONS STYLING
   ============================================================ */
.category-editorial-section {
  padding: 85px 0;
  background: var(--dsh-cream-light, #FCFBF7);
  color: var(--dsh-charcoal, #333333);
}
.editorial-header {
  text-align: center;
  max-width: 980px;
  margin: 0 auto 55px;
}
.editorial-subtitle {
  font-size: 0.8rem;
  letter-spacing: 3.5px;
  text-transform: uppercase;
  color: var(--dsh-gold-dark, #A97E3B);
  font-weight: 800;
  margin-bottom: 12px;
  display: block;
}
.editorial-title {
  font-family: var(--font-serif);
  font-size: clamp(2rem, 3.2vw, 2.9rem);
  font-weight: 700;
  color: var(--dsh-navy, #142D4E);
  letter-spacing: 0.5px;
  white-space: nowrap;
}

.editorial-cat-card {
  position: relative;
  border-radius: 16px;
  overflow: hidden;
  height: 420px;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  padding: 32px 26px;
  text-decoration: none;
  border: 2px solid var(--dsh-cream-dark, #E5DEC9);
  transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
  background: #ffffff;
  box-shadow: 0 10px 30px rgba(20, 45, 78, 0.08);
}
.editorial-cat-card:hover {
  transform: translateY(-8px);
  border-color: var(--dsh-gold, #C59A55);
  box-shadow: 0 20px 45px rgba(20, 45, 78, 0.18);
}
.editorial-cat-img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
}
.editorial-cat-card:hover .editorial-cat-img {
  transform: scale(1.06);
}
.editorial-cat-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(15, 33, 55, 0.88) 0%, rgba(15, 33, 55, 0.45) 40%, rgba(15, 33, 55, 0.08) 70%, transparent 100%);
  z-index: 1;
}
.editorial-cat-content {
  position: relative;
  z-index: 2;
}
.editorial-cat-title {
  font-family: var(--font-serif);
  font-size: 1.75rem;
  font-weight: 700;
  color: #ffffff;
  margin-bottom: 8px;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
  letter-spacing: 0.5px;
}
.editorial-cat-brands {
  font-size: 0.88rem;
  font-weight: 500;
  color: #F7F3E8;
  margin-bottom: 16px;
  line-height: 1.5;
  text-shadow: 0 1px 4px rgba(0, 0, 0, 0.6);
}
.editorial-cat-link {
  font-size: 0.82rem;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #D4AF37;
  font-weight: 800;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(15, 33, 55, 0.6);
  padding: 8px 16px;
  border-radius: 30px;
  border: 1.5px solid #C59A55;
  backdrop-filter: blur(8px);
  transition: all 0.25s ease;
}
.editorial-cat-card:hover .editorial-cat-link {
  background: #C59A55;
  color: #0F2137;
  border-color: #C59A55;
  padding-left: 20px;
  padding-right: 20px;
}

/* ============================================================
   OUR TRUSTED BRANDS - THREE-ROW INFINITE CAROUSEL
   ============================================================ */
.brands-showcase-section {
  padding: 60px 0;
  background: var(--dsh-cream, #F7F3E8);
  border-top: 1.5px solid rgba(197, 154, 85, 0.25);
  border-bottom: 1.5px solid rgba(197, 154, 85, 0.25);
  overflow: hidden;
  position: relative;
}

.brands-header {
  text-align: center;
  max-width: 680px;
  margin: 0 auto 36px;
  padding: 0 20px;
}
.brands-subtitle {
  font-family: var(--font-sans, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif);
  font-size: 0.8rem;
  letter-spacing: 3.5px;
  text-transform: uppercase;
  color: var(--dsh-gold-dark, #A97E3B);
  font-weight: 800;
  margin-bottom: 10px;
  display: block;
}
.brands-title {
  font-family: var(--font-serif, "Playfair Display", Georgia, serif);
  font-size: clamp(2.1rem, 3.8vw, 2.9rem);
  font-weight: 700;
  color: var(--dsh-navy, #142D4E);
  margin-bottom: 10px;
  letter-spacing: 0.5px;
}
.brands-desc {
  font-family: var(--font-sans, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif);
  font-size: 1.02rem;
  color: var(--dsh-charcoal, #333333);
  margin: 0 auto;
  line-height: 1.6;
}

/* Infinite Marquee Rows */
.brands-carousel-container {
  width: 100%;
  position: relative;
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding: 10px 0;
  /* Subtle edge gradient fade mask for premium look */
  -webkit-mask-image: linear-gradient(to right, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 8%, rgba(0,0,0,1) 92%, rgba(0,0,0,0) 100%);
  mask-image: linear-gradient(to right, rgba(0,0,0,0) 0%, rgba(0,0,0,1) 8%, rgba(0,0,0,1) 92%, rgba(0,0,0,0) 100%);
}

.brands-marquee-row {
  display: flex;
  overflow: hidden;
  user-select: none;
  width: 100%;
  padding: 10px 0;
}

.brands-track {
  display: flex;
  gap: 20px;
  width: max-content;
  flex-shrink: 0;
  will-change: transform;
  align-items: center;
}

/* Row 1: Right to Left (25s) */
.brands-marquee-row[data-direction="rtl-1"] .brands-track {
  animation: marquee-rtl 25s linear infinite;
}

/* Row 2: Left to Right (30s) */
.brands-marquee-row[data-direction="ltr-2"] .brands-track {
  animation: marquee-ltr 30s linear infinite;
}

/* Row 3: Right to Left (35s) */
.brands-marquee-row[data-direction="rtl-3"] .brands-track {
  animation: marquee-rtl 35s linear infinite;
}

/* Hover on row pauses that specific track */
.brands-marquee-row:hover .brands-track {
  animation-play-state: paused !important;
}

/* Global pause toggle via accessible button or container state */
.brands-carousel-container.is-paused .brands-track {
  animation-play-state: paused !important;
}

/* Keyframes */
@keyframes marquee-rtl {
  0% { transform: translate3d(0, 0, 0); }
  100% { transform: translate3d(-50%, 0, 0); }
}

@keyframes marquee-ltr {
  0% { transform: translate3d(-50%, 0, 0); }
  100% { transform: translate3d(0, 0, 0); }
}

/* Brand Card Design */
.brand-card-item {
  width: 240px;
  height: 100px;
  flex-shrink: 0;
  background: #ffffff;
  border: 1.5px solid rgba(197, 154, 85, 0.4);
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 16px 24px;
  text-decoration: none;
  box-shadow: 0 4px 16px rgba(20, 45, 78, 0.05);
  transition: transform 0.28s cubic-bezier(0.165, 0.84, 0.44, 1), 
              box-shadow 0.28s cubic-bezier(0.165, 0.84, 0.44, 1), 
              border-color 0.28s ease, 
              background-color 0.28s ease;
  cursor: pointer;
  position: relative;
  z-index: 1;
}

.brand-card-item:hover {
  transform: translateY(-6px) scale(1.02);
  border-color: #C59A55;
  box-shadow: 0 12px 28px rgba(197, 154, 85, 0.25), 0 0 0 1px #C59A55;
  background: #ffffff;
  z-index: 5;
}

.brand-card-logo-wrap {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.brand-card-logo {
  max-width: 100%;
  max-height: 52px;
  width: auto;
  height: auto;
  object-fit: contain;
  transition: transform 0.28s ease;
  display: block;
}

.brand-card-item:hover .brand-card-logo {
  transform: scale(1.05);
}

/* Fallback Typography if logo is text */
.brand-card-text {
  font-family: var(--font-serif, "Playfair Display", Georgia, serif);
  font-size: 1.15rem;
  font-weight: 700;
  color: var(--dsh-navy, #142D4E);
  letter-spacing: 1px;
}

/* Accessible Pause / Play Control */
.brands-control-wrap {
  text-align: center;
  margin-top: 28px;
}
.brands-pause-toggle {
  background: #ffffff;
  border: 1px solid rgba(197, 154, 85, 0.45);
  color: var(--dsh-navy, #142D4E);
  padding: 6px 18px;
  border-radius: 24px;
  font-size: 0.82rem;
  font-weight: 600;
  letter-spacing: 0.8px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
  box-shadow: 0 2px 8px rgba(20, 45, 78, 0.05);
  transition: all 0.2s ease;
}
.brands-pause-toggle:hover {
  background: var(--dsh-navy, #142D4E);
  color: #ffffff;
  border-color: var(--dsh-navy, #142D4E);
}

/* Respect reduced motion */
@media (prefers-reduced-motion: reduce) {
  .brands-track {
    animation-play-state: paused !important;
  }
}

/* Tablet adjustments */
@media (max-width: 991px) {
  .brands-showcase-section {
    padding: 50px 0;
  }
  .brand-card-item {
    width: 190px;
    height: 85px;
    padding: 12px 18px;
  }
  .brand-card-logo {
    max-height: 44px;
  }
  .brands-track {
    gap: 16px;
  }
  .brands-carousel-container {
    gap: 14px;
  }
}

/* Mobile adjustments */
@media (max-width: 576px) {
  .brands-showcase-section {
    padding: 42px 0;
  }
  .brands-header {
    margin-bottom: 24px;
  }
  .brands-subtitle {
    font-size: 0.72rem;
    letter-spacing: 2.2px;
  }
  .brands-title {
    font-size: 1.65rem;
  }
  .brands-desc {
    font-size: 0.88rem;
  }
  .brand-card-item {
    width: 148px;
    height: 72px;
    padding: 10px 14px;
    border-radius: 6px;
  }
  .brand-card-logo {
    max-height: 36px;
  }
  .brands-track {
    gap: 12px;
  }
  .brands-carousel-container {
    gap: 12px;
  }
  .brands-control-wrap {
    margin-top: 18px;
  }
}

/* Customer Testimonials - Rich Navy Heritage Section */
.testimonials-section {
  padding: 95px 0;
  background: var(--dsh-navy, #142D4E);
  color: #ffffff;
  position: relative;
  overflow: hidden;
}
.testimonials-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 80% 20%, rgba(197, 154, 85, 0.12) 0%, transparent 60%);
  pointer-events: none;
}
.testimonial-card-styled {
  background: rgba(255, 255, 255, 0.06);
  border: 1.5px solid rgba(197, 154, 85, 0.3);
  border-radius: 16px;
  padding: 32px 28px;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
  position: relative;
}
.testimonial-card-styled:hover {
  transform: translateY(-6px);
  background: rgba(255, 255, 255, 0.1);
  border-color: var(--dsh-gold, #C59A55);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
}
.testimonial-stars {
  color: #f59e0b;
  font-size: 1.05rem;
  letter-spacing: 2px;
  margin-bottom: 14px;
}
.testimonial-quote {
  font-size: 0.95rem;
  line-height: 1.7;
  color: rgba(247, 243, 232, 0.92);
  margin-bottom: 24px;
  font-style: italic;
  position: relative;
}
.testimonial-author-wrap {
  display: flex;
  align-items: center;
  gap: 14px;
  padding-top: 16px;
  border-top: 1px solid rgba(255, 255, 255, 0.12);
}
.testimonial-author-avatar {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: linear-gradient(135deg, #C59A55, #936427);
  color: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 1rem;
  flex-shrink: 0;
  box-shadow: 0 4px 10px rgba(0,0,0,0.25);
}
.testimonial-author-name {
  font-weight: 700;
  color: #ffffff;
  font-size: 0.95rem;
  margin-bottom: 2px;
}
.testimonial-author-loc {
  font-size: 0.78rem;
  color: var(--dsh-gold-bright, #D4AF37);
  display: flex;
  align-items: center;
  gap: 4px;
}
.testimonial-verified-badge {
  color: #22c55e;
  font-size: 0.82rem;
}
.testimonials-google-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  padding: 6px 16px;
  border-radius: 50px;
  font-size: 0.85rem;
  font-weight: 600;
  color: #ffffff;
  margin-bottom: 12px;
}
  color: rgba(247, 243, 232, 0.85);
  line-height: 1.7;
  margin: 0;
}

/* Section Title Heritage Elements */
.section-header-heritage {
  max-width: 720px;
  margin: 0 auto 48px;
}
.section-label-heritage {
  display: inline-block;
  font-size: 0.8rem;
  letter-spacing: 3.5px;
  text-transform: uppercase;
  color: var(--dsh-gold-dark, #A97E3B);
  font-weight: 800;
  margin-bottom: 10px;
}
.section-title-wrap {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
  margin-bottom: 12px;
}
.title-line-heritage {
  height: 2px;
  width: 50px;
  background: var(--dsh-gold, #C59A55);
  display: inline-block;
}
.section-title-heritage {
  font-family: var(--font-serif);
  font-size: clamp(2.2rem, 4vw, 3.2rem);
  font-weight: 700;
  color: var(--dsh-navy, #142D4E);
  margin: 0;
  letter-spacing: 0.5px;
}
.section-sub-heritage {
  font-size: 1rem;
  color: var(--dsh-text-muted, #666666);
  margin: 0;
  line-height: 1.6;
}

/* Store Experience */
.store-experience-section {
  padding: 95px 0;
  background: #ffffff;
  color: var(--dsh-charcoal);
}
.store-img-wrap {
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(197, 154, 85, 0.3);
  box-shadow: 0 25px 60px rgba(0, 0, 0, 0.7);
  position: relative;
}
.store-img-wrap img {
  width: 100%;
  height: auto;
  display: block;
  filter: contrast(1.05) brightness(0.95);
}

/* ============================================================
   RESPONSIVE COMPACT ADJUSTMENTS FOR MOBILE & TABLET
   ============================================================ */
@media (max-width: 991px) {
  .category-editorial-section {
    padding: 55px 0 !important;
  }
  .editorial-header {
    margin: 0 auto 36px !important;
  }
  .editorial-cat-card {
    height: 340px !important;
    padding: 24px 20px !important;
  }
  .trust-editorial-section {
    padding: 60px 0 !important;
  }
  .products-section {
    padding: 60px 0 !important;
  }
  .store-experience-section {
    padding: 60px 0 !important;
  }
}

@media (max-width: 576px) {
  .category-editorial-section {
    padding: 40px 0 !important;
  }
  .editorial-header {
    margin: 0 auto 28px !important;
  }
  .editorial-subtitle {
    font-size: 0.7rem !important;
    letter-spacing: 2.2px !important;
    margin-bottom: 8px !important;
  }
  .editorial-title {
    font-size: clamp(1.22rem, 5.4vw, 1.55rem) !important;
    letter-spacing: 0.3px !important;
    white-space: nowrap !important;
  }
  .editorial-header p {
    font-size: 0.88rem !important;
    margin-top: 8px !important;
  }
  .editorial-cat-card {
    height: 250px !important;
    padding: 18px 16px !important;
    border-radius: 12px !important;
  }
  .editorial-cat-title {
    font-size: 1.25rem !important;
    margin-bottom: 4px !important;
  }
  .editorial-cat-brands {
    font-size: 0.74rem !important;
    line-height: 1.35 !important;
    margin-bottom: 10px !important;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .editorial-cat-link {
    font-size: 0.72rem !important;
    padding: 5px 12px !important;
    letter-spacing: 1px !important;
  }
  
  /* Heritage Strip on Mobile */
  .heritage-strip {
    padding: 24px 0 !important;
  }
  .heritage-strip .heritage-badge-card {
    height: 100% !important;
    min-height: 140px !important;
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    justify-content: center !important;
    text-align: center !important;
    padding: 16px 10px !important;
    gap: 8px !important;
  }
  .heritage-strip .heritage-badge-card > div:first-child {
    width: 44px !important;
    height: 44px !important;
    font-size: 1.25rem !important;
    margin: 0 auto !important;
  }
  .heritage-strip .heritage-badge-card .badge-title {
    font-size: 0.88rem !important;
    font-weight: 800 !important;
    margin-bottom: 2px !important;
  }
  .heritage-strip .heritage-badge-card .badge-desc {
    font-size: 0.72rem !important;
    line-height: 1.3 !important;
    display: block !important;
  }

  /* Featured products section on Mobile */
  .products-section {
    padding: 42px 0 !important;
  }
  .section-header-heritage {
    margin-bottom: 28px !important;
  }
  .section-label-heritage {
    font-size: 0.7rem !important;
    letter-spacing: 2px !important;
  }
  .section-title-heritage {
    font-size: 1.6rem !important;
  }
  .title-line-heritage {
    width: 25px !important;
  }
  .section-sub-heritage {
    font-size: 0.84rem !important;
  }

  /* Trust Editorial section on Mobile */
  .trust-editorial-section {
    padding: 42px 0 !important;
  }
  .trust-card {
    padding: 20px 18px !important;
    border-radius: 12px !important;
  }
  .trust-card-icon {
    width: 46px !important;
    height: 46px !important;
    font-size: 1.3rem !important;
    margin-bottom: 14px !important;
  }
  .trust-card-title {
    font-size: 1.15rem !important;
    margin-bottom: 8px !important;
  }
  .trust-card-text {
    font-size: 0.82rem !important;
    line-height: 1.55 !important;
  }

  /* Store Experience on Mobile */
  .store-experience-section {
    padding: 42px 0 !important;
  }
  .store-experience-section h2 {
    font-size: 1.65rem !important;
    margin-bottom: 14px !important;
  }
  .store-experience-section p {
    font-size: 0.86rem !important;
    line-height: 1.55 !important;
    margin-bottom: 20px !important;
  }
  .store-experience-section .p-4,
  .store-experience-section [style*="padding:24px"] {
    padding: 16px !important;
  }
}
</style>
@endpush

@section('content')

{{-- ============================================================
     1A. MOBILE STANDALONE SLIDER (d-lg-none)
     Native, instant swipe, responsive arrows, zero scroll pin space
     ============================================================ --}}
<div class="mobile-hero-slider-wrap d-lg-none">
  <div class="swiper mobile-hero-swiper" id="mobileHeroSwiper">
    <div class="swiper-wrapper">
      
      {{-- Slide 1: The Store --}}
      <div class="swiper-slide">
        <div class="mobile-slide-box">
          <img src="{{ asset('images/Durable Storefront at Dusk.png') }}" class="mobile-slide-bg-blur" alt="" aria-hidden="true">
          <img src="{{ asset('images/Durable Storefront at Dusk.png') }}" class="mobile-slide-img" alt="Durable Suitcase House Storefront">
        </div>
      </div>

      {{-- Slide 2: The Showroom --}}
      <div class="swiper-slide">
        <div class="mobile-slide-box">
          <img src="{{ asset('images/personbag.png') }}" class="mobile-slide-bg-blur" alt="" aria-hidden="true">
          <img src="{{ asset('images/personbag.png') }}" class="mobile-slide-img" alt="Durable Luggage Showcase">
        </div>
      </div>

      {{-- Slide 3: Traveler & Luggage --}}
      <div class="swiper-slide">
        <div class="mobile-slide-box">
          <img src="{{ asset('images/SikhTravelerat.png') }}" class="mobile-slide-bg-blur" alt="" aria-hidden="true">
          <img src="{{ asset('images/SikhTravelerat.png') }}" class="mobile-slide-img" alt="Traveler with Suitcase">
          <div class="mobile-slide-card">
            <div class="mobile-slide-card-text">
              <span class="mobile-slide-tag">Since 1960 &bull; Patiala</span>
              <h3 class="mobile-slide-title">Travel Light. Explore More.</h3>
            </div>
            <a href="{{ route('shop.index', ['category' => 'luggage']) }}" class="mobile-slide-btn" style="background:var(--dsh-navy, #142D4E); border:1px solid var(--dsh-gold); color:#ffffff !important;">
              Explore &rarr;
            </a>
          </div>
        </div>
      </div>

      {{-- Slide 4: Bridal Purse Collection --}}
      <div class="swiper-slide">
        <div class="mobile-slide-box">
          <img src="{{ asset('images/sliders/Luxurious Bridal Accessories Panorama.png') }}" class="mobile-slide-bg-blur" alt="" aria-hidden="true">
          <img src="{{ asset('images/sliders/Luxurious Bridal Accessories Panorama.png') }}" class="mobile-slide-img" alt="Bridal Purse Collection">
          <div class="mobile-slide-card">
            <div class="mobile-slide-card-text">
              <span class="mobile-slide-tag">Exclusive Wedding Range</span>
              <h3 class="mobile-slide-title">Huge Range in Bridal Purse Collection</h3>
            </div>
            <a href="{{ route('shop.index', ['category' => 'bridal-purse-collection']) }}" class="mobile-slide-btn" style="background:#C59A55; color:#0F2137 !important;">
              Explore &rarr;
            </a>
          </div>
        </div>
      </div>

    </div>

    {{-- Arrows & Pagination for Mobile Swiper --}}
    <div class="mobile-swiper-prev" id="swiperPrevBtn" role="button" aria-label="Previous Slide">
      <i class="bi bi-chevron-left"></i>
    </div>
    <div class="mobile-swiper-next" id="swiperNextBtn" role="button" aria-label="Next Slide">
      <i class="bi bi-chevron-right"></i>
    </div>
    <div class="mobile-swiper-pagination swiper-pagination"></div>
  </div>
</div>

{{-- ============================================================
     1B. DESKTOP CINEMATIC SCROLL-DRIVEN HERO (d-none d-lg-block)
     GSAP ScrollTrigger Pinned Showcase
     ============================================================ --}}
<div class="cinematic-hero-wrapper d-none d-lg-block" id="heroScrollWrapper">
  <div class="cinematic-hero-viewport" id="heroViewport">

    {{-- Ambient Vignette --}}
    <div class="cinematic-vignette"></div>
    <div class="scene-atmosphere-glow"></div>

    {{-- Progress Dots Navigation --}}
    <div class="scene-step-dots">
      <span class="step-dot active" id="dot1"></span>
      <span class="step-dot" id="dot2"></span>
      <span class="step-dot" id="dot3"></span>
      <span class="step-dot" id="dot4"></span>
    </div>

    {{-- SCENE 1: The Storefront (Durableshop.png - Pure Visual, Complete Uncropped) --}}
    <div class="hero-scene" id="heroScene1">
      <img src="{{ asset('images/Durable Storefront at Dusk.png') }}" class="hero-scene-bg-blur" alt="" aria-hidden="true">
      <img src="{{ asset('images/Durable Storefront at Dusk.png') }}" class="hero-scene-bg" id="bgScene1" alt="Durable Suitcase House Storefront">
    </div>

    {{-- SCENE 2: The Showroom / Suitcase (personbag.png - Pure Visual, Complete Uncropped) --}}
    <div class="hero-scene" id="heroScene2" style="opacity: 0; pointer-events: none;">
      <img src="{{ asset('images/personbag.png') }}" class="hero-scene-bg-blur" alt="" aria-hidden="true">
      <img src="{{ asset('images/personbag.png') }}" class="hero-scene-bg" id="bgScene2" alt="Durable Luggage Showcase">
    </div>

    {{-- SCENE 3: The Traveler (SikhTravelerat.png - Complete Uncropped, Left Text so Traveler & Suitcase on Right are 100% visible) --}}
    <div class="hero-scene" id="heroScene3" style="opacity: 0; pointer-events: none;">
      <img src="{{ asset('images/SikhTravelerat.png') }}" class="hero-scene-bg-blur" alt="" aria-hidden="true">
      <img src="{{ asset('images/SikhTravelerat.png') }}" class="scene-traveler-bg" id="bgTraveler" alt="Traveler with Suitcase">
      
      {{-- Left Side Synchronized Story Card (Airport lounge background on left, Person & Suitcase on right) --}}
      <div class="scene-text-column-left" id="storyColTraveler">
        <span class="cinematic-badge-gold" style="margin-bottom:6px;">Your Next Journey Starts Here</span>
        <h3 class="story-line story-line-gold" id="traveler1">TRAVEL LIGHT.</h3>
        <h3 class="story-line" id="traveler2">EXPLORE MORE.</h3>
        <h3 class="story-line story-line-gold" id="traveler3">MAKE EVERY JOURNEY COUNT.</h3>
        
        <p class="story-supporting" id="travelerSupporting">
          Premium Luggage. Trusted Brands. Timeless Travel.<br>
          Authorized dealer of VIP, American Tourister, Safari, Samsonite &amp; more.
        </p>
        
        <a href="{{ route('shop.index', ['category' => 'luggage']) }}" class="hero-cta-btn" id="travelerCta" style="background:var(--dsh-navy, #142D4E); border-color:var(--dsh-gold); color:#ffffff !important;">
          EXPLORE LUGGAGE <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>

    {{-- SCENE 4: Luxurious Bridal Accessories Panorama (Huge range in Bridal purse Collection - Left Text) --}}
    <div class="hero-scene" id="heroScene4" style="opacity: 0; pointer-events: none;">
      <img src="{{ asset('images/sliders/Luxurious Bridal Accessories Panorama.png') }}" class="hero-scene-bg-blur" alt="" aria-hidden="true">
      <img src="{{ asset('images/sliders/Luxurious Bridal Accessories Panorama.png') }}" class="scene-traveler-bg" id="bgBridal" alt="Luxurious Bridal Accessories Panorama">
      
      {{-- Left Side Synchronized Bridal Card --}}
      <div class="scene-text-column-left" id="storyColBridal">
        <span class="cinematic-badge-gold" style="margin-bottom:6px;">Exclusive Festive &amp; Wedding</span>
        <h3 class="story-line story-line-gold" id="bridal1" style="font-size:clamp(1.4rem, 2.2vw, 2rem);">HUGE RANGE IN</h3>
        <h3 class="story-line" id="bridal2" style="font-size:clamp(1.4rem, 2.2vw, 2rem);">BRIDAL PURSE</h3>
        <h3 class="story-line story-line-gold" id="bridal3" style="font-size:clamp(1.4rem, 2.2vw, 2rem);">COLLECTION</h3>
        
        <p class="story-supporting" id="bridalSupporting">
          Exquisite handcrafted Zardozi velvet clutches, traditional raw silk potlis, pearl encrusted party boxes, and bridal vanity cases.
        </p>
        
        <a href="{{ route('shop.index', ['category' => 'bridal-purse-collection']) }}" class="hero-cta-btn" id="bridalCta" style="background:#C59A55; border-color:#C59A55; color:#0F2137 !important;">
          EXPLORE BRIDAL PURSES <i class="bi bi-arrow-right"></i>
        </a>
      </div>
    </div>

    {{-- Scroll Indicator HUD --}}
    <div class="scroll-progress-hud">
      <div class="scroll-pill-track">
        <div class="scroll-pill-bar" id="heroProgressBar"></div>
      </div>
      <span class="scroll-hud-text" id="hudStatus">SCROLL TO EXPLORE STORY</span>
    </div>

  </div>
</div>

{{-- ============================================================
     HERITAGE TRUST BADGES STRIP (CRISP WHITE CARDS ON SOFT CREAM)
     ============================================================ --}}
<section class="heritage-strip" style="background:#F4EFE6; border-top:2px solid var(--dsh-cream-dark); border-bottom:2px solid var(--dsh-cream-dark); padding:40px 0;">
  <div class="container-xl-custom">
    <div class="row g-3 g-lg-4 align-items-stretch">
      <div class="col-6 col-lg-3">
        <div class="heritage-badge-card d-flex align-items-center gap-3 p-3 bg-white rounded-3 shadow-sm h-100" style="border:1.5px solid var(--dsh-cream-dark);">
          <div style="width:54px; height:54px; border-radius:50%; background:var(--dsh-navy-subtle); display:flex; align-items:center; justify-content:center; color:var(--dsh-navy); font-size:1.5rem; flex-shrink:0;">
            <i class="bi bi-clock-history"></i>
          </div>
          <div>
            <div class="badge-title" style="font-size:1.02rem; font-weight:800; color:var(--dsh-navy); line-height:1.2;">Since 1960</div>
            <span class="badge-desc" style="font-size:0.82rem; color:var(--dsh-charcoal); font-weight:500;">68+ Years of Trust in Patiala</span>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="heritage-badge-card d-flex align-items-center gap-3 p-3 bg-white rounded-3 shadow-sm h-100" style="border:1.5px solid var(--dsh-cream-dark);">
          <div style="width:54px; height:54px; border-radius:50%; background:var(--dsh-navy-subtle); display:flex; align-items:center; justify-content:center; color:var(--dsh-navy); font-size:1.5rem; flex-shrink:0;">
            <i class="bi bi-shield-check"></i>
          </div>
          <div>
            <div class="badge-title" style="font-size:1.02rem; font-weight:800; color:var(--dsh-navy); line-height:1.2;">100% Genuine</div>
            <span class="badge-desc" style="font-size:0.82rem; color:var(--dsh-charcoal); font-weight:500;">Direct Brand Warranty</span>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="heritage-badge-card d-flex align-items-center gap-3 p-3 bg-white rounded-3 shadow-sm h-100" style="border:1.5px solid var(--dsh-cream-dark);">
          <div style="width:54px; height:54px; border-radius:50%; background:var(--dsh-navy-subtle); display:flex; align-items:center; justify-content:center; color:var(--dsh-navy); font-size:1.5rem; flex-shrink:0;">
            <i class="bi bi-stars"></i>
          </div>
          <div>
            <div class="badge-title" style="font-size:1.02rem; font-weight:800; color:var(--dsh-navy); line-height:1.2;">Bridal &amp; Travel</div>
            <span class="badge-desc" style="font-size:0.82rem; color:var(--dsh-charcoal); font-weight:500;">Luggage, Clutches &amp; Backpacks</span>
          </div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="heritage-badge-card d-flex align-items-center gap-3 p-3 bg-white rounded-3 shadow-sm h-100" style="border:1.5px solid var(--dsh-cream-dark);">
          <div style="width:54px; height:54px; border-radius:50%; background:rgba(37,211,102,0.15); display:flex; align-items:center; justify-content:center; color:#128C7E; font-size:1.5rem; flex-shrink:0;">
            <i class="bi bi-whatsapp"></i>
          </div>
          <div>
            <div class="badge-title" style="font-size:1.02rem; font-weight:800; color:var(--dsh-navy); line-height:1.2;">Instant WhatsApp</div>
            <span class="badge-desc" style="font-size:0.82rem; color:var(--dsh-charcoal); font-weight:500;">Live In-Store Inventory Help</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ============================================================
     2. SHOP BY CATEGORY (STRICTLY FROM NOTE: 4 CORE CATEGORIES)
     ============================================================ --}}
<section class="category-editorial-section" id="categories" style="background:#ffffff; padding:80px 0;">
  <div class="container-xl-custom">
    <div class="editorial-header">
      <span class="editorial-subtitle">Curated Collection</span>
      <h2 class="editorial-title">OUR PRODUCT CATEGORIES</h2>
      <p style="color:var(--dsh-charcoal); font-size:1.05rem; margin-top:14px;">
        Explore authentic branded luggage, stylish ladies handbags, ergonomic school bags, and our exclusive bridal purse collection.
      </p>
    </div>

    @php
      $catLuggage = $categories->firstWhere('slug', 'luggage') ?? \App\Models\Category::where('slug', 'luggage')->first();
      $catHandbags = $categories->firstWhere('slug', 'ladies-handbags') ?? \App\Models\Category::where('slug', 'ladies-handbags')->first();
      $catSchool = $categories->firstWhere('slug', 'school-bags') ?? \App\Models\Category::where('slug', 'school-bags')->first();
      $catBridal = $categories->firstWhere('slug', 'bridal-purse-collection') ?? \App\Models\Category::where('slug', 'bridal-purse-collection')->first();
    @endphp

    <div class="row g-4">
      {{-- 1. Luggage --}}
      <div class="col-12 col-sm-6 col-lg-3">
        <a href="{{ route('shop.index', ['category' => 'luggage']) }}" class="editorial-cat-card">
          <img src="{{ ($catLuggage && $catLuggage->image) ? $catLuggage->image_url : asset('images/personbag.png') }}" class="editorial-cat-img" alt="Luggage">
          <div class="editorial-cat-overlay"></div>
          <div class="editorial-cat-content">
            <h3 class="editorial-cat-title">{{ $catLuggage->name ?? 'Luggage' }}</h3>
            <span class="editorial-cat-link">Shop Luggage &rarr;</span>
          </div>
        </a>
      </div>

      {{-- 2. Ladies Handbags (Dynamic from Category image) --}}
      <div class="col-12 col-sm-6 col-lg-3">
        <a href="{{ route('shop.index', ['category' => 'ladies-handbags']) }}" class="editorial-cat-card">
          <img src="{{ ($catHandbags && $catHandbags->image) ? $catHandbags->image_url : asset('images/Luxury Handbag Marble Display.png') }}" class="editorial-cat-img" alt="Ladies Handbags">
          <div class="editorial-cat-overlay"></div>
          <div class="editorial-cat-content">
            <h3 class="editorial-cat-title">{{ $catHandbags->name ?? 'Ladies Handbags' }}</h3>
            <span class="editorial-cat-link">Shop Handbags &rarr;</span>
          </div>
        </a>
      </div>

      {{-- 3. School Bags --}}
      <div class="col-12 col-sm-6 col-lg-3">
        <a href="{{ route('shop.index', ['category' => 'school-bags']) }}" class="editorial-cat-card">
          <img src="{{ ($catSchool && $catSchool->image) ? $catSchool->image_url : 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=700&q=80&fit=crop' }}" class="editorial-cat-img" alt="School Bags">
          <div class="editorial-cat-overlay"></div>
          <div class="editorial-cat-content">
            <h3 class="editorial-cat-title">{{ $catSchool->name ?? 'School Bags' }}</h3>
            <span class="editorial-cat-link">Shop School Bags &rarr;</span>
          </div>
        </a>
      </div>

      {{-- 4. Bridal Purse Collection --}}
      <div class="col-12 col-sm-6 col-lg-3">
        <a href="{{ route('shop.index', ['category' => 'bridal-purse-collection']) }}" class="editorial-cat-card">
          <img src="{{ ($catBridal && $catBridal->image) ? $catBridal->image_url : asset('images/sliders/Luxurious Bridal Accessories Panorama.png') }}" class="editorial-cat-img" alt="Bridal Purse Collection">
          <div class="editorial-cat-overlay"></div>
          <div class="editorial-cat-content">
            <h3 class="editorial-cat-title">{{ $catBridal->name ?? 'Bridal Purse Collection' }}</h3>
            <span class="editorial-cat-link">Shop Bridal Range &rarr;</span>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>

{{-- ============================================================
     3. NEW ARRIVALS (OPTION 1 RICH NAVY BLUE EDITORIAL SHOWCASE)
     ============================================================ --}}
<section class="products-section" style="background:var(--dsh-navy, #142D4E); padding:95px 0; border-top:2px solid var(--dsh-gold, #C59A55);">
  <div class="container-xl-custom">
    <div class="text-center mb-5">
      <span class="editorial-subtitle" style="color:var(--dsh-gold-bright, #D4AF37);">Fresh Arrivals In Patiala</span>
      <h2 style="font-family:var(--font-serif); font-size:clamp(2.2rem, 4vw, 3rem); font-weight:700; color:#ffffff; margin-bottom:12px;">
        New Season Arrivals
      </h2>
      <p style="color:rgba(247, 243, 232, 0.85); font-size:1.05rem; margin-top:10px; max-width:620px; margin-left:auto; margin-right:auto;">
        Latest polycarbonate trolleys, bridal clutches, and high-capacity travel packs directly from top authorized brands
      </p>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3 g-md-4">
      @forelse($newArrivals->take(10) as $product)
      <div class="col">
        @include('frontend.partials.product-card', ['product' => $product])
      </div>
      @empty
      <div class="col-12 text-center py-5">
        <p style="color:rgba(255,255,255,0.7);">No new arrivals to display.</p>
      </div>
      @endforelse
    </div>

    <div class="text-center mt-5">
      <a href="{{ route('shop.index', ['new_arrival' => 1]) }}" class="hero-cta-btn" style="opacity:1; transform:none; display:inline-flex; background:var(--dsh-gold, #C59A55); border-color:var(--dsh-gold, #C59A55); color:#0F2137 !important;">
        View All New Arrivals <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</section>

{{-- ============================================================
     4. FEATURED COLLECTION (DYNAMIC PRODUCTS + WHATSAPP ENQUIRY)
     ============================================================ --}}
<section class="products-section" style="background:#ffffff; padding:90px 0;">
  <div class="container-xl-custom">
    <div class="section-header-heritage text-center mb-5">
      <span class="section-label-heritage">Handcrafted &amp; Engineered</span>
      <div class="section-title-wrap">
        <span class="title-line-heritage"></span>
        <h2 class="section-title-heritage">Featured Collection</h2>
        <span class="title-line-heritage"></span>
      </div>
      <p class="section-sub-heritage">Top-rated spinner trolley sets, designer leather carryalls, and bridal clutches</p>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3 g-md-4">
      @forelse($featured->take(10) as $product)
      <div class="col">
        @include('frontend.partials.product-card', ['product' => $product])
      </div>
      @empty
      <div class="col-12 text-center py-5">
        <p class="text-muted">No featured products currently available.</p>
      </div>
      @endforelse
    </div>

    <div class="text-center mt-5">
      <a href="{{ route('shop.index') }}" class="hero-cta-btn" style="opacity:1; transform:none; display:inline-flex;">
        Explore All Products <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</section>

{{-- ============================================================
     5. OUR TRUSTED BRANDS – THREE-ROW INFINITE CAROUSEL
     ============================================================ --}}
<section class="brands-showcase-section" id="brands" aria-label="Our Trusted Brands">
  <div class="brands-header">
    <span class="brands-subtitle">DISCOVER OUR BRANDS</span>
    <h2 class="brands-title">Our Trusted Brands</h2>
    <p class="brands-desc">
      Discover iconic brands for every journey and every occasion.
    </p>
  </div>

  @php
    $resolveLogo = function($slug, $fallbackName) {
      // 1. Check exact files provided in public/images/brands/
      foreach (['png', 'webp', 'avif', 'jpg', 'jpeg', 'svg'] as $ext) {
        if (file_exists(public_path('images/brands/' . $slug . '.' . $ext))) {
          return asset('images/brands/' . $slug . '.' . $ext);
        }
      }
      return null;
    };

    $row1 = [
      ['name' => 'American Tourister', 'slug' => 'american-tourister'],
      ['name' => 'Samsonite',          'slug' => 'samsonite'],
      ['name' => 'Kamiliant',          'slug' => 'kamiliant'],
      ['name' => 'Safari',             'slug' => 'safari'],
      ['name' => 'VIP',                'slug' => 'vip'],
      ['name' => 'Swiss Military',     'slug' => 'swiss-military'],
    ];

    $row2 = [
      ['name' => 'Gear',               'slug' => 'gear'],
      ['name' => 'Aristocrat',         'slug' => 'aristocrat'],
      ['name' => 'Tommy Hilfiger',     'slug' => 'tommy-hilfiger'],
      ['name' => 'Delsey Paris',       'slug' => 'delsey-paris'],
      ['name' => 'Wrangler',           'slug' => 'wrangler'],
      ['name' => 'Itti',               'slug' => 'itti'],
    ];

    $row3 = [
      ['name' => 'Aldo',               'slug' => 'aldo'],
      ['name' => 'Magnolia',           'slug' => 'magnolia'],
      ['name' => 'Sequence',           'slug' => 'sequence'],
      ['name' => 'Logos',              'slug' => 'logos'],
      ['name' => 'Emily Loran',        'slug' => 'emily-loran'],
      ['name' => 'Genie',              'slug' => 'genie'],
    ];
  @endphp

  <div class="brands-carousel-container" id="brandsCarouselContainer">
    {{-- Row 1: Right to Left (25s) --}}
    <div class="brands-marquee-row" data-direction="rtl-1" aria-label="Brands Row 1">
      <div class="brands-track">
        @foreach([1, 2] as $repeat)
          @foreach($row1 as $b)
            @php $logoUrl = $resolveLogo($b['slug'], $b['name']); @endphp
            <a href="{{ route('shop.index', ['brand' => $b['slug']]) }}" class="brand-card-item" title="Explore {{ $b['name'] }} Collection">
              <div class="brand-card-logo-wrap">
                @if($logoUrl)
                  <img src="{{ $logoUrl }}" alt="{{ $b['name'] }} Logo" class="brand-card-logo" loading="lazy">
                @else
                  <span class="brand-card-text">{{ $b['name'] }}</span>
                @endif
              </div>
            </a>
          @endforeach
        @endforeach
      </div>
    </div>

    {{-- Row 2: Left to Right (30s) --}}
    <div class="brands-marquee-row" data-direction="ltr-2" aria-label="Brands Row 2">
      <div class="brands-track">
        @foreach([1, 2] as $repeat)
          @foreach($row2 as $b)
            @php $logoUrl = $resolveLogo($b['slug'], $b['name']); @endphp
            <a href="{{ route('shop.index', ['brand' => $b['slug']]) }}" class="brand-card-item" title="Explore {{ $b['name'] }} Collection">
              <div class="brand-card-logo-wrap">
                @if($logoUrl)
                  <img src="{{ $logoUrl }}" alt="{{ $b['name'] }} Logo" class="brand-card-logo" loading="lazy">
                @else
                  <span class="brand-card-text">{{ $b['name'] }}</span>
                @endif
              </div>
            </a>
          @endforeach
        @endforeach
      </div>
    </div>

    {{-- Row 3: Right to Left (35s) --}}
    <div class="brands-marquee-row" data-direction="rtl-3" aria-label="Brands Row 3">
      <div class="brands-track">
        @foreach([1, 2] as $repeat)
          @foreach($row3 as $b)
            @php $logoUrl = $resolveLogo($b['slug'], $b['name']); @endphp
            <a href="{{ route('shop.index', ['brand' => $b['slug']]) }}" class="brand-card-item" title="Explore {{ $b['name'] }} Collection">
              <div class="brand-card-logo-wrap">
                @if($logoUrl)
                  <img src="{{ $logoUrl }}" alt="{{ $b['name'] }} Logo" class="brand-card-logo" loading="lazy">
                @else
                  <span class="brand-card-text">{{ $b['name'] }}</span>
                @endif
              </div>
            </a>
          @endforeach
        @endforeach
      </div>
    </div>
  </div>

  {{-- Accessible Pause / Resume Control --}}
  <div class="brands-control-wrap">
    <button type="button" class="brands-pause-toggle" id="brandsPauseToggle" aria-pressed="false" aria-label="Pause brand carousel animation">
      <i class="bi bi-pause-fill" id="brandsControlIcon"></i>
      <span id="brandsControlText">Pause Animation</span>
    </button>
  </div>
</section>

{{-- ============================================================
     6. CUSTOMER TESTIMONIALS (VOICES OF OUR VALUED PATRONS)
     ============================================================ --}}
<section class="testimonials-section">
  <div class="container-xl-custom position-relative" style="z-index: 2;">
    <div class="editorial-header text-center">
      <div class="testimonials-google-pill mx-auto">
        <i class="fa-brands fa-google text-warning"></i>
        <span>4.9 / 5.0 Star Rating &bull; 1,200+ Happy Travelers</span>
      </div>
      <span class="editorial-subtitle" style="color:var(--dsh-gold-bright, #D4AF37);">Trusted Since 1960</span>
      <h2 class="editorial-title" style="color:#ffffff;">WHAT OUR CUSTOMERS SAY</h2>
      <p style="color:rgba(247, 243, 232, 0.85); font-size:1.05rem; margin-top:14px; max-width:680px; margin-left:auto; margin-right:auto;">
        Real experiences from families, business flyers, and brides across Patiala and Punjab who rely on Durable Suitcase House.
      </p>
    </div>

    <div class="row g-4 mt-2">
      <!-- Testimonial 1 -->
      <div class="col-12 col-md-6 col-lg-3">
        <div class="testimonial-card-styled">
          <div>
            <div class="testimonial-stars">
              <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <p class="testimonial-quote">
              "Purchased an American Tourister 3-piece set for my son's journey to Canada. The staff guided us on exact airline cabin weight rules. Flawless wheels and rock solid build!"
            </p>
          </div>
          <div class="testimonial-author-wrap">
            <div class="testimonial-author-avatar">GS</div>
            <div>
              <div class="testimonial-author-name">Gurpreet Singh</div>
              <div class="testimonial-author-loc">
                <i class="fa-solid fa-location-dot"></i> Patiala &bull; <span class="testimonial-verified-badge"><i class="fa-solid fa-circle-check"></i> Verified</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Testimonial 2 -->
      <div class="col-12 col-md-6 col-lg-3">
        <div class="testimonial-card-styled">
          <div>
            <div class="testimonial-stars">
              <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <p class="testimonial-quote">
              "My family has bought luggage from Durable Suitcase House since my grandfather’s time. Unbeatable authenticity, fair prices, and the best collection of VIP and Safari."
            </p>
          </div>
          <div class="testimonial-author-wrap">
            <div class="testimonial-author-avatar">RK</div>
            <div>
              <div class="testimonial-author-name">Rajesh Kumar</div>
              <div class="testimonial-author-loc">
                <i class="fa-solid fa-location-dot"></i> Model Town &bull; <span class="testimonial-verified-badge"><i class="fa-solid fa-circle-check"></i> Verified</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Testimonial 3 -->
      <div class="col-12 col-md-6 col-lg-3">
        <div class="testimonial-card-styled">
          <div>
            <div class="testimonial-stars">
              <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <p class="testimonial-quote">
              "Their bridal purse and clutch collection is exquisite! Found the exact matching gold embroidery clutch for my wedding lehenga. Truly timeless quality and design."
            </p>
          </div>
          <div class="testimonial-author-wrap">
            <div class="testimonial-author-avatar">SK</div>
            <div>
              <div class="testimonial-author-name">Simran Kaur</div>
              <div class="testimonial-author-loc">
                <i class="fa-solid fa-location-dot"></i> Chandigarh &bull; <span class="testimonial-verified-badge"><i class="fa-solid fa-circle-check"></i> Verified</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Testimonial 4 -->
      <div class="col-12 col-md-6 col-lg-3">
        <div class="testimonial-card-styled">
          <div>
            <div class="testimonial-stars">
              <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <p class="testimonial-quote">
              "Ordered online with express delivery. Received authentic Samsonite trolley in perfect packing within 2 days. The customer service over WhatsApp was super helpful."
            </p>
          </div>
          <div class="testimonial-author-wrap">
            <div class="testimonial-author-avatar">AK</div>
            <div>
              <div class="testimonial-author-name">Amit Khurana</div>
              <div class="testimonial-author-loc">
                <i class="fa-solid fa-location-dot"></i> Ludhiana &bull; <span class="testimonial-verified-badge"><i class="fa-solid fa-circle-check"></i> Verified</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ============================================================
     7. STORE EXPERIENCE (YOUR NEXT JOURNEY STARTS HERE)
     ============================================================ --}}
<section class="store-experience-section" id="store" style="background:#ffffff; padding:95px 0;">
  <div class="container-xl-custom">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <span class="editorial-subtitle" style="color:var(--dsh-gold-dark, #A97E3B);">Physical Showroom</span>
        <h2 style="font-family:var(--font-serif); font-size:clamp(2.4rem, 4vw, 3.6rem); font-weight:700; color:var(--dsh-navy, #142D4E); line-height:1.15; margin-bottom:20px;">
          YOUR NEXT JOURNEY<br>
          <span style="color:var(--dsh-gold-dark, #A97E3B);">STARTS HERE.</span>
        </h2>
        <p style="color:var(--dsh-charcoal, #333333); font-size:1.05rem; line-height:1.75; margin-bottom:28px;">
          Visit our flagship showroom in Dharampura Bazar, Near Anardana Chowk, Patiala. Touch, inspect, test the wheel gliding smoothness, and take home authentic brand travel gear.
        </p>

        <div style="background:#ffffff; border:2px solid var(--dsh-cream-dark); border-left:4px solid var(--dsh-navy, #142D4E); border-radius:12px; padding:24px; margin-bottom:32px; box-shadow:0 8px 24px rgba(20,45,78,0.06);">
          <div class="d-flex align-items-start gap-3 mb-3">
            <i class="bi bi-geo-alt-fill" style="font-size:1.4rem; color:var(--dsh-gold-dark);"></i>
            <div>
              <strong style="color:var(--dsh-navy);">Store Address:</strong><br>
              <span style="color:var(--dsh-charcoal);">Dharampura Bazar, Near Anardana Chowk, Patiala, Punjab &ndash; 147001</span>
            </div>
          </div>
          <div class="d-flex align-items-center gap-3 mb-3">
            <i class="bi bi-telephone-fill" style="font-size:1.4rem; color:var(--dsh-gold-dark);"></i>
            <div>
              <strong style="color:var(--dsh-navy);">Direct Helpline:</strong><br>
              <span style="color:var(--dsh-charcoal);">+91 9914469211 &bull; +91 9814041822</span>
            </div>
          </div>
          <div class="d-flex align-items-center gap-3">
            <i class="bi bi-whatsapp" style="font-size:1.4rem; color:#25D366;"></i>
            <div>
              <strong style="color:var(--dsh-navy);">Instant WhatsApp:</strong><br>
              <span style="color:var(--dsh-charcoal);">Chat with our in-store team for live inventory &amp; product photos</span>
            </div>
          </div>
        </div>

        <div class="d-flex gap-3 flex-wrap">
          <a href="https://wa.me/919914469211?text={{ urlencode('Hi Durable Suitcase House, I would like to enquire about your luggage and bag collection.') }}" target="_blank" class="hero-cta-btn" style="background:#25D366; color:#fff; box-shadow:0 10px 30px rgba(37,211,102,0.35); opacity:1; transform:none; display:inline-flex;">
            <i class="bi bi-whatsapp"></i> Chat On WhatsApp
          </a>
          <a href="https://maps.google.com/?q=Durable+Suitcase+House+Near+Anardana+Chowk+Dharampura+Bazar+Patiala" target="_blank" class="hero-cta-btn" style="background:var(--dsh-navy); border:1px solid var(--dsh-navy); color:#ffffff; box-shadow:none; opacity:1; transform:none; display:inline-flex;">
            <i class="bi bi-geo-alt"></i> Get Directions
          </a>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="store-img-wrap">
          <img src="{{ asset('images/Durable Storefront at Dusk.png') }}" alt="Durable Suitcase House Patiala Showroom">
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Check if GSAP & ScrollTrigger are loaded
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
    console.warn('GSAP or ScrollTrigger not loaded; falling back to static presentation.');
    const s1 = document.getElementById('heroScene1');
    if (s1) s1.style.opacity = '1';
    return;
  }

  gsap.registerPlugin(ScrollTrigger);

  const wrapper = document.getElementById('heroScrollWrapper');
  const viewport = document.getElementById('heroViewport');

  const scene1 = document.getElementById('heroScene1');
  const bgScene1 = document.getElementById('bgScene1');

  const scene2 = document.getElementById('heroScene2');
  const bgScene2 = document.getElementById('bgScene2');

  const scene3 = document.getElementById('heroScene3');
  const bgTraveler = document.getElementById('bgTraveler');
  const storyColTraveler = document.getElementById('storyColTraveler');
  const traveler1 = document.getElementById('traveler1');
  const traveler2 = document.getElementById('traveler2');
  const traveler3 = document.getElementById('traveler3');
  const travelerSupporting = document.getElementById('travelerSupporting');
  const travelerCta = document.getElementById('travelerCta');

  const scene4 = document.getElementById('heroScene4');
  const bgBridal = document.getElementById('bgBridal');
  const storyColBridal = document.getElementById('storyColBridal');
  const bridal1 = document.getElementById('bridal1');
  const bridal2 = document.getElementById('bridal2');
  const bridal3 = document.getElementById('bridal3');
  const bridalSupporting = document.getElementById('bridalSupporting');
  const bridalCta = document.getElementById('bridalCta');

  const dot1 = document.getElementById('dot1');
  const dot2 = document.getElementById('dot2');
  const dot3 = document.getElementById('dot3');
  const dot4 = document.getElementById('dot4');
  const progressBar = document.getElementById('heroProgressBar');
  const hudStatus = document.getElementById('hudStatus');

  // -------------------------------------------------------------
  // 1. MOBILE STANDALONE SWIPER (< 992px)
  // -------------------------------------------------------------
  if (window.innerWidth < 992) {
    if (typeof Swiper !== 'undefined') {
      new Swiper('#mobileHeroSwiper', {
        loop: true,
        speed: 400,
        autoplay: {
          delay: 4500,
          disableOnInteraction: false,
        },
        navigation: {
          nextEl: '#swiperNextBtn',
          prevEl: '#swiperPrevBtn',
        },
        pagination: {
          el: '.mobile-swiper-pagination',
          clickable: true,
        },
      });
    }
    return; // Don't run GSAP ScrollTrigger on mobile
  }

  // -------------------------------------------------------------
  // 2. DESKTOP CINEMATIC GSAP SCROLLTRIGGER (>= 992px)
  // -------------------------------------------------------------
  if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
    return;
  }

  // Initial States for Desktop GSAP ScrollTrigger
  gsap.set(scene1, { opacity: 1, pointerEvents: 'auto' });
  gsap.set(bgScene1, { scale: 1 });

  gsap.set(scene2, { opacity: 0, pointerEvents: 'none' });
  gsap.set(bgScene2, { scale: 1.15, y: 30 });

  gsap.set(scene3, { opacity: 0, pointerEvents: 'none' });
  gsap.set(bgTraveler, { scale: 1.05 });
  gsap.set(storyColTraveler, { opacity: 0, x: -50 });

  gsap.set(scene4, { opacity: 0, pointerEvents: 'none' });
  gsap.set(bgBridal, { scale: 1.05 });
  gsap.set(storyColBridal, { opacity: 0, x: -50 });

  // Pinned GSAP ScrollTrigger Master Timeline (4 Scenes)
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: wrapper,
      start: 'top top',
      end: 'bottom bottom',
      scrub: 1, // Smooth scrub
      onUpdate: (self) => {
        const prog = self.progress;
        if (progressBar) progressBar.style.width = (prog * 100) + '%';

        // Update step dots & HUD
        if (prog < 0.25) {
          if (dot1) dot1.classList.add('active');
          if (dot2) dot2.classList.remove('active');
          if (dot3) dot3.classList.remove('active');
          if (dot4) dot4.classList.remove('active');
          if (hudStatus) hudStatus.textContent = 'SCENE 1: THE STORE';
        } else if (prog < 0.50) {
          if (dot1) dot1.classList.remove('active');
          if (dot2) dot2.classList.add('active');
          if (dot3) dot3.classList.remove('active');
          if (dot4) dot4.classList.remove('active');
          if (hudStatus) hudStatus.textContent = 'SCENE 2: SHOWROOM LUGGAGE';
        } else if (prog < 0.75) {
          if (dot1) dot1.classList.remove('active');
          if (dot2) dot2.classList.remove('active');
          if (dot3) dot3.classList.add('active');
          if (dot4) dot4.classList.remove('active');
          if (hudStatus) hudStatus.textContent = 'SCENE 3: THE TRAVELER';
        } else {
          if (dot1) dot1.classList.remove('active');
          if (dot2) dot2.classList.remove('active');
          if (dot3) dot3.classList.remove('active');
          if (dot4) dot4.classList.add('active');
          if (hudStatus) hudStatus.textContent = 'SCENE 4: BRIDAL PURSE COLLECTION';
        }
      }
    }
  });

  /* -------------------------------------------------------------
     SCENE 1 -> SCENE 2 TRANSITION (0 to ~1.0)
     ------------------------------------------------------------- */
  tl.to(bgScene1, {
    scale: 1.1,
    ease: 'none',
    duration: 1.2
  }, 0)
  .to(scene1, {
    opacity: 0,
    ease: 'power2.inOut',
    duration: 0.6,
    onComplete: () => { if (scene1) scene1.style.pointerEvents = 'none'; }
  }, 0.8);

  /* -------------------------------------------------------------
     SCENE 2 (0.8 to ~2.0)
     ------------------------------------------------------------- */
  tl.to(scene2, {
    opacity: 1,
    ease: 'power2.out',
    duration: 0.6,
    onStart: () => { if (scene2) scene2.style.pointerEvents = 'auto'; }
  }, 0.8)
  .to(bgScene2, {
    scale: 1.0,
    y: 0,
    ease: 'none',
    duration: 1.2
  }, 0.8)
  .to(scene2, {
    opacity: 0,
    ease: 'power2.inOut',
    duration: 0.6,
    onComplete: () => { if (scene2) scene2.style.pointerEvents = 'none'; }
  }, 1.8);

  /* -------------------------------------------------------------
     SCENE 3: Traveler & Story (1.8 to ~3.0) - Right Side Text
     ------------------------------------------------------------- */
  tl.to(scene3, {
    opacity: 1,
    ease: 'power2.out',
    duration: 0.6,
    onStart: () => { if (scene3) scene3.style.pointerEvents = 'auto'; }
  }, 1.8)
  .to(bgTraveler, {
    scale: 1.0,
    ease: 'none',
    duration: 1.2
  }, 1.8)
  .to(storyColTraveler, {
    opacity: 1,
    x: 0,
    ease: 'power2.out',
    duration: 0.6
  }, 2.0)
  .to(traveler1, { opacity: 1, x: 0, ease: 'power2.out', duration: 0.3 }, 2.1)
  .to(traveler2, { opacity: 1, x: 0, ease: 'power2.out', duration: 0.3 }, 2.3)
  .to(traveler3, { opacity: 1, x: 0, ease: 'power2.out', duration: 0.3 }, 2.5)
  .to(travelerSupporting, { opacity: 1, y: 0, ease: 'power2.out', duration: 0.4 }, 2.6)
  .to(travelerCta, { opacity: 1, y: 0, ease: 'power2.out', duration: 0.4 }, 2.7)
  .to(scene3, {
    opacity: 0,
    ease: 'power2.inOut',
    duration: 0.6,
    onComplete: () => { if (scene3) scene3.style.pointerEvents = 'none'; }
  }, 3.0);

  /* -------------------------------------------------------------
     SCENE 4: Bridal Panorama (3.0 to 4.2) - Left Side Text
     ------------------------------------------------------------- */
  tl.to(scene4, {
    opacity: 1,
    ease: 'power2.out',
    duration: 0.6,
    onStart: () => { if (scene4) scene4.style.pointerEvents = 'auto'; }
  }, 3.0)
  .to(bgBridal, {
    scale: 1.0,
    ease: 'none',
    duration: 1.2
  }, 3.0)
  .to(storyColBridal, {
    opacity: 1,
    x: 0,
    ease: 'power2.out',
    duration: 0.6
  }, 3.2)
  .to(bridal1, { opacity: 1, x: 0, ease: 'power2.out', duration: 0.3 }, 3.3)
  .to(bridal2, { opacity: 1, x: 0, ease: 'power2.out', duration: 0.3 }, 3.5)
  .to(bridal3, { opacity: 1, x: 0, ease: 'power2.out', duration: 0.3 }, 3.7)
  .to(bridalSupporting, { opacity: 1, y: 0, ease: 'power2.out', duration: 0.4 }, 3.8)
  .to(bridalCta, { opacity: 1, y: 0, ease: 'power2.out', duration: 0.4 }, 3.9);
});

// Accessible Pause / Resume Toggle for Brands Carousel
document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('brandsCarouselContainer');
  const toggleBtn = document.getElementById('brandsPauseToggle');
  const controlIcon = document.getElementById('brandsControlIcon');
  const controlText = document.getElementById('brandsControlText');

  if (toggleBtn && container) {
    toggleBtn.addEventListener('click', () => {
      const isPaused = container.classList.toggle('is-paused');
      toggleBtn.setAttribute('aria-pressed', isPaused ? 'true' : 'false');
      if (isPaused) {
        controlIcon.className = 'bi bi-play-fill';
        controlText.textContent = 'Resume Animation';
      } else {
        controlIcon.className = 'bi bi-pause-fill';
        controlText.textContent = 'Pause Animation';
      }
    });
  }
});
</script>
@endpush
