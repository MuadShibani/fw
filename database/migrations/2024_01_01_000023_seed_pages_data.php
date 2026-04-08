<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * This migration seeds the 'home' page row and ensures all pages
 * have their full custom_fields JSON populated.
 * Safe to run on both fresh and existing installs — uses updateOrInsert.
 */
return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        $pages = [
            [
                'page_key'      => 'home',
                'title_en'      => "Empowering Yemen's Entrepreneurial Ecosystem",
                'title_ar'      => 'تمكين منظومة ريادة الأعمال في اليمن',
                'subtitle_en'   => "Strengthening the foundations of Yemen's entrepreneurial ecosystem to drive economic recovery and growth.",
                'subtitle_ar'   => 'تعزيز أسس منظومة ريادة الأعمال في اليمن لدفع التعافي الاقتصادي والنمو.',
                'content_en'    => 'EU-Funded Initiative',
                'content_ar'    => 'مبادرة بتمويل أوروبي',
                'image_url'     => null,
                'custom_fields' => json_encode([
                    'cta_primary'   => ['en' => 'Learn More',  'ar' => 'اعرف المزيد'],
                    'cta_secondary' => ['en' => 'Contact Us',  'ar' => 'تواصل معنا'],
                ]),
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'page_key'      => 'about',
                'title_en'      => 'About Wathba',
                'title_ar'      => 'عن وثبة',
                'subtitle_en'   => "Strengthening the foundations of Yemen's entrepreneurial ecosystem.",
                'subtitle_ar'   => 'تعزيز أسس منظومة ريادة الأعمال في اليمن.',
                'content_en'    => '<p>Wathba is a comprehensive project funded by the European Union designed to support the resilience and recovery of the Yemeni economy.</p>',
                'content_ar'    => '<p>وثبة هو مشروع شامل بتمويل من الاتحاد الأوروبي صمم لدعم مرونة وتعافي الاقتصاد اليمني.</p>',
                'image_url'     => null,
                'custom_fields' => json_encode([
                    'mission_title' => ['en' => 'Our Mission', 'ar' => 'مهمتنا'],
                    'mission_body'  => ['en' => 'Strengthening the Yemeni entrepreneurial ecosystem through targeted programs, capacity building, and strategic investments.', 'ar' => 'تعزيز منظومة ريادة الأعمال اليمنية من خلال برامج مستهدفة وبناء القدرات والاستثمارات الاستراتيجية.'],
                    'vision_title'  => ['en' => 'Our Vision',  'ar' => 'رؤيتنا'],
                    'vision_body'   => ['en' => "A thriving, resilient Yemeni economy where entrepreneurs can start, grow, and scale impactful businesses.", 'ar' => 'اقتصاد يمني مزدهر ومرن حيث يمكن لرواد الأعمال بدء وتنمية وتوسيع الأعمال ذات الأثر الإيجابي.'],
                    'values_title'  => ['en' => 'Our Values',  'ar' => 'قيمنا'],
                    'values_body'   => ['en' => 'Transparency, inclusion, innovation, and sustainability drive every decision we make.', 'ar' => 'الشفافية والشمول والابتكار والاستدامة تقود كل قرار نتخذه.'],
                ]),
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'page_key'      => 'accelerator',
                'title_en'      => 'Wathba Accelerator',
                'title_ar'      => 'مسرعة وثبة',
                'subtitle_en'   => 'Supporting startups through 5 planned cohorts.',
                'subtitle_ar'   => 'دعم الشركات الناشئة من خلال 5 دفعات مخططة.',
                'content_en'    => '<p>A dedicated program supporting startups providing mentorship and roadmaps.</p>',
                'content_ar'    => '<p>برنامج مخصص لدعم الشركات الناشئة يوفر التوجيه وخرائط الطريق.</p>',
                'image_url'     => null,
                'custom_fields' => json_encode([
                    'apply_link'    => '',
                    'features'      => [
                        ['en' => 'Mentor Directory', 'ar' => 'دليل المرشدين'],
                        ['en' => 'Alumni Showcase',  'ar' => 'معرض الخريجين'],
                        ['en' => 'Roadmap',          'ar' => 'خارطة الطريق'],
                    ],
                    'timelineTitle' => ['en' => 'Program Timeline', 'ar' => 'الجدول الزمني للبرنامج'],
                    'timelineSteps' => [
                        ['en' => 'Start',     'ar' => 'البداية'],
                        ['en' => 'Selection', 'ar' => 'الاختيار'],
                        ['en' => 'Training',  'ar' => 'التدريب'],
                        ['en' => 'Demo Day',  'ar' => 'يوم العرض'],
                    ],
                ]),
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'page_key'      => 'yain',
                'title_en'      => 'YAIN',
                'title_ar'      => 'الشبكة',
                'subtitle_en'   => 'Yemen Angel Investment Network',
                'subtitle_ar'   => 'شبكة المستثمرين الملائكيين اليمنية',
                'content_en'    => '<p>Bridging the funding gap by connecting startups with investors.</p>',
                'content_ar'    => '<p>سد الفجوة التمويلية من خلال ربط الشركات الناشئة بالمستثمرين.</p>',
                'image_url'     => null,
                'custom_fields' => json_encode([
                    'championsTitle'    => ['en' => 'Our Champions',    'ar' => 'أبطالنا'],
                    'championsSubtitle' => ['en' => 'Meet the angel investors driving innovation in Yemen.', 'ar' => 'تعرف على المستثمرين الملائكيين الذين يدفعون عجلة الابتكار في اليمن.'],
                    'portfolioTitle'    => ['en' => 'Portfolio Companies', 'ar' => 'شركات المحفظة'],
                    'portfolioSubtitle' => ['en' => 'Innovative startups backed by the YAIN network.', 'ar' => 'شركات ناشئة مبتكرة مدعومة من شبكة YAIN.'],
                    'ctaTitle'          => ['en' => 'Become an Angel Investor', 'ar' => 'كن مستثمراً ملائكياً'],
                    'ctaSubtitle'       => ['en' => "Join the network and help shape the future of Yemen's economy.", 'ar' => 'انضم إلى الشبكة وساعد في تشكيل مستقبل اقتصاد اليمن.'],
                    'investor_join_link' => '',
                    'startup_pitch_link' => '',
                ]),
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'page_key'      => 'wiif',
                'title_en'      => 'WIIF',
                'title_ar'      => 'الصندوق',
                'subtitle_en'   => 'Wathba Impact Investment Fund',
                'subtitle_ar'   => 'صندوق وثبة للاستثمار المؤثر',
                'content_en'    => '<p>A dedicated fund focusing on capital structure.</p>',
                'content_ar'    => '<p>صندوق مخصص يركز على هيكل رأس المال.</p>',
                'image_url'     => null,
                'custom_fields' => json_encode([
                    'listItems' => [
                        ['en' => 'Capital Structure: Blended finance model', 'ar' => 'هيكل رأس المال: نموذج التمويل المختلط'],
                        ['en' => 'Ticket Size: $50k - $200k',               'ar' => 'حجم التذكرة: 50 ألف - 200 ألف دولار'],
                        ['en' => 'Focus: Job creation and women empowerment','ar' => 'التركيز: خلق فرص العمل وتمكين المرأة'],
                    ],
                    'sdgTitle' => ['en' => 'SDG Alignment', 'ar' => 'أهداف التنمية المستدامة'],
                    'sdgDesc'  => [
                        'en' => 'We measure our impact against the UN Sustainable Development Goals, ensuring every investment contributes to a better future for Yemen.',
                        'ar' => 'نحن نقيس أثرنا مقابل أهداف التنمية المستدامة للأمم المتحدة، لضمان أن كل استثمار يساهم في مستقبل أفضل لليمن.',
                    ],
                ]),
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'page_key'      => 'sil',
                'title_en'      => 'Social Innovation Lab',
                'title_ar'      => 'مختبر الابتكار الاجتماعي',
                'subtitle_en'   => 'Fostering social entrepreneurship.',
                'subtitle_ar'   => 'تعزيز ريادة الأعمال الاجتماعية.',
                'content_en'    => '<p>The SIL operates to create sustainable social impact through grants, community programs, and impact measurement.</p>',
                'content_ar'    => '<p>يعمل المختبر على خلق أثر اجتماعي مستدام من خلال المنح والبرامج المجتمعية وقياس الأثر.</p>',
                'image_url'     => null,
                'custom_fields' => json_encode([
                    'external_link'    => '',
                    'grants_title'     => ['en' => 'Innovation Grants',   'ar' => 'منح الابتكار'],
                    'grants_body'      => ['en' => "Funding for social innovation projects that address Yemen's pressing community challenges.", 'ar' => 'تمويل مشاريع الابتكار الاجتماعي التي تعالج التحديات المجتمعية الملحّة في اليمن.'],
                    'community_title'  => ['en' => 'Community Programs', 'ar' => 'البرامج المجتمعية'],
                    'community_body'   => ['en' => 'Workshops and capacity-building for social entrepreneurs and community leaders.', 'ar' => 'ورش عمل وبناء قدرات لرواد الأعمال الاجتماعيين وقادة المجتمع.'],
                    'impact_title'     => ['en' => 'Impact Measurement',  'ar' => 'قياس الأثر'],
                    'impact_body'      => ['en' => 'Tools and frameworks for measuring the social impact of entrepreneurial initiatives.', 'ar' => 'أدوات وأطر لقياس الأثر الاجتماعي للمبادرات الريادية.'],
                ]),
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
        ];

        foreach ($pages as $page) {
            DB::table('pages')->updateOrInsert(
                ['page_key' => $page['page_key']],
                $page
            );
        }
    }

    public function down(): void
    {
        DB::table('pages')->whereIn('page_key', ['home','about','accelerator','yain','wiif','sil'])->delete();
    }
};
