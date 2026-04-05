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
        Schema::create('academic_programs', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_km');
            $table->string('slug')->unique();
            $table->string('degree_type'); // bachelor, master, doctorate, certificate
            $table->text('description_en');
            $table->text('description_km');
            $table->text('admission_requirements_en')->nullable();
            $table->text('admission_requirements_km')->nullable();
            $table->text('curriculum_en')->nullable();
            $table->text('curriculum_km')->nullable();
            $table->integer('duration_years')->default(4);
            $table->string('credits_required')->default('120');
            $table->decimal('tuition_fee', 10, 2)->nullable();
            $table->string('featured_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_programs');
    }
};
