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
        Schema::create('moot_court_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // coach, mentor, advisor, researcher, mooter
            $table->string('display_name_en');
            $table->string('display_name_km');
            $table->text('description_en')->nullable();
            $table->text('description_km')->nullable();
            $table->integer('max_per_team')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moot_court_roles');
    }
};
