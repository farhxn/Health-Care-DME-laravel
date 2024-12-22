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
        Schema::create('inventories', function (Blueprint $table) {
             $table->id();
            $table->string('Manufacturer')->default('N/A')->nullable();
            $table->string('Barcode_Type')->default('N/A')->nullable();
            $table->string('Predefined_Text')->default('N/A')->nullable();
            $table->string('Model')->default('N/A')->nullable();
            $table->string('Product_Type')->default('N/A')->nullable();
            $table->string('Barcode')->default('N/A')->nullable();
            $table->string('Vendor')->default('N/A')->nullable();
            $table->string('Purchase_Price')->default('N/A')->nullable();
            $table->string('MAP_Price')->default('N/A')->nullable();
            $table->string('MSRPPrice')->default('N/A')->nullable();
            $table->string('TotalSellItems')->default('N/A')->nullable();
            $table->string('InStockQty')->default('N/A')->nullable();
            $table->string('Inv_Code')->default('N/A')->nullable();
            $table->string('Basis')->default('N/A')->nullable();
            $table->string('Frequency')->default('N/A')->nullable();
            $table->string('Item_Name')->default('N/A')->nullable();
            $table->string('Inventory_Code')->default('N/A')->nullable();
            $table->string('O2Tank')->default('N/A')->nullable();
            $table->string('Service')->default('N/A')->nullable();
            $table->string('Serialized')->default('N/A')->nullable();
            $table->string('Inactive')->default('N/A')->nullable();
            $table->string('PaidAt')->default('N/A')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE inventories AUTO_INCREMENT = 1000');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
