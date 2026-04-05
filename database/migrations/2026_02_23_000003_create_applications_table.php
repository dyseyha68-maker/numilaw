<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_applications', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->foreignId('intake_id')->constrained('admission_intakes')->onDelete('cascade');
            $table->foreignId('program_id')->constrained('admission_programs')->onDelete('cascade');
            
            // Personal Info
            $table->string('full_name_en');
            $table->string('full_name_kh');
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('nationality')->default('Cambodian');
            $table->string('id_card_number')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->text('address_en');
            $table->text('address_kh')->nullable();
            
            // Academic Background
            $table->string('previous_school_en');
            $table->string('previous_school_kh')->nullable();
            $table->year('graduation_year');
            $table->decimal('gpa', 3, 2)->nullable();
            $table->string('certificate_path')->nullable();
            
            // Supporting Documents
            $table->string('id_card_path')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('transcript_path')->nullable();
            $table->string('recommendation_letter_path')->nullable();
            
            // Application Status
            $table->enum('status', ['draft', 'submitted', 'under_review', 'accepted', 'rejected', 'withdrawn'])->default('draft');
            $table->text('admin_notes')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            
            // Tracking
            $table->timestamp('submitted_at')->nullable();
            $table->string('ip_address')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_applications');
    }
};
