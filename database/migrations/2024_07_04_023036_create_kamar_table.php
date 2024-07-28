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
        Schema::create('kamar', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 10, 2);
            $table->float('luas');
            $table->enum('tipe_kamar', ['putra', 'putri', 'campuran']);
            $table->enum('status', ['tersedia', 'disewa', 'terbooking'])->default('tersedia');
            $table->string('alamat');
            $table->boolean('fasilitas_ac')->default(false);
            $table->boolean('fasilitas_wifi')->default(false);
            $table->boolean('fasilitas_tv')->default(false);
            $table->boolean('fasilitas_perabotan')->default(false);
            $table->boolean('fasilitas_dapur')->default(false);
            $table->boolean('fasilitas_kamar_mandi_dalam')->default(false);
            $table->boolean('fasilitas_keamanan_24_jam')->default(false);
            $table->boolean('fasilitas_tempat_parkir')->default(false);
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};
