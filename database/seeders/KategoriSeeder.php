<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        DB::table('kategori')->insert([
            ['nama' => 'Pakaian'],
            ['nama' => 'Aksesoris'],
            ['nama' => 'Khusus']
        ]);
    }
}
