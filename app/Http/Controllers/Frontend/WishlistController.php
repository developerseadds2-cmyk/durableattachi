<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = auth()->user()->wishlists()->with('product.category')->get();
        return view('frontend.account.wishlist', compact('wishlist'));
    }

    public function toggle(int $productId)
    {
        $existing = Wishlist::where('user_id', auth()->id())->where('product_id', $productId)->first();

        if ($existing) {
            $existing->delete();
            $status = false;
            $msg    = 'Removed from wishlist.';
        } else {
            Wishlist::create(['user_id' => auth()->id(), 'product_id' => $productId]);
            $status = true;
            $msg    = 'Added to wishlist!';
        }

        return response()->json([
            'success' => true,
            'wishlisted' => $status,
            'count' => Wishlist::where('user_id', auth()->id())->count(),
            'message' => $msg,
        ]);
    }
}
