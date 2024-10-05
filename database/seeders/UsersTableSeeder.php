<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Seed data for Admin
        DB::table('users')->insert([
            'username' => 'adm123',
            'password' => 'tes123',
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'username' => 'yoga.adelpho',
            'password' => 'Wellcome#24',
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'username' => 'shabrina.hawari',
            'password' => 'Wellcome#24',
            'role' => 'admin',
        ]);

        // Seed data for User
        DB::table('users')->insert([
            'username' => 'usr123',
            'password' => 'tes123',
            'role' => 'user',
        ]);

        DB::table('users')->insert([
            'username' => 'adhityah.anugrah',
            'password' => 'Asetbpjs#24',
            'role' => 'user',
        ]);

        DB::table('users')->insert([
            'username' => 'donesa.rucci',
            'password' => 'Asetbpjs#24',
            'role' => 'user',
        ]);

        DB::table('users')->insert([
            'username' => 'dwi.yunita',
            'password' => 'Asetbpjs#24',
            'role' => 'user',
        ]);

        DB::table('users')->insert([
            'username' => 'ahmad.habibi',
            'password' => 'Asetbpjs#24',
            'role' => 'user',
        ]);
    }
}
