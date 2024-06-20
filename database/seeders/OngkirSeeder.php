<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OngkirSeeder extends Seeder
{
    public function run()
    {
        DB::table('ongkir')->insert([
            ['dari' => 'Jakarta', 'tujuan' => 'Bandung', 'biaya' => 20000],
            ['dari' => 'Jakarta', 'tujuan' => 'Surabaya', 'biaya' => 30000],
        ]);
    }
}
