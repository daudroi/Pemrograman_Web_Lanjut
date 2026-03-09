<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Event;
use App\Models\Rsvp;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function index()
    {
        // ========== INSERT dengan Eloquent ==========
        // Tambahkan tamu baru jika belum ada
        $event = Event::first();

        Guest::firstOrCreate(
            ['qr_token' => 'demo-qr-token-eloquent'],
            [
                'event_id'        => $event->id,
                'name'            => 'Tamu Demo Eloquent',
                'phone'           => '089999999999',
                'category'        => 'Teman',
                'checkin_status'  => false,
                'souvenir_status' => false,
            ]
        );

        // ========== UPDATE dengan Eloquent ==========
        Guest::where('qr_token', 'demo-qr-token-eloquent')
            ->update(['category' => 'VIP']);

        // ========== SELECT dengan Eager Loading ==========
        // Ambil semua tamu beserta data event dan RSVP-nya
        $guests = Guest::with(['event', 'rsvp'])->get();

        return view('guest.index', compact('guests'));
    }
}
