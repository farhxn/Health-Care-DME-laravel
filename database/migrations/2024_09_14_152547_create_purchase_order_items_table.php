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
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->string('customer')->nullable();
            $table->string('item')->nullable();
            $table->string('price')->nullable();
            $table->string('orderedQty')->nullable();
            $table->string('backOrder')->nullable();
            $table->string('receivedQty')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('uniqueId')->nullable();
            $table->string('dateReceived')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_items');
    }
};
