<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Data - Hotel Hidayah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
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

        /* Content Styling */
        .main-content { margin-left: 250px; padding: 40px; }
        .card-table { border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); overflow: hidden; }
        
        /* Nav Tabs Modern */
        .nav-tabs { border-bottom: 2px solid #e9ecef; margin-bottom: 20px; }
        .nav-tabs .nav-link { border: none; color: #6c757d; font-weight: 600; padding: 12px 25px; transition: 0.3s; }
        .nav-tabs .nav-link:hover { color: #dc3545; }
        .nav-tabs .nav-link.active { border-bottom: 3px solid #dc3545; color: #dc3545; background: transparent; }

        /* Tabel */
        .table thead tr { background-color: #212529 !important; color: #ffffff !important; }
        .table thead th { background-color: #212529 !important; color: #ffffff !important; border: none !important; padding: 15px; font-size: 14px; text-transform: uppercase; }
        .table tbody td { vertical-align: middle; padding: 15px; border-bottom: 1px solid #f0f0f0; }

        /* Tombol Aksi */
        .btn-wrapper { display: flex; gap: 8px; justify-content: flex-start; }
        .btn-aksi { padding: 6px 12px; font-size: 13px; display: inline-flex; align-items: center; justify-content: center; gap: 5px; font-weight: 500; border-radius: 6px; }

        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; z-index: 1000; }
            .sidebar-menu { display: flex; overflow-x: auto; white-space: nowrap; margin-bottom: 0; padding: 10px; }
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
            <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-file-invoice"></i> Data Reservasi</a></li>
            <li><a href="{{ route('admin.kamar') }}"><i class="fas fa-bed"></i> Data Kamar</a></li>
            <li><a href="{{ route('admin.tamu') }}"><i class="fas fa-users"></i> Data Tamu</a></li>
            <li><a href="{{ route('admin.arsip') }}" class="active"><i class="fas fa-archive"></i> Arsip Data</a></li>
            <li><a href="{{ route('admin.laporan') }}"><i class="fas fa-chart-line"></i> Laporan</a></li>
            
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
            <i class="fas fa-archive fa-2x text-secondary me-3"></i>
            <h2 class="fw-bold m-0" style="color: #444;">Tong Sampah / Arsip</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-table p-4">
            
            <ul class="nav nav-tabs" id="arsipTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tamu-tab" data-bs-toggle="tab" data-bs-target="#tamu" type="button" role="tab"><i class="fas fa-users me-2"></i>Arsip Data Tamu</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reservasi-tab" data-bs-toggle="tab" data-bs-target="#reservasi" type="button" role="tab"><i class="fas fa-file-invoice me-2"></i>Arsip Reservasi</button>
                </li>
            </ul>

            <div class="tab-content" id="arsipTabContent">
                
                <div class="tab-pane fade show active" id="tamu" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Nama Tamu</th>
                                    <th>Email</th>
                                    <th>Waktu Dihapus</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tamu_dihapus as $t)
                                <tr>
                                    <td class="fw-bold text-dark">{{ $t->name }}</td>
                                    <td>{{ $t->email }}</td>
                                    <td class="text-danger"><i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($t->deleted_at)->translatedFormat('d M Y, H:i') }}</td>
                                    <td>
                                        <div class="btn-wrapper">
                                            <form action="{{ route('admin.tamu.restore', $t->id) }}" method="POST" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-aksi shadow-sm" title="Pulihkan Data" onclick="return confirm('Kembalikan data {{ $t->name }} ke daftar utama?')">
                                                    <i class="fas fa-trash-restore"></i> Restore
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('admin.tamu.force_delete', $t->id) }}" method="POST" class="m-0">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-aksi shadow-sm" title="Hapus Permanen" onclick="return confirm('PERINGATAN! Data akan dihapus dari sistem selamanya. Yakin?')">
                                                    <i class="fas fa-times-circle"></i> Hapus Permanen
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4"><i class="fas fa-folder-open fa-3x mb-3 text-light"></i><br>Tidak ada data tamu di tong sampah.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="reservasi" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>No. Invoice</th>
                                    <th>Nama Tamu</th>
                                    <th>Waktu Dihapus</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reservasi_dihapus as $r)
                                <tr>
                                    <td class="fw-bold text-secondary">#{{ $r->id_reservasi }}</td>
                                    <td class="fw-bold">{{ $r->tamu?->name ?? 'Tamu Dihapus' }}</td>
                                    <td class="text-danger"><i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($r->deleted_at)->translatedFormat('d M Y, H:i') }}</td>
                                    <td>
                                        <div class="btn-wrapper">
                                            <form action="{{ route('admin.reservasi.restore', $r->id_reservasi) }}" method="POST" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-aksi shadow-sm" title="Pulihkan Data" onclick="return confirm('Kembalikan invoice #{{ $r->id_reservasi }} ke daftar utama?')">
                                                    <i class="fas fa-trash-restore"></i> Restore
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('admin.reservasi.force_delete', $r->id_reservasi) }}" method="POST" class="m-0">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-aksi shadow-sm" title="Hapus Permanen" onclick="return confirm('PERINGATAN! Data invoice ini akan hilang dari laporan selamanya. Yakin?')">
                                                    <i class="fas fa-times-circle"></i> Hapus Permanen
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4"><i class="fas fa-folder-open fa-3x mb-3 text-light"></i><br>Tidak ada data reservasi di tong sampah.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>