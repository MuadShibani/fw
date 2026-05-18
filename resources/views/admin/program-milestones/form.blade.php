@extends('layouts.admin')
@section('title', $item ? 'Edit Milestone' : 'New Milestone')
@section('page-title', $item ? 'Edit Timeline Milestone' : 'New Timeline Milestone')

@section('content')
<div class="admin-panel">
    <form action="{{ $item ? '/admin/program-milestones/'.$item->id : '/admin/program-milestones' }}" method="POST" id="milestoneForm">
        @csrf
        @if($item) @method('PUT') @endif

        <div class="form-grid-2">
            <div class="form-group">
                <label>Title (English) *</label>
                <input type="text" name="title_en" value="{{ old('title_en', $item->title_en ?? '') }}" class="form-input" required placeholder="Start, Selection, Demo Day…">
            </div>
            <div class="form-group">
                <label>Title (Arabic) *</label>
                <input type="text" name="title_ar" value="{{ old('title_ar', $item->title_ar ?? '') }}" class="form-input" dir="rtl" required>
            </div>
            <div class="form-group">
                <label>Timeline (English)</label>
                <input type="text" name="timeline_en" value="{{ old('timeline_en', $item->timeline_en ?? '') }}" class="form-input" placeholder='e.g. Month 1, Months 3–5'>
            </div>
            <div class="form-group">
                <label>Timeline (Arabic)</label>
                <input type="text" name="timeline_ar" value="{{ old('timeline_ar', $item->timeline_ar ?? '') }}" class="form-input" dir="rtl">
            </div>
            <div class="form-group">
                <label>Icon <span class="label-hint">Emoji or short text — e.g. 🚀, 🎓, ✅, or "1"</span></label>
                <input type="text" name="icon" value="{{ old('icon', $item->icon ?? '') }}" class="form-input" maxlength="10" placeholder="🚀">
            </div>
            <div class="form-group">
                <label>Color</label>
                @php $color = old('color', $item->color ?? ''); @endphp
                <div style="display:flex;gap:.5rem;align-items:center;">
                    <input type="color" id="milestone_color_picker" value="{{ $color ?: '#b04c2c' }}" style="width:48px;height:38px;border:1px solid #ccc;border-radius:6px;padding:2px;cursor:pointer;">
                    <input type="text" name="color" id="milestone_color_hex" value="{{ $color }}" class="form-input" style="max-width:140px;font-family:monospace;" placeholder="#b04c2c" pattern="^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$">
                </div>
            </div>
        </div>

        <div class="mt-4">
            <x-quill-editor name="activities_en" label="Key Activities (English)" :value="old('activities_en', $item->activities_en ?? '')" />
            <x-quill-editor name="activities_ar" label="Key Activities (Arabic)" :value="old('activities_ar', $item->activities_ar ?? '')" dir="rtl" />
        </div>

        <div class="mt-4">
            <x-quill-editor name="output_en" label="Main Output (English)" :value="old('output_en', $item->output_en ?? '')" />
            <x-quill-editor name="output_ar" label="Main Output (Arabic)" :value="old('output_ar', $item->output_ar ?? '')" dir="rtl" />
        </div>

        <div class="form-group mt-4">
            <label>Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order ?? 0) }}" class="form-input" min="0" style="max-width:160px;">
        </div>

        <div class="form-actions">
            <a href="/admin/program-milestones" class="btn btn-outline">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $item ? 'Update' : 'Add' }} Milestone</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
(function () {
    var picker = document.getElementById('milestone_color_picker');
    var hex    = document.getElementById('milestone_color_hex');
    if (!picker || !hex) return;
    picker.addEventListener('input', function () { hex.value = picker.value; });
    hex.addEventListener('input', function () {
        if (/^#([0-9a-fA-F]{6})$/.test(hex.value.trim())) picker.value = hex.value.trim();
    });
})();
</script>
@endpush
@endsection
