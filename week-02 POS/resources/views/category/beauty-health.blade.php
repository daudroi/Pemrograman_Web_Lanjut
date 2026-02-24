@extends('layout')

@section('title', 'Beauty & Health')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">
        <i class="fas fa-heart me-2"></i>Beauty & Health
    </h1>
    <a href="/" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<p class="text-muted mb-4">Produk kecantikan dan kesehatan berkualitas untuk perawatan diri Anda</p>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-wand-magic-sparkles"></i>
                <h6 class="card-title mt-3">Sabun Wajah</h6>
                <p class="card-text small">Sabun wajah pembersih terbaik</p>
                <span class="badge-category">Beauty</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-hairbrush"></i>
                <h6 class="card-title mt-3">Shampo</h6>
                <p class="card-text small">Shampo berkualitas premium</p>
                <span class="badge-category">Beauty</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-capsules"></i>
                <h6 class="card-title mt-3">Vitamin</h6>
                <p class="card-text small">Suplemen kesehatan kompleks</p>
                <span class="badge-category">Health</span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card h-100 product-card">
            <div class="card-body">
                <i class="fas fa-flask-vial"></i>
                <h6 class="card-title mt-3">Obat-obatan</h6>
                <p class="card-text small">Obat-obatan terpercaya</p>
                <span class="badge-category">Health</span>
            </div>
        </div>
    </div>
</div>
@endsection
