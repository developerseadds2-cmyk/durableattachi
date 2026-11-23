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
            Session::forget(['pending_order_id', 'paypal_order_id']);

            return redirect()->route('checkout.success', $order->order_number)
                ->with('success', 'Payment successful via PayPal!');

        } catch (\Exception $e) {
            return redirect()->route('checkout.index')->with('error', 'PayPal payment verification failed.');
        }
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
