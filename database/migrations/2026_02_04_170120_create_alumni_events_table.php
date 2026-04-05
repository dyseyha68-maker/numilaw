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
        Schema::create('alumni_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizer_id')->constrained('users')->onDelete('cascade');
            $table->string('title_en');
            $table->string('title_km')->nullable();
            $table->text('description_en');
            $table->text('description_km')->nullable();
            $table->text('content_en')->nullable(); // Full event content
            $table->text('content_km')->nullable();
            $table->string('slug')->unique();
            $table->string('featured_image')->nullable();
            $table->string('venue');
            $table->string('address');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->integer('max_attendees')->nullable(); // null for unlimited
            $table->integer('current_attendees')->default(0);
            $table->decimal('registration_fee', 10, 2)->default(0);
            $table->string('registration_url')->nullable();
            $table->enum('status', ['upcoming', 'ongoing', 'completed', 'cancelled'])->default('upcoming');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->json('gallery_images')->nullable(); // JSON array of event photos
            $table->softDeletes();
            $table->timestamps();

            $table->index(['status', 'start_datetime']);
            $table->index(['is_featured', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_events');
    }
};
