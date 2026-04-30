{{--
    Reusable page hero. Pass either:
      $page (Page model, will use its title/subtitle/image) — preferred
      OR fallback text via $fallbackTitle, $fallbackSubtitle, $fallbackBg
--}}
@php
    $heroTitle    = $page?->{'title_'.$lang}    ?? ($fallbackTitle    ?? '');
    $heroSubtitle = $page?->{'subtitle_'.$lang} ?? ($fallbackSubtitle ?? '');
    $heroImage    = $page?->image_url           ?? null;
    $fallbackBg   = $fallbackBg ?? '#524037';
@endphp

<section class="page-hero"
    @if($heroImage)
        style="background-image:url('{{ $heroImage }}');background-size:cover;background-position:center;"
    @else
        style="background-color: {{ $fallbackBg }};"
    @endif>
    <div class="container">
        <h1 class="page-hero-title">{{ $heroTitle }}</h1>
        @if($heroSubtitle)
            <p class="page-hero-subtitle">{{ $heroSubtitle }}</p>
        @endif
    </div>
</section>
