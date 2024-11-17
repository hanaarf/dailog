<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(array(
            array(
                'name' => 'admin',
                'username' => 'adminsungbum',
                'email' => 'admin1@gmail.com',
                'role' => 1,
                'bio' => 'hi im admin',
                'password' => bcrypt('123456')
            ),
            array(
                'name' => 'hana aulia',
                'username' => 'hanaarf',
                'email' => 'hana@gmail.com',
                'role' => 2,
                'bio' => 'Welcome to my blog on dailog',
                'password' => bcrypt('123456')
            ),
        ));
    }
}
