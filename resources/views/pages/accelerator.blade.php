@extends('layouts.app')
@section('title', $page->{'title_'.$lang})

@section('content')
@php $cf = $page->custom_fields ?? []; @endphp

{{-- Hero --}}
<section class="page-hero" @if($page->image_url) style="background-image:url('{{ $page->image_url }}');background-size:cover;" @else style="background-color:#9FD4D5;color:#524037;" @endif>
    <div class="container">
        <h1 class="page-hero-title">{{ $page->{'title_'.$lang} }}</h1>
        <p class="page-hero-subtitle">{{ $page->{'subtitle_'.$lang} }}</p>
        @if(!empty($cf['apply_link']))
        <a href="{{ $cf['apply_link'] }}" target="_blank" class="btn btn-brown mt-6">
            {{ $lang==='en' ? 'Apply Now' : 'قدّم الآن' }}
        </a>
        @endif
    </div>
</section>

@if($page->{'content_'.$lang})
<section class="section">
    <div class="container prose-content">
        {!! $page->{'content_'.$lang} !!}
    </div>
</section>
@endif

{{-- ── PROGRAM FEATURES TABLE ─────────────────────────────────── --}}
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ $lang==='en' ? 'Program Features' : 'مميزات البرنامج' }}</h2>
        </div>
        <div class="features-table-wrap">
            <table class="features-table">
                <thead>
                    <tr>
                        <th>{{ $lang==='en' ? 'Feature' : 'الميزة' }}</th>
                        <th>{{ $lang==='en' ? 'Description' : 'الوصف' }}</th>
                    </tr>
                </thead>
                <tbody>
                @if($lang==='en')
                    <tr><td class="features-table-name">6-Month Acceleration Program</td><td>Each cohort goes through a structured 6-month journey focused on business growth, scaling, and investment readiness.</td></tr>
                    <tr><td class="features-table-name">Cohort-Based Model</td><td>Each cohort includes up to <strong>10 selected startups</strong>, allowing focused support and peer learning.</td></tr>
                    <tr><td class="features-table-name">Five Cohorts</td><td>The program will deliver <strong>five accelerator cohorts</strong>, graduating up to <strong>50 startups</strong> over the project period.</td></tr>
                    <tr><td class="features-table-name">Tailored Mentorship</td><td>Each startup receives customized mentorship and advisory support based on its business needs and growth objectives.</td></tr>
                    <tr><td class="features-table-name">Expert Masterclasses</td><td>Startups participate in practical sessions led by experts on entrepreneurship, business development, finance, market access, and scaling.</td></tr>
                    <tr><td class="features-table-name">Technical Assistance Grant</td><td>Each startup can access up to <strong>USD 10,000</strong> for value-added services such as legal advice, registration, patent filing, team training, or specialized business support.</td></tr>
                    <tr><td class="features-table-name">Women and Youth Inclusion</td><td>The program actively targets women and youth entrepreneurs, with an aim for <strong>30%–50% women-led startups</strong> in the accelerator.</td></tr>
                    <tr><td class="features-table-name">Networking Opportunities</td><td>Startups are connected with mentors, experts, investors, ecosystem actors, and potential partners.</td></tr>
                    <tr><td class="features-table-name">Investment Readiness Support</td><td>Startups receive support to strengthen their business models, financial planning, pitch decks, and investor communication.</td></tr>
                    <tr><td class="features-table-name">Demo Day</td><td>Each cohort concludes with a showcase event where startups pitch to investors, partners, and ecosystem stakeholders.</td></tr>
                    <tr><td class="features-table-name">Linkage to Wathba Ecosystem</td><td>Graduated startups may be connected to other Wathba components, including the Yemen Angel Investment Network and the Wathba Impact Investment Fund.</td></tr>
                @else
                    <tr><td class="features-table-name">برنامج تسريع لمدة 6 أشهر</td><td>تمر كل دفعة برحلة منظمة مدتها 6 أشهر تركز على نمو الأعمال والتوسع والاستعداد للاستثمار.</td></tr>
                    <tr><td class="features-table-name">نموذج قائم على الدفعات</td><td>تضم كل دفعة ما يصل إلى <strong>10 شركات ناشئة مختارة</strong>، مما يتيح دعماً مركزاً وتعلماً بين الأقران.</td></tr>
                    <tr><td class="features-table-name">خمس دفعات</td><td>سيقدم البرنامج <strong>خمس دفعات مسرّعة</strong>، يتخرج منها ما يصل إلى <strong>50 شركة ناشئة</strong> خلال فترة المشروع.</td></tr>
                    <tr><td class="features-table-name">إرشاد مخصص</td><td>تحصل كل شركة ناشئة على إرشاد واستشارة مخصصة بناءً على احتياجاتها وأهداف نموها.</td></tr>
                    <tr><td class="features-table-name">دروس إتقانية من خبراء</td><td>تشارك الشركات الناشئة في جلسات عملية يقودها خبراء في ريادة الأعمال والتمويل والوصول إلى الأسواق.</td></tr>
                    <tr><td class="features-table-name">منحة المساعدة التقنية</td><td>يمكن لكل شركة ناشئة الحصول على ما يصل إلى <strong>10,000 دولار أمريكي</strong> للخدمات ذات القيمة المضافة.</td></tr>
                    <tr><td class="features-table-name">إدماج المرأة والشباب</td><td>يستهدف البرنامج بنشاط رواد الأعمال من النساء والشباب، بهدف <strong>30%-50% من الشركات التي تقودها نساء</strong>.</td></tr>
                    <tr><td class="features-table-name">فرص التواصل</td><td>يتم ربط الشركات الناشئة بالمرشدين والخبراء والمستثمرين وجهات النظام البيئي والشركاء المحتملين.</td></tr>
                    <tr><td class="features-table-name">دعم الاستعداد للاستثمار</td><td>تتلقى الشركات الناشئة دعماً لتعزيز نماذج أعمالها والتخطيط المالي وعروض المستثمرين.</td></tr>
                    <tr><td class="features-table-name">يوم العرض</td><td>تختتم كل دفعة بفعالية عرض يقدم فيها رواد الأعمال مشاريعهم للمستثمرين والشركاء.</td></tr>
                    <tr><td class="features-table-name">الارتباط بمنظومة وثبة</td><td>قد يتم ربط الشركات الناشئة الخريجة بمكونات وثبة الأخرى، بما في ذلك شبكة YAIN وصندوق WIIF.</td></tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- ── PROGRAM TIMELINE — vertical cards ──────────────────────── --}}
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">
                {{ $cf['timelineTitle'][$lang] ?? ($lang==='en' ? 'Program Timeline' : 'الجدول الزمني للبرنامج') }}
            </h2>
        </div>

        <div class="timeline-vertical">

@if ($lang === 'en')

    <article class="tl-stage tl-stage-1">
        <header><span class="tl-num">1</span><div><h3>Start</h3><p>Launch the cohort and attract strong applicants</p></div></header>
        <div class="tl-body">
            <div class="tl-block">
                <span class="tl-label">Key Activities</span>
                <p>Announce the program, promote the call for applications, explain eligibility, hold info sessions, and receive applications &mdash; with active outreach to women and youth entrepreneurs.</p>
            </div>
            <div class="tl-block tl-out">
                <span class="tl-label tl-out-label">Main Output</span>
                <p>&#9989; Application pipeline created</p>
            </div>
        </div>
    </article>

    <article class="tl-stage tl-stage-2">
        <header><span class="tl-num">2</span><div><h3>Selection</h3><p>Identify startups with the strongest potential to grow and scale</p></div></header>
        <div class="tl-body">
            <div class="tl-block">
                <span class="tl-label">Key Activities</span>
                <p>Screen applications, shortlist candidates, conduct interviews and pitch reviews, assess team, market, product, impact, and readiness &mdash; then select up to 10 startups.</p>
            </div>
            <div class="tl-block tl-out">
                <span class="tl-label tl-out-label">Main Output</span>
                <p>&#9989; Final cohort selected</p>
            </div>
        </div>
    </article>

    <article class="tl-stage tl-stage-3">
        <header><span class="tl-num">3</span><div><h3>Training / Acceleration</h3><p>Strengthen startup capacity and prepare them for growth and investment</p></div></header>
        <div class="tl-body">
            <div class="tl-block">
                <span class="tl-label">Key Activities</span>
                <p>Deliver tailored mentorship, business advisory, masterclasses, networking, market validation, financial modelling, pitch preparation, and technical assistance grants for legal advice, registration, patent filing, or team training.</p>
            </div>
            <div class="tl-block tl-out">
                <span class="tl-label tl-out-label">Main Output</span>
                <p>&#9989; Startups improve business models, operations, investment readiness, and scale plans</p>
            </div>
        </div>
    </article>

    <article class="tl-stage tl-stage-4">
        <header><span class="tl-num">4</span><div><h3>Demo Day</h3><p>Showcase startups to investors, partners, and ecosystem stakeholders</p></div></header>
        <div class="tl-body">
            <div class="tl-block">
                <span class="tl-label">Key Activities</span>
                <p>Final pitch event, startup presentations, investor matchmaking, feedback sessions, media visibility, and follow-up investment or partnership discussions.</p>
            </div>
            <div class="tl-block tl-out">
                <span class="tl-label tl-out-label">Main Output</span>
                <p>&#9989; Graduated startups connected to funding, partners, and market opportunities</p>
            </div>
        </div>
    </article>

@else

    <article class="tl-stage tl-stage-1">
        <header><span class="tl-num">1</span><div><h3>البداية</h3><p>إطلاق الدفعة وجذب المتقدمين الأقوياء</p></div></header>
        <div class="tl-body">
            <div class="tl-block">
                <span class="tl-label">الأنشطة الرئيسية</span>
                <p>الإعلان عن البرنامج، والترويج لدعوة تقديم الطلبات، وتوضيح شروط الأهلية، وعقد جلسات معلوماتية، واستقبال الطلبات &mdash; مع التوعية النشطة لرواد الأعمال من النساء والشباب.</p>
            </div>
            <div class="tl-block tl-out">
                <span class="tl-label tl-out-label">المخرج الرئيسي</span>
                <p>&#9989; إنشاء قاعدة الطلبات</p>
            </div>
        </div>
    </article>

    <article class="tl-stage tl-stage-2">
        <header><span class="tl-num">2</span><div><h3>الاختيار</h3><p>تحديد الشركات الناشئة ذات أعلى إمكانات النمو</p></div></header>
        <div class="tl-body">
            <div class="tl-block">
                <span class="tl-label">الأنشطة الرئيسية</span>
                <p>مراجعة الطلبات، وإدراج المرشحين في القائمة المختصرة، وإجراء المقابلات ومراجعات العروض، وتقييم الفريق والسوق والمنتج والأثر والاستعداد &mdash; ثم اختيار ما يصل إلى 10 شركات ناشئة.</p>
            </div>
            <div class="tl-block tl-out">
                <span class="tl-label tl-out-label">المخرج الرئيسي</span>
                <p>&#9989; اختيار الدفعة النهائية</p>
            </div>
        </div>
    </article>

    <article class="tl-stage tl-stage-3">
        <header><span class="tl-num">3</span><div><h3>التدريب والتسريع</h3><p>تعزيز قدرات الشركات الناشئة وإعدادها للنمو والاستثمار</p></div></header>
        <div class="tl-body">
            <div class="tl-block">
                <span class="tl-label">الأنشطة الرئيسية</span>
                <p>تقديم الإرشاد المخصص والاستشارات التجارية والدروس الإتقانية والتواصل والتحقق من السوق والنمذجة المالية وإعداد العروض ومنح المساعدة التقنية.</p>
            </div>
            <div class="tl-block tl-out">
                <span class="tl-label tl-out-label">المخرج الرئيسي</span>
                <p>&#9989; تحسين الشركات الناشئة لنماذج أعمالها والاستعداد للاستثمار</p>
            </div>
        </div>
    </article>

    <article class="tl-stage tl-stage-4">
        <header><span class="tl-num">4</span><div><h3>يوم العرض</h3><p>عرض الشركات الناشئة على المستثمرين والشركاء</p></div></header>
        <div class="tl-body">
            <div class="tl-block">
                <span class="tl-label">الأنشطة الرئيسية</span>
                <p>فعالية العرض النهائي، وعروض الشركات الناشئة، ومطابقة المستثمرين، وجلسات التغذية الراجعة، والوضوح الإعلامي، ومتابعة مناقشات الاستثمار أو الشراكة.</p>
            </div>
            <div class="tl-block tl-out">
                <span class="tl-label tl-out-label">المخرج الرئيسي</span>
                <p>&#9989; ربط الشركات الناشئة المتخرجة بالتمويل والشركاء وفرص السوق</p>
            </div>
        </div>
    </article>

@endif

</div>{{-- end timeline-vertical --}}
    </div>
</section>

{{-- Cohorts --}}
<section class="section section-alt">
    <div class="container">
        <div class="section-header"><h2 class="section-title">{{ $lang==='en' ? 'Cohorts' : 'الدفعات' }}</h2></div>
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>{{ $lang==='en' ? 'Cohort' : 'الدفعة' }}</th>
                        <th>{{ $lang==='en' ? 'Status' : 'الحالة' }}</th>
                        <th>{{ $lang==='en' ? 'Start Date' : 'تاريخ البدء' }}</th>
                        <th>{{ $lang==='en' ? 'End Date' : 'تاريخ الانتهاء' }}</th>
                        <th>{{ $lang==='en' ? 'Startups' : 'الشركات' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cohorts as $cohort)
                    <tr>
                        <td><strong>{{ $cohort->{'name_'.$lang} }}</strong></td>
                        <td><span class="status-badge status-{{ strtolower($cohort->status) }}">{{ $cohort->status }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($cohort->start_date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($cohort->end_date)->format('d M Y') }}</td>
                        <td>{{ $cohort->startups_count }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="empty-state">{{ $lang==='en' ? 'No cohorts yet.' : 'لا توجد دفعات بعد.' }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

@include('partials.related-news')
@endsection
