<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    public function run()
    {
        DB::table('sliders')->insert([
            ['image' => 'banner1.png'],
            ['image' => 'banner2.png'],
            ['image' => 'banner3.png']
        ]);
    }
}
