@extends('layouts.admin')
@section('title', $item ? 'Edit Item' : 'Add Library Item')
@section('page-title', $item ? 'Edit Library Item' : 'Add Library Item')
@section('content')
<div class="admin-panel">
    <form action="{{ $item ? '/admin/library/'.$item->id : '/admin/library' }}" method="POST">
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
                <label>Type *</label>
                <select name="type" class="form-input" required>
                    @foreach(['document','image','video'] as $type)
                    <option value="{{ $type }}" {{ old('type', $item->type ?? '') === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Date *</label>
                <input type="date" name="file_date" value="{{ old('file_date', $item ? $item->file_date->format('Y-m-d') : today()->format('Y-m-d')) }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>File Size</label>
                <input type="text" name="size" value="{{ old('size', $item->size ?? '') }}" class="form-input" placeholder="4.2 MB">
            </div>
            <div class="form-group">
                <label>File URL / Link *</label>
                <input type="text" name="url" value="{{ old('url', $item->url ?? '') }}" class="form-input" placeholder="https://... or upload an image below" required>
                <span class="form-hint">For documents/videos paste URL. For images use the uploader below.</span>
            </div>
        </div>
        <div class="form-grid-2 mt-4">
            <div class="form-group">
                <label>Description (English)</label>
                <textarea name="description_en" rows="2" class="form-input">{{ old('description_en', $item->description_en ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label>Description (Arabic)</label>
                <textarea name="description_ar" rows="2" class="form-input" dir="rtl">{{ old('description_ar', $item->description_ar ?? '') }}</textarea>
            </div>
        </div>

        {{-- Cover image upload — shows on the public library card --}}
        <div class="mt-4">
            <x-image-upload name="cover_url" label="Cover Image (optional, for documents/videos)" :value="old('cover_url', $item->cover_url ?? '')" />
        </div>
        {{-- Image upload helper — clicking "use this" fills the URL field --}}
        <div class="form-group mt-4">
            <label>Or Upload Image <span class="label-hint">(fills the URL field above)</span></label>
            <div class="upload-zone" id="lib_upload_zone" onclick="document.getElementById('lib_file').click()"
                 ondragover="event.preventDefault();this.classList.add('drag-over')" ondragleave="this.classList.remove('drag-over')"
                 ondrop="handleLibDrop(event)">
                <div class="upload-placeholder" id="lib_placeholder">
                    <div class="upload-icon">📎</div>
                    <p>Click or drag &amp; drop image</p>
                </div>
                <div class="upload-progress" id="lib_progress" style="display:none">
                    <div class="upload-spinner"></div><span>Uploading…</span>
                </div>
                <div id="lib_preview" style="display:none;padding:1rem;text-align:center">
                    <img id="lib_preview_img" src="" style="max-height:120px;border-radius:8px;" alt="preview">
                    <p class="mt-2 text-sm" style="color:var(--rust)">✓ URL filled in above</p>
                </div>
            </div>
            <input type="file" id="lib_file" accept="image/*" style="display:none" onchange="uploadLibImage(this)">
        </div>
        <div class="form-actions">
            <a href="/admin/library" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $item ? 'Update' : 'Add' }} Item</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
function uploadLibImage(input) {
    if (!input.files || !input.files[0]) return;
    const file = input.files[0];
    const formData = new FormData();
    formData.append('image', file);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
    document.getElementById('lib_placeholder').style.display='none';
    document.getElementById('lib_progress').style.display='flex';
    fetch('/admin/upload-image', { method:'POST', body:formData })
        .then(r=>r.json()).then(data=>{
            if(data.url){
                document.querySelector('input[name="url"]').value = data.url;
                document.getElementById('lib_preview_img').src = data.url;
                document.getElementById('lib_preview').style.display='block';
                document.getElementById('lib_progress').style.display='none';
            }
        }).catch(()=>{
            document.getElementById('lib_progress').style.display='none';
            document.getElementById('lib_placeholder').style.display='block';
        });
}
function handleLibDrop(e){
    e.preventDefault();
    document.getElementById('lib_upload_zone').classList.remove('drag-over');
    const file = e.dataTransfer.files[0];
    if(file){ const dt=new DataTransfer(); dt.items.add(file); document.getElementById('lib_file').files=dt.files; uploadLibImage({files:[file]}); }
}
</script>
@endpush
