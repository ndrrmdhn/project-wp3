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
        Schema::create('penghuni', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('kamar_id');
            $table->unsignedBigInteger('pemilik_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('kamar_id')->references('id')->on('kamar')->onDelete('cascade');
            $table->foreign('pemilik_id')->references('id')->on('pemilik')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghuni');
    }
};
