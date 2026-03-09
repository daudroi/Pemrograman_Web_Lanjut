<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name'       => 'Admin WedBook',
                'email'      => 'admin@wedbook.com',
                'password'   => Hash::make('password123'),
                'role'       => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Budi Santoso',
                'email'      => 'budi@wedbook.com',
                'password'   => Hash::make('password123'),
                'role'       => 'organizer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Siti Rahayu',
                'email'      => 'siti@wedbook.com',
                'password'   => Hash::make('password123'),
                'role'       => 'organizer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Ahmad Fauzi',
                'email'      => 'ahmad@wedbook.com',
                'password'   => Hash::make('password123'),
                'role'       => 'scanner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
