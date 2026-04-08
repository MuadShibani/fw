
@if (session('success'))
    <div class="alert alert-success mb-6">✅ {{ session('success') }}</div>
@endif
@if ($errors->any())
    <div class="alert alert-error mb-6">
        @foreach ($errors->all() as $e)<p>{{ $e }}</p>@endforeach
    </div>
@endif

<form action="/admin/pages/{{ $page->page_key }}" method="POST" id="pageForm">
    @csrf @method('PUT')

    {{-- ── HERO / HEADER ── --}}
    <div class="page-section-card">
        <h2 class="page-section-title">🖼 Hero / Header Section</h2>
        <div class="form-group mb-5">
            <x-image-upload name="image_url" label="Header Image (Optional)" :value="old('image_url', $page->image_url ?? '')" />
        </div>
        <div class="form-grid-2">
            <div class="form-group">
                <label>Title (English) *</label>
                <input type="text" name="title_en" value="{{ old('title_en', $page->title_en) }}" class="form-input" required>
                @error('title_en')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Title (Arabic) *</label>
                <input type="text" name="title_ar" value="{{ old('title_ar', $page->title_ar) }}" class="form-input" dir="rtl" required>
            </div>
            <div class="form-group">
                <label>Subtitle (English)</label>
                <textarea name="subtitle_en" rows="2" class="form-input">{{ old('subtitle_en', $page->subtitle_en) }}</textarea>
            </div>
            <div class="form-group">
                <label>Subtitle (Arabic)</label>
                <textarea name="subtitle_ar" rows="2" class="form-input" dir="rtl">{{ old('subtitle_ar', $page->subtitle_ar) }}</textarea>
            </div>
        </div>
    </div>

    {{-- ── MAIN CONTENT (Quill) ── --}}
    <div class="page-section-card">
        <h2 class="page-section-title">📝 Main Content</h2>
        <div class="form-group mb-5">
            <label>Content (English) <span class="label-hint">Rich text</span></label>
            <div id="quill_en" class="quill-editor-box">{!! old('content_en', $page->content_en) !!}</div>
            <input type="hidden" name="content_en" id="content_en_hidden">
        </div>
        <div class="form-group">
            <label>Content (Arabic) <span class="label-hint">Rich text</span></label>
            <div id="quill_ar" class="quill-editor-box" dir="rtl">{!! old('content_ar', $page->content_ar) !!}</div>
            <input type="hidden" name="content_ar" id="content_ar_hidden">
        </div>
    </div>

    {{-- ── PAGE-SPECIFIC FIELDS ── --}}
    @php $cf = $page->custom_fields ?? []; @endphp

    @if ($page->page_key === 'home')
    <div class="page-section-card">
        <h2 class="page-section-title">🏠 Home Page — Buttons & Labels</h2>
        <div class="form-grid-2">
            <div class="form-group">
                <label>Primary CTA Button (English)</label>
                <input type="text" name="cf_cta_primary_en" value="{{ old('cf_cta_primary_en', $cf['cta_primary']['en'] ?? 'Learn More') }}" class="form-input">
            </div>
            <div class="form-group">
                <label>Primary CTA Button (Arabic)</label>
                <input type="text" name="cf_cta_primary_ar" value="{{ old('cf_cta_primary_ar', $cf['cta_primary']['ar'] ?? 'اعرف المزيد') }}" class="form-input" dir="rtl">
            </div>
            <div class="form-group">
                <label>Secondary CTA Button (English)</label>
                <input type="text" name="cf_cta_secondary_en" value="{{ old('cf_cta_secondary_en', $cf['cta_secondary']['en'] ?? 'Contact Us') }}" class="form-input">
            </div>
            <div class="form-group">
                <label>Secondary CTA Button (Arabic)</label>
                <input type="text" name="cf_cta_secondary_ar" value="{{ old('cf_cta_secondary_ar', $cf['cta_secondary']['ar'] ?? 'تواصل معنا') }}" class="form-input" dir="rtl">
            </div>
        </div>
    </div>
    @endif

    @if ($page->page_key === 'about')
    <div class="page-section-card">
        <h2 class="page-section-title">🎯 Mission / Vision / Values Cards</h2>
        @foreach(['mission','vision','values'] as $block)
        <div class="custom-field-block">
            <h4 class="custom-field-heading">{{ ucfirst($block) }}</h4>
            <div class="form-grid-2">
                <div class="form-group">
                    <label>Card Title (English)</label>
                    <input type="text" name="cf_{{ $block }}_title_en" value="{{ old('cf_'.$block.'_title_en', $cf[$block.'_title']['en'] ?? '') }}" class="form-input">
                </div>
                <div class="form-group">
                    <label>Card Title (Arabic)</label>
                    <input type="text" name="cf_{{ $block }}_title_ar" value="{{ old('cf_'.$block.'_title_ar', $cf[$block.'_title']['ar'] ?? '') }}" class="form-input" dir="rtl">
                </div>
                <div class="form-group">
                    <label>Card Body (English)</label>
                    <textarea name="cf_{{ $block }}_body_en" rows="3" class="form-input">{{ old('cf_'.$block.'_body_en', $cf[$block.'_body']['en'] ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Card Body (Arabic)</label>
                    <textarea name="cf_{{ $block }}_body_ar" rows="3" class="form-input" dir="rtl">{{ old('cf_'.$block.'_body_ar', $cf[$block.'_body']['ar'] ?? '') }}</textarea>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if ($page->page_key === 'accelerator')
    <div class="page-section-card">
        <h2 class="page-section-title">🚀 Accelerator Settings</h2>
        <div class="form-group mb-4">
            <label>Apply / Application Form Link</label>
            <input type="text" name="cf_apply_link" value="{{ old('cf_apply_link', $cf['apply_link'] ?? '') }}" class="form-input" placeholder="https://forms.google.com/...">
        </div>
        <div class="form-grid-2">
            <div class="form-group">
                <label>Timeline Section Title (English)</label>
                <input type="text" name="cf_timelineTitle_en" value="{{ old('cf_timelineTitle_en', $cf['timelineTitle']['en'] ?? '') }}" class="form-input">
            </div>
            <div class="form-group">
                <label>Timeline Section Title (Arabic)</label>
                <input type="text" name="cf_timelineTitle_ar" value="{{ old('cf_timelineTitle_ar', $cf['timelineTitle']['ar'] ?? '') }}" class="form-input" dir="rtl">
            </div>
        </div>
        <div class="form-hint mt-2">💡 Timeline steps and program features are managed via the database seeder. Contact your developer to update them.</div>
    </div>
    @endif

    @if ($page->page_key === 'yain')
    <div class="page-section-card">
        <h2 class="page-section-title">👥 YAIN Section Labels & Links</h2>
        <div class="form-grid-2">
            <div class="form-group">
                <label>Champions Section Title (English)</label>
                <input type="text" name="cf_championsTitle_en" value="{{ old('cf_championsTitle_en', $cf['championsTitle']['en'] ?? '') }}" class="form-input">
            </div>
            <div class="form-group">
                <label>Champions Section Title (Arabic)</label>
                <input type="text" name="cf_championsTitle_ar" value="{{ old('cf_championsTitle_ar', $cf['championsTitle']['ar'] ?? '') }}" class="form-input" dir="rtl">
            </div>
            <div class="form-group">
                <label>Champions Subtitle (English)</label>
                <input type="text" name="cf_championsSubtitle_en" value="{{ old('cf_championsSubtitle_en', $cf['championsSubtitle']['en'] ?? '') }}" class="form-input">
            </div>
            <div class="form-group">
                <label>Champions Subtitle (Arabic)</label>
                <input type="text" name="cf_championsSubtitle_ar" value="{{ old('cf_championsSubtitle_ar', $cf['championsSubtitle']['ar'] ?? '') }}" class="form-input" dir="rtl">
            </div>
            <div class="form-group">
                <label>Portfolio Section Title (English)</label>
                <input type="text" name="cf_portfolioTitle_en" value="{{ old('cf_portfolioTitle_en', $cf['portfolioTitle']['en'] ?? '') }}" class="form-input">
            </div>
            <div class="form-group">
                <label>Portfolio Section Title (Arabic)</label>
                <input type="text" name="cf_portfolioTitle_ar" value="{{ old('cf_portfolioTitle_ar', $cf['portfolioTitle']['ar'] ?? '') }}" class="form-input" dir="rtl">
            </div>
            <div class="form-group">
                <label>Portfolio Subtitle (English)</label>
                <input type="text" name="cf_portfolioSubtitle_en" value="{{ old('cf_portfolioSubtitle_en', $cf['portfolioSubtitle']['en'] ?? '') }}" class="form-input">
            </div>
            <div class="form-group">
                <label>Portfolio Subtitle (Arabic)</label>
                <input type="text" name="cf_portfolioSubtitle_ar" value="{{ old('cf_portfolioSubtitle_ar', $cf['portfolioSubtitle']['ar'] ?? '') }}" class="form-input" dir="rtl">
            </div>
            <div class="form-group">
                <label>CTA Title (English)</label>
                <input type="text" name="cf_ctaTitle_en" value="{{ old('cf_ctaTitle_en', $cf['ctaTitle']['en'] ?? '') }}" class="form-input">
            </div>
            <div class="form-group">
                <label>CTA Title (Arabic)</label>
                <input type="text" name="cf_ctaTitle_ar" value="{{ old('cf_ctaTitle_ar', $cf['ctaTitle']['ar'] ?? '') }}" class="form-input" dir="rtl">
            </div>
            <div class="form-group">
                <label>CTA Subtitle (English)</label>
                <textarea name="cf_ctaSubtitle_en" rows="2" class="form-input">{{ old('cf_ctaSubtitle_en', $cf['ctaSubtitle']['en'] ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label>CTA Subtitle (Arabic)</label>
                <textarea name="cf_ctaSubtitle_ar" rows="2" class="form-input" dir="rtl">{{ old('cf_ctaSubtitle_ar', $cf['ctaSubtitle']['ar'] ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label>Investor Join Form Link</label>
                <input type="text" name="cf_investor_join_link" value="{{ old('cf_investor_join_link', $cf['investor_join_link'] ?? '') }}" class="form-input" placeholder="https://forms.google.com/...">
            </div>
            <div class="form-group">
                <label>Startup Pitch Form Link</label>
                <input type="text" name="cf_startup_pitch_link" value="{{ old('cf_startup_pitch_link', $cf['startup_pitch_link'] ?? '') }}" class="form-input" placeholder="https://forms.google.com/...">
            </div>
        </div>
    </div>
    @endif

    @if ($page->page_key === 'wiif')
    <div class="page-section-card">
        <h2 class="page-section-title">📊 WIIF — SDG Section</h2>
        <div class="form-grid-2">
            <div class="form-group">
                <label>SDG Section Title (English)</label>
                <input type="text" name="cf_sdgTitle_en" value="{{ old('cf_sdgTitle_en', $cf['sdgTitle']['en'] ?? '') }}" class="form-input">
            </div>
            <div class="form-group">
                <label>SDG Section Title (Arabic)</label>
                <input type="text" name="cf_sdgTitle_ar" value="{{ old('cf_sdgTitle_ar', $cf['sdgTitle']['ar'] ?? '') }}" class="form-input" dir="rtl">
            </div>
            <div class="form-group">
                <label>SDG Description (English)</label>
                <textarea name="cf_sdgDesc_en" rows="3" class="form-input">{{ old('cf_sdgDesc_en', $cf['sdgDesc']['en'] ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label>SDG Description (Arabic)</label>
                <textarea name="cf_sdgDesc_ar" rows="3" class="form-input" dir="rtl">{{ old('cf_sdgDesc_ar', $cf['sdgDesc']['ar'] ?? '') }}</textarea>
            </div>
        </div>
        <div class="form-hint mt-2">💡 Fund bullet points (Capital Structure, Ticket Size, Focus) are managed via the database seeder.</div>
    </div>
    @endif

    @if ($page->page_key === 'sil')
    <div class="page-section-card">
        <h2 class="page-section-title">💡 SIL Settings</h2>
        <div class="form-group mb-5">
            <label>External Redirect Link <span class="label-hint">If set, /sil redirects here instead of showing this page</span></label>
            <input type="text" name="cf_external_link" value="{{ old('cf_external_link', $cf['external_link'] ?? '') }}" class="form-input" placeholder="https://...  (leave blank to show page normally)">
        </div>
        @foreach(['grants','community','impact'] as $block)
        <div class="custom-field-block">
            <h4 class="custom-field-heading">{{ $block === 'grants' ? 'Innovation Grants' : ($block === 'community' ? 'Community Programs' : 'Impact Measurement') }} Card</h4>
            <div class="form-grid-2">
                <div class="form-group">
                    <label>Title (English)</label>
                    <input type="text" name="cf_{{ $block }}_title_en" value="{{ old('cf_'.$block.'_title_en', $cf[$block.'_title']['en'] ?? '') }}" class="form-input">
                </div>
                <div class="form-group">
                    <label>Title (Arabic)</label>
                    <input type="text" name="cf_{{ $block }}_title_ar" value="{{ old('cf_'.$block.'_title_ar', $cf[$block.'_title']['ar'] ?? '') }}" class="form-input" dir="rtl">
                </div>
                <div class="form-group">
                    <label>Body (English)</label>
                    <textarea name="cf_{{ $block }}_body_en" rows="3" class="form-input">{{ old('cf_'.$block.'_body_en', $cf[$block.'_body']['en'] ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Body (Arabic)</label>
                    <textarea name="cf_{{ $block }}_body_ar" rows="3" class="form-input" dir="rtl">{{ old('cf_'.$block.'_body_ar', $cf[$block.'_body']['ar'] ?? '') }}</textarea>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- ── SAVE BAR ── --}}
    <div class="form-actions sticky-save">
        <a href="/admin/pages" class="btn btn-outline">Cancel</a>
        <button type="submit" class="btn btn-primary" id="saveBtn">💾 Save Page</button>
    </div>
</form>

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

document.getElementById('pageForm').addEventListener('submit', function(e) {
    document.getElementById('content_en_hidden').value = quillEn.root.innerHTML;
    document.getElementById('content_ar_hidden').value = quillAr.root.innerHTML;
});
</script>
@endpush
