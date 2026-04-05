<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('moot_teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participation_id')->constrained('moot_participations')->onDelete('cascade');
            $table->string('team_name');
            $table->string('team_name_local')->nullable();
            $table->string('coach_name')->nullable();
            $table->string('coach_email')->nullable();
            $table->string('coach_image')->nullable();
            $table->string('advisor_name')->nullable();
            $table->string('advisor_image')->nullable();
            $table->string('mentor_name')->nullable();
            $table->string('mentor_image')->nullable();
            $table->enum('team_type', ['main', 'reserve', 'unofficial'])->default('main');
            $table->integer('round_reached')->nullable();
            $table->string('result_en')->nullable();
            $table->string('result_km')->nullable();
            $table->string('awards_en')->nullable();
            $table->string('awards_km')->nullable();
            $table->text('notes')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moot_teams');
    }
};
