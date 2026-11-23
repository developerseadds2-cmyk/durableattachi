<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function dashboard()
    {
        $user         = auth()->user();
        $recentOrders = Order::where('user_id', $user->id)->latest()->limit(5)->get();
        $stats        = [
            'total_orders'    => Order::where('user_id', $user->id)->count(),
            'pending_orders'  => Order::where('user_id', $user->id)->where('status', 'pending')->count(),
            'delivered_orders'=> Order::where('user_id', $user->id)->where('status', 'delivered')->count(),
            'wishlist_count'  => $user->wishlists()->count(),
        ];
        return view('frontend.account.dashboard', compact('user', 'recentOrders', 'stats'));
    }

    public function profile()
    {
        return view('frontend.account.profile', ['user' => auth()->user()]);
    }

    public function updateProfile(Request $request)
    {
        $user      = auth()->user();
        $validated = $request->validate([
            'name'   => 'required|string|max:191',
            'email'  => 'required|email|unique:users,email,' . $user->id,
            'phone'  => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) @unlink(public_path('uploads/avatars/' . $user->avatar));
            $file     = $request->file('avatar');
            $filename = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/avatars'), $filename);
            $validated['avatar'] = $filename;
        }

        $user->update($validated);
        return back()->with('success', 'Profile updated successfully.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        auth()->user()->update(['password' => Hash::make($request->password)]);
        return back()->with('success', 'Password changed successfully.');
    }

    public function orders()
    {
        $orders = Order::where('user_id', auth()->id())->latest()->paginate(10);
        return view('frontend.account.orders', compact('orders'));
    }

    public function orderDetail(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', auth()->id())
            ->with('items.product', 'payments')
            ->firstOrFail();
        return view('frontend.account.order-detail', compact('order'));
    }

    public function addresses()
    {
        $addresses = auth()->user()->addresses()->get();
        return view('frontend.account.addresses', compact('addresses'));
    }

    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'type'          => 'required|in:billing,shipping',
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'address_line1' => 'required|string|max:255',
            'city'          => 'required|string|max:100',
            'state'         => 'required|string|max:100',
            'postal_code'   => 'required|string|max:20',
            'country'       => 'required|string|max:100',
        ]);

        $validated['user_id']    = auth()->id();
        $validated['is_default'] = $request->boolean('is_default');

        if ($validated['is_default']) {
            Address::where('user_id', auth()->id())->where('type', $validated['type'])->update(['is_default' => false]);
        }

        Address::create($validated);
        return back()->with('success', 'Address added successfully.');
    }

    public function updateAddress(Request $request, int $id)
    {
        $address = Address::where('user_id', auth()->id())->findOrFail($id);
        $address->update($request->validated());
        return back()->with('success', 'Address updated.');
    }

    public function deleteAddress(int $id)
    {
        Address::where('user_id', auth()->id())->findOrFail($id)->delete();
        return back()->with('success', 'Address deleted.');
    }

    public function wishlist()
    {
        $wishlist = auth()->user()->wishlists()->with('product.category')->get();
        return view('frontend.account.wishlist', compact('wishlist'));
    }
}
