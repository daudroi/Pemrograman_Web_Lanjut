@extends('layout')

@section('title', 'Dashboard')

@section('content')
<h1 class="page-title">
    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
</h1>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card product-card">
            <div class="card-body">
                <i class="fas fa-cube"></i>
                <h5 class="card-title mt-3">Kategori Produk</h5>
                <p class="card-text">Kelola semua kategori produk yang tersedia di sistem POS</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card product-card">
            <div class="card-body">
                <i class="fas fa-chart-bar"></i>
                <h5 class="card-title mt-3">Laporan Penjualan</h5>
                <p class="card-text">Lihat laporan dan analitik penjualan lengkap</p>
            </div>
        </div>
    </div>
</div>

<hr class="my-5">

<div class="alert alert-info">
    <h5><i class="fas fa-info-circle me-2"></i>Selamat Datang di POS System</h5>
    <p class="mb-0">Gunakan menu di sebelah kiri untuk mengakses halaman Produk, Profil User, dan Halaman Penjualan.</p>
</div>
@endsection
