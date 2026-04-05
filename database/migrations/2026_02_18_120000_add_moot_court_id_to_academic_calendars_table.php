<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('academic_calendars', function (Blueprint $table) {
            $table->foreignId('moot_court_id')->nullable()->after('program_id')->constrained('moot_courts')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('academic_calendars', function (Blueprint $table) {
            $table->dropForeign(['moot_court_id']);
            $table->dropColumn('moot_court_id');
        });
    }
};
