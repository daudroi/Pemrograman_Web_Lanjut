@extends('layouts.app')

@section('content')
<h2>Selamat datang di WedBook</h2>
<p>Aplikasi manajemen undangan pernikahan berbasis Eloquent ORM Laravel.</p>
<ul>
    <li><a href="/event">Lihat data Event</a> — demo Eloquent INSERT, UPDATE, SELECT + eager loading relasi <code>belongsTo</code> dan <code>hasMany</code></li>
    <li><a href="/guest">Lihat data Guest & RSVP</a> — demo Eloquent <code>firstOrCreate</code>, UPDATE, SELECT + eager loading relasi <code>hasOne</code></li>
</ul>
@endsection
