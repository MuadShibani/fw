@extends('layouts.app')
@section('title', $page->{'title_'.$lang})

@section('content')
@php $cf = $page->custom_fields ?? []; @endphp

<section class="page-hero" @if($page->image_url) style="background-image:url('{{ $page->image_url }}');background-size:cover;" @else style="background-color:#ECCE9E;color:#524037;" @endif>
    <div class="container">
        <h1 class="page-hero-title">{{ $page->{'title_'.$lang} }}</h1>
        <p class="page-hero-subtitle">{{ $page->{'subtitle_'.$lang} }}</p>
    </div>
</section>

<section class="section">
    <div class="container prose-content">
        {!! $page->{'content_'.$lang} !!}
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="cards-3">
            @foreach(['grants','community','impact'] as $i => $block)
            @if(!empty($cf[$block.'_title']))
            <div class="icon-card icon-card-clean">
                                <h3>{{ $cf[$block.'_title'][$lang] ?? $cf[$block.'_title']['en'] ?? ucfirst($block) }}</h3>
                <p>{{ $cf[$block.'_body'][$lang] ?? $cf[$block.'_body']['en'] ?? '' }}</p>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>

@include('partials.related-news')
@endsection
