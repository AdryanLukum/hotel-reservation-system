<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Tamu - Hotel Hidayah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Desain Latar Belakang Modern */
        body { 
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=1920&auto=format&fit=crop'); 
            background-size: cover; 
            background-position: center;
            background-attachment: fixed;
            height: 100vh; 
            display: flex; 
            align-items: center; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Efek Kartu Kaca (Glassmorphism) */
        .card-login { 
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.2); 
            width: 100%; 
            max-width: 420px; 
            margin: auto; 
            padding: 40px 30px;
        }

        .btn-danger { 
            background-color: #dc3545; 
            border: none; 
            padding: 12px; 
            border-radius: 10px; 
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        .form-control {
            padding: 12px 15px;
            border-radius: 10px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
            border-color: #dc3545;
            background-color: #ffffff;
        }

        .input-group-text {
            border-radius: 10px 0 0 10px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-right: none;
            color: #6c757d;
        }

        .form-control {
            border-left: none;
        }

        .lupa-password {
            font-size: 13px;
            font-weight: 600;
            color: #dc3545;
            text-decoration: none;
            transition: 0.3s;
        }

        .lupa-password:hover {
            color: #a52834;
            text-decoration: underline;
        }
        
        .invalid-feedback {
            font-size: 0.8rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container p-3">
        <div class="card card-login">
            <div class="text-center mb-4">
                <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow" style="width: 60px; height: 60px;">
                    <i class="fas fa-hotel fa-2x"></i>
                </div>
                <h4 class="fw-bold text-dark mb-1">HOTEL HIDAYAH</h4>
                <p class="text-muted small">Silakan masuk untuk melanjutkan reservasi</p>
            </div>

            @if(session()->has('success'))
                <div class="alert alert-success small rounded-3"><i class="fas fa-check-circle me-1"></i> {{ session('success') }}</div>
            @endif

            @if(session()->has('loginError'))
                <div class="alert alert-danger small rounded-3"><i class="fas fa-exclamation-circle me-1"></i> {{ session('loginError') }}</div>
            @endif

            <form action="{{ url('/login') }}" method="POST" novalidate>
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Username</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan Username Anda" value="{{ old('username') }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label small fw-bold text-secondary mb-0">Password</label>
                        <a href="#" class="lupa-password" data-bs-toggle="modal" data-bs-target="#modalLupaPassword">Lupa Password?</a>
                    </div>
                    <div class="input-group mt-2 has-validation">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password Anda" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-danger fw-bold fs-6">Masuk Sekarang <i class="fas fa-sign-in-alt ms-1"></i></button>
                </div>
            </form>
            
            <div class="text-center mt-4">
                <p class="small text-muted mb-2">Belum punya akun? <a href="{{ route('register') }}" class="text-danger fw-bold text-decoration-none">Daftar di sini</a></p>
                <a href="{{ url('/') }}" class="small text-secondary text-decoration-none hover-danger"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalLupaPassword" tabindex="-1" aria-labelledby="modalLupaPasswordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark" id="modalLupaPasswordLabel"><i class="fas fa-key text-warning me-2"></i> Lupa Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small">Masukkan Username Anda yang terdaftar. Sistem akan mengarahkan Anda ke WhatsApp Admin untuk mereset password.</p>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Username Anda</label>
                        <input type="text" id="usernameLupa" class="form-control" placeholder="Contoh: adryan123" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success fw-bold px-4" onclick="hubungiAdmin()">
                        <i class="fab fa-whatsapp me-1"></i> Hubungi Admin
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function hubungiAdmin() {
            let usernameTamu = document.getElementById('usernameLupa').value;
            
            if(usernameTamu === "") {
                alert("Mohon isi Username Anda terlebih dahulu!");
                return;
            }

            let noWaAdmin = "6289515812996"; 
            
            let pesan = "Halo Admin Hotel Hidayah. Saya kesulitan login dan butuh bantuan untuk mereset password.\n\nUsername akun saya adalah: *" + usernameTamu + "*\n\nMohon bantuannya, terima kasih.";
            
            let pesanEncoded = encodeURIComponent(pesan);
            let urlWA = "https://wa.me/" + noWaAdmin + "?text=" + pesanEncoded;
            window.open(urlWA, "_blank");
            
            var myModalEl = document.getElementById('modalLupaPassword');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();
        }
    </script>
</body>
</html>