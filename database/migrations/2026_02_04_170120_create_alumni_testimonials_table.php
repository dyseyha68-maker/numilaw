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
        Schema::create('alumni_testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->constrained()->onDelete('cascade');
            $table->string('title_en');
            $table->string('title_km')->nullable();
            $table->text('content_en');
            $table->text('content_km')->nullable();
            $table->string('photo')->nullable(); // Alumni photo for testimonial
            $table->string('company_at_time')->nullable(); // Company when testimonial was given
            $table->string('position_at_time')->nullable(); // Position when testimonial was given
            $table->integer('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamp('featured_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index(['is_featured', 'is_active']);
            $table->index('featured_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_testimonials');
    }
};
