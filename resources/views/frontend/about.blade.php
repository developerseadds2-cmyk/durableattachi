@extends('frontend.layouts.app')
@section('title', 'About Us — Durable Suitcase House Since 1960')
@section('meta_description', 'A Legacy of Trust. A Journey Since 1960. Serving generations in Patiala with premium luggage, school bags, ladies handbags & bridal collections.')

@push('styles')
<style>
.about-hero {
  background: linear-gradient(rgba(20,45,78,0.92), rgba(15,33,55,0.95)),
              url('https://images.unsplash.com/photo-1565026057447-bc90a3dceb87?w=1600&q=85&fit=crop') center/cover no-repeat;
  padding: 120px 0 85px;
  position: relative;
}
.stat-card {
  background: var(--dsh-cream);
  padding: 36px 20px;
  text-align: center;
  border-right: 1px solid var(--dsh-cream-dark);
  border-bottom: 1px solid var(--dsh-cream-dark);
  transition: all 0.3s;
}
.stat-card:hover {
  background: #fff;
  box-shadow: 0 8px 30px rgba(0,0,0,0.06);
  transform: translateY(-4px);
}
.stat-number {
  font-family: var(--font-serif);
  font-size: 2.8rem;
  font-weight: 700;
  color: var(--dsh-navy);
  line-height: 1;
  margin-bottom: 8px;
}
.stat-label {
  font-size: 0.74rem;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: var(--dsh-text-muted);
}
.value-card {
  background: #fff;
  padding: 36px 28px;
  border: 1px solid var(--dsh-cream-dark);
  border-radius: 8px;
  height: 100%;
  transition: all 0.3s;
}
.value-card:hover {
  border-color: var(--dsh-gold);
  box-shadow: 0 10px 30px rgba(20,45,78,0.08);
  transform: translateY(-4px);
}
.value-icon {
  width: 54px;
  height: 54px;
  background: var(--dsh-cream);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.4rem;
  color: var(--dsh-navy);
  margin-bottom: 20px;
}
.about-pill {
  display: inline-block;
  padding: 6px 16px;
  border-radius: 30px;
  background: var(--dsh-navy-subtle);
  color: var(--dsh-navy);
  font-size: 0.74rem;
  font-weight: 800;
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-bottom: 14px;
}
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="about-hero">
  <div class="container-xl-custom text-center text-white position-relative" style="z-index:1;">
    <span style="font-size:0.78rem;font-weight:800;letter-spacing:4px;text-transform:uppercase;color:var(--dsh-gold);display:block;margin-bottom:14px;">A Legacy of Trust</span>
    <h1 style="font-family:var(--font-serif);font-size:clamp(2.4rem,5vw,4rem);font-weight:700;margin-bottom:20px;line-height:1.15;">
      A Journey Since 1960<br><em style="color:var(--dsh-gold);font-style:italic;">Durable Suitcase House</em>
    </h1>
    <p style="font-size:1.1rem;color:rgba(255,255,255,0.9);max-width:680px;margin:0 auto 32px;line-height:1.75;">
      Welcome to Durable Suitcase House — a name synonymous with trust, quality, and a passion for travel since 1960 in Patiala.
    </p>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
      <a href="{{ route('shop.index') }}" class="btn-glamora" style="padding:14px 38px;background:var(--dsh-gold);color:var(--dsh-navy-dark);border-color:var(--dsh-gold);font-weight:700;">
        Explore Collections
      </a>
      <a href="{{ route('contact.index') }}" class="btn-outline-glamora" style="padding:14px 38px;color:#fff;border-color:rgba(255,255,255,0.6);">
        Visit Store in Patiala
      </a>
    </div>
  </div>
</section>

{{-- STATS --}}
<section style="padding:0;background:#fff;">
  <div class="container-xl-custom">
    <div class="row g-0">
      @foreach([
        ['64+', 'Years of Trust Since 1960'],
        ['100,000+', 'Happy Families Served'],
        ['100%', 'Genuine Brand Warranties'],
        ['4 Core', 'Luggage, Handbags, School & Bridal']
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
<section style="padding:85px 0;background:#fff;">
  <div class="container-xl-custom">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <div style="border-radius:12px; overflow:hidden; box-shadow:0 12px 36px rgba(20,45,78,0.12);">
          <img src="https://images.unsplash.com/photo-1581553680321-4fffae59fccd?w=800&q=85&fit=crop" alt="Durable Suitcase House Story" style="width:100%;aspect-ratio:4/3;object-fit:cover;display:block;">
        </div>
      </div>
      <div class="col-lg-6">
        <span class="about-pill">Our Legacy</span>
        <h2 style="font-family:var(--font-serif); font-size:2.4rem; color:var(--dsh-navy); line-height:1.2; margin-bottom:18px;">
          Six Decades of Delivering Companions for Every Journey
        </h2>
        <p style="color:var(--dsh-charcoal); line-height:1.8; margin-bottom:18px;">
          With over six decades of experience, we have proudly served generations of customers, helping them find the perfect companions for every journey, every occasion, and every stage of life. What began as a commitment to quality and customer satisfaction has grown into a trusted destination for all your travel and everyday carry essentials.
        </p>
        <p style="color:var(--dsh-charcoal); line-height:1.8; margin-bottom:24px;">
          We deal exclusively in a wide range of <strong>luggage, school bags, ladies’ handbags, bridal purse collections, and travel accessories</strong>, bringing together quality, style, durability, and value under one roof.
        </p>
        <div style="background:var(--dsh-cream); border-left:4px solid var(--dsh-navy); padding:16px 20px; border-radius:0 8px 8px 0;">
          <p class="mb-0 fst-italic" style="color:var(--dsh-navy); font-weight:600;">
            "Since 1960, and for generations to come — your journey is our legacy."
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- CORE OFFERINGS --}}
<section style="padding:80px 0;background:var(--dsh-cream);">
  <div class="container-xl-custom">
    <div class="text-center mb-5">
      <span class="about-pill">What Sets Us Apart</span>
      <h2 style="font-family:var(--font-serif);font-size:2.5rem;font-weight:700;color:var(--dsh-navy);">Everything Under One Roof</h2>
    </div>
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="value-card">
          <div class="value-icon"><i class="bi bi-suitcase-lg"></i></div>
          <h5 style="font-family:var(--font-serif); font-size:1.2rem; font-weight:700; color:var(--dsh-navy); margin-bottom:10px;">Luggage &amp; Trolleys</h5>
          <p style="color:var(--dsh-text-muted); font-size:0.88rem; line-height:1.6; margin:0;">
            Authorized dealer for American Tourister, Samsonite, Safari, VIP, Swiss Military, Gear, Aristocrat, Tommy Hilfiger &amp; Delsey Paris.
          </p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="value-card">
          <div class="value-icon"><i class="bi bi-handbag"></i></div>
          <h5 style="font-family:var(--font-serif); font-size:1.2rem; font-weight:700; color:var(--dsh-navy); margin-bottom:10px;">Ladies Handbags</h5>
          <p style="color:var(--dsh-text-muted); font-size:0.88rem; line-height:1.6; margin:0;">
            Trending totes, shoulder bags, and luxury slings from Aldo, Wrangler, Itti, Magnolia, Sequence, Logos, and Emily Loran.
          </p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="value-card">
          <div class="value-icon"><i class="bi bi-backpack"></i></div>
          <h5 style="font-family:var(--font-serif); font-size:1.2rem; font-weight:700; color:var(--dsh-navy); margin-bottom:10px;">School Bags</h5>
          <p style="color:var(--dsh-text-muted); font-size:0.88rem; line-height:1.6; margin:0;">
            Ergonomic orthopedic backpacks, college bags, and cheerful character packs from Safari, American Tourister, Genie &amp; Gear.
          </p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="value-card">
          <div class="value-icon"><i class="bi bi-stars"></i></div>
          <h5 style="font-family:var(--font-serif); font-size:1.2rem; font-weight:700; color:var(--dsh-navy); margin-bottom:10px;">Bridal Purses</h5>
          <p style="color:var(--dsh-text-muted); font-size:0.88rem; line-height:1.6; margin:0;">
            A huge curated range in bridal and wedding purses, royal zardozi potlis, crystal evening minaudières, and heirloom clutches.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- WHY CHOOSE DURABLE SUITCASE HOUSE --}}
<section style="padding:85px 0;background:var(--dsh-navy);color:#fff;">
  <div class="container-xl-custom">
    <div class="text-center mb-5">
      <span style="font-size:0.75rem;font-weight:800;letter-spacing:4px;text-transform:uppercase;color:var(--dsh-gold);display:block;margin-bottom:12px;">The Durable Promise</span>
      <h2 style="font-family:var(--font-serif);font-size:2.5rem;font-weight:700;color:#fff;">Why Trust Durable Suitcase House?</h2>
    </div>
    <div class="row g-4">
      @foreach([
        ['bi-patch-check', 'Authentic Manufacturer Warranty', 'Every luggage piece from top brands like Safari, American Tourister and VIP carries authentic company warranty support.'],
        ['bi-people', 'Serving Generations of Families', 'Over 60 years of heartfelt relationships with families preparing for weddings, children starting school, and world travelers.'],
        ['bi-award', 'Excellence in Craft & Durability', 'We handpick bags and accessories built to endure the rigors of modern travel and everyday usage.'],
        ['bi-geo-alt', 'Physical Presence in Patiala', 'Visit our established storefront in Dharampura Bazar to experience materials and sizes in person.'],
      ] as $w)
      <div class="col-md-6 col-lg-3">
        <div style="text-align:center;padding:32px 18px;">
          <div style="width:62px;height:62px;background:rgba(197,154,85,0.18);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
            <i class="bi {{ $w[0] }}" style="color:var(--dsh-gold);font-size:1.6rem;"></i>
          </div>
          <h5 style="font-family:var(--font-serif);font-size:1.2rem;font-weight:600;color:#fff;margin-bottom:10px;">{{ $w[1] }}</h5>
          <p style="color:rgba(255,255,255,0.75);font-size:0.86rem;line-height:1.75;margin:0;">{{ $w[2] }}</p>
        </div>
      </div>
      @endforeach
    </div>
    <div class="text-center mt-5">
      <a href="{{ route('shop.index') }}" class="btn-glamora" style="padding:14px 40px;background:var(--dsh-gold);color:var(--dsh-navy-dark);border-color:var(--dsh-gold);font-weight:700;">
        Shop Now <i class="bi bi-arrow-right ms-2"></i>
      </a>
    </div>
  </div>
</section>

@endsection
