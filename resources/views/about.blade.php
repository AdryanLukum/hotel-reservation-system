<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Hotel Hidayah</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #fafbfc; /* Warna background abu-abu sangat muda khas Traveloka */
            color: #333; 
        }

        /* Navbar Clean */
        .navbar-custom { 
            background-color: #ffffff; 
            padding: 15px 0; 
            border-bottom: 1px solid #eaeaea;
        }
        .navbar-brand { color: #dc3545 !important; font-weight: 700; font-size: 1.4rem; }

        /* Hero Banner ala Traveloka */
        .hero-traveloka {
            background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 100%), url('{{ asset("gambar/banner2.jpg") }}');
            background-size: cover;
            background-position: center;
            height: 45vh;
            min-height: 400px;
            display: flex;
            align-items: center;
            color: white;
            border-radius: 0 0 40px 40px;
            margin-bottom: 60px;
        }

        .section-title { 
            font-weight: 700; 
            color: #1a1a1a; 
            font-size: 2rem;
            margin-bottom: 15px; 
        }

        /* Teks Profil */
        .text-reading {
            color: #555;
            line-height: 1.9;
            font-size: 1.05rem;
            margin-bottom: 20px;
        }

        /* Card Ala Traveloka (Our Products) */
        .card-traveloka {
            border: 1px solid #f0f0f0;
            border-radius: 20px;
            padding: 30px 25px;
            background: #ffffff;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card-traveloka:hover { 
            box-shadow: 0 10px 30px rgba(0,0,0,0.08); 
            transform: translateY(-5px);
            border-color: #ffffff;
        }

        /* Lingkaran Ikon Soft */
        .icon-circle {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 25px;
        }

        /* Varian Warna Ikon ala Traveloka */
        .bg-soft-blue { background-color: #eef8ff; color: #0288d1; }
        .bg-soft-red { background-color: #fff1f0; color: #dc3545; }
        .bg-soft-green { background-color: #e6f9f0; color: #0f9d58; }
        .bg-soft-orange { background-color: #fff4e6; color: #f57c00; }
        .bg-soft-purple { background-color: #f4eefc; color: #673ab7; }

        .card-traveloka h5 { font-weight: 700; color: #2c2c2c; margin-bottom: 10px; font-size: 1.2rem;}
        .card-traveloka p { color: #666; font-size: 0.95rem; line-height: 1.6; margin: 0; }
        
        .img-profile {
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <nav class="navbar-custom sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand text-decoration-none" href="{{ url('/') }}">
                <i class="fas fa-hotel me-2"></i> HOTEL HIDAYAH
            </a>
            <a href="{{ url('/') }}" class="btn btn-outline-danger rounded-pill px-4 fw-bold shadow-sm">Kembali</a>
        </div>
    </nav>

    <header class="hero-traveloka">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h1 class="display-4 fw-bold mb-3">Lebih Dekat Dengan Kami</h1>
                    <p class="lead fw-light" style="opacity: 0.9;">Kenyamanan berlandaskan keramahan di jantung Kotabaru. Kami memastikan setiap pengalaman menginap Anda tak terlupakan.</p>
                </div>
            </div>
        </div>
    </header>

    <div class="container mb-5 pb-5">
        <div class="row g-5 align-items-center mb-5 pb-4">
            <div class="col-lg-6 pe-lg-5">
                <h2 class="section-title">Tentang Hotel Hidayah</h2>
                <p class="text-reading mt-4">
                    Hotel Hidayah adalah akomodasi modern yang terletak strategis di Kotabaru, Kalimantan Selatan. Kami berkomitmen untuk memberikan pengalaman menginap yang tenang dan nyaman bagi para tamu, baik untuk keperluan bisnis maupun liburan keluarga.
                </p>
                <p class="text-reading">
                    Dengan lokasi yang dekat dengan pusat kota dan pelayanan yang profesional, kami memastikan setiap tamu merasakan hangatnya keramahan lokal yang dipadukan dengan standar fasilitas hotel yang berkualitas tinggi.
                </p>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('gambar/banner2.jpg') }}" class="img-fluid img-profile" alt="Hotel Hidayah">
            </div>
        </div>

        <div class="mt-5 pt-4">
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
                        <p>Pembayaran dan upload bukti transfer wajib diselesaikan dalam batas waktu <strong>40 Menit</strong> setelah form pemesanan dibuat untuk menghindari pembatalan otomatis.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>