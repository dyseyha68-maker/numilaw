<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_kh');
            $table->enum('degree_level', ['bachelor', 'master', 'doctorate']);
            $table->string('duration_en');
            $table->string('duration_kh');
            $table->text('description_en');
            $table->text('description_kh');
            $table->text('requirements_en');
            $table->text('requirements_kh');
            $table->string('tuition_en');
            $table->string('tuition_kh');
            $table->boolean('scholarship_available')->default(false);
            $table->text('scholarship_info_en')->nullable();
            $table->text('scholarship_info_kh')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_programs');
    }
};
