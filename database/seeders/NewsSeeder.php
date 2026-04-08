<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        News::truncate();

        $items = [
            [
                'date'       => '2026-01-15',
                'title_en'   => 'Wathba Launches First Cohort',
                'title_ar'   => 'وثبة تطلق الدفعة الأولى',
                'summary_en' => 'The accelerator program welcomes 10 new startups.',
                'summary_ar' => 'برنامج المسرعة يرحب بـ 10 شركات ناشئة جديدة.',
                'category'   => 'Accelerator',
                'image_en'   => 'https://picsum.photos/400/300',
                'image_ar'   => 'https://picsum.photos/400/300',
            ],
            [
                'date'       => '2026-02-01',
                'title_en'   => 'YAIN Secures Major Funding',
                'title_ar'   => 'الشبكة تؤمن تمويلاً ضخماً',
                'summary_en' => 'New partnerships established with regional investors.',
                'summary_ar' => 'شراكات جديدة تم تأسيسها مع مستثمرين إقليميين.',
                'category'   => 'Investment',
                'image_en'   => 'https://picsum.photos/400/301',
                'image_ar'   => 'https://picsum.photos/400/301',
            ],
            [
                'date'       => '2026-02-10',
                'title_en'   => 'SDG Impact Report Released',
                'title_ar'   => 'إصدار تقرير الأثر لأهداف التنمية',
                'summary_en' => 'Analysis of how Wathba is contributing to local goals.',
                'summary_ar' => 'تحليل لكيفية مساهمة وثبة في الأهداف المحلية.',
                'category'   => 'WIIF',
                'image_en'   => 'https://picsum.photos/400/302',
                'image_ar'   => 'https://picsum.photos/400/302',
            ],
        ];

        News::insert($items);
    }
}
