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
        Schema::create('patient_insurances', function (Blueprint $table) {
            $table->id();
            $table->string('Policy')->nullable();
            $table->string('PatientID')->nullable();
            $table->string('Group')->nullable();
            $table->string('Company')->nullable();
            $table->string('Type')->nullable();
            $table->string('Insured')->nullable();
            $table->string('First')->nullable();
            $table->string('Last')->nullable();
            $table->string('DOB')->nullable();
            $table->string('City')->nullable();
            $table->string('State')->nullable();
            $table->string('ZIP')->nullable();
            $table->string('MI')->nullable();
            $table->string('Suffix')->nullable();
            $table->string('Gender')->nullable();
            $table->string('Address')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Mobile')->nullable();
            $table->string('Payment')->nullable();
            $table->string('Eligibility')->nullable();
            $table->string('Basis')->nullable();
            $table->string('Inactive')->nullable();
            $table->string('EligibilityRequested')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_insurances');
    }
};
