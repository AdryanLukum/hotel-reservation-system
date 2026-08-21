<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kamar - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
        .card { border: none; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .form-label { font-weight: 600; color: #444; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 px-3">
                <div class="card p-4">
                    <h4 class="fw-bold mb-4 text-danger">Tambah Tipe Kamar Baru</h4>
                    
                    <form action="{{ route('admin.kamar.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tipe Kamar</label>
                            <input type="text" name="tipe_kamar" class="form-control @error('tipe_kamar') is-invalid @enderror" placeholder="Contoh: AC Standar" value="{{ old('tipe_kamar') }}" required>
                            @error('tipe_kamar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Harga per Malam</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" placeholder="350000" value="{{ old('harga') }}" required>
                                    @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <label class="form-label">Kapasitas Orang</label>
                                <input type="number" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" value="{{ old('kapasitas', 2) }}" required>
                                @error('kapasitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3 p-3 bg-light border rounded">
                            <label class="form-label text-primary">Daftar Nomor Kamar <span class="text-danger">*</span></label>
                            <textarea name="nomor_kamar_list" class="form-control @error('nomor_kamar_list') is-invalid @enderror" rows="2" placeholder="Contoh: 101, 102, 103, Mawar" required>{{ old('nomor_kamar_list') }}</textarea>
                            <small class="text-muted d-block mt-1">Pisahkan setiap nomor/nama kamar dengan tanda koma (,). Sistem akan otomatis menghitung total stok berdasarkan jumlah nomor yang Anda masukkan.</small>
                            @error('nomor_kamar_list') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Fasilitas Kamar</label>
                            <textarea name="fasilitas" class="form-control @error('fasilitas') is-invalid @enderror" rows="3" placeholder="Contoh: AC, TV, WiFi, Kamar Mandi Dalam" required>{{ old('fasilitas') }}</textarea>
                            @error('fasilitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Foto Kamar</label>
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/png, image/jpeg, image/jpg" required>
                            @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-danger px-4 fw-bold text-white">Simpan Data</button>
                            <a href="{{ route('admin.kamar') }}" class="btn btn-outline-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>