<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Add page rows for blog, events, library, media, contact
 * so their hero banners can be edited from the dashboard.
 * Safe for existing databases (uses updateOrInsert).
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pages')) {
            return;
        }

        $now = now();
        $pages = [
            [
                'page_key'    => 'blog',
                'title_en'    => 'Blog',
                'title_ar'    => 'المدونة',
                'subtitle_en' => 'Insights, stories and updates from the Wathba ecosystem.',
                'subtitle_ar' => 'رؤى وقصص وتحديثات من منظومة وثبة.',
            ],
            [
                'page_key'    => 'events',
                'title_en'    => 'Events',
                'title_ar'    => 'الفعاليات',
                'subtitle_en' => 'Workshops, webinars, networking events and pitch days.',
                'subtitle_ar' => 'ورش عمل وندوات وفعاليات تواصل وأيام العرض.',
            ],
            [
                'page_key'    => 'library',
                'title_en'    => 'Library',
                'title_ar'    => 'المكتبة',
                'subtitle_en' => 'Documents, images, and videos from Wathba.',
                'subtitle_ar' => 'وثائق وصور ومقاطع فيديو من وثبة.',
            ],
            [
                'page_key'    => 'media',
                'title_en'    => 'News & Media',
                'title_ar'    => 'الأخبار والوسائط',
                'subtitle_en' => 'Latest updates and press coverage.',
                'subtitle_ar' => 'آخر المستجدات والتغطية الإعلامية.',
            ],
            [
                'page_key'    => 'contact',
                'title_en'    => 'Contact Us',
                'title_ar'    => 'تواصل معنا',
                'subtitle_en' => "We'd love to hear from you. Reach out and our team will get back to you.",
                'subtitle_ar' => 'يسعدنا أن نسمع منك. تواصل معنا وسنرد عليك في أقرب وقت.',
            ],
        ];

        foreach ($pages as $page) {
            DB::table('pages')->updateOrInsert(
                ['page_key' => $page['page_key']],
                array_merge($page, [
                    'created_at' => $now,
                    'updated_at' => $now,
                ])
            );
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pages')) {
            DB::table('pages')->whereIn('page_key', ['blog','events','library','media','contact'])->delete();
        }
    }
};
