{{--
    Reusable Quill rich-text editor component.

    Usage:
        <x-quill-editor name="content_en" label="Content (English)" :value="old('content_en', $item->content_en ?? '')" />
        <x-quill-editor name="content_ar" label="Content (Arabic)" :value="old('content_ar', $item->content_ar ?? '')" dir="rtl" />

    The hidden input matches `$name` so the field POSTs as that name.
    Existing Markdown content is converted to HTML on display so old posts
    look formatted in the editor instead of showing literal `**bold**`.
--}}
@props([
    'name',
    'label'    => null,
    'value'    => '',
    'dir'      => 'ltr',
    'required' => false,
    'hint'     => 'Rich text',
])

@php
    $uid = 'quill_' . str_replace(['[', ']', '.'], '_', $name) . '_' . uniqid();
@endphp

<div class="form-group">
    @if ($label)
        <label>{{ $label }}{{ $required ? ' *' : '' }}@if($hint) <span class="label-hint">{{ $hint }}</span>@endif</label>
    @endif
    <div id="{{ $uid }}"
         class="quill-editor-box"
         data-quill-target="hidden_{{ $uid }}"
         @if($dir === 'rtl') dir="rtl" @endif>{!! \App\Support\Content::format($value) !!}</div>
    <input type="hidden" name="{{ $name }}" id="hidden_{{ $uid }}">
</div>

@once
@push('styles')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
(function() {
    var registry = window.__quillRegistry = window.__quillRegistry || [];

    function init() {
        document.querySelectorAll('.quill-editor-box[data-quill-target]').forEach(function(el) {
            if (el.__quillReady) return;
            var hiddenId = el.getAttribute('data-quill-target');
            var hidden = document.getElementById(hiddenId);
            if (!hidden) return;
            var q = new Quill('#' + el.id, {
                theme: 'snow',
                modules: { toolbar: [
                    [{ header: [1,2,3,false] }],
                    ['bold','italic','underline','strike'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    [{ align: [] }],
                    ['link','blockquote'],
                    ['clean']
                ]}
            });
            el.__quillReady = true;
            registry.push({ quill: q, hidden: hidden });
        });

        // Attach a single submit listener to each form holding any Quill editor.
        var forms = new Set();
        registry.forEach(function(entry) {
            var f = entry.hidden.closest('form');
            if (f) forms.add(f);
        });
        forms.forEach(function(f) {
            if (f.__quillSubmitWired) return;
            f.__quillSubmitWired = true;
            f.addEventListener('submit', function() {
                registry.forEach(function(entry) {
                    if (f.contains(entry.hidden)) {
                        var html = entry.quill.root.innerHTML;
                        // Treat empty Quill state as truly empty
                        if (html === '<p><br></p>') html = '';
                        entry.hidden.value = html;
                    }
                });
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
</script>
@endpush
@endonce
