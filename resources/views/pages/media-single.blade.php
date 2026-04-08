@extends('layouts.app')
@section('title', $item->{'title_'.$lang})
@section('description', $item->{'summary_'.$lang})

@section('content')

{{-- Hero --}}
<div class="news-single-hero" style="background-image: url('{{ $item->{'image_'.$lang} ?? 'https://picsum.photos/1200/500?random='.$item->id }}')">
    <div class="news-single-hero-overlay">
        <div class="container">
            <span class="news-badge" style="font-size:.9rem;padding:.4rem 1.25rem">{{ $item->category }}</span>
            <h1 class="news-single-title">{{ $item->{'title_'.$lang} }}</h1>
            <p class="news-single-date">📅 {{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}</p>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="news-single-layout">

            {{-- Article --}}
            <article class="news-single-article">
                <p class="news-single-summary">{{ $item->{'summary_'.$lang} }}</p>
                <div class="news-single-back">
                    <a href="/media" class="btn btn-outline btn-sm">
                        {{ $isRTL ? '→' : '←' }} {{ $lang === 'en' ? 'Back to News' : 'العودة للأخبار' }}
                    </a>
                </div>
            </article>

            {{-- Sidebar: related news --}}
            <aside class="news-single-sidebar">
                <h3 class="sidebar-title">{{ $lang === 'en' ? 'Related News' : 'أخبار ذات صلة' }}</h3>
                @foreach ($relatedNews as $related)
                    <a href="/media/{{ $related->id }}" class="sidebar-post-link">
                        <p class="sidebar-post-title">{{ $related->{'title_'.$lang} }}</p>
                        <p class="sidebar-post-date">
                            <span class="news-badge" style="font-size:.7rem;padding:.15rem .5rem">{{ $related->category }}</span>
                            &nbsp; {{ \Carbon\Carbon::parse($related->date)->format('d M Y') }}
                        </p>
                    </a>
                @endforeach
            </aside>

        </div>
    </div>
</section>

@endsection
