<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Invoice #{{ $order->order_number }} — Ayur Naman</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Segoe UI', sans-serif; font-size: 13px; color: #333; padding: 40px; }
  .invoice-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px; }
  .brand { font-size: 2rem; font-weight: 300; color: #1a1005; font-style: italic; }
  .invoice-title { font-size: 2rem; font-weight: 700; color: #c9a96e; }
  .invoice-meta { text-align: right; font-size: 0.85rem; color: #666; }
  .addresses { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 30px; }
  .address-box { background: #f9f6f1; padding: 16px; }
  .address-label { font-size: 0.65rem; letter-spacing: 2px; text-transform: uppercase; color: #c9a96e; font-weight: 700; margin-bottom: 6px; }
  table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
  table thead { background: #1a1005; color: #fff; }
  table thead th { padding: 10px 12px; font-size: 0.78rem; font-weight: 600; letter-spacing: 0.5px; }
  table tbody td { padding: 10px 12px; border-bottom: 1px solid #eee; }
  .totals-row td { padding: 6px 12px; }
  .totals-row.grand td { font-size: 1rem; font-weight: 700; border-top: 2px solid #1a1005; padding-top: 12px; }
  .footer-note { text-align: center; color: #999; font-size: 0.8rem; margin-top: 40px; border-top: 1px solid #eee; padding-top: 20px; }
  @media print { body { padding: 20px; } .no-print { display: none; } }
</style>
</head>
<body>
<div class="no-print" style="margin-bottom:20px;">
  <button onclick="window.print()" style="background:#c9a96e;color:#fff;border:none;padding:10px 24px;cursor:pointer;font-size:0.85rem;font-weight:600;letter-spacing:1px;text-transform:uppercase;">🖨️ Print Invoice</button>
  <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}" style="margin-left:12px;color:#666;text-decoration:none;font-size:0.85rem;">← Back to Order</a>
</div>

<div class="invoice-header">
  <div>
    <div class="brand">Ayur Naman</div>
    <div style="font-size:0.8rem;color:#666;margin-top:4px;">{{ \App\Models\Setting::get('site_address') }}</div>
    <div style="font-size:0.8rem;color:#666;">{{ \App\Models\Setting::get('site_email') }} | {{ \App\Models\Setting::get('site_phone') }}</div>
  </div>
  <div>
    <div class="invoice-title">INVOICE</div>
    <div class="invoice-meta">
      <div><strong>Invoice #:</strong> {{ $order->order_number }}</div>
      <div><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</div>
      <div><strong>Status:</strong> {{ ucfirst($order->status) }}</div>
      <div><strong>Payment:</strong> {{ strtoupper($order->payment_method) }}</div>
    </div>
  </div>
</div>

<div class="addresses">
  <div class="address-box">
    <div class="address-label">Bill To</div>
    <strong>{{ $order->billing_first_name }} {{ $order->billing_last_name }}</strong><br>
    {{ $order->billing_address }}<br>
    {{ $order->billing_city }}, {{ $order->billing_state }} {{ $order->billing_postal_code }}<br>
    {{ $order->billing_country }}<br>
    {{ $order->billing_email }}<br>
    {{ $order->billing_phone }}
  </div>
  @if($order->shipping_address)
  <div class="address-box">
    <div class="address-label">Ship To</div>
    <strong>{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</strong><br>
    {{ $order->shipping_address }}<br>
    {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_postal_code }}<br>
    {{ $order->shipping_country }}
  </div>
  @endif
</div>

<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Product</th>
      <th>SKU</th>
      <th style="text-align:right;">Unit Price</th>
      <th style="text-align:center;">Qty</th>
      <th style="text-align:right;">Total</th>
    </tr>
  </thead>
  <tbody>
    @foreach($order->items as $i => $item)
    <tr>
      <td>{{ $i + 1 }}</td>
      <td>{{ $item->product_name }}</td>
      <td style="color:#999;">{{ $item->product_sku ?? '—' }}</td>
      <td style="text-align:right;">₨{{ number_format($item->unit_price, 2) }}</td>
      <td style="text-align:center;">{{ $item->quantity }}</td>
      <td style="text-align:right; font-weight:600;">₨{{ number_format($item->total_price, 2) }}</td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr class="totals-row">
      <td colspan="5" style="text-align:right; color:#666;">Subtotal</td>
      <td style="text-align:right;">₨{{ number_format($order->subtotal, 2) }}</td>
    </tr>
    @if($order->discount_amount > 0)
    <tr class="totals-row">
      <td colspan="5" style="text-align:right; color:#666;">Discount ({{ $order->coupon_code }})</td>
      <td style="text-align:right; color:green;">-₨{{ number_format($order->discount_amount, 2) }}</td>
    </tr>
    @endif
    <tr class="totals-row">
      <td colspan="5" style="text-align:right; color:#666;">Shipping</td>
      <td style="text-align:right;">{{ $order->shipping_amount > 0 ? '₨'.number_format($order->shipping_amount, 2) : 'Free' }}</td>
    </tr>
    <tr class="totals-row grand">
      <td colspan="5" style="text-align:right;">TOTAL</td>
      <td style="text-align:right; color:#c9a96e;">₨{{ number_format($order->total_amount, 2) }}</td>
    </tr>
  </tfoot>
</table>

@if($order->notes)
<div style="background:#f9f6f1;padding:12px 16px;margin-top:20px;">
  <strong>Notes:</strong> {{ $order->notes }}
</div>
@endif

<div class="footer-note">
  <p>Thank you for shopping with Ayur Naman!</p>
  <p>For questions, contact us at {{ \App\Models\Setting::get('site_email') }}</p>
</div>
</body>
</html>
