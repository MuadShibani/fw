@extends('layouts.app')
@section('title', $homePage?->{'title_'.$lang} ?? ($lang==='ar' ? 'الرئيسية' : 'Home'))

@section('content')
@php $hp = $homePage; $cf = $hp?->custom_fields ?? []; @endphp

{{-- Hero Slider --}}
@php
    // Build the slide list. If no editable slides exist yet, fall back to the
    // single page-derived hero so the home page never renders empty.
    $slides = ($heroSlides ?? collect())->all();
    if (empty($slides) && $hp) {
        $slides = [(object) [
            'title_en'     => $hp->title_en,
            'title_ar'     => $hp->title_ar,
            'subtitle_en'  => $hp->subtitle_en,
            'subtitle_ar'  => $hp->subtitle_ar,
            'image_url'    => $hp->image_url,
            'cta_label_en' => $cf['cta_primary']['en'] ?? 'Learn More',
            'cta_label_ar' => $cf['cta_primary']['ar'] ?? 'اعرف المزيد',
            'cta_link'     => '/about',
        ]];
    }
@endphp

<section class="hero-slider" id="heroSlider" aria-roledescription="carousel">
    <div class="hero-slides">
        @foreach ($slides as $i => $slide)
            <div class="hero-slide {{ $i === 0 ? 'is-active' : '' }}"
                 @if(!empty($slide->image_url)) style="background-image:url('{{ $slide->image_url }}');" @endif
                 aria-hidden="{{ $i === 0 ? 'false' : 'true' }}">
                <div class="hero-bg-pattern"></div>
                <div class="container">
                    <div class="hero-content">
                        <h1 class="hero-title animate__animated animate__fadeInUp">{{ $slide->{'title_'.$lang} }}</h1>
                        <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">{{ $slide->{'subtitle_'.$lang} }}</p>
                        <div class="hero-actions animate__animated animate__fadeInUp animate__delay-2s">
                            @if(!empty($slide->cta_link))
                                <a href="{{ $slide->cta_link }}" class="btn btn-primary">{{ $slide->{'cta_label_'.$lang} ?: ($lang==='en'?'Learn More':'اعرف المزيد') }}</a>
                            @endif
                            <a href="/contact" class="btn btn-outline">{{ $lang==='en'?'Contact Us':'تواصل معنا' }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if (count($slides) > 1)
        <button type="button" class="hero-arrow hero-arrow-prev" aria-label="Previous slide">{{ $isRTL ? '›' : '‹' }}</button>
        <button type="button" class="hero-arrow hero-arrow-next" aria-label="Next slide">{{ $isRTL ? '‹' : '›' }}</button>
        <div class="hero-dots">
            @foreach ($slides as $i => $slide)
                <button type="button" class="hero-dot {{ $i === 0 ? 'is-active' : '' }}" data-slide="{{ $i }}" aria-label="Go to slide {{ $i + 1 }}"></button>
            @endforeach
        </div>
    @endif
</section>

@push('styles')
<style>
.hero-slider { position: relative; overflow: hidden; }
.hero-slides { position: relative; }
.hero-slide {
    position: absolute; top: 0; left: 0; right: 0;
    background-size: cover; background-position: center;
    opacity: 0; visibility: hidden;
    transition: opacity .8s ease;
}
.hero-slide.is-active { position: relative; opacity: 1; visibility: visible; }
.hero-slider .hero-bg-pattern { position: absolute; inset: 0; pointer-events: none; }
.hero-arrow {
    position: absolute; top: 50%; transform: translateY(-50%);
    width: 44px; height: 44px; border-radius: 50%;
    background: rgba(255,255,255,.85); border: 0; cursor: pointer;
    color: #524037; font-size: 1.6rem; line-height: 1;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 2px 8px rgba(0,0,0,.15);
    transition: background .2s ease, transform .2s ease;
    z-index: 2;
}
.hero-arrow:hover { background: #fff; transform: translateY(-50%) scale(1.05); }
.hero-arrow-prev { left: 1rem; }
.hero-arrow-next { right: 1rem; }
.hero-dots {
    position: absolute; bottom: 1.25rem; left: 50%; transform: translateX(-50%);
    display: flex; gap: .5rem; z-index: 2;
}
.hero-dot {
    width: 10px; height: 10px; border-radius: 50%;
    background: rgba(255,255,255,.5); border: 0; padding: 0; cursor: pointer;
    transition: background .2s ease, transform .2s ease;
}
.hero-dot.is-active { background: #fff; transform: scale(1.25); }
.hero-dot:hover { background: rgba(255,255,255,.85); }
</style>
@endpush

@push('scripts')
<script>
(function () {
    var root = document.getElementById('heroSlider');
    if (!root) return;
    var slides = Array.prototype.slice.call(root.querySelectorAll('.hero-slide'));
    if (slides.length < 2) return;

    var dots = Array.prototype.slice.call(root.querySelectorAll('.hero-dot'));
    var prev = root.querySelector('.hero-arrow-prev');
    var next = root.querySelector('.hero-arrow-next');
    var current = 0;
    var timer = null;

    function go(to) {
        to = (to + slides.length) % slides.length;
        if (to === current) return;
        slides[current].classList.remove('is-active');
        slides[current].setAttribute('aria-hidden', 'true');
        dots[current] && dots[current].classList.remove('is-active');
        slides[to].classList.add('is-active');
        slides[to].setAttribute('aria-hidden', 'false');
        dots[to] && dots[to].classList.add('is-active');
        // Re-trigger entrance animations
        slides[to].querySelectorAll('.animate__animated').forEach(function (el) {
            el.style.animation = 'none';
            // force reflow
            void el.offsetWidth;
            el.style.animation = '';
        });
        current = to;
    }

    function start() {
        stop();
        timer = setInterval(function () { go(current + 1); }, 6000);
    }
    function stop() { if (timer) { clearInterval(timer); timer = null; } }

    if (prev) prev.addEventListener('click', function () { go(current - 1); start(); });
    if (next) next.addEventListener('click', function () { go(current + 1); start(); });
    dots.forEach(function (dot, i) {
        dot.addEventListener('click', function () { go(i); start(); });
    });

    root.addEventListener('mouseenter', stop);
    root.addEventListener('mouseleave', start);

    start();
})();
</script>
@endpush

{{-- Stats --}}
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            @foreach ($stats as $i => $stat)
                <div class="stat-card animate__animated animate__fadeInUp" style="animation-delay: {{ $i * 0.12 }}s">
                    <div class="stat-value">{{ $stat->value }}</div>
                    <div class="stat-label">{{ $stat->{'label_'.$lang} }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Wathba Components — 2x2 grid --}}
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ $lang==='en'?'Wathba Components':'مكونات وثبة' }}</h2>
            <p class="section-subtitle">{{ $lang==='en'?'Four integrated components working together to empower Yemen entrepreneurs.':'أربعة مكونات متكاملة تعمل معاً لتمكين رواد الأعمال في اليمن.' }}</p>
        </div>
        <div class="programs-grid programs-grid-2x2">
            @foreach ($programs as $i => $program)
                <a href="{{ $program->path }}" class="program-card animate__animated animate__fadeIn" style="--program-color:{{ $program->color }}; animation-delay: {{ $i * 0.15 }}s">
                    <div class="program-card-accent"></div>
                    <h3 class="program-title">{{ $program->{'title_'.$lang} }}</h3>
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

{{-- Latest Blog Posts --}}
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ $lang==='en'?'Latest from our Blog':'آخر مقالات المدونة' }}</h2>
            <p class="section-subtitle">{{ $lang==='en'?'Insights, stories and updates from the Wathba ecosystem.':'رؤى وقصص وتحديثات من منظومة وثبة.' }}</p>
        </div>
        <div class="news-grid">
            @forelse ($latestBlog as $post)
                <a href="/blog/{{ $post->id }}" class="news-card">
                    <div class="news-img-wrap">
                        <img src="{{ $post->{'image_'.$lang} ?? 'https://picsum.photos/400/250?random='.($post->id + 1000) }}"
                             alt="{{ $post->{'title_'.$lang} }}" class="news-img" loading="lazy">
                        <span class="news-badge" style="background:#A2C59A;color:#524037">✍️ {{ $post->{'author_'.$lang} }}</span>
                    </div>
                    <div class="news-body">
                        <p class="news-date">📅 {{ \Carbon\Carbon::parse($post->date)->format('d M Y') }}</p>
                        <h3 class="news-title">{{ $post->{'title_'.$lang} }}</h3>
                        <p class="news-summary">{{ $post->{'summary_'.$lang} }}</p>
                    </div>
                </a>
            @empty
                <p class="empty-state col-span-full">{{ $lang==='en'?'No blog posts yet.':'لا توجد مقالات بعد.' }}</p>
            @endforelse
        </div>
        <div class="section-cta">
            <a href="/blog" class="btn btn-outline">{{ $lang==='en'?'All Blog Posts':'كل المقالات' }}</a>
        </div>
    </div>
</section>

{{-- Upcoming Events — 3 in a row, same as news --}}
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ $lang==='en'?'Upcoming Events':'الفعاليات القادمة' }}</h2>
        </div>
        <div class="news-grid">
            @forelse ($upcomingEvents as $event)
                <a href="{{ $event->registration_link ?: '/events' }}"
                   {{ $event->registration_link ? 'target="_blank"' : '' }}
                   class="news-card event-news-card">
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
