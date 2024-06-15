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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('notran', 12);
            $table->boolean('status');
            $table->unsignedBigInteger('anggota_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('tanggal');
            $table->double('total_bayar');
            $table->timestamps();
            $table->foreign('anggota_id')->references('id')->on('anggota');
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
