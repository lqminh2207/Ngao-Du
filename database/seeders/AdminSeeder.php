<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins') -> insert([
            'name' => 'Lê Quang Minh',
            'email' => 'lqminh2207@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}
