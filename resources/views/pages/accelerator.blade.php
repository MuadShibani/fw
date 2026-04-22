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
            {{ $lang==='en'?'Apply Now':'قدّم الآن' }}
        </a>
        @endif
    </div>
</section>

{{-- Main Content --}}
@if($page->{'content_'.$lang})
<section class="section">
    <div class="container prose-content">
        {!! $page->{'content_'.$lang} !!}
    </div>
</section>
@endif

{{-- ── PROGRAM FEATURES — table layout ────────────────────────────── --}}
<section class="section section-alt">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">{{ $lang==='en'?'Program Features':'مميزات البرنامج' }}</h2>
        </div>
        <div class="features-table-wrap">
            <table class="features-table">
                <thead>
                    <tr>
                        <th>{{ $lang==='en'?'Feature':'الميزة' }}</th>
                        <th>{{ $lang==='en'?'Description':'الوصف' }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $features = $lang==='en' ? [
                        ['6-Month Acceleration Program', 'Each cohort goes through a structured 6-month journey focused on business growth, scaling, and investment readiness.'],
                        ['Cohort-Based Model', 'Each cohort includes up to <strong>10 selected startups</strong>, allowing focused support and peer learning.'],
                        ['Five Cohorts', 'The program will deliver <strong>five accelerator cohorts</strong>, graduating up to <strong>50 startups</strong> over the project period.'],
                        ['Tailored Mentorship', 'Each startup receives customized mentorship and advisory support based on its business needs and growth objectives.'],
                        ['Expert Masterclasses', 'Startups participate in practical sessions led by experts on entrepreneurship, business development, finance, market access, and scaling.'],
                        ['Technical Assistance Grant', 'Each startup can access up to <strong>USD 10,000</strong> for value-added services such as legal advice, registration, patent filing, team training, or specialized business support.'],
                        ['Women and Youth Inclusion', 'The program actively targets women and youth entrepreneurs, with an aim for <strong>30%–50% women-led startups</strong> in the accelerator.'],
                        ['Networking Opportunities', 'Startups are connected with mentors, experts, investors, ecosystem actors, and potential partners.'],
                        ['Investment Readiness Support', 'Startups receive support to strengthen their business models, financial planning, pitch decks, and investor communication.'],
                        ['Demo Day', 'Each cohort concludes with a showcase event where startups pitch to investors, partners, and ecosystem stakeholders.'],
                        ['Linkage to Wathba Ecosystem', 'Graduated startups may be connected to other Wathba components, including the Yemen Angel Investment Network and the Wathba Impact Investment Fund.'],
                    ] : [
                        ['برنامج تسريع لمدة 6 أشهر', 'تمر كل دفعة برحلة منظمة مدتها 6 أشهر تركز على نمو الأعمال والتوسع والاستعداد للاستثمار.'],
                        ['نموذج قائم على الدفعات', 'تضم كل دفعة ما يصل إلى <strong>10 شركات ناشئة مختارة</strong>، مما يتيح دعماً مركزاً وتعلماً بين الأقران.'],
                        ['خمس دفعات', 'سيقدم البرنامج <strong>خمس دفعات مسرّعة</strong>، يتخرج منها ما يصل إلى <strong>50 شركة ناشئة</strong> خلال فترة المشروع.'],
                        ['إرشاد مخصص', 'تحصل كل شركة ناشئة على إرشاد واستشارة مخصصة بناءً على احتياجاتها وأهداف نموها.'],
                        ['دروس إتقانية من خبراء', 'تشارك الشركات الناشئة في جلسات عملية يقودها خبراء في ريادة الأعمال والتمويل والوصول إلى الأسواق.'],
                        ['منحة المساعدة التقنية', 'يمكن لكل شركة ناشئة الحصول على ما يصل إلى <strong>10,000 دولار أمريكي</strong> للخدمات ذات القيمة المضافة.'],
                        ['إدماج المرأة والشباب', 'يستهدف البرنامج بنشاط رواد الأعمال من النساء والشباب، بهدف <strong>30%-50% من الشركات التي تقودها نساء</strong>.'],
                        ['فرص التواصل', 'يتم ربط الشركات الناشئة بالمرشدين والخبراء والمستثمرين وجهات النظام البيئي والشركاء المحتملين.'],
                        ['دعم الاستعداد للاستثمار', 'تتلقى الشركات الناشئة دعماً لتعزيز نماذج أعمالها والتخطيط المالي وعروض المستثمرين.'],
                        ['يوم العرض', 'تختتم كل دفعة بفعالية عرض يقدم فيها رواد الأعمال مشاريعهم للمستثمرين والشركاء.'],
                        ['الارتباط بمنظومة وثبة', 'قد يتم ربط الشركات الناشئة الخريجة بمكونات وثبة الأخرى، بما في ذلك شبكة YAIN وصندوق WIIF.'],
                    ];
                    @endphp
                    @foreach($features as $row)
                    <tr>
                        <td class="features-table-name">{!! $row[0] !!}</td>
                        <td>{!! $row[1] !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- ── PROGRAM TIMELINE — vertical card layout ─────────────────────── --}}
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">
                {{ $cf['timelineTitle'][$lang] ?? ($lang==='en'?'Program Timeline':'الجدول الزمني للبرنامج') }}
            </h2>
        </div>
        @php
        $timelineStages = $lang==='en' ? [
            [
                'num'  => '1',
                'title'=> 'Start',
                'color'=> '#9FD4D5',
                'purpose'=> 'Launch the cohort and attract strong applicants',
                'activities' => 'Announce the program, promote the call for applications, explain eligibility, hold info sessions, and receive applications — with active outreach to women and youth entrepreneurs.',
                'output' => 'Application pipeline created',
            ],
            [
                'num'  => '2',
                'title'=> 'Selection',
                'color'=> '#A2C59A',
                'purpose'=> 'Identify startups with the strongest potential to grow and scale',
                'activities' => 'Screen applications, shortlist candidates, conduct interviews and pitch reviews, assess team, market, product, impact, and readiness — then select up to 10 startups.',
                'output' => 'Final cohort selected',
            ],
            [
                'num'  => '3',
                'title'=> 'Training / Acceleration',
                'color'=> '#ECCE9E',
                'purpose'=> 'Strengthen startup capacity and prepare them for growth and investment',
                'activities' => 'Deliver tailored mentorship, business advisory, masterclasses, networking, market validation, financial modelling, pitch preparation, and technical assistance grants for legal advice, registration, patent filing, or team training.',
                'output' => 'Startups improve business models, operations, investment readiness, and scale plans',
            ],
            [
                'num'  => '4',
                'title'=> 'Demo Day',
                'color'=> '#B04C2C',
                'purpose'=> 'Showcase startups to investors, partners, and ecosystem stakeholders',
                'activities' => 'Final pitch event, startup presentations, investor matchmaking, feedback sessions, media visibility, and follow-up investment or partnership discussions.',
                'output' => 'Graduated startups connected to funding, partners, and market opportunities',
            ],

        ] : [
            [
                'num'  => '1',
                'title'=> 'البداية',
                'color'=> '#9FD4D5',
                'purpose'=> 'إطلاق الدفعة وجذب المتقدمين الأقوياء',
                'activities' => 'الإعلان عن البرنامج، والترويج لدعوة تقديم الطلبات، وتوضيح شروط الأهلية، وعقد جلسات معلوماتية، واستقبال الطلبات — مع التوعية النشطة لرواد الأعمال من النساء والشباب.',
                'output' => 'إنشاء قاعدة الطلبات',
            ],
            [
                'num'  => '2',
                'title'=> 'الاختيار',
                'color'=> '#A2C59A',
                'purpose'=> 'تحديد الشركات الناشئة ذات أعلى إمكانات النمو',
                'activities' => 'مراجعة الطلبات، وإدراج المرشحين في القائمة المختصرة، وإجراء المقابلات ومراجعات العروض، وتقييم الفريق والسوق والمنتج والأثر والاستعداد — ثم اختيار ما يصل إلى 10 شركات ناشئة.',
                'output' => 'اختيار الدفعة النهائية',
            ],
            [
                'num'  => '3',
                'title'=> 'التدريب والتسريع',
                'color'=> '#ECCE9E',
                'purpose'=> 'تعزيز قدرات الشركات الناشئة وإعدادها للنمو والاستثمار',
                'activities' => 'تقديم الإرشاد المخصص والاستشارات التجارية والدروس الإتقانية والتواصل والتحقق من السوق والنمذجة المالية وإعداد العروض ومنح المساعدة التقنية.',
                'output' => 'تحسين الشركات الناشئة لنماذج أعمالها والاستعداد للاستثمار',
            ],
            [
                'num'  => '4',
                'title'=> 'يوم العرض',
                'color'=> '#B04C2C',
                'purpose'=> 'عرض الشركات الناشئة على المستثمرين والشركاء',
                'activities' => 'فعالية العرض النهائي، وعروض الشركات الناشئة، ومطابقة المستثمرين، وجلسات التغذية الراجعة، والوضوح الإعلامي، ومتابعة مناقشات الاستثمار أو الشراكة.',
                'output' => 'ربط الشركات الناشئة المتخرجة بالتمويل والشركاء وفرص السوق',
            ],

        ];
        @endphp

        <div class="timeline-vertical">
            @php $x = 0;  @endphp
            @foreach($timelineStages as $stage)
                @php if($x == 3) {
        break;
 }  @endphp
            <div class="timeline-v-item">
                <div class="timeline-v-badge" style="background:{{ $stage['color'] }};color:{{ $stage['color']==='#B04C2C'?'#fff':'#524037' }}">
                    {{ $stage['num'] }}
                </div>
                <div class="timeline-v-connector"></div>
                <div class="timeline-v-card">
                    <div class="timeline-v-card-header" style="background:{{ $stage['color'] }};color:{{ $stage['color']==='#B04C2C'?'#fff':'#524037' }}">
                        <h3 class="timeline-v-title">{{ $stage['title'] }}</h3>
                        <p class="timeline-v-purpose">{{ $stage['purpose'] }}</p>
                    </div>
                    <div class="timeline-v-card-body">
                        <div class="timeline-v-section">
                            <span class="timeline-v-label">{{ $lang==='en'?'Key Activities':'الأنشطة الرئيسية' }}</span>
                            <p>{{ $stage['activities'] }}</p>
                        </div>
                        <div class="timeline-v-section timeline-v-output">
                            <span class="timeline-v-label output-label">{{ $lang==='en'?'Main Output':'المخرج الرئيسي' }}</span>
                            <p>✅ {{ $stage['output'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
                @php $x++;  @endphp
            @endforeach
        </div>
    </div>
</section>

{{-- Cohorts --}}
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
                        <td><strong>{{ $cohort->{'name_'.$lang} }}</strong></td>
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
