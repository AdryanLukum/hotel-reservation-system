<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tamu - Hotel Hidayah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .sidebar { width: 250px; height: 100vh; background-color: #dc3545; position: fixed; color: white; z-index: 1000;}
        .sidebar-header { padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1); }
        
        .sidebar-menu { padding: 15px; list-style: none; }
        .sidebar-menu li { margin-bottom: 8px; }
        .sidebar-menu li a { 
            padding: 12px 20px; display: block; color: rgba(255, 255, 255, 0.85); 
            text-decoration: none; transition: all 0.3s ease; border-radius: 10px; 
        }
        .sidebar-menu li a:hover { background-color: rgba(255, 255, 255, 0.15); color: white; }
        .sidebar-menu li a.active { background-color: #ffffff; color: #dc3545; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .sidebar-menu li a i { width: 30px; }
        .sidebar-menu li form button {
            width: 100%; text-align: left; padding: 12px 20px; background: transparent; 
            border: none; color: rgba(255, 255, 255, 0.85); transition: all 0.3s ease; border-radius: 10px;
        }
        .sidebar-menu li form button:hover { background-color: rgba(255, 255, 255, 0.15); color: white; }

        .main-content { margin-left: 250px; padding: 40px; }
        .table thead th { background-color: #212529 !important; color: white !important; }
        .btn-wa { background-color: #198754; color: white; font-size: 13px; border-radius: 6px; }
        .btn-wa:hover { background-color: #146c43; color: white; }

        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; z-index: 1000; }
            .sidebar-menu { display: flex; overflow-x: auto; white-space: nowrap; margin-bottom: 0; padding: 10px; }
            .sidebar-menu li { margin-bottom: 0; margin-right: 5px; }
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
            <li><a href="{{ route('admin.tamu') }}" class="active"><i class="fas fa-users"></i> Data Tamu</a></li>
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
            <i class="fas fa-users fa-2x text-primary me-3"></i>
            <h2 class="fw-bold m-0" style="color: #0d6efd;">Data Tamu Hotel</h2>
        </div>

        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th width="70" class="text-center">No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th> <!-- Label diubah -->
                            <th class="text-center">No. Handphone</th>
                            <th width="120" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data_tamu as $index => $t)
                        <tr>
                            <td class="text-center text-muted">{{ $index + 1 }}</td>
                            <td class="fw-bold">{{ $t->name }}</td>
                            
                            {{-- LOGIKA PEMOTONGAN TEKS: Mengambil bagian sebelum simbol @ --}}
                            <td><span class="badge bg-light text-dark border">{{ explode('@', $t->email)[0] }}</span></td>
                            
                            <td class="text-center">
                                <a href="https://wa.me/62{{ ltrim($t->no_hp, '0') }}" target="_blank" class="btn btn-wa px-3 shadow-sm">
                                    <i class="fab fa-whatsapp me-2"></i>{{ $t->no_hp }}
                                </a>
                            </td>
                            
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <form action="{{ route('admin.tamu.reset_password', $t->id) }}" method="POST" onsubmit="return confirm('Reset password tamu {{ $t->name }}?')">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm text-white shadow-sm" title="Reset Password">
                                            <i class="fas fa-key"></i>
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.tamu.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus data tamu {{ $t->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm shadow-sm" title="Hapus Tamu">
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