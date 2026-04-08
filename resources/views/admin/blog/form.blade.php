@extends('layouts.admin')
@section('title', $item ? 'Edit Post' : 'New Post')
@section('page-title', $item ? 'Edit Blog Post' : 'New Blog Post')
@section('content')
<div class="admin-panel">
    <form action="{{ $item ? '/admin/blog/'.$item->id : '/admin/blog' }}" method="POST">
        @csrf
        @if($item) @method('PUT') @endif
        <div class="form-grid-2">
            <div class="form-group">
                <label>Title (English) *</label>
                <input type="text" name="title_en" value="{{ old('title_en', $item->title_en ?? '') }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Title (Arabic) *</label>
                <input type="text" name="title_ar" value="{{ old('title_ar', $item->title_ar ?? '') }}" class="form-input" dir="rtl" required>
            </div>
            <div class="form-group">
                <label>Author (English) *</label>
                <input type="text" name="author_en" value="{{ old('author_en', $item->author_en ?? '') }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Author (Arabic) *</label>
                <input type="text" name="author_ar" value="{{ old('author_ar', $item->author_ar ?? '') }}" class="form-input" dir="rtl" required>
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
        <div class="form-group mt-4">
            <label>Summary (English) *</label>
            <textarea name="summary_en" rows="2" class="form-input" required>{{ old('summary_en', $item->summary_en ?? '') }}</textarea>
        </div>
        <div class="form-group">
            <label>Summary (Arabic) *</label>
            <textarea name="summary_ar" rows="2" class="form-input" dir="rtl" required>{{ old('summary_ar', $item->summary_ar ?? '') }}</textarea>
        </div>
        <div class="form-group">
            <label>Content (English) * <span class="label-hint">HTML supported</span></label>
            <textarea name="content_en" rows="10" class="form-input rich-editor" required>{{ old('content_en', $item->content_en ?? '') }}</textarea>
        </div>
        <div class="form-group">
            <label>Content (Arabic) * <span class="label-hint">HTML supported</span></label>
            <textarea name="content_ar" rows="10" class="form-input rich-editor" dir="rtl" required>{{ old('content_ar', $item->content_ar ?? '') }}</textarea>
        </div>
        <div class="form-actions">
            <a href="/admin/blog" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $item ? 'Update' : 'Publish' }} Post</button>
        </div>
    </form>
</div>
@endsection
