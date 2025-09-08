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
        if (!Schema::hasTable('bookings')) {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('billboard_id');
            $table->unsignedBigInteger('advertiser_id');
            $table->unsignedBigInteger('owner_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('video_path');
            $table->enum('admin_approval', ['pending','approved','denied'])->default('pending');
            $table->decimal('net_payment', 10, 2)->default(0);
            $table->decimal('price', 10, 2);
            $table->enum('payment_status', ['pending','paid','failed','refunded'])->default('pending');
            $table->timestamps();
        });}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
