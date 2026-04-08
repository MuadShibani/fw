@extends('layouts.app')
@section('title', $item->{'title_'.$lang})
@section('description', $item->{'summary_'.$lang})

@section('content')

<section class="section">
    <div class="container">
        <div class="blog-post-layout">

            {{-- Article — same structure as blog-post --}}
            <article class="blog-post">
                <div class="blog-post-header">
                    <div class="blog-post-meta">
                        <span>📅 {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</span>
                        <span class="news-badge" style="font-size:.75rem;padding:.2rem .75rem;border-radius:99px">{{ $item->category }}</span>
                    </div>
                    <h1 class="blog-post-title">{{ $item->{'title_'.$lang} }}</h1>
                </div>

                <img src="{{ $item->{'image_'.$lang} ?? 'https://picsum.photos/800/400?random='.$item->id }}"
                     alt="{{ $item->{'title_'.$lang} }}" class="blog-post-hero-img" loading="lazy">

                <div class="prose-content blog-post-content">
                    <p>{{ $item->{'summary_'.$lang} }}</p>
                </div>

                <div class="blog-post-nav">
                    <a href="/media" class="btn btn-outline">
                        {{ $isRTL ? '→' : '←' }} {{ $lang === 'en' ? 'Back to News' : 'العودة للأخبار' }}
                    </a>
                </div>
            </article>

            {{-- Sidebar — same as blog-post --}}
            <aside class="blog-sidebar">
                <h3 class="sidebar-title">{{ $lang === 'en' ? 'Related News' : 'أخبار ذات صلة' }}</h3>
                @foreach ($relatedNews as $related)
                    <a href="/media/{{ $related->id }}" class="sidebar-post-link {{ $related->id === $item->id ? 'active' : '' }}">
                        <p class="sidebar-post-title">{{ $related->{'title_'.$lang} }}</p>
                        <p class="sidebar-post-date">
                            {{ \Carbon\Carbon::parse($related->date)->format('d M Y') }}
                            &nbsp;
                            <span style="background:#B04C2C;color:#fff;padding:.1rem .5rem;border-radius:99px;font-size:.7rem">{{ $related->category }}</span>
                        </p>
                    </a>
                @endforeach
            </aside>

        </div>
    </div>
</section>

@endsection
