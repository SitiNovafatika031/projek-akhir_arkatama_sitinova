<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        DB::table('pembayaran')->insert([
            [
                'pemesanan_id' => 1,
                'nama_pelanggan' => 'John Doe',
                'jumlah_transfer' => 50000,
                'nama_bank' => 'BCA',
                'tanggal' => now(),
                'struk_pembayaran' => 'struk_pembayaran.jpg'
            ],
        ]);
    }
}
