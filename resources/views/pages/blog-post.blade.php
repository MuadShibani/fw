@extends('layouts.app')
@section('title', $post->{'title_' . $lang})

@section('content')

<section class="section">
    <div class="container">
        <div class="blog-post-layout">
            {{-- Article --}}
            <article class="blog-post">
                <div class="blog-post-header">
                    <div class="blog-post-meta">
                        <span>📅 {{ \Carbon\Carbon::parse($post->date)->format('d M Y') }}</span>
                        <span>✍️ {{ $post->{'author_' . $lang} }}</span>
                    </div>
                    <h1 class="blog-post-title">{{ $post->{'title_' . $lang} }}</h1>
                </div>
                <img src="{{ $post->{'image_' . $lang} ?? 'https://picsum.photos/800/400?random=' . $post->id }}"
                     alt="{{ $post->{'title_' . $lang} }}" class="blog-post-hero-img" loading="lazy">
                <div class="prose-content blog-post-content">
                    {!! $post->{'content_' . $lang} !!}
                </div>
                <div class="blog-post-nav">
                    <a href="/blog" class="btn btn-outline">
                        {{ $isRTL ? '→' : '←' }} {{ $lang === 'en' ? 'Back to Blog' : 'العودة للمدونة' }}
                    </a>
                </div>
            </article>

            {{-- Sidebar --}}
            <aside class="blog-sidebar">
                <h3 class="sidebar-title">{{ $lang === 'en' ? 'Recent Posts' : 'أحدث المقالات' }}</h3>
                @foreach ($recentPosts as $recent)
                    <a href="/blog/{{ $recent->id }}" class="sidebar-post-link {{ $recent->id === $post->id ? 'active' : '' }}">
                        <p class="sidebar-post-title">{{ $recent->{'title_' . $lang} }}</p>
                        <p class="sidebar-post-date">{{ \Carbon\Carbon::parse($recent->date)->format('d M Y') }}</p>
                    </a>
                @endforeach
            </aside>
        </div>
    </div>
</section>
@endsection
