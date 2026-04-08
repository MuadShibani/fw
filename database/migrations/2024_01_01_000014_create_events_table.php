<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_ar');
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->date('event_date');
            $table->string('event_time', 100);
            $table->string('location_en', 255)->nullable();
            $table->string('location_ar', 255)->nullable();
            $table->enum('type', ['Workshop', 'Webinar', 'Networking', 'Pitch Day']);
            $table->boolean('is_virtual')->default(false);
            $table->unsignedInteger('capacity')->nullable();
            $table->unsignedInteger('registered_count')->default(0);
            $table->text('registration_link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
