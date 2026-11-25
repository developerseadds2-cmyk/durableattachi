<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        $query = Color::withCount('products')->latest();

        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $colors = $query->paginate(20)->withQueryString();
        return view('admin.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:100|unique:colors,name',
            'code'   => 'nullable|string|max:50',
            'status' => 'boolean',
        ]);

        $validated['status'] = $request->boolean('status', true);

        Color::create($validated);

        return redirect()->route('admin.colors.index')
            ->with('success', 'Color created successfully.');
    }

    public function edit(Color $color)
    {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:100|unique:colors,name,' . $color->id,
            'code'   => 'nullable|string|max:50',
            'status' => 'boolean',
        ]);

        $validated['status'] = $request->boolean('status', true);

        $color->update($validated);

        return redirect()->route('admin.colors.index')
            ->with('success', 'Color updated successfully.');
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->route('admin.colors.index')
            ->with('success', 'Color deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:colors,id',
        ]);

        $count = Color::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.colors.index')
            ->with('success', "{$count} colors deleted successfully.");
    }
}
