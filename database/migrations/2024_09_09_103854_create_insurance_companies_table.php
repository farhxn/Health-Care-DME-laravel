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
        Schema::create('insurance_companies', function (Blueprint $table) {
            $table->id();
            $table->string('Name')->nullable()->default('N/A');
            $table->string('address')->nullable()->default('N/A');
            $table->string('Phone')->nullable()->default('N/A');
            $table->string('Phone2')->nullable()->default('N/A');
            $table->string('Fax')->nullable()->default('N/A');
            $table->string('ContactName')->nullable()->default('N/A');
            $table->string('PriceCode')->nullable()->default('N/A');
            $table->string('Expected')->nullable()->default('N/A');
            $table->string('Bill')->nullable()->default('N/A');
            $table->string('InventoryInvoice')->nullable()->default('N/A');
            $table->string('HAOCodeInvoice')->nullable()->default('N/A');
            $table->string('Type')->nullable()->default('N/A');
            $table->string('Group')->nullable()->default('N/A');
            $table->string('Invoice')->nullable()->default('N/A');
            $table->string('ECSFormat')->nullable()->default('N/A');
            $table->string('Ability')->nullable()->default('N/A');
            $table->string('Availability')->nullable()->default('N/A');
            $table->string('ClaimMD')->nullable()->default('N/A');
            $table->string('Medicaid')->nullable()->default('N/A');
            $table->string('Medicare')->nullable()->default('N/A');
            $table->string('OfficeAlly')->nullable()->default('N/A');
            $table->string('Zirmed')->nullable()->default('N/A');
            $table->string('ParticipatingProvider')->nullable()->default('N/A');
            $table->string('OrderingPhysician')->nullable()->default('N/A');
            $table->string('ReferingPhysician')->nullable()->default('N/A');
            $table->string('RenderingPhysician')->nullable()->default('N/A');
            $table->string('TaxonomyCode')->nullable()->default('N/A');
            $table->string('Prefix')->nullable()->default('N/A');
            $table->string('AbilityPayer')->nullable()->default('N/A');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_companies');
    }
};
