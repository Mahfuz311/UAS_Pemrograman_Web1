<div class="row justify-content-center animate-fade-in">
    <div class="col-md-5">
        
        <div class="card card-custom border-0">
            <div class="card-header-custom bg-white border-0 pb-0">
                <h4 class="fw-bold mb-1"><?= isset($isEdit) ? 'Edit User' : 'Tambah User Baru'; ?></h4>
                <p class="text-muted small">Lengkapi data akun di bawah ini.</p>
            </div>

            <div class="card-body p-4">
                <form action="/aplikasi_manajemen_produk/public/user/<?= isset($isEdit) ? 'update' : 'add' ?>" method="POST">
                    
                    <?php if(isset($isEdit)): ?>
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">USERNAME</label>
                        <input type="text" name="username" class="form-control" value="<?= isset($user) ? $user['username'] : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">ROLE (JABATAN)</label>
                        <select name="role" class="form-select border-2 rounded-3 py-2 bg-light">
                            <option value="user" <?= (isset($user) && $user['role'] == 'user') ? 'selected' : ''; ?>>User Biasa</option>
                            <option value="admin" <?= (isset($user) && $user['role'] == 'admin') ? 'selected' : ''; ?>>Administrator</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">PASSWORD</label>
                        <input type="password" name="password" class="form-control" placeholder="<?= isset($isEdit) ? 'Isi hanya jika ingin ganti password' : 'Wajib diisi'; ?>" <?= isset($isEdit) ? '' : 'required'; ?>>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill py-2 fw-bold shadow-sm">
                            <i class="bi bi-save me-2"></i>Simpan Data
                        </button>
                        <a href="/aplikasi_manajemen_produk/public/user/index" class="btn btn-light rounded-pill py-2 text-muted">
                            Batal
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>