<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('moot_participations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moot_id')->constrained('moots')->onDelete('cascade');
            $table->integer('year');
            $table->string('theme_en')->nullable();
            $table->string('theme_km')->nullable();
            $table->string('case_problem_en')->nullable();
            $table->string('case_problem_km')->nullable();
            $table->date('competition_start_date')->nullable();
            $table->date('competition_end_date')->nullable();
            $table->string('venue')->nullable();
            $table->string('host_city')->nullable();
            $table->string('host_country')->nullable();
            $table->enum('status', ['planning', 'registration_open', 'preparing', 'ongoing', 'completed', 'cancelled'])->default('planning');
            $table->text('summary_en')->nullable();
            $table->text('summary_km')->nullable();
            $table->boolean('is_published')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->string('result_en')->nullable();
            $table->string('result_km')->nullable();
            $table->string('achievements_en')->nullable();
            $table->string('achievements_km')->nullable();
            $table->timestamps();

            $table->unique(['moot_id', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moot_participations');
    }
};
