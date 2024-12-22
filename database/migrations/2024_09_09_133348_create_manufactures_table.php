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
        Schema::create('manufactures', function (Blueprint $table) {
            $table->id();
            $table->string('Manufacture_Name')->default('N/A')->nullable();
            $table->string('Contact')->default('N/A')->nullable();
            $table->string('Account')->default('N/A')->nullable();
            $table->string('Address')->default('N/A')->nullable();
            $table->string('City')->default('N/A')->nullable();
            $table->string('State')->default('N/A')->nullable();
            $table->string('Zip')->default('N/A')->nullable();
            $table->string('Phone')->default('N/A')->nullable();
            $table->string('Phone2')->default('N/A')->nullable();
            $table->string('Fax')->default('N/A')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manufactures');
    }
};
