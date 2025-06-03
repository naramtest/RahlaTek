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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->morphs('payable');
            $table->unsignedBigInteger('amount');
            $table->string('currency_code', 3);
            $table->string('payment_method');
            $table->string('status');
            $table->string('provider_id')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->text('note')->nullable();
            $table->dateTime('paid_at')->nullable();
            // Make payment_method nullable
            $table->string('payment_method')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
