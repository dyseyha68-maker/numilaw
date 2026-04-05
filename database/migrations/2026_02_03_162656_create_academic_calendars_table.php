<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('academic_calendars', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_km');
            $table->text('description_en')->nullable();
            $table->text('description_km')->nullable();
            $table->enum('event_type', ['academic_deadline', 'exam_period', 'holiday', 'registration', 'orientation', 'graduation', 'semester_start', 'semester_end', 'special_event']);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('location')->nullable();
            $table->string('audience'); // students, faculty, all, specific_program
            $table->boolean('is_all_day')->default(false);
            $table->boolean('is_recurring')->default(false);
            $table->string('recurring_pattern')->nullable(); // daily, weekly, monthly
            $table->text('notes_en')->nullable();
            $table->text('notes_km')->nullable();
            $table->string('color_code')->default('#007bff'); // For calendar display
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_calendars');
    }
};
