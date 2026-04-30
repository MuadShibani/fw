@extends('layouts.app')
@section('title', $page->{'title_'.$lang})

@section('content')
@php $cf = $page->custom_fields ?? []; @endphp

<section class="page-hero" @if($page->image_url) style="background-image:url('{{ $page->image_url }}');background-size:cover;" @else style="background-color:#A2C59A;color:#524037;" @endif>
    <div class="container">
        <h1 class="page-hero-title">{{ $page->{'title_'.$lang} }}</h1>
        <p class="page-hero-subtitle">{{ $page->{'subtitle_'.$lang} }}</p>
    </div>
</section>

<section class="section">
    <div class="container prose-content">
        {!! \App\Support\Content::format($page->{'content_'.$lang}) !!}
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ $cf['championsTitle'][$lang] ?? ($lang==='en'?'Our Champions':'أبطالنا') }}</h2>
            <p class="section-subtitle">{{ $cf['championsSubtitle'][$lang] ?? '' }}</p>
        </div>
        <div class="investors-grid">
            @forelse ($investors as $investor)
                <div class="investor-card">
                    <img src="{{ $investor->image_url }}" alt="{{ $investor->{'name_'.$lang} }}" class="investor-img" loading="lazy">
                    <div class="investor-info">
                        <h3>{{ $investor->{'name_'.$lang} }}</h3>
                        <p class="investor-role">{{ $investor->{'role_'.$lang} }}</p>
                        <p class="investor-bio">{{ $investor->{'bio_'.$lang} }}</p>
                        <div class="investor-social">
                            @if ($investor->linkedin_url)<a href="{{ $investor->linkedin_url }}" target="_blank">LinkedIn</a>@endif
                            @if ($investor->twitter_url)<a href="{{ $investor->twitter_url }}" target="_blank">Twitter</a>@endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="empty-state">{{ $lang==='en'?'No investors listed.':'لا يوجد مستثمرون.' }}</p>
            @endforelse
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ $cf['portfolioTitle'][$lang] ?? ($lang==='en'?'Portfolio Companies':'شركات المحفظة') }}</h2>
            <p class="section-subtitle">{{ $cf['portfolioSubtitle'][$lang] ?? '' }}</p>
        </div>
        <div class="startups-grid">
            @forelse ($startups as $startup)
                <div class="startup-card">
                    <img src="{{ $startup->logo_url }}" alt="{{ $startup->name }}" class="startup-logo" loading="lazy">
                    <div class="startup-info">
                        <h3>{{ $startup->name }}</h3>
                        <span class="startup-sector">{{ $startup->sector }}</span>
                        <span class="startup-stage stage-{{ strtolower(str_replace([' ','-'],'-',$startup->stage)) }}">{{ $startup->stage }}</span>
                        <p>{{ $startup->{'description_'.$lang} }}</p>
                        @if ($startup->founder_name)<p class="startup-founder">👤 {{ $startup->founder_name }}</p>@endif
                    </div>
                </div>
            @empty
                <p class="empty-state">{{ $lang==='en'?'No startups listed.':'لا توجد شركات.' }}</p>
            @endforelse
        </div>
    </div>
</section>

@if (!empty($cf['ctaTitle']))
<section class="section section-alt">
    <div class="container text-center">
        <h2 class="section-title">{{ $cf['ctaTitle'][$lang] ?? '' }}</h2>
        <p class="section-subtitle">{{ $cf['ctaSubtitle'][$lang] ?? '' }}</p>
        <div class="mt-8 flex gap-4 justify-center flex-wrap">
            @if(!empty($cf['investor_join_link']))
            <a href="{{ $cf['investor_join_link'] }}" target="_blank" class="btn btn-primary">
                {{ $lang==='en'?'Join as Investor':'انضم كمستثمر' }}
            </a>
            @endif
            @if(!empty($cf['startup_pitch_link']))
            <a href="{{ $cf['startup_pitch_link'] }}" target="_blank" class="btn btn-outline">
                {{ $lang==='en'?'Pitch Your Startup':'قدّم شركتك' }}
            </a>
            @endif
        </div>
    </div>
</section>
@endif

@include('partials.related-news')
@endsection
