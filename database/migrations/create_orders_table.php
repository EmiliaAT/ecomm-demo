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
            $table->id('order_id');
            $table->string('owner_id');
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->foreignId('order_id')
                ->constrained(table: 'orders', column: 'order_id')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('item_id')
                ->constrained(table: 'items', column: 'item_id')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->unsignedBigInteger('quantity');
            $table->timestamps();
            $table->primary(['order_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
    }
};
