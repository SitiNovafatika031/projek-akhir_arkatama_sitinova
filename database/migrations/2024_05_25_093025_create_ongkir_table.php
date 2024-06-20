<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOngkirTable extends Migration
{
    public function up()
    {
        Schema::create('ongkir', function (Blueprint $table) {
            $table->id();
            $table->string('dari');
            $table->string('tujuan');
            $table->decimal('biaya', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ongkir');
    }
};