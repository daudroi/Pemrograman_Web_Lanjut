@extends('layout')

@section('title', 'Sales Transaction')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">
        <i class="fas fa-receipt me-2"></i>Sales Transaction
    </h1>
    <a href="/" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<p class="text-muted mb-4">Sistem transaksi Point of Sale</p>

<div class="table-responsive mb-4">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Harga Satuan</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><i class="fas fa-droplet text-primary me-2"></i>Air Mineral 1.5L</td>
                <td>Rp 5.000</td>
                <td>2</td>
                <td><strong>Rp 10.000</strong></td>
            </tr>
            <tr>
                <td>2</td>
                <td><i class="fas fa-mug-hot text-success me-2"></i>Kopi Sachet Premium</td>
                <td>Rp 3.000</td>
                <td>3</td>
                <td><strong>Rp 9.000</strong></td>
            </tr>
            <tr>
                <td>3</td>
                <td><i class="fas fa-cookie text-warning me-2"></i>Snack Pack</td>
                <td>Rp 7.500</td>
                <td>1</td>
                <td><strong>Rp 7.500</strong></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="row justify-content-end">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal:</span>
                    <span>Rp 26.500</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span>Pajak (10%):</span>
                    <span>Rp 2.650</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4" style="font-size: 1.2rem;">
                    <strong>Grand Total:</strong>
                    <strong style="color: var(--secondary);">Rp 29.150</strong>
                </div>
                <button class="btn btn-primary w-100">
                    <i class="fas fa-credit-card me-2"></i>Proses Pembayaran
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
