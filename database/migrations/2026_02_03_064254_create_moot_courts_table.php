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
        Schema::create('moot_courts', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_km');
            $table->string('slug')->unique();
            $table->longText('case_summary_en');
            $table->longText('case_summary_km');
            $table->text('case_details_en')->nullable();
            $table->text('case_details_km')->nullable();
            $table->date('competition_date');
            $table->string('location');
            $table->string('document_pdf')->nullable();
            $table->enum('status', ['upcoming', 'ongoing', 'completed', 'cancelled'])->default('upcoming');
            $table->foreignId('organizer_id')->constrained('users')->onDelete('cascade');
            $table->datetime('registration_deadline')->nullable();
            $table->text('rules_en')->nullable();
            $table->text('rules_km')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moot_courts');
    }
};
