@extends('layout')

@section('title', 'User Profile')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">
        <i class="fas fa-user-circle me-2"></i>User Profile
    </h1>
    <a href="/" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="user-profile-card">
            <div class="profile-id">ID: {{ $id }}</div>
            <div style="margin-bottom: 30px;">
                <p style="font-size: 1.2rem; margin: 20px 0;"><strong>{{ $name }}</strong></p>
                <p class="mb-0" style="font-size: 0.95rem;">Administrator</p>
            </div>
            <hr style="border-color: rgba(255,255,255,0.3);">
            <div style="margin-top: 20px; text-align: left;">
                <p><i class="fas fa-envelope me-2"></i>admin@possystem.local</p>
                <p><i class="fas fa-phone me-2"></i>+62 812 3456 7890</p>
                <p><i class="fas fa-map-marker-alt me-2"></i>Jakarta, Indonesia</p>
            </div>
        </div>
    </div>
</div>
@endsection
