@extends('layout')

@section('title', 'Baby & Kid')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">
        <i class="fas fa-teddy-bear me-2"></i>Baby & Kid
    </h1>
    <a href="/" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<p class="text-muted mb-4">Produk bayi dan anak-anak terpercaya dan aman</p>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-child"></i>
                <h6 class="card-title mt-3">Popok Bayi</h6>
                <p class="card-text small">Popok premium untuk kenyamanan bayi</p>
                <span class="badge-category">Baby</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-bottle"></i>
                <h6 class="card-title mt-3">Susu Formula</h6>
                <p class="card-text small">Susu formula bergizi lengkap</p>
                <span class="badge-category">Nutrition</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-cube"></i>
                <h6 class="card-title mt-3">Mainan Anak</h6>
                <p class="card-text small">Mainan edukatif dan aman</p>
                <span class="badge-category">Toys</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-shirt"></i>
                <h6 class="card-title mt-3">Pakaian Bayi</h6>
                <p class="card-text small">Pakaian bayi nyaman dan stylish</p>
                <span class="badge-category">Fashion</span>
            </div>
        </div>
    </div>
</div>
@endsection
