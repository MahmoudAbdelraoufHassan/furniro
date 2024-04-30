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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('discountPercentage', 10, 2)->nullable();
            $table->decimal('rating', 10, 2)->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('stock')->nullable();
            $table->string('dimensions')->nullable();
            $table->foreignId('category_id')->default(1)->nullable();
            $table->foreignId('supplier_id')->default(1)->nullable();
            $table->foreignId('order_id')->default(1);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->cascadeOnDelete();
            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
