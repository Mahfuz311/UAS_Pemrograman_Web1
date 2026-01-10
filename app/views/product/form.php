<div class="card mt-3">
    <div class="card-header">
        <?= isset($isEdit) ? 'Edit Produk' : 'Tambah Produk Baru'; ?>
    </div>
    <div class="card-body">
        <form action="/aplikasi_manajemen_produk/public/product/<?= isset($isEdit) ? 'update' : 'add' ?>" method="POST" enctype="multipart/form-data">
            
            <?php if(isset($isEdit)): ?>
                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                <input type="hidden" name="oldImage" value="<?= $product['image'] ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="name" class="form-control" value="<?= isset($product) ? $product['name'] : '' ?>" required>
            </div>
            
            <div class="mb-3">
                <label>Harga (Rp)</label>
                <input type="number" name="price" class="form-control" value="<?= isset($product) ? $product['price'] : '' ?>" required>
            </div>

            <div class="mb-3">
                <label>Stok Barang</label>
                <input type="number" name="stock" class="form-control" value="<?= isset($product) ? $product['stock'] : '' ?>" required>
            </div>
            
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="3"><?= isset($product) ? $product['description'] : '' ?></textarea>
            </div>

            <div class="mb-3">
                <label>Foto Produk</label>
                <input type="file" name="image" class="form-control">
                <?php if(isset($isEdit) && !empty($product['image'])): ?>
                    <small class="text-muted">Gambar saat ini:</small><br>
                    <img src="/aplikasi_manajemen_produk/public/img/<?= $product['image']; ?>" width="100">
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/aplikasi_manajemen_produk/public/product/index" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>