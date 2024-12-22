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
        Schema::create('doctors_data', function (Blueprint $table) {
            $table->id();
            $table->string('FirstName')->nullable();
            $table->string('LastName')->nullable();
            $table->string('MI')->nullable();
            $table->string('Suffix')->nullable();
            $table->string('Courtesy')->nullable();
            $table->string('Address')->nullable();
            $table->string('City')->nullable();
            $table->string('State')->nullable();
            $table->string('Zip')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Phone2')->nullable();
            $table->string('Fax')->nullable();
            $table->string('UPIN')->nullable();
            $table->string('Medicaid')->nullable();
            $table->string('NPI')->nullable();
            $table->string('License')->nullable();
            $table->string('Expiry')->nullable();
            $table->string('Federal')->nullable();
            $table->string('Other')->nullable();
            $table->string('DES')->nullable();
            $table->string('PECOS')->nullable();
            $table->string('DoctorType')->nullable();
            $table->string('Contact')->nullable();
            $table->string('Title')->nullable();
            $table->string('LastCheck')->nullable();
            $table->string('LastCheckUser')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors_data');
    }
};
