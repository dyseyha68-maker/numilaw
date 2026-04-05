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
        Schema::create('moot_court_teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moot_court_id')->constrained()->onDelete('cascade');
            $table->string('team_name');
            $table->foreignId('leader_id')->constrained('users')->onDelete('cascade');
            $table->json('members')->nullable();
            $table->string('institution');
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->enum('status', ['registered', 'confirmed', 'withdrawn'])->default('registered');
            $table->integer('total_score')->default(0);
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moot_court_teams');
    }
};
