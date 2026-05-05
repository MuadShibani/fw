@extends('layouts.admin')
@section('title', $item ? 'Edit Slide' : 'New Slide')
@section('page-title', $item ? 'Edit Hero Slide' : 'New Hero Slide')

@section('content')
<div class="admin-panel">
    <form action="{{ $item ? '/admin/hero/'.$item->id : '/admin/hero' }}" method="POST" id="heroForm">
        @csrf
        @if($item) @method('PUT') @endif

        <div class="form-grid-2">
            <div class="form-group">
                <label>Title (English)</label>
                <input type="text" name="title_en" value="{{ old('title_en', $item->title_en ?? '') }}" class="form-input">
            </div>
            <div class="form-group">
                <label>Title (Arabic)</label>
                <input type="text" name="title_ar" value="{{ old('title_ar', $item->title_ar ?? '') }}" class="form-input" dir="rtl">
            </div>
            <div class="form-group">
                <label>Subtitle (English)</label>
                <textarea name="subtitle_en" rows="3" class="form-input">{{ old('subtitle_en', $item->subtitle_en ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label>Subtitle (Arabic)</label>
                <textarea name="subtitle_ar" rows="3" class="form-input" dir="rtl">{{ old('subtitle_ar', $item->subtitle_ar ?? '') }}</textarea>
            </div>
        </div>

        <div class="mt-4">
            <x-image-upload name="image_url" label="Slide Background Image" :value="old('image_url', $item->image_url ?? '')" />
        </div>

        <div class="form-grid-2 mt-4">
            <div class="form-group">
                <label>CTA Button Label (English)</label>
                <input type="text" name="cta_label_en" value="{{ old('cta_label_en', $item->cta_label_en ?? '') }}" class="form-input" placeholder="Learn More">
            </div>
            <div class="form-group">
                <label>CTA Button Label (Arabic)</label>
                <input type="text" name="cta_label_ar" value="{{ old('cta_label_ar', $item->cta_label_ar ?? '') }}" class="form-input" dir="rtl" placeholder="اعرف المزيد">
            </div>
            <div class="form-group">
                <label>CTA Link</label>
                <input type="text" name="cta_link" value="{{ old('cta_link', $item->cta_link ?? '') }}" class="form-input" placeholder="/about or https://...">
            </div>
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" class="form-input" min="0">
                <span class="form-hint">Lower numbers appear first.</span>
            </div>
        </div>

        @php $textColor = old('text_color', $item->text_color ?? ''); @endphp
        <div class="form-group mt-4">
            <label>Text Color</label>
            <div style="display:flex;gap:.5rem;align-items:center;flex-wrap:wrap;">
                <input type="color" id="hero_text_color_picker"
                       value="{{ $textColor ?: '#ffffff' }}"
                       style="width:48px;height:38px;border:1px solid #ccc;border-radius:6px;padding:2px;cursor:pointer;">
                <input type="text" name="text_color" id="hero_text_color_hex"
                       value="{{ $textColor }}"
                       class="form-input"
                       style="max-width:140px;font-family:monospace;"
                       placeholder="#ffffff"
                       pattern="^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6}|[0-9a-fA-F]{8})$"
                       title="Hex code, e.g. #ffffff">
                <button type="button" id="hero_text_color_clear" class="btn btn-xs btn-outline">Use default</button>
            </div>
            <span class="form-hint">Optional. Leave blank to use the auto default (white on image slides, brown on plain slides).</span>
        </div>

        <div class="form-group mt-4">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active ?? true) ? 'checked' : '' }}>
                Active (show on homepage)
            </label>
        </div>

        <div class="form-actions">
            <a href="/admin/hero" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $item ? 'Update' : 'Create' }} Slide</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
(function () {
    var picker = document.getElementById('hero_text_color_picker');
    var hex    = document.getElementById('hero_text_color_hex');
    var clear  = document.getElementById('hero_text_color_clear');
    if (!picker || !hex) return;

    // Picker → hex
    picker.addEventListener('input', function () {
        hex.value = picker.value;
    });
    // Hex → picker (only if it's a valid 6/8-digit value the input[type=color] understands)
    hex.addEventListener('input', function () {
        var v = hex.value.trim();
        if (/^#([0-9a-fA-F]{6})$/.test(v)) picker.value = v;
    });
    clear.addEventListener('click', function () {
        hex.value = '';
        picker.value = '#ffffff';
    });
})();
</script>
@endpush
@endsection
