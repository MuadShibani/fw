@extends('layouts.app')
@section('title', $homePage?->{'title_'.$lang} ?? ($lang==='ar' ? 'الرئيسية' : 'Home'))

@section('content')
@php $hp = $homePage; $cf = $hp?->custom_fields ?? []; @endphp

@push('scripts')
<script>
(function () {
    // ── Scroll-triggered reveal using animate.css ────────────────────────────
    var revealEls = document.querySelectorAll('[data-reveal]');
    if ('IntersectionObserver' in window && revealEls.length) {
        var revealIO = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                var el = entry.target;
                var anim = el.getAttribute('data-reveal') || 'fadeInUp';
                var delay = el.getAttribute('data-reveal-delay');
                if (delay) el.style.animationDelay = delay;
                // animate.css's animation-fill-mode:both holds the start (opacity 0)
                // during the delay and the end (opacity 1) after the run, so we
                // don't need a separate visibility class.
                el.classList.add('animate__animated', 'animate__' + anim);
                revealIO.unobserve(el);
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -10% 0px' });
        revealEls.forEach(function (el) { revealIO.observe(el); });
    } else {
        // No IntersectionObserver — just make everything visible.
        revealEls.forEach(function (el) { el.style.opacity = '1'; });
    }

    // ── Counter animation on stat values ─────────────────────────────────────
    function animateCounter(el) {
        var text = el.getAttribute('data-counter-original') || el.textContent.trim();
        // Match: optional non-digit prefix, the number (with commas/decimals), trailing suffix
        var m = text.match(/^(\D*?)([\d,]+(?:\.\d+)?)(.*)$/);
        if (!m) return;
        var prefix = m[1];
        var numStr = m[2];
        var suffix = m[3];
        var target = parseFloat(numStr.replace(/,/g, ''));
        if (isNaN(target)) return;
        el.setAttribute('data-counter-original', text);
        var hasDecimal = numStr.indexOf('.') !== -1;
        var decimals = hasDecimal ? (numStr.split('.')[1] || '').length : 0;

        function format(v) {
            var rounded = decimals ? Number(v.toFixed(decimals)) : Math.floor(v);
            return prefix + rounded.toLocaleString(undefined, {
                minimumFractionDigits: decimals,
                maximumFractionDigits: decimals
            }) + suffix;
        }

        var duration = 1600;
        var startTime = null;
        function tick(now) {
            if (!startTime) startTime = now;
            var t = Math.min(1, (now - startTime) / duration);
            // easeOutCubic
            var eased = 1 - Math.pow(1 - t, 3);
            el.textContent = format(target * eased);
            if (t < 1) requestAnimationFrame(tick);
            else el.textContent = format(target);
        }
        // Start at 0 so the count-up is visible
        el.textContent = format(0);
        requestAnimationFrame(tick);
    }

    var counters = document.querySelectorAll('[data-counter]');
    if ('IntersectionObserver' in window && counters.length) {
        var counterIO = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                animateCounter(entry.target);
                counterIO.unobserve(entry.target);
            });
        }, { threshold: 0.4 });
        counters.forEach(function (el) { counterIO.observe(el); });
    }
})();
</script>
@endpush

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
            'text_color'   => null,
        ]];
    }
@endphp

<section class="hero-slider" id="heroSlider" aria-roledescription="carousel">
    <div class="hero-slides">
        @foreach ($slides as $i => $slide)
            @php
                $textColor = !empty($slide->text_color) ? $slide->text_color : null;
                $textStyle = $textColor ? "color:{$textColor};" : '';
                $imgStyle  = !empty($slide->image_url) ? "background-image:url('".e($slide->image_url)."');" : '';
            @endphp
            <div class="hero-slide {{ $i === 0 ? 'is-active' : '' }}"
                 aria-hidden="{{ $i === 0 ? 'false' : 'true' }}">
                <div class="container">
                    <div class="hero-split">
                        <div class="hero-text">
                            <h1 class="hero-title" @if($textStyle) style="{{ $textStyle }}" @endif>{{ $slide->{'title_'.$lang} }}</h1>
                            <p class="hero-subtitle" @if($textStyle) style="{{ $textStyle }}" @endif>{{ $slide->{'subtitle_'.$lang} }}</p>
                            <div class="hero-actions">
                                @if(!empty($slide->cta_link))
                                    <a href="{{ $slide->cta_link }}" class="btn btn-primary">{{ $slide->{'cta_label_'.$lang} ?: ($lang==='en'?'Learn More':'اعرف المزيد') }}</a>
                                @endif
                            </div>
                        </div>
                        <div class="hero-visual-wrap">
                            <div class="hero-visual-frame">
                                <div class="hero-visual" @if($imgStyle) style="{{ $imgStyle }}" @endif></div>
                                <div class="hero-chip hero-chip-1">
                                    <div class="hero-chip-icon">🌱</div>
                                    <div>
                                        <strong>{{ $lang==='en' ? 'Backed by Wathba' : 'مدعومة من وثبة' }}</strong>
                                        <span>{{ $lang==='en' ? '6-month accelerator program' : 'برنامج تسريع 6 أشهر' }}</span>
                                    </div>
                                </div>
                                <div class="hero-chip hero-chip-2">
                                    <div class="hero-chip-icon">💼</div>
                                    <div>
                                        <strong>{{ $lang==='en' ? 'Diaspora investors' : 'مستثمرو الشتات' }}</strong>
                                        <span>{{ $lang==='en' ? 'Connecting capital to founders' : 'ربط رأس المال بالمؤسسين' }}</span>
                                    </div>
                                </div>
                            </div>
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
        // Re-trigger entrance fade by removing and re-adding the .is-active
        // class. Hero elements are styled to animate when .is-active is on,
        // so toggling it replays the keyframes from the start.
        var newSlide = slides[to];
        newSlide.querySelectorAll('.hero-title, .hero-subtitle, .hero-actions, .hero-visual-wrap, .hero-chip').forEach(function (el) {
            // Force reflow so the animation restarts cleanly.
            el.style.animation = 'none';
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

{{-- Stats — floating strip that overlaps the hero and the next section --}}
<div class="stats-strip-wrap" data-reveal="fadeInUp">
    <div class="container">
        <div class="stats-strip">
            @foreach ($stats as $i => $stat)
                <div class="stat-card" data-reveal="fadeInUp" data-reveal-delay="{{ $i * 0.1 }}s">
                    <div class="stat-value" data-counter>{{ $stat->value }}</div>
                    <div class="stat-label">{{ $stat->{'label_'.$lang} }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Wathba Components — 2x2 grid --}}
@php
    $componentOrder = ['sil' => 1, 'accelerator' => 2, 'yain' => 3, 'wiif' => 4];
    $componentLogos = [
        'sil' => 'images/logo-sil.png',
        'accelerator' => 'images/logo-wathba-accelerator.jpg',
        'yain' => 'images/wathba.png',
        'wiif' => 'images/wathba.png',
    ];
    $orderedPrograms = $programs->sortBy(fn ($program) => $componentOrder[$program->id] ?? 99)->values();
@endphp
<section class="home-section">
    <div class="container">
        <div class="section-header" data-reveal="fadeIn">
            <h2 class="section-title">{{ $lang==='en'?'Wathba Components':'مكونات وثبة' }}</h2>
            <p class="section-subtitle">{{ $lang==='en'?'Four integrated components working together to empower Yemen entrepreneurs.':'أربعة مكونات متكاملة تعمل معاً لتمكين رواد الأعمال في اليمن.' }}</p>
        </div>
        <div class="programs-grid programs-grid-2x2">
            @foreach ($orderedPrograms as $i => $program)
                <a href="{{ $program->path }}" class="program-card program-card-{{ $program->id }}" data-reveal="fadeInUp" data-reveal-delay="{{ $i * 0.12 }}s" style="--program-color:{{ $program->color }}">
                    <div class="program-card-accent"></div>
                    @if (isset($componentLogos[$program->id]))
                        <div class="program-logo-wrap">
                            <img src="{{ asset($componentLogos[$program->id]) }}" alt="{{ $program->{'title_'.$lang} }}" class="program-logo program-logo-{{ $program->id }}" loading="lazy">
                        </div>
                    @endif
                    <h3 class="program-title">{{ $program->{'title_'.$lang} }}</h3>
                    <span class="program-link">{{ $lang==='en'?'Learn More':'اعرف المزيد' }} <span>{{ $isRTL?'←':'→' }}</span></span>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Latest News --}}
<section class="home-section home-section-cream">
    <div class="container">
        <div class="section-header" data-reveal="fadeIn">
            <h2 class="section-title">{{ $lang==='en'?'Latest News':'آخر الأخبار' }}</h2>
            <p class="section-subtitle">{{ $lang==='en'?'Updates from across the Wathba ecosystem.':'آخر المستجدات من جميع أنحاء منظومة وثبة.' }}</p>
        </div>
        <div class="news-grid">
            @foreach ($latestNews as $i => $item)
                <a href="/media/{{ $item->id }}" class="news-card" data-reveal="fadeIn" data-reveal-delay="{{ $i * 0.12 }}s" style="display:block;">
                    <div class="news-img-wrap" style="height:220px;aspect-ratio:auto;line-height:0;overflow:hidden;">
                        <img src="{{ $item->{'image_'.$lang} ?? 'https://picsum.photos/400/250?random='.$item->id }}"
                             alt="{{ $item->{'title_'.$lang} }}" class="news-img" loading="lazy" style="width:100%;height:100%;object-fit:cover;display:block;">
                        <span class="news-badge">{{ $item->category }}</span>
                    </div>
                    <div class="news-body" style="display:block;margin:0;min-height:0;padding:1.5rem 1.75rem 1.75rem;">
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
<section class="home-section">
    <div class="container">
        <div class="section-header" data-reveal="fadeIn">
            <h2 class="section-title">{{ $lang==='en'?'Latest from our Blog':'آخر مقالات المدونة' }}</h2>
            <p class="section-subtitle">{{ $lang==='en'?'Insights, stories and updates from the Wathba ecosystem.':'رؤى وقصص وتحديثات من منظومة وثبة.' }}</p>
        </div>
        <div class="news-grid">
            @forelse ($latestBlog as $i => $post)
                <a href="/blog/{{ $post->id }}" class="news-card" data-reveal="fadeIn" data-reveal-delay="{{ $i * 0.12 }}s" style="display:block;">
                    <div class="news-img-wrap" style="height:220px;aspect-ratio:auto;line-height:0;overflow:hidden;">
                        <img src="{{ $post->{'image_'.$lang} ?? 'https://picsum.photos/400/250?random='.($post->id + 1000) }}"
                             alt="{{ $post->{'title_'.$lang} }}" class="news-img" loading="lazy" style="width:100%;height:100%;object-fit:cover;display:block;">
                        <span class="news-badge" style="background:#A2C59A;color:#524037">✍️ {{ $post->{'author_'.$lang} }}</span>
                    </div>
                    <div class="news-body" style="display:block;margin:0;min-height:0;padding:1.5rem 1.75rem 1.75rem;">
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
<section class="home-section home-section-cream">
    <div class="container">
        <div class="section-header" data-reveal="fadeIn">
            <h2 class="section-title">{{ $lang==='en'?'Upcoming Events':'الفعاليات القادمة' }}</h2>
            <p class="section-subtitle">{{ $lang==='en'?'Workshops, webinars, and networking opportunities.':'ورش عمل وندوات وفرص للتواصل.' }}</p>
        </div>
        <div class="news-grid">
            @forelse ($upcomingEvents as $i => $event)
                <a href="{{ $event->registration_link ?: '/events' }}"
                   {{ $event->registration_link ? 'target="_blank"' : '' }}
                   class="news-card event-news-card"
                   data-reveal="fadeIn" data-reveal-delay="{{ $i * 0.12 }}s">
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

