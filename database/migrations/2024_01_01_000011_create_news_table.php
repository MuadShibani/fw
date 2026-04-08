<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('title_en');
            $table->string('title_ar');
            $table->text('summary_en');
            $table->text('summary_ar');
            $table->string('category', 100);
            $table->longText('image_en')->nullable();   // URL or uploaded path
            $table->longText('image_ar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
