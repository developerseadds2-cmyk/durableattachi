@extends('admin.layout.app')
@section('title','Edit Category')
@section('breadcrumb')<li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li><li class="breadcrumb-item active">Edit</li>@endsection
@section('content')
<div class="page-header"><h4>Edit Category</h4><a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">Back</a></div>
<form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">@csrf @method('PUT')
  <div class="form-card" style="max-width:850px"><div class="row g-3">
    <div class="col-md-6"><label class="form-label">Name</label><input name="name" class="form-control" value="{{ old('name', $category->name) }}" required></div>
    <div class="col-md-6"><label class="form-label">URL Slug</label><input name="slug" class="form-control" value="{{ old('slug', $category->slug) }}" placeholder="diamond-rings"></div>
    <div class="col-md-6"><label class="form-label">Parent</label><select name="parent_id" class="form-select"><option value="">No Parent</option>@foreach($parents as $parent)<option value="{{ $parent->id }}" @selected($category->parent_id == $parent->id)>{{ $parent->name }}</option>@endforeach</select></div>
    <div class="col-md-4"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="{{ $category->sort_order }}"></div>
    <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea></div>
    <div class="col-12"><label class="form-label">Image</label><input type="file" name="image" class="form-control" accept="image/*"></div>
  </div><div class="form-check form-switch my-3"><input class="form-check-input" type="checkbox" name="status" value="1" @checked($category->status)><label class="form-check-label">Active</label></div><button class="btn btn-gold">Save Category</button></div>
</form>
@endsection
