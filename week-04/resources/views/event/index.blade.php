@extends('layouts.app')

@section('content')
<h2>Praktikum 4.1 — Eloquent ORM: Tabel Events</h2>
<p>
    Menampilkan data <strong>events</strong> beserta <strong>organizer</strong> (relasi <code>belongsTo User</code>)
    dan jumlah <strong>tamu</strong> (relasi <code>hasMany Guest</code>).
</p>
<p><em>Operasi yang dijalankan: INSERT (Event::create), UPDATE (Event::where->update), SELECT (Event::with(['user','guests'])->get())</em></p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul Acara</th>
            <th>Mempelai Pria</th>
            <th>Mempelai Wanita</th>
            <th>Tanggal Acara</th>
            <th>Lokasi</th>
            <th>Tema</th>
            <th>Organizer</th>
            <th>Role Organizer</th>
            <th>Jumlah Tamu</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $event)
        <tr>
            <td>{{ $event->id }}</td>
            <td>{{ $event->title }}</td>
            <td>{{ $event->groom_name }}</td>
            <td>{{ $event->bride_name }}</td>
            <td>{{ $event->event_date->format('d-m-Y') }}</td>
            <td>{{ $event->location_name }}</td>
            <td>{{ $event->theme }}</td>
            <td>{{ $event->user->name }}</td>
            <td>{{ $event->user->role }}</td>
            <td>{{ $event->guests->count() }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
