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
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sensor');
            $table->double('tegangan')->default(0); // Tambahkan ini
            $table->double('tekanan')->default(0);  // Tambahkan ini
            $table->double('energi')->default(0);   // Tambahkan ini
            $table->boolean('status')->default(1);
            $table->timestamps(); // Ini yang mencatat hari dan waktu otomatis
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensors');
    }
};
