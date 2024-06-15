<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemilikTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pemilik', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

        Schema::table('kamar', function (Blueprint $table) {
            $table->unsignedBigInteger('pemilik_id')->nullable()->after('id');
            $table->foreign('pemilik_id')->references('id')->on('pemilik')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('kamar', function (Blueprint $table) {
            $table->dropForeign(['pemilik_id']);
            $table->dropColumn('pemilik_id');
        });

        Schema::dropIfExists('pemilik');
    }
}
