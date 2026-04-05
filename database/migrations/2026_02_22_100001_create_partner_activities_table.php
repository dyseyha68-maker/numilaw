<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partner_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_university_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('type', ['mou', 'study_visit', 'exchange', 'seminar', 'workshop', 'meeting', 'conference', 'other']);
            $table->text('description')->nullable();
            $table->date('activity_date');
            $table->string('location')->nullable();
            $table->enum('visibility', ['public', 'internal'])->default('public');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partner_activities');
    }
};
