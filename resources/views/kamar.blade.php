<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kamar - Hotel Hidayah</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; color: #333; }
        
        /* Navbar */
        .navbar { background-color: rgba(255, 255, 255, 0.98) !important; backdrop-filter: blur(10px); transition: all 0.3s ease; z-index: 1030;}
        .navbar-brand { color: #dc3545 !important; font-weight: 700; font-size: 1.4rem; }
        .nav-link { color: #555 !important; font-weight: 500; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: #dc3545 !important; }

        /* Header Minimalis */
        .header-kamar {
            background: linear-gradient(135deg, #111, #dc3545);
            padding: 80px 0 100px 0;
            color: white;
            text-align: center;
            position: relative;
        }

        /* Form Pencarian ala OTA */
        .search-box-container {
            margin-top: -60px;
            position: relative;
            z-index: 10;
            margin-bottom: 25px; /* Sedikit dikurangi agar alert pesan tidak terlalu jauh */
        }
        .search-box {
            background: white;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            padding: 25px;
        }

        /* Card Kamar Interaktif */
        .kamar-card { border: none; border-radius: 16px; overflow: hidden; transition: all 0.3s ease; background: white; }
        .kamar-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
        .img-wrapper { overflow: hidden; position: relative; }
        .card-img-top { height: 220px; object-fit: cover; transition: transform 0.5s ease; }
        .kamar-card:hover .card-img-top { transform: scale(1.08); }

        .badge-status { position: absolute; top: 15px; right: 15px; z-index: 10; padding: 6px 12px; border-radius: 8px; font-weight: 600; font-size: 0.8rem; backdrop-filter: blur(5px); }
        .badge-tersedia { background-color: rgba(25, 135, 84, 0.9); color: white; }
        .badge-penuh { background-color: rgba(220, 53, 69, 0.9); color: white; }
        .harga-text { font-size: 1.4rem; color: #dc3545; font-weight: 700; }

        /* Footer */
        .footer-custom { background-color: #111; color: #eee; padding: 40px 0 20px; margin-top: 80px; }
        
        @media screen and (max-width: 768px) {
            .navbar-collapse { background: white; padding: 15px; border-radius: 12px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); margin-top: 10px; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-hotel me-2"></i> HOTEL HIDAYAH
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('kamar') }}">Daftar Kamar</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}#kebijakan-hotel">Kebijakan Hotel</a></li>

                    @guest
                        <li class="nav-item ms-lg-4 mt-3 mt-lg-0 d-grid d-lg-block">
                            <a class="btn btn-danger px-4 rounded-pill fw-bold shadow-sm" href="{{ route('login') }}">Masuk / Daftar</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item dropdown ms-lg-4 mt-3 mt-lg-0">
                            <a class="nav-link dropdown-toggle fw-bold text-dark bg-light px-4 py-2 rounded-pill text-center text-lg-start" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1 text-danger"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-2 text-center text-lg-start">
                                <li><a class="dropdown-item py-2" href="{{ route('tamu.riwayat') }}"><i class="fas fa-list me-2 text-primary"></i> Riwayat Pesanan</a></li>
                                <li><a class="dropdown-item py-2" href="{{ route('tamu.profil') }}"><i class="fas fa-user-cog me-2 text-danger"></i> Profil Saya</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger fw-bold">
                                            <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- HEADER -->
    <div class="header-kamar">
        <div class="container">
            <h2 class="fw-bold mb-2">Pilihan Kamar Terbaik</h2>
            <p class="mb-0 text-white-50">Temukan kenyamanan Anda. Cek ketersediaan untuk tanggal rencana menginap Anda.</p>
        </div>
    </div>

    <!-- FORM PENCARIAN OTA STYLE -->
    <div class="container search-box-container">
        <div class="search-box">
            <form action="{{ route('kamar') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label fw-bold text-secondary small">Tanggal Check-In</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-calendar-day text-danger"></i></span>
                        <input type="date" name="checkin" class="form-control border-start-0 ps-0 fw-medium" 
                               value="{{ request('checkin', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-bold text-secondary small">Tanggal Check-Out</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-calendar-check text-danger"></i></span>
                        <input type="date" name="checkout" class="form-control border-start-0 ps-0 fw-medium" 
                               value="{{ request('checkout', date('Y-m-d', strtotime('+1 day'))) }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                    </div>
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-danger fw-bold py-2 shadow-sm">Atur Tanggal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- PESAN PANDUAN (HANYA MUNCUL JIKA TANGGAL SUDAH DIATUR DI URL) -->
    @if(request()->has('checkin') && request()->has('checkout'))
    <div class="container mb-4">
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-4 d-flex align-items-center" role="alert" style="background-color: #d1e7dd; color: #0f5132;">
            <i class="fas fa-check-circle fa-2x me-3"></i>
            <div>
                <strong>Tanggal Menginap Tersimpan!</strong><br>
                <span class="small">Silakan gulir ke bawah dan klik tombol <b>"Cek Ketersediaan & Pesan"</b> pada tipe kamar yang Anda inginkan.</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <!-- DAFTAR KAMAR -->
    <section class="container pb-5 mb-5">
        <div class="row g-4">
            @foreach($data_kamar as $k)
            <div class="col-md-4">
                <div class="card kamar-card h-100 shadow-sm">
                    <div class="img-wrapper">
                        @if($k->stok > 0)
                            <span class="badge-status badge-tersedia shadow-sm"><i class="fas fa-door-open me-1"></i> Total {{ $k->stok }} Unit</span>
                        @else
                            <span class="badge-status badge-penuh shadow-sm"><i class="fas fa-times-circle me-1"></i> Tidak Tersedia</span>
                        @endif
                        <img src="{{ asset('gambar/' . $k->foto) }}" class="card-img-top" alt="{{ $k->tipe_kamar }}">
                    </div>
                    
                    <div class="card-body p-4">
                        <h4 class="card-title fw-bold text-dark mb-1">{{ $k->tipe_kamar }}</h4>
                        <div class="mb-3">
                            <span class="harga-text">Rp {{ number_format($k->harga, 0, ',', '.') }}</span>
                            <span class="text-muted small">/ malam</span>
                        </div>
                        
                        <div class="d-flex justify-content-between small text-secondary mb-3 pb-3 border-bottom">
                            <span><i class="fas fa-users text-secondary me-2"></i> {{ $k->kapasitas }} Orang</span>
                            <span><i class="fas fa-bed text-secondary me-2"></i> Tipe Premium</span>
                        </div>

                        <p class="card-text small text-muted mb-4" style="min-height: 40px;">
                            {{ Str::limit($k->fasilitas, 75) }}
                        </p>
                        
                        <div class="d-grid mt-auto">
                            @if($k->stok > 0)
                                <!-- URL melempar parameter Checkin dan Checkout ke Halaman Detail -->
                                <a href="{{ route('kamar.detail', $k->id_kamar) }}?checkin={{ request('checkin', date('Y-m-d')) }}&checkout={{ request('checkout', date('Y-m-d', strtotime('+1 day'))) }}" 
                                   class="btn btn-outline-danger fw-bold rounded-pill py-2">Cek Ketersediaan & Pesan</a>
                            @else
                                <button class="btn btn-light text-muted fw-bold rounded-pill py-2 border" disabled>Maintenance</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer-custom text-center">
        <div class="container">
            <p class="small mb-0 text-secondary">
                &copy; 2026 <strong>Hotel Hidayah</strong>. All rights reserved.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mencegah tanggal checkout mendahului checkin di Search Bar
        const searchCheckin = document.querySelector('input[name="checkin"]');
        const searchCheckout = document.querySelector('input[name="checkout"]');
        
        if(searchCheckin && searchCheckout) {
            searchCheckin.addEventListener('change', function() {
                let date = new Date(this.value);
                date.setDate(date.getDate() + 1);
                let nextDay = date.toISOString().split('T')[0];
                searchCheckout.min = nextDay;
                if(searchCheckout.value <= this.value) { searchCheckout.value = nextDay; }
            });
        }
    </script>
</body>
</html>