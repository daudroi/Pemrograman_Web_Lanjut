<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POS System') - POS Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1a5f7a;
            --secondary: #2ecc71;
            --accent: #e74c3c;
            --warn: #f39c12;
            --light: #ecf0f1;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: linear-gradient(90deg, var(--primary) 0%, #2980b9 100%);
            box-shadow: 0 4px 6px rgba(0,0,0,0.15);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: white !important;
            letter-spacing: 0.5px;
        }
        
        .sidebar {
            background: white;
            border-right: 2px solid #ecf0f1;
            min-height: calc(100vh - 56px);
            padding: 20px 0;
            box-shadow: 2px 0 4px rgba(0,0,0,0.05);
        }
        
        .sidebar .nav-link {
            color: var(--primary);
            padding: 12px 20px;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .sidebar .nav-link:hover {
            background-color: #f0f0f0;
            border-left-color: var(--secondary);
            color: var(--secondary);
            padding-left: 24px;
        }
        
        .sidebar .nav-link.active {
            background-color: #e8f8f5;
            border-left-color: var(--secondary);
            color: var(--secondary);
        }
        
        .content {
            padding: 30px;
        }
        
        .page-title {
            color: var(--primary);
            font-weight: 700;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--secondary);
            font-size: 2rem;
        }
        
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 12px;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }
        
        .product-card {
            text-align: center;
            padding: 20px;
        }
        
        .product-card i {
            font-size: 3rem;
            color: var(--secondary);
            margin-bottom: 10px;
        }
        
        .badge-category {
            background: linear-gradient(135deg, var(--secondary) 0%, #27ae60 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }
        
        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--secondary) 0%, #27ae60 100%);
            color: white;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #27ae60 0%, #1e8449 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 204, 113, 0.4);
            color: white;
        }
        
        .btn-outline-secondary {
            color: var(--primary);
            border: 2px solid var(--primary);
        }
        
        .btn-outline-secondary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-sm {
            padding: 6px 12px;
            font-size: 0.875rem;
        }
        
        .table thead {
            background: linear-gradient(90deg, var(--primary) 0%, #2980b9 100%);
            color: white;
        }
        
        .table thead th {
            border: none;
            font-weight: 600;
        }
        
        .table tbody tr:hover {
            background-color: #f5f5f5;
        }
        
        footer {
            background: linear-gradient(90deg, var(--primary) 0%, #2980b9 100%);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }
        
        .user-profile-card {
            background: linear-gradient(135deg, var(--primary) 0%, #2980b9 100%);
            color: white;
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        }
        
        .user-profile-card .profile-id {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="fas fa-shopping-cart"></i>
                POS System
            </a>
            <span class="navbar-text text-white">
                <i class="fas fa-user-circle me-2"></i>Admin
            </span>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <nav class="nav flex-column">
                    <a class="nav-link" href="/">
                        <i class="fas fa-home me-2"></i>Dashboard
                    </a>
                    <a class="nav-link" href="/category/food-beverage">
                        <i class="fas fa-box me-2"></i>Products
                    </a>
                    <a class="nav-link" href="/user/1/name/Admin">
                        <i class="fas fa-user me-2"></i>Profile
                    </a>
                    <a class="nav-link" href="/sales">
                        <i class="fas fa-receipt me-2"></i>Sales
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025/2026 - POS Application | Pemrograman Web Lanjut</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
