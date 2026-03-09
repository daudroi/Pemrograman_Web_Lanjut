<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guest;
use Illuminate\Support\Str;

class GuestSeeder extends Seeder
{
    public function run(): void
    {
        // Tamu untuk Event 1
        Guest::insert([
            [
                'event_id'       => 1,
                'name'           => 'Hendra Wijaya',
                'phone'          => '081234567890',
                'category'       => 'Keluarga',
                'qr_token'       => Str::uuid(),
                'checkin_status' => false,
                'souvenir_status'=> false,
                'checkin_time'   => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'event_id'       => 1,
                'name'           => 'Dewi Kartika',
                'phone'          => '082345678901',
                'category'       => 'Keluarga',
                'qr_token'       => Str::uuid(),
                'checkin_status' => true,
                'souvenir_status'=> true,
                'checkin_time'   => now(),
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'event_id'       => 1,
                'name'           => 'Andi Prasetyo',
                'phone'          => '083456789012',
                'category'       => 'Teman',
                'qr_token'       => Str::uuid(),
                'checkin_status' => false,
                'souvenir_status'=> false,
                'checkin_time'   => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // Tamu untuk Event 2
            [
                'event_id'       => 2,
                'name'           => 'Rina Susilowati',
                'phone'          => '084567890123',
                'category'       => 'Keluarga',
                'qr_token'       => Str::uuid(),
                'checkin_status' => false,
                'souvenir_status'=> false,
                'checkin_time'   => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'event_id'       => 2,
                'name'           => 'Doni Setiawan',
                'phone'          => '085678901234',
                'category'       => 'Rekan Kerja',
                'qr_token'       => Str::uuid(),
                'checkin_status' => false,
                'souvenir_status'=> false,
                'checkin_time'   => null,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
