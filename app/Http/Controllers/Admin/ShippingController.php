<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index(Request $request)
    {
        $query = ShippingMethod::latest();
        if ($request->filled('search')) $query->where('name', 'like', '%' . $request->search . '%');
        if ($request->filled('status')) $query->where('status', $request->status === 'active');
        $methods = $query->paginate(20)->withQueryString();
        return view('admin.shipping.index', compact('methods'));
    }

    public function create()
    {
        return view('admin.shipping.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:191', 'price' => 'required|numeric|min:0']);
        $data = $request->except('_token');
        $data['status'] = $request->boolean('status', true);
        ShippingMethod::create($data);
        return redirect()->route('admin.shipping.index')->with('success', 'Shipping method created.');
    }

    public function edit(ShippingMethod $shipping)
    {
        return view('admin.shipping.edit', compact('shipping'));
    }

    public function update(Request $request, ShippingMethod $shipping)
    {
        $data = $request->except(['_token', '_method']);
        $data['status'] = $request->boolean('status');
        $shipping->update($data);
        return redirect()->route('admin.shipping.index')->with('success', 'Shipping method updated.');
    }

    public function destroy(ShippingMethod $shipping)
    {
        $shipping->delete();
        return redirect()->route('admin.shipping.index')->with('success', 'Shipping method deleted.');
    }

    public function show(ShippingMethod $shipping)
    {
        return redirect()->route('admin.shipping.edit', $shipping);
    }
}
