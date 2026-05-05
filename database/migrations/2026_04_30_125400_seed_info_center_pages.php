<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Ensure the basic Info Center & Contact pages exist in the `pages` table so
 * admins can edit their hero (title / subtitle / background image) from
 * /admin/pages without having to re-run the PageSeeder.
 *
 * Existing rows for these page_keys are left untouched.
 */
return new class extends Migration
{
    public function up(): void
    {
        $defaults = [
            [
                'page_key'    => 'blog',
                'title_en'    => 'Blog',
                'title_ar'    => 'المدونة',
                'subtitle_en' => "Insights, stories and updates from the Wathba ecosystem.",
                'subtitle_ar' => 'رؤى وقصص وتحديثات من منظومة وثبة.',
            ],
            [
                'page_key'    => 'events',
                'title_en'    => 'Events',
                'title_ar'    => 'الفعاليات',
                'subtitle_en' => "Workshops, webinars, and networking opportunities for Yemen's entrepreneurs.",
                'subtitle_ar' => 'ورش عمل وندوات وفرص للتواصل لرواد الأعمال في اليمن.',
            ],
            [
                'page_key'    => 'library',
                'title_en'    => 'Library',
                'title_ar'    => 'المكتبة',
                'subtitle_en' => 'Reports, guides, videos, and resources from the Wathba programs.',
                'subtitle_ar' => 'تقارير وأدلة ومقاطع فيديو وموارد من برامج وثبة.',
            ],
            [
                'page_key'    => 'media',
                'title_en'    => 'News & Media',
                'title_ar'    => 'الأخبار والوسائط',
                'subtitle_en' => 'Stay up to date with the latest news from across the Wathba ecosystem.',
                'subtitle_ar' => 'ابق على اطلاع بآخر الأخبار من جميع أنحاء منظومة وثبة.',
            ],
            [
                'page_key'    => 'contact',
                'title_en'    => 'Contact Us',
                'title_ar'    => 'تواصل معنا',
                'subtitle_en' => "We'd love to hear from you. Reach out and our team will respond shortly.",
                'subtitle_ar' => 'يسعدنا تواصلكم معنا، وسيقوم فريقنا بالرد في أقرب وقت.',
            ],
        ];

        $now = now();
        foreach ($defaults as $row) {
            $exists = DB::table('pages')->where('page_key', $row['page_key'])->exists();
            if ($exists) continue;
            DB::table('pages')->insert(array_merge($row, [
                'content_en'    => null,
                'content_ar'    => null,
                'image_url'     => null,
                'custom_fields' => json_encode(new \stdClass()),
                'created_at'    => $now,
                'updated_at'    => $now,
            ]));
        }
    }

    public function down(): void
    {
        // Non-destructive — keep the rows so admins don't lose customised heroes.
    }
};
