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
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            $table->string('Name')->default('N/A')->nullable();
            $table->string('StatesTax')->default('N/A')->nullable();
            $table->string('CountyTax')->default('N/A')->nullable();
            $table->string('CityTax')->default('N/A')->nullable();
            $table->string('OtherTax')->default('N/A')->nullable();
            $table->string('TotalTax')->default('N/A')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
