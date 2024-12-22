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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('Name')->default('N/A')->nullable();
            $table->string('address')->default('N/A')->nullable();
            $table->string('City')->default('N/A')->nullable();
            $table->string('State')->default('N/A')->nullable();
            $table->string('Contact')->default('N/A')->nullable();
            $table->string('Zip')->default('N/A')->nullable();
            $table->string('Phone')->default('N/A')->nullable();
            $table->string('Phone2')->default('N/A')->nullable();
            $table->string('mail')->default('N/A')->nullable();
            $table->string('Fax')->default('N/A')->nullable();
            $table->string('Code')->default('N/A')->nullable();
            $table->string('NPI')->default('N/A')->nullable();
            $table->string('FederalTaxID')->default('N/A')->nullable();
            $table->string('TaxIDType')->default('N/A')->nullable();
            $table->string('POSType')->default('N/A')->nullable();
            $table->string('Warehouse')->default('N/A')->nullable();
            $table->string('TaxRate')->default('N/A')->nullable();
            $table->string('Tickets')->default('N/A')->nullable();
            $table->string('Statement')->default('N/A')->nullable();
            $table->string('Provider')->default('N/A')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
