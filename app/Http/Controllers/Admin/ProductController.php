<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Color;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand'])->latest();

        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('sku', 'like', "%{$request->search}%");
        }
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->stock === 'low') {
            $query->where('stock_quantity', '>', 0)->whereColumn('stock_quantity', '<=', 'low_stock_threshold');
        } elseif ($request->stock === 'out') {
            $query->where('stock_quantity', 0);
        }

        // Support per_page option: 10, 20, 50, 100 or 'all'
        $perPage = $request->input('per_page', 20);
        if ($perPage === 'all' || (int)$perPage > 500) {
            $perPage = 1000;
        } else {
            $perPage = max(10, min(100, (int)$perPage));
        }

        $products   = $query->paginate($perPage)->withQueryString();
        $categories = Category::active()->whereNull('parent_id')->with('children')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::active()->orderBy('name')->get();
        $brands     = Brand::where('status', true)->orderBy('name')->get();
        $colors     = Color::where('status', true)->orderBy('name')->get();
        return view('admin.products.create', compact('categories', 'brands', 'colors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:191',
            'slug'                 => 'nullable|string|max:191|unique:products,slug',
            'category_id'          => 'required|exists:categories,id',
            'brand_id'             => 'nullable|exists:brands,id',
            'color_id'             => 'nullable|exists:colors,id',
            'sku'                  => 'nullable|string|max:100|unique:products',
            'price'                => 'required|numeric|min:0',
            'sale_price'           => 'nullable|numeric|min:0|lt:price',
            'cost_price'           => 'nullable|numeric|min:0',
            'stock_quantity'       => 'required|integer|min:0',
            'short_description'    => 'nullable|string',
            'description'          => 'nullable|string',
            'material'             => 'nullable|string|max:150',
            'warranty_details'     => 'nullable|string|max:255',
            'product_warranty'     => 'nullable|string|max:100',
            'manufacturer_details' => 'nullable|string',
            'tax_rate'             => 'nullable|numeric|min:0|max:100',
            'hsn_code'             => 'nullable|string|max:50',
            'weight'               => 'nullable|numeric|min:0',
            'status'               => 'required|in:active,inactive,draft',
            'thumbnail'            => 'nullable|file',
            'images.*'             => 'nullable|file',
        ]);

        $validated['slug'] = Str::slug($request->input('slug') ?: $request->name);

        // Handle thumbnail
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->uploadFile($request->file('thumbnail'), 'products');
        }

        $validated['is_featured']    = $request->boolean('is_featured');
        $validated['is_new_arrival'] = $request->boolean('is_new_arrival');
        $validated['is_best_seller'] = $request->boolean('is_best_seller');

        $product = Product::create($validated);

        // Handle multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $filename = $this->uploadFile($image, 'products');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $filename,
                    'sort_order' => $index,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        // Handle attributes
        if ($request->has('attributes')) {
            foreach ($request->attributes as $attr) {
                if (!empty($attr['name']) && !empty($attr['value'])) {
                    $product->attributes()->create([
                        'attribute_name'   => $attr['name'],
                        'attribute_value'  => $attr['value'],
                        'price_adjustment' => $attr['price_adjustment'] ?? 0,
                        'stock'            => $attr['stock'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'brand', 'images', 'attributes', 'reviews.user']);
        return view('admin.products.show', compact('product'));
    }

    public function duplicate(Product $product)
    {
        $product->load(['images', 'attributes']);

        $copy = $product->replicate();
        $copy->name = $this->uniqueProductName($product->name);
        $copy->slug = $this->uniqueProductSlug($copy->name);
        $copy->sku = $product->sku ? $this->uniqueSku($product->sku) : null;
        $copy->status = 'draft';
        $copy->views = 0;

        if ($product->thumbnail) {
            $copy->thumbnail = $this->copyProductFile($product->thumbnail);
        }

        $copy->save();

        foreach ($product->images as $image) {
            $copy->images()->create([
                'image' => $this->copyProductFile($image->image),
                'alt_text' => $image->alt_text,
                'sort_order' => $image->sort_order,
                'is_primary' => $image->is_primary,
            ]);
        }

        foreach ($product->attributes as $attribute) {
            $copy->attributes()->create([
                'attribute_name' => $attribute->attribute_name,
                'attribute_value' => $attribute->attribute_value,
                'price_adjustment' => $attribute->price_adjustment,
                'stock' => $attribute->stock,
            ]);
        }

        return redirect()->route('admin.products.edit', $copy)
            ->with('success', 'Product duplicated. Review the copy before publishing.');
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'attributes']);
        $categories = Category::active()->orderBy('name')->get();
        $brands     = Brand::where('status', true)->orderBy('name')->get();
        $colors     = Color::where('status', true)->orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'colors'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:191',
            'slug'                 => ['nullable', 'string', 'max:191', Rule::unique('products', 'slug')->ignore($product->id)],
            'category_id'          => 'required|exists:categories,id',
            'brand_id'             => 'nullable|exists:brands,id',
            'color_id'             => 'nullable|exists:colors,id',
            'sku'                  => 'nullable|string|max:100|unique:products,sku,' . $product->id,
            'price'                => 'required|numeric|min:0',
            'sale_price'           => 'nullable|numeric|min:0',
            'cost_price'           => 'nullable|numeric|min:0',
            'stock_quantity'       => 'required|integer|min:0',
            'short_description'    => 'nullable|string',
            'description'          => 'nullable|string',
            'material'             => 'nullable|string|max:150',
            'warranty_details'     => 'nullable|string|max:255',
            'product_warranty'     => 'nullable|string|max:100',
            'manufacturer_details' => 'nullable|string',
            'tax_rate'             => 'nullable|numeric|min:0|max:100',
            'hsn_code'             => 'nullable|string|max:50',
            'weight'               => 'nullable|numeric|min:0',
            'status'               => 'required|in:active,inactive,draft',
            'thumbnail'            => 'nullable|file',
        ]);

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($product->thumbnail) {
                @unlink(public_path('uploads/products/' . $product->thumbnail));
            }
            $validated['thumbnail'] = $this->uploadFile($request->file('thumbnail'), 'products');
        }

        $validated['is_featured']    = $request->boolean('is_featured');
        $validated['is_new_arrival'] = $request->boolean('is_new_arrival');
        $validated['is_best_seller'] = $request->boolean('is_best_seller');
        $validated['slug']           = Str::slug($request->input('slug') ?: $request->name);

        $product->update($validated);

        // Handle new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $filename = $this->uploadFile($image, 'products');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $filename,
                    'sort_order' => $product->images()->count() + $index,
                    'is_primary' => false,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Delete images
        foreach ($product->images as $img) {
            @unlink(public_path('uploads/products/' . $img->image));
        }
        if ($product->thumbnail) {
            @unlink(public_path('uploads/products/' . $product->thumbnail));
        }
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        if (empty($ids) || !is_array($ids)) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Please select at least one product to delete.');
        }

        $products = Product::whereIn('id', $ids)->get();
        $count = $products->count();

        foreach ($products as $product) {
            foreach ($product->images as $img) {
                @unlink(public_path('uploads/products/' . $img->image));
            }
            if ($product->thumbnail) {
                @unlink(public_path('uploads/products/' . $product->thumbnail));
            }
            $product->delete();
        }

        return redirect()->route('admin.products.index')
            ->with('success', "Successfully deleted {$count} product(s).");
    }

    public function toggleStatus(Product $product)
    {
        $product->update(['status' => $product->status === 'active' ? 'inactive' : 'active']);
        return back()->with('success', 'Product status updated.');
    }

    public function deleteImage(Request $request, int $imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        @unlink(public_path('uploads/products/' . $image->image));
        $image->delete();
        return response()->json(['success' => true]);
    }

    public function uploadMedia(Request $request)
    {
        $request->validate(['file' => 'required|image|max:2048']);
        $filename = $this->uploadFile($request->file('file'), 'products');
        return response()->json(['url' => asset('uploads/products/' . $filename), 'filename' => $filename]);
    }

    private function uploadFile($file, string $folder): string
    {
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $path     = public_path('uploads/' . $folder);
        if (!file_exists($path)) mkdir($path, 0755, true);
        $file->move($path, $filename);
        return $filename;
    }

    private function uniqueProductName(string $name): string
    {
        $base = $name . ' Copy';
        $candidate = $base;
        $counter = 2;
        while (Product::where('name', $candidate)->exists()) {
            $candidate = $base . ' ' . $counter++;
        }
        return $candidate;
    }

    private function uniqueProductSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'product-copy';
        $slug = $base;
        $counter = 2;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $counter++;
        }
        return $slug;
    }

    private function uniqueSku(string $sku): string
    {
        $base = $sku . '-COPY';
        $candidate = $base;
        $counter = 2;
        while (Product::where('sku', $candidate)->exists()) {
            $candidate = $base . '-' . $counter++;
        }
        return $candidate;
    }

    private function copyProductFile(string $filename): string
    {
        $source = public_path('uploads/products/' . $filename);
        if (!File::exists($source)) return $filename;

        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $copyName = time() . '_' . Str::random(10) . ($extension ? '.' . $extension : '');
        File::copy($source, public_path('uploads/products/' . $copyName));
        return $copyName;
    }
}
