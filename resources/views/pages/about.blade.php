@extends('layouts.app')
@section('title', $page->{'title_'.$lang})

@section('content')
@php $cf = $page->custom_fields ?? []; @endphp

<section class="page-hero" @if($page->image_url) style="background-image:url('{{ $page->image_url }}');background-size:cover;" @else style="background-color:#524037;" @endif>
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
            @foreach(['mission','vision','values'] as $block)
            @if(!empty($cf[$block.'_title']))
            <div class="icon-card">
                <div class="icon-card-icon" style="background:{{ $loop->index===0?'#9FD4D5':($loop->index===1?'#A2C59A':'#ECCE9E') }}">
                    {{ $loop->index===0?'🎯':($loop->index===1?'👁':'🌍') }}
                </div>
                <h3>{{ $cf[$block.'_title'][$lang] ?? $cf[$block.'_title']['en'] ?? '' }}</h3>
                <p>{{ $cf[$block.'_body'][$lang] ?? $cf[$block.'_body']['en'] ?? '' }}</p>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>

{{--<section class="section">--}}
{{--    <div class="container">--}}
{{--        <div class="eu-partnership-banner">--}}
{{--            <div class="eu-flag-large">★ ★ ★ ★ ★</div>--}}
{{--            <div>--}}
{{--                <h3>{{ $lang==='en'?'Funded by the European Union':'بتمويل من الاتحاد الأوروبي' }}</h3>--}}
{{--                <p>{{ $lang==='en'?'Wathba is funded by the European Union as part of efforts to promote economic resilience and recovery in Yemen.':'وثبة ممولة من الاتحاد الأوروبي في إطار جهود تعزيز المرونة الاقتصادية والتعافي في اليمن.' }}</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
@endsection
