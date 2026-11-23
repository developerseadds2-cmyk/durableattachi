<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $query = Brand::withCount('products')->latest();
        if ($request->filled('search')) $query->where('name', 'like', '%' . $request->search . '%');
        if ($request->filled('status')) $query->where('status', $request->status === 'active');
        $brands = $query->paginate(20)->withQueryString();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:191', 'slug' => 'nullable|string|max:191|unique:brands,slug', 'logo' => 'nullable|image|max:2048']);
        $data = ['name' => $request->name, 'slug' => Str::slug($request->input('slug') ?: $request->name), 'description' => $request->description, 'status' => $request->boolean('status', true)];
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/brands'), $filename);
            $data['logo'] = $filename;
        }
        Brand::create($data);
        return redirect()->route('admin.brands.index')->with('success', 'Brand created.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate(['name' => 'required|string|max:191', 'slug' => ['nullable', 'string', 'max:191', Rule::unique('brands', 'slug')->ignore($brand->id)], 'logo' => 'nullable|image|max:2048']);
        $data = ['name' => $request->name, 'slug' => Str::slug($request->input('slug') ?: $request->name), 'description' => $request->description, 'status' => $request->boolean('status')];
        if ($request->hasFile('logo')) {
            if ($brand->logo) @unlink(public_path('uploads/brands/' . $brand->logo));
            $file = $request->file('logo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/brands'), $filename);
            $data['logo'] = $filename;
        }
        $brand->update($data);
        return redirect()->route('admin.brands.index')->with('success', 'Brand updated.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted.');
    }

    public function show(Brand $brand)
    {
        return redirect()->route('admin.brands.edit', $brand);
    }
}
