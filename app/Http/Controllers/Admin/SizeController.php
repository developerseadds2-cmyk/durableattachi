<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index(Request $request)
    {
        $query = Size::withCount('products')->latest();

        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('code', 'like', "%{$request->search}%");
        }

        $sizes = $query->paginate(20)->withQueryString();
        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:100|unique:sizes,name',
            'code'   => 'nullable|string|max:50',
            'status' => 'boolean',
        ]);

        $validated['status'] = $request->boolean('status', true);

        Size::create($validated);

        return redirect()->route('admin.sizes.index')
            ->with('success', 'Size created successfully.');
    }

    public function edit(Size $size)
    {
        return view('admin.sizes.edit', compact('size'));
    }

    public function update(Request $request, Size $size)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:100|unique:sizes,name,' . $size->id,
            'code'   => 'nullable|string|max:50',
            'status' => 'boolean',
        ]);

        $validated['status'] = $request->boolean('status', true);

        $size->update($validated);

        return redirect()->route('admin.sizes.index')
            ->with('success', 'Size updated successfully.');
    }

    public function destroy(Size $size)
    {
        $size->delete();
        return redirect()->route('admin.sizes.index')
            ->with('success', 'Size deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:sizes,id',
        ]);

        $count = Size::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.sizes.index')
            ->with('success', "{$count} sizes deleted successfully.");
    }
}
