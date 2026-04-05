<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_intakes', function (Blueprint $table) {
            $table->id();
            $table->string('intake_name_en');
            $table->string('intake_name_kh');
            $table->foreignId('program_id')->constrained('admission_programs')->onDelete('cascade');
            $table->date('application_start');
            $table->date('application_end');
            $table->date('semester_start');
            $table->integer('max_seats');
            $table->boolean('is_open')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_intakes');
    }
};
