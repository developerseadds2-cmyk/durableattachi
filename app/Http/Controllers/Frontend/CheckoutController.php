<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $subtotal        = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        $coupon          = Session::get('coupon');
        $discount        = $coupon ? $coupon['discount'] : 0;
        $shippingMethods = ShippingMethod::active()->get();
        $addresses       = auth()->user()->addresses()->get();

        return view('frontend.checkout.index', compact(
            'cart', 'subtotal', 'coupon', 'discount', 'shippingMethods', 'addresses'
        ));
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'billing_first_name' => 'required|string|max:100',
            'billing_last_name'  => 'required|string|max:100',
            'billing_email'      => 'required|email',
            'billing_phone'      => 'nullable|string|max:20',
            'billing_address'    => 'required|string|max:255',
            'billing_city'       => 'required|string|max:100',
            'billing_state'      => 'required|string|max:100',
            'billing_postal_code'=> 'required|string|max:20',
            'billing_country'    => 'required|string|max:100',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'payment_method'     => 'required|in:cod,razorpay,stripe,paypal',
            'notes'              => 'nullable|string',
        ]);

        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
            $coupon   = Session::get('coupon');
            $discount = $coupon ? $coupon['discount'] : 0;
            $shipping = ShippingMethod::findOrFail($request->shipping_method_id);

            // Check if order qualifies for free shipping
            $shippingCost = ($shipping->free_above && $subtotal >= $shipping->free_above) ? 0 : $shipping->price;
            $total        = $subtotal - $discount + $shippingCost;

            $order = Order::create([
                ...$validated,
                'user_id'         => auth()->id(),
                'order_number'    => Order::generateOrderNumber(),
                'status'          => 'pending',
                'payment_status'  => $request->payment_method === 'cod' ? 'pending' : 'pending',
                'payment_method'  => $request->payment_method,
                'subtotal'        => $subtotal,
                'discount_amount' => $discount,
                'coupon_code'     => $coupon ? $coupon['code'] : null,
                'shipping_amount' => $shippingCost,
                'tax_amount'      => 0,
                'total_amount'    => $total,
            ]);

            // Copy shipping to billing if same
            if ($request->boolean('same_as_billing')) {
                $order->update([
                    'shipping_first_name'  => $request->billing_first_name,
                    'shipping_last_name'   => $request->billing_last_name,
                    'shipping_address'     => $request->billing_address,
                    'shipping_city'        => $request->billing_city,
                    'shipping_state'       => $request->billing_state,
                    'shipping_postal_code' => $request->billing_postal_code,
                    'shipping_country'     => $request->billing_country,
                ]);
            }

            // Create order items & update stock
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item['product_id'],
                    'product_name' => $item['name'],
                    'quantity'     => $item['quantity'],
                    'unit_price'   => $item['price'],
                    'total_price'  => $item['price'] * $item['quantity'],
                    'attributes'   => $item['attributes'] ?? [],
                ]);

                // Decrement stock
                Product::where('id', $item['product_id'])->decrement('stock_quantity', $item['quantity']);
            }

            // Increment coupon usage
            if ($coupon) {
                \App\Models\Coupon::where('code', $coupon['code'])->increment('used_count');
            }

            DB::commit();

            // For COD, finalize order and clear cart now
            if ($request->payment_method === 'cod') {
                Session::forget('cart');
                Session::forget('coupon');
                return redirect()->route('checkout.success', $order->order_number)
                    ->with('success', 'Order placed successfully!');
            }

            // For online gateways (Razorpay, Stripe, PayPal): Keep cart intact until payment succeeds!
            Session::put('pending_order_id', $order->id);

            if ($request->payment_method === 'razorpay') {
                return redirect()->route('payment.razorpay.process', ['order_id' => $order->id]);
            }

            if ($request->payment_method === 'stripe') {
                return redirect()->route('payment.stripe.process')->with(['order_id' => $order->id]);
            }

            return redirect()->route('payment.paypal.redirect', ['order_id' => $order->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order. Please try again. ' . $e->getMessage());
        }
    }

    public function success(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', auth()->id())
            ->with('items.product')
            ->firstOrFail();

        return view('frontend.checkout.success', compact('order'));
    }
}
