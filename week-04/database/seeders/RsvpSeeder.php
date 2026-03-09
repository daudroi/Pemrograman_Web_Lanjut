<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rsvp;

class RsvpSeeder extends Seeder
{
    public function run(): void
    {
        Rsvp::insert([
            [
                'guest_id'          => 1,
                'attendance_status' => 'attending',
                'total_person'      => 2,
                'message'           => 'Kami akan hadir bersama keluarga.',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'guest_id'          => 2,
                'attendance_status' => 'attending',
                'total_person'      => 1,
                'message'           => 'Selamat menempuh hidup baru!',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'guest_id'          => 3,
                'attendance_status' => 'not_attending',
                'total_person'      => 0,
                'message'           => 'Maaf tidak bisa hadir, semoga lancar.',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'guest_id'          => 4,
                'attendance_status' => 'maybe',
                'total_person'      => 1,
                'message'           => 'Insya Allah hadir.',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
