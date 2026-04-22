@extends('layouts.admin')
@section('title', $item ? 'Edit Item' : 'Add Library Item')
@section('page-title', $item ? 'Edit Library Item' : 'Add Library Item')
@section('content')
<div class="admin-panel">
    <form action="{{ $item ? '/admin/library/'.$item->id : '/admin/library' }}" method="POST"
          enctype="multipart/form-data" id="libraryForm">
        @csrf
        @if($item) @method('PUT') @endif

        {{-- Hidden fields --}}
        <input type="hidden" name="url"        id="urlHidden"     value="{{ old('url', $item->url ?? '') }}">
        <input type="hidden" name="youtube_id" id="youtubeIdField" value="">

        {{-- Titles --}}
        <div class="form-grid-2">
            <div class="form-group">
                <label>Title (English) *</label>
                <input type="text" name="title_en" id="titleEn" value="{{ old('title_en', $item->title_en ?? '') }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>Title (Arabic) *</label>
                <input type="text" name="title_ar" id="titleAr" value="{{ old('title_ar', $item->title_ar ?? '') }}" class="form-input" dir="rtl" required>
            </div>
            <div class="form-group">
                <label>Type *</label>
                <select name="type" id="typeSelect" class="form-input" required onchange="switchType(this.value)">
                    @foreach(['document','image','video'] as $type)
                    <option value="{{ $type }}" {{ old('type', $item->type ?? 'document') === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Date *</label>
                <input type="date" name="file_date" value="{{ old('file_date', $item ? $item->file_date->format('Y-m-d') : today()->format('Y-m-d')) }}" class="form-input" required>
            </div>
            <div class="form-group">
                <label>File Size <span class="label-hint">auto-filled for uploads</span></label>
                <input type="text" name="size" id="sizeField" value="{{ old('size', $item->size ?? '') }}" class="form-input" placeholder="e.g. 2.4 MB">
            </div>
        </div>

        {{-- ── DOCUMENT: PDF/file upload ─────────────────────────────── --}}
        <div id="section-document" class="lib-type-section mt-6">
            <div class="form-group">
                <label>Upload PDF / Document *</label>
                <div class="upload-zone" id="docZone" onclick="document.getElementById('fileUpload').click()"
                     ondragover="event.preventDefault();this.classList.add('drag-over')"
                     ondragleave="this.classList.remove('drag-over')"
                     ondrop="handleDocDrop(event)">
                    <div id="docPlaceholder" class="upload-placeholder">
                        <div class="upload-icon">📄</div>
                        <p>Click or drag & drop your PDF or document here</p>
                        <p class="upload-hint">PDF, DOC, DOCX, XLSX, PPT — max 20 MB</p>
                    </div>
                    <div id="docProgress" class="upload-progress" style="display:none">
                        <div class="upload-spinner"></div><span>Uploading…</span>
                    </div>
                    <div id="docSuccess" style="display:none;padding:1rem;text-align:center">
                        <div style="font-size:2rem">✅</div>
                        <p id="docFileName" style="font-weight:600;color:var(--brown);margin-top:.5rem"></p>
                        <p style="font-size:.8rem;color:#6b7280">File uploaded successfully</p>
                    </div>
                </div>
                <input type="file" id="fileUpload" name="file_upload" accept=".pdf,.doc,.docx,.xlsx,.xls,.ppt,.pptx,.zip,.rar" style="display:none" onchange="handleDocUpload(this)">
                @if($item && $item->type === 'document' && $item->url)
                    <p class="form-hint mt-2">Current file: <a href="{{ $item->url }}" target="_blank" class="text-rust">View current file ↗</a> — upload a new file to replace it.</p>
                @endif
                @error('url')<span class="form-error">{{ $message }}</span>@enderror
            </div>
        </div>

        {{-- ── IMAGE: upload ─────────────────────────────────────────── --}}
        <div id="section-image" class="lib-type-section mt-6" style="display:none">
            <x-image-upload name="image_file_hidden" label="Upload Image *" :value="old('url', ($item && $item->type==='image') ? $item->url : '')" />
        </div>

        {{-- ── VIDEO: YouTube embed ──────────────────────────────────── --}}
        <div id="section-video" class="lib-type-section mt-6" style="display:none">
            <div class="form-group">
                <label>YouTube Link *</label>
                <div style="display:flex;gap:.75rem;align-items:flex-start">
                    <input type="text" id="youtubeInput" class="form-input" style="flex:1"
                           placeholder="https://youtu.be/abc123  or  https://www.youtube.com/watch?v=abc123"
                           value="{{ ($item && $item->type==='video') ? $item->url : '' }}">
                    <button type="button" class="btn btn-outline" onclick="fetchYoutube()" style="white-space:nowrap">
                        🔍 Fetch Info
                    </button>
                </div>
                <p class="form-hint mt-1">Paste the YouTube video URL and click "Fetch Info" to auto-fill title and thumbnail.</p>
            </div>

            {{-- YouTube preview --}}
            <div id="youtubePreview" style="display:none;margin-top:1rem;background:#f9fafb;border-radius:10px;padding:1rem;display:none;">
                <div style="display:grid;grid-template-columns:200px 1fr;gap:1rem;align-items:start">
                    <img id="ytThumb" src="" alt="thumbnail" style="width:100%;border-radius:8px">
                    <div>
                        <p style="font-size:.75rem;color:#9ca3af;font-weight:700;text-transform:uppercase;letter-spacing:.05em;margin-bottom:.35rem">Video Title (auto-fetched — you can edit)</p>
                        <input type="text" id="ytTitleEn" class="form-input mb-2" placeholder="Title (English)">
                        <input type="text" id="ytTitleAr" class="form-input" dir="rtl" placeholder="العنوان (عربي)">
                        <button type="button" class="btn btn-primary btn-sm mt-3" onclick="applyYoutube()">✅ Use This Video</button>
                    </div>
                </div>
            </div>

            @if($item && $item->type === 'video' && $item->url)
            <div class="mt-4">
                <p class="form-hint">Current video:</p>
                <iframe src="{{ $item->url }}" width="320" height="180" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="border-radius:8px;margin-top:.5rem"></iframe>
            </div>
            @endif
        </div>

        {{-- Descriptions --}}
        <div class="form-grid-2 mt-6">
            <div class="form-group">
                <label>Description (English)</label>
                <textarea name="description_en" rows="2" class="form-input">{{ old('description_en', $item->description_en ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label>Description (Arabic)</label>
                <textarea name="description_ar" rows="2" class="form-input" dir="rtl">{{ old('description_ar', $item->description_ar ?? '') }}</textarea>
            </div>
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
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

// ── Switch visible section based on type ──────────────────────────
function switchType(type) {
    ['document','image','video'].forEach(t => {
        const el = document.getElementById('section-'+t);
        if (el) el.style.display = (t === type) ? 'block' : 'none';
    });
}
// Init on load
switchType(document.getElementById('typeSelect').value);

// ── PDF Upload (direct to server) ────────────────────────────────
function handleDocUpload(input) {
    if (!input.files || !input.files[0]) return;
    uploadDoc(input.files[0]);
}
function handleDocDrop(e) {
    e.preventDefault();
    document.getElementById('docZone').classList.remove('drag-over');
    const file = e.dataTransfer.files[0];
    if (file) uploadDoc(file);
}
function uploadDoc(file) {
    if (file.size > 20 * 1024 * 1024) { alert('File too large. Max 20 MB.'); return; }
    const fd = new FormData();
    fd.append('file', file);
    fd.append('_token', csrfToken);

    document.getElementById('docPlaceholder').style.display = 'none';
    document.getElementById('docProgress').style.display = 'flex';

    fetch('/admin/upload-document', { method: 'POST', body: fd })
        .then(r => r.json())
        .then(data => {
            if (data.url) {
                document.getElementById('urlHidden').value = data.url;
                document.getElementById('docProgress').style.display = 'none';
                document.getElementById('docSuccess').style.display = 'block';
                document.getElementById('docFileName').textContent = file.name;
                if (data.size) document.getElementById('sizeField').value = data.size;
            } else {
                alert(data.error || 'Upload failed.');
                document.getElementById('docProgress').style.display = 'none';
                document.getElementById('docPlaceholder').style.display = 'block';
            }
        }).catch(() => {
            document.getElementById('docProgress').style.display = 'none';
            document.getElementById('docPlaceholder').style.display = 'block';
            alert('Upload failed. Please try again.');
        });
}

// ── Image upload (x-image-upload component handles this but we need to capture the URL) ──
// Override the hidden input sync for image type
document.getElementById('libraryForm').addEventListener('submit', function() {
    const type = document.getElementById('typeSelect').value;
    if (type === 'image') {
        // Find the hidden input from x-image-upload component (starts with val_img_image)
        const imgInput = document.querySelector('input[id^="val_img_image_file_hidden"]') ||
                         document.querySelector('[id^="val_img"]');
        if (imgInput && imgInput.value) {
            document.getElementById('urlHidden').value = imgInput.value;
        }
    }
});

// ── YouTube fetch ──────────────────────────────────────────────────
function fetchYoutube() {
    const url = document.getElementById('youtubeInput').value.trim();
    if (!url) { alert('Please paste a YouTube URL first.'); return; }

    fetch('/admin/library/youtube-info', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
        body: JSON.stringify({ url })
    })
    .then(r => r.json())
    .then(data => {
        if (data.error) { alert(data.error); return; }
        document.getElementById('ytThumb').src = data.thumbnail;
        document.getElementById('ytTitleEn').value = data.title;
        document.getElementById('ytTitleAr').value = data.title; // user can edit
        document.getElementById('youtubePreview').style.display = 'block';
        // Store the video ID
        document.getElementById('youtubeIdField').value = data.id;
    })
    .catch(() => alert('Could not fetch YouTube info. Check the URL and try again.'));
}

function applyYoutube() {
    const enTitle = document.getElementById('ytTitleEn').value.trim();
    const arTitle = document.getElementById('ytTitleAr').value.trim();
    if (enTitle) document.getElementById('titleEn').value = enTitle;
    if (arTitle) document.getElementById('titleAr').value = arTitle;
    alert('✅ Video applied! Fill in the remaining fields and save.');
}
</script>
@endpush
