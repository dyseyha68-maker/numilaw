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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('program_id')->nullable()->constrained('academic_programs')->nullOnDelete();
            $table->string('student_id')->unique()->nullable();
            $table->integer('graduation_year');
            $table->string('current_job_title')->nullable();
            $table->string('company')->nullable();
            $table->string('industry')->nullable();
            $table->string('location')->nullable(); // City, Country
            $table->string('phone')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->text('bio')->nullable();
            $table->json('achievements')->nullable(); // JSON array of achievements
            $table->json('skills')->nullable(); // JSON array of skills
            $table->boolean('is_featured')->default(false);
            $table->boolean('contact_consent')->default(true);
            $table->boolean('newsletter_consent')->default(true);
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('cv_file')->nullable(); // Resume/CV file path
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();

            // Indexes for performance
            $table->index(['graduation_year', 'status']);
            $table->index(['is_featured', 'status']);
            $table->index(['company', 'industry']);
            $table->index(['location']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
