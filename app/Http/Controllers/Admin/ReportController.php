<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $period = $request->period ?? 'monthly';
        $from   = $request->from ? Carbon::parse($request->from) : Carbon::now()->subMonths(6);
        $to     = $request->to   ? Carbon::parse($request->to)   : Carbon::now();

        $orders = Order::where('payment_status', 'paid')
            ->whereBetween('created_at', [$from->startOfDay(), $to->endOfDay()])
            ->get();

        $totalRevenue   = $orders->sum('total_amount');
        $totalOrders    = $orders->count();
        $avgOrderValue  = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        return view('admin.reports.sales', compact('orders', 'totalRevenue', 'totalOrders', 'avgOrderValue', 'from', 'to'));
    }

    public function products(Request $request)
    {
        $products = Product::withCount('orderItems')
            ->withSum('orderItems', 'total_price')
            ->orderByDesc('order_items_count')
            ->paginate(20);

        return view('admin.reports.products', compact('products'));
    }

    public function customers(Request $request)
    {
        $customers = User::where('role', 'customer')
            ->withCount('orders')
            ->withSum('orders', 'total_amount')
            ->orderByDesc('orders_count')
            ->paginate(20);

        return view('admin.reports.customers', compact('customers'));
    }
}
