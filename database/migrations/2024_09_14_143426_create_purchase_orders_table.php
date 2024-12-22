<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('Cost')->nullable();
            $table->string('Freight')->nullable();
            $table->string('Vendor')->nullable();
            $table->string('Vendor_Account')->nullable();
            $table->string('Confirm')->nullable();
            $table->string('Tax')->nullable();
            $table->string('Total_Due')->nullable();
            $table->string('Billing_Address')->nullable();
            $table->string('Shipping_Address')->nullable();
            $table->string('Order_Patient')->nullable();
            $table->string('Items')->nullable();
            $table->string('dropShip')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE purchase_orders AUTO_INCREMENT = 1000');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
