<div class="row justify-content-center align-items-center" style="min-height: 75vh;">
    <div class="col-md-5">
        
        <div class="card card-custom border-0 shadow-lg">
            
            <div class="card-header-custom border-0 text-center pt-4 pb-0" style="background: linear-gradient(to bottom, #f8f9fa, #ffffff);">
                
                <div class="mb-3">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm text-white fw-bold" 
                         style="width: 100px; height: 100px; font-size: 2.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: 4px solid white;">
                        <?= strtoupper(substr($user['username'], 0, 1)); ?>
                    </div>
                </div>

                <h4 class="fw-bold text-dark mb-1">Edit Profil</h4>
                <p class="text-muted small">Perbarui data akun anda</p>
            </div>

            <div class="card-body p-4 pt-2">
                <form action="/aplikasi_manajemen_produk/public/auth/updateProfile" method="POST">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-secondary">
                            <i class="bi bi-person-fill me-1 text-primary"></i> USERNAME
                        </label>
                        <input type="text" name="username" class="form-control form-control-lg" value="<?= $user['username']; ?>" required style="font-size: 1rem;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-secondary">
                            <i class="bi bi-key-fill me-1 text-primary"></i> PASSWORD BARU
                        </label>
                        <input type="password" name="password" class="form-control form-control-lg" placeholder="••••••" style="font-size: 1rem;">
                        <div class="form-text text-muted fst-italic ms-1">
                            <small>*Kosongkan jika tidak ingin mengganti password.</small>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small text-secondary">
                            <i class="bi bi-shield-lock-fill me-1 text-primary"></i> ROLE (JABATAN)
                        </label>
                        <div class="d-flex align-items-center p-3 rounded-3 bg-light border">
                            <?php if($user['role'] == 'admin'): ?>
                                <i class="bi bi-patch-check-fill text-primary me-2 fs-5"></i>
                                <span class="fw-bold text-dark">Administrator</span>
                            <?php else: ?>
                                <i class="bi bi-person-badge-fill text-secondary me-2 fs-5"></i>
                                <span class="fw-bold text-dark">User Biasa</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary rounded-pill py-3 fw-bold shadow-sm hover-scale">
                            Simpan Perubahan
                        </button>
                        <a href="/aplikasi_manajemen_produk/public/product/index" class="btn btn-light rounded-pill py-3 text-muted fw-bold">
                            Batal & Kembali
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>