<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Contact;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function loginForm()
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            if (!Auth::user()->isAdmin()) {
                Auth::logout();
                return back()->with('error', 'Access denied. Admin privileges required.');
            }
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, ' . Auth::user()->name . '!');
        }

        return back()->with('error', 'Invalid credentials.')->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }

    public function index()
    {
        // Stats
        $stats = [
            'total_orders'    => Order::count(),
            'pending_orders'  => Order::where('status', 'pending')->count(),
            'total_revenue'   => Order::where('payment_status', 'paid')->sum('total_amount'),
            'today_revenue'   => Order::where('payment_status', 'paid')->whereDate('created_at', today())->sum('total_amount'),
            'total_products'  => Product::count(),
            'low_stock'       => Product::where('stock_quantity', '>', 0)->whereColumn('stock_quantity', '<=', 'low_stock_threshold')->count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'new_customers'   => User::where('role', 'customer')->whereMonth('created_at', now()->month)->count(),
            'unread_contacts' => Contact::where('is_read', false)->count(),
            'pending_reviews' => Review::where('status', 'pending')->count(),
        ];

        // Recent Orders
        $recentOrders = Order::with('user')->latest()->limit(10)->get();

        // Monthly revenue chart (last 6 months)
        $chartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $chartData[] = [
                'month'   => $month->format('M Y'),
                'revenue' => Order::where('payment_status', 'paid')
                    ->whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->sum('total_amount'),
                'orders' => Order::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count(),
            ];
        }

        // Top Products
        $topProducts = Product::withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->limit(5)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'recentOrders', 'chartData', 'topProducts'));
    }
}
