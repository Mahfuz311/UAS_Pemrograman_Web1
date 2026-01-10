<div class="row justify-content-center animate-fade-in">
    <div class="col-md-10">
        
        <a href="javascript:history.back()" class="btn btn-dark rounded-pill mb-4 fw-bold px-4 shadow-sm hover-scale">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
        </a>

        <div class="card card-custom border-0" style="min-height: 400px;">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-5 text-center mb-4 mb-md-0">
                        <div class="p-3 bg-light rounded-4 shadow-sm h-100 d-flex align-items-center justify-content-center">
                            <img src="/aplikasi_manajemen_produk/public/img/<?= !empty($product['image']) ? $product['image'] : 'default.jpg'; ?>" 
                                 class="img-fluid rounded-3 shadow" 
                                 style="max-height: 350px; object-fit: contain;">
                        </div>
                    </div>

                    <div class="col-md-7 ps-md-4">
                        <h2 class="fw-bold text-dark mb-2"><?= $product['name']; ?></h2>
                        <div class="mb-3">
                             <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mb-2">
                                ID Produk: #<?= $product['id']; ?>
                            </span>
                        </div>

                        <h3 class="fw-bold text-primary mb-3">
                            Rp <?= number_format($product['price']); ?>
                        </h3>

                        <div class="mb-4">
                            <?php if($product['stock'] > 0): ?>
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="bi bi-check-circle-fill me-1"></i> Stok Tersedia: <?= $product['stock']; ?>
                                </span>
                            <?php else: ?>
                                <span class="badge bg-danger rounded-pill px-3 py-2">
                                    <i class="bi bi-x-circle-fill me-1"></i> Stok Habis
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="mb-5">
                            <h6 class="fw-bold text-muted text-uppercase mb-2" style="letter-spacing: 1px;">Spesifikasi & Deskripsi:</h6>
                            <div class="p-3 bg-light rounded-3 text-secondary" style="line-height: 1.8;">
                                <?= nl2br($product['description']); ?>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-block">
                            <?php if($product['stock'] > 0): ?>
                                <a href="/aplikasi_manajemen_produk/public/product/buy/<?= $product['id']; ?>" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-sm">
                                    <i class="bi bi-cart-plus-fill me-2"></i>Beli Sekarang
                                </a>
                            <?php else: ?>
                                <button class="btn btn-secondary rounded-pill px-5 py-2" disabled>Stok Habis</button>
                            <?php endif; ?>

                            <?php if($_SESSION['role'] == 'admin'): ?>
                                <a href="/aplikasi_manajemen_produk/public/product/edit/<?= $product['id']; ?>" class="btn btn-warning text-white rounded-pill px-4 py-2 fw-bold ms-md-2">
                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>