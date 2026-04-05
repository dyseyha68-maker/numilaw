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
        Schema::create('moot_court_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moot_court_id')->constrained()->onDelete('cascade');
            $table->foreignId('round_id')->constrained('moot_court_rounds')->onDelete('cascade');
            $table->foreignId('team_id')->constrained('moot_court_teams')->onDelete('cascade');
            $table->foreignId('judge_id')->constrained('moot_court_judges')->onDelete('cascade');
            $table->decimal('score', 8, 2)->default(0);
            $table->json('criteria_scores')->nullable(); // JSON for individual criteria
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->unique(['round_id', 'team_id', 'judge_id'], 'unique_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moot_court_scores');
    }
};
