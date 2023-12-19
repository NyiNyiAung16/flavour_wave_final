<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('preorder_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('preorder_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('order_quantity');
            $table->integer('total_price');
            $table->string('preorder_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preorder_details');
    }
};
