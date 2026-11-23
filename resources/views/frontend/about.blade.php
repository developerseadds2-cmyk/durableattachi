@extends('frontend.layouts.app')
@section('title', 'About Us — Ayurnaman')
@section('meta_description', 'Ayurnaman is an Ayurvedic skincare and wellness brand focused on providing quality products for everyday beauty and wellness needs.')

@push('styles')
<style>
.about-hero {
  background: linear-gradient(rgba(11,26,19,0.85), rgba(27,56,43,0.92)),
              url('https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=1600&q=85&fit=crop') center/cover no-repeat;
  padding: 110px 0 80px;
  position: relative;
}
.stat-card {
  background: var(--pd-ice);
  padding: 36px 20px;
  text-align: center;
  border-right: 1px solid var(--border);
  border-bottom: 1px solid var(--border);
  transition: all 0.3s;
}
.stat-card:hover {
  background: #fff;
  box-shadow: 0 8px 30px rgba(0,0,0,0.06);
  transform: translateY(-4px);
}
.stat-number {
  font-family: var(--font-serif);
  font-size: 2.6rem;
  font-weight: 400;
  color: var(--ayur-green-dark);
  line-height: 1;
  margin-bottom: 8px;
}
.stat-label {
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: var(--text-muted);
}
.value-card {
  background: #fff;
  padding: 36px 28px;
  border: 1px solid var(--border);
  border-radius: 8px;
  height: 100%;
  transition: all 0.3s;
}
.value-card:hover {
  border-color: var(--ayur-green);
  box-shadow: 0 10px 30px rgba(27,56,43,0.08);
  transform: translateY(-4px);
}
.value-icon {
  width: 52px;
  height: 52px;
  background: var(--pd-ice);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.3rem;
  color: var(--ayur-green);
  margin-bottom: 20px;
}
.about-pill {
  display: inline-block;
  padding: 6px 16px;
  border-radius: 30px;
  background: rgba(27,56,43,0.08);
  color: var(--ayur-green-dark);
  font-size: 0.72rem;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-bottom: 12px;
}
@media (max-width: 768px) {
  .about-hero {
    padding: 70px 0 50px;
  }
}
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="about-hero">
  <div class="container-xl-custom text-center text-white position-relative" style="z-index:1;">
    <span style="font-size:0.75rem;font-weight:700;letter-spacing:4px;text-transform:uppercase;color:var(--ayur-gold);display:block;margin-bottom:14px;">About Ayurnaman</span>
    <h1 style="font-family:var(--font-serif);font-size:clamp(2.2rem,5vw,3.8rem);font-weight:400;margin-bottom:18px;line-height:1.15;">
      Everyday Ayurvedic Skincare<br><em style="color:var(--ayur-gold);font-style:italic;">&amp; Natural Wellness</em>
    </h1>
    <p style="font-size:1.05rem;color:rgba(255,255,255,0.85);max-width:620px;margin:0 auto 30px;line-height:1.75;">
      Ayurnaman is a skincare and wellness brand focused on providing quality products for everyday beauty and wellness needs.
    </p>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
      <a href="{{ route('shop.index') }}" class="btn-glamora" style="padding:13px 36px;">Explore Products</a>
      <a href="{{ route('contact.index') }}" class="btn-outline-glamora" style="padding:13px 36px;color:#fff;border-color:rgba(255,255,255,0.5);">Contact Us</a>
    </div>
  </div>
</section>

{{-- STATS --}}
<section style="padding:0;background:#fff;">
  <div class="container-xl-custom">
    <div class="row g-0">
      @foreach([
        ['100%', 'Pure & Herbal Actives'],
        ['10,000+', 'Happy Customers'],
        ['100%', 'Customer Satisfaction'],
        ['Safe & Gentle', 'Everyday Self-Care']
      ] as $s)
      <div class="col-6 col-md-3">
        <div class="stat-card">
          <div class="stat-number">{{ $s[0] }}</div>
          <div class="stat-label">{{ $s[1] }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- OUR STORY --}}
<section style="padding:80px 0;background:#fff;">
  <div class="container-xl-custom">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6" data-aos="fade-right">
        <div style="position:relative; border-radius:12px; overflow:hidden; box-shadow:0 12px 36px rgba(0,0,0,0.08);">
          <img src="{{ asset('images/about.png') }}" onerror="this.src='https://images.unsplash.com/photo-1608248597359-009f4b97ea30?w=700&q=85&fit=crop'" alt="Ayurnaman Wellness" style="width:100%;aspect-ratio:4/3;object-fit:cover;display:block;">
        </div>
      </div>
      <div class="col-lg-6" data-aos="fade-left">
        <span class="about-pill">About Us</span>
        <h2 class="section-title" style="text-align:left;font-size:2.4rem;color:var(--ayur-green-dark);line-height:1.2;margin-bottom:16px;">
          Nurturing Health,<br>Simplifying Everyday Wellness
        </h2>
        <div class="divider-gold" style="margin:16px 0;margin-left:0;"></div>
        <p class="text-muted mb-3" style="line-height:1.85;font-size:0.95rem;">
          <strong>Ayurnaman</strong> is a skincare and wellness brand focused on providing quality products for everyday beauty and wellness needs.
        </p>
        <p class="text-muted mb-3" style="line-height:1.85;font-size:0.95rem;">
          Our aim is to offer carefully developed products with a focus on quality, customer satisfaction and a better self-care experience.
        </p>
        <p class="text-muted mb-4" style="line-height:1.85;font-size:0.95rem;">
          We believe in making skincare and wellness accessible through quality products and a customer-friendly shopping experience.
        </p>
        <div class="d-flex gap-4 mt-3">
          @foreach([['bi-flower2','Pure Herbal Actives'],['bi-shield-check','Quality Assured'],['bi-heart','Customer-First Service']] as $v)
          <div class="text-center">
            <div style="width:50px;height:50px;background:var(--pd-ice);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 8px;">
              <i class="bi {{ $v[0] }}" style="color:var(--ayur-green);font-size:1.25rem;"></i>
            </div>
            <div style="font-size:0.75rem;font-weight:700;color:var(--ayur-green-dark);">{{ $v[1] }}</div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- MISSION & VALUES --}}
<section style="padding:80px 0;background:var(--pd-ice);">
  <div class="container-xl-custom">
    <div class="text-center mb-5" data-aos="fade-up">
      <span class="about-pill">Our Commitment</span>
      <h2 class="section-title" style="color:var(--ayur-green-dark);">Brand Mission &amp; Core Values</h2>
      <div class="divider-gold"></div>
    </div>
    <div class="row g-4">
      @foreach([
        ['bi-bullseye','Brand Mission','To provide quality skincare and wellness products and build customer trust through quality and service.'],
        ['bi-stars','Quality Assurance','Our aim is to offer carefully developed products with an uncompromising focus on quality, safe formulations, and efficacy.'],
        ['bi-heart-pulse','Everyday Beauty & Wellness','Crafting holistic daily self-care solutions that support your vitality, skin health, and radiant natural glow.'],
        ['bi-cart-check','Accessible Self-Care','We believe in making skincare and wellness accessible through quality products and a seamless, customer-friendly shopping experience.'],
        ['bi-hand-thumbs-up','Customer Trust & Satisfaction','Putting customer satisfaction at the heart of everything we do with transparent service, attentive care, and reliable support.'],
        ['bi-leaf','Authentic Botanicals','Utilizing time-tested herbal ingredients and pure botanical extracts to bring you gentle, dependable, and wholesome care.'],
      ] as $v)
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
        <div class="value-card">
          <div class="value-icon"><i class="bi {{ $v[0] }}"></i></div>
          <h5 style="font-family:var(--font-serif);font-size:1.2rem;font-weight:600;color:var(--ayur-green-dark);margin-bottom:10px;">{{ $v[1] }}</h5>
          <p class="text-muted small mb-0" style="line-height:1.75;">{{ $v[2] }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- WHY CHOOSE AYURNAMAN --}}
<section style="padding:80px 0;background:var(--ayur-green-dark);">
  <div class="container-xl-custom">
    <div class="text-center mb-5">
      <span style="font-size:0.75rem;font-weight:700;letter-spacing:4px;text-transform:uppercase;color:var(--ayur-gold);display:block;margin-bottom:12px;">Why Us</span>
      <h2 style="font-family:var(--font-serif);font-size:2.5rem;font-weight:400;color:#fff;">Why Choose Ayurnaman?</h2>
    </div>
    <div class="row g-4">
      @foreach([
        ['bi-patch-check', 'Carefully Developed Formulations', 'Every product is thoughtfully formulated with premium Ayurvedic herbs for dependable, everyday wellness results.'],
        ['bi-shield-check', 'Customer Trust & Care', 'Building lasting relationships through attentive customer service, transparent communication, and genuine care.'],
        ['bi-truck', 'Fast & Reliable Shipping', 'Prompt packaging and nationwide delivery to bring fresh Ayurvedic care directly to your doorstep.'],
        ['bi-arrow-repeat', 'Customer Satisfaction', 'We take pride in our formulations. Enjoy a smooth, reliable shopping experience with dedicated assistance.'],
      ] as $w)
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
        <div style="text-align:center;padding:32px 20px;">
          <div style="width:60px;height:60px;background:rgba(212,175,55,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
            <i class="bi {{ $w[0] }}" style="color:var(--ayur-gold);font-size:1.4rem;"></i>
          </div>
          <h5 style="font-family:var(--font-serif);font-size:1.2rem;font-weight:500;color:#fff;margin-bottom:10px;">{{ $w[1] }}</h5>
          <p style="color:rgba(255,255,255,0.7);font-size:0.85rem;line-height:1.75;margin:0;">{{ $w[2] }}</p>
        </div>
      </div>
      @endforeach
    </div>
    <div class="text-center mt-5">
      <a href="{{ route('shop.index') }}" class="btn-glamora" style="padding:14px 40px;background:var(--ayur-gold);color:#0b1a13;border-color:var(--ayur-gold);font-weight:700;">Shop Ayurnaman Products</a>
    </div>
  </div>
</section>

@endsection
