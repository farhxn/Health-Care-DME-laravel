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
        Schema::create('retail_sales', function (Blueprint $table) {
            $table->id();
            $table->string('Date')->default('N/A')->nullable();
            $table->string('SoldBy')->default('N/A')->nullable();
            $table->string('Discount')->default('N/A')->nullable();
            $table->string('Customer')->default('N/A')->nullable();
            $table->string('Address')->default('N/A')->nullable();
            $table->string('City')->default('N/A')->nullable();
            $table->string('State')->default('N/A')->nullable();
            $table->string('ZIP')->default('N/A')->nullable();
            $table->string('Phone')->default('N/A')->nullable();
            $table->string('TaxRate')->default('N/A')->nullable();
            $table->string('per')->default('N/A')->nullable();
            $table->string('Items')->default('N/A')->nullable();
            $table->string('Sub_total')->default('N/A')->nullable();
            $table->string('DiscountPer')->default('N/A')->nullable();
            $table->string('Total')->default('N/A')->nullable();
            $table->string('Tax')->default('N/A')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retail_sales');
    }
};
