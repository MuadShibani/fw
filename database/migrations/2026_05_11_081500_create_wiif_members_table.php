<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wiif_members', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['gp', 'committee'])->index();
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('role_en')->nullable();
            $table->string('role_ar')->nullable();
            $table->text('bio_en')->nullable();
            $table->text('bio_ar')->nullable();
            $table->longText('image_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wiif_members');
    }
};
