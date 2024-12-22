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
        Schema::create('price_codes', function (Blueprint $table) {
            $table->id();
            $table->string('Item')->default('N/A')->nullable();
            $table->string('Insurance')->default('N/A')->nullable();
            $table->string('OrderType')->default('N/A')->nullable();
            $table->string('PredefinedText')->default('N/A')->nullable();
            $table->string('Billable_Price')->default('N/A')->nullable();
            $table->string('AllowablePrice')->default('N/A')->nullable();
            $table->string('Rental_Billable_Price')->default('N/A')->nullable();
            $table->string('RentalAllowablePrice')->default('N/A')->nullable();
            $table->string('RentalType')->default('N/A')->nullable();
            $table->string('Bill_Billable_Code')->default('N/A')->nullable();
            $table->string('DMN/RX')->default('N/A')->nullable();
            $table->string('modifier1')->default('N/A')->nullable();
            $table->string('modifier2')->default('N/A')->nullable();
            $table->string('modifier3')->default('N/A')->nullable();
            $table->string('modifier4')->default('N/A')->nullable();
            $table->string('PriorAuth')->default('N/A')->nullable();
            $table->string('Quantity')->default('N/A')->nullable();
            $table->string('Units')->default('N/A')->nullable();
            $table->string('When')->default('N/A')->nullable();
            $table->string('Converter')->default('N/A')->nullable();
            $table->string('BQuantity')->default('N/A')->nullable();
            $table->string('BUnits')->default('N/A')->nullable();
            $table->string('BWhen')->default('N/A')->nullable();
            $table->string('BConverter')->default('N/A')->nullable();
            $table->string('DQuantity')->default('N/A')->nullable();
            $table->string('DUnits')->default('N/A')->nullable();
            $table->string('DWhen')->default('N/A')->nullable();
            $table->string('DConverter')->default('N/A')->nullable();
            $table->string('ReoccuringSale')->default('N/A')->nullable();
            $table->string('AcceptAssignment')->default('N/A')->nullable();
            $table->string('SpanDates')->default('N/A')->nullable();
            $table->string('BillTOInsurance')->default('N/A')->nullable();
            $table->string('Taxable')->default('N/A')->nullable();
            $table->string('DayDelivery')->default('N/A')->nullable();
            $table->string('LastPeriod')->default('N/A')->nullable();
            $table->string('BillPickUp')->default('N/A')->nullable();
            $table->string('LastMonth')->default('N/A')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE price_codes AUTO_INCREMENT = 1000');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_codes');
    }
};
