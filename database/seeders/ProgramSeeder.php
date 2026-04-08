<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        Program::truncate();

        $items = [
            [
                'id'             => 'accelerator',
                'sort_order'     => 1,
                'title_en'       => 'Wathba Accelerator',
                'title_ar'       => 'مسرعة وثبة',
                'description_en' => 'A dedicated program supporting startups through 5 planned cohorts over 6 months each, providing mentorship and roadmaps.',
                'description_ar' => 'برنامج مخصص لدعم الشركات الناشئة من خلال 5 دفعات مخططة مدة كل منها 6 أشهر، يوفر التوجيه وخرائط الطريق.',
                'color'          => '#9FD4D5',
                'path'           => '/accelerator',
                'features'       => json_encode([
                    ['en' => 'Mentor Directory',  'ar' => 'دليل المرشدين'],
                    ['en' => 'Alumni Showcase',   'ar' => 'معرض الخريجين'],
                    ['en' => 'Cohort Tracker',    'ar' => 'متابعة الدفعات'],
                ]),
            ],
            [
                'id'             => 'yain',
                'sort_order'     => 2,
                'title_en'       => 'Yemen Angel Investment Network',
                'title_ar'       => 'شبكة المستثمرين الملائكيين اليمنية',
                'description_en' => 'Connecting angel investors and champions with promising Yemeni startups to bridge the funding gap.',
                'description_ar' => 'ربط المستثمرين الملائكيين والأبطال بالشركات الناشئة اليمنية الواعدة لسد الفجوة التمويلية.',
                'color'          => '#A2C59A',
                'path'           => '/yain',
                'features'       => json_encode([
                    ['en' => 'Investor Profiles',  'ar' => 'ملفات المستثمرين'],
                    ['en' => 'Startup Showcase',   'ar' => 'معرض الشركات الناشئة'],
                    ['en' => 'Investment Vehicles', 'ar' => 'أدوات الاستثمار'],
                ]),
            ],
            [
                'id'             => 'wiif',
                'sort_order'     => 3,
                'title_en'       => 'Wathba Impact Investment Fund',
                'title_ar'       => 'صندوق وثبة للاستثمار المؤثر',
                'description_en' => 'A fund overview focused on capital structure, portfolio company profiles, and SDG alignment.',
                'description_ar' => 'نظرة عامة على الصندوق تركز على هيكل رأس المال، وملفات شركات المحفظة، ومواءمة أهداف التنمية المستدامة.',
                'color'          => '#B04C2C',
                'path'           => '/wiif',
                'features'       => json_encode([
                    ['en' => 'Capital Structure',   'ar' => 'هيكل رأس المال'],
                    ['en' => 'Portfolio Companies', 'ar' => 'شركات المحفظة'],
                    ['en' => 'SDG Alignment',       'ar' => 'أهداف التنمية المستدامة'],
                ]),
            ],
            [
                'id'             => 'sil',
                'sort_order'     => 4,
                'title_en'       => 'Social Innovation Lab',
                'title_ar'       => 'مختبر الابتكار الاجتماعي',
                'description_en' => 'Fostering social entrepreneurship and community-driven solutions for Yemen\'s most pressing challenges.',
                'description_ar' => 'تعزيز ريادة الأعمال الاجتماعية والحلول المجتمعية لأكثر تحديات اليمن إلحاحاً.',
                'color'          => '#ECCE9E',
                'path'           => '/sil',
                'features'       => json_encode([
                    ['en' => 'Innovation Grants',  'ar' => 'منح الابتكار'],
                    ['en' => 'Community Programs', 'ar' => 'البرامج المجتمعية'],
                    ['en' => 'Impact Measurement', 'ar' => 'قياس الأثر'],
                ]),
            ],
        ];

        foreach ($items as $item) {
            Program::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
