<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail {{ $kamar->tipe_kamar }} - Hotel Hidayah</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; color: #333;}
        .navbar-detail { background-color: #ffffff; padding: 15px 0; border-bottom: 1px solid #eaeaea;}
        .btn-kembali { color: #dc3545; font-weight: 600; text-decoration: none; transition: all 0.3s ease; display: inline-flex; align-items: center;}
        .btn-kembali:hover { color: #b02a37; transform: translateX(-5px);}
        .img-main { width: 100%; border-radius: 20px; object-fit: cover; max-height: 380px; box-shadow: 0 10px 30px rgba(0,0,0,0.08);}
        .price-text { font-size: 1.8rem; color: #dc3545; font-weight: 700; letter-spacing: -1px;}
        .feature-badge { background-color: #fdf2f2; color: #dc3545; border-radius: 12px; padding: 10px 18px; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; border: 1px solid #f9d6d9;}
        .feature-badge i { font-size: 1.1rem; margin-right: 8px; }
        .badge-stok { background-color: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; } 
        .badge-habis { background-color: #ffebee; color: #c62828; border: 1px solid #ffcdd2; } 
        .badge-kapasitas { background-color: #e3f2fd; color: #1565c0; border: 1px solid #bbdefb; } 
        .badge-wifi { background-color: #fff3e0; color: #ef6c00; border: 1px solid #ffe0b2; } 
        .card-booking { border: none; border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.06); background: #ffffff;}
        .form-control { border-radius: 12px; padding: 12px 15px; border: 1px solid #e0e0e0; font-size: 0.95rem;}
        .form-control:focus { box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.15); border-color: #dc3545;}
        .form-control.is-invalid { border-color: #dc3545; background-color: #fff8f8;}
        .btn-pesan { border-radius: 12px; padding: 14px; font-weight: 600; font-size: 1.1rem; transition: all 0.3s ease;}
        .btn-pesan:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(220, 53, 69, 0.3);}
        .modal-content { border-radius: 20px; border: none; }
        .modal-header { border-radius: 20px 20px 0 0; }
    </style>
</head>
<body>

    <nav class="navbar-detail shadow-sm mb-5 sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('kamar') }}" class="btn-kembali">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Kamar
            </a>
            <span class="fw-bold text-secondary tracking-wide text-uppercase" style="font-size: 0.9rem;">Detail Akomodasi</span>
        </div>
    </nav>

    <div class="container mb-5 pb-5">
        
        <!-- INI AKAN MENAMPILKAN ERROR JIKA TANGGAL TERSEBUT KAMAR PENUH (DARI CONTROLLER) -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4 border-0 rounded-4" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> <strong>Mohon Maaf!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4 border-0 rounded-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-5">
            <div class="col-lg-8">
                <img src="{{ asset('gambar/' . $kamar->foto) }}" class="img-main mb-4" alt="{{ $kamar->tipe_kamar }}">
                
                <div class="d-flex justify-content-between align-items-start mt-4 mb-2">
                    <h2 class="fw-bold text-dark m-0">{{ $kamar->tipe_kamar }}</h2>
                </div>
                
                <div class="mb-4">
                    <span class="price-text">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</span>
                    <span class="text-muted fw-normal fs-5">/ malam</span>
                </div>
                
                <div class="d-flex flex-wrap gap-2 mb-5">
                    @if($kamar->stok > 0)
                        <div class="feature-badge badge-stok"><i class="fas fa-building"></i> Total Fisik: {{ $kamar->stok }} Unit</div>
                    @else
                        <div class="feature-badge badge-habis"><i class="fas fa-wrench"></i> Sedang Maintenance</div>
                    @endif
                    <div class="feature-badge badge-kapasitas"><i class="fas fa-user-friends"></i> Kapasitas {{ $kamar->kapasitas }} Orang</div>
                    <div class="feature-badge badge-wifi"><i class="fas fa-wifi"></i> WiFi Kecepatan Tinggi</div>
                </div>

                <h4 class="fw-bold text-dark mb-3"><i class="fas fa-concierge-bell text-danger me-2"></i> Fasilitas Kamar</h4>
                <div class="p-4 bg-white rounded-4 shadow-sm mb-4">
                    @php
                        $list_fasilitas = explode(',', $kamar->fasilitas);
                    @endphp
                    <div class="row g-3">
                        @foreach($list_fasilitas as $item)
                            @php
                                $item = trim($item); 
                                $icon = 'fa-check-circle'; 
                                $iconColor = '#198754'; 
                                
                                if(stripos($item, 'ac') !== false) { $icon = 'fa-snowflake'; $iconColor = '#0dcaf0'; } 
                                elseif(stripos($item, 'tv') !== false) { $icon = 'fa-tv'; $iconColor = '#343a40'; } 
                                elseif(stripos($item, 'wifi') !== false || stripos($item, 'wi-fi') !== false) { $icon = 'fa-wifi'; $iconColor = '#0d6efd'; } 
                                elseif(stripos($item, 'air panas') !== false || stripos($item, 'water heater') !== false) { $icon = 'fa-hot-tub'; $iconColor = '#dc3545'; } 
                                elseif(stripos($item, 'kasur') !== false || stripos($item, 'bed') !== false) { $icon = 'fa-bed'; $iconColor = '#6610f2'; } 
                                elseif(stripos($item, 'sarapan') !== false || stripos($item, 'makan') !== false) { $icon = 'fa-utensils'; $iconColor = '#fd7e14'; } 
                                elseif(stripos($item, 'kipas') !== false || stripos($item, 'fan') !== false) { $icon = 'fa-fan'; $iconColor = '#6c757d'; } 
                                elseif(stripos($item, 'kopi') !== false || stripos($item, 'teh') !== false) { $icon = 'fa-coffee'; $iconColor = '#795548'; } 
                                elseif(stripos($item, 'lemari') !== false) { $icon = 'fa-door-closed'; $iconColor = '#8b4513'; } 
                                elseif(stripos($item, 'mandi') !== false || stripos($item, 'shower') !== false) { $icon = 'fa-shower'; $iconColor = '#0aa2c0'; }
                            @endphp
                            
                            <div class="col-md-6 col-lg-4">
                                <div class="d-flex align-items-center p-2 border rounded-3 bg-light" style="transition: 0.3s;">
                                    <div class="bg-white rounded-circle d-flex justify-content-center align-items-center shadow-sm me-3" style="width: 35px; height: 35px; min-width: 35px; color: {{ $iconColor }};">
                                        <i class="fas {{ $icon }}"></i>
                                    </div>
                                    <span class="text-secondary fw-medium" style="font-size: 0.95rem;">{{ $item }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- FORM BOOKING SEBELAH KANAN -->
            <div class="col-lg-4">
                <div class="card card-booking p-4 sticky-lg-top" style="top: 100px;">
                    <h4 class="fw-bold mb-4 text-dark border-bottom pb-3"><i class="fas fa-calendar-check me-2 text-danger"></i> Cek Ketersediaan & Pesan</h4>
                    
                    @auth
                        <form action="{{ route('kamar.pesan', $kamar->id_kamar) }}" method="POST" id="formPemesanan">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">Tanggal Check-In</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-calendar-alt text-muted"></i></span>
                                    <!-- Menangkap Parameter URL 'checkin' -->
                                    <input type="date" name="tgl_checkin" class="form-control border-start-0 ps-0" 
                                           value="{{ request('checkin', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">Tanggal Check-Out</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-calendar-check text-muted"></i></span>
                                    <!-- Menangkap Parameter URL 'checkout' -->
                                    <input type="date" name="tgl_checkout" class="form-control border-start-0 ps-0" 
                                           value="{{ request('checkout', date('Y-m-d', strtotime('+1 day'))) }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">Jumlah Kamar</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-bed text-muted"></i></span>
                                    <!-- Max diset ke total fisik. Backend akan menolak jika pada tanggal tersebut penuh -->
                                    <input type="number" name="jumlah" id="inputJumlah" class="form-control border-start-0 ps-0" value="1" min="1" max="{{ $kamar->stok }}" required>
                                </div>
                                <div class="form-text text-muted small mt-1" id="infoJumlah"><i class="fas fa-info-circle me-1"></i> Sistem akan mencarikan jadwal kamar yang kosong secara otomatis.</div>
                            </div>

                            <div class="p-3 bg-light rounded-3 border mt-4 mb-4">
                                <label class="form-label small fw-bold text-dark mb-3"><i class="fas fa-plus-circle text-success me-1"></i> Opsi Tambahan (Bila Perlu)</label>
                                <div class="mb-3">
                                    <label class="form-label small text-secondary">Ekstra Orang (Tanpa Kasur)</label>
                                    <select name="ekstra_orang" class="form-select form-select-sm" id="ekstra_orang">
                                        <option value="0">Tidak Ada</option>
                                        <option value="1">1 Orang (+ Rp 50.000 / Malam)</option>
                                        <option value="2">2 Orang (+ Rp 100.000 / Malam)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label small text-secondary">Ekstra Kasur (Bed Tambahan)</label>
                                    <select name="ekstra_kasur" class="form-select form-select-sm" id="ekstra_kasur">
                                        <option value="0">Tidak Ada</option>
                                        <option value="1">1 Kasur (+ Rp 75.000 / Malam)</option>
                                        <option value="2">2 Kasur (+ Rp 150.000 / Malam)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <span class="small text-muted">Harga kamar dasar: Rp {{ number_format($kamar->harga, 0, ',', '.') }} / malam</span>
                            </div>

                            <div class="d-grid">
                                @if($kamar->stok > 0)
                                    <button type="button" class="btn btn-danger btn-pesan text-white" id="btnBukaModal">
                                        Pesan Sekarang <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-secondary btn-pesan" disabled>Kamar Maintenance</button>
                                @endif
                            </div>
                        </form>
                    @endauth

                    @guest
                        <div class="text-center py-5">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                                <i class="fas fa-lock text-muted fa-2x"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-2">Login Diperlukan</h6>
                            <p class="text-muted small mb-4">Silakan masuk ke akun Anda untuk mengecek ketersediaan dan memesan.</p>
                            <div class="d-grid px-2">
                                <a href="{{ route('login') }}" class="btn btn-outline-danger fw-bold rounded-pill py-2">Masuk / Daftar Sekarang</a>
                            </div>
                        </div>
                    @endguest

                    <div class="mt-4 pt-3 border-top small text-muted text-center">
                        <p class="m-0"><i class="fas fa-shield-alt text-success me-1"></i> Transaksi Aman & Terpercaya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PERATURAN -->
    <div class="modal fade" id="modalPeraturan" tabindex="-1" aria-labelledby="modalPeraturanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-danger text-white border-0 py-3">
                    <h5 class="modal-title fw-bold" id="modalPeraturanLabel">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i> Peraturan Penting
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-dark text-wrap">
                    <div class="text-center mb-3">
                        <i class="fas fa-id-card fa-3x text-secondary opacity-50"></i>
                    </div>
                    <p class="text-center">Bagi tamu yang menginap membawa pasangan, <strong>DIWAJIBKAN</strong> untuk menunjukkan bukti nikah resmi (KTP dengan alamat sama atau Buku Nikah) pada saat Check-in di Resepsionis.</p>
                    <hr class="my-4 border-secondary opacity-25">
                    <p class="mb-0 text-center fw-bold text-danger">Apakah Anda setuju dengan peraturan ini?</p>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 justify-content-center gap-2">
                    <button type="button" class="btn btn-light fw-bold px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger fw-bold px-4 rounded-pill shadow-sm" id="btnKirimPesanan">Setuju & Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            // 1. Logika Kalender (Mencegah tanggal mundur)
            const checkinInput = document.querySelector('input[name="tgl_checkin"]');
            const checkoutInput = document.querySelector('input[name="tgl_checkout"]');

            if (checkinInput && checkoutInput) {
                checkinInput.addEventListener('change', function() {
                    let date = new Date(this.value);
                    date.setDate(date.getDate() + 1);
                    let nextDay = date.toISOString().split('T')[0];
                    
                    checkoutInput.min = nextDay;
                    
                    if(checkoutInput.value <= this.value) {
                        checkoutInput.value = nextDay; 
                    }
                });
            }

            // 2. Logika Buka Modal & Submit
            const btnBukaModal = document.getElementById('btnBukaModal');
            const formPesan = document.getElementById('formPemesanan');
            
            if (btnBukaModal && formPesan) {
                const modalPeraturan = new bootstrap.Modal(document.getElementById('modalPeraturan'));

                btnBukaModal.addEventListener('click', function() {
                    // Hanya cek apakah input wajib sudah diisi (HTML5 Validation)
                    if (!formPesan.checkValidity()) {
                        formPesan.reportValidity();
                    } else {
                        modalPeraturan.show();
                    }
                });
            }

            // 3. Logika Submit setelah setuju peraturan
            const btnKirim = document.getElementById('btnKirimPesanan');
            if (btnKirim && formPesan) {
                btnKirim.addEventListener('click', function() {
                    // Tombol diubah jadi "Memproses..." agar tidak diklik dua kali
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Memproses...';
                    this.classList.add('disabled');
                    formPesan.submit(); 
                });
            }
        });
    </script>
</body>
</html>