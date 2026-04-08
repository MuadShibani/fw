@extends('layouts.app')
@section('title', $page->{'title_'.$lang})

@section('content')
@php $cf = $page->custom_fields ?? []; @endphp

<section class="page-hero" @if($page->image_url) style="background-image:url('{{ $page->image_url }}');background-size:cover;" @else style="background-color:#B04C2C;" @endif>
    <div class="container">
        <h1 class="page-hero-title">{{ $page->{'title_'.$lang} }}</h1>
        <p class="page-hero-subtitle">{{ $page->{'subtitle_'.$lang} }}</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="content-split">
            <div>
                <div class="prose-content">{!! $page->{'content_'.$lang} !!}</div>
                @if (!empty($cf['listItems']))
                <ul class="check-list mt-6">
                    @foreach ($cf['listItems'] as $item)
                        <li>✓ {{ $item[$lang] ?? $item['en'] }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
            <div class="fund-stats-box">
                <div class="fund-stat"><div class="fund-stat-val">$50k–$200k</div><div class="fund-stat-label">{{ $lang==='en'?'Ticket Size':'حجم التذكرة' }}</div></div>
                <div class="fund-stat"><div class="fund-stat-val">Blended</div><div class="fund-stat-label">{{ $lang==='en'?'Finance Model':'نموذج التمويل' }}</div></div>
                <div class="fund-stat"><div class="fund-stat-val">SDG</div><div class="fund-stat-label">{{ $lang==='en'?'Aligned':'متوافق' }}</div></div>
            </div>
        </div>
    </div>
</section>

@if (!empty($cf['sdgTitle']))
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ $cf['sdgTitle'][$lang] ?? '' }}</h2>
            <p class="section-subtitle">{{ $cf['sdgDesc'][$lang] ?? '' }}</p>
        </div>
        <div class="sdg-goals-grid">
            @foreach ([1,3,4,5,8,9,10,17] as $goal)
                <div class="sdg-goal">SDG {{ $goal }}</div>
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="section">
    <div class="container">
        <div class="section-header"><h2 class="section-title">{{ $lang==='en'?'Portfolio Companies':'شركات المحفظة' }}</h2></div>
        <div class="startups-grid">
            @forelse ($portfolio as $company)
                <div class="startup-card">
                    <img src="{{ $company->logo_url }}" alt="{{ $company->name }}" class="startup-logo" loading="lazy">
                    <div class="startup-info">
                        <h3>{{ $company->name }}</h3>
                        <span class="startup-sector">{{ $company->{'sector_'.$lang} }}</span>
                        <p>{{ $company->{'description_'.$lang} }}</p>
                        <p class="text-sm text-gray-500">📅 {{ \Carbon\Carbon::parse($company->investment_date)->format('M Y') }}</p>
                    </div>
                </div>
            @empty
                <p class="empty-state">{{ $lang==='en'?'No portfolio companies yet.':'لا توجد شركات في المحفظة بعد.' }}</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
