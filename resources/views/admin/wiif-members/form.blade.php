@extends('layouts.admin')
@section('title', $item ? 'Edit Member' : 'Add Member')
@section('page-title', $item ? 'Edit WIIF Member' : 'New WIIF Member')

@section('content')
<div class="admin-panel">
    <form action="{{ $item ? '/admin/wiif-members/'.$item->id : '/admin/wiif-members' }}" method="POST">
        @csrf
        @if($item) @method('PUT') @endif

        <div class="form-group">
            <label>Member Type *</label>
            <select name="type" class="form-input" required>
                <option value="gp" {{ old('type', $item->type ?? $defaultType) === 'gp' ? 'selected' : '' }}>General Partner</option>
                <option value="committee" {{ old('type', $item->type ?? $defaultType) === 'committee' ? 'selected' : '' }}>Investment Committee Member</option>
            </select>
        </div>

        <div class="form-grid-2">
            <div class="form-group">
                <label>Name (English) *</label>
                <input type="text" name="name_en" value="{{ old('name_en', $item->name_en ?? '') }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Name (Arabic) *</label>
                <input type="text" name="name_ar" value="{{ old('name_ar', $item->name_ar ?? '') }}" class="form-input" dir="rtl" required>
            </div>
            <div class="form-group">
                <label>Role (English)</label>
                <input type="text" name="role_en" value="{{ old('role_en', $item->role_en ?? '') }}" class="form-input" placeholder="Managing Partner, Chair, Member…">
            </div>
            <div class="form-group">
                <label>Role (Arabic)</label>
                <input type="text" name="role_ar" value="{{ old('role_ar', $item->role_ar ?? '') }}" class="form-input" dir="rtl">
            </div>
        </div>

        <div class="mt-4">
            <x-image-upload name="image_url" label="Profile Photo" :value="old('image_url', $item->image_url ?? '')" />
        </div>

        <div class="mt-4">
            <x-quill-editor name="bio_en" label="Bio (English)" :value="old('bio_en', $item->bio_en ?? '')" />
            <x-quill-editor name="bio_ar" label="Bio (Arabic)" :value="old('bio_ar', $item->bio_ar ?? '')" dir="rtl" />
        </div>

        <div class="form-group mt-4">
            <label>Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" class="form-input" min="0" style="max-width:160px;">
            <span class="form-hint">Lower numbers appear first within the section.</span>
        </div>

        <div class="form-actions">
            <a href="/admin/wiif-members" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $item ? 'Update' : 'Add' }} Member</button>
        </div>
    </form>
</div>
@endsection
