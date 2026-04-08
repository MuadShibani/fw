<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Library;

class LibrarySeeder extends Seeder
{
    public function run(): void
    {
        Library::truncate();

        $items = [
            [
                'title_en'       => 'Wathba Annual Report 2025',
                'title_ar'       => 'التقرير السنوي لوثبة 2025',
                'description_en' => 'Comprehensive analysis of the ecosystem growth.',
                'description_ar' => 'تحليل شامل لنمو منظومة ريادة الأعمال.',
                'type'           => 'document',
                'url'            => '#',
                'file_date'      => '2025-12-30',
                'size'           => '4.2 MB',
            ],
            [
                'title_en'       => 'Entrepreneurship Handbook',
                'title_ar'       => 'دليل ريادة الأعمال',
                'description_en' => 'A guide for new startups in Yemen.',
                'description_ar' => 'دليل للشركات الناشئة الجديدة في اليمن.',
                'type'           => 'document',
                'url'            => '#',
                'file_date'      => '2026-01-15',
                'size'           => '1.5 MB',
            ],
            [
                'title_en'       => 'Demo Day Highlights',
                'title_ar'       => 'مقتطفات يوم العرض',
                'description_en' => 'Video coverage of the first cohort graduation.',
                'description_ar' => 'تغطية فيديو لتخرج الدفعة الأولى.',
                'type'           => 'video',
                'url'            => '#',
                'file_date'      => '2026-01-20',
                'size'           => '150 MB',
            ],
            [
                'title_en'       => 'Workshop Gallery',
                'title_ar'       => 'معرض ورشة العمل',
                'description_en' => 'Photos from the design thinking workshop.',
                'description_ar' => 'صور من ورشة عمل التفكير التصميمي.',
                'type'           => 'image',
                'url'            => 'https://picsum.photos/800/600',
                'file_date'      => '2026-02-05',
                'size'           => '2.4 MB',
            ],
        ];

        Library::insert($items);
    }
}
