<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Hotel Hidayah</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; color: #333; }
        .navbar-custom { background-color: #ffffff; padding: 15px 0; border-bottom: 1px solid #eaeaea; }
        .btn-kembali { color: #dc3545; font-weight: 600; text-decoration: none; transition: 0.3s; display: inline-flex; align-items: center; }
        .btn-kembali:hover { transform: translateX(-5px); }
        .card-profil { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .form-control { border-radius: 10px; padding: 12px; }
        .btn-simpan { border-radius: 10px; padding: 10px 25px; font-weight: 600; }
        /* Tambahan styling untuk badge username */
        .badge-username { background-color: #e9ecef; color: #495057; font-size: 0.9rem; padding: 6px 12px; border-radius: 6px; border: 1px solid #dee2e6; }
    </style>
</head>
<body>

    <nav class="navbar-custom shadow-sm mb-5 sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ url('/') }}" class="btn-kembali"><i class="fas fa-arrow-left me-2"></i> Beranda</a>
            <span class="fw-bold text-secondary text-uppercase small">Pengaturan Akun</span>
        </div>
    </nav>

    <div class="container mb-5 pb-5">
        <div class="row g-4">
            <div class="col-lg-4 text-center">
                <div class="card card-profil p-4 mb-4">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 100px; height: 100px;">
                        <i class="fas fa-user text-danger fa-3x"></i>
                    </div>
                    <h5 class="fw-bold mb-2">{{ Auth::user()->name }}</h5>
                    
                    <div class="mb-3">
                        <span class="badge-username"><i class="fas fa-user-tag me-1"></i> {{ Auth::user()->username }}</span>
                    </div>

                    <hr>
                    <div class="text-start">
                        <small class="text-muted d-block">Status Akun</small>
                        <span class="badge bg-success shadow-sm">Tamu Terverifikasi</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-4"><i class="fas fa-check-circle me-2"></i> {{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger border-0 shadow-sm mb-4"><i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}</div>
                @endif

                <div class="card card-profil p-4 mb-4">
                    <h5 class="fw-bold mb-4"><i class="fas fa-id-card text-danger me-2"></i> Data Pribadi</h5>
                    <form action="{{ route('tamu.profil.update') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Username</label>
                            <input type="text" name="username" class="form-control" value="{{ Auth::user()->username }}" required>
                            <small class="text-muted" style="font-size: 0.8rem;">*Username ini digunakan untuk Login.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nomor WhatsApp/HP</label>
                            <input type="text" name="no_hp" class="form-control" value="{{ Auth::user()->no_hp }}" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-danger btn-simpan shadow-sm">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>

                <div class="card card-profil p-4">
                    <h5 class="fw-bold mb-4"><i class="fas fa-lock text-danger me-2"></i> Keamanan & Password</h5>
                    <form action="{{ route('tamu.profil.password') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Password Saat Ini</label>
                            <input type="password" name="current_password" class="form-control" placeholder="Masukkan password lama/acak" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Password Baru</label>
                                <input type="password" name="new_password" class="form-control" placeholder="Minimal 6 karakter" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label small fw-bold">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" class="form-control" placeholder="Tulis ulang password baru" required>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-outline-danger btn-simpan">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>