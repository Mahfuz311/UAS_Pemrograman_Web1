<div class="row align-items-center mb-5">
    <div class="col-md-6">
        <h2 class="fw-bold mb-1">Dashboard Produk</h2>
        <p class="text-muted mb-0">Kelola inventaris toko dengan mudah.</p>
    </div>
    <div class="col-md-6 text-md-end mt-3 mt-md-0">
        <?php if($_SESSION['role'] == 'admin'): ?>
            <a href="/aplikasi_manajemen_produk/public/product/add" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                <i class="bi bi-plus-lg me-2"></i>Tambah Produk
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="card card-custom mb-4">
    <div class="card-body p-2">
        <form action="" method="GET" class="d-flex align-items-center">
            <i class="bi bi-search ms-3 text-muted fs-5"></i>
            <input type="text" name="q" class="form-control border-0 shadow-none bg-transparent" placeholder="Cari nama produk, kategori, atau merk..." value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>" style="height: 50px;">
            <button type="submit" class="btn btn-primary rounded-pill px-4 ms-2">Cari</button>
        </form>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-custom">
        <thead>
            <tr>
                <th class="ps-4">No</th>
                <th>Produk</th> <th>Harga</th>
                <th>Stok</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php $nomor = $start + 1; ?>
                <?php foreach($products as $p): ?>
                <tr>
                    <td class="ps-4 fw-bold text-muted">#<?= $nomor++; ?></td>
                    
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="/aplikasi_manajemen_produk/public/img/<?= !empty($p['image']) ? $p['image'] : 'default.jpg'; ?>" class="img-product me-3">
                            <div>
                                <a href="/aplikasi_manajemen_produk/public/product/detail/<?= $p['id']; ?>" class="d-block fw-bold text-dark text-decoration-none product-link">
                                    <?= $p['name']; ?>
                                </a>
                            </div>
                        </div>
                    </td>

                    <td class="fw-bold text-primary">Rp <?= number_format($p['price']); ?></td>
                    
                    <td>
                        <?php if($p['stock'] < 1): ?>
                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill">Habis</span>
                        <?php else: ?>
                            <div class="d-flex align-items-center">
                                <div class="progress flex-grow-1 me-2" style="height: 6px; width: 60px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= min($p['stock']*2, 100); ?>%"></div>
                                </div>
                                <span class="small fw-bold"><?= $p['stock']; ?> pcs</span>
                            </div>
                        <?php endif; ?>
                    </td>

                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <?php if($p['stock'] > 0): ?>
                                <a href="/aplikasi_manajemen_produk/public/product/buy/<?= $p['id']; ?>" class="btn btn-light btn-sm rounded-circle shadow-sm text-success" title="Beli">
                                    <i class="bi bi-cart-plus-fill"></i>
                                </a>
                            <?php endif; ?>

                            <?php if($_SESSION['role'] == 'admin'): ?>
                                <a href="/aplikasi_manajemen_produk/public/product/edit/<?= $p['id']; ?>" class="btn btn-light btn-sm rounded-circle shadow-sm text-warning" title="Edit">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="/aplikasi_manajemen_produk/public/product/delete/<?= $p['id']; ?>" class="btn btn-light btn-sm rounded-circle shadow-sm text-danger" onclick="return confirm('Hapus data ini?')" title="Hapus">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?> 
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486747.png" width="100" class="mb-3 opacity-50">
                        <p class="text-muted fw-bold">Belum ada data produk</p>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<nav class="mt-5 mb-5">
  <ul class="pagination justify-content-center align-items-center gap-2">

    <?php if($page > 1): ?>
        <li class="page-item">
            <a class="page-link border-0 rounded-pill shadow-sm text-muted fw-bold px-3 py-2" href="?page=<?= $page - 1 ?>&q=<?= isset($_GET['q']) ? $_GET['q'] : '' ?>">
                <i class="bi bi-arrow-left me-1"></i> Prev
            </a>
        </li>
    <?php else: ?>
        <li class="page-item disabled">
            <span class="page-link border-0 rounded-pill text-muted opacity-50 px-3 py-2"><i class="bi bi-arrow-left me-1"></i> Prev</span>
        </li>
    <?php endif; ?>


    <?php for($i=1; $i<=$total_pages; $i++): ?>
        <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
            <a class="page-link border-0 rounded-circle shadow-sm fw-bold mx-1 d-flex align-items-center justify-content-center <?= ($page == $i) ? 'bg-primary text-white' : 'bg-white text-secondary' ?>" 
               href="?page=<?= $i ?>&q=<?= isset($_GET['q']) ? $_GET['q'] : '' ?>" 
               style="width: 40px; height: 40px;">
                <?= $i ?>
            </a>
        </li>
    <?php endfor; ?>


    <?php if($page < $total_pages): ?>
        <li class="page-item">
            <a class="page-link border-0 rounded-pill shadow-sm text-primary fw-bold px-3 py-2" href="?page=<?= $page + 1 ?>&q=<?= isset($_GET['q']) ? $_GET['q'] : '' ?>">
                Next <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </li>
    <?php else: ?>
        <li class="page-item disabled">
            <span class="page-link border-0 rounded-pill text-muted opacity-50 px-3 py-2">Next <i class="bi bi-arrow-right ms-1"></i></span>
        </li>
    <?php endif; ?>

  </ul>
</nav>