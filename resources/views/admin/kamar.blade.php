<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kamar - Hotel Hidayah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        
        .sidebar { width: 250px; height: 100vh; background-color: #dc3545; position: fixed; color: white; z-index: 1000; }
        .sidebar-header { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        
        /* --- SIDEBAR MENU OPSI 2 (WHITE PILL) --- */
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
        .table thead th { background-color: #212529 !important; color: white !important; text-align: center; }
        .img-thumbnail-custom { width: 80px; height: 60px; object-fit: cover; border-radius: 5px; }
        .badge-tersedia { background-color: #198754; }
        .badge-penuh { background-color: #dc3545; }

        /* Responsif untuk Mobile & Tablet */
        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; }
            .sidebar-menu { display: flex; overflow-x: auto; white-space: nowrap; margin-bottom: 0; padding: 10px; }
            .sidebar-menu li { margin-bottom: 0; margin-right: 5px; }
            .sidebar-menu li.mt-5 { margin-top: 0 !important; }
            .sidebar-menu li form { margin-bottom: 0; }
            .sidebar-menu li form button { padding: 10px 15px; }
            .main-content { margin-left: 0; padding: 15px; }
            .d-flex.align-items-center.mb-4 { flex-direction: column; text-align: center; gap: 10px; }
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
            <li><a href="{{ route('admin.kamar') }}" class="active"><i class="fas fa-bed"></i> Data Kamar</a></li>
            <li><a href="{{ route('admin.tamu') }}"><i class="fas fa-users"></i> Data Tamu</a></li>
            <li><a href="{{ route('admin.arsip') }}"><i class="fas fa-archive"></i> Arsip Data</a></li>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">Data Kamar Hotel Hidayah</h2>
            <a href="{{ route('admin.kamar.create') }}" class="btn btn-primary fw-bold shadow-sm">
                <i class="fas fa-plus me-1"></i> Tambah Data
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Foto</th>
                            <th>Tipe Kamar</th>
                            <th>Harga</th>
                            <th>Kapasitas</th>
                            <th>Unit</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_kamar as $index => $k)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">
                                <img src="{{ asset('gambar/' . $k->foto) }}" class="img-thumbnail-custom shadow-sm">
                            </td>
                            <td class="fw-bold">{{ $k->tipe_kamar }}</td>
                            <td class="text-center">Rp {{ number_format($k->harga, 0, ',', '.') }}</td>
                            <td class="text-center"><i class="fas fa-users me-1"></i> {{ $k->kapasitas }} Orang</td>
                            <td class="text-center text-muted">{{ $k->stok }} Unit</td>
                            <td class="text-center">
                                @if($k->stok > 0)
                                    <span class="badge bg-success px-3">Tersedia</span>
                                @else
                                    <span class="badge bg-danger px-3">Tidak Tersedia</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.kamar.edit', $k->id_kamar) }}" class="btn btn-warning btn-sm text-white shadow-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.kamar.destroy', $k->id_kamar) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm shadow-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus tipe kamar {{ $k->tipe_kamar }}?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>