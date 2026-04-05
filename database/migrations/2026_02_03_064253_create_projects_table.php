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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_km');
            $table->string('slug')->unique();
            $table->enum('type', ['club', 'academic_project', 'research_project'])->default('academic_project');
            $table->longText('description_en');
            $table->longText('description_km');
            $table->text('objectives_en')->nullable();
            $table->text('objectives_km')->nullable();
            $table->foreignId('supervisor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', ['active', 'completed', 'suspended'])->default('active');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('featured_image')->nullable();
            $table->foreignId('leader_id')->nullable()->constrained('users')->onDelete('set null');
            $table->json('members')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
