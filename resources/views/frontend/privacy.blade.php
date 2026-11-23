@extends('frontend.layouts.app')
@section('title', 'Privacy Policy — Durable Suitcase House')
@section('meta_description', 'Durable Suitcase House Privacy Policy — how we collect, use, and protect your personal information.')

@push('styles')
<style>
.policy-hero { background: var(--pd-grad-dark); padding: 70px 0; text-align: center; }
.policy-sidebar { position: sticky; top: 100px; }
.policy-nav a {
  display: block; padding: 10px 16px; font-size: 0.85rem;
  color: var(--pd-slate); border-left: 3px solid transparent;
  text-decoration: none; transition: all 0.2s; margin-bottom: 2px;
}
.policy-nav a:hover, .policy-nav a.active {
  color: var(--pd-blue); border-left-color: var(--pd-blue); background: var(--pd-ice);
}
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
</style>
@endpush

@section('content')

<section class="policy-hero">
  <div class="container-xl-custom">
    <span style="font-size:0.7rem;font-weight:600;letter-spacing:4px;text-transform:uppercase;color:var(--pd-aqua);display:block;margin-bottom:12px;">Legal</span>
    <h1 style="font-family:var(--font-serif);font-size:clamp(2rem,4vw,3rem);font-weight:400;color:#fff;margin-bottom:12px;">Privacy Policy</h1>
    <p style="color:rgba(255,255,255,0.7);font-size:0.88rem;">Last updated: January 1, 2025</p>
    <nav style="margin-top:16px;font-size:0.82rem;color:rgba(255,255,255,0.6);">
      <a href="{{ route('home') }}" style="color:rgba(255,255,255,0.6);text-decoration:none;">Home</a>
      <span class="mx-2">›</span>
      <span style="color:var(--pd-aqua);">Privacy Policy</span>
    </nav>
  </div>
</section>

<div class="container-xl-custom py-5">
  <div class="row g-5">

    <div class="col-lg-3 d-none d-lg-block">
      <div class="policy-sidebar">
        <div style="font-size:0.7rem;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--pd-blue);margin-bottom:12px;padding:0 16px;">Contents</div>
        <nav class="policy-nav">
          <a href="#info-collect">1. Information We Collect</a>
          <a href="#how-use">2. How We Use Your Data</a>
          <a href="#sharing">3. Data Sharing</a>
          <a href="#cookies">4. Cookies</a>
          <a href="#security">5. Data Security</a>
          <a href="#rights">6. Your Rights</a>
          <a href="#retention">7. Data Retention</a>
          <a href="#third-party">8. Third-Party Links</a>
          <a href="#children">9. Children's Privacy</a>
          <a href="#changes">10. Policy Changes</a>
          <a href="#contact-privacy">11. Contact</a>
        </nav>
      </div>
    </div>

    <div class="col-lg-9">

      <div class="policy-highlight">
        <i class="bi bi-shield-check me-2" style="color:var(--pd-blue);"></i>
        <strong>Your privacy matters to us.</strong> Durable Suitcase House is committed to protecting your personal information. This policy explains what we collect, how we use it, and your rights.
      </div>

      <div class="policy-section" id="info-collect">
        <h2><span class="section-num">1</span> Information We Collect</h2>
        <p>We collect the following types of information:</p>
        <p><strong>Personal Information you provide:</strong></p>
        <ul>
          <li>Name, email address, phone number</li>
          <li>Billing and shipping addresses</li>
          <li>Payment information (processed securely — we do not store card details)</li>
          <li>Account login credentials</li>
          <li>Messages and communications sent to us</li>
        </ul>
        <p><strong>Automatically collected information:</strong></p>
        <ul>
          <li>IP address and browser type</li>
          <li>Pages visited and time spent on site</li>
          <li>Referring website and search terms</li>
          <li>Device type and operating system</li>
        </ul>
      </div>

      <div class="policy-section" id="how-use">
        <h2><span class="section-num">2</span> How We Use Your Data</h2>
        <p>We use your personal information to:</p>
        <ul>
          <li>Process and fulfill your orders</li>
          <li>Send order confirmations and shipping updates</li>
          <li>Manage your account and preferences</li>
          <li>Respond to inquiries and provide customer support</li>
          <li>Send promotional emails and newsletters (with your consent)</li>
          <li>Improve our website and user experience</li>
          <li>Comply with legal obligations</li>
          <li>Detect and prevent fraudulent transactions</li>
        </ul>
      </div>

      <div class="policy-section" id="sharing">
        <h2><span class="section-num">3</span> Data Sharing</h2>
        <p>We do not sell, rent, or trade your personal information. We may share your data with:</p>
        <ul>
          <li><strong>Delivery partners</strong> (name, address, phone) to fulfill your orders</li>
          <li><strong>Payment processors</strong> to complete transactions securely</li>
          <li><strong>Email service providers</strong> for transactional and marketing communications</li>
          <li><strong>Analytics providers</strong> to understand website usage (anonymized data)</li>
          <li><strong>Legal authorities</strong> when required by law</li>
        </ul>
        <p>All third-party partners are bound by confidentiality agreements and may only use your data for the specific purpose shared.</p>
      </div>

      <div class="policy-section" id="cookies">
        <h2><span class="section-num">4</span> Cookies & Tracking</h2>
        <p>Our website uses cookies to enhance your browsing experience. We use:</p>
        <ul>
          <li><strong>Essential cookies:</strong> Required for the website to function (cart, sessions, login)</li>
          <li><strong>Analytics cookies:</strong> Help us understand how visitors use our site (Google Analytics)</li>
          <li><strong>Marketing cookies:</strong> Used to show relevant advertisements</li>
        </ul>
        <p>You can control cookie settings through your browser preferences. Disabling cookies may affect some website functionality.</p>
      </div>

      <div class="policy-section" id="security">
        <h2><span class="section-num">5</span> Data Security</h2>
        <p>We implement industry-standard security measures to protect your personal information:</p>
        <ul>
          <li>SSL/TLS encryption for all data transmission</li>
          <li>Secure, encrypted storage of sensitive data</li>
          <li>Regular security audits and updates</li>
          <li>Strict access controls — only authorized staff can access customer data</li>
        </ul>
        <div class="policy-highlight">
          <i class="bi bi-lock-fill me-2"></i>We never store your full credit card number. All payment processing is handled by certified, PCI-DSS compliant payment gateways.
        </div>
      </div>

      <div class="policy-section" id="rights">
        <h2><span class="section-num">6</span> Your Rights</h2>
        <p>You have the following rights regarding your personal data:</p>
        <ul>
          <li><strong>Access:</strong> Request a copy of the personal data we hold about you</li>
          <li><strong>Correction:</strong> Request correction of inaccurate data</li>
          <li><strong>Deletion:</strong> Request deletion of your data (subject to legal requirements)</li>
          <li><strong>Opt-out:</strong> Unsubscribe from marketing emails at any time</li>
          <li><strong>Portability:</strong> Request your data in a machine-readable format</li>
        </ul>
        <p>To exercise your rights, contact us at <a href="mailto:{{ \App\Models\Setting::get('site_email','durablesuitcasehouse@gmail.com') }}" style="color:var(--pd-blue);">{{ \App\Models\Setting::get('site_email','durablesuitcasehouse@gmail.com') }}</a></p>
      </div>

      <div class="policy-section" id="retention">
        <h2><span class="section-num">7</span> Data Retention</h2>
        <p>We retain your personal data for as long as necessary to fulfill the purposes for which it was collected, including legal, accounting, or reporting requirements. Order data is retained for 7 years for tax compliance. You may request deletion of your account at any time.</p>
      </div>

      <div class="policy-section" id="third-party">
        <h2><span class="section-num">8</span> Third-Party Links</h2>
        <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of those sites. We encourage you to review the privacy policies of any external sites you visit.</p>
      </div>

      <div class="policy-section" id="children">
        <h2><span class="section-num">9</span> Children's Privacy</h2>
        <p>Our services are not directed at individuals under 18 years of age. We do not knowingly collect personal information from minors. If we become aware that a minor has provided us with personal information, we will delete it promptly.</p>
      </div>

      <div class="policy-section" id="changes">
        <h2><span class="section-num">10</span> Changes to This Policy</h2>
        <p>We may update this Privacy Policy from time to time. Changes will be posted on this page with an updated revision date. Significant changes will be communicated via email. Continued use of our services after changes constitutes acceptance of the updated policy.</p>
      </div>

      <div class="policy-section" id="contact-privacy">
        <h2><span class="section-num">11</span> Contact Us</h2>
        <p>For any questions, concerns, or requests regarding this Privacy Policy or your personal data:</p>
        <ul>
          <li><strong>Email:</strong> <a href="mailto:{{ \App\Models\Setting::get('site_email','durablesuitcasehouse@gmail.com') }}" style="color:var(--pd-blue);">{{ \App\Models\Setting::get('site_email','durablesuitcasehouse@gmail.com') }}</a></li>
          <li><strong>Phone:</strong> {{ \App\Models\Setting::get('site_phone','+92-300-1234567') }}</li>
          <li><strong>Address:</strong> {{ \App\Models\Setting::get('site_address','123 Jewelry Street, Karachi, Pakistan') }}</li>
        </ul>
        <a href="{{ route('contact.index') }}" class="btn-glamora" style="padding:12px 28px;margin-top:8px;">Contact Our Team</a>
      </div>

    </div>
  </div>
</div>
@endsection


