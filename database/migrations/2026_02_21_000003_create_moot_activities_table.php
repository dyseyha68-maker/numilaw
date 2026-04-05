<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('moot_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participation_id')->constrained('moot_participations')->onDelete('cascade');
            $table->string('title_en');
            $table->string('title_km')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_km')->nullable();
            $table->date('activity_date')->nullable();
            $table->string('location')->nullable();
            $table->enum('activity_type', ['training', 'submission', 'preliminary', 'quarterfinal', 'semifinal', 'final', 'ceremony', 'announcement', 'meeting', 'other'])->default('other');
            $table->integer('order')->default(0);
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moot_activities');
    }
};
