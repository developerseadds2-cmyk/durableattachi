<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->search) {
            $query->where('order_number', 'like', "%{$request->search}%")
                  ->orWhere('billing_email', 'like', "%{$request->search}%")
                  ->orWhere('billing_first_name', 'like', "%{$request->search}%");
        }
        if ($request->status) $query->where('status', $request->status);
        if ($request->payment_status) $query->where('payment_status', $request->payment_status);
        if ($request->date_from) $query->whereDate('created_at', '>=', $request->date_from);
        if ($request->date_to) $query->whereDate('created_at', '<=', $request->date_to);

        $orders = $query->paginate(20)->withQueryString();

        $statusCounts = [
            'pending'    => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped'    => Order::where('status', 'shipped')->count(),
            'delivered'  => Order::where('status', 'delivered')->count(),
            'cancelled'  => Order::where('status', 'cancelled')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'statusCounts'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'user', 'payments']);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status'          => 'sometimes|in:pending,processing,confirmed,shipped,delivered,cancelled,refunded',
            'tracking_number' => 'nullable|string|max:191',
            'notes'           => 'nullable|string',
        ]);

        $data = $request->only(['status', 'tracking_number', 'notes']);
        if ($request->status === 'shipped' && !$order->shipped_at) {
            $data['shipped_at'] = now();
        }
        if ($request->status === 'delivered' && !$order->delivered_at) {
            $data['delivered_at'] = now();
        }
        if ($request->status === 'delivered' && $order->payment_method === 'cod') {
            $data['payment_status'] = 'paid';
        }

        $order->update($data);
        return redirect()->route('admin.orders.show', $order)->with('success', 'Order updated successfully.');
    }

    public function updateStatus(Request $request, int $id)
    {
        $order = Order::findOrFail($id);
        $request->validate(['status' => 'required|in:pending,processing,confirmed,shipped,delivered,cancelled,refunded']);

        $data = ['status' => $request->status];
        if ($request->status === 'delivered') {
            $data['delivered_at'] = $order->delivered_at ?: now();
            if ($order->payment_method === 'cod') {
                $data['payment_status'] = 'paid';
            }
        }
        $order->update($data);

        if ($request->status === 'shipped') $order->update(['shipped_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated.',
            'payment_status' => $order->payment_status,
        ]);
    }

    public function updatePayment(Request $request, int $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['payment_status' => $request->payment_status]);
        return response()->json(['success' => true, 'message' => 'Payment status updated.']);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted.');
    }

    public function invoice(Order $order)
    {
        $order->load(['items.product', 'user']);
        return view('admin.orders.invoice', compact('order'));
    }
}
