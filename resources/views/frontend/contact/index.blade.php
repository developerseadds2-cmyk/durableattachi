@extends('frontend.layouts.app')
@section('title', 'Contact Us — Durable Suitcase House Patiala')
@section('meta_description', 'Get in touch with Durable Suitcase House. Visit our Patiala store near Anardana Chowk, Dharampura Bazar or connect via WhatsApp and phone.')

@push('styles')
<style>
.contact-hero {
  background: linear-gradient(rgba(20,45,78,0.92), rgba(15,33,55,0.95)),
              url('https://images.unsplash.com/photo-1565026057447-bc90a3dceb87?w=1600&q=85&fit=crop') center/cover no-repeat;
  padding: 100px 0 80px;
  text-align: center;
  position: relative;
  overflow: hidden;
  color: #fff;
}
.contact-info-card {
  background: #fff;
  border: 1.5px solid var(--dsh-cream-dark);
  border-radius: 10px;
  padding: 32px 20px;
  text-align: center;
  height: 100%;
  transition: all 0.3s;
}
.contact-info-card:hover {
  border-color: var(--dsh-navy);
  box-shadow: 0 10px 30px rgba(20,45,78,0.08);
  transform: translateY(-4px);
}
.contact-info-icon {
  width: 60px; height: 60px;
  background: var(--dsh-cream);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 18px;
  transition: all 0.3s;
  color: var(--dsh-navy);
  font-size: 1.5rem;
}
.contact-info-card:hover .contact-info-icon {
  background: var(--dsh-navy);
  color: #fff;
}
.contact-form-wrap {
  background: #fff;
  border: 1.5px solid var(--dsh-cream-dark);
  border-radius: 12px;
  padding: 40px;
}
.form-control-pd {
  border: 1.5px solid var(--dsh-cream-dark);
  border-radius: 6px;
  padding: 12px 16px;
  font-size: 0.92rem;
  color: var(--dsh-charcoal);
  transition: border-color 0.2s;
  width: 100%;
  outline: none;
  background: var(--dsh-cream-light);
}
.form-control-pd:focus {
  border-color: var(--dsh-navy);
  background: #fff;
  box-shadow: 0 0 0 3px rgba(20,45,78,0.1);
}
.form-label-pd {
  font-size: 0.78rem;
  font-weight: 700;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  color: var(--dsh-navy);
  margin-bottom: 6px;
  display: block;
}
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="contact-hero">
  <div class="container-xl-custom position-relative" style="z-index:1;">
    <span style="font-size:0.78rem;font-weight:800;letter-spacing:4px;text-transform:uppercase;color:var(--dsh-gold);display:block;margin-bottom:12px;">Visit or Contact Us</span>
    <h1 style="font-family:var(--font-serif);font-size:clamp(2.4rem,5vw,3.8rem);font-weight:700;margin-bottom:16px;">
      We’re Here for Every Journey
    </h1>
    <p style="font-size:1.05rem;color:rgba(255,255,255,0.85);max-width:600px;margin:0 auto;line-height:1.7;">
      Have a question regarding luggage sizes, school bags, brand warranties or bridal clutches? Reach out or visit our store in Patiala.
    </p>
  </div>
</section>

{{-- CONTACT CARDS --}}
<section style="padding:60px 0; background:var(--dsh-cream-light);">
  <div class="container-xl-custom">
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="contact-info-card">
          <div class="contact-info-icon"><i class="bi bi-geo-alt-fill"></i></div>
          <h5 style="font-family:var(--font-serif); font-weight:700; color:var(--dsh-navy); font-size:1.2rem;">Our Store</h5>
          <p style="font-size:0.86rem; color:var(--dsh-text-muted); line-height:1.6; margin:0;">
            Near Anardana Chowk, Dharampura Bazar, Patiala, Punjab - 147001
          </p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="contact-info-card">
          <div class="contact-info-icon"><i class="bi bi-telephone-fill"></i></div>
          <h5 style="font-family:var(--font-serif); font-weight:700; color:var(--dsh-navy); font-size:1.2rem;">Phone Numbers</h5>
          <p style="font-size:0.86rem; color:var(--dsh-text-muted); line-height:1.6; margin:0;">
            9914469211<br>
            9814041822<br>
            9914141822
          </p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="contact-info-card">
          <div class="contact-info-icon" style="color:#25D366;"><i class="bi bi-whatsapp"></i></div>
          <h5 style="font-family:var(--font-serif); font-weight:700; color:var(--dsh-navy); font-size:1.2rem;">WhatsApp Chat</h5>
          <p style="font-size:0.86rem; color:var(--dsh-text-muted); line-height:1.6; margin-bottom:12px;">
            Fast response for product queries &amp; photos.
          </p>
          <a href="https://wa.me/919914469211" target="_blank" class="btn btn-sm" style="background:#25D366; color:#fff; font-weight:700; border-radius:20px; padding:6px 16px;">
            Chat on WhatsApp
          </a>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="contact-info-card">
          <div class="contact-info-icon"><i class="bi bi-envelope-fill"></i></div>
          <h5 style="font-family:var(--font-serif); font-weight:700; color:var(--dsh-navy); font-size:1.2rem;">Email Us</h5>
          <p style="font-size:0.86rem; color:var(--dsh-text-muted); line-height:1.6; margin:0;">
            durablesuitcasehouse@gmail.com
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- FORM & STORE MAP / INFO --}}
<section style="padding:80px 0; background:#fff;">
  <div class="container-xl-custom">
    <div class="row g-5">
      <div class="col-lg-7">
        <div class="contact-form-wrap">
          <h3 style="font-family:var(--font-serif); font-size:1.8rem; font-weight:700; color:var(--dsh-navy); margin-bottom:8px;">
            Send Us a Message
          </h3>
          <p style="color:var(--dsh-text-muted); font-size:0.92rem; margin-bottom:28px;">
            Fill out the form below and our team will get back to you promptly.
          </p>

          <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label-pd">Your Full Name</label>
                <input type="text" name="name" class="form-control-pd" required placeholder="e.g. Ramesh Kumar">
              </div>
              <div class="col-md-6">
                <label class="form-label-pd">Email Address</label>
                <input type="email" name="email" class="form-control-pd" required placeholder="e.g. name@example.com">
              </div>
              <div class="col-md-6">
                <label class="form-label-pd">Phone / WhatsApp</label>
                <input type="text" name="phone" class="form-control-pd" placeholder="e.g. 9914469211">
              </div>
              <div class="col-md-6">
                <label class="form-label-pd">Interested Category</label>
                <select name="subject" class="form-control-pd">
                  <option value="Luggage & Trolleys">Luggage &amp; Trolleys</option>
                  <option value="Ladies Handbags">Ladies Handbags</option>
                  <option value="School Bags">School Bags</option>
                  <option value="Bridal Purse Collection">Bridal Purse Collection</option>
                  <option value="General Inquiry">General Inquiry</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label-pd">Message / Inquiry Details</label>
                <textarea name="message" rows="5" class="form-control-pd" required placeholder="Tell us how we can help you..."></textarea>
              </div>
              <div class="col-12 mt-4">
                <button type="submit" class="btn-glamora" style="padding:14px 40px;background:var(--dsh-navy);border-color:var(--dsh-navy);font-weight:700;">
                  Send Message <i class="bi bi-send ms-2"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="col-lg-5">
        <div style="background:var(--dsh-cream); border:1.5px solid var(--dsh-cream-dark); border-radius:12px; padding:36px; height:100%;">
          <span style="font-size:0.75rem; font-weight:800; letter-spacing:2.5px; text-transform:uppercase; color:var(--dsh-gold-dark); display:block; margin-bottom:8px;">Store Hours &amp; Location</span>
          <h4 style="font-family:var(--font-serif); font-size:1.6rem; font-weight:700; color:var(--dsh-navy); margin-bottom:16px;">
            Durable Suitcase House
          </h4>
          <p style="color:var(--dsh-charcoal); font-size:0.95rem; line-height:1.7; margin-bottom:24px;">
            Visit our showroom in Dharampura Bazar to browse through our complete collection of travel gear, luggage sets, school bags, and wedding purse collections in person.
          </p>

          <div class="mb-4">
            <h6 style="color:var(--dsh-navy); font-weight:700; font-size:0.95rem; margin-bottom:8px;"><i class="bi bi-clock me-2 text-gold"></i>Opening Hours:</h6>
            <div style="color:var(--dsh-text-muted); font-size:0.88rem; line-height:1.8;">
              Monday – Saturday: 10:30 AM – 8:30 PM<br>
              Sunday: Open / Festival Timing
            </div>
          </div>

          <div>
            <h6 style="color:var(--dsh-navy); font-weight:700; font-size:0.95rem; margin-bottom:8px;"><i class="bi bi-patch-check me-2 text-gold"></i>In-Store Services:</h6>
            <ul style="color:var(--dsh-text-muted); font-size:0.88rem; line-height:1.8; padding-left:20px; margin-bottom:0;">
              <li>Genuine brand warranty registration &amp; advice</li>
              <li>Size and weight consultation for international airlines</li>
              <li>Bridal outfit matching for clutches and potlis</li>
              <li>School bag ergonomics &amp; spine-friendly fit checks</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
