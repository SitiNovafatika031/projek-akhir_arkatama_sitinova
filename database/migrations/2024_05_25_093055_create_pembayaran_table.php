<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->constrained('pemesanan');
            $table->string('nama_pelanggan');
            $table->decimal('jumlah_transfer', 10, 2);
            $table->string('nama_bank');
            $table->text('keterangan')->nullable();
            $table->date('tanggal');
            $table->string('struk_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};