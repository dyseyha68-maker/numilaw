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
        Schema::create('alumni_donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('USD');
            $table->string('donation_type'); // one-time, recurring, scholarship, infrastructure
            $table->string('campaign')->nullable(); // Specific fundraising campaign
            $table->boolean('is_anonymous')->default(false);
            $table->string('transaction_id')->nullable();
            $table->string('payment_method'); // credit_card, bank_transfer, check, etc.
            $table->date('donation_date');
            $table->text('notes')->nullable();
            $table->string('receipt_url')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['alumni_id', 'donation_date']);
            $table->index(['donation_type', 'is_verified']);
            $table->index(['campaign']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_donations');
    }
};
