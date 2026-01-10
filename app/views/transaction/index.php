<?php
    $total_omset = 0;
    $total_trx = count($transactions);
    foreach($transactions as $t) $total_omset += $t['price'];
?>

<div class="row mb-4 animate-fade-in">
    <div class="col-md-6 mb-3">
        <div class="card card-custom border-0 text-white shadow" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
            <div class="card-body p-4">
                <h6 class="text-uppercase mb-2 opacity-75 fw-bold">Total Pendapatan</h6>
                <h2 class="fw-bold mb-0">Rp <?= number_format($total_omset); ?></h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mb-3">
        <div class="card card-custom border-0 text-white shadow" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="card-body p-4">
                <h6 class="text-uppercase mb-2 opacity-75 fw-bold">Barang Terjual</h6>
                <h2 class="fw-bold mb-0"><?= $total_trx; ?> <span class="fs-6">Unit</span></h2>
            </div>
        </div>
    </div>
</div>

<div class="row align-items-center mb-4">
    <div class="col-md-6">
        <h3 class="fw-bold mb-1">Laporan Penjualan</h3>
        <p class="text-muted mb-0">Rekapitulasi riwayat transaksi toko.</p>
    </div>
    <div class="col-md-6 text-md-end">
        
        <a href="/aplikasi_manajemen_produk/public/transaction/clear" 
           class="btn btn-danger rounded-pill px-4 py-2 shadow-sm me-2 print-btn"
           onclick="return confirm('PERINGATAN KERAS!\n\nApakah anda yakin ingin MENGHAPUS SEMUA riwayat transaksi?\nData yang dihapus tidak dapat dikembalikan!')">
            <i class="bi bi-trash-fill me-2"></i>Reset
        </a>

        <button onclick="window.print()" class="btn btn-dark rounded-pill px-4 py-2 shadow-sm print-btn">
            <i class="bi bi-printer-fill me-2"></i>Cetak
        </button>
        
    </div>
</div>

<div class="table-responsive">
    <table class="table table-custom">
        <thead>
            <tr>
                <th class="ps-4">No</th>
                <th>Tanggal</th>
                <th>Info Pembeli</th> <th>Produk</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($transactions)): ?>
                <?php $no = 1; foreach($transactions as $t): ?>
                <tr>
                    <td class="ps-4 fw-bold text-muted">#<?= $no++; ?></td>
                    
                    <td>
                        <div class="text-muted small fw-bold">
                            <i class="bi bi-calendar3 me-1"></i> <?= date('d M Y', strtotime($t['created_at'])); ?>
                            <br>
                            <i class="bi bi-clock me-1"></i> <?= date('H:i', strtotime($t['created_at'])); ?>
                        </div>
                    </td>

                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-person-circle text-secondary fs-5"></i>
                            <div>
                                <span class="fw-bold text-dark d-block"><?= ucfirst($t['buyer_name'] ? $t['buyer_name'] : $t['username']); ?></span>
                                <?php if(!empty($t['notes'])): ?>
                                    <small class="text-muted fst-italic" style="font-size: 0.75rem;">Note: <?= $t['notes']; ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>

                    <td>
                        <div class="d-flex align-items-center">
                            <img src="/aplikasi_manajemen_produk/public/img/<?= !empty($t['image']) ? $t['image'] : 'default.jpg'; ?>" 
                                 class="rounded-3 shadow-sm me-3" style="width: 40px; height: 40px; object-fit: cover;">
                            <span class="fw-bold text-dark"><?= $t['product_name']; ?></span>
                        </div>
                    </td>

                    <td>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-bold" style="font-size: 0.9rem;">
                            + Rp <?= number_format($t['price']); ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">Belum ada transaksi</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<style>
@media print {
    .navbar, .print-btn, footer, .btn {
        display: none !important;
    }
    body {
        background: white;
        color: black;
    }
    .card-custom {
        border: 1px solid #ddd;
        box-shadow: none !important;
    }
    .main-container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }
}
</style>