@extends('layouts.app')
@section('title', $homePage?->{'title_'.$lang} ?? ($lang==='ar' ? 'الرئيسية' : 'Home'))

@section('content')
@php $hp = $homePage; $cf = $hp?->custom_fields ?? []; @endphp

{{-- Hero --}}
<section class="hero" @if($hp?->image_url) style="background-image:url('{{ $hp->image_url }}');background-size:cover;background-position:center;" @endif>
    <div class="hero-bg-pattern"></div>
    <div class="container">
        <div class="hero-content">
            @if($hp?->content_en || $hp?->content_ar)
            <span class="hero-badge">🇾🇪 {{ $hp->{'content_'.$lang} }}</span>
            @endif
            <h1 class="hero-title">{{ $hp?->{'title_'.$lang} ?? '' }}</h1>
            <p class="hero-subtitle">{{ $hp?->{'subtitle_'.$lang} ?? '' }}</p>
            <div class="hero-actions">
                <a href="/about" class="btn btn-primary">{{ $cf['cta_primary'][$lang] ?? ($lang==='en'?'Learn More':'اعرف المزيد') }}</a>
                <a href="/contact" class="btn btn-outline">{{ $lang==='en'?'Contact Us':'تواصل معنا' }}</a>
            </div>
        </div>
    </div>
</section>

{{-- Stats --}}
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            @foreach ($stats as $stat)
                <div class="stat-card">
                    <div class="stat-value">{{ $stat->value }}</div>
                    <div class="stat-label">{{ $stat->{'label_'.$lang} }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Programs --}}
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ $lang==='en'?'Our Programs':'برامجنا' }}</h2>
            <p class="section-subtitle">{{ $lang==='en'?'Comprehensive initiatives to support entrepreneurs at every stage.':'مبادرات شاملة لدعم رواد الأعمال في كل مرحلة.' }}</p>
        </div>
        <div class="programs-grid">
            @foreach ($programs as $program)
                <a href="{{ $program->path }}" class="program-card" style="--program-color:{{ $program->color }}">
                    <div class="program-card-accent"></div>
                    <h3 class="program-title">{{ $program->{'title_'.$lang} }}</h3>
                    <p class="program-desc">{{ $program->{'description_'.$lang} }}</p>
                    @if ($program->features)
                        <ul class="program-features">
{{--                            @foreach ($program->features as $feature)--}}
{{--                                <li>✓ {{ $feature[$lang] ?? $feature['en'] }}</li>--}}
{{--                            @endforeach--}}
                        </ul>
                    @endif
                    <span class="program-link">{{ $lang==='en'?'Learn More':'اعرف المزيد' }} <span>{{ $isRTL?'←':'→' }}</span></span>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Latest News --}}
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ $lang==='en'?'Latest News':'آخر الأخبار' }}</h2>
        </div>
        <div class="news-grid">
            @foreach ($latestNews as $item)
                <a href="/media/{{ $item->id }}" class="news-card">
                    <div class="news-img-wrap">
                        <img src="{{ $item->{'image_'.$lang} ?? 'https://picsum.photos/400/250?random='.$item->id }}"
                             alt="{{ $item->{'title_'.$lang} }}" class="news-img" loading="lazy">
                        <span class="news-badge">{{ $item->category }}</span>
                    </div>
                    <div class="news-body">
                        <p class="news-date">{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</p>
                        <h3 class="news-title">{{ $item->{'title_'.$lang} }}</h3>
                        <p class="news-summary">{{ $item->{'summary_'.$lang} }}</p>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="section-cta">
            <a href="/media" class="btn btn-outline">{{ $lang==='en'?'All News':'كل الأخبار' }}</a>
        </div>
    </div>
</section>

{{-- Upcoming Events — 3-col card grid like news --}}
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ $lang==='en'?'Upcoming Events':'الفعاليات القادمة' }}</h2>
        </div>
        <div class="news-grid">
            @forelse ($upcomingEvents as $event)
                <a href="{{ $event->registration_link ?: '/events' }}" {{ $event->registration_link ? 'target="_blank"' : '' }} class="news-card event-news-card">
                    <div class="news-img-wrap">
                        <div class="event-card-img-placeholder">
                            <div class="event-card-date-large">
                                <span class="event-day-lg">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                                <span class="event-month-lg">{{ \Carbon\Carbon::parse($event->event_date)->format('M Y') }}</span>
                            </div>
                        </div>
                        <span class="news-badge event-type-badge-card event-type-{{ strtolower(str_replace(' ','-',$event->type)) }}">{{ $event->type }}</span>
                    </div>
                    <div class="news-body">
                        <h3 class="news-title">{{ $event->{'title_'.$lang} }}</h3>
                        <p class="news-summary">
                            🕐 {{ $event->event_time }}<br>
                            {{ $event->is_virtual ? '🌐' : '📍' }} {{ $event->{'location_'.$lang} }}
                        </p>
                        @if ($event->registration_link)
                        <span class="event-register-cta">{{ $lang==='en'?'Register →':'سجّل ←' }}</span>
                        @endif
                    </div>
                </a>
            @empty
                <p class="empty-state col-span-full">{{ $lang==='en'?'No upcoming events.':'لا توجد فعاليات قادمة.' }}</p>
            @endforelse
        </div>
        <div class="section-cta">
            <a href="/events" class="btn btn-outline">{{ $lang==='en'?'All Events':'كل الفعاليات' }}</a>
        </div>
    </div>
</section>
@endsection
