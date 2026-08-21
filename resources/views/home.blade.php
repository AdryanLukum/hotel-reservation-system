<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Hidayah - Reservasi Modern</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fafbfc; color: #333; }
        
        /* Navbar */
        .navbar { background-color: rgba(255, 255, 255, 0.98) !important; backdrop-filter: blur(10px); transition: all 0.3s ease; }
        .navbar-brand { color: #dc3545 !important; font-weight: 700; font-size: 1.4rem; }
        .nav-link { color: #555 !important; font-weight: 500; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { color: #dc3545 !important; }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.7)), url('{{ asset("gambar/banner2.jpg") }}');
            background-size: cover; background-position: center; background-attachment: fixed;
            height: 80vh; min-height: 500px; display: flex; align-items: center; justify-content: center;
            color: white; text-align: center; border-radius: 0 0 40px 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .hero-title { font-size: 3.5rem; font-weight: 700; letter-spacing: -1px; margin-bottom: 15px; text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8); }
        .hero-subtitle { font-size: 1.2rem; font-weight: 300; margin-bottom: 30px; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.9); }
        .btn-pesan { background-color: #dc3545; color: white; border: none; padding: 12px 35px; border-radius: 50px; font-weight: 600; transition: 0.3s; box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3); }
        .btn-pesan:hover { background-color: #bb2d3b; color: white; transform: translateY(-3px); }

        /* Tentang Hotel & Kebijakan */
        .section-title { font-weight: 700; color: #1a1a1a; font-size: 2rem; margin-bottom: 15px; }
        .text-reading { color: #555; line-height: 1.9; font-size: 1.05rem; margin-bottom: 20px; }
        .img-profile { border-radius: 24px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        
        .card-traveloka {
            border: 1px solid #f0f0f0; border-radius: 20px; padding: 30px 25px; background: #ffffff;
            transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.02); height: 100%; display: flex; flex-direction: column;
        }
        .card-traveloka:hover { box-shadow: 0 10px 30px rgba(0,0,0,0.08); transform: translateY(-5px); border-color: #ffffff; }
        .icon-circle { width: 55px; height: 55px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 25px; }
        
        .bg-soft-blue { background-color: #eef8ff; color: #0288d1; }
        .bg-soft-red { background-color: #fff1f0; color: #dc3545; }
        .bg-soft-green { background-color: #e6f9f0; color: #0f9d58; }
        .bg-soft-orange { background-color: #fff4e6; color: #f57c00; }
        .bg-soft-purple { background-color: #f4eefc; color: #673ab7; }
        .card-traveloka h5 { font-weight: 700; color: #2c2c2c; margin-bottom: 10px; font-size: 1.2rem;}
        .card-traveloka p { color: #666; font-size: 0.95rem; line-height: 1.6; margin: 0; }

        /* Footer */
        .footer-custom { background-color: #111; color: #eee; padding: 70px 0 30px; margin-top: 100px; }
        .footer-brand { font-size: 1.5rem; letter-spacing: 1px; color: #fff; font-weight: 700; }
        .address-text { line-height: 1.8; color: #aaa; font-weight: 300; }
        .social-icons a { display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(255,255,255,0.1); color: #fff; border-radius: 50%; margin: 0 8px; transition: 0.3s; }
        .social-icons a:hover { background: #dc3545; transform: translateY(-3px); }
        .btn-wa-footer { background-color: #25d366; color: white; border-radius: 50px; padding: 12px 30px; font-weight: 600; text-decoration: none; display: inline-block; transition: 0.3s; }
        .btn-wa-footer:hover { background-color: #1ebe57; color: white; transform: translateY(-3px); }

        @media screen and (max-width: 768px) {
            .navbar-collapse { background: white; padding: 15px; border-radius: 12px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); margin-top: 10px; }
            .hero-section { height: auto; min-height: 60vh; padding: 120px 15px 60px; border-radius: 0 0 20px 20px; background-attachment: scroll; }
            .hero-title { font-size: 2.2rem; line-height: 1.2; }
            .btn-pesan { width: 100%; }
            .footer-custom { padding: 50px 0 20px; text-align: center; }
            .btn-wa-footer { width: 100%; }
        }
    </style>
</head>
<body>

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
                    <li class="nav-item"><a class="nav-link active" href="{{ url('/') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('kamar') }}">Daftar Kamar</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kebijakan-hotel">Kebijakan Hotel</a></li>
                    <li class="nav-item"><a class="nav-link" href="#lokasi-kami">Lokasi Hotel</a></li>

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

    <header class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h1 class="hero-title">Temukan Kenyamanan Sejati</h1>
                    <p class="hero-subtitle">Hotel Hidayah menghadirkan pengalaman menginap Kelas Melati yang nyaman dan terjangkau di Jl. Pangeran Kesuma Negara Nomor 12, Kotabaru Hilir, Kotabaru, Kalimantan Selatan.</p>
                    
                    @guest
                        <a href="{{ route('kamar') }}" class="btn btn-pesan fs-5 mt-2">Lihat Kamar & Pesan</a>
                    @endguest

                    @auth
                        <a href="{{ route('tamu.riwayat') }}" class="btn btn-pesan fs-5 mt-2"><i class="fas fa-ticket-alt me-2"></i>Cek Pesanan Saya</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- SECTION TENTANG HOTEL -->
    <div id="tentang-hotel" class="container mt-5 pt-5 mb-4">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 pe-lg-5">
                <span class="text-danger fw-bold small text-uppercase tracking-wide">Tentang Kami</span>
                <h2 class="section-title mt-2">Profil Hotel Hidayah</h2>
                <p class="text-reading mt-4">
                    Hotel Hidayah adalah akomodasi berkonsep <strong>budget hotel Melati (Non-Bintang)</strong> yang terletak strategis di Kotabaru, Kalimantan Selatan. Dengan menawarkan harga yang sangat terjangkau mulai dari Rp 160.000, kami berkomitmen untuk memberikan pengalaman menginap yang fungsional, bersih, dan nyaman bagi para tamu, baik untuk keperluan bisnis maupun liburan keluarga.
                </p>
                <p class="text-reading">
                    Dengan lokasi yang dekat dengan pusat kota dan pelayanan yang profesional, kami memastikan setiap tamu merasakan hangatnya keramahan lokal yang dipadukan dengan standar fasilitas hotel yang berkualitas tinggi.
                </p>
                <a href="{{ route('kamar') }}" class="btn btn-outline-danger rounded-pill px-4 py-2 mt-3 fw-bold">Jelajahi Pilihan Kamar <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('gambar/banner2.jpg') }}" class="img-fluid img-profile" alt="Hotel Hidayah">
            </div>
        </div>
    </div>

    <!-- SECTION FASILITAS HOTEL (BARU DITAMBAHKAN) -->
    <div id="fasilitas-hotel" class="container mt-5 pt-3 mb-5 pb-3">
        <h2 class="section-title text-center mb-2">Fasilitas</h2>
        <p class="text-center text-muted mb-5 pb-3">Nikmati berbagai fasilitas pendukung yang kami sediakan untuk kenyamanan Anda.</p>

        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="card-traveloka align-items-center text-center">
                    <div class="icon-circle bg-soft-blue"><i class="fas fa-couch"></i></div>
                    <h5 class="fs-6 mb-0">Ruang Tunggu</h5>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card-traveloka align-items-center text-center">
                    <div class="icon-circle bg-soft-orange"><i class="fas fa-utensils"></i></div>
                    <h5 class="fs-6 mb-0">Dapur Bersama</h5>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card-traveloka align-items-center text-center">
                    <div class="icon-circle bg-soft-green"><i class="fas fa-motorcycle"></i></div>
                    <h5 class="fs-6 mb-0">Area Parkir Motor</h5>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card-traveloka align-items-center text-center">
                    <div class="icon-circle bg-soft-purple"><i class="fas fa-car"></i></div>
                    <h5 class="fs-6 mb-1">Akses Parkir Mobil</h5>
                    <p class="small text-muted" style="font-size: 0.8rem;">(Area Siring Laut)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION KEBIJAKAN HOTEL -->
    <div id="kebijakan-hotel" class="mt-5 pt-4" style="scroll-margin-top: 90px;">
        <div class="container">
            <h2 class="section-title text-center mb-2">Kebijakan & Aturan Hotel</h2>
            <p class="text-center text-muted mb-5 pb-3">Pelajari panduan layanan kami untuk memastikan kenyamanan Anda selama menginap.</p>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card-traveloka">
                        <div class="icon-circle bg-soft-blue"><i class="fas fa-clock"></i></div>
                        <h5>Waktu Layanan</h5>
                        <p><strong>Check-in:</strong> 14.00 WITA<br><strong>Check-out:</strong> 12.00 WITA<br>Layanan resepsionis tersedia untuk membantu Anda.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card-traveloka">
                        <div class="icon-circle bg-soft-red"><i class="fas fa-id-card"></i></div>
                        <h5>Ketentuan Pasangan</h5>
                        <p>Tamu yang menginap berpasangan diwajibkan menunjukkan bukti nikah resmi (Buku Nikah / KTP dengan alamat sama) saat check-in.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card-traveloka">
                        <div class="icon-circle bg-soft-orange"><i class="fas fa-smoking-ban"></i></div>
                        <h5>Kawasan Bebas Asap</h5>
                        <p>Dilarang keras merokok di dalam kamar hotel. Pelanggaran terhadap aturan ini dapat dikenakan biaya pembersihan ekstra.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card-traveloka">
                        <div class="icon-circle bg-soft-purple"><i class="fas fa-undo"></i></div>
                        <h5>Kebijakan Pembatalan</h5>
                        <p>Pembatalan reservasi maksimal dilakukan H-2 sebelum tanggal check-in. Proses refund akan dilakukan secara manual oleh tim admin kami.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card-traveloka">
                        <div class="icon-circle bg-soft-green"><i class="fas fa-paw"></i></div>
                        <h5>Hewan Peliharaan</h5>
                        <p>Demi menjaga standar kebersihan dan kenyamanan seluruh tamu, hewan peliharaan dalam bentuk apapun tidak diperkenankan memasuki area hotel.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card-traveloka">
                        <div class="icon-circle bg-soft-blue"><i class="fas fa-wallet"></i></div>
                        <h5>Batas Waktu Pembayaran</h5>
                        <p>Pembayaran dan upload bukti transfer wajib diselesaikan dalam batas waktu <strong>40 Menit</strong> setelah pemesanan dibuat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION LOKASI KAMI -->
    <div id="lokasi-kami" class="container mt-5 pt-5 mb-5" style="scroll-margin-top: 90px;">
        <h2 class="section-title text-center mb-2">Lihat Lokasi Kami</h2>
        <p class="text-center text-muted mb-4 pb-2">Temukan Hotel Hidayah dengan mudah di pusat Kotabaru.</p>
        
        <div class="row bg-white p-4 rounded-4 shadow-sm border">
            <div class="col-lg-4 mb-4 mb-lg-0 d-flex flex-column justify-content-center">
                <h5 class="fw-bold text-danger mb-3"><i class="fas fa-map-marker-alt me-2"></i>Alamat Lengkap</h5>
                <p class="text-reading fs-6">
                    JL. Pangeran Kesuma Negara, No. 12<br>
                    Kotabaru Hilir, Kec. Pulau Laut Utara<br>
                    Kabupaten Kotabaru, Kalimantan Selatan 72113
                </p>
                <a href="https://maps.app.goo.gl/mDPT5RPWJmuSuYwL8" target="_blank" class="btn btn-outline-danger mt-3 rounded-pill w-100">
                    <i class="fas fa-location-arrow me-2"></i> Buka di Google Maps
                </a>
            </div>
            <div class="col-lg-8">
                <!-- Ganti src di bawah dengan link embed iframe asli dari Google Maps Hotel Hidayah -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.452614044156!2d116.22220605611798!3d-3.2369957433702097!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2def314966cf715f%3A0x60fcddfe82cde606!2sHotel%20Hidayah!5e0!3m2!1sen!2sid!4v1782873891948!5m2!1sen!2sid" 
                    width="100%" height="400" style="border:0; border-radius: 12px; min-height: 250px;" 
                    allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin">
                </iframe>
            </div>
        </div>
    </div>

    <footer class="footer-custom">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-md-5 mb-4 mb-md-0">
                    <div class="footer-brand mb-3">
                        <i class="fas fa-hotel text-danger me-2"></i>HOTEL HIDAYAH
                    </div>
                    <p class="small address-text pe-md-5">
                        Menghadirkan pelayanan prima dan fasilitas lengkap untuk memastikan istirahat Anda berkualitas.<br><br>
                        <i class="fas fa-map-marker-alt text-danger me-2"></i> JL. Pangeran Kesuma Negara, No. 12, Kotabaru Hilir, Kotabaru, Kalimantan Selatan 72113
                    </p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0 text-md-center">
                    <h5 class="text-white fw-bold mb-4">Butuh Bantuan?</h5>
                    <a href="https://wa.me/6289515812996" target="_blank" class="btn btn-wa-footer shadow">
                        <i class="fab fa-whatsapp me-2 fs-5"></i> Hubungi Pihak Hotel
                    </a>
                </div>
                <div class="col-md-3 text-md-end mb-4">
                    <h5 class="text-white fw-bold mb-3 mt-4 mt-md-0">Ikuti Kami</h5>
                    <div class="social-icons justify-content-md-end d-flex justify-content-center">
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="mailto:hotelhidayah@gmail.com" title="Email"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary mt-5 mb-4 opacity-25">
            <div class="text-center">
                <p class="small mb-0 text-secondary">
                    &copy; 2026 <strong>Hotel Hidayah</strong>. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>