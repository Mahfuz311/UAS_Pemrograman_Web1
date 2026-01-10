<div class="row align-items-center mb-5">
    <div class="col-md-6">
        <h2 class="fw-bold mb-1">Manajemen User</h2>
        <p class="text-muted mb-0">Kelola akun admin dan user aplikasi.</p>
    </div>
    <div class="col-md-6 text-md-end mt-3 mt-md-0">
        <a href="/aplikasi_manajemen_produk/public/user/add" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
            <i class="bi bi-person-plus-fill me-2"></i>Tambah User
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-custom">
        <thead>
            <tr>
                <th class="ps-4">No</th>
                <th>Username</th>
                <th>Role</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php $no = 1; foreach($users as $u): ?>
                <tr>
                    <td class="ps-4 fw-bold text-muted">#<?= $no++; ?></td>
                    
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold shadow-sm" 
                                 style="width: 45px; height: 45px; background: linear-gradient(135deg, #e0c3fc 0%, #8ec5fc 100%); color: #fff;">
                                <?= strtoupper(substr($u['username'], 0, 1)); ?>
                            </div>
                            
                            <div>
                                <span class="d-block fw-bold text-dark"><?= $u['username']; ?></span>
                                <?php if($u['id'] == $_SESSION['user_id']): ?>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill" style="font-size: 0.6rem;">YOU</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>

                    <td>
                        <?php if($u['role'] == 'admin'): ?>
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold">
                                <i class="bi bi-shield-lock-fill me-1"></i> ADMIN
                            </span>
                        <?php else: ?>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill fw-bold">
                                <i class="bi bi-person-fill me-1"></i> USER
                            </span>
                        <?php endif; ?>
                    </td>

                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="/aplikasi_manajemen_produk/public/user/edit/<?= $u['id']; ?>" class="btn btn-light btn-sm rounded-circle shadow-sm text-warning" title="Edit">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            
                            <?php if($u['id'] != $_SESSION['user_id']): ?>
                                <a href="/aplikasi_manajemen_produk/public/user/delete/<?= $u['id']; ?>" class="btn btn-light btn-sm rounded-circle shadow-sm text-danger" onclick="return confirm('Yakin hapus user ini?')" title="Hapus">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center py-5 text-muted">Belum ada data user</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>