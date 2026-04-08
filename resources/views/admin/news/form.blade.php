@extends('layouts.admin')
@section('title', $item ? 'Edit News' : 'Create News')
@section('page-title', $item ? 'Edit News Article' : 'New News Article')
@section('content')
<div class="admin-panel">
    <form action="{{ $item ? '/admin/news/'.$item->id : '/admin/news' }}" method="POST">
        @csrf
        @if($item) @method('PUT') @endif
        <div class="form-grid-2">
            <div class="form-group">
                <label>Title (English) *</label>
                <input type="text" name="title_en" value="{{ old('title_en', $item->title_en ?? '') }}" class="form-input" required>
                @error('title_en')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Title (Arabic) *</label>
                <input type="text" name="title_ar" value="{{ old('title_ar', $item->title_ar ?? '') }}" class="form-input" dir="rtl" required>
            </div>
            <div class="form-group">
                <label>Summary (English) *</label>
                <textarea name="summary_en" rows="3" class="form-input" required>{{ old('summary_en', $item->summary_en ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label>Summary (Arabic) *</label>
                <textarea name="summary_ar" rows="3" class="form-input" dir="rtl" required>{{ old('summary_ar', $item->summary_ar ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label>Category *</label>
                <input type="text" name="category" value="{{ old('category', $item->category ?? '') }}" class="form-input" placeholder="e.g. Accelerator, Investment, WIIF" required>
            </div>
            <div class="form-group">
                <label>Date *</label>
                <input type="date" name="date" value="{{ old('date', $item ? $item->date->format('Y-m-d') : today()->format('Y-m-d')) }}" class="form-input" required>
            </div>
        </div>
        <div class="form-grid-2 mt-4">
            <x-image-upload name="image_en" label="Image (English)" :value="old('image_en', $item->image_en ?? '')" />
            <x-image-upload name="image_ar" label="Image (Arabic)" :value="old('image_ar', $item->image_ar ?? '')" />
        </div>
        <div class="form-actions">
            <a href="/admin/news" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $item ? 'Update' : 'Create' }} Article</button>
        </div>
    </form>
</div>
@endsection
