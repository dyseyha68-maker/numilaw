<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('moot_team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('moot_teams')->onDelete('cascade');
            $table->string('name_en');
            $table->string('name_km')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->enum('role', ['speaker', 'researcher', 'reserve', 'coach', 'observer'])->default('researcher');
            $table->integer('order')->default(0);
            $table->boolean('is_team_lead')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moot_team_members');
    }
};
