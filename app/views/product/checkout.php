<div class="row justify-content-center animate-fade-in">
    <div class="col-md-5">
        
        <div class="card card-custom border-0 shadow-lg">
            <div class="card-header-custom bg-white border-0 text-center pb-0">
                <h4 class="fw-bold mb-1">Konfirmasi Pembelian</h4>
                <p class="text-muted small">Mohon lengkapi data transaksi</p>
            </div>

            <div class="card-body p-4">
                
                <div class="d-flex align-items-center p-3 bg-light rounded-3 mb-4 border">
                    <img src="/aplikasi_manajemen_produk/public/img/<?= !empty($product['image']) ? $product['image'] : 'default.jpg'; ?>" 
                         class="rounded-3 shadow-sm me-3" style="width: 60px; height: 60px; object-fit: cover;">
                    <div>
                        <h6 class="fw-bold text-dark mb-1"><?= $product['name']; ?></h6>
                        <span class="text-primary fw-bold">Rp <?= number_format($product['price']); ?></span>
                    </div>
                </div>

                <form action="/aplikasi_manajemen_produk/public/product/processBuy" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                    <input type="hidden" name="price" value="<?= $product['price']; ?>">

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">NAMA PEMBELI</label>
                        <input type="text" name="buyer_name" class="form-control" value="<?= $_SESSION['username']; ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">CATATAN (OPSIONAL)</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Contoh: Lunas, COD, atau No. HP Pembeli..."></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success rounded-pill py-3 fw-bold shadow-sm">
                            <i class="bi bi-bag-check-fill me-2"></i>Bayar & Proses
                        </button>
                        <a href="javascript:history.back()" class="btn btn-light rounded-pill py-3 text-muted">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>