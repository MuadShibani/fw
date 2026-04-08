<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stat;

class StatSeeder extends Seeder
{
    public function run(): void
    {
        Stat::truncate();

        $items = [
            ['value' => '50+',   'label_en' => 'Startups Supported', 'label_ar' => 'شركة ناشئة مدعومة', 'icon' => 'rocket',       'sort_order' => 1],
            ['value' => '200+',  'label_en' => 'Jobs Created',        'label_ar' => 'فرصة عمل',          'icon' => 'users',        'sort_order' => 2],
            ['value' => '$1.5M', 'label_en' => 'Capital Raised',      'label_ar' => 'رأس مال تم جمعه',   'icon' => 'trending-up',  'sort_order' => 3],
        ];

        Stat::insert($items);
    }
}
