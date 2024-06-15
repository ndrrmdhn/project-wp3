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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->string('nama_produk');
            $table->unsignedBigInteger('kategori_id');
            $table->text('detail');
            $table->double('harga');
            $table->integer('stok');
            $table->double('berat');
            $table->string('foto');
            $table->timestamps();
            $table->foreign('kategori_id')->references('id')->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_produk');
    }
};
