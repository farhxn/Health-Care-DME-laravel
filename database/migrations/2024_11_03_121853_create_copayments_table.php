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
        Schema::create('copayments', function (Blueprint $table) {
            $table->id();
            $table->string('PatientID')->nullable();
            $table->string('SignatureFile')->nullable();
            $table->string('MonthsValid')->nullable();
            $table->string('SignatureType')->nullable();
            $table->string('CoPay')->nullable();
            $table->string('Basis')->nullable();
            $table->string('TaxRate')->nullable();
            $table->string('Block12')->nullable();
            $table->string('CoPayDollar')->nullable();
            $table->string('Frequency')->nullable();
            $table->string('InvoiceForm')->nullable();
            $table->string('Block13')->nullable();
            $table->string('Hardship')->nullable();
            $table->string('Deductible')->nullable();
            $table->string('OutPocket')->nullable();
            $table->string('SupplierStandards')->nullable();
            $table->string('HIPPANote')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copayments');
    }
};
