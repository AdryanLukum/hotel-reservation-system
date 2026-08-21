<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan - Hotel Hidayah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        
        /* --- SIDEBAR MENU OPSI 2 (WHITE PILL) --- */
        .sidebar { width: 250px; height: 100vh; background-color: #dc3545; position: fixed; color: white; z-index: 1000; }
        .sidebar-header { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-menu { padding: 15px; list-style: none; }
        .sidebar-menu li { margin-bottom: 8px; }
        .sidebar-menu li a { 
            padding: 12px 20px; display: block; color: rgba(255, 255, 255, 0.85); 
            text-decoration: none; transition: all 0.3s ease; border-radius: 10px; 
        }
        .sidebar-menu li a:hover { background-color: rgba(255, 255, 255, 0.15); color: white; }
        .sidebar-menu li a.active { 
            background-color: #ffffff; color: #dc3545; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
        }
        .sidebar-menu li a i { width: 30px; }
        .sidebar-menu li form button {
            width: 100%; text-align: left; padding: 12px 20px; background: transparent; 
            border: none; color: rgba(255, 255, 255, 0.85); transition: all 0.3s ease; border-radius: 10px;
        }
        .sidebar-menu li form button:hover { background-color: rgba(255, 255, 255, 0.15); color: white; }

        .main-content { margin-left: 250px; padding: 40px; }
        .table thead th { background-color: #212529 !important; color: white !important; text-align: center; }
        .total-row { background-color: #fff3cd; font-weight: bold; }

        /* Sembunyikan Header Cetak di Tampilan Layar Web */
        .print-header { display: none; }

        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; z-index: 1000; }
            .sidebar-menu { display: flex; overflow-x: auto; white-space: nowrap; margin-bottom: 0; padding: 10px; }
            .sidebar-menu li { margin-bottom: 0; margin-right: 5px; }
            .sidebar-menu li.mt-5 { margin-top: 0 !important; }
            .sidebar-menu li form { margin-bottom: 0; }
            .sidebar-menu li form button { padding: 10px 15px; }
            .main-content { margin-left: 0; padding: 15px; }
            .d-flex.align-items-center.mb-4 { flex-direction: column; text-align: center; gap: 10px; }
        }

        /* =======================================================
            TAMPILAN KERTAS SAAT DICETAK (PRINT)
           ======================================================= */
        @media print {
            /* 1. Sembunyikan elemen web yang tidak perlu */
            .sidebar, 
            .btn, 
            form, 
            .d-flex.align-items-center.mb-4 {
                display: none !important;
            }

            /* 2. Geser konten agar memenuhi kertas */
            .main-content {
                margin-left: 0 !important;
                padding: 0 !important;
                width: 100% !important;
                background-color: white !important;
            }

            /* 3. Tampilkan Kop Surat Resmi */
            .print-header {
                display: block !important;
                text-align: center;
                margin-bottom: 20px;
            }
            .print-header h2 {
                margin: 0;
                font-weight: bold;
                color: black !important;
            }
            .print-header p {
                margin: 0;
                font-size: 14px;
            }
            .print-header hr {
                border-top: 3px solid black !important;
                opacity: 1 !important;
                margin-top: 10px;
                margin-bottom: 20px;
            }

            /* 4. Format kartu & tabel agar muncul dengan jelas di cetakan */
            .card {
                border: none !important;
                box-shadow: none !important; 
            }
            .table-responsive {
                overflow: visible !important; 
            }
            .table {
                border-collapse: collapse !important;
                width: 100% !important;
            }
            .table, .table th, .table td {
                border: 1px solid black !important;
                color: black !important;
            }
            .table thead th {
                background-color: #f0f0f0 !important; 
                color: black !important;
            }
            
            /* PERBAIKAN STATUS KOTAK: Mengubah badge menjadi teks biasa saat dicetak */
            .badge {
                border: none !important;
                background-color: transparent !important;
                color: black !important;
                padding: 0 !important;
                font-weight: bold !important;
                font-size: 14px !important;
            }
            
            /* Teks abu-abu untuk cetak */
            .text-muted {
                color: #555 !important;
            }
        }
    </style>
</head>
<body>

    <div class="sidebar shadow">
        <div class="sidebar-header">
            <h4 class="fw-bold"><i class="fas fa-hotel me-2"></i> ADMIN</h4>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-file-invoice"></i> Data Reservasi</a></li>
            <li><a href="{{ route('admin.kamar') }}"><i class="fas fa-bed"></i> Data Kamar</a></li>
            <li><a href="{{ route('admin.tamu') }}"><i class="fas fa-users"></i> Data Tamu</a></li>
            <li><a href="{{ route('admin.arsip') }}"><i class="fas fa-archive"></i> Arsip Data</a></li>
            <li><a href="{{ route('admin.laporan') }}" class="active"><i class="fas fa-chart-line"></i> Laporan</a></li>
            <li class="mt-5">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">
                        <i class="fas fa-sign-out-alt me-2 text-warning"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="d-flex align-items-center mb-4">
            <i class="fas fa-print fa-2x text-dark me-3"></i>
            <h2 class="fw-bold m-0">Laporan Penerimaan</h2>
        </div>

        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('admin.laporan') }}" method="GET" class="row align-items-end">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label class="form-label fw-bold">Pilih Bulan</label>
                        <select name="bulan" class="form-select">
                            @foreach(['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'] as $m => $nama)
                                <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label class="form-label fw-bold">Pilih Tahun</label>
                        <select name="tahun" class="form-select">
                            @for($i = date('Y'); $i >= 2024; $i--)
                                <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    
                    <div class="col-md-4 d-flex gap-2 mt-3 mt-md-0">
                        <button type="submit" class="btn btn-primary w-100 fw-bold"><i class="fas fa-search me-1"></i> Tampilkan</button>
                        <button type="button" onclick="window.print()" class="btn btn-success w-100 fw-bold"><i class="fas fa-print me-1"></i> Cetak</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="print-header">
            <h2>HOTEL HIDAYAH</h2>
            <p>JL. Pangeran Kesuma Negara, No. 07, Kotabaru, Kalimantan Selatan</p>
            <hr>
        </div>

        <h5 class="text-center mb-3 fw-bold">Laporan Penerimaan Bulan 
            {{ ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'][$bulan] }} {{ $tahun }}
        </h5>

        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0" style="min-width: 600px;">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Tanggal Transaksi</th>
                            <th>Nama Tamu</th>
                            <th>Kamar & Tipe</th> <!-- REVISI HEADER -->
                            <th>Status</th>
                            <th>Jumlah Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $index => $l)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            
                            <td class="text-center">{{ \Carbon\Carbon::parse($l->tgl_pesan)->format('d-m-Y H:i') }}</td>
                            
                            <td>{{ $l->tamu->name ?? 'Tamu Dihapus' }}</td>
                            
                            <!-- REVISI KOLOM: MENAMPILKAN NOMOR KAMAR -->
                            <td class="text-center">
                                <span class="fw-bold">{{ $l->kamar->tipe_kamar }}</span>
                                @if($l->nomor_kamar_assigned)
                                    <br>
                                    <span class="badge bg-secondary mt-1" style="font-size: 0.75rem;"><i class="fas fa-key me-1"></i>No. {{ $l->nomor_kamar_assigned }}</span>
                                @endif
                            </td>
                            
                            <td class="text-center">
                                <span class="badge {{ $l->status == 'Selesai' ? 'bg-success' : 'bg-primary' }}">{{ $l->status }}</span>
                            </td>
                            
                            <td class="text-end fw-bold">Rp {{ number_format($l->total_bayar, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Tidak ada data pendapatan pada periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="total-row">
                            <td colspan="5" class="text-center text-uppercase">Total Penerimaan</td>
                            <td class="text-end text-primary fw-bold" style="font-size: 1.1rem;">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>