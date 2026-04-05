<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campus_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_kh');
            $table->string('media_path');
            $table->enum('media_type', ['photo', 'video']);
            $table->enum('category', ['events', 'moot_court', 'graduation', 'clubs', 'general']);
            $table->year('year');
            $table->text('caption_en')->nullable();
            $table->text('caption_kh')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campus_galleries');
    }
};
