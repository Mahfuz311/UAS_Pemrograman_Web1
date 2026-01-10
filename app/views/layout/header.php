<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Manajemen Produk</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/aplikasi_manajemen_produk/public/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container d-flex justify-content-between align-items-center">
    
    <div class="d-flex align-items-center gap-4">
        <a class="navbar-brand" href="/aplikasi_manajemen_produk/public/product/index">
            <i class="bi bi-ui-checks-grid me-2"></i>Toko Mahfuz
        </a>

        <?php if(isset($_SESSION['user_id'])): ?>
            <div class="d-none d-md-flex gap-3">
                
                <?php 
                    $current_uri = $_SERVER['REQUEST_URI'];
                    
                    $is_product = (strpos($current_uri, '/product') !== false) ? 'text-primary fw-bold' : 'text-secondary';
                    
                    $is_user = (strpos($current_uri, '/user') !== false) ? 'text-primary fw-bold' : 'text-secondary';
                ?>

                <a href="/aplikasi_manajemen_produk/public/product/index" class="text-decoration-none px-2 py-1 rounded hover-effect <?= $is_product; ?>">
                    Produk
                </a>

                <?php if($_SESSION['role'] == 'admin'): ?>
                    <a href="/aplikasi_manajemen_produk/public/user/index" class="text-decoration-none px-2 py-1 rounded hover-effect <?= $is_user; ?>">
                        Users
                    </a>
                    
                    <?php $is_trx = (strpos($current_uri, '/transaction') !== false) ? 'text-primary fw-bold' : 'text-secondary'; ?>
                    <a href="/aplikasi_manajemen_produk/public/transaction/index" class="text-decoration-none px-2 py-1 rounded hover-effect <?= $is_trx; ?>">
                        Laporan
                    </a>
                <?php endif; ?>

                

            </div>
        <?php endif; ?>
    </div>

    <div class="d-flex align-items-center gap-3">
        <?php if(isset($_SESSION['user_id'])): ?>
            
            <a href="/aplikasi_manajemen_produk/public/auth/profile" class="text-decoration-none d-flex align-items-center gap-2">
                
                <div class="d-none d-md-block text-end lh-sm">
                    <span class="d-block fw-bold text-dark" style="font-size: 0.9rem;">
                        Halo, <?= ucfirst($_SESSION['username']); ?>
                    </span>
                    <span class="d-block text-secondary" style="font-size: 0.7rem; font-weight: 500; letter-spacing: 0.5px;">
                        <?= strtoupper($_SESSION['role']); ?>
                    </span>
                </div>

                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-primary shadow-sm" style="width: 40px; height: 40px;">
                    <i class="bi bi-person-circle fs-5"></i>
                </div>
            </a>
            
            <div class="vr text-secondary d-none d-md-block" style="height: 25px;"></div>

            <a href="/aplikasi_manajemen_produk/public/auth/logout" class="btn btn-outline-danger btn-sm rounded-circle d-flex align-items-center justify-content-center border-0 shadow-sm" style="width: 35px; height: 35px;" title="Keluar">
                <i class="bi bi-power"></i>
            </a>

        <?php endif; ?>
    </div>

  </div>
</nav>

<div class="container main-container animate-fade-in" style="margin-top: 100px; margin-bottom: 50px;">