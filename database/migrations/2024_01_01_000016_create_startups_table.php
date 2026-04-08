<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('startups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sector', 100);
            $table->text('description_en');
            $table->text('description_ar');
            $table->longText('logo_url');       // URL or uploaded path
            $table->enum('stage', ['Pre-Seed', 'Seed', 'Series A', 'Bootstrapped']);
            $table->string('founder_name', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('startups');
    }
};
