<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        DB::table('produk')->insert([
            [
                'nama' => 'Laptop',
                'harga' => 15000000,
                'stok' => 10,
                'keterangan' => 'Laptop gaming',
                'gambar' => 'laptop.jpeg',
                'kategori_id' => 1
            ],
            [
                'nama' => 'Kaos',
                'harga' => 100000,
                'stok' => 50,
                'keterangan' => 'Kaos polos',
                'gambar' => 'kemeja.jpeg',
                'kategori_id' => 2
            ],
            [
                'nama' => 'Baju Olahraga',
                'harga' => 50000,
                'stok' => 30,
                'keterangan' => 'Jaket khusus untuk olahraga',
                'gambar' => 'ransel.jpeg',
                'kategori_id' => 3
            ],
        ]);
    }
}