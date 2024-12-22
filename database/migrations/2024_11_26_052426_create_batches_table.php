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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('OrderID')->nullable();
            $table->string('PatientID')->nullable();
            $table->string('BatchNumber')->nullable();
            $table->string('Status')->nullable();
            $table->string('Created')->nullable();
            $table->string('BatchStatus')->nullable();
            $table->string('Item')->nullable();
            $table->string('Balance')->nullable();
            $table->string('BillingCode')->nullable();
            $table->string('InvoiceDate')->nullable();
            $table->string('HAO')->nullable();
            $table->string('Modifier1')->nullable();
            $table->string('Modifier2')->nullable();
            $table->string('Modifier3')->nullable();
            $table->string('Modifier4')->nullable();
            $table->string('From')->nullable();
            $table->string('To')->nullable();
            $table->string('BillingMonth')->nullable();
            $table->string('BillableAmount')->nullable();
            $table->string('AllowedAmount')->nullable();
            $table->string('Quantity')->nullable();
            $table->string('Taxes')->nullable();
            $table->string('Ins1')->nullable();
            $table->string('Ins2')->nullable();
            $table->string('Ins3')->nullable();
            $table->string('Ins4')->nullable();
            $table->string('NoPay')->nullable();
            $table->string('Dx10')->nullable();
            $table->string('PriorAuthType')->nullable();
            $table->string('PriorAuth')->nullable();
            $table->string('SpecialCode')->nullable();
            $table->string('ReviewCode')->nullable();
            $table->string('CMNRX')->nullable();
            $table->string('AcceptAssignment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
