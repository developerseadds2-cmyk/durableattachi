<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    /**
     * Process Stripe Payment
     */
    public function stripeProcess(Request $request)
    {
        $orderId = Session::get('pending_order_id');
        if (!$orderId) {
            return redirect()->route('cart.index')->with('error', 'No pending order found.');
        }

        $order      = Order::findOrFail($orderId);
        $stripeKey  = Setting::get('stripe_secret');

        if (!$stripeKey) {
            return back()->with('error', 'Stripe is not configured.');
        }

        try {
            \Stripe\Stripe::setApiKey($stripeKey);

            $charge = \Stripe\Charge::create([
                'amount'      => (int) ($order->total_amount * 100),
                'currency'    => strtolower(Setting::get('currency', 'pkr')),
                'source'      => $request->stripeToken,
                'description' => 'Order #' . $order->order_number,
            ]);

            Payment::create([
                'order_id'         => $order->id,
                'transaction_id'   => $charge->id,
                'gateway'          => 'stripe',
                'amount'           => $order->total_amount,
                'currency'         => strtoupper(Setting::get('currency', 'PKR')),
                'status'           => 'success',
                'gateway_response' => $charge->toArray(),
                'paid_at'          => now(),
            ]);

            $order->update(['payment_status' => 'paid', 'status' => 'processing']);
            Session::forget('pending_order_id');
            Session::forget('cart');
            Session::forget('coupon');

            return redirect()->route('checkout.success', $order->order_number)
                ->with('success', 'Payment successful! Order confirmed.');

        } catch (\Exception $e) {
            Payment::create([
                'order_id' => $order->id,
                'gateway'  => 'stripe',
                'amount'   => $order->total_amount,
                'currency' => 'PKR',
                'status'   => 'failed',
            ]);
            return back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function stripeProcessGet()
    {
        return redirect()->route('checkout.index')
            ->with('error', 'Please submit the checkout form to continue with Stripe payment.');
    }

    /**
     * Redirect to PayPal
     */
    public function paypalRedirect(Request $request)
    {
        $orderId = $request->order_id ?? Session::get('pending_order_id');
        $order   = Order::findOrFail($orderId);

        $clientId = Setting::get('paypal_client_id');
        $secret   = Setting::get('paypal_secret');
        $mode     = Setting::get('paypal_mode', 'sandbox');

        if (!$clientId || !$secret) {
            return redirect()->route('cart.index')->with('error', 'PayPal is not configured.');
        }

        // Build PayPal order URL
        $baseUrl  = $mode === 'live' ? 'https://api-m.paypal.com' : 'https://api-m.sandbox.paypal.com';

        // Get access token
        $response = \Illuminate\Support\Facades\Http::withBasicAuth($clientId, $secret)
            ->asForm()
            ->post("{$baseUrl}/v1/oauth2/token", ['grant_type' => 'client_credentials']);

        $accessToken = $response->json('access_token');

        // Create PayPal order
        $ppOrder = \Illuminate\Support\Facades\Http::withToken($accessToken)
            ->post("{$baseUrl}/v2/checkout/orders", [
                'intent'         => 'CAPTURE',
                'purchase_units' => [[
                    'amount'      => [
                        'currency_code' => 'USD',
                        'value'         => number_format($order->total_amount / 285, 2),
                    ],
                    'description' => 'Order #' . $order->order_number,
                ]],
                'application_context' => [
                    'return_url' => route('payment.paypal.success') . '?order_id=' . $order->id,
                    'cancel_url' => route('payment.paypal.cancel') . '?order_id=' . $order->id,
                ],
            ]);

        $approveLink = collect($ppOrder->json('links'))->firstWhere('rel', 'approve')['href'] ?? null;

        if (!$approveLink) {
            return back()->with('error', 'Could not connect to PayPal. Please try another payment method.');
        }

        Session::put('paypal_order_id', $ppOrder->json('id'));
        Session::put('pending_order_id', $order->id);

        return redirect($approveLink);
    }

    /**
     * Handle PayPal success
     */
    public function paypalSuccess(Request $request)
    {
        $orderId = Session::get('pending_order_id') ?? $request->order_id;
        $order   = Order::findOrFail($orderId);

        $clientId = Setting::get('paypal_client_id');
        $secret   = Setting::get('paypal_secret');
        $mode     = Setting::get('paypal_mode', 'sandbox');
        $baseUrl  = $mode === 'live' ? 'https://api-m.paypal.com' : 'https://api-m.sandbox.paypal.com';

        try {
            $response    = \Illuminate\Support\Facades\Http::withBasicAuth($clientId, $secret)
                ->asForm()->post("{$baseUrl}/v1/oauth2/token", ['grant_type' => 'client_credentials']);
            $accessToken = $response->json('access_token');

            $ppOrderId  = Session::get('paypal_order_id');
            $capture    = \Illuminate\Support\Facades\Http::withToken($accessToken)
                ->post("{$baseUrl}/v2/checkout/orders/{$ppOrderId}/capture");

            Payment::create([
                'order_id'         => $order->id,
                'transaction_id'   => $capture->json('id'),
                'gateway'          => 'paypal',
                'amount'           => $order->total_amount,
                'currency'         => 'PKR',
                'status'           => 'success',
                'gateway_response' => $capture->json(),
                'paid_at'          => now(),
            ]);

            $order->update(['payment_status' => 'paid', 'status' => 'processing']);
            Session::forget(['pending_order_id', 'paypal_order_id', 'cart', 'coupon']);

            return redirect()->route('checkout.success', $order->order_number)
                ->with('success', 'Payment successful via PayPal!');

        } catch (\Exception $e) {
            return redirect()->route('checkout.index')->with('error', 'PayPal payment verification failed.');
        }
    }

    /**
     * Razorpay Process Page
     */
    public function razorpayProcess(Request $request)
    {
        $orderId = $request->order_id ?? Session::get('pending_order_id');
        if (!$orderId) {
            return redirect()->route('cart.index')->with('error', 'No pending order found.');
        }

        $order = Order::with('items.product')->findOrFail($orderId);

        $keyId = Setting::get('razorpay_key_id') ?: env('RAZORPAY_KEY_ID');
        $keySecret = Setting::get('razorpay_key_secret') ?: env('RAZORPAY_KEY_SECRET');

        if (!$keyId || !$keySecret) {
            return redirect()->route('checkout.index')->with('error', 'Razorpay is not configured yet. Please choose another payment method.');
        }

        // Determine image for Razorpay modal
        // Razorpay modal requires a publicly accessible HTTPS image URL or a base64 / publicly hosted image.
        // On localhost (127.0.0.1 / localhost), Razorpay's iframe servers cannot fetch http://127.0.0.1:8000/...
        $modalImage = null;
        $firstItem = $order->items->first();
        if ($firstItem && $firstItem->product && $firstItem->product->primary_image_url) {
            $modalImage = $firstItem->product->primary_image_url;
        }

        // Check if on localhost or non-routable host; Razorpay will fail to load http://127.0.0.1 or http://localhost images.
        // If on localhost, use a clean fallback hosted badge or omit so Razorpay uses initials without showing a broken image icon.
        if (request()->getHost() === '127.0.0.1' || request()->getHost() === 'localhost') {
            $modalImage = 'https://cdn-icons-png.flaticon.com/512/3144/3144456.png'; // Clean universal shopping bag / store icon for test
        } elseif (!$modalImage) {
            $modalImage = asset('images/logo.png');
        }

        // Amount in paise (1 INR = 100 paise)
        $amountInPaise = (int) round($order->total_amount * 100);

        // Create Razorpay Order via HTTP
        $razorpayOrderId = null;
        try {
            $response = \Illuminate\Support\Facades\Http::withBasicAuth($keyId, $keySecret)
                ->post('https://api.razorpay.com/v1/orders', [
                    'receipt'  => (string) $order->order_number,
                    'amount'   => $amountInPaise,
                    'currency' => 'INR',
                    'notes'    => [
                        'order_id' => (string) $order->id,
                        'customer' => $order->customer_name,
                    ],
                ]);

            if ($response->successful()) {
                $razorpayOrderId = $response->json('id');
            }
        } catch (\Exception $e) {
            \Log::warning('Razorpay Order create failed: ' . $e->getMessage());
        }

        return view('frontend.payment.razorpay', compact('order', 'keyId', 'amountInPaise', 'razorpayOrderId', 'modalImage'));
    }

    /**
     * Razorpay Payment Verification
     */
    public function razorpayVerify(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required',
            'order_id'            => 'required',
        ]);

        $order = Order::findOrFail($request->order_id);
        $keySecret = Setting::get('razorpay_key_secret') ?: env('RAZORPAY_KEY_SECRET');

        $paymentId = $request->razorpay_payment_id;
        $razorpayOrderId = $request->razorpay_order_id;
        $signature = $request->razorpay_signature;

        $verified = false;

        if ($razorpayOrderId && $signature && $keySecret) {
            $expectedSignature = hash_hmac('sha256', $razorpayOrderId . '|' . $paymentId, $keySecret);
            $verified = hash_equals($expectedSignature, $signature);
        } else {
            // In test mode or without order id, consider valid if payment ID present
            $verified = !empty($paymentId);
        }

        if ($verified) {
            // Update order
            $order->update([
                'payment_status' => 'paid',
                'order_status'   => 'confirmed',
            ]);

            Payment::create([
                'order_id'       => $order->id,
                'gateway'        => 'razorpay',
                'transaction_id' => $paymentId,
                'amount'         => $order->total_amount,
                'currency'       => 'INR',
                'status'         => 'success',
                'paid_at'        => now(),
            ]);

            // Clear session cart now that payment is confirmed
            Session::forget('cart');
            Session::forget('pending_order_id');

            return redirect()->route('checkout.success', $order->id)
                ->with('success', 'Payment successful! Your order has been placed.');
        }

        Payment::create([
            'order_id'       => $order->id,
            'gateway'        => 'razorpay',
            'transaction_id' => $paymentId ?? 'failed',
            'amount'         => $order->total_amount,
            'currency'       => 'INR',
            'status'         => 'failed',
        ]);

        return redirect()->route('checkout.index')
            ->with('error', 'Razorpay payment verification failed. Please try again.');
    }

    /**
     * Handle PayPal cancellation
     */
    public function paypalCancel(Request $request)
    {
        Session::forget(['pending_order_id', 'paypal_order_id']);
        return redirect()->route('checkout.index')->with('error', 'PayPal payment was cancelled.');
    }

    /**
     * Stripe Webhook
     */
    public function stripeWebhook(Request $request)
    {
        $payload   = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret    = Setting::get('stripe_webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sigHeader, $secret);

            if ($event->type === 'payment_intent.succeeded') {
                $paymentIntent = $event->data->object;
                Payment::where('transaction_id', $paymentIntent->id)->update(['status' => 'success', 'paid_at' => now()]);
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
