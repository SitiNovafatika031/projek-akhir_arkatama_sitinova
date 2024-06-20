<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 2,
                'name' => 'Paul Julius Oleac',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin12345'),
                'type' => 1,
                'email_verified_at' => Carbon::now(),
                'remember_token' => null,
                'created_at' => Carbon::parse('2021-04-12 12:52:31'),
                'updated_at' => Carbon::parse('2021-05-02 12:00:14'),
            ],
            [
                'id' => 15,
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user12345'),
                'type' => 0,
                'email_verified_at' => Carbon::now(),
                'remember_token' => null,
                'created_at' => Carbon::parse('2021-05-25 08:40:01'),
                'updated_at' => Carbon::parse('2021-05-25 08:40:01'),
            ],
        ]);
    }
}