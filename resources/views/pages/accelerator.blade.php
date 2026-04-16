@extends('layouts.app')
@section('title', $page->{'title_'.$lang})

@section('content')
@php $cf = $page->custom_fields ?? []; @endphp

<section class="page-hero" @if($page->image_url) style="background-image:url('{{ $page->image_url }}');background-size:cover;" @else style="background-color:#9FD4D5;color:#524037;" @endif>
    <div class="container">
        <h1 class="page-hero-title">{{ $page->{'title_'.$lang} }}</h1>
        <p class="page-hero-subtitle">{{ $page->{'subtitle_'.$lang} }}</p>
        @if(!empty($cf['apply_link']))
        <a href="{{ $cf['apply_link'] }}" target="_blank" class="btn btn-brown mt-6">
            {{ $lang==='en'?'Apply Now':'قدّم الآن' }}
        </a>
        @endif
    </div>
</section>

<section class="section">
    <div class="container prose-content">
        {!! $page->{'content_'.$lang} !!}
    </div>
</section>

@if (!empty($cf['features']))
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ $lang==='en'?'Program Features':'مميزات البرنامج' }}</h2>
        </div>
        <div class="chips-center">
            @foreach ($cf['features'] as $feature)
                <div class="feature-chip">✓ {{ $feature[$lang] ?? $feature['en'] }}</div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if (!empty($cf['timelineSteps']))
<section class="section">
    <div class="container">
        <h2 class="section-title text-center mb-10">
            {{ $cf['timelineTitle'][$lang] ?? ($lang==='en'?'Program Timeline':'الجدول الزمني') }}
        </h2>
        <div class="timeline">
            @foreach ($cf['timelineSteps'] as $i => $step)
                <div class="timeline-step">
                    <div class="timeline-dot">{{ $i+1 }}</div>
                    <div class="timeline-label">{{ $step[$lang] ?? $step['en'] }}</div>
                </div>
                @if (!$loop->last)<div class="timeline-connector"></div>@endif
            @endforeach
        </div>
    </div>
</section>
@endif

<section class="section section-alt">
    <div class="container">
        <div class="section-header"><h2 class="section-title">{{ $lang==='en'?'Cohorts':'الدفعات' }}</h2></div>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>{{ $lang==='en'?'Cohort':'الدفعة' }}</th>
                        <th>{{ $lang==='en'?'Status':'الحالة' }}</th>
                        <th>{{ $lang==='en'?'Start Date':'تاريخ البدء' }}</th>
                        <th>{{ $lang==='en'?'End Date':'تاريخ الانتهاء' }}</th>
                        <th>{{ $lang==='en'?'Startups':'الشركات' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cohorts as $cohort)
                    <tr>
                        <td>{{ $cohort->{'name_'.$lang} }}</td>
                        <td><span class="status-badge status-{{ strtolower($cohort->status) }}">{{ $cohort->status }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($cohort->start_date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($cohort->end_date)->format('d M Y') }}</td>
                        <td>{{ $cohort->startups_count }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="empty-state">{{ $lang==='en'?'No cohorts yet.':'لا توجد دفعات بعد.' }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
