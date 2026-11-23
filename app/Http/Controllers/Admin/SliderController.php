<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'nullable|string|max:191',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'sort_order'  => 'integer|min:0',
        ]);

        $file     = $request->file('image');
        $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/sliders'), $filename);

        Slider::create([
            'title'       => $request->title,
            'subtitle'    => $request->subtitle,
            'description' => $request->description,
            'image'       => $filename,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'position'    => $request->position ?? 'center',
            'sort_order'  => $request->sort_order ?? 0,
            'status'      => $request->boolean('status', true),
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title'  => 'nullable|string|max:191',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data = $request->except(['_token', '_method', 'image']);
        $data['status'] = $request->boolean('status');

        if ($request->hasFile('image')) {
            @unlink(public_path('uploads/sliders/' . $slider->image));
            $file     = $request->file('image');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sliders'), $filename);
            $data['image'] = $filename;
        }

        $slider->update($data);
        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        @unlink(public_path('uploads/sliders/' . $slider->image));
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted.');
    }

    public function show(Slider $slider)
    {
        return redirect()->route('admin.sliders.edit', $slider);
    }

    public function sort(Request $request)
    {
        foreach ($request->items as $item) {
            Slider::where('id', $item['id'])->update(['sort_order' => $item['order']]);
        }
        return response()->json(['success' => true]);
    }
}
