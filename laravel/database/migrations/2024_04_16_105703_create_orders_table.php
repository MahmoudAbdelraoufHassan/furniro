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
            $table->foreignId('user_id');
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->enum('status' , ['pending' , 'processing', 'shipped', 'delivered']);
            $table->enum('payment_method' , ['credit card' , 'PayPal', 'cash on delivery']);
            $table->enum('payment_status' , ['paid' , 'pending', 'failed']);
            $table->string('shipping_address')->nullable();
            $table->string('currency')->nullable();
            $table->text('notes')->nullable();
            $table->string('coupon_code')->nullable();
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('tax_amount', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
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
