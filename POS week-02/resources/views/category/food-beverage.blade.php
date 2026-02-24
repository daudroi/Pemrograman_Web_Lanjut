@extends('layout')

@section('title', 'Food & Beverage')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">
        <i class="fas fa-utensils me-2"></i>Food & Beverage
    </h1>
    <a href="/" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<p class="text-muted mb-4">Daftar lengkap produk Food & Beverage yang tersedia di POS System</p>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-droplet"></i>
                <h6 class="card-title mt-3">Air Mineral</h6>
                <p class="card-text small">Minuman segar untuk kesehatan</p>
                <badge class="badge-category">Food</badge>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-mug-hot"></i>
                <h6 class="card-title mt-3">Kopi</h6>
                <p class="card-text small">Kopi premium pilihan</p>
                <span class="badge-category">Beverage</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-glass-water"></i>
                <h6 class="card-title mt-3">Susu</h6>
                <p class="card-text small">Susu murni berkualitas</p>
                <span class="badge-category">Beverage</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-cookie"></i>
                <h6 class="card-title mt-3">Snack</h6>
                <p class="card-text small">Camilan enak dan bergizi</p>
                <span class="badge-category">Food</span>
            </div>
        </div>
    </div>
</div>
@endsection
