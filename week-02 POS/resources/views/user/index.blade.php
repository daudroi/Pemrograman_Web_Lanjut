@extends('layout')

@section('title', 'Data User')

@section('content')
<div class="container-fluid">
    <h1 class="page-title"><i class="fas fa-users me-2"></i>Data User</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="fas fa-database me-2"></i>Praktikum 6 - Eloquent ORM</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-warning">
                <strong>Operasi yang dijalankan:</strong>
                <code>UserModel::firstOrCreate()</code>, <code>::where()->update()</code>, <code>::with('level')->get()</code>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Level</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $user)
                        <tr>
                            <td>{{ $user->user_id }}</td>
                            <td><strong>{{ $user->username }}</strong></td>
                            <td>{{ $user->nama_lengkap }}</td>
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $user->level->level_nama ?? '-' }}
                                </span>
                            </td>
                            <td>{{ $user->created_at ? $user->created_at->format('d-m-Y H:i') : '-' }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <p class="text-muted mt-2 mb-0"><small>Total: {{ count($data) }} data</small></p>
        </div>
    </div>
</div>
@endsection
