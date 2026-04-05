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
        Schema::table('moot_courts', function (Blueprint $table) {
            $table->enum('moot_nature', ['public', 'private'])->default('public')->after('status');
            $table->longText('facts_en')->nullable()->after('case_details_km');
            $table->longText('facts_km')->nullable()->after('facts_en');
            $table->longText('legal_issues_en')->nullable()->after('facts_km');
            $table->longText('legal_issues_km')->nullable()->after('legal_issues_en');
            $table->boolean('is_published')->default(false)->after('moot_nature');
            $table->timestamp('published_at')->nullable()->after('is_published');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('moot_courts', function (Blueprint $table) {
            $table->dropColumn([
                'moot_nature',
                'facts_en',
                'facts_km',
                'legal_issues_en',
                'legal_issues_km',
                'is_published',
                'published_at',
            ]);
        });
    }
};
