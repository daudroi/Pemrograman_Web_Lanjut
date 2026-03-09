<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestController;

// Home
Route::get('/', [HomeController::class, 'index']);

// Praktikum 4.1 - Eloquent ORM: Events (INSERT, UPDATE, SELECT + Relasi User & Guest)
Route::get('/event', [EventController::class, 'index']);

// Praktikum 4.2 - Eloquent ORM: Guests & RSVP (INSERT, UPDATE, SELECT + Relasi Event & Rsvp)
Route::get('/guest', [GuestController::class, 'index']);
