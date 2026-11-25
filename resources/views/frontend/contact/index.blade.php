@extends('frontend.layouts.app')
@section('title', 'Contact Us — Durable Suitcase House Patiala Since 1960')
@section('meta_description', 'Get in touch with Durable Suitcase House. Visit our Patiala store near Anardana Chowk, Dharampura Bazar or connect via WhatsApp and phone.')

@push('styles')
<style>
/* Contact Hero Header */
.contact-hero {
  background: linear-gradient(135deg, rgba(20,45,78,0.95) 0%, rgba(15,33,55,0.98) 100%),
              url('https://images.unsplash.com/photo-1565026057447-bc90a3dceb87?w=1600&q=85&fit=crop') center/cover no-repeat;
  padding: 85px 0 65px;
  text-align: center;
  position: relative;
  overflow: hidden;
  color: #fff;
}
.contact-hero-tag {
  font-size: 0.78rem;
  font-weight: 800;
  letter-spacing: 3px;
  text-transform: uppercase;
  color: #C59A55;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 12px;
}
.contact-hero-title {
  font-family: var(--font-serif);
  font-size: clamp(2.2rem, 4.5vw, 3.4rem);
  font-weight: 700;
  margin-bottom: 14px;
  line-height: 1.2;
}
.contact-hero-desc {
  font-size: 1rem;
  color: rgba(255,255,255,0.85);
  max-width: 620px;
  margin: 0 auto;
  line-height: 1.6;
}

/* 4 Quick Info Cards */
.contact-cards-section {
  padding: 50px 0 40px;
  background: #fbf9f4;
  border-bottom: 1px solid #ede8dc;
}
.contact-info-card {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 30px 20px;
  text-align: center;
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  transition: all 0.25s ease;
  box-shadow: 0 2px 10px rgba(0,0,0,0.03);
}
.contact-info-card:hover {
  border-color: #142D4E;
  box-shadow: 0 10px 25px rgba(20,45,78,0.1);
  transform: translateY(-4px);
}
.contact-info-icon {
  width: 58px;
  height: 58px;
  background: #f1f5f9;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 16px;
  transition: all 0.25s ease;
  color: #142D4E;
  font-size: 1.45rem;
}
.contact-info-card:hover .contact-info-icon {
  background: #142D4E;
  color: #ffffff;
}
.contact-info-title {
  font-family: var(--font-serif);
  font-weight: 700;
  color: #142D4E;
  font-size: 1.15rem;
  margin-bottom: 8px;
}
.contact-info-body {
  font-size: 0.88rem;
  color: #64748b;
  line-height: 1.6;
  margin: 0;
  flex: 1;
}

/* Contact Main Section */
.contact-main-section {
  padding: 60px 0 80px;
  background: #ffffff;
}
.contact-form-wrap {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 14px;
  padding: 36px 32px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.04);
}
@media (max-width: 576px) {
  .contact-form-wrap {
    padding: 24px 18px;
  }
}
.contact-section-title {
  font-family: var(--font-serif);
  font-size: 1.75rem;
  font-weight: 700;
  color: #142D4E;
  margin-bottom: 6px;
}
.contact-section-desc {
  color: #64748b;
  font-size: 0.92rem;
  margin-bottom: 24px;
}

.form-label-custom {
  font-size: 0.8rem;
  font-weight: 700;
  letter-spacing: 0.4px;
  text-transform: uppercase;
  color: #142D4E;
  margin-bottom: 6px;
  display: block;
}
.form-control-custom {
  border: 1.5px solid #cbd5e1;
  border-radius: 8px;
  padding: 12px 14px;
  font-size: 0.92rem;
  color: #1e293b;
  transition: all 0.2s;
  width: 100%;
  outline: none;
  background: #ffffff;
}
.form-control-custom:focus {
  border-color: #142D4E;
  background: #fff;
  box-shadow: 0 0 0 3px rgba(20,45,78,0.12);
}

.btn-contact-submit {
  background: #142D4E;
  color: #ffffff;
  border: none;
  border-radius: 8px;
  padding: 14px 36px;
  font-weight: 700;
  font-size: 0.95rem;
  letter-spacing: 0.5px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 4px 14px rgba(20,45,78,0.25);
  transition: all 0.2s;
  cursor: pointer;
}
.btn-contact-submit:hover {
  background: #1e3f6b;
  color: #ffffff;
  transform: translateY(-2px);
  box-shadow: 0 6px 18px rgba(20,45,78,0.3);
}

/* Sidebar Info Card */
.store-sidebar-card {
  background: #fffdf9;
  border: 1.5px solid #f2e9d8;
  border-radius: 14px;
  padding: 34px 28px;
  box-shadow: 0 4px 18px rgba(0,0,0,0.03);
}
@media (max-width: 576px) {
  .store-sidebar-card {
    padding: 24px 18px;
  }
}
.store-sidebar-tag {
  font-size: 0.75rem;
  font-weight: 800;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #b45309;
  display: block;
  margin-bottom: 6px;
}
.store-sidebar-title {
  font-family: var(--font-serif);
  font-size: 1.55rem;
  font-weight: 700;
  color: #142D4E;
  margin-bottom: 14px;
}
.store-sidebar-desc {
  color: #475569;
  font-size: 0.92rem;
  line-height: 1.65;
  margin-bottom: 22px;
}

/* Google Map Embed Container */
.map-embed-wrapper {
  border-radius: 10px;
  overflow: hidden;
  border: 1.5px solid #e2e8f0;
  margin-top: 22px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
.map-embed-wrapper iframe {
  width: 100%;
  height: 220px;
  border: 0;
  display: block;
}
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="contact-hero">
  <div class="container-xl-custom position-relative" style="z-index:1;">
    <div class="contact-hero-tag">
      <i class="bi bi-geo-alt-fill"></i> Visit or Contact Us
    </div>
    <h1 class="contact-hero-title">
      We’re Here for Every Journey
    </h1>
    <p class="contact-hero-desc">
      Have a question regarding luggage sizes, school bags, brand warranties or bridal clutches? Reach out or visit our flagship showroom in Patiala.
    </p>
  </div>
</section>

{{-- 4 CONTACT CARDS --}}
<section class="contact-cards-section">
  <div class="container-xl-custom">
    <div class="row g-3 g-lg-4">
      
      <!-- Store Location -->
      <div class="col-6 col-lg-3">
        <div class="contact-info-card">
          <div class="contact-info-icon"><i class="bi bi-geo-alt-fill"></i></div>
          <h5 class="contact-info-title">Our Store</h5>
          <p class="contact-info-body">
            Near Anardana Chowk, Dharampura Bazar, Patiala, Punjab 147001
          </p>
        </div>
      </div>

      <!-- Phone Numbers -->
      <div class="col-6 col-lg-3">
        <div class="contact-info-card">
          <div class="contact-info-icon"><i class="bi bi-telephone-fill"></i></div>
          <h5 class="contact-info-title">Call Us</h5>
          <p class="contact-info-body">
            <a href="tel:9914469211" class="text-dark fw-bold d-block text-decoration-none">+91 99144 69211</a>
            <a href="tel:9814041822" class="text-muted d-block text-decoration-none">+91 98140 41822</a>
            <a href="tel:9914141822" class="text-muted d-block text-decoration-none">+91 99141 41822</a>
          </p>
        </div>
      </div>

      <!-- WhatsApp Chat -->
      <div class="col-6 col-lg-3">
        <div class="contact-info-card">
          <div class="contact-info-icon" style="color:#25D366; background:#eafaf1;"><i class="bi bi-whatsapp"></i></div>
          <h5 class="contact-info-title">WhatsApp Chat</h5>
          <p class="contact-info-body mb-3">
            Instant help for product photos &amp; color availability.
          </p>
          <a href="https://wa.me/919914469211" target="_blank" class="btn btn-sm" style="background:#25D366; color:#fff; font-weight:700; border-radius:20px; padding:6px 14px; font-size:0.8rem;">
            Chat on WhatsApp
          </a>
        </div>
      </div>

      <!-- Email -->
      <div class="col-6 col-lg-3">
        <div class="contact-info-card">
          <div class="contact-info-icon"><i class="bi bi-envelope-fill"></i></div>
          <h5 class="contact-info-title">Email Us</h5>
          <p class="contact-info-body">
            <a href="mailto:durablesuitcasehouse@gmail.com" class="text-dark text-break fw-500 text-decoration-none">
              durablesuitcasehouse@gmail.com
            </a>
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- FORM & STORE MAP / INFO --}}
<section class="contact-main-section">
  <div class="container-xl-custom">
    
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show mb-4 d-flex align-items-center gap-2" role="alert">
        <i class="bi bi-check-circle-fill fs-5"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div class="row g-4 g-lg-5">
      
      <!-- Left: Contact Form -->
      <div class="col-lg-7">
        <div class="contact-form-wrap">
          <h3 class="contact-section-title">Send Us a Message</h3>
          <p class="contact-section-desc">
            Fill out the form below and our store specialists will get back to you promptly.
          </p>

          <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label-custom">Your Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control-custom" required placeholder="e.g. Ramesh Kumar" value="{{ old('name') }}">
                @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-6">
                <label class="form-label-custom">Email Address <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control-custom" required placeholder="e.g. name@example.com" value="{{ old('email') }}">
                @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-6">
                <label class="form-label-custom">Phone / WhatsApp</label>
                <input type="text" name="phone" class="form-control-custom" placeholder="e.g. 9914469211" value="{{ old('phone') }}">
                @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-6">
                <label class="form-label-custom">Interested Category</label>
                <select name="subject" class="form-control-custom">
                  <option value="Luggage &amp; Trolleys">Luggage &amp; Trolleys</option>
                  <option value="Ladies Handbags">Ladies Handbags</option>
                  <option value="School Bags">School Bags</option>
                  <option value="Bridal Purse Collection">Bridal Purse Collection</option>
                  <option value="General Inquiry">General Inquiry</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label-custom">Message / Inquiry Details <span class="text-danger">*</span></label>
                <textarea name="message" rows="5" class="form-control-custom" required placeholder="Tell us how we can help you with your luggage or purse inquiry...">{{ old('message') }}</textarea>
                @error('message')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
              </div>
              <div class="col-12 mt-4">
                <button type="submit" class="btn-contact-submit">
                  <span>Send Message</span>
                  <i class="bi bi-send"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Right: Showroom & Store Details -->
      <div class="col-lg-5">
        <div class="store-sidebar-card">
          <span class="store-sidebar-tag">Patiala Showroom Since 1960</span>
          <h4 class="store-sidebar-title">Durable Suitcase House</h4>
          <p class="store-sidebar-desc">
            Visit our showroom in Dharampura Bazar to browse through our complete collection of travel gear, luggage sets, school bags, and wedding purse collections in person.
          </p>

          <div class="mb-3">
            <h6 style="color:#142D4E; font-weight:700; font-size:0.95rem; margin-bottom:6px;">
              <i class="bi bi-clock me-2" style="color:#C59A55;"></i>Store Timings:
            </h6>
            <div style="color:#475569; font-size:0.88rem; line-height:1.7;">
              Monday – Saturday: 10:30 AM – 8:30 PM<br>
              Sunday: Open / Festival Hours
            </div>
          </div>

          <div class="mb-3">
            <h6 style="color:#142D4E; font-weight:700; font-size:0.95rem; margin-bottom:6px;">
              <i class="bi bi-patch-check me-2" style="color:#C59A55;"></i>In-Store Services:
            </h6>
            <ul style="color:#475569; font-size:0.86rem; line-height:1.7; padding-left:18px; margin-bottom:0;">
              <li>Genuine brand warranty registration &amp; advice</li>
              <li>Size and weight consultation for international airlines</li>
              <li>Bridal outfit matching for clutches and potlis</li>
              <li>School bag ergonomics &amp; spine-friendly fit checks</li>
            </ul>
          </div>

          <!-- Embedded Map -->
          <div class="map-embed-wrapper">
            <iframe 
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3442.7561848529244!2d76.3888!3d30.3344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391028e938953f97%3A0xb3bfebda689e49b1!2sDharampura%20Bazar%2C%20Patiala%2C%20Punjab%20147001!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade"
              title="Durable Suitcase House Location Map">
            </iframe>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection
