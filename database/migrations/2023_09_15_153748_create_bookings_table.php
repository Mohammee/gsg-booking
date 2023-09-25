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
            $table->timestamp('booking_datetime');
            $table->time('startAt');
            $table->time('endAt');
            $table->enum('status', ['accepted', 'denied', 'pending'])->default('pending');
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('seat_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('training_hall_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('workspace_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->integer('booked_seats')->nullable()->default(0);
            $table->timestamps();
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
