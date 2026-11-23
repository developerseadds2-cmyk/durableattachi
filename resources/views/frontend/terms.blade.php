@extends('frontend.layouts.app')
@section('title', 'Terms & Conditions — Durable Suitcase House')
@section('meta_description', 'Read the Terms & Conditions for Durable Suitcase House. Understand your rights and responsibilities when using our website and purchasing our jewelry.')

@push('styles')
<style>
.policy-hero { background: var(--pd-grad-dark); padding: 70px 0; text-align: center; }
.policy-sidebar { position: sticky; top: 100px; }
.policy-nav a {
  display: block;
  padding: 10px 16px;
  font-size: 0.85rem;
  color: var(--pd-slate);
  border-left: 3px solid transparent;
  text-decoration: none;
  transition: all 0.2s;
  margin-bottom: 2px;
}
.policy-nav a:hover, .policy-nav a.active {
  color: var(--pd-blue);
  border-left-color: var(--pd-blue);
  background: var(--pd-ice);
}
.policy-section { margin-bottom: 48px; scroll-margin-top: 110px; }
.policy-section h2 {
  font-family: var(--font-serif);
  font-size: 1.5rem;
  font-weight: 500;
  color: var(--pd-navy);
  margin-bottom: 16px;
  padding-bottom: 12px;
  border-bottom: 2px solid var(--pd-ice);
  display: flex;
  align-items: center;
  gap: 10px;
}
.policy-section h2 .section-num {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 30px; height: 30px;
  background: var(--pd-blue);
  color: #fff;
  border-radius: 50%;
  font-size: 0.78rem;
  font-weight: 700;
  flex-shrink: 0;
}
.policy-section p, .policy-section li {
  color: var(--pd-slate);
  font-size: 0.92rem;
  line-height: 1.9;
  margin-bottom: 10px;
}
.policy-section ul, .policy-section ol {
  padding-left: 20px;
  margin-bottom: 16px;
}
.policy-highlight {
  background: var(--pd-ice);
  border-left: 4px solid var(--pd-blue);
  padding: 16px 20px;
  margin: 20px 0;
  font-size: 0.88rem;
  color: var(--pd-navy);
  line-height: 1.7;
}
</style>
@endpush

@section('content')

<section class="policy-hero">
  <div class="container-xl-custom">
    <span style="font-size:0.7rem;font-weight:600;letter-spacing:4px;text-transform:uppercase;color:var(--pd-aqua);display:block;margin-bottom:12px;">Legal</span>
    <h1 style="font-family:var(--font-serif);font-size:clamp(2rem,4vw,3rem);font-weight:400;color:#fff;margin-bottom:12px;">Terms & Conditions</h1>
    <p style="color:rgba(255,255,255,0.7);font-size:0.88rem;">Last updated: January 1, 2025</p>
    <nav style="margin-top:16px;font-size:0.82rem;color:rgba(255,255,255,0.6);">
      <a href="{{ route('home') }}" style="color:rgba(255,255,255,0.6);text-decoration:none;">Home</a>
      <span class="mx-2">›</span>
      <span style="color:var(--pd-aqua);">Terms & Conditions</span>
    </nav>
  </div>
</section>

<div class="container-xl-custom py-5">
  <div class="row g-5">

    {{-- Sidebar Nav --}}
    <div class="col-lg-3 d-none d-lg-block">
      <div class="policy-sidebar">
        <div style="font-size:0.7rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--pd-blue);margin-bottom:12px;padding:0 16px;">Contents</div>
        <nav class="policy-nav">
          <a href="#acceptance">1. Acceptance of Terms</a>
          <a href="#products">2. Products & Pricing</a>
          <a href="#orders">3. Orders & Payment</a>
          <a href="#shipping">4. Shipping & Delivery</a>
          <a href="#returns">5. Returns & Refunds</a>
          <a href="#warranty">6. Warranty</a>
          <a href="#intellectual">7. Intellectual Property</a>
          <a href="#liability">8. Limitation of Liability</a>
          <a href="#privacy">9. Privacy</a>
          <a href="#governing">10. Governing Law</a>
          <a href="#contact-terms">11. Contact</a>
        </nav>
      </div>
    </div>

    {{-- Content --}}
    <div class="col-lg-9">

      <div class="policy-highlight">
        <strong>Please read these Terms & Conditions carefully</strong> before using the Durable Suitcase House website or making a purchase. By accessing our website or placing an order, you agree to be bound by these terms.
      </div>

      <div class="policy-section" id="acceptance">
        <h2><span class="section-num">1</span> Acceptance of Terms</h2>
        <p>By accessing and using the Durable Suitcase House website (durablesuitcasehouse.com) and/or purchasing our products, you accept and agree to be bound by these Terms & Conditions and our Privacy Policy. If you do not agree with any part of these terms, please do not use our services.</p>
        <p>We reserve the right to update these terms at any time. Continued use of the website after changes constitutes acceptance of the revised terms. The date of last revision is shown above.</p>
      </div>

      <div class="policy-section" id="products">
        <h2><span class="section-num">2</span> Products & Pricing</h2>
        <p>Durable Suitcase House offers a range of diamond and gemstone jewelry. We take every effort to accurately display our products, including descriptions, images, and specifications. However:</p>
        <ul>
          <li>Colors may vary slightly due to screen display settings.</li>
          <li>All product images are for illustrative purposes and actual products may differ slightly.</li>
          <li>Prices are listed in Pakistani Rupees (₨) and are inclusive of applicable taxes unless stated otherwise.</li>
          <li>We reserve the right to change prices without prior notice.</li>
          <li>In the case of a pricing error, we will notify you and you may cancel or confirm your order at the correct price.</li>
        </ul>
        <p>All diamond jewelry is sold with GIA certification unless explicitly stated otherwise in the product description.</p>
      </div>

      <div class="policy-section" id="orders">
        <h2><span class="section-num">3</span> Orders & Payment</h2>
        <p>When you place an order on our website, you are making an offer to purchase the products at the stated price. Your order is confirmed only after you receive an order confirmation email from us.</p>
        <ul>
          <li>We accept payments via credit/debit card, bank transfer, and cash on delivery (select areas).</li>
          <li>Full payment is required before dispatch, except for COD orders.</li>
          <li>We reserve the right to refuse or cancel any order at our discretion.</li>
          <li>For custom orders, a 50% advance payment is required before work begins.</li>
        </ul>
        <div class="policy-highlight">
          <i class="bi bi-shield-lock me-2"></i>All payments are processed through secure, encrypted channels. We do not store your credit card information.
        </div>
      </div>

      <div class="policy-section" id="shipping">
        <h2><span class="section-num">4</span> Shipping & Delivery</h2>
        <p>Durable Suitcase House ships nationwide across Pakistan. Delivery timelines are estimates and may vary.</p>
        <ul>
          <li>Standard delivery: 3–5 business days</li>
          <li>Express delivery: 1–2 business days (additional charge applies)</li>
          <li>Free shipping on orders above ₨5,000</li>
          <li>All orders are shipped with insured packaging and tracking numbers.</li>
          <li>We are not responsible for delays caused by courier services or natural events beyond our control.</li>
          <li>Risk of loss and title for products passes to you upon delivery.</li>
        </ul>
      </div>

      <div class="policy-section" id="returns">
        <h2><span class="section-num">5</span> Returns & Refunds</h2>
        <p>We want you to be completely satisfied with your purchase. Please refer to our <a href="{{ route('refund') }}" style="color:var(--pd-blue);">Refund Policy</a> for complete details. Key points:</p>
        <ul>
          <li>Returns accepted within 30 days of delivery.</li>
          <li>Items must be in original, unworn condition with all certificates and packaging.</li>
          <li>Custom-made pieces are non-refundable unless defective.</li>
          <li>Sale items are final sale and non-refundable.</li>
        </ul>
      </div>

      <div class="policy-section" id="warranty">
        <h2><span class="section-num">6</span> Warranty</h2>
        <p>Durable Suitcase House provides a <strong>1-year manufacturing warranty</strong> on all jewelry against defects in materials and workmanship. This warranty does not cover:</p>
        <ul>
          <li>Normal wear and tear</li>
          <li>Damage due to misuse, accidents, or improper care</li>
          <li>Loss of stones due to prong damage from wear</li>
          <li>Alterations or repairs done by third parties</li>
        </ul>
        <p>To claim warranty service, please contact us with your order number and proof of purchase.</p>
      </div>

      <div class="policy-section" id="intellectual">
        <h2><span class="section-num">7</span> Intellectual Property</h2>
        <p>All content on this website — including text, images, logos, designs, and product descriptions — is the property of Durable Suitcase House and is protected by copyright law. You may not reproduce, distribute, or use our content without written permission.</p>
      </div>

      <div class="policy-section" id="liability">
        <h2><span class="section-num">8</span> Limitation of Liability</h2>
        <p>To the maximum extent permitted by law, Durable Suitcase House shall not be liable for any indirect, incidental, special, or consequential damages arising from the use of our website or products. Our total liability shall not exceed the amount paid for the specific product in question.</p>
      </div>

      <div class="policy-section" id="privacy">
        <h2><span class="section-num">9</span> Privacy</h2>
        <p>Your use of this website is also governed by our <a href="{{ route('privacy') }}" style="color:var(--pd-blue);">Privacy Policy</a>, which is incorporated into these Terms by reference. Please review our Privacy Policy to understand our practices.</p>
      </div>

      <div class="policy-section" id="governing">
        <h2><span class="section-num">10</span> Governing Law</h2>
        <p>These Terms & Conditions are governed by the laws of Pakistan. Any disputes arising from these terms shall be subject to the exclusive jurisdiction of the courts of Karachi, Pakistan.</p>
      </div>

      <div class="policy-section" id="contact-terms">
        <h2><span class="section-num">11</span> Contact Us</h2>
        <p>If you have any questions about these Terms & Conditions, please contact us:</p>
        <ul>
          <li><strong>Email:</strong> {{ \App\Models\Setting::get('site_email','durablesuitcasehouse@gmail.com') }}</li>
          <li><strong>Phone:</strong> {{ \App\Models\Setting::get('site_phone','+92-300-1234567') }}</li>
          <li><strong>Address:</strong> {{ \App\Models\Setting::get('site_address','123 Jewelry Street, Karachi, Pakistan') }}</li>
        </ul>
        <a href="{{ route('contact.index') }}" class="btn-glamora" style="padding:12px 28px;margin-top:8px;">Contact Us</a>
      </div>

    </div>
  </div>
</div>
@endsection


