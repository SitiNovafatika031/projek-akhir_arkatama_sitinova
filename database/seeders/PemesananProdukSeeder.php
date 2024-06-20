<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemesananProdukSeeder extends Seeder
{
    public function run()
    {
        DB::table('pemesanan_produk')->insert([
            [
                'pemesanan_id' => 1,
                'produk_id' => 1,
                'harga' => 15000000,
                'jumlah' => 1
            ],
        ]);
    }
}
