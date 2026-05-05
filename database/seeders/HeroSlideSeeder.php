<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlide;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        HeroSlide::truncate();

        $items = [
            [
                'title_en'     => "Strengthening Yemen's Entrepreneurial Ecosystem",
                'title_ar'     => 'تعزيز منظومة ريادة الأعمال في اليمن',
                'subtitle_en'  => 'Wathba is a four-component platform empowering founders, investors, and innovators to drive economic recovery and growth.',
                'subtitle_ar'  => 'منصة وثبة هي منصة من أربعة مكونات تمكّن المؤسسين والمستثمرين والمبتكرين لدفع التعافي الاقتصادي والنمو.',
                'image_url'    => null,
                'cta_label_en' => 'Learn More',
                'cta_label_ar' => 'اعرف المزيد',
                'cta_link'     => '/about',
                'sort_order'   => 1,
                'is_active'    => true,
            ],
            [
                'title_en'     => 'Wathba Accelerator',
                'title_ar'     => 'مسرعة وثبة',
                'subtitle_en'  => 'A 6-month structured journey for up to 10 startups per cohort — mentorship, masterclasses, and a $10k technical assistance grant.',
                'subtitle_ar'  => 'رحلة منظمة لمدة 6 أشهر لما يصل إلى 10 شركات ناشئة لكل دفعة — إرشاد ودروس إتقانية ومنحة مساعدة تقنية بقيمة 10,000 دولار.',
                'image_url'    => null,
                'cta_label_en' => 'Explore the Program',
                'cta_label_ar' => 'استعرض البرنامج',
                'cta_link'     => '/accelerator',
                'sort_order'   => 2,
                'is_active'    => true,
            ],
            [
                'title_en'     => 'Yemen Angel Investment Network',
                'title_ar'     => 'شبكة المستثمرين الملائكيين اليمنيين',
                'subtitle_en'  => 'Connecting Yemeni founders with diaspora investors who back the next generation of high-growth companies.',
                'subtitle_ar'  => 'ربط المؤسسين اليمنيين بمستثمري الشتات الذين يدعمون الجيل القادم من الشركات عالية النمو.',
                'image_url'    => null,
                'cta_label_en' => 'Meet YAIN',
                'cta_label_ar' => 'تعرّف على YAIN',
                'cta_link'     => '/yain',
                'sort_order'   => 3,
                'is_active'    => true,
            ],
        ];

        foreach ($items as $row) {
            HeroSlide::create($row);
        }
    }
}
