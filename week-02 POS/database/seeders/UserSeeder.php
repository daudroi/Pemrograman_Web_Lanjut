<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('m_user')->insert([
            [
                'level_id' => 1,
                'username' => 'admin',
                'nama_lengkap' => 'Administrator',
                'password' => Hash::make('password123'),
                'data_lengkap' => null,
            ],
            [
                'level_id' => 2,
                'username' => 'manager',
                'nama_lengkap' => 'Manager Toko',
                'password' => Hash::make('password123'),
                'data_lengkap' => null,
            ],
            [
                'level_id' => 3,
                'username' => 'staff1',
                'nama_lengkap' => 'Staff Kasir Satu',
                'password' => Hash::make('password123'),
                'data_lengkap' => null,
            ],
        ]);
    }
}
