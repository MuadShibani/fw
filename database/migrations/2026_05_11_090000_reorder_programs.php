<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Reorder the four Wathba components so the homepage and the
 * "Wathba Components" dropdown both show:
 *   1. Social Innovation Lab (SIL)
 *   2. Wathba Accelerator Program (WAP)
 *   3. Yemen Angel Investment Network (YAIN)
 *   4. Wathba Impact Investment Fund (WIIF)
 *
 * Also update the Accelerator title to the longer "Wathba Accelerator
 * Program" so it matches the menu label.
 */
return new class extends Migration
{
    public function up(): void
    {
        $order = [
            'sil'         => 1,
            'accelerator' => 2,
            'yain'        => 3,
            'wiif'        => 4,
        ];
        foreach ($order as $id => $sort) {
            DB::table('programs')->where('id', $id)->update(['sort_order' => $sort]);
        }

        DB::table('programs')->where('id', 'accelerator')->update([
            'title_en' => 'Wathba Accelerator Program',
            'title_ar' => 'برنامج وثبة للتسريع',
        ]);
    }

    public function down(): void
    {
        // Non-destructive — keep new sort_orders.
    }
};
