<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->year('batch_year');
            $table->string('program');
            $table->text('story_en');
            $table->text('story_kh');
            $table->string('photo')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_experiences');
    }
};
