<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran {{ $reservasi->id_reservasi }} - Hotel Hidayah</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; color: #333; }
        .navbar-checkout { background-color: #ffffff; padding: 15px 0; border-bottom: 1px solid #eaeaea; box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
        .card-custom { border: none; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); background: #ffffff; }
        .timer-box { background-color: #fff8e1; border: 1px solid #ffe082; border-radius: 12px; transition: all 0.3s ease; }
        .timer-box.timeout { background-color: #ffebee; border-color: #ef9a9a; }
        .bank-card { border: 1px solid #e0e0e0; border-radius: 12px; background: #fafafa; }
        .invoice-title { font-size: 0.9rem; font-weight: 600; color: #888; text-transform: uppercase; letter-spacing: 1px; }
        .invoice-item { font-size: 0.95rem; color: #555; }
        .invoice-value { font-weight: 600; color: #222; text-align: right; }
        .dash-line { border-top: 2px dashed #ddd; margin: 15px 0; }
        .total-box { background-color: #fdf2f2; border-radius: 12px; padding: 15px; color: #dc3545; }
        .form-control:focus { box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.15); border-color: #dc3545; }
    </style>
</head>
<body>

    <nav class="navbar-checkout sticky-top mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <span class="fw-bold fs-5 text-dark">
                <i class="fas fa-lock text-success me-2"></i> Proses Pembayaran
            </span>
            <span class="fw-bold text-secondary" style="font-size: 0.9rem;">ID: {{ $reservasi->id_reservasi }}</span>
        </div>
    </nav>

    <div class="container pb-5">
        
        @php
            $checkIn = \Carbon\Carbon::parse($reservasi->tgl_check_in);
            $checkOut = \Carbon\Carbon::parse($reservasi->tgl_check_out);
            $durasiMalam = $checkIn->diffInDays($checkOut);
            if($durasiMalam == 0) { $durasiMalam = 1; }
        @endphp

        <div class="row g-4">
            
            <div class="col-lg-7">
                <h3 class="fw-bold mb-4 text-dark">Selesaikan Pembayaran Anda</h3>

                <div class="timer-box p-4 mb-4 text-center shadow-sm" id="kotakTimer">
                    <h6 class="fw-bold text-warning-emphasis mb-2"><i class="fas fa-hourglass-half me-2"></i>Sisa Waktu Pembayaran</h6>
                    <h2 class="mb-0 fw-bold text-danger" id="angkaTimer" style="letter-spacing: 1px;">Menghitung...</h2>
                    <p class="small text-muted mt-2 mb-0">Segera selesaikan pembayaran agar pesanan Anda tidak dibatalkan otomatis oleh sistem.</p>
                </div>

                <div class="card card-custom p-4 mb-4">
                    <h5 class="fw-bold border-bottom pb-3 mb-4"><i class="fas fa-university text-primary me-2"></i>Transfer Bank</h5>
                    <p class="text-secondary small mb-3">Silakan transfer sesuai dengan total tagihan ke rekening di bawah ini:</p>
                    
                    <div class="bank-card p-3 d-flex align-items-center justify-content-between mb-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-white p-2 rounded shadow-sm me-3 border">
                                <span class="fw-bold text-primary px-2">MANDIRI</span>
                            </div>
                            <div>
                                <h4 class="fw-bold text-dark m-0 tracking-wide" id="nomorRekening">1234567890</h4>
                                <span class="text-muted small fw-medium">A/N HOTEL HIDAYAH</span>
                            </div>
                        </div>
                        <button type="button" onclick="salinRekening()" class="btn btn-light border rounded-circle shadow-sm" style="width: 45px; height: 45px; transition: 0.3s;" id="btnCopy" title="Salin Rekening">
                            <i class="fas fa-copy text-secondary"></i>
                        </button>
                    </div>

                    <form action="{{ route('pembayaran.upload', $reservasi->id_reservasi) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4 bg-light p-3 rounded-3 border">
                            <label class="form-label fw-bold text-dark"><i class="fas fa-cloud-upload-alt text-danger me-2"></i>Upload Bukti Transfer</label>
                            <input type="file" name="bukti_bayar" id="inputBukti" class="form-control bg-white @error('bukti_bayar') is-invalid @enderror" accept="image/png, image/jpeg, image/jpg" required>
                            <div class="form-text small mt-2 text-muted">Format: JPG, JPEG, PNG. Maksimal ukuran file 2MB.</div>
                            
                            @error('bukti_bayar')
                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('tamu.riwayat') }}" id="btnNanti" class="btn btn-outline-secondary fw-bold px-4 py-2 rounded-pill shadow-sm">Bayar Nanti</a>
                            <button type="submit" id="btnSubmit" class="btn btn-danger fw-bold px-4 py-2 rounded-pill shadow-sm flex-grow-1">Kirim Bukti Pembayaran <i class="fas fa-check-circle ms-1"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card card-custom p-4 sticky-lg-top" style="top: 100px;">
                    <h5 class="fw-bold border-bottom pb-3 mb-4"><i class="fas fa-receipt text-danger me-2"></i>Rincian Pesanan</h5>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span class="invoice-item">Nama Tamu</span>
                        <span class="invoice-value">{{ $reservasi->tamu->name }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span class="invoice-item">Tipe Kamar</span>
                        <span class="invoice-value text-danger">{{ $reservasi->kamar->tipe_kamar }}</span>
                    </div>

                    @if($reservasi->nomor_kamar_assigned)
                    <div class="d-flex justify-content-between mb-3">
                        <span class="invoice-item">Nomor Kamar</span>
                        <span class="invoice-value"><span class="badge bg-secondary"><i class="fas fa-key me-1"></i> No. {{ $reservasi->nomor_kamar_assigned }}</span></span>
                    </div>
                    @endif

                    <div class="dash-line"></div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="invoice-item">Check-in</span>
                        <span class="invoice-value">{{ $checkIn->format('d M Y') }} <br><small class="text-muted fw-normal">14:00 WITA</small></span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="invoice-item">Check-out</span>
                        <span class="invoice-value">{{ $checkOut->format('d M Y') }} <br><small class="text-muted fw-normal">12:00 WITA</small></span>
                    </div>

                    <div class="dash-line"></div>

                    <div class="mb-3">
                        <span class="invoice-title d-block mb-2">Rincian Harga</span>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="invoice-item small">Harga Kamar / Malam</span>
                            <span class="invoice-value small">Rp {{ number_format($reservasi->kamar->harga ?? ($reservasi->total_bayar / $durasiMalam / $reservasi->jumlah_kamar), 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="invoice-item small">Durasi Menginap</span>
                            <span class="invoice-value small">{{ $durasiMalam }} Malam</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="invoice-item small">Jumlah Kamar</span>
                            <span class="invoice-value small">{{ $reservasi->jumlah_kamar }} Unit</span>
                        </div>
                        
                        @if($reservasi->ekstra_orang > 0)
                        <div class="d-flex justify-content-between mb-1">
                            <span class="invoice-item small text-success">Ekstra Orang (x{{ $reservasi->ekstra_orang }})</span>
                            <span class="invoice-value small text-success">+ Rp {{ number_format($reservasi->ekstra_orang * 50000 * $durasiMalam, 0, ',', '.') }}</span>
                        </div>
                        @endif

                        @if($reservasi->ekstra_kasur > 0)
                        <div class="d-flex justify-content-between mb-1">
                            <span class="invoice-item small text-success">Ekstra Kasur (x{{ $reservasi->ekstra_kasur }})</span>
                            <span class="invoice-value small text-success">+ Rp {{ number_format($reservasi->ekstra_kasur * 75000 * $durasiMalam, 0, ',', '.') }}</span>
                        </div>
                        @endif
                    </div>

                    <div class="total-box mt-4 d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-dark">Total Tagihan</span>
                        <h3 class="fw-bold m-0 text-danger">Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let waktuDatabase = "{{ $reservasi->expired_at }}".replace(' ', 'T');
            const batasWaktu = new Date(waktuDatabase).getTime();
            
            const angkaTimer = document.getElementById('angkaTimer');
            const kotakTimer = document.getElementById('kotakTimer');
            const btnSubmit = document.getElementById('btnSubmit');
            const inputBukti = document.getElementById('inputBukti');
            const btnNanti = document.getElementById('btnNanti');

            const hitungMundur = setInterval(function() {
                const sekarang = new Date().getTime();
                const selisih = batasWaktu - sekarang;

                if (selisih < 0) {
                    clearInterval(hitungMundur);
                    angkaTimer.innerHTML = "WAKTU HABIS!";
                    kotakTimer.classList.add('timeout');
                    btnSubmit.disabled = true;
                    btnSubmit.innerHTML = "Pesanan Dibatalkan";
                    inputBukti.disabled = true;
                    btnNanti.classList.add('disabled');

                    setTimeout(() => { 
                        window.location.href = "{{ route('tamu.riwayat') }}"; 
                    }, 2000);
                    
                } else {
                    const menit = Math.floor((selisih % (1000 * 60 * 60)) / (1000 * 60));
                    const detik = Math.floor((selisih % (1000 * 60)) / 1000);
                    
                    let teksMenit = menit < 10 ? "0" + menit : menit;
                    let teksDetik = detik < 10 ? "0" + detik : detik;

                    angkaTimer.innerHTML = teksMenit + " menit " + teksDetik + " detik";
                }
            }, 1000);
        });

        function salinRekening() {
            var teksRekening = document.getElementById("nomorRekening").innerText;
            navigator.clipboard.writeText(teksRekening).then(function() {
                var btnCopy = document.getElementById("btnCopy");
                btnCopy.innerHTML = '<i class="fas fa-check text-success"></i>';
                btnCopy.classList.add("border-success", "bg-success-subtle");

                setTimeout(function() {
                    btnCopy.innerHTML = '<i class="fas fa-copy text-secondary"></i>';
                    btnCopy.classList.remove("border-success", "bg-success-subtle");
                }, 2000);
            }).catch(function(err) {
                alert("Gagal menyalin rekening. Silakan copy manual.");
            });
        }
    </script>
</body>
</html>