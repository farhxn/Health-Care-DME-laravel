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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('InvoiceNumber')->nullable();
            $table->string('Payer')->nullable();
            $table->string('Billable')->nullable();
            $table->string('Allowable')->nullable();
            $table->string('Balance')->nullable();
            $table->string('Expected')->nullable();
            $table->string('Allowed')->nullable();
            $table->string('Deductible')->nullable();
            $table->string('Coins')->nullable();
            $table->string('Paid')->nullable();
            $table->string('Actual')->nullable();
            $table->string('PostingDate')->nullable();
            $table->string('CheckDate')->nullable();
            $table->string('Check')->nullable();
            $table->string('ICN')->nullable();
            $table->string('PaymentComment')->nullable();
            $table->string('Company')->nullable();
            $table->string('Tran')->nullable();
            $table->string('Transaction')->nullable();
            $table->string('Amount')->nullable();
            $table->string('Quantity')->nullable();
            $table->string('Taxes')->nullable();
            $table->string('Batches')->nullable();
            $table->string('Comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
