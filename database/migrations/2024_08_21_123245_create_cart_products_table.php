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
        Schema::create('cart_products', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('cartId')->constrained('shopping_carts', 'cartId');
            $table->foreignUuid('productId')->constrained('products', 'productId');
            $table->decimal('amount', 10, 2);
            $table->integer('quantity');
            $table->decimal('line_amount', 10, 2)->storedAs('quantity*amount');     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_products');
    }
};
