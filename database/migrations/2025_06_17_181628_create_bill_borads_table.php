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
        Schema::create('bill_borads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');

            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location');  // Could later break into city, region, etc.

            $table->string('photo_path');  // Path to billboard image

            // Availability period for the billboard
            $table->date('available_from');
            $table->date('available_to');

            // Pricing model
            $table->decimal('price_per_day', 10, 2);
            $table->decimal('price_per_month', 10, 2)->nullable();

            // Status of billboard
            $table->enum('status', ['available', 'reserved', 'sold'])->default('available');

            $table->timestamps();

            // Helpful indexes for filtering/search
            $table->index(['location']);
            $table->index(['price_per_day']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_borads');
    }
};
