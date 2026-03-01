@extends('layout')

@section('title', 'Data Kategori')

@section('content')
<div class="container-fluid">
    <h1 class="page-title"><i class="fas fa-tags me-2"></i>Data Kategori Barang</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-database me-2"></i>Praktikum 5 - Query Builder</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-success">
                <strong>Operasi yang dijalankan:</strong>
                <code>DB::table()->insertOrIgnore()</code>, <code>->update()</code>, <code>->get()</code>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Kategori ID</th>
                            <th>Kode Kategori</th>
                            <th>Nama Kategori</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $kategori)
                        <tr>
                            <td>{{ $kategori->kategori_id }}</td>
                            <td><span class="badge bg-success">{{ $kategori->kategori_kode }}</span></td>
                            <td>{{ $kategori->kategori_nama }}</td>
                            <td>{{ $kategori->created_at ?? '-' }}</td>
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
