<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Add Governorates and Beneficiaries stats to the homepage
 * Safe for both fresh and existing installs (uses updateOrInsert).
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('stats')) {
            return;
        }

        $now = now();

        $stats = [
            [
                'value'      => '5',
                'label_en'   => 'Governorates',
                'label_ar'   => 'محافظة',
                'icon'       => 'map',
                'sort_order' => 4,
            ],
            [
                'value'      => '1000+',
                'label_en'   => 'Beneficiaries',
                'label_ar'   => 'مستفيد',
                'icon'       => 'heart',
                'sort_order' => 5,
            ],
        ];

        foreach ($stats as $stat) {
            DB::table('stats')->updateOrInsert(
                ['label_en' => $stat['label_en']],
                array_merge($stat, [
                    'created_at' => $now,
                    'updated_at' => $now,
                ])
            );
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('stats')) {
            DB::table('stats')->whereIn('label_en', ['Governorates', 'Beneficiaries'])->delete();
        }
    }
};
