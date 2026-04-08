<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cohort;

class CohortSeeder extends Seeder
{
    public function run(): void
    {
        Cohort::truncate();

        $items = [
            [
                'name_en'        => 'Cohort 1',
                'name_ar'        => 'الدفعة 1',
                'status'         => 'Completed',
                'start_date'     => '2024-01-01',
                'end_date'       => '2024-06-30',
                'startups_count' => 10,
            ],
            [
                'name_en'        => 'Cohort 2',
                'name_ar'        => 'الدفعة 2',
                'status'         => 'Completed',
                'start_date'     => '2024-07-01',
                'end_date'       => '2024-12-31',
                'startups_count' => 12,
            ],
            [
                'name_en'        => 'Cohort 3',
                'name_ar'        => 'الدفعة 3',
                'status'         => 'Active',
                'start_date'     => '2025-01-01',
                'end_date'       => '2025-06-30',
                'startups_count' => 15,
            ],
        ];

        Cohort::insert($items);
    }
}
