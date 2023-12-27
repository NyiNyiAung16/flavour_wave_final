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
        Schema::create('preorders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('order_quantity');
            $table->integer('deliver_price')->nullable()->default(0);
            $table->timestamp('preorder_date');
            $table->boolean('is_urgent')->default(false);
            $table->string('truck_number')->nullable();
            $table->string('date')->nullable();
            $table->integer('capacity')->nullable();
            $table->string('driver_nrc')->nullable();
            $table->string('status')->default('pending');
            $table->integer('delivered_quantity')->default(0);
            $table->text('cancel_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preorders');
    }
};
