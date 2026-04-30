@extends('layouts.app')
@section('title', $lang === 'ar' ? 'المدونة' : 'Blog')

@section('content')

@include('partials.page-hero', ['fallbackBg' => '#524037'])

<section class="section">
    <div class="container">
        <div class="blog-grid">
            @forelse ($posts as $post)
                <article class="blog-card" style="cursor:pointer" onclick="window.location='/blog/{{ $post->id }}'">
                    <div class="blog-img-wrap">
                        <img src="{{ $post->{'image_' . $lang} ?? 'https://picsum.photos/400/250?random=' . $post->id }}"
                             alt="{{ $post->{'title_' . $lang} }}" class="blog-img" loading="lazy">
                    </div>
                    <div class="blog-body">
                        <div class="blog-meta">
                            <span>📅 {{ \Carbon\Carbon::parse($post->date)->format('d M Y') }}</span>
                            <span>✍️ {{ $post->{'author_' . $lang} }}</span>
                        </div>
                        <h2 class="blog-title">{{ $post->{'title_' . $lang} }}</h2>
                        <p class="blog-summary">{{ $post->{'summary_' . $lang} }}</p>
                        <a href="/blog/{{ $post->id }}" class="btn btn-outline btn-sm">
                            {{ $lang === 'en' ? 'Read More' : 'اقرأ المزيد' }} {{ $isRTL ? '←' : '→' }}
                        </a>
                    </div>
                </article>
            @empty
                <p class="empty-state">{{ $lang === 'en' ? 'No blog posts yet.' : 'لا توجد مقالات بعد.' }}</p>
            @endforelse
        </div>
        {{ $posts->links('layouts.pagination') }}
    </div>
</section>
@endsection
