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
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->string('OrderID')->nullable();
            $table->string('DateOfInjury')->nullable();
            $table->string('WorkDate')->nullable();
            $table->string('ConsultDate')->nullable();
            $table->string('Accident')->nullable();
            $table->string('StateInjury')->nullable();
            $table->string('ICD91')->nullable();
            $table->string('ICD92')->nullable();
            $table->string('ICD93')->nullable();
            $table->string('ICD94')->nullable();
            $table->string('ICD101')->nullable();
            $table->string('ICD102')->nullable();
            $table->string('ICD103')->nullable();
            $table->string('ICD104')->nullable();
            $table->string('ICD105')->nullable();
            $table->string('ICD106')->nullable();
            $table->string('ICD107')->nullable();
            $table->string('ICD108')->nullable();
            $table->string('ICD109')->nullable();
            $table->string('ICD1010')->nullable();
            $table->string('ICD1011')->nullable();
            $table->string('ICD1012')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnoses');
    }
};
