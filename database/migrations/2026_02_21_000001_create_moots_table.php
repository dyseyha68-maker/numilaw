<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('moots', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_km');
            $table->string('slug')->unique();
            $table->string('short_name')->nullable();
            $table->string('acronym')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_km')->nullable();
            $table->string('official_url')->nullable();
            $table->string('organizing_body_en')->nullable();
            $table->string('organizing_body_km')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('cover_image_path')->nullable();
            $table->string('case_file_path')->nullable();
            $table->integer('first_participation_year')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moots');
    }
};
