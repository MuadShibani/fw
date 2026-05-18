<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProgramFeature;

class ProgramFeatureSeeder extends Seeder
{
    public function run(): void
    {
        ProgramFeature::truncate();

        $items = [
            ['name_en' => '6-Month Acceleration Program', 'name_ar' => 'برنامج تسريع لمدة 6 أشهر', 'description_en' => 'Each cohort goes through a structured 6-month journey focused on business growth, scaling, and investment readiness.', 'description_ar' => 'تمر كل دفعة برحلة منظمة مدتها 6 أشهر تركز على نمو الأعمال والتوسع والاستعداد للاستثمار.'],
            ['name_en' => 'Cohort-Based Model', 'name_ar' => 'نموذج قائم على الدفعات', 'description_en' => 'Each cohort includes up to 10 selected startups, allowing focused support and peer learning.', 'description_ar' => 'تضم كل دفعة ما يصل إلى 10 شركات ناشئة مختارة، مما يتيح دعماً مركزاً وتعلماً بين الأقران.'],
            ['name_en' => 'Five Cohorts', 'name_ar' => 'خمس دفعات', 'description_en' => 'The program will deliver five accelerator cohorts, graduating up to 50 startups over the project period.', 'description_ar' => 'سيقدم البرنامج خمس دفعات مسرّعة، يتخرج منها ما يصل إلى 50 شركة ناشئة خلال فترة المشروع.'],
            ['name_en' => 'Tailored Mentorship', 'name_ar' => 'إرشاد مخصص', 'description_en' => 'Each startup receives customized mentorship and advisory support based on its business needs and growth objectives.', 'description_ar' => 'تحصل كل شركة ناشئة على إرشاد واستشارة مخصصة بناءً على احتياجاتها وأهداف نموها.'],
            ['name_en' => 'Expert Masterclasses', 'name_ar' => 'دروس إتقانية من خبراء', 'description_en' => 'Startups participate in practical sessions led by experts on entrepreneurship, business development, finance, market access, and scaling.', 'description_ar' => 'تشارك الشركات الناشئة في جلسات عملية يقودها خبراء في ريادة الأعمال وتطوير الأعمال والتمويل والوصول إلى الأسواق والتوسع.'],
            ['name_en' => 'Technical Assistance Grant', 'name_ar' => 'منحة المساعدة التقنية', 'description_en' => 'Each startup can access up to USD 10,000 for value-added services such as legal advice, registration, patent filing, team training, or specialized business support.', 'description_ar' => 'يمكن لكل شركة ناشئة الحصول على ما يصل إلى 10,000 دولار أمريكي للخدمات ذات القيمة المضافة.'],
            ['name_en' => 'Women and Youth Inclusion', 'name_ar' => 'إدماج المرأة والشباب', 'description_en' => 'The program actively targets women and youth entrepreneurs, with an aim for 30%–50% women-led startups in the accelerator.', 'description_ar' => 'يستهدف البرنامج بنشاط رواد الأعمال من النساء والشباب، بهدف 30%-50% من الشركات التي تقودها نساء.'],
            ['name_en' => 'Networking Opportunities', 'name_ar' => 'فرص التواصل', 'description_en' => 'Startups are connected with mentors, experts, investors, ecosystem actors, and potential partners.', 'description_ar' => 'يتم ربط الشركات الناشئة بالمرشدين والخبراء والمستثمرين وجهات النظام البيئي والشركاء المحتملين.'],
            ['name_en' => 'Investment Readiness Support', 'name_ar' => 'دعم الاستعداد للاستثمار', 'description_en' => 'Startups receive support to strengthen their business models, financial planning, pitch decks, and investor communication.', 'description_ar' => 'تتلقى الشركات الناشئة دعماً لتعزيز نماذج أعمالها والتخطيط المالي وعروض المستثمرين.'],
            ['name_en' => 'Demo Day', 'name_ar' => 'يوم العرض', 'description_en' => 'Each cohort concludes with a showcase event where startups pitch to investors, partners, and ecosystem stakeholders.', 'description_ar' => 'تختتم كل دفعة بفعالية عرض يقدم فيها رواد الأعمال مشاريعهم للمستثمرين والشركاء.'],
            ['name_en' => 'Linkage to Wathba Ecosystem', 'name_ar' => 'الارتباط بمنظومة وثبة', 'description_en' => 'Graduated startups may be connected to other Wathba components, including the Yemen Angel Investment Network and the Wathba Impact Investment Fund.', 'description_ar' => 'قد يتم ربط الشركات الناشئة الخريجة بمكونات وثبة الأخرى، بما في ذلك شبكة YAIN وصندوق WIIF.'],
        ];

        foreach ($items as $i => $row) {
            ProgramFeature::create(array_merge($row, ['sort_order' => $i + 1]));
        }
    }
}
