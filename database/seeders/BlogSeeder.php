<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        Blog::truncate();

        $items = [
            [
                'date'       => '2026-02-12',
                'title_en'   => 'The Future of Fintech in Yemen',
                'title_ar'   => 'مستقبل التكنولوجيا المالية في اليمن',
                'summary_en' => 'Exploring how digital payments are transforming the local economy.',
                'summary_ar' => 'استكشاف كيف تحول المدفوعات الرقمية الاقتصاد المحلي.',
                'content_en' => 'Fintech in Yemen is experiencing a surge. Mobile money solutions are reaching unbanked populations in remote areas, enabling small businesses to transact digitally for the first time. With smartphone penetration increasing and youth demographics driving adoption, the future looks promising for financial technology in the region.',
                'content_ar' => 'تشهد التكنولوجيا المالية في اليمن طفرة ملحوظة. تصل حلول الأموال عبر الهاتف المحمول إلى السكان الذين لا يتعاملون مع البنوك في المناطق النائية، مما يتيح للشركات الصغيرة إجراء معاملات رقمية لأول مرة. مع تزايد انتشار الهواتف الذكية وقيادة الشباب لعملية التبني، يبدو المستقبل واعداً للتكنولوجيا المالية في المنطقة.',
                'author_en'  => 'Sarah Al-Yafai',
                'author_ar'  => 'سارة اليافعي',
                'image_en'   => 'https://picsum.photos/400/305',
                'image_ar'   => 'https://picsum.photos/400/305',
            ],
            [
                'date'       => '2026-02-08',
                'title_en'   => 'Building Resilience in Startups',
                'title_ar'   => 'بناء المرونة في الشركات الناشئة',
                'summary_en' => 'Key strategies for survival and growth in challenging markets.',
                'summary_ar' => 'استراتيجيات رئيسية للبقاء والنمو في الأسواق الصعبة.',
                'content_en' => 'Resilience is not just a buzzword — it is the defining trait of successful startups operating in conflict-affected markets. From adaptive business models to lean operations and community-based distribution, Yemeni entrepreneurs are rewriting the playbook for building companies in adversity.',
                'content_ar' => 'المرونة ليست مجرد كلمة طنانة — بل هي السمة المميزة للشركات الناشئة الناجحة التي تعمل في الأسواق المتأثرة بالنزاعات. من النماذج التجارية التكيفية إلى العمليات الرشيقة والتوزيع المجتمعي، يعيد رواد الأعمال اليمنيون كتابة قواعد اللعبة لبناء شركات في مواجهة الشدائد.',
                'author_en'  => 'Ahmed Al-Sanaani',
                'author_ar'  => 'أحمد الصنعاني',
                'image_en'   => 'https://picsum.photos/400/306',
                'image_ar'   => 'https://picsum.photos/400/306',
            ],
        ];

        Blog::insert($items);
    }
}
