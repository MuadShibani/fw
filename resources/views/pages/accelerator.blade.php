@extends('layouts.app')
@section('title', $page->{'title_'.$lang})

@section('content')
@php $cf = $page->custom_fields ?? []; @endphp

{{-- Hero --}}
<section class="page-hero" @if($page->image_url) style="background-image:url('{{ $page->image_url }}');background-size:cover;" @else style="background-color:#9FD4D5;color:#524037;" @endif>
    <div class="container">
        <h1 class="page-hero-title">{{ $page->{'title_'.$lang} }}</h1>
        <p class="page-hero-subtitle">{{ $page->{'subtitle_'.$lang} }}</p>
        @if(!empty($cf['apply_link']))
        <a href="{{ $cf['apply_link'] }}" target="_blank" class="btn btn-brown mt-6">
            {{ $lang==='en' ? 'Apply Now' : 'قدّم الآن' }}
        </a>
        @endif
    </div>
</section>

@if($page->{'content_'.$lang})
<section class="section">
    <div class="container prose-content">
        {!! \App\Support\Content::format($page->{'content_'.$lang}) !!}
    </div>
</section>
@endif

{{-- ── PROGRAM FEATURES — collapsible accordion ─────────────── --}}
<section class="section section-alt">
    <div class="container">
        <div class="section-header" data-reveal="fadeIn">
            <h2 class="section-title">{{ $lang==='en' ? 'Program Features' : 'مميزات البرنامج' }}</h2>
            <p class="section-subtitle">{{ $lang==='en' ? 'Click a feature to read more about it.' : 'اضغط على أي ميزة لمعرفة المزيد.' }}</p>
        </div>
        <div class="features-accordion">
            @forelse ($features as $i => $feature)
                <details class="feature-item" @if($loop->first) open @endif>
                    <summary class="feature-summary">
                        <span class="feature-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="feature-name">{{ $feature->{'name_'.$lang} }}</span>
                        <span class="feature-chevron" aria-hidden="true">▾</span>
                    </summary>
                    <div class="feature-description prose-content">
                        {!! \App\Support\Content::format($feature->{'description_'.$lang}) !!}
                    </div>
                </details>
            @empty
                <p class="empty-state">{{ $lang==='en' ? 'No features published yet.' : 'لا توجد مميزات منشورة بعد.' }}</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ── PROGRAM TIMELINE — interactive roadmap from DB ──────────── --}}
<section class="section">
    <div class="container">
        <div class="section-header" data-reveal="fadeIn">
            <h2 class="section-title">
                {{ $cf['timelineTitle'][$lang] ?? ($lang==='en' ? 'Program Timeline' : 'الجدول الزمني للبرنامج') }}
            </h2>
            <p class="section-subtitle">{{ $lang==='en' ? 'Click any milestone to reveal its key activities and main output.' : 'اضغط على أي مرحلة لاستعراض أنشطتها الرئيسية ومخرجاتها.' }}</p>
        </div>

        
{{--        <div class="roadmap">--}}
{{--            @forelse ($milestones as $i => $m)--}}
{{--                <div class="roadmap-stage" data-reveal="fadeInUp" data-reveal-delay="{{ $i * 0.1 }}s">--}}
{{--                    <button type="button" class="roadmap-marker" data-roadmap-toggle="stage-{{ $m->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="stage-{{ $m->id }}" style="--roadmap-color: {{ $m->color ?: '#b04c2c' }}">--}}
{{--                        <span class="roadmap-icon">{{ $m->icon ?: ($i + 1) }}</span>--}}
{{--                        <span class="roadmap-stage-title">{{ $m->{'title_'.$lang} }}</span>--}}
{{--                        @if($m->{'timeline_'.$lang})--}}
{{--                            <span class="roadmap-stage-time">{{ $m->{'timeline_'.$lang} }}</span>--}}
{{--                        @endif--}}
{{--                    </button>--}}
{{--                    <div class="roadmap-detail" id="stage-{{ $m->id }}" @if(!$loop->first) hidden @endif>--}}
{{--                        @if($m->{'activities_'.$lang})--}}
{{--                            <div class="roadmap-block">--}}
{{--                                <span class="roadmap-block-label">{{ $lang==='en' ? 'Key Activities' : 'الأنشطة الرئيسية' }}</span>--}}
{{--                                <div class="prose-content">{!! \App\Support\Content::format($m->{'activities_'.$lang}) !!}</div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                        @if($m->{'output_'.$lang})--}}
{{--                            <div class="roadmap-block roadmap-block-output">--}}
{{--                                <span class="roadmap-block-label">{{ $lang==='en' ? 'Main Output' : 'المخرج الرئيسي' }}</span>--}}
{{--                                <div class="prose-content">✅ {!! \App\Support\Content::format($m->{'output_'.$lang}) !!}</div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @empty--}}
{{--                <p class="empty-state">{{ $lang==='en' ? 'Timeline coming soon.' : 'الجدول الزمني قريباً.' }}</p>--}}
{{--            @endforelse--}}
{{--        </div>--}}
    </div>
</section>

@push('scripts')
<script>
(function () {
    document.querySelectorAll('[data-roadmap-toggle]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var id = btn.getAttribute('data-roadmap-toggle');
            var panel = document.getElementById(id);
            if (!panel) return;
            var isOpen = !panel.hasAttribute('hidden');
            // Close all other panels for an exclusive accordion feel
            document.querySelectorAll('.roadmap-detail').forEach(function (p) { p.setAttribute('hidden', ''); });
            document.querySelectorAll('[data-roadmap-toggle]').forEach(function (b) { b.setAttribute('aria-expanded', 'false'); });
            if (!isOpen) {
                panel.removeAttribute('hidden');
                btn.setAttribute('aria-expanded', 'true');
            }
        });
    });
})();
</script>
@endpush

{{-- Cohorts --}}
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ $lang==='en' ? 'Cohort Summary' : 'ملخص الدفعات' }}</h2>
            <p class="section-subtitle">{{ $lang==='en' ? 'Each cohort enrolls up to 10 startups. Click a cohort to view its participants.' : 'تضم كل دفعة ما يصل إلى 10 شركات ناشئة. اضغط على الدفعة لعرض المشاركين.' }}</p>
        </div>

        <div class="cohorts-stack">
            @forelse ($cohorts as $cohort)
                @php $startupsList = $cohort->startups_list ?? []; @endphp
                <details class="cohort-card" @if($loop->first) open @endif>
                    <summary class="cohort-card-header">
                        <div class="cohort-card-title">
                            <strong>{{ $cohort->{'name_'.$lang} }}</strong>
                            <span class="status-badge status-{{ strtolower($cohort->status) }}">{{ $cohort->status }}</span>
                        </div>
                        <div class="cohort-card-meta">
                            <span>📅 {{ \Carbon\Carbon::parse($cohort->start_date)->format('d M Y') }} — {{ \Carbon\Carbon::parse($cohort->end_date)->format('d M Y') }}</span>
                            <span>👥 {{ count($startupsList) ?: $cohort->startups_count }} {{ $lang==='en' ? 'startups' : 'شركة' }}</span>
                        </div>
                        <span class="cohort-card-toggle" aria-hidden="true">▾</span>
                    </summary>

                    @if (!empty($startupsList))
                        <div class="cohort-startups-grid">
                            @foreach ($startupsList as $s)
                                <div class="cohort-startup-card">
                                    @if(!empty($s['logo_url']))
                                        <img src="{{ $s['logo_url'] }}" alt="{{ $s['name'] ?? '' }}" class="cohort-startup-logo" loading="lazy">
                                    @else
                                        <div class="cohort-startup-logo cohort-startup-logo-placeholder">{{ mb_substr($s['name'] ?? '?', 0, 1) }}</div>
                                    @endif
                                    <div class="cohort-startup-info">
                                        <h4 class="cohort-startup-name">{{ $s['name'] ?? '' }}</h4>
                                        @if(!empty($s['sector_'.$lang]) || !empty($s['sector_en']))
                                            <span class="cohort-startup-sector">{{ $s['sector_'.$lang] ?? $s['sector_en'] ?? '' }}</span>
                                        @endif
                                        @if(!empty($s['description_'.$lang]) || !empty($s['description_en']))
                                            <p class="cohort-startup-desc">{{ $s['description_'.$lang] ?? $s['description_en'] ?? '' }}</p>
                                        @endif
                                        @if(!empty($s['founder_name']))
                                            <p class="cohort-startup-founder">👤 {{ $s['founder_name'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="empty-state">{{ $lang==='en' ? 'Startup roster coming soon.' : 'قائمة الشركات الناشئة قريباً.' }}</p>
                    @endif
                </details>
            @empty
                <p class="empty-state">{{ $lang==='en' ? 'No cohorts yet.' : 'لا توجد دفعات بعد.' }}</p>
            @endforelse
        </div>
    </div>
</section>

@push('styles')
<style>
.cohorts-stack { display: flex; flex-direction: column; gap: 1rem; }
.cohort-card { background: #fff; border: 1px solid #e5e0d8; border-radius: 12px; overflow: hidden; }
.cohort-card[open] { box-shadow: 0 2px 8px rgba(82, 64, 55, .08); }
.cohort-card-header { display: flex; align-items: center; gap: 1rem; padding: 1rem 1.25rem; cursor: pointer; list-style: none; }
.cohort-card-header::-webkit-details-marker { display: none; }
.cohort-card-title { display: flex; align-items: center; gap: .75rem; flex: 1 1 auto; }
.cohort-card-title strong { font-size: 1.1rem; }
.cohort-card-meta { display: flex; gap: 1.25rem; flex-wrap: wrap; color: #6b5b50; font-size: .9rem; }
.cohort-card-toggle { display: inline-block; transition: transform .2s ease; color: #b04c2c; }
.cohort-card[open] .cohort-card-toggle { transform: rotate(180deg); }
.cohort-startups-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1rem; padding: 0 1.25rem 1.25rem; }
.cohort-startup-card { display: flex; gap: .75rem; padding: 1rem; background: #faf6ee; border-radius: 10px; border: 1px solid #ece5d6; }
.cohort-startup-logo { width: 48px; height: 48px; border-radius: 8px; object-fit: cover; flex-shrink: 0; }
.cohort-startup-logo-placeholder { display: flex; align-items: center; justify-content: center; background: #b04c2c; color: #fff; font-weight: 600; font-size: 1.25rem; text-transform: uppercase; }
.cohort-startup-info { flex: 1 1 auto; min-width: 0; }
.cohort-startup-name { margin: 0 0 .25rem; font-size: .95rem; font-weight: 600; color: #524037; }
.cohort-startup-sector { display: inline-block; padding: .15rem .5rem; background: #ecce9e; color: #524037; border-radius: 99px; font-size: .7rem; margin-bottom: .35rem; }
.cohort-startup-desc { margin: .35rem 0 .25rem; font-size: .82rem; color: #6b5b50; line-height: 1.45; }
.cohort-startup-founder { margin: .25rem 0 0; font-size: .78rem; color: #8a7666; }
[dir="rtl"] .cohort-card-toggle { transform: rotate(0); }
[dir="rtl"] .cohort-card[open] .cohort-card-toggle { transform: rotate(180deg); }
</style>
@endpush

@include('partials.related-news')
@endsection
