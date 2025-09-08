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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billboard_id')->constrained('billboards')->onDelete('cascade');
            $table->foreignId('advertiser_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            // Booking period
            $table->date('start_date');
            $table->date('end_date');
            $table->string('video_path');
            $table->enum("admin_approval",['pending', 'approved', 'denied'])->default('pending');
            $table->decimal('net_payment', 10, 2)->default(0);
            // Price and payment
            $table->decimal('price', 10, 2);
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->timestamps();
            // Indexes for search/filter
            $table->index(['payment_status']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
