<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('academic_programs')->onDelete('cascade');
            $table->string('first_name_en');
            $table->string('last_name_en');
            $table->string('first_name_km')->nullable();
            $table->string('last_name_km')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->date('date_of_birth');
            $table->string('nationality');
            $table->text('address');
            $table->string('high_school');
            $table->integer('graduation_year');
            $table->decimal('gpa', 3, 2);
            $table->enum('english_level', ['beginner', 'intermediate', 'advanced', 'fluent']);
            $table->text('motivation_letter');
            $table->text('experience')->nullable();
            $table->text('achievements')->nullable();
            $table->string('reference_name');
            $table->string('reference_email');
            $table->string('reference_phone');
            $table->string('application_reference')->unique();
            $table->enum('status', ['pending', 'reviewing', 'approved', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();

            $table->index('application_reference');
            $table->index('status');
            $table->index('email');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
