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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('Item')->nullable();
            $table->string('Off_Name')->nullable();
            $table->string('Dob')->nullable();
            $table->string('Location')->nullable();
            $table->string('Insurance')->nullable();
            $table->string('Order_No')->nullable();
            $table->string('Order_Status')->nullable();
            $table->string('Dept')->nullable();
            $table->string('User')->nullable();
            $table->string('resupplyDate')->nullable();
            $table->string('resupplyCat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
