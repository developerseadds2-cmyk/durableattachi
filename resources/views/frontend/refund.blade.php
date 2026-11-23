@extends('frontend.layouts.app')
@section('title', 'Refund & Return Policy — Durable Suitcase House')
@section('meta_description', 'Durable Suitcase House Refund and Return Policy. Easy 30-day returns on all jewelry purchases. Learn how to return or exchange your order.')

@push('styles')
<style>
.policy-hero { background: var(--pd-grad-dark); padding: 70px 0; text-align: center; }
.policy-sidebar { position: sticky; top: 100px; }
.policy-nav a {
  display: block; padding: 10px 16px; font-size: 0.85rem;
  color: var(--pd-slate); border-left: 3px solid transparent;
  text-decoration: none; transition: all 0.2s; margin-bottom: 2px;
}
.policy-nav a:hover { color: var(--pd-blue); border-left-color: var(--pd-blue); background: var(--pd-ice); }
.policy-section { margin-bottom: 48px; scroll-margin-top: 110px; }
.policy-section h2 {
  font-family: var(--font-serif); font-size: 1.5rem; font-weight: 500;
  color: var(--pd-navy); margin-bottom: 16px; padding-bottom: 12px;
  border-bottom: 2px solid var(--pd-ice); display: flex; align-items: center; gap: 10px;
}
.section-num {
  display: inline-flex; align-items: center; justify-content: center;
  width: 30px; height: 30px; background: var(--pd-blue); color: #fff;
  border-radius: 50%; font-size: 0.78rem; font-weight: 700; flex-shrink: 0;
}
.policy-section p, .policy-section li { color: var(--pd-slate); font-size: 0.92rem; line-height: 1.9; margin-bottom: 10px; }
.policy-section ul, .policy-section ol { padding-left: 20px; margin-bottom: 16px; }
.policy-highlight { background: var(--pd-ice); border-left: 4px solid var(--pd-blue); padding: 16px 20px; margin: 20px 0; font-size: 0.88rem; color: var(--pd-navy); line-height: 1.7; }
.policy-warn { background: #fff3cd; border-left: 4px solid #ffc107; padding: 16px 20px; margin: 20px 0; font-size: 0.88rem; color: #856404; line-height: 1.7; }
.step-card {
  display: flex; gap: 20px; align-items: flex-start;
  padding: 20px 24px; background: var(--pd-ice); margin-bottom: 12px;
}
.step-num {
  width: 40px; height: 40px; background: var(--pd-blue); color: #fff;
  border-radius: 50%; display: flex; align-items: center; justify-content: center;
  font-weight: 700; font-size: 0.9rem; flex-shrink: 0;
}
.step-card h6 { font-weight: 600; color: var(--pd-navy); margin-bottom: 4px; font-size: 0.9rem; }
.step-card p { color: var(--pd-slate); font-size: 0.85rem; margin: 0; line-height: 1.7; }
</style>
@endpush

@section('content')

<section class="policy-hero">
  <div class="container-xl-custom">
    <span style="font-size:0.7rem;font-weight:600;letter-spacing:4px;text-transform:uppercase;color:var(--pd-aqua);display:block;margin-bottom:12px;">Customer Care</span>
    <h1 style="font-family:var(--font-serif);font-size:clamp(2rem,4vw,3rem);font-weight:400;color:#fff;margin-bottom:12px;">Refund & Return Policy</h1>
    <p style="color:rgba(255,255,255,0.7);font-size:0.88rem;">Last updated: January 1, 2025</p>
    <nav style="margin-top:16px;font-size:0.82rem;color:rgba(255,255,255,0.6);">
      <a href="{{ route('home') }}" style="color:rgba(255,255,255,0.6);text-decoration:none;">Home</a>
      <span class="mx-2">›</span>
      <span style="color:var(--pd-aqua);">Refund Policy</span>
    </nav>
  </div>
</section>

{{-- Quick Summary --}}
<section style="background:#fff;padding:48px 0;border-bottom:1px solid var(--pd-silver);">
  <div class="container-xl-custom">
    <div class="row g-4 text-center">
      @foreach([
        ['bi-calendar-check','30-Day Returns','Return any item within 30 days of delivery'],
        ['bi-arrow-repeat','Easy Exchange','Exchange for a different size or style'],
        ['bi-cash-coin','Full Refund','Get 100% refund to original payment method'],
        ['bi-headset','Free Support','Our team handles your return from start to finish'],
      ] as $s)
      <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
        <div style="padding:20px;">
          <div style="width:56px;height:56px;background:var(--pd-ice);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;">
            <i class="bi {{ $s[0] }}" style="color:var(--pd-blue);font-size:1.3rem;"></i>
          </div>
          <div style="font-weight:700;font-size:0.9rem;color:var(--pd-navy);margin-bottom:4px;">{{ $s[1] }}</div>
          <div style="font-size:0.8rem;color:var(--pd-slate);">{{ $s[2] }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<div class="container-xl-custom py-5">
  <div class="row g-5">

    <div class="col-lg-3 d-none d-lg-block">
      <div class="policy-sidebar">
        <div style="font-size:0.7rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--pd-blue);margin-bottom:12px;padding:0 16px;">Contents</div>
        <nav class="policy-nav">
          <a href="#eligibility">1. Return Eligibility</a>
          <a href="#non-returnable">2. Non-Returnable Items</a>
          <a href="#how-to-return">3. How to Return</a>
          <a href="#refund-process">4. Refund Process</a>
          <a href="#exchanges">5. Exchanges</a>
          <a href="#defective">6. Defective Items</a>
          <a href="#shipping-returns">7. Return Shipping</a>
          <a href="#contact-refund">8. Contact</a>
        </nav>
      </div>
    </div>

    <div class="col-lg-9">

      <div class="policy-highlight">
        <i class="bi bi-heart me-2" style="color:var(--pd-blue);"></i>
        <strong>We want you to love every piece.</strong> If for any reason you're not completely satisfied with your purchase, we make the return process simple and hassle-free.
      </div>

      <div class="policy-section" id="eligibility">
        <h2><span class="section-num">1</span> Return Eligibility</h2>
        <p>We accept returns on most items within <strong>30 days of the delivery date</strong>. To be eligible for a return:</p>
        <ul>
          <li>Item must be in its <strong>original, unworn condition</strong></li>
          <li>All <strong>original packaging</strong> must be intact (box, pouch, certificates)</li>
          <li><strong>GIA certificate</strong> and any other documentation must be included</li>
          <li>Item must not have been <strong>altered, resized, or engraved</strong> after purchase</li>
          <li>Return request must be initiated within <strong>30 days</strong> of delivery</li>
        </ul>
      </div>

      <div class="policy-section" id="non-returnable">
        <h2><span class="section-num">2</span> Non-Returnable Items</h2>
        <p>The following items cannot be returned or refunded:</p>
        <ul>
          <li><strong>Custom-made or personalized jewelry</strong> (engraved, made-to-order pieces)</li>
          <li><strong>Sale or clearance items</strong> marked as "Final Sale"</li>
          <li>Items that have been <strong>resized, altered, or repaired</strong> by a third party</li>
          <li>Items showing signs of <strong>wear, damage, or misuse</strong></li>
          <li>Items returned <strong>after 30 days</strong> of delivery</li>
          <li><strong>Gift cards</strong> and store credit vouchers</li>
        </ul>
        <div class="policy-warn">
          <i class="bi bi-exclamation-triangle me-2"></i>
          <strong>Please note:</strong> Earrings that have been worn cannot be returned for hygiene reasons, unless they are defective.
        </div>
      </div>

      <div class="policy-section" id="how-to-return">
        <h2><span class="section-num">3</span> How to Return — Step by Step</h2>
        <p>Follow these simple steps to return your item:</p>

        <div class="step-card">
          <div class="step-num">1</div>
          <div>
            <h6>Initiate Your Return</h6>
            <p>Contact our customer service team within 30 days of delivery via email at <a href="mailto:{{ \App\Models\Setting::get('site_email','durablesuitcasehouse@gmail.com') }}" style="color:var(--pd-blue);">{{ \App\Models\Setting::get('site_email','durablesuitcasehouse@gmail.com') }}</a> or call <strong>{{ \App\Models\Setting::get('site_phone','+92-300-1234567') }}</strong> with your order number and reason for return.</p>
          </div>
        </div>

        <div class="step-card">
          <div class="step-num">2</div>
          <div>
            <h6>Receive Return Authorization</h6>
            <p>Our team will review your request and send you a Return Authorization (RA) number within 24–48 hours. Returns without an RA number will not be accepted.</p>
          </div>
        </div>

        <div class="step-card">
          <div class="step-num">3</div>
          <div>
            <h6>Pack & Ship</h6>
            <p>Securely pack the item in its original packaging. Write the RA number on the outside of the package. Use an insured, trackable courier service to ship the item to our address.</p>
          </div>
        </div>

        <div class="step-card">
          <div class="step-num">4</div>
          <div>
            <h6>Inspection & Approval</h6>
            <p>Once we receive the item, our team will inspect it within 2–3 business days to verify it meets return eligibility criteria.</p>
          </div>
        </div>

        <div class="step-card">
          <div class="step-num">5</div>
          <div>
            <h6>Refund Issued</h6>
            <p>Upon approval, your refund will be processed within 5–7 business days to your original payment method.</p>
          </div>
        </div>
      </div>

      <div class="policy-section" id="refund-process">
        <h2><span class="section-num">4</span> Refund Process & Timeline</h2>
        <p>Once your return is approved and processed:</p>
        <ul>
          <li><strong>Credit/Debit Card:</strong> Refund within 5–7 business days to your card</li>
          <li><strong>Bank Transfer:</strong> Refund within 3–5 business days</li>
          <li><strong>Cash on Delivery:</strong> Bank transfer refund within 5–7 business days (bank details required)</li>
          <li><strong>Store Credit:</strong> Immediately added to your Durable Suitcase House account</li>
        </ul>
        <div class="policy-highlight">
          <i class="bi bi-info-circle me-2"></i>Original shipping fees are non-refundable. Only the product price will be refunded.
        </div>
      </div>

      <div class="policy-section" id="exchanges">
        <h2><span class="section-num">5</span> Exchanges</h2>
        <p>Want a different size or style? We're happy to exchange your item. The exchange process follows the same steps as returns. Additional charges may apply if the new item has a higher price. If the new item has a lower price, the difference will be refunded.</p>
        <p>Exchanges are subject to item availability. If the desired item is not in stock, we will issue a full refund or store credit.</p>
      </div>

      <div class="policy-section" id="defective">
        <h2><span class="section-num">6</span> Defective or Damaged Items</h2>
        <p>If you receive a defective or damaged item, please contact us within <strong>48 hours of delivery</strong> with:</p>
        <ul>
          <li>Your order number</li>
          <li>Clear photographs of the defect/damage</li>
          <li>Description of the issue</li>
        </ul>
        <p>For defective items, we will arrange free return shipping and offer a full replacement, repair, or refund at no cost to you. This is covered under our 1-year manufacturing warranty.</p>
      </div>

      <div class="policy-section" id="shipping-returns">
        <h2><span class="section-num">7</span> Return Shipping</h2>
        <ul>
          <li>Customers are responsible for return shipping costs, except for defective or incorrect items.</li>
          <li>We strongly recommend using an insured, trackable courier service.</li>
          <li>Durable Suitcase House is not responsible for items lost or damaged during return shipping.</li>
          <li>Return shipping address will be provided with your Return Authorization.</li>
        </ul>
      </div>

      <div class="policy-section" id="contact-refund">
        <h2><span class="section-num">8</span> Contact Us</h2>
        <p>Our customer care team is available to help you with returns, exchanges, and refunds.</p>
        <div class="row g-3 mt-2">
          @foreach([
            ['bi-envelope','Email',\App\Models\Setting::get('site_email','durablesuitcasehouse@gmail.com'),'mailto:'.(\App\Models\Setting::get('site_email','durablesuitcasehouse@gmail.com'))],
            ['bi-telephone','Phone',\App\Models\Setting::get('site_phone','+92-300-1234567'),'tel:'.(\App\Models\Setting::get('site_phone','+92-300-1234567'))],
            ['bi-whatsapp','WhatsApp','+92-300-1234567','https://wa.me/923001234567'],
          ] as $c)
          <div class="col-md-4">
            <a href="{{ $c[3] }}" style="display:flex;align-items:center;gap:12px;padding:16px 20px;background:var(--pd-ice);text-decoration:none;color:var(--pd-navy);transition:all 0.2s;border:1px solid transparent;" onmouseover="this.style.borderColor='var(--pd-blue)';this.style.background='#fff'" onmouseout="this.style.borderColor='transparent';this.style.background='var(--pd-ice)'">
              <i class="bi {{ $c[0] }}" style="font-size:1.3rem;color:var(--pd-blue);flex-shrink:0;"></i>
              <div>
                <div style="font-size:0.72rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:var(--pd-slate);">{{ $c[1] }}</div>
                <div style="font-size:0.85rem;font-weight:600;">{{ $c[2] }}</div>
              </div>
            </a>
          </div>
          @endforeach
        </div>
        <div class="mt-4">
          <a href="{{ route('contact.index') }}" class="btn-glamora" style="padding:12px 28px;">Go to Contact Page</a>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection


