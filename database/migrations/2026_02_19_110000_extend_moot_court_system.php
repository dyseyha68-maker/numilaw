<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('student_status', ['active', 'alumni', 'graduated', 'suspended'])->nullable()->after('avatar');
            $table->string('student_id')->nullable()->unique()->after('student_status');
            $table->foreignId('academic_program_id')->nullable()->after('student_id')->constrained()->onDelete('set null');
            $table->integer('academic_year')->nullable()->after('academic_program_id');
            $table->boolean('is_numi_law_student')->default(false)->after('academic_year');
        });

        Schema::table('moot_courts', function (Blueprint $table) {
            $table->longText('complementary_facts_en')->nullable()->after('facts_km');
            $table->longText('complementary_facts_km')->nullable()->after('complementary_facts_en');
            $table->boolean('complementary_facts_published')->default(false)->after('complementary_facts_km');
            $table->timestamp('complementary_facts_published_at')->nullable()->after('complementary_facts_published');
            $table->enum('moot_nature', ['public', 'private'])->default('public')->change();
            $table->json('applicable_laws')->nullable()->after('legal_issues_km');
        });

        Schema::table('moot_court_timelines', function (Blueprint $table) {
            $table->enum('timeline_type', [
                'facts_declaration',
                'complimentary_facts_release',
                'registration',
                'memorial_submission',
                'oral_round',
                'award_ceremony'
            ])->nullable()->after('type')->change();
            $table->boolean('is_locked')->default(false)->after('is_milestone');
            $table->timestamp('locked_at')->nullable()->after('is_locked');
        });

        Schema::create('moot_court_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moot_court_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('team_id')->nullable()->constrained('moot_court_teams')->onDelete('set null');
            $table->enum('registration_status', ['draft', 'submitted', 'under_review', 'approved', 'rejected'])->default('draft');
            $table->text('rejection_reason')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
            $table->unique(['moot_court_id', 'user_id'], 'unique_registration');
        });

        Schema::create('moot_court_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moot_court_id')->constrained()->onDelete('cascade');
            $table->foreignId('team_id')->constrained('moot_court_teams')->onDelete('cascade');
            $table->string('submission_type'); // memorial, reply, sur_rejoinder
            $table->string('file_path');
            $table->string('original_filename');
            $table->integer('version')->default(1);
            $table->enum('status', ['draft', 'submitted', 'late', 'graded'])->default('draft');
            $table->foreignId('submitted_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('submitted_at')->nullable();
            $table->text('feedback')->nullable();
            $table->decimal('score', 8, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('moot_court_eligibility_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moot_court_id')->constrained()->onDelete('cascade');
            $table->boolean('require_active_student_status')->default(true);
            $table->boolean('require_verified_student_id')->default(true);
            $table->integer('max_team_size')->default(5);
            $table->integer('min_team_size')->default(3);
            $table->integer('max_mooters_per_team')->default(3);
            $table->integer('max_researchers_per_team')->default(2);
            $table->text('allowed_programs')->nullable();
            $table->json('additional_requirements')->nullable();
            $table->timestamps();
        });

        Schema::create('moot_court_activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moot_court_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('action'); // registered, submitted, viewed_facts, etc.
            $table->json('metadata')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->index(['moot_court_id', 'created_at']);
            $table->index(['user_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moot_court_activity_logs');
        Schema::dropIfExists('moot_court_eligibility_rules');
        Schema::dropIfExists('moot_court_submissions');
        Schema::dropIfExists('moot_court_registrations');

        Schema::table('moot_court_timelines', function (Blueprint $table) {
            $table->dropColumn(['is_locked', 'locked_at']);
        });

        Schema::table('moot_courts', function (Blueprint $table) {
            $table->dropColumn([
                'complementary_facts_en',
                'complementary_facts_km',
                'complementary_facts_published',
                'complementary_facts_published_at',
                'applicable_laws'
            ]);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'student_status',
                'student_id',
                'academic_program_id',
                'academic_year',
                'is_numi_law_student'
            ]);
        });
    }
};
