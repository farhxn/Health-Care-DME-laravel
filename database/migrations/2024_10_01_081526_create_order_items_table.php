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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('item')->nullable();
            $table->string('itemId')->nullable();
            $table->string('uniqueOrderId')->nullable();
            $table->string('patientID')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('priceCode')->nullable();
            $table->string('Type')->nullable();
            $table->string('Bill_Billable_Code')->nullable();
            $table->string('price_Code')->nullable();
            $table->string('modifier1')->nullable();
            $table->string('modifier2')->nullable();
            $table->string('modifier3')->nullable();
            $table->string('modifier4')->nullable();
            $table->string('RentalType')->nullable();
            $table->string('Billable_Price')->nullable();
            $table->string('AllowablePrice')->nullable();
            $table->string('Taxable')->nullable();
            $table->string('Quantity')->nullable();
            $table->string('Units')->nullable();
            $table->string('QuantityOrderType')->nullable();
            $table->string('BQuantity')->nullable();
            $table->string('BUnits')->nullable();
            $table->string('BOrderType')->nullable();
            $table->string('DQuantity')->nullable();
            $table->string('DUnits')->nullable();
            $table->string('PriorAuth')->nullable();
            $table->string('PriorAuthType')->nullable();
            $table->string('AcceptAssignment')->nullable();
            $table->string('ins1')->nullable();
            $table->string('ins2')->nullable();
            $table->string('ins3')->nullable();
            $table->string('ins4')->nullable();
            $table->string('noIns1')->nullable();
            $table->string('HAO')->nullable();
            $table->string('Serial')->nullable();
            $table->string('BillItem')->nullable();
            $table->string('invoice')->nullable();
            $table->string('PriorAuthNo')->nullable();
            $table->string('PriorAuthExpiry')->nullable();
            $table->string('RXExp')->nullable();
            $table->string('DOSFrom')->nullable();
            $table->string('DOSTo')->nullable();
            $table->string('DOSBillingMonth')->nullable();
            $table->string('DXPointer10')->nullable();
            $table->string('SellType')->nullable();
            $table->string('CMN')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
