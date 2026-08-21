<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Reservasi - Hotel Hidayah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        .sidebar { width: 250px; height: 100vh; background-color: #dc3545; position: fixed; color: white; z-index: 1000; }
        .sidebar-header { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        
        /* --- REVISI SIDEBAR MENU OPSI 2 (WHITE PILL) --- */
        .sidebar-menu { padding: 15px; list-style: none; }
        .sidebar-menu li { margin-bottom: 8px; }
        .sidebar-menu li a { 
            padding: 12px 20px; 
            display: block; 
            color: rgba(255, 255, 255, 0.85); 
            text-decoration: none; 
            transition: all 0.3s ease;
            border-radius: 10px; 
        }
        .sidebar-menu li a:hover { 
            background-color: rgba(255, 255, 255, 0.15); 
            color: white; 
        }
        .sidebar-menu li a.active { 
            background-color: #ffffff; 
            color: #dc3545; 
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
        }
        .sidebar-menu li a i { width: 30px; }
        
        /* Tombol Logout */
        .sidebar-menu li form button {
            width: 100%;
            text-align: left;
            padding: 12px 20px;
            background: transparent;
            border: none;
            color: rgba(255, 255, 255, 0.85);
            transition: all 0.3s ease;
            border-radius: 10px;
        }
        .sidebar-menu li form button:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .main-content { margin-left: 250px; padding: 40px; }
        .card-table { border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); overflow: hidden; }
        
        .table { margin-bottom: 0; }
        .table thead tr { background-color: #212529 !important; color: #ffffff !important; }
        .table thead th { background-color: #212529 !important; color: #ffffff !important; border: none !important; padding: 15px 15px !important; font-size: 14px; font-weight: 600; vertical-align: middle; text-transform: uppercase; letter-spacing: 0.5px; }
        .table tbody td { vertical-align: middle; padding: 16px 15px; font-size: 14.5px; border-bottom: 1px solid #f0f0f0; }

        .col-invoice { width: 130px !important; padding-left: 20px !important; font-weight: 600; color: #444; }
        .col-tamu { padding-left: 10px !important; }
        .col-aksi { width: 240px !important; padding-right: 20px !important; }

        .badge-status { padding: 8px 15px; font-weight: 600; letter-spacing: 0.3px; font-size: 12px; }

        .btn-wrapper { display: flex; justify-content: flex-end; align-items: center; gap: 6px; }
        .btn-aksi { width: 38px; height: 38px; font-size: 14px; display: inline-flex; align-items: center; justify-content: center; font-weight: 500; border-radius: 8px; transition: all 0.2s ease-in-out; border: none; }
        .btn-aksi:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important; }

        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; }
            .sidebar-menu { display: flex; overflow-x: auto; white-space: nowrap; margin-bottom: 0; padding: 10px;}
            .sidebar-menu li { margin-bottom: 0; margin-right: 5px; }
            .sidebar-menu li.mt-5 { margin-top: 0 !important; }
            .sidebar-menu li form { margin-bottom: 0; }
            .sidebar-menu li form button { padding: 10px 15px; }
            .main-content { margin-left: 0; padding: 15px; }
        }
    </style>
</head>
<body>

    <div class="sidebar shadow">
        <div class="sidebar-header">
            <h4 class="fw-bold"><i class="fas fa-hotel me-2"></i> ADMIN</h4>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}" class="active"><i class="fas fa-file-invoice"></i> Data Reservasi</a></li>
            <li><a href="{{ route('admin.kamar') }}"><i class="fas fa-bed"></i> Data Kamar</a></li>
            <li><a href="{{ route('admin.tamu') }}"><i class="fas fa-users"></i> Data Tamu</a></li>
            <li><a href="{{ route('admin.arsip') }}"><i class="fas fa-archive"></i> Arsip Data</a></li>
            <li><a href="{{ route('admin.laporan') }}"><i class="fas fa-chart-line"></i> Laporan</a></li>
            <li class="mt-5">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"><i class="fas fa-sign-out-alt me-2 text-warning"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="d-flex align-items-center mb-4">
            <i class="fas fa-calendar-alt fa-2x text-danger me-3"></i>
            <h2 class="fw-bold m-0" style="color: #dc3545;">Data Reservasi Masuk</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('admin.dashboard') }}" method="GET" class="d-inline-block mb-4">
            <div class="input-group shadow-sm border-0 rounded">
                <span class="input-group-text bg-white border-0 fw-bold text-secondary">
                    <i class="fas fa-filter me-2 text-danger"></i> Filter Waktu:
                </span>
                <select name="sort" class="form-select border-0 text-dark fw-medium" onchange="this.form.submit()" style="background-color: #f8f9fa;">
                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Paling Terbaru</option>
                    <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Paling Terlama</option>
                </select>
            </div>
        </form>

        <div class="card card-table">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th class="col-invoice">No. Invoice</th>
                                <th class="col-tamu">Nama Tamu</th>
                                <th class="text-center">Kamar & Tipe</th> <th class="text-center">Tgl Check-In</th>
                                <th class="text-center">Total Bayar</th> 
                                <th class="text-center">Status & Info</th>
                                <th class="col-aksi text-end">Aksi</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservasi as $r)
                            <tr>
                                <td class="col-invoice text-secondary">#{{ $r->id_reservasi }}</td>
                                <td class="col-tamu">
                                    <span class="fw-bold text-dark">{{ $r->tamu?->name ?? 'Tamu Dihapus' }}</span> <br> 
                                    <small class="text-muted"><i class="fas fa-phone-alt me-1" style="font-size:10px;"></i>{{ $r->tamu?->no_hp ?? '-' }}</small>
                                </td>
                                
                                <td class="text-center">
                                    <span class="fw-bold d-block">{{ $r->kamar->tipe_kamar }}</span>
                                    @if($r->nomor_kamar_assigned)
                                        <span class="badge bg-secondary mt-1"><i class="fas fa-key me-1"></i>No. {{ $r->nomor_kamar_assigned }}</span>
                                    @endif
                                </td>
                                
                                <td class="text-center">{{ \Carbon\Carbon::parse($r->tgl_check_in)->format('d M Y') }}</td>
                                
                                <td class="text-center fw-bold" style="color: #dc3545;">
                                    Rp {{ number_format($r->total_bayar, 0, ',', '.') }}
                                </td>
                                
                                <td class="text-center">
                                    @if($r->status == 'Pending' || $r->status == 'Menunggu Konfirmasi')
                                        <span class="badge bg-warning text-dark rounded-pill badge-status mb-1"><i class="fas fa-clock me-1"></i>{{ $r->status }}</span>
                                    
                                    @elseif($r->status == 'Lunas')
                                        <span class="badge bg-success rounded-pill badge-status mb-1"><i class="fas fa-check-circle me-1"></i>Lunas / Check-In</span>
                                    
                                    @elseif($r->status == 'Selesai')
                                        <span class="badge bg-primary rounded-pill badge-status mb-1"><i class="fas fa-flag-checkered me-1"></i>Selesai</span>
                                    
                                    @elseif($r->status == 'Batal')
                                        <span class="badge bg-danger rounded-pill badge-status mb-1"><i class="fas fa-times-circle me-1"></i>Batal</span>
                                        <br>
                                        
                                        @if($r->status_refund == 'Menunggu Refund')
                                            <span class="badge bg-warning text-dark px-2 py-1 mt-1" style="font-size: 10px;"><i class="fas fa-exclamation-triangle me-1"></i>Tamu Menunggu Refund</span>
                                        @elseif($r->status_refund == 'Refund Selesai')
                                            <span class="badge bg-info text-dark px-2 py-1 mt-1" style="font-size: 10px;"><i class="fas fa-check-double me-1"></i>Refund Selesai</span>
                                        @endif
                                        
                                        @if($r->alasan_batal)
                                            <div class="mt-1">
                                                <small class="text-danger fw-bold" style="font-size: 11px;">Alasan: {{ $r->alasan_batal }}</small>
                                            </div>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary rounded-pill badge-status">{{ $r->status }}</span>
                                    @endif
                                </td>
                                <td class="col-aksi">
                                    <div class="btn-wrapper">
                                        
                                        @if($r->status == 'Menunggu Konfirmasi')
                                            <button type="button" class="btn btn-info text-white btn-aksi shadow-sm" data-bs-toggle="modal" data-bs-target="#buktiModal{{ $r->id_reservasi }}" title="Lihat Bukti Pembayaran">
                                                <i class="fas fa-receipt"></i>
                                            </button>

                                            <form action="{{ route('admin.reservasi.konfirmasi', $r->id_reservasi) }}" method="POST" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-aksi shadow-sm" title="Terima & Konfirmasi Reservasi">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            
                                            <button type="button" class="btn btn-warning text-dark btn-aksi shadow-sm" data-bs-toggle="modal" data-bs-target="#tolakModal{{ $r->id_reservasi }}" title="Tolak & Batalkan Reservasi">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                        @endif
                                        
                                        @if($r->status == 'Batal' && $r->status_refund == 'Menunggu Refund')
                                            <button type="button" class="btn btn-primary btn-sm px-3 fw-bold rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#refundModal{{ $r->id_reservasi }}">
                                                <i class="fas fa-upload me-1"></i> Upload Refund
                                            </button>
                                        @endif

                                        @if($r->status == 'Lunas')
                                            <form action="{{ route('admin.reservasi.checkout', $r->id_reservasi) }}" method="POST" class="m-0" onsubmit="return confirm('Tamu sudah selesai menginap? Klik OK untuk Check-out dan melepaskan kamar.')">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-aksi shadow-sm" title="Proses Check-out (Selesai)">
                                                    <i class="fas fa-sign-out-alt"></i>
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('admin.reservasi.destroy', $r->id_reservasi) }}" method="POST" class="m-0" onsubmit="return confirm('Yakin ingin menghapus data ke dalam Arsip?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-aksi shadow-sm" title="Pindahkan Data ke Arsip">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="buktiModal{{ $r->id_reservasi }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4 border-0 shadow">
                                        <div class="modal-header border-bottom-0">
                                            <h5 class="modal-title fw-bold">Bukti Transfer #{{ $r->id_reservasi }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center pb-4">
                                            <div class="alert alert-info text-start mb-3 shadow-sm border-0 rounded-3">
                                                <h6 class="mb-1 fw-bold"><i class="fas fa-info-circle me-2"></i>Detail Tagihan</h6>
                                                <p class="mb-0 text-dark">Total dibayar tamu: 
                                                    <span class="text-danger fw-bold d-block mt-1" style="font-size: 1.3rem;">
                                                        Rp {{ number_format($r->total_bayar, 0, ',', '.') }}
                                                    </span>
                                                </p>
                                            </div>
                                            <label class="form-label d-block fw-bold mb-2">Foto Bukti Transfer:</label>
                                            @if($r->bukti_bayar)
                                                <img src="{{ asset('gambar_bukti/' . $r->bukti_bayar) }}" class="img-fluid rounded-3 shadow-sm border">
                                            @else
                                                <div class="alert alert-warning m-0"><i class="fas fa-exclamation-triangle me-2"></i>Belum diunggah.</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                           <div class="modal fade" id="tolakModal{{ $r->id_reservasi }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4 border-0 shadow">
                                        <div class="modal-header border-bottom-0">
                                            <h5 class="modal-title fw-bold text-danger"><i class="fas fa-exclamation-circle me-2"></i>Tolak Reservasi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body pb-4">
                                            <p class="text-muted small mb-3">Tamu telah melakukan pembayaran, jika Anda menolak pesanan ini, Anda diwajibkan melakukan <strong>Refund (Pengembalian Dana)</strong>.</p>
                                            
                                            <form action="{{ route('admin.reservasi.tolak', $r->id_reservasi) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold small">Kategori Pembatalan (Wajib):</label>
                                                    <select name="alasan_utama" class="form-select mb-3" required>
                                                        <option value="">-- Pilih Alasan --</option>
                                                        <option value="Bukti Transfer Palsu / Tidak Valid">Bukti Transfer Palsu / Tidak Valid</option>
                                                        <option value="Tamu Melanggar Aturan Hotel">Tamu Melanggar Aturan Hotel</option>
                                                        <option value="Kamar Sedang Maintenance/Perbaikan">Kamar Sedang Maintenance/Perbaikan</option>
                                                        <option value="Tamu Menggunakan Data Fiktif">Tamu Menggunakan Data Fiktif</option>
                                                        <option value="Lainnya">Lainnya (Jelaskan di bawah)</option>
                                                    </select>
                                                    
                                                    <label class="form-label fw-bold small">Ketik Detail Tambahan (Opsional):</label>
                                                    <textarea name="alasan_detail" class="form-control" rows="3" placeholder="ketik alasan detail kenapa menolak..."></textarea>
                                                </div>
                                                <div class="d-grid mt-4">
                                                    <button type="submit" class="btn btn-danger fw-bold">Konfirmasi Penolakan</button>
                                                </div>
                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="refundModal{{ $r->id_reservasi }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4 border-0 shadow">
                                        <div class="modal-header border-bottom-0">
                                            <h5 class="modal-title fw-bold text-primary"><i class="fas fa-hand-holding-usd me-2"></i>Unggah Bukti Refund</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body pb-4">
                                            <div class="alert alert-warning small border-0 shadow-sm mb-4">
                                                Tamu <strong>{{ $r->tamu?->name }}</strong> menunggu pengembalian dana sebesar <strong class="text-danger">Rp {{ number_format($r->total_bayar, 0, ',', '.') }}</strong> dengan alasan: <em>{{ $r->alasan_batal }}</em>
                                            </div>
                                            <form action="{{ route('admin.reservasi.refund', $r->id_reservasi) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold small">Upload Bukti Transfer Bank:</label>
                                                    <input type="file" name="bukti_refund" class="form-control" accept="image/png, image/jpeg, image/jpg" required>
                                                    <small class="text-muted" style="font-size: 11px;">Maksimal 2MB (JPG, JPEG, PNG)</small>
                                                </div>
                                                <div class="d-grid mt-4">
                                                    <button type="submit" class="btn btn-primary fw-bold">Selesaikan Refund</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>