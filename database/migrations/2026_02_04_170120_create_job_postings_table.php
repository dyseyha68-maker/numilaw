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
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->string('company');
            $table->string('location');
            $table->string('job_type'); // full-time, part-time, contract, internship, remote
            $table->string('industry');
            $table->string('experience_level'); // entry-level, mid-level, senior, executive
            $table->decimal('salary_min', 10, 2)->nullable();
            $table->decimal('salary_max', 10, 2)->nullable();
            $table->string('salary_currency', 3)->default('USD');
            $table->string('application_url')->nullable();
            $table->string('application_email')->nullable();
            $table->date('application_deadline')->nullable();
            $table->boolean('is_remote')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('views_count')->default(0);
            $table->integer('applications_count')->default(0);
            $table->timestamp('featured_until')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['is_active', 'created_at']);
            $table->index(['industry', 'job_type']);
            $table->index(['location']);
            $table->index('application_deadline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_postings');
    }
};
