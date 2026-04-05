<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('moot_participations', function (Blueprint $table) {
            $table->enum('status', ['planning', 'registration_open', 'preparing', 'ongoing', 'completed', 'cancelled'])->default('planning')->change();
        });
    }

    public function down(): void
    {
        Schema::table('moot_participations', function (Blueprint $table) {
            $table->enum('status', ['planning', 'preparing', 'ongoing', 'completed', 'cancelled'])->default('planning')->change();
        });
    }
};
