<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/aplikasi_manajemen_produk/public/css/style.css">
</head>
<body class="login-body">

    <div class="login-card animate-fade-in text-center">
        <div class="mb-4">
            <h2 class="fw-bold mb-1" style="color: #4e54c8;">Welcome Back!</h2>
            <p class="text-muted">Silakan masuk ke akun anda</p>
        </div>

        <form action="/aplikasi_manajemen_produk/public/auth/authenticate" method="POST">
            <div class="mb-3 text-start">
                <label class="form-label small fw-bold text-muted">USERNAME</label>
                <input type="text" name="username" class="form-control" placeholder="nama anda" required>
            </div>
            
            <div class="mb-4 text-start">
                <label class="form-label small fw-bold text-muted">PASSWORD</label>
                <input type="password" name="password" class="form-control" placeholder="••••••" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold">Masuk Sekarang</button>
        </form>

        <div class="mt-4 pt-3 border-top">
             <small class="text-muted">&copy; <?= date('Y'); ?> Mahfuz Fauzi Project</small>
        </div>
    </div>

</body>
</html>