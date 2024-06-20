<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemesananSeeder extends Seeder
{
    public function run()
    {
        DB::table('pemesanan')->insert([
            [
                'nama_penerima' => 'John Doe',
                'alamat' => 'Jl. Contoh No. 123',
                'ongkir_id' => 1,
                'kota' => 'Jakarta',
                'kode_pos' => '12345',
                'no_telp' => '081234567890',
                'status_bayar' => 'Belum Bayar'
            ],
        ]);
    }
}
