@extends('layouts.admin')
@section('title', $item ? 'Edit Post' : 'New Post')
@section('page-title', $item ? 'Edit Blog Post' : 'New Blog Post')
@section('content')
<div class="admin-panel">
    <form action="{{ $item ? '/admin/blog/'.$item->id : '/admin/blog' }}" method="POST" id="blogForm">
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

        {{-- ── MAIN CONTENT (Quill) ── --}}
        <div class="form-group mt-4">
            <label>Content (English) * <span class="label-hint">Rich text</span></label>
            <div id="quill_en" class="quill-editor-box">{!! \App\Support\Content::format(old('content_en', $item->content_en ?? '')) !!}</div>
            <input type="hidden" name="content_en" id="content_en_hidden">
        </div>
        <div class="form-group">
            <label>Content (Arabic) * <span class="label-hint">Rich text</span></label>
            <div id="quill_ar" class="quill-editor-box" dir="rtl">{!! \App\Support\Content::format(old('content_ar', $item->content_ar ?? '')) !!}</div>
            <input type="hidden" name="content_ar" id="content_ar_hidden">
        </div>

        <div class="form-actions">
            <a href="/admin/blog" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $item ? 'Update' : 'Publish' }} Post</button>
        </div>
    </form>
</div>

@push('styles')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
var quillEn = new Quill('#quill_en', {
    theme: 'snow',
    modules: { toolbar: [
        [{ header: [1,2,3,false] }],
        ['bold','italic','underline','strike'],
        [{ list:'ordered'},{list:'bullet'}],
        [{ align:[] }],
        ['link','blockquote'],
        ['clean']
    ]}
});
var quillAr = new Quill('#quill_ar', {
    theme: 'snow',
    modules: { toolbar: [
        [{ header: [1,2,3,false] }],
        ['bold','italic','underline','strike'],
        [{ list:'ordered'},{list:'bullet'}],
        [{ align:[] }],
        ['link','blockquote'],
        ['clean']
    ]}
});

document.getElementById('blogForm').addEventListener('submit', function(e) {
    document.getElementById('content_en_hidden').value = quillEn.root.innerHTML;
    document.getElementById('content_ar_hidden').value = quillAr.root.innerHTML;
});
</script>
@endpush
@endsection
