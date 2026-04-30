<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('library', function (Blueprint $table) {
            if (!Schema::hasColumn('library', 'cover_url')) {
                $table->longText('cover_url')->nullable()->after('url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('library', function (Blueprint $table) {
            if (Schema::hasColumn('library', 'cover_url')) {
                $table->dropColumn('cover_url');
            }
        });
    }
};
