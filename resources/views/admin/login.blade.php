<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Hotel Hidayah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Tambahan padding 15px agar di HP tidak menempel ke pinggir layar */
        body { background-color: #212529; height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', sans-serif; padding: 15px; }
        
        /* Ubah width menjadi max-width agar fleksibel di layar kecil */
        .login-card { width: 100%; max-width: 400px; border: none; border-radius: 15px; overflow: hidden; }
        
        .card-header { background-color: #dc3545; color: white; padding: 25px; text-align: center; border: none; }
        .btn-admin { background-color: #dc3545; border: none; font-weight: bold; padding: 12px; }
        .btn-admin:hover { background-color: #b02a37; }
        
        
    </style>
</head>
<body>

    <div class="card login-card shadow-lg">
        <div class="card-header">
            <i class="fas fa-user-shield fa-3x mb-3"></i>
            <h4 class="fw-bold m-0">ADMIN LOGIN</h4>
            <small>Sistem Informasi Hotel Hidayah</small>
        </div>
        <div class="card-body p-4">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ url('/admin/login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Username Admin</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-admin w-100 text-white shadow-sm mb-3">MASUK KE DASHBOARD</button>
                <div class="text-center">
                    <a href="/" class="text-muted text-decoration-none small"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>