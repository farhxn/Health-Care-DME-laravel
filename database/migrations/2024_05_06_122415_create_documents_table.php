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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('docType')->nullable();
            $table->string('subDocType')->nullable();
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->string('desc')->nullable();
            $table->string('ptName')->nullable();
            $table->string('ptDr')->nullable();
            $table->string('ptAcc')->nullable();
            $table->string('ptOrder')->nullable();
            $table->string('fromDate')->nullable();
            $table->string('toDate')->nullable();
            $table->string('freq')->nullable();
            $table->string('img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
