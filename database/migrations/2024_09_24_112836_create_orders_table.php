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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('Patient_ID')->nullable();
            $table->string('Patient_Name')->nullable();
            $table->string('Patient_Last_Name')->nullable();
            $table->string('Address')->nullable();
            $table->string('City')->nullable();
            $table->string('Account')->nullable();
            $table->string('Phone')->nullable();
            $table->string('State')->nullable();
            $table->string('ZIP')->nullable();
            $table->string('Patient_DOB')->nullable();
            $table->string('Email')->nullable();
            $table->string('OrderStatus')->nullable();
            $table->string('Department')->nullable();
            $table->string('AssignUser')->nullable();
            $table->string('Phone2')->nullable();
            $table->string('DrOffice')->nullable();
            $table->string('DrPhone')->nullable();
            $table->string('DrFax')->nullable();
            $table->string('DrNPI')->nullable();
            $table->string('LastCheckUser')->nullable();
            $table->string('CheckedDate')->nullable();
            $table->string('OrderType')->nullable();
            $table->string('Policy1')->nullable();
            $table->string('Policy2')->nullable();
            $table->string('Policy3')->nullable();
            $table->string('Policy4')->nullable();
            $table->string('Items')->nullable();
            $table->string('SignatureFile')->nullable();
            $table->string('MonthsValid')->nullable();
            $table->string('block12')->nullable();
            $table->string('block13')->nullable();
            $table->string('InsuranceEligibility')->nullable();
            $table->string('TaxRate')->nullable();
            $table->string('OutPocket')->nullable();
            $table->string('Basis')->nullable();
            $table->string('InvoiceForm')->nullable();
            $table->string('SupplierStandards')->nullable();
            $table->string('HIPPANote')->nullable();
            $table->string('POS')->nullable();
            $table->string('CreatedBy')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE orders AUTO_INCREMENT = 1000');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
