@extends('frontend.layouts.app')

@section('title', 'Processing Payment - ' . config('app.name'))

@push('styles')
<style>
.razorpay-checkout-section {
  background: #f8fafc;
  min-height: 70vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 60px 15px;
}
.payment-card-box {
  background: #ffffff;
  border-radius: 18px;
  border: 1px solid #e2e8f0;
  box-shadow: 0 12px 35px rgba(20, 45, 78, 0.08);
  max-width: 480px;
  width: 100%;
  padding: 36px 32px;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.payment-card-topbar {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 5px;
  background: linear-gradient(90deg, #142D4E 0%, #C59A55 50%, #142D4E 100%);
}
.shield-icon-circle {
  width: 68px;
  height: 68px;
  border-radius: 50%;
  background: #eff6ff;
  color: #142D4E;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.8rem;
  margin: 0 auto 20px;
  border: 2px solid #dbeafe;
}
.payment-title {
  font-family: var(--font-serif, "Playfair Display", Georgia, serif);
  font-size: 1.75rem;
  font-weight: 700;
  color: #142D4E;
  margin-bottom: 6px;
}
.payment-order-sub {
  color: #64748b;
  font-size: 0.92rem;
  margin-bottom: 24px;
}
.order-num-pill {
  font-weight: 700;
  color: #0f172a;
  background: #f1f5f9;
  padding: 2px 8px;
  border-radius: 6px;
}
.payment-amount-box {
  background: #f8fafc;
  border: 1.5px dashed #cbd5e1;
  border-radius: 12px;
  padding: 18px 20px;
  margin-bottom: 26px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.payment-amount-label {
  font-size: 0.92rem;
  font-weight: 600;
  color: #475569;
}
.payment-amount-val {
  font-size: 1.75rem;
  font-weight: 800;
  color: #142D4E;
}
.btn-rzp-pay {
  background: #142D4E;
  color: #ffffff;
  font-size: 1rem;
  font-weight: 700;
  padding: 14px 24px;
  border-radius: 10px;
  border: none;
  width: 100%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  box-shadow: 0 6px 18px rgba(20, 45, 78, 0.25);
  transition: all 0.25s ease;
  cursor: pointer;
  text-decoration: none;
  margin-bottom: 16px;
}
.btn-rzp-pay:hover {
  background: #1e3f6b;
  color: #ffffff;
  transform: translateY(-2px);
  box-shadow: 0 8px 22px rgba(20, 45, 78, 0.3);
}
.btn-cancel-checkout {
  color: #64748b;
  font-size: 0.88rem;
  font-weight: 600;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: color 0.2s;
}
.btn-cancel-checkout:hover {
  color: #0f172a;
}
.payment-trust-footer {
  margin-top: 28px;
  padding-top: 18px;
  border-top: 1px solid #f1f5f9;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  font-size: 0.78rem;
  color: #94a3b8;
}
.payment-trust-footer i {
  color: #16a34a;
}
.methods-accepted-badges {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  margin-bottom: 22px;
  flex-wrap: wrap;
}
.method-badge-item {
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 6px;
  padding: 4px 10px;
  font-size: 0.75rem;
  font-weight: 700;
  color: #475569;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
</style>
@endpush

@section('content')
<div class="razorpay-checkout-section">
  <div class="payment-card-box">
    <div class="payment-card-topbar"></div>

    <div class="shield-icon-circle">
      <i class="fa-solid fa-shield-halved"></i>
    </div>

    <h1 class="payment-title">Secure Payment</h1>
    <p class="payment-order-sub">Order <span class="order-num-pill">#{{ $order->order_number }}</span></p>

    <!-- Payment Methods Accepted Badge strip -->
    <div class="methods-accepted-badges">
      <span class="method-badge-item"><i class="fa-solid fa-qrcode text-primary"></i> UPI / QR</span>
      <span class="method-badge-item"><i class="fa-brands fa-google-pay text-dark"></i> GPay</span>
      <span class="method-badge-item"><i class="fa-solid fa-mobile-screen-button text-purple"></i> PhonePe</span>
      <span class="method-badge-item"><i class="fa-solid fa-credit-card text-success"></i> Cards &amp; RuPay</span>
    </div>

    <div class="payment-amount-box">
      <span class="payment-amount-label">Amount Payable</span>
      <span class="payment-amount-val">₹{{ number_format($order->total_amount, 2) }}</span>
    </div>

    <button type="button" id="rzp-button1" class="btn-rzp-pay">
      <i class="fa-solid fa-lock"></i>
      <span>Pay Now with Razorpay</span>
    </button>

    <div>
      <a href="{{ route('checkout.index') }}" class="btn-cancel-checkout">
        <i class="fa-solid fa-arrow-left"></i> Cancel and Return to Checkout
      </a>
    </div>

    <div class="payment-trust-footer">
      <span><i class="fa-solid fa-lock"></i> 256-Bit SSL Encrypted</span>
      <span>•</span>
      <span>Razorpay Verified</span>
    </div>
  </div>
</div>

<form name="razorpayform" action="{{ route('payment.razorpay.verify') }}" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    <input type="hidden" name="order_id" value="{{ $order->id }}">
</form>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const options = {
        "key": "{{ $keyId }}",
        "amount": "{{ $amountInPaise }}",
        "currency": "INR",
        "name": "{{ config('app.name', 'Durable Suitcase House') }}",
        "description": "Order #{{ $order->order_number }}",
        @if(!empty($modalImage))
        "image": "{{ $modalImage }}",
        @endif
        @if($razorpayOrderId)
        "order_id": "{{ $razorpayOrderId }}",
        @endif
        "handler": function (response) {
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('razorpay_order_id').value = response.razorpay_order_id || '{{ $razorpayOrderId ?? "" }}';
            document.getElementById('razorpay_signature').value = response.razorpay_signature || '';
            document.razorpayform.submit();
        },
        "prefill": {
            "name": "{{ addslashes($order->customer_name) }}",
            "email": "{{ addslashes($order->customer_email) }}",
            "contact": "{{ addslashes($order->customer_phone) }}"
        },
        "theme": {
            "color": "#142D4E"
        },
        "modal": {
            "ondismiss": function() {
                console.log('Razorpay modal closed');
            }
        }
    };

    const rzp1 = new Razorpay(options);
    
    document.getElementById('rzp-button1').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    };

    // Auto trigger Razorpay checkout modal
    setTimeout(function() {
        rzp1.open();
    }, 400);
});
</script>
@endsection
