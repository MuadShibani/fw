<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::truncate();

        $items = [
            [
                'title_en'          => 'Startup Financial Modeling Workshop',
                'title_ar'          => 'ورشة عمل النمذجة المالية للشركات الناشئة',
                'description_en'    => 'A deep dive into creating robust financial models for early-stage startups.',
                'description_ar'    => 'تعمق في إنشاء نماذج مالية قوية للشركات الناشئة في مراحلها المبكرة.',
                'event_date'        => '2026-03-10',
                'event_time'        => '10:00 AM - 02:00 PM',
                'location_en'       => 'Wathba HQ, Sanaa',
                'location_ar'       => 'مقر وثبة، صنعاء',
                'type'              => 'Workshop',
                'is_virtual'        => false,
                'capacity'          => 30,
                'registered_count'  => 22,
                'registration_link' => 'https://docs.google.com/forms',
            ],
            [
                'title_en'          => 'Investment Readiness Webinar',
                'title_ar'          => 'ندوة عبر الإنترنت حول الجاهزية للاستثمار',
                'description_en'    => 'Learn what angel investors look for and how to prepare your pitch deck.',
                'description_ar'    => 'تعلم ما يبحث عنه المستثمرون الملائكيون وكيفية إعداد عرضك التقديمي.',
                'event_date'        => '2026-03-15',
                'event_time'        => '04:00 PM - 05:30 PM',
                'location_en'       => 'Online (Zoom)',
                'location_ar'       => 'عبر الإنترنت (زوم)',
                'type'              => 'Webinar',
                'is_virtual'        => true,
                'capacity'          => null,
                'registered_count'  => 56,
                'registration_link' => 'https://docs.google.com/forms',
            ],
            [
                'title_en'          => 'Wathba Networking Mixer',
                'title_ar'          => 'لقاء وثبة للتعارف',
                'description_en'    => 'Connect with fellow entrepreneurs, mentors, and industry experts.',
                'description_ar'    => 'تواصل مع زملائك رواد الأعمال والمرشدين وخبراء الصناعة.',
                'event_date'        => '2026-03-20',
                'event_time'        => '05:00 PM - 08:00 PM',
                'location_en'       => 'Coffee Trader, Aden',
                'location_ar'       => 'كوفي تريدر، عدن',
                'type'              => 'Networking',
                'is_virtual'        => false,
                'capacity'          => 50,
                'registered_count'  => 50,
                'registration_link' => 'https://docs.google.com/forms',
            ],
            [
                'title_en'          => 'Cohort 2 Pitch Day',
                'title_ar'          => 'يوم العرض للدفعة الثانية',
                'description_en'    => 'Watch the top 10 startups from our accelerator pitch to investors.',
                'description_ar'    => 'شاهد أفضل 10 شركات ناشئة من مسرعتنا وهي تعرض مشاريعها على المستثمرين.',
                'event_date'        => '2026-04-05',
                'event_time'        => '09:00 AM - 01:00 PM',
                'location_en'       => 'Grand Hotel, Sanaa',
                'location_ar'       => 'فندق جراند، صنعاء',
                'type'              => 'Pitch Day',
                'is_virtual'        => false,
                'capacity'          => null,
                'registered_count'  => 88,
                'registration_link' => 'https://docs.google.com/forms',
            ],
        ];

        Event::insert($items);
    }
}
