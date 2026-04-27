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
        <div class="sdg-goals-grid chips-center">
            @php
            $sdgInfo = [
                1  => ['en' => 'No Poverty — End poverty in all its forms everywhere.', 'ar' => 'القضاء على الفقر — إنهاء الفقر بجميع أشكاله في كل مكان.'],
                3  => ['en' => 'Good Health & Well-being — Ensure healthy lives and well-being for all.', 'ar' => 'الصحة الجيدة والرفاهية — ضمان حياة صحية وتعزيز الرفاهية للجميع.'],
                4  => ['en' => 'Quality Education — Ensure inclusive and equitable quality education.', 'ar' => 'التعليم الجيد — ضمان التعليم الجيد المنصف والشامل للجميع.'],
                5  => ['en' => 'Gender Equality — Achieve gender equality and empower all women and girls.', 'ar' => 'المساواة بين الجنسين — تحقيق المساواة بين الجنسين وتمكين جميع النساء والفتيات.'],
                8  => ['en' => 'Decent Work & Economic Growth — Promote sustained, inclusive and sustainable economic growth.', 'ar' => 'العمل اللائق ونمو الاقتصاد — تعزيز النمو الاقتصادي المطرد والشامل والمستدام.'],
                9  => ['en' => 'Industry, Innovation & Infrastructure — Build resilient infrastructure, promote sustainable industrialization.', 'ar' => 'الصناعة والابتكار والبنية التحتية — بناء بنية تحتية قادرة على الصمود وتعزيز التصنيع.'],
                10 => ['en' => 'Reduced Inequalities — Reduce inequality within and among countries.', 'ar' => 'الحد من أوجه عدم المساواة — الحد من أوجه عدم المساواة داخل البلدان وفيما بينها.'],
                17 => ['en' => 'Partnerships for the Goals — Strengthen implementation means and revitalize global partnerships.', 'ar' => 'عقد الشراكات لتحقيق الأهداف — تعزيز وسائل التنفيذ وتنشيط الشراكة العالمية.'],
            ];
            @endphp
            @foreach ([1,3,4,5,8,9,10,17] as $goal)
                <div class="sdg-goal sdg-interactive" data-tooltip="{{ $sdgInfo[$goal][$lang] }}">
                    SDG {{ $goal }}
                    <span class="sdg-tooltip">{{ $sdgInfo[$goal][$lang] }}</span>
                </div>
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

@include('partials.related-news')
@endsection
