<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('internship_stories', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->year('batch_year');
            $table->string('company_name');
            $table->string('duration');
            $table->text('story_en');
            $table->text('story_kh');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('internship_stories');
    }
};
