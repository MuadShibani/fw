<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramMilestone;

class ProgramMilestoneSeeder extends Seeder
{
    public function run(): void
    {
        ProgramMilestone::truncate();

        $items = [
            [
                'title_en' => 'Start',
                'title_ar' => 'البداية',
                'activities_en' => 'Announce the program, promote the call for applications, explain eligibility, hold info sessions, and receive applications — with active outreach to women and youth entrepreneurs.',
                'activities_ar' => 'الإعلان عن البرنامج، والترويج لدعوة تقديم الطلبات، وتوضيح شروط الأهلية، وعقد جلسات معلوماتية، واستقبال الطلبات — مع التوعية النشطة لرواد الأعمال من النساء والشباب.',
                'output_en' => 'Application pipeline created',
                'output_ar' => 'إنشاء قاعدة الطلبات',
                'timeline_en' => 'Month 1',
                'timeline_ar' => 'الشهر 1',
                'icon'  => '🚀',
                'color' => '#b04c2c',
            ],
            [
                'title_en' => 'Selection',
                'title_ar' => 'الاختيار',
                'activities_en' => 'Screen applications, shortlist candidates, conduct interviews and pitch reviews, assess team, market, product, impact, and readiness — then select up to 10 startups.',
                'activities_ar' => 'مراجعة الطلبات، وإدراج المرشحين في القائمة المختصرة، وإجراء المقابلات ومراجعات العروض، وتقييم الفريق والسوق والمنتج والأثر والاستعداد — ثم اختيار ما يصل إلى 10 شركات ناشئة.',
                'output_en' => 'Final cohort selected',
                'output_ar' => 'اختيار الدفعة النهائية',
                'timeline_en' => 'Month 2',
                'timeline_ar' => 'الشهر 2',
                'icon'  => '🎯',
                'color' => '#b06b1d',
            ],
            [
                'title_en' => 'Training / Acceleration',
                'title_ar' => 'التدريب والتسريع',
                'activities_en' => 'Deliver tailored mentorship, business advisory, masterclasses, networking, market validation, financial modelling, pitch preparation, and technical assistance grants.',
                'activities_ar' => 'تقديم الإرشاد المخصص والاستشارات التجارية والدروس الإتقانية والتواصل والتحقق من السوق والنمذجة المالية وإعداد العروض ومنح المساعدة التقنية.',
                'output_en' => 'Startups improve business models, operations, investment readiness, and scale plans.',
                'output_ar' => 'تحسين الشركات الناشئة لنماذج أعمالها والاستعداد للاستثمار وخطط التوسع.',
                'timeline_en' => 'Months 3–5',
                'timeline_ar' => 'الأشهر 3-5',
                'icon'  => '🎓',
                'color' => '#4a8f3a',
            ],
            [
                'title_en' => 'Demo Day',
                'title_ar' => 'يوم العرض',
                'activities_en' => 'Final pitch event, startup presentations, investor matchmaking, feedback sessions, media visibility, and follow-up investment or partnership discussions.',
                'activities_ar' => 'فعالية العرض النهائي، وعروض الشركات الناشئة، ومطابقة المستثمرين، وجلسات التغذية الراجعة، والوضوح الإعلامي، ومتابعة مناقشات الاستثمار أو الشراكة.',
                'output_en' => 'Graduated startups connected to funding, partners, and market opportunities.',
                'output_ar' => 'ربط الشركات الناشئة المتخرجة بالتمويل والشركاء وفرص السوق.',
                'timeline_en' => 'Month 6',
                'timeline_ar' => 'الشهر 6',
                'icon'  => '🏆',
                'color' => '#4f6a93',
            ],
        ];

        foreach ($items as $i => $row) {
            ProgramMilestone::create(array_merge($row, ['sort_order' => $i + 1]));
        }
    }
}
