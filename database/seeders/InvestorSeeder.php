<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Investor;

class InvestorSeeder extends Seeder
{
    public function run(): void
    {
        Investor::truncate();

        $items = [
            [
                'name_en'      => 'Ahmed Al-Sanaani',
                'name_ar'      => 'أحمد الصنعاني',
                'role_en'      => 'Tech Investor & Mentor',
                'role_ar'      => 'مستثمر تقني ومرشد',
                'bio_en'       => 'Experienced angel investor with a portfolio of 15+ startups in MENA. Focused on Fintech and E-commerce.',
                'bio_ar'       => 'مستثمر ملائكي خبير لديه محفظة تضم أكثر من 15 شركة ناشئة في الشرق الأوسط وشمال أفريقيا. يركز على التكنولوجيا المالية والتجارة الإلكترونية.',
                'image_url'    => 'https://i.pravatar.cc/300?img=11',
                'linkedin_url' => 'https://linkedin.com',
                'twitter_url'  => null,
            ],
            [
                'name_en'      => 'Sarah Al-Yafai',
                'name_ar'      => 'سارة اليافعي',
                'role_en'      => 'Managing Partner',
                'role_ar'      => 'شريك إداري',
                'bio_en'       => 'Passionate about social impact startups. Helping Yemeni entrepreneurs scale globally.',
                'bio_ar'       => 'شغوفة بالشركات الناشئة ذات الأثر الاجتماعي. تساعد رواد الأعمال اليمنيين على التوسع عالمياً.',
                'image_url'    => 'https://i.pravatar.cc/300?img=5',
                'linkedin_url' => 'https://linkedin.com',
                'twitter_url'  => 'https://twitter.com',
            ],
            [
                'name_en'      => 'Dr. Omar Ba-Abbad',
                'name_ar'      => 'د. عمر باعباد',
                'role_en'      => 'Healthcare Innovation',
                'role_ar'      => 'الابتكار في الرعاية الصحية',
                'bio_en'       => 'Medical doctor turned entrepreneur and investor. Seeking HealthTech solutions for local challenges.',
                'bio_ar'       => 'طبيب تحول إلى رائد أعمال ومستثمر. يبحث عن حلول التكنولوجيا الصحية للتحديات المحلية.',
                'image_url'    => 'https://i.pravatar.cc/300?img=13',
                'linkedin_url' => null,
                'twitter_url'  => null,
            ],
        ];

        Investor::insert($items);
    }
}
