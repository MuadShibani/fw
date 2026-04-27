{{-- Reusable: include with @include('partials.related-news', ['relatedNews' => $relatedNews]) --}}
@if (isset($relatedNews) && $relatedNews->count() > 0)
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ $lang==='en' ? 'Related News' : 'أخبار ذات صلة' }}</h2>
            <p class="section-subtitle">{{ $lang==='en' ? 'Latest updates related to this component.' : 'آخر المستجدات المتعلقة بهذا المكون.' }}</p>
        </div>
        <div class="news-grid">
            @foreach ($relatedNews as $item)
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
            <a href="/media" class="btn btn-outline">{{ $lang==='en' ? 'All News' : 'كل الأخبار' }}</a>
        </div>
    </div>
</section>
@endif
