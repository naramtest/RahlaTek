<?php

use App\Enums\Reservation\ReservationStatus;
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
            $table->unsignedBigInteger('total_price')->default(0);
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->foreignId('vehicle_id')->constrained()->restrictOnDelete();
            $table
                ->foreignId('driver_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->text('pickup_address');
            $table->text('destination_address')->nullable();

            $table
                ->string('status')
                ->default(ReservationStatus::Pending->value);
            $table->text('notes')->nullable();
            $table->softDeletes();
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
