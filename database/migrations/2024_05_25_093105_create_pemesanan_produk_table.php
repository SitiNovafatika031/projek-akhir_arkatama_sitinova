<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemesananProdukTable extends Migration
{
    public function up()
    {
        Schema::create('pemesanan_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->constrained('pemesanan');
            $table->foreignId('produk_id')->constrained('produk');
            $table->decimal('harga', 10, 2);
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemesanan_produk');
    }
};