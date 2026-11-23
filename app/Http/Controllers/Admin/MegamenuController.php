<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Megamenu;
use App\Models\MegamenuColumn;
use App\Models\MegamenuItem;
use App\Models\MegamenuBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MegamenuController extends Controller
{
    public function index()
    {
        $menus = Megamenu::with('columns.items', 'banner', 'children.children.children')->orderBy('sort_order')->get();
        return view('admin.megamenu.index', compact('menus'));
    }

    public function create()
    {
        $menus = Megamenu::orderBy('sort_order')->get();
        return view('admin.megamenu.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:191',
            'type'        => 'required|in:link,dropdown,megamenu',
            'url'         => 'nullable|string|max:255',
            'icon'        => 'nullable|string|max:100',
            'parent_id'   => 'nullable|exists:megamenus,id',
            'badge_text'  => 'nullable|string|max:50',
            'badge_color' => 'nullable|string|max:50',
            'sort_order'  => 'integer|min:0',
        ]);

        $validated['status'] = $request->boolean('status', true);
        $validated['parent_id'] = $this->validatedParentId($request->input('parent_id'));
        $menu = Megamenu::create($validated);

        // Store columns if type is megamenu
        if ($request->type === 'megamenu' && $request->has('columns')) {
            foreach ($request->columns as $colData) {
                $column = $menu->columns()->create([
                    'title'      => $colData['title'],
                    'sort_order' => $colData['sort_order'] ?? 0,
                ]);
                if (!empty($colData['items'])) {
                    foreach ($colData['items'] as $idx => $item) {
                        $column->items()->create([
                            'label'          => $item['label'],
                            'url'            => $item['url'],
                            'icon'           => $item['icon'] ?? null,
                            'is_highlighted' => !empty($item['is_highlighted']),
                            'sort_order'     => $idx,
                        ]);
                    }
                }
            }
        }

        // Banner upload
        if ($request->hasFile('banner_image')) {
            $file     = $request->file('banner_image');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/megamenu'), $filename);
            MegamenuBanner::create([
                'megamenu_id' => $menu->id,
                'image'       => $filename,
                'title'       => $request->banner_title,
                'subtitle'    => $request->banner_subtitle,
                'link'        => $request->banner_link,
            ]);
        }

        return redirect()->route('admin.megamenu.index')->with('success', 'Menu item created successfully.');
    }

    public function edit(Megamenu $megamenu)
    {
        $megamenu->load('columns.items', 'banner');
        return view('admin.megamenu.edit', compact('megamenu'));
    }

    public function update(Request $request, Megamenu $megamenu)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:191',
            'type'        => 'required|in:link,dropdown,megamenu',
            'url'         => 'nullable|string|max:255',
            'icon'        => 'nullable|string|max:100',
            'parent_id'   => 'nullable|exists:megamenus,id',
            'badge_text'  => 'nullable|string|max:50',
            'badge_color' => 'nullable|string|max:50',
            'sort_order'  => 'integer|min:0',
        ]);

        $validated['status'] = $request->boolean('status');
        $validated['parent_id'] = $this->validatedParentId($request->input('parent_id'), $megamenu->id);
        $megamenu->update($validated);

        // Sync columns
        if ($request->type === 'megamenu' && $request->has('columns')) {
            // Delete existing columns (cascade deletes items)
            $megamenu->columns()->delete();
            foreach ($request->columns as $colData) {
                $column = $megamenu->columns()->create([
                    'title'      => $colData['title'],
                    'sort_order' => $colData['sort_order'] ?? 0,
                ]);
                if (!empty($colData['items'])) {
                    foreach ($colData['items'] as $idx => $item) {
                        $column->items()->create([
                            'label'          => $item['label'],
                            'url'            => $item['url'],
                            'icon'           => $item['icon'] ?? null,
                            'is_highlighted' => !empty($item['is_highlighted']),
                            'sort_order'     => $idx,
                        ]);
                    }
                }
            }
        }

        // Handle banner
        if ($request->hasFile('banner_image')) {
            if ($megamenu->banner) {
                @unlink(public_path('uploads/megamenu/' . $megamenu->banner->image));
                $megamenu->banner()->delete();
            }
            $file     = $request->file('banner_image');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/megamenu'), $filename);
            MegamenuBanner::create([
                'megamenu_id' => $megamenu->id,
                'image'       => $filename,
                'title'       => $request->banner_title,
                'subtitle'    => $request->banner_subtitle,
                'link'        => $request->banner_link,
            ]);
        }

        return redirect()->route('admin.megamenu.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Megamenu $megamenu)
    {
        $megamenu->delete();
        return redirect()->route('admin.megamenu.index')->with('success', 'Menu item deleted.');
    }

    public function show(Megamenu $megamenu)
    {
        return redirect()->route('admin.megamenu.edit', $megamenu);
    }

    public function sort(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer|exists:megamenus,id',
            'items.*.order' => 'required|integer|min:0',
            'items.*.parent_id' => 'nullable|integer|exists:megamenus,id',
        ]);

        foreach ($validated['items'] as $item) {
            $parentId = $item['parent_id'] ?? null;
            if ($parentId === (int) $item['id'] || $this->createsDeepHierarchy((int) $item['id'], $parentId)) {
                return response()->json(['message' => 'Menus can only be nested three levels deep.'], 422);
            }
            Megamenu::where('id', $item['id'])->update([
                'sort_order' => $item['order'],
                'parent_id' => $parentId,
            ]);
        }
        return response()->json(['success' => true]);
    }

    private function validatedParentId($parentId, ?int $menuId = null): ?int
    {
        if (!$parentId) return null;
        $parentId = (int) $parentId;
        if ($menuId && ($parentId === $menuId || $this->createsDeepHierarchy($menuId, $parentId))) {
            abort(422, 'Menus can only be nested three levels deep.');
        }
        return $parentId;
    }

    private function createsDeepHierarchy(int $menuId, ?int $parentId): bool
    {
        $depth = 1;
        while ($parentId) {
            if ($depth >= 3) return true;
            $parent = Megamenu::find($parentId);
            $parentId = $parent?->parent_id;
            $depth++;
            if ($parentId === $menuId) return true;
        }
        return false;
    }

    public function toggleStatus(Megamenu $megamenu)
    {
        $megamenu->update(['status' => ! $megamenu->status]);

        return response()->json(['success' => true, 'status' => $megamenu->status]);
    }

    public function storeColumn(Request $request, int $id)
    {
        $menu   = Megamenu::findOrFail($id);
        $column = $menu->columns()->create([
            'title'      => $request->title,
            'sort_order' => $request->sort_order ?? 0,
        ]);
        return response()->json(['success' => true, 'column' => $column]);
    }
}
