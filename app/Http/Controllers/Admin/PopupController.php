<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Popup;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PopupController extends Controller
{
    public function index()
    {
        $popups = Popup::with(['category', 'product'])->latest()->paginate(15);
        return view('admin.popups.index', compact('popups'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $products = Product::where('status', 'published')->orderBy('name')->get();
        return view('admin.popups.create', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'                 => 'required|string|max:255',
            'type'                  => 'required|in:offer,simple,image_only',
            'badge_text'            => 'nullable|string|max:100',
            'headline'              => 'nullable|string|max:255',
            'description'           => 'nullable|string',
            'coupon_code'           => 'nullable|string|max:50',
            'discount_percentage'   => 'nullable|integer|min:1|max:100',
            'button_text'           => 'nullable|string|max:100',
            'button_url'            => 'nullable|string|max:255',
            'image'                 => 'nullable|image|max:3072',
            'target_type'           => 'required|in:all,home_only,category,product',
            'category_id'           => 'nullable|required_if:target_type,category|exists:categories,id',
            'product_id'            => 'nullable|required_if:target_type,product|exists:products,id',
            'delay_seconds'         => 'nullable|integer|min:0|max:60',
            'show_once_per_session' => 'nullable|boolean',
            'starts_at'             => 'nullable|date',
            'ends_at'               => 'nullable|date|after_or_equal:starts_at',
            'is_active'             => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['show_once_per_session'] = $request->has('show_once_per_session');
        $data['delay_seconds'] = $data['delay_seconds'] ?? 2;

        if ($request->hasFile('image')) {
            $dest = public_path('uploads/popups');
            if (!File::isDirectory($dest)) {
                File::makeDirectory($dest, 0755, true);
            }
            $filename = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($dest, $filename);
            $data['image'] = $filename;
        }

        Popup::create($data);

        // If an offer popup has a coupon code, ensure a matching active Coupon exists so customers can redeem it
        if (!empty($data['coupon_code'])) {
            $code = strtoupper(trim($data['coupon_code']));
            Coupon::firstOrCreate(
                ['code' => $code],
                [
                    'type'               => 'percentage',
                    'value'              => $data['discount_percentage'] ?? 10,
                    'min_order_amount'   => 0,
                    'max_discount_amount'=> null,
                    'status'             => true,
                ]
            );
        }

        return redirect()->route('admin.popups.index')->with('success', 'Popup created successfully.');
    }

    public function edit(Popup $popup)
    {
        $categories = Category::orderBy('name')->get();
        $products = Product::where('status', 'published')->orderBy('name')->get();
        return view('admin.popups.edit', compact('popup', 'categories', 'products'));
    }

    public function update(Request $request, Popup $popup)
    {
        $data = $request->validate([
            'title'                 => 'required|string|max:255',
            'type'                  => 'required|in:offer,simple,image_only',
            'badge_text'            => 'nullable|string|max:100',
            'headline'              => 'nullable|string|max:255',
            'description'           => 'nullable|string',
            'coupon_code'           => 'nullable|string|max:50',
            'discount_percentage'   => 'nullable|integer|min:1|max:100',
            'button_text'           => 'nullable|string|max:100',
            'button_url'            => 'nullable|string|max:255',
            'image'                 => 'nullable|image|max:3072',
            'target_type'           => 'required|in:all,home_only,category,product',
            'category_id'           => 'nullable|required_if:target_type,category|exists:categories,id',
            'product_id'            => 'nullable|required_if:target_type,product|exists:products,id',
            'delay_seconds'         => 'nullable|integer|min:0|max:60',
            'show_once_per_session' => 'nullable|boolean',
            'starts_at'             => 'nullable|date',
            'ends_at'               => 'nullable|date|after_or_equal:starts_at',
            'is_active'             => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['show_once_per_session'] = $request->has('show_once_per_session');
        $data['delay_seconds'] = $data['delay_seconds'] ?? 2;

        if ($request->hasFile('image')) {
            $dest = public_path('uploads/popups');
            if ($popup->image && File::exists($dest . '/' . $popup->image)) {
                File::delete($dest . '/' . $popup->image);
            }
            $filename = time() . '_' . uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($dest, $filename);
            $data['image'] = $filename;
        }

        $popup->update($data);

        return redirect()->route('admin.popups.index')->with('success', 'Popup updated successfully.');
    }

    public function toggleStatus(Popup $popup)
    {
        $popup->update(['is_active' => !$popup->is_active]);
        return back()->with('success', 'Popup status updated.');
    }

    public function destroy(Popup $popup)
    {
        if ($popup->image) {
            $path = public_path('uploads/popups/' . $popup->image);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $popup->delete();

        return redirect()->route('admin.popups.index')->with('success', 'Popup deleted successfully.');
    }
}
