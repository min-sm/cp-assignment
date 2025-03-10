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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relationship with User
            $table->decimal('total_amount', 10, 2); // Total amount of the order
            $table->enum('payment_method', ['Cash on Delivery', 'KBZPay']); // Payment method (e.g., cash_on_delivery, kbzpay)
            $table->string('kbzpay_number')->nullable(); // KBZPay number (nullable)
            $table->enum('status', ['pending', 'shipped', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
