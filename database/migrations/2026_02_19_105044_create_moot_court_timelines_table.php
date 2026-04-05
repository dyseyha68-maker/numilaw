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
        Schema::create('moot_court_timelines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moot_court_id')->constrained()->onDelete('cascade');
            $table->string('title_en');
            $table->string('title_km');
            $table->string('type'); // facts_release, complementary_facts, registration, memorial_submission, oral_round
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime')->nullable();
            $table->boolean('is_milestone')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moot_court_timelines');
    }
};
