@extends('layouts.app')

@section('content')
<h2>Praktikum 4.2 — Eloquent ORM: Tabel Guests & RSVP</h2>
<p>
    Menampilkan data <strong>guests</strong> beserta <strong>event</strong> (relasi <code>belongsTo Event</code>)
    dan data <strong>RSVP</strong> (relasi <code>hasOne Rsvp</code>).
</p>
<p><em>Operasi yang dijalankan: INSERT (Guest::firstOrCreate), UPDATE (Guest::where->update), SELECT (Guest::with(['event','rsvp'])->get())</em></p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Tamu</th>
            <th>No HP</th>
            <th>Kategori</th>
            <th>Event</th>
            <th>Tgl Acara</th>
            <th>Checkin</th>
            <th>Souvenir</th>
            <th>Status RSVP</th>
            <th>Jumlah Orang</th>
            <th>Pesan RSVP</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($guests as $guest)
        <tr>
            <td>{{ $guest->id }}</td>
            <td>{{ $guest->name }}</td>
            <td>{{ $guest->phone ?? '-' }}</td>
            <td>{{ $guest->category ?? '-' }}</td>
            <td>{{ $guest->event->title }}</td>
            <td>{{ $guest->event->event_date->format('d-m-Y') }}</td>
            <td>{{ $guest->checkin_status ? '✅' : '❌' }}</td>
            <td>{{ $guest->souvenir_status ? '✅' : '❌' }}</td>
            <td>{{ $guest->rsvp ? $guest->rsvp->attendance_status : '-' }}</td>
            <td>{{ $guest->rsvp ? $guest->rsvp->total_person : '-' }}</td>
            <td>{{ $guest->rsvp ? $guest->rsvp->message : '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
