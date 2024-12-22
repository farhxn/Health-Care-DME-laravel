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
        Schema::create('serial_numbers', function (Blueprint $table) {
            $table->id();
            $table->string('SerialNumber')->default('N/A')->nullable();
            $table->string('InventoryCode')->default('N/A')->nullable();
            $table->string('Status')->default('N/A')->nullable();
            $table->string('Warranty')->default('N/A')->nullable();
            $table->string('WarrantyLength')->default('N/A')->nullable();
            $table->string('Manufacturer')->default('N/A')->nullable();
            $table->string('ManufacturerSerialNumber')->default('N/A')->nullable();
            $table->string('Model')->default('N/A')->nullable();
            $table->string('Warehouse')->default('N/A')->nullable();
            $table->string('PurchaseAmount')->default('N/A')->nullable();
            $table->string('PurchaseDate')->default('N/A')->nullable();
            $table->string('SoldDate')->default('N/A')->nullable();
            $table->string('NextMaintenanceDate')->default('N/A')->nullable();
            $table->string('MonthsRented')->default('N/A')->nullable();
            $table->string('CurrentCustomer')->default('N/A')->nullable();
            $table->string('LastCustomer')->default('N/A')->nullable();
            $table->string('LotNumber')->default('N/A')->nullable();
            $table->string('FirstRented')->default('N/A')->nullable();
            $table->string('OwnRent')->default('N/A')->nullable();
            $table->string('Vendor')->default('N/A')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serial_numbers');
    }
};
