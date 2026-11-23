@php($level = $level ?? 0)
<tr data-id="{{ $menu->id }}" data-parent-id="{{ $menu->parent_id ?? '' }}" draggable="true" class="menu-row level-{{ $level }}">
  <td><i class="bi bi-grip-vertical text-muted drag-handle" title="Drag to reorder"></i> <span class="sort-number">{{ $menu->sort_order }}</span></td>
  <td class="fw-600" style="padding-left:{{ 12 + ($level * 28) }}px"><span class="level-badge">L{{ $level + 1 }}</span>{{ $menu->title }}</td>
  <td>@if($menu->type === 'link') <span class="badge bg-info">Link</span>@elseif($menu->type === 'dropdown') <span class="badge bg-primary">Dropdown</span>@else <span class="badge bg-warning text-dark">Megamenu</span>@endif</td>
  <td class="small text-muted">{{ $menu->url ?? '—' }}</td>
  <td>@if($menu->type === 'megamenu')<span class="badge bg-light text-dark">{{ $menu->columns->count() }} columns</span>@foreach($menu->columns as $col)<div class="small text-muted">{{ $col->title }}: {{ $col->items->count() }} items</div>@endforeach @else — @endif</td>
  <td>@if($menu->badge_text)<span class="badge" style="background:{{ $menu->badge_color ?? '#c9a96e' }}">{{ $menu->badge_text }}</span>@else — @endif</td>
  <td><div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" {{ $menu->status ? 'checked' : '' }} onchange="toggleStatus({{ $menu->id }}, this)"></div></td>
  <td><div class="d-flex gap-1"><a href="{{ route('admin.megamenu.edit', $menu) }}" class="btn btn-sm btn-light"><i class="bi bi-pencil"></i></a><button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('admin.megamenu.destroy', $menu) }}')"><i class="bi bi-trash"></i></button></div></td>
</tr>
@foreach($menu->children as $child)
  @include('admin.megamenu._row', ['menu' => $child, 'level' => $level + 1])
@endforeach
