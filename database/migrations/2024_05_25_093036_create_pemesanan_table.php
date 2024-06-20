<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananTable extends Migration
{
    public function up()
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penerima');
            $table->text('alamat');
            $table->foreignId('ongkir_id')->constrained('ongkir');
            $table->string('kota');
            $table->string('kode_pos');
            $table->string('no_telp');
            $table->string('status_bayar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemesanan');
    }
};