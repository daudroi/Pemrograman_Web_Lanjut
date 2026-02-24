@extends('layout')

@section('title', 'Home Care')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">
        <i class="fas fa-broom me-2"></i>Home Care
    </h1>
    <a href="/" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<p class="text-muted mb-4">Produk perawatan rumah tangga lengkap dan berkualitas</p>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-soap"></i>
                <h6 class="card-title mt-3">Deterjen</h6>
                <p class="card-text small">Deterjen pencuci pakaian terbaik</p>
                <span class="badge-category">Laundry</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-bottle"></i>
                <h6 class="card-title mt-3">Pembersih Lantai</h6>
                <p class="card-text small">Pembersih lantai yang efektif</p>
                <span class="badge-category">Cleaning</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-wind"></i>
                <h6 class="card-title mt-3">Pengharum Ruangan</h6>
                <p class="card-text small">Pengharum ruangan mewah</p>
                <span class="badge-category">Fragrance</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-tissue"></i>
                <h6 class="card-title mt-3">Tissue</h6>
                <p class="card-text small">Tissue premium lembut</p>
                <span class="badge-category">Supplies</span>
            </div>
        </div>
    </div>
</div>
@endsection
