<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_milestones', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->text('activities_en')->nullable();
            $table->text('activities_ar')->nullable();
            $table->text('output_en')->nullable();
            $table->text('output_ar')->nullable();
            $table->string('timeline_en', 120)->nullable();
            $table->string('timeline_ar', 120)->nullable();
            $table->string('icon', 50)->nullable();
            $table->string('color', 9)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_milestones');
    }
};
