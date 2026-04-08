{{--
    Reusable image upload component with live preview.
    Usage: <x-image-upload name="image_en" label="Image (English)" :value="$item->image_en ?? ''" />
--}}
@props([
    'name'     => 'image',
    'label'    => 'Image',
    'value'    => '',
    'required' => false,
])

@php $uid = 'img_' . str_replace(['[',']'], '_', $name) . '_' . uniqid(); @endphp

<div class="form-group image-upload-group" id="group_{{ $uid }}">
    <label>{{ $label }}{{ $required ? ' *' : '' }}</label>

    {{-- Hidden input stores the final URL (existing or newly uploaded) --}}
    <input type="hidden" name="{{ $name }}" id="val_{{ $uid }}" value="{{ $value }}">

    {{-- Upload zone --}}
    <div class="upload-zone" id="zone_{{ $uid }}"
         onclick="document.getElementById('file_{{ $uid }}').click()"
         ondragover="event.preventDefault();this.classList.add('drag-over')"
         ondragleave="this.classList.remove('drag-over')"
         ondrop="handleDrop(event,'{{ $uid }}')">

        {{-- Preview --}}
        <div class="upload-preview" id="preview_{{ $uid }}"
             style="{{ $value ? '' : 'display:none' }}">
            <img src="{{ $value }}" alt="Preview" id="previewImg_{{ $uid }}"
                 style="max-height:160px;max-width:100%;border-radius:8px;object-fit:cover;">
            <button type="button" class="upload-remove-btn"
                    onclick="event.stopPropagation();removeImage('{{ $uid }}')">✕ Remove</button>
        </div>

        {{-- Placeholder --}}
        <div class="upload-placeholder" id="placeholder_{{ $uid }}"
             style="{{ $value ? 'display:none' : '' }}">
            <div class="upload-icon">📷</div>
            <p>Click or drag &amp; drop to upload</p>
            <p class="upload-hint">JPG, PNG, WEBP — max 5 MB</p>
        </div>

        {{-- Progress --}}
        <div class="upload-progress" id="progress_{{ $uid }}" style="display:none">
            <div class="upload-spinner"></div>
            <span>Uploading…</span>
        </div>
    </div>

    {{-- Hidden file input --}}
    <input type="file" id="file_{{ $uid }}" accept="image/*" style="display:none"
           onchange="uploadImage(this,'{{ $uid }}')">

    <span class="form-error" id="err_{{ $uid }}" style="display:none"></span>
</div>

@once
@push('scripts')
<script>
function uploadImage(input, uid) {
    if (!input.files || !input.files[0]) return;
    const file = input.files[0];
    if (file.size > 5 * 1024 * 1024) {
        showUploadError(uid, 'File too large. Maximum 5 MB.');
        return;
    }
    const formData = new FormData();
    formData.append('image', file);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

    document.getElementById('placeholder_' + uid).style.display = 'none';
    document.getElementById('preview_' + uid).style.display = 'none';
    document.getElementById('progress_' + uid).style.display = 'flex';
    document.getElementById('err_' + uid).style.display = 'none';

    fetch('/admin/upload-image', { method: 'POST', body: formData })
        .then(r => r.json())
        .then(data => {
            if (data.url) {
                document.getElementById('val_' + uid).value = data.url;
                document.getElementById('previewImg_' + uid).src = data.url;
                document.getElementById('preview_' + uid).style.display = 'block';
                document.getElementById('progress_' + uid).style.display = 'none';
            } else {
                showUploadError(uid, data.message || 'Upload failed.');
            }
        })
        .catch(() => showUploadError(uid, 'Network error. Please try again.'));
}

function handleDrop(e, uid) {
    e.preventDefault();
    document.getElementById('zone_' + uid).classList.remove('drag-over');
    const file = e.dataTransfer.files[0];
    if (!file) return;
    const fakeInput = { files: [file] };
    const realInput = document.getElementById('file_' + uid);
    // Create DataTransfer to set files on real input
    try {
        const dt = new DataTransfer();
        dt.items.add(file);
        realInput.files = dt.files;
    } catch(err) {}
    uploadImage({ files: [file] }, uid);
}

function removeImage(uid) {
    document.getElementById('val_' + uid).value = '';
    document.getElementById('previewImg_' + uid).src = '';
    document.getElementById('preview_' + uid).style.display = 'none';
    document.getElementById('placeholder_' + uid).style.display = 'block';
    document.getElementById('file_' + uid).value = '';
}

function showUploadError(uid, msg) {
    document.getElementById('progress_' + uid).style.display = 'none';
    document.getElementById('placeholder_' + uid).style.display = 'block';
    const err = document.getElementById('err_' + uid);
    err.textContent = msg;
    err.style.display = 'block';
}
</script>
@endpush
@endonce
