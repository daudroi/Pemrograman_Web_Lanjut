<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::insert([
            [
                'user_id'          => 2, // Budi Santoso (organizer)
                'title'            => 'Pernikahan Budi & Sari',
                'slug'             => 'pernikahan-budi-sari',
                'groom_name'       => 'Budi Santoso',
                'bride_name'       => 'Sari Dewi',
                'event_date'       => '2026-04-20',
                'location_name'    => 'Gedung Serbaguna Nusantara, Malang',
                'location_maps_url'=> 'https://maps.google.com/?q=Gedung+Nusantara+Malang',
                'theme'            => 'Javanese Traditional',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'user_id'          => 3, // Siti Rahayu (organizer)
                'title'            => 'Pernikahan Rizky & Nurul',
                'slug'             => 'pernikahan-rizky-nurul',
                'groom_name'       => 'Rizky Pratama',
                'bride_name'       => 'Nurul Fadilah',
                'event_date'       => '2026-05-10',
                'location_name'    => 'Ballroom Hotel Bintang Lima, Surabaya',
                'location_maps_url'=> 'https://maps.google.com/?q=Hotel+Bintang+Lima+Surabaya',
                'theme'            => 'Modern Elegant',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);
    }
}
