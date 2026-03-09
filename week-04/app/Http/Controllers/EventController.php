<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        // ========== INSERT dengan Eloquent ==========
        // Cek dulu supaya tidak duplikat saat reload
        $existing = Event::where('slug', 'pernikahan-demo-eloquent')->first();

        if (!$existing) {
            // Ambil organizer untuk foreign key
            $organizer = User::where('role', 'organizer')->first();

            Event::create([
                'user_id'          => $organizer->id,
                'title'            => 'Demo Event Eloquent',
                'slug'             => 'pernikahan-demo-eloquent',
                'groom_name'       => 'Aditya Nugraha',
                'bride_name'       => 'Citra Melati',
                'event_date'       => '2026-12-12',
                'location_name'    => 'Gedung Serbaguna Jember',
                'location_maps_url'=> null,
                'theme'            => 'Rustic Garden',
            ]);
        }

        // ========== UPDATE dengan Eloquent ==========
        Event::where('slug', 'pernikahan-demo-eloquent')
            ->update(['theme' => 'Rustic Garden (Updated)']);

        // ========== SELECT dengan Eager Loading ==========
        // Ambil semua event beserta data organizer (relasi belongsTo User)
        // dan jumlah tamu (relasi hasMany Guest)
        $events = Event::with(['user', 'guests'])->get();

        return view('event.index', compact('events'));
    }
}
