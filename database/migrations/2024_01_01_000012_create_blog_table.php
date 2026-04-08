<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('title_en');
            $table->string('title_ar');
            $table->text('summary_en');
            $table->text('summary_ar');
            $table->longText('content_en');
            $table->longText('content_ar');
            $table->string('author_en', 100);
            $table->string('author_ar', 100);
            $table->longText('image_en')->nullable();
            $table->longText('image_ar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog');
    }
};
