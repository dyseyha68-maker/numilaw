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
        Schema::create('moot_court_legal_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('moot_court_id')->constrained()->onDelete('cascade');
            $table->string('title_en');
            $table->string('title_km');
            $table->string('document_type'); // statute, article, section, case_law
            $table->longText('content_en')->nullable();
            $table->longText('content_km')->nullable();
            $table->string('file_path')->nullable();
            $table->string('source')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moot_court_legal_documents');
    }
};
