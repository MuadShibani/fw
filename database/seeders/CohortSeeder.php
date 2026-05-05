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
                'startups_list'  => self::placeholderStartups(1, 10),
            ],
            [
                'name_en'        => 'Cohort 2',
                'name_ar'        => 'الدفعة 2',
                'status'         => 'Completed',
                'start_date'     => '2024-07-01',
                'end_date'       => '2024-12-31',
                'startups_count' => 10,
                'startups_list'  => self::placeholderStartups(2, 10),
            ],
            [
                'name_en'        => 'Cohort 3',
                'name_ar'        => 'الدفعة 3',
                'status'         => 'Active',
                'start_date'     => '2025-01-01',
                'end_date'       => '2025-06-30',
                'startups_count' => 10,
                'startups_list'  => self::placeholderStartups(3, 10),
            ],
        ];

        foreach ($items as $row) {
            Cohort::create($row);
        }
    }

    /**
     * Generate placeholder startup entries for a cohort.
     * Replace these with real cohort participants via the admin or directly in the seeder.
     */
    private static function placeholderStartups(int $cohortNumber, int $count): array
    {
        $sectors = ['Fintech', 'AgriTech', 'HealthTech', 'EdTech', 'CleanTech', 'E-commerce', 'Logistics', 'AI / SaaS', 'Manufacturing', 'Tourism'];
        $sectorsAr = ['تقنية مالية', 'تقنية زراعية', 'تقنية صحية', 'تقنية تعليمية', 'طاقة نظيفة', 'تجارة إلكترونية', 'لوجستيات', 'ذكاء اصطناعي', 'تصنيع', 'سياحة'];

        $list = [];
        for ($i = 1; $i <= $count; $i++) {
            $sectorIndex = ($i - 1) % count($sectors);
            $list[] = [
                'name'           => "Cohort {$cohortNumber} — Startup {$i}",
                'sector_en'      => $sectors[$sectorIndex],
                'sector_ar'      => $sectorsAr[$sectorIndex],
                'founder_name'   => 'Founder TBD',
                'description_en' => 'Placeholder description — replace with the real pitch summary.',
                'description_ar' => 'وصف افتراضي — يستبدل بالوصف الحقيقي.',
                'logo_url'       => null,
            ];
        }
        return $list;
    }
}
