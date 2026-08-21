<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Hotel Hidayah</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Desain Latar Belakang Modern (Sama dengan Login) */
        body { 
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=1920&auto=format&fit=crop'); 
            background-size: cover; 
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh; 
            display: flex; 
            align-items: center; 
            font-family: 'Poppins', sans-serif;
            padding: 40px 0;
        }
        
        /* Efek Kartu Kaca (Glassmorphism) */
        .card-register { 
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.2); 
            width: 100%; 
            max-width: 550px; 
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

        /* Styling Input Group dengan Icon */
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
        
        .invalid-feedback {
            font-size: 0.8rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container p-3">
        <div class="card card-register">
            <div class="text-center mb-4">
                <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow" style="width: 60px; height: 60px;">
                    <i class="fas fa-user-plus fa-2x"></i>
                </div>
                <h4 class="fw-bold text-dark mb-1">DAFTAR AKUN BARU</h4>
                <p class="text-muted small">Lengkapi data diri Anda untuk mulai reservasi</p>
            </div>

            <form action="{{ url('/register') }}" method="POST" novalidate>
                @csrf
                
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Masukkan nama lengkap Anda" value="{{ old('nama_lengkap') }}" required>
                        @error('nama_lengkap') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Username</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Buat username (contoh: adryan123)" value="{{ old('username') }}" required>
                        @error('username') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                </div>
               
                
                <div class="mb-4">
                    <label class="form-label small fw-bold text-secondary">Nomor WhatsApp / HP</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="08xxxxxxxxxx" value="{{ old('no_hp') }}" required>
                        @error('no_hp') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold text-secondary">Password</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Buat Password" required>
                            @error('password') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label small fw-bold text-secondary">Konfirmasi Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Tulis ulang Password" required>
                        </div>
                    </div>
                </div>
                
                <div class="d-grid mt-2">
                    <button type="submit" class="btn btn-danger fw-bold fs-6">Daftar Sekarang <i class="fas fa-arrow-right ms-1"></i></button>
                </div>
            </form>
            
            <div class="text-center mt-4">
                <p class="small text-muted mb-2">Sudah punya akun? <a href="{{ route('login') }}" class="text-danger fw-bold text-decoration-none">Login di sini</a></p>
                <a href="{{ url('/') }}" class="small text-secondary text-decoration-none hover-danger"><i class="fas fa-home me-1"></i> Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</body>
</html>