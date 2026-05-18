<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WiifMember;

class WiifMemberSeeder extends Seeder
{
    public function run(): void
    {
        WiifMember::truncate();

        $gps = [
            ['name_en' => 'GP 1', 'name_ar' => 'الشريك العام 1', 'role_en' => 'Managing Partner', 'role_ar' => 'شريك إداري', 'bio_en' => 'Brief bio — replace with the real partner profile.', 'bio_ar' => 'نبذة — تستبدل بسيرة الشريك الفعلية.'],
            ['name_en' => 'GP 2', 'name_ar' => 'الشريك العام 2', 'role_en' => 'Investment Partner', 'role_ar' => 'شريك استثماري', 'bio_en' => 'Brief bio — replace with the real partner profile.', 'bio_ar' => 'نبذة — تستبدل بسيرة الشريك الفعلية.'],
        ];
        $committee = [
            ['name_en' => 'Committee Member 1', 'name_ar' => 'عضو اللجنة 1', 'role_en' => 'Chair',  'role_ar' => 'الرئيس',  'bio_en' => 'Brief bio — replace with the real profile.', 'bio_ar' => 'نبذة — تستبدل بالسيرة الفعلية.'],
            ['name_en' => 'Committee Member 2', 'name_ar' => 'عضو اللجنة 2', 'role_en' => 'Member', 'role_ar' => 'عضو',     'bio_en' => 'Brief bio — replace with the real profile.', 'bio_ar' => 'نبذة — تستبدل بالسيرة الفعلية.'],
            ['name_en' => 'Committee Member 3', 'name_ar' => 'عضو اللجنة 3', 'role_en' => 'Member', 'role_ar' => 'عضو',     'bio_en' => 'Brief bio — replace with the real profile.', 'bio_ar' => 'نبذة — تستبدل بالسيرة الفعلية.'],
        ];

        foreach ($gps as $i => $row) {
            WiifMember::create(array_merge($row, ['type' => 'gp', 'sort_order' => $i + 1]));
        }
        foreach ($committee as $i => $row) {
            WiifMember::create(array_merge($row, ['type' => 'committee', 'sort_order' => $i + 1]));
        }
    }
}
