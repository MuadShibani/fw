<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wiif_portfolio', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sector_en', 255);
            $table->string('sector_ar', 255);
            $table->text('description_en');
            $table->text('description_ar');
            $table->longText('logo_url');
            $table->date('investment_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wiif_portfolio');
    }
};
