<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart     = Session::get('cart', []);
        $coupon   = Session::get('coupon');
        $subtotal = $this->getSubtotal($cart);
        $discount = $coupon ? $coupon['discount'] : 0;

        return view('frontend.cart.index', compact('cart', 'coupon', 'subtotal', 'discount'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1|max:99',
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->isInStock()) {
            return response()->json(['success' => false, 'message' => 'Product is out of stock.'], 422);
        }

        $cart    = Session::get('cart', []);
        $rowId   = md5($product->id . json_encode($request->attributes ?? []));
        $qty     = $request->quantity;

        if (isset($cart[$rowId])) {
            $cart[$rowId]['quantity'] += $qty;
        } else {
            $cart[$rowId] = [
                'product_id'   => $product->id,
                'name'         => $product->name,
                'slug'         => $product->slug,
                'price'        => $product->current_price,
                'thumbnail'    => $product->thumbnail_url,
                'quantity'     => $qty,
                'attributes'   => $request->attributes ?? [],
            ];
        }

        Session::put('cart', $cart);
        $count = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart!',
            'count'   => $count,
        ]);
    }

    public function update(Request $request)
    {
        $cart = Session::get('cart', []);

        $itemTotal = 0;
        if (isset($cart[$request->row_id])) {
            if ($request->quantity <= 0) {
                unset($cart[$request->row_id]);
            } else {
                $cart[$request->row_id]['quantity'] = (int) $request->quantity;
                $itemTotal = $cart[$request->row_id]['price'] * $cart[$request->row_id]['quantity'];
            }
            Session::put('cart', $cart);
        }

        $subtotal = $this->getSubtotal($cart);

        return response()->json([
            'success'    => true,
            'subtotal'   => number_format($subtotal, 2, '.', ''),
            'item_total' => $itemTotal,
            'count'      => array_sum(array_column($cart, 'quantity')),
        ]);
    }

    public function remove(string $rowId)
    {
        $cart = Session::get('cart', []);
        unset($cart[$rowId]);
        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'count'   => array_sum(array_column($cart, 'quantity')),
            'subtotal' => number_format($this->getSubtotal($cart), 2, '.', ''),
        ]);
    }

    public function clear()
    {
        Session::forget('cart');
        Session::forget('coupon');
        return response()->json(['success' => true]);
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        $coupon   = Coupon::where('code', strtoupper($request->code))->first();
        $cart     = Session::get('cart', []);
        $subtotal = $this->getSubtotal($cart);

        if (!$coupon || !$coupon->isValid($subtotal)) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired coupon code.']);
        }

        $discount = $coupon->calculateDiscount($subtotal);
        Session::put('coupon', [
            'code'     => $coupon->code,
            'discount' => $discount,
            'type'     => $coupon->type,
            'value'    => $coupon->value,
        ]);

        return response()->json([
            'success'  => true,
            'message'  => 'Coupon applied! You saved ' . number_format($discount, 2),
            'discount' => number_format($discount, 2),
        ]);
    }

    public function removeCoupon()
    {
        Session::forget('coupon');
        return response()->json(['success' => true]);
    }

    public function count()
    {
        $cart  = Session::get('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));
        return response()->json(['count' => $count]);
    }

    public function data()
    {
        $cart = Session::get('cart', []);
        $items = collect($cart)->map(function ($item, $rowId) {
            return [
                'row_id' => $rowId,
                'name' => $item['name'],
                'slug' => $item['slug'] ?? null,
                'thumbnail' => $item['thumbnail'] ?? null,
                'price' => (float) $item['price'],
                'quantity' => (int) $item['quantity'],
                'total' => (float) $item['price'] * (int) $item['quantity'],
            ];
        })->values();

        return response()->json([
            'items' => $items,
            'count' => $items->sum('quantity'),
            'subtotal' => $items->sum('total'),
        ]);
    }

    private function getSubtotal(array $cart): float
    {
        return array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
    }
}
