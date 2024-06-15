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
        Schema::create('transaksidetail', function (Blueprint $table) {
            $table->id();
            $table->string('notran', 12);
            $table->unsignedBigInteger('produk_id');
            $table->float('harga')->nullable();
            $table->float('jumbel')->nullable();
            $table->timestamps();
            $table->foreign('produk_id')->references('id')->on('produk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksidetail');
    }
};
