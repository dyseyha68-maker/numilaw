<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('academic_programs')->onDelete('cascade');
            $table->integer('year');
            $table->integer('semester');
            $table->string('code')->nullable();
            $table->string('name_en');
            $table->string('name_km');
            $table->text('description_en')->nullable();
            $table->text('description_km')->nullable();
            $table->integer('credits')->default(3);
            $table->string('phase')->nullable(); // Foundation, Development, Specialization, Capstone
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
