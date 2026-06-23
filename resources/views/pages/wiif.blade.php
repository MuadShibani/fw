@extends('layouts.app')
@section('title', $page->{'title_'.$lang})

@section('content')
@php $cf = $page->custom_fields ?? []; @endphp

<section class="page-hero" @if($page->image_url) style="background-image:url('{{ $page->image_url }}');background-size:cover;" @else style="background-color:#B04C2C;" @endif>
    <div class="container">
        <h1 class="page-hero-title">{{ $page->{'title_'.$lang} }}</h1>
        <p class="page-hero-subtitle">{{ $page->{'subtitle_'.$lang} }}</p>
    </div>
</section>

{{-- Intro + CTA --}}
<section class="section">
    <div class="container wiif-intro">
        <div class="prose-content">{!! \App\Support\Content::format($page->{'content_'.$lang}) !!}</div>
        @if (!empty($cf['listItems']))
            <ul class="check-list mt-6">
                @foreach ($cf['listItems'] as $item)
                    <li>✓ {{ $item[$lang] ?? $item['en'] }}</li>
                @endforeach
            </ul>
        @endif
        <div class="mt-8 text-center">
            <button type="button" class="btn btn-primary" id="wiifMeetingBtn">
                📅 {{ $lang==='en' ? 'Request a Meeting' : 'طلب اجتماع' }}
            </button>
        </div>
    </div>
</section>

{{-- General Partners --}}
{{--@if (!empty($gps) && $gps->count() > 0)--}}
{{--<section class="section section-alt">--}}
{{--    <div class="container">--}}
{{--        <div class="section-header" data-reveal="fadeIn">--}}
{{--            <h2 class="section-title">{{ $lang==='en' ? 'General Partners' : 'الشركاء العامون' }}</h2>--}}
{{--            <p class="section-subtitle">{{ $lang==='en' ? 'The partners overseeing the fund and shaping its strategy.' : 'الشركاء الذين يشرفون على الصندوق ويرسمون استراتيجيته.' }}</p>--}}
{{--        </div>--}}
{{--        <div class="member-grid">--}}
{{--            @foreach ($gps as $i => $member)--}}
{{--                <article class="member-card" data-reveal="fadeInUp" data-reveal-delay="{{ $i * 0.08 }}s">--}}
{{--                    <div class="member-photo">--}}
{{--                        @if($member->image_url)--}}
{{--                            <img src="{{ $member->image_url }}" alt="{{ $member->{'name_'.$lang} }}" loading="lazy">--}}
{{--                        @else--}}
{{--                            <div class="member-photo-placeholder">{{ mb_substr($member->{'name_'.$lang} ?? '?', 0, 1) }}</div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <h3 class="member-name">{{ $member->{'name_'.$lang} }}</h3>--}}
{{--                    <p class="member-role">{{ $member->{'role_'.$lang} }}</p>--}}
{{--                    @if ($member->{'bio_'.$lang})--}}
{{--                        <div class="member-bio prose-content">{!! \App\Support\Content::format($member->{'bio_'.$lang}) !!}</div>--}}
{{--                    @endif--}}
{{--                </article>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
{{--@endif--}}

{{-- Investment Committee --}}
{{--@if (!empty($committee) && $committee->count() > 0)--}}
{{--<section class="section">--}}
{{--    <div class="container">--}}
{{--        <div class="section-header" data-reveal="fadeIn">--}}
{{--            <h2 class="section-title">{{ $lang==='en' ? 'Investment Committee' : 'لجنة الاستثمار' }}</h2>--}}
{{--            <p class="section-subtitle">{{ $lang==='en' ? 'The committee that evaluates and approves WIIF investments.' : 'اللجنة التي تقيّم استثمارات الصندوق وتعتمدها.' }}</p>--}}
{{--        </div>--}}
{{--        <div class="member-grid">--}}
{{--            @foreach ($committee as $i => $member)--}}
{{--                <article class="member-card" data-reveal="fadeInUp" data-reveal-delay="{{ $i * 0.08 }}s">--}}
{{--                    <div class="member-photo">--}}
{{--                        @if($member->image_url)--}}
{{--                            <img src="{{ $member->image_url }}" alt="{{ $member->{'name_'.$lang} }}" loading="lazy">--}}
{{--                        @else--}}
{{--                            <div class="member-photo-placeholder">{{ mb_substr($member->{'name_'.$lang} ?? '?', 0, 1) }}</div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <h3 class="member-name">{{ $member->{'name_'.$lang} }}</h3>--}}
{{--                    <p class="member-role">{{ $member->{'role_'.$lang} }}</p>--}}
{{--                    @if ($member->{'bio_'.$lang})--}}
{{--                        <div class="member-bio prose-content">{!! \App\Support\Content::format($member->{'bio_'.$lang}) !!}</div>--}}
{{--                    @endif--}}
{{--                </article>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
{{--@endif--}}

{{-- Portfolio Companies (kept as profile-style cards for consistency) --}}
{{--<section class="section section-alt">--}}
{{--    <div class="container">--}}
{{--        <div class="section-header" data-reveal="fadeIn">--}}
{{--            <h2 class="section-title">{{ $lang==='en' ? "Portfolio Companies" : 'شركات المحفظة' }}</h2>--}}
{{--        </div>--}}
{{--        <div class="company-profile-grid">--}}
{{--            @forelse ($portfolio as $company)--}}
{{--                <article class="company-card">--}}
{{--                    <div class="company-card-photo">--}}
{{--                        <img src="{{ $company->logo_url }}" alt="{{ $company->name }}" loading="lazy">--}}
{{--                    </div>--}}
{{--                    <h3 class="company-card-name">{{ $company->name }}</h3>--}}
{{--                    <div class="company-card-chips">--}}
{{--                        <span class="chip chip-sector">{{ $company->{'sector_'.$lang} }}</span>--}}
{{--                    </div>--}}
{{--                    <div class="company-card-desc prose-content">{!! \App\Support\Content::format($company->{'description_'.$lang}) !!}</div>--}}
{{--                    <p class="company-card-founder">📅 {{ \Carbon\Carbon::parse($company->investment_date)->format('M Y') }}</p>--}}
{{--                </article>--}}
{{--            @empty--}}
{{--                <p class="empty-state">{{ $lang==='en' ? 'No portfolio companies yet.' : 'لا توجد شركات في المحفظة بعد.' }}</p>--}}
{{--            @endforelse--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}

{{-- Meeting Request Modal --}}
<div class="meeting-modal" id="wiifMeetingModal" hidden>
    <div class="meeting-modal-overlay" data-meeting-close></div>
    <div class="meeting-modal-card" role="dialog" aria-modal="true" aria-labelledby="wiifMeetingTitle">
        <button type="button" class="meeting-modal-close" data-meeting-close aria-label="Close">×</button>
        <h3 id="wiifMeetingTitle" class="meeting-modal-title">
            {{ $lang==='en' ? 'Request a Meeting with WIIF' : 'طلب اجتماع مع صندوق WIIF' }}
        </h3>
        <p class="meeting-modal-subtitle">
            {{ $lang==='en' ? 'Tell us a bit about your company and we will get back to you to schedule a call.' : 'أخبرنا عن شركتك وسنتواصل معك لتحديد موعد.' }}
        </p>
        @if (session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        <form action="/contact" method="POST" class="contact-form">
            @csrf
            <input type="hidden" name="_subject" value="WIIF Meeting Request">
            <div class="form-row">
                <div class="form-group">
                    <label>{{ $lang==='en' ? 'First Name' : 'الاسم الأول' }} *</label>
                    <input type="text" name="first_name" class="form-input" required>
                </div>
                <div class="form-group">
                    <label>{{ $lang==='en' ? 'Last Name' : 'اسم العائلة' }} *</label>
                    <input type="text" name="last_name" class="form-input" required>
                </div>
            </div>
            <div class="form-group">
                <label>{{ $lang==='en' ? 'Email' : 'البريد الإلكتروني' }} *</label>
                <input type="email" name="email" class="form-input" required>
            </div>
            <div class="form-group">
                <label>{{ $lang==='en' ? 'Company / Message' : 'الشركة / الرسالة' }} *</label>
                <textarea name="message" rows="4" class="form-input" required placeholder="{{ $lang==='en' ? 'Tell us about your company, stage, and what you would like to discuss.' : 'أخبرنا عن شركتك ومرحلتها وما تود مناقشته.' }}"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-full">{{ $lang==='en' ? 'Send Request' : 'إرسال الطلب' }}</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
(function () {
    var btn   = document.getElementById('wiifMeetingBtn');
    var modal = document.getElementById('wiifMeetingModal');
    if (!btn || !modal) return;
    function open()  { modal.removeAttribute('hidden'); document.body.style.overflow = 'hidden'; }
    function close() { modal.setAttribute('hidden', ''); document.body.style.overflow = ''; }
    btn.addEventListener('click', open);
    modal.querySelectorAll('[data-meeting-close]').forEach(function (el) {
        el.addEventListener('click', close);
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !modal.hasAttribute('hidden')) close();
    });
    // If we just submitted (success in session), keep the modal closed.
})();
</script>
@endpush

@include('partials.related-news')
@endsection
