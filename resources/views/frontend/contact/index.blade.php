@extends('frontend.layouts.app')
@section('title', 'Contact Us — Ayurnaman')
@section('meta_description', 'Get in touch with Ayurnaman. We are here to help with your Ayurvedic skincare and wellness queries, order assistance, and customer support.')

@push('styles')
<style>
.contact-hero {
  background: linear-gradient(rgba(11,26,19,0.85), rgba(27,56,43,0.92)),
              url('https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=1600&q=85&fit=crop') center/cover no-repeat;
  padding: 100px 0 80px;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.contact-info-card {
  background: #fff;
  border: 1px solid var(--border);
  padding: 32px 20px;
  text-align: center;
  height: 100%;
  transition: all 0.3s;
}
.contact-info-card:hover {
  border-color: var(--ayur-green);
  box-shadow: 0 8px 30px rgba(27,56,43,0.08);
  transform: translateY(-4px);
}
.contact-info-icon {
  width: 58px; height: 58px;
  background: var(--pd-ice);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 16px;
  transition: all 0.3s;
}
.contact-info-card:hover .contact-info-icon { 
  background: var(--ayur-green-dark); 
}
.contact-info-card:hover .contact-info-icon i { 
  color: #fff !important; 
}
.contact-form-wrap {
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 40px;
}
.form-control-pd {
  border: 1.5px solid var(--border);
  border-radius: 4px;
  padding: 12px 16px;
  font-size: 0.9rem;
  color: var(--dark);
  transition: border-color 0.2s;
  width: 100%;
  outline: none;
  background: #fafbfc;
}
.form-control-pd:focus {
  border-color: var(--ayur-green);
  background: #fff;
  box-shadow: 0 0 0 3px rgba(45,90,39,0.1);
}
.form-label-pd {
  font-size: 0.78rem;
  font-weight: 700;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  color: var(--ayur-green-dark);
  margin-bottom: 6px;
  display: block;
}
.faq-item {
  border-bottom: 1px solid var(--border);
  padding: 18px 0;
}
.faq-item:last-child { border-bottom: none; }
.faq-question {
  font-weight: 600;
  font-size: 0.95rem;
  color: var(--ayur-green-dark);
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 12px;
}
.faq-answer {
  color: var(--text-muted);
  font-size: 0.88rem;
  line-height: 1.75;
  margin-top: 10px;
  display: none;
}
.faq-item.open .faq-answer { display: block; }
.faq-item.open .faq-icon { transform: rotate(45deg); }
.faq-icon { transition: transform 0.2s; flex-shrink: 0; color: var(--ayur-green); }

@media (max-width: 768px) {
  .contact-hero {
    padding: 60px 0 50px;
  }
  .contact-form-wrap {
    padding: 24px 18px;
  }
}
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="contact-hero">
  <div class="container-xl-custom position-relative" style="z-index:1;">
    <span style="font-size:0.75rem;font-weight:700;letter-spacing:4px;text-transform:uppercase;color:var(--ayur-gold);display:block;margin-bottom:14px;">Get In Touch</span>
    <h1 style="font-family:var(--font-serif);font-size:clamp(2.2rem,5vw,3.5rem);font-weight:400;color:#fff;margin-bottom:16px;">
      We'd Love to <em style="color:var(--ayur-gold);font-style:italic;">Hear From You</em>
    </h1>
    <p style="color:rgba(255,255,255,0.85);max-width:540px;margin:0 auto;font-size:0.95rem;line-height:1.75;">
      Have a question about our Ayurvedic skincare or wellness products? Need guidance on everyday self-care or an order? Our team is always here to assist you.
    </p>
  </div>
</section>

{{-- INFO CARDS --}}
<section style="padding:0;background:#f8fafc;">
  <div class="container-xl-custom">
    <div class="row g-0">
      @foreach([
        ['bi-geo-alt-fill', 'Location', \App\Models\Setting::get('site_address','Fountain Chowk, College Road, Ludhiana - 141001'), 'Punjab, India', 'https://maps.google.com/?q=' . urlencode(\App\Models\Setting::get('site_address','Fountain Chowk, College Road, Ludhiana - 141001'))],
        ['bi-telephone-fill', 'Mobile Number', '+91 8556839980', 'Mon–Sat: 10AM – 7PM', 'tel:+918556839980'],
        ['bi-envelope-fill', 'Business Email', 'ayurnaman@gmail.com', 'Quick response guaranteed', 'mailto:ayurnaman@gmail.com'],
        ['bi-whatsapp', 'WhatsApp Support', '+91 8556839980', 'Instant assistance', 'https://wa.me/918556839980'],
      ] as $c)
      <div class="col-6 col-md-3">
        <a href="{{ $c[4] }}" target="{{ str_starts_with($c[4], 'http') ? '_blank' : '_self' }}" class="text-decoration-none d-block h-100">
          <div class="contact-info-card">
            <div class="contact-info-icon">
              <i class="bi {{ $c[0] }}" style="color:var(--ayur-green);font-size:1.3rem;"></i>
            </div>
            <div style="font-size:0.7rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--text-muted);margin-bottom:6px;">{{ $c[1] }}</div>
            <div style="font-size:0.88rem;font-weight:700;color:var(--ayur-green-dark);margin-bottom:4px;word-break:break-word;">{{ $c[2] }}</div>
            <div style="font-size:0.78rem;color:var(--text-muted);">{{ $c[3] }}</div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- FORM + INFO --}}
<section style="padding:72px 0;background:#fff;">
  <div class="container-xl-custom">
    <div class="row g-5">

      {{-- LEFT: Form --}}
      <div class="col-lg-7" data-aos="fade-right">
        <span class="section-label" style="text-align:left;display:block;">Send a Message</span>
        <h2 style="font-family:var(--font-serif);font-size:2rem;font-weight:400;color:var(--ayur-green-dark);margin-bottom:8px;">Let's Start a Conversation</h2>
        <p class="text-muted small mb-4">Fill out the form below and our Ayurnaman wellness team will get back to you within 24 hours.</p>

        @if(session('success'))
        <div style="background:#e8f5e9;border-left:4px solid var(--ayur-green);padding:16px 20px;margin-bottom:24px;color:var(--ayur-green-dark);font-size:0.9rem;border-radius:4px;">
          <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
        @endif

        <div class="contact-form-wrap">
          <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label-pd">Full Name <span style="color:#dc3545;">*</span></label>
                <input type="text" name="name" class="form-control-pd @error('name') border-danger @enderror" placeholder="Your full name" value="{{ old('name') }}" required>
                @error('name')<div style="color:#dc3545;font-size:0.78rem;margin-top:4px;">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-6">
                <label class="form-label-pd">Email Address <span style="color:#dc3545;">*</span></label>
                <input type="email" name="email" class="form-control-pd @error('email') border-danger @enderror" placeholder="your@email.com" value="{{ old('email') }}" required>
                @error('email')<div style="color:#dc3545;font-size:0.78rem;margin-top:4px;">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-6">
                <label class="form-label-pd">Phone Number</label>
                <input type="tel" name="phone" class="form-control-pd @error('phone') border-danger @enderror" placeholder="+91 XXXXX XXXXX" value="{{ old('phone') }}">
                @error('phone')<div style="color:#dc3545;font-size:0.78rem;margin-top:4px;">{{ $message }}</div>@enderror
              </div>
              <div class="col-md-6">
                <label class="form-label-pd">Subject</label>
                <input type="text" name="subject" class="form-control-pd @error('subject') border-danger @enderror" placeholder="How can we help?" value="{{ old('subject') }}">
                @error('subject')<div style="color:#dc3545;font-size:0.78rem;margin-top:4px;">{{ $message }}</div>@enderror
              </div>
              <div class="col-12">
                <label class="form-label-pd">Your Message <span style="color:#dc3545;">*</span></label>
                <textarea name="message" class="form-control-pd @error('message') border-danger @enderror" rows="5" placeholder="Tell us how we can assist your wellness journey..." required>{{ old('message') }}</textarea>
                @error('message')<div style="color:#dc3545;font-size:0.78rem;margin-top:4px;">{{ $message }}</div>@enderror
              </div>
              <label class="d-flex align-items-start gap-2 mt-3" style="font-size:0.82rem;line-height:1.7;color:var(--text);cursor:pointer;">
                <input type="checkbox" name="consent" value="1" style="margin-top:5px;flex-shrink:0;" {{ old('consent') ? 'checked' : '' }} required>
                <span>I consent to receiving WhatsApp, Email or SMS updates from Ayurnaman and agree to the <a href="{{ route('page.show', 'terms') }}" style="color:var(--ayur-green);font-weight:600;">Terms &amp; Conditions</a> and <a href="{{ route('page.show', 'privacy') }}" style="color:var(--ayur-green);font-weight:600;">Privacy Policy</a>.</span>
              </label>
              @error('consent')<div style="color:#dc3545;font-size:0.78rem;margin-top:4px;">{{ $message }}</div>@enderror
              <div class="col-12 mt-2">
                <button type="submit" class="btn-glamora" style="padding:14px 40px;gap:10px;">
                  <i class="bi bi-send-fill"></i> Send Message
                </button>
                <p class="text-muted small mt-3 mb-0"><i class="bi bi-shield-lock me-1 text-success"></i>Your information is safe and never shared.</p>
              </div>
            </div>
          </form>
        </div>
      </div>

      {{-- RIGHT: Info + FAQ --}}
      <div class="col-lg-5" data-aos="fade-left">

        {{-- Google Map Embed --}}
        <div style="position:relative;margin-bottom:32px; border-radius:12px; overflow:hidden; border:1px solid var(--border); box-shadow:0 4px 20px rgba(0,0,0,0.06);">
          <iframe 
            src="https://maps.google.com/maps?q={{ urlencode(\App\Models\Setting::get('site_address','Fountain Chowk, College Road, Ludhiana - 141001')) }}&t=&z=15&ie=UTF8&iwloc=&output=embed" 
            width="100%" 
            height="260" 
            style="border:0; display:block;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
          <div style="background:#fff; padding:12px 18px; border-top:1px solid var(--border); display:flex; align-items:center; justify-content:space-between;">
            <div>
              <div style="font-size:0.7rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--ayur-green);">Ayurnaman Headquarters</div>
              <div style="font-size:0.85rem; font-weight:600; color:var(--ayur-green-dark); line-height:1.3;">{{ \App\Models\Setting::get('site_address','Fountain Chowk, College Road, Ludhiana - 141001') }}</div>
            </div>
            <a href="https://maps.google.com/?q={{ urlencode(\App\Models\Setting::get('site_address','Fountain Chowk, College Road, Ludhiana - 141001')) }}" target="_blank" rel="noopener" class="btn btn-sm" style="background:var(--ayur-green); color:#fff; font-size:0.75rem; font-weight:600; padding:6px 14px; border-radius:20px; white-space:nowrap;">
              <i class="bi bi-geo-alt me-1"></i>Directions
            </a>
          </div>
        </div>

        {{-- Direct Contact Box --}}
        <div style="background:var(--pd-ice);padding:24px;border-radius:8px;margin-bottom:28px;border:1px solid rgba(27,56,43,0.08);">
          <h6 style="font-size:0.75rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--ayur-green-dark);margin-bottom:16px;">Direct Channels</h6>
          <div class="d-flex justify-content-between align-items-center py-2" style="border-bottom:1px solid rgba(27,56,43,0.08);">
            <span style="font-size:0.85rem;color:var(--text-muted);"><i class="bi bi-phone me-2 text-success"></i>Mobile Number</span>
            <a href="tel:+918556839980" class="text-decoration-none fw-bold" style="color:var(--ayur-green-dark);font-size:0.85rem;">8556839980</a>
          </div>
          <div class="d-flex justify-content-between align-items-center py-2" style="border-bottom:1px solid rgba(27,56,43,0.08);">
            <span style="font-size:0.85rem;color:var(--text-muted);"><i class="bi bi-envelope me-2 text-success"></i>Business Email</span>
            <a href="mailto:ayurnaman@gmail.com" class="text-decoration-none fw-bold" style="color:var(--ayur-green-dark);font-size:0.85rem;">ayurnaman@gmail.com</a>
          </div>
          <div class="d-flex justify-content-between align-items-center py-2">
            <span style="font-size:0.85rem;color:var(--text-muted);"><i class="bi bi-clock me-2 text-success"></i>Working Hours</span>
            <span class="fw-bold" style="color:var(--ayur-green-dark);font-size:0.85rem;">Mon – Sat: 10AM – 7PM</span>
          </div>
        </div>

        {{-- FAQ --}}
        <h6 style="font-size:0.75rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--ayur-green-dark);margin-bottom:16px;">Frequently Asked Questions</h6>
        <div>
          @foreach([
            ['How long does delivery take?', 'Orders are dispatched within 24–48 hours. Standard nationwide delivery typically takes 3–5 business days.'],
            ['Are your products 100% Ayurvedic?', 'Yes, our formulations are powered by pure herbal actives and traditional Ayurvedic principles for safe, everyday wellness.'],
            ['How can I track my order?', 'Once shipped, you will receive a tracking link via email/SMS. You can also track your order through your account dashboard.'],
            ['What is your return policy?', 'We prioritize your satisfaction. If you encounter any issue with your order, please contact our support team within 7 days.'],
          ] as $faq)
          <div class="faq-item">
            <div class="faq-question" onclick="this.closest('.faq-item').classList.toggle('open')">
              <span>{{ $faq[0] }}</span>
              <i class="bi bi-plus-lg faq-icon"></i>
            </div>
            <div class="faq-answer">{{ $faq[1] }}</div>
          </div>
          @endforeach
        </div>

      </div>
    </div>
  </div>
</section>

{{-- SOCIAL CTA --}}
<section style="padding:60px 0;background:var(--pd-ice);text-align:center;">
  <div class="container-xl-custom">
    <h3 style="font-family:var(--font-serif);font-size:2rem;font-weight:400;color:var(--ayur-green-dark);margin-bottom:8px;">Follow Ayurnaman on Social Media</h3>
    <p class="text-muted mb-4">Stay connected for daily Ayurvedic wellness tips, new product launches, and exclusive offers.</p>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
      <a href="https://www.facebook.com/Ayurnaman" target="_blank" rel="noopener" style="display:flex;align-items:center;gap:8px;padding:12px 24px;background:#fff;border:1px solid var(--border);border-radius:30px;font-size:0.85rem;font-weight:600;color:#1877f2;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        <i class="bi bi-facebook" style="font-size:1.2rem;"></i> Facebook
      </a>
      <a href="https://www.instagram.com/ayurnaman/?hl=en" target="_blank" rel="noopener" style="display:flex;align-items:center;gap:8px;padding:12px 24px;background:#fff;border:1px solid var(--border);border-radius:30px;font-size:0.85rem;font-weight:600;color:#e1306c;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        <i class="bi bi-instagram" style="font-size:1.2rem;"></i> Instagram
      </a>
      <a href="https://www.youtube.com/@AyurNaman2025" target="_blank" rel="noopener" style="display:flex;align-items:center;gap:8px;padding:12px 24px;background:#fff;border:1px solid var(--border);border-radius:30px;font-size:0.85rem;font-weight:600;color:#ff0000;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        <i class="bi bi-youtube" style="font-size:1.2rem;"></i> YouTube
      </a>
      <a href="https://wa.me/918556839980" target="_blank" rel="noopener" style="display:flex;align-items:center;gap:8px;padding:12px 24px;background:#fff;border:1px solid var(--border);border-radius:30px;font-size:0.85rem;font-weight:600;color:#25d366;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        <i class="bi bi-whatsapp" style="font-size:1.2rem;"></i> WhatsApp
      </a>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
// FAQ toggle handled inline
</script>
@endpush
