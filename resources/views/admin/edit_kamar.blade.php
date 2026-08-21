<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kamar - Admin Hotel Hidayah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .card { border: none; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .form-label { font-weight: 600; color: #444; }

        /* Responsif untuk Mobile & Tablet */
        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; z-index: 1000; }
            .sidebar-menu { display: flex; overflow-x: auto; white-space: nowrap; margin-bottom: 0; }
            .sidebar-menu li.mt-5 { margin-top: 0 !important; }
            .sidebar-menu li form { margin-bottom: 0; }
            .sidebar-menu li form button { padding: 15px 25px; background: none; border: none; font-size: 16px; }
            .main-content { margin-left: 0; padding: 15px; }
            .d-flex.align-items-center.mb-4 { flex-direction: column; text-align: center; gap: 10px; }
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4">
                    <div class="d-flex align-items-center mb-4">
                        <i class="fas fa-edit fa-2x text-warning me-3"></i>
                        <h3 class="fw-bold m-0">Edit Data Kamar</h3>
                    </div>
                    
                    <form action="{{ route('admin.kamar.update', $kamar->id_kamar) }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tipe Kamar</label>
                            <input type="text" name="tipe_kamar" class="form-control @error('tipe_kamar') is-invalid @enderror" value="{{ old('tipe_kamar', $kamar->tipe_kamar) }}" required>
                            @error('tipe_kamar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga per Malam</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga', $kamar->harga) }}" required>
                                    @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kapasitas</label>
                                <input type="number" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" value="{{ old('kapasitas', $kamar->kapasitas) }}" required>
                                @error('kapasitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        @php
                            $nomorKamarSaatIni = $kamar->daftarNomor->pluck('nomor_kamar')->implode(', ');
                        @endphp
                        
                        <div class="mb-3 p-3 bg-light border rounded">
                            <label class="form-label text-primary">Daftar Nomor Kamar</label>
                            <textarea name="nomor_kamar_list" class="form-control @error('nomor_kamar_list') is-invalid @enderror" rows="2" placeholder="Kosongkan jika kamar sedang tidak tersedia">{{ old('nomor_kamar_list', $nomorKamarSaatIni) }}</textarea>
                            <small class="text-muted d-block mt-1">Stok saat ini: <strong>{{ $kamar->stok }} Unit</strong>. Hapus atau tambahkan nomor kamar (pisahkan dengan koma). <strong>Biarkan kosong untuk membuat stok menjadi 0.</strong></small>
                            @error('nomor_kamar_list') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fasilitas</label>
                            <textarea name="fasilitas" class="form-control @error('fasilitas') is-invalid @enderror" rows="3" required>{{ old('fasilitas', $kamar->fasilitas) }}</textarea>
                            @error('fasilitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label d-block">Foto Kamar Saat Ini</label>
                            <img src="{{ asset('gambar/' . $kamar->foto) }}" class="img-thumbnail mb-2" style="width: 200px; height: 130px; object-fit: cover;">
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/png, image/jpeg, image/jpg">
                            @error('foto') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @else
                                <small class="text-muted">*Biarkan kosong jika tidak ingin mengganti foto</small>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning px-4 fw-bold text-white">Update Kamar</button>
                            <a href="{{ route('admin.kamar') }}" class="btn btn-outline-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>