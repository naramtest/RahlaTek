<?php

use App\Models\Driver;
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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignIdFor(Driver::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('name');
            $table->string('model');
            $table->string('engine_number')->unique();
            $table->string('engine_type');
            $table->string('license_plate')->unique();
            $table->date('registration_expiry_date');
            $table->unsignedInteger('year_of_first_immatriculation');
            $table->string('gearbox');
            $table->string('fuel_type');
            $table->unsignedInteger('number_of_seats');
            $table->unsignedInteger('kilometer');
            $table->json('options')->nullable();
            $table->string('document')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedInteger('inspection_period_days')->nullable();
            $table->boolean('notify_before_inspection')->default(true);
            $table->date('next_inspection_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
