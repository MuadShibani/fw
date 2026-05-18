@extends('layouts.admin')
@section('title', $item ? 'Edit Feature' : 'New Feature')
@section('page-title', $item ? 'Edit Program Feature' : 'New Program Feature')

@section('content')
<div class="admin-panel">
    <form action="{{ $item ? '/admin/program-features/'.$item->id : '/admin/program-features' }}" method="POST">
        @csrf
        @if($item) @method('PUT') @endif

        <div class="form-grid-2">
            <div class="form-group">
                <label>Feature Name (English) *</label>
                <input type="text" name="name_en" value="{{ old('name_en', $item->name_en ?? '') }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Feature Name (Arabic) *</label>
                <input type="text" name="name_ar" value="{{ old('name_ar', $item->name_ar ?? '') }}" class="form-input" dir="rtl" required>
            </div>
        </div>

        <div class="mt-4">
            <x-quill-editor name="description_en" label="Description (English)" :value="old('description_en', $item->description_en ?? '')" />
            <x-quill-editor name="description_ar" label="Description (Arabic)" :value="old('description_ar', $item->description_ar ?? '')" dir="rtl" />
        </div>

        <div class="form-group mt-4">
            <label>Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" class="form-input" min="0" style="max-width:160px;">
        </div>

        <div class="form-actions">
            <a href="/admin/program-features" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $item ? 'Update' : 'Add' }} Feature</button>
        </div>
    </form>
</div>
@endsection
