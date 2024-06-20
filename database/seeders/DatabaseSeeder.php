<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(KategoriSeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(OngkirSeeder::class);
        $this->call(PemesananSeeder::class);
        $this->call(PembayaranSeeder::class);
        $this->call(PemesananProdukSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
