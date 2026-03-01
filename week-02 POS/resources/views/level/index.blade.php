@extends('layout')

@section('title', 'Data Level')

@section('content')
<div class="container-fluid">
    <h1 class="page-title"><i class="fas fa-layer-group me-2"></i>Data Level Pengguna</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-database me-2"></i>Praktikum 4 - DB Facade (Raw SQL)</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <strong>Operasi yang dijalankan:</strong>
                <code>DB::insert()</code>, <code>DB::update()</code>, <code>DB::select()</code>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Level ID</th>
                            <th>Kode Level</th>
                            <th>Nama Level</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $level)
                        <tr>
                            <td>{{ $level->level_id }}</td>
                            <td><span class="badge bg-primary">{{ $level->level_kode }}</span></td>
                            <td>{{ $level->level_nama }}</td>
                            <td>{{ $level->created_at ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <p class="text-muted mt-2 mb-0"><small>Total: {{ count($data) }} data</small></p>
        </div>
    </div>
</div>
@endsection
