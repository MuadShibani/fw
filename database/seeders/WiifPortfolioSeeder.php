<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WiifPortfolio;

class WiifPortfolioSeeder extends Seeder
{
    public function run(): void
    {
        WiifPortfolio::truncate();

        $items = [
            [
                'name'            => 'EcoYemen',
                'sector_en'       => 'Green Energy',
                'sector_ar'       => 'الطاقة الخضراء',
                'description_en'  => 'Providing affordable solar solutions to off-grid communities across Yemen.',
                'description_ar'  => 'تقديم حلول شمسية بأسعار معقولة للمجتمعات غير المتصلة بالشبكة في جميع أنحاء اليمن.',
                'logo_url'        => 'https://via.placeholder.com/100',
                'investment_date' => '2024-05-10',
            ],
        ];

        WiifPortfolio::insert($items);
    }
}
