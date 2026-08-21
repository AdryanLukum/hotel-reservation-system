<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Hotel Hidayah</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; color: #333; }

        /* Navbar Clean */
        .navbar-custom { background-color: #ffffff; padding: 15px 0; border-bottom: 1px solid #eaeaea; }
        .btn-kembali { color: #dc3545; font-weight: 600; text-decoration: none; transition: all 0.3s ease; display: inline-flex; align-items: center; }
        .btn-kembali:hover { color: #b02a37; transform: translateX(-5px); }

        /* Card Container (Global) */
        .card-history { border: none; border-radius: 20px; box-shadow: 0 10px 35px rgba(0,0,0,0.04); background: #ffffff; overflow: hidden; }

        /* Modern Table Styling (Desktop) */
        .table { margin-bottom: 0; }
        .table thead th { background-color: #f8f9fa; color: #6c757d; font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; border-bottom: 1px solid #eaeaea; padding: 15px; }
        .table tbody td { padding: 18px 15px; vertical-align: middle; color: #444; border-bottom: 1px solid #f0f0f0; font-size: 0.95rem; }
        .table tbody tr:hover { background-color: #fafbfc; }

        .id-booking { font-weight: 700; color: #dc3545; letter-spacing: 0.5px; }

        /* Soft Badges */
        .badge-soft { padding: 8px 12px; border-radius: 8px; font-weight: 600; font-size: 0.8rem; display: inline-flex; align-items: center; }
        .badge-warning-soft { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
        .badge-success-soft { background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; }
        .badge-danger-soft  { background-color: #f8d7da; color: #842029; border: 1px solid #f5c2c7; }
        .badge-secondary-soft { background-color: #e2e3e5; color: #41464b; border: 1px solid #d3d6d8; }

        /* Action Buttons */
        .btn-action { border-radius: 8px; font-weight: 600; padding: 8px 15px; font-size: 0.85rem; transition: all 0.3s ease; }
        .btn-action:hover { transform: translateY(-2px); }
        .btn-icon { width: 38px; height: 38px; display: inline-flex; align-items: center; justify-content: center; padding: 0; }
        .btn-action-text { height: 38px; display: inline-flex; align-items: center; }

        /* Alert Modern */
        .alert-modern { border-radius: 12px; border: none; background-color: #d1e7dd; color: #0f5132; border-left: 5px solid #198754; }

        /* Modal Custom Styling */
        .modal-header-custom { background-color: #f8f9fa; border-bottom: 1px solid #eaeaea; border-radius: 16px 16px 0 0; }
        .detail-item { font-size: 0.9rem; color: #6c757d; }
        .detail-value { font-size: 1rem; font-weight: 600; color: #333; text-align: right; }
        .detail-row { border-bottom: 1px dashed #eaeaea; padding: 10px 0; }
        .detail-row:last-child { border-bottom: none; }

        @media screen and (max-width: 768px) {
            .table-responsive { border: none; }
            .table thead { display: none; }
            .table tbody tr { display: block; background-color: #fff; border: 1px solid #eaeaea; border-radius: 12px; margin-bottom: 15px; padding: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
            .table tbody tr:hover { background-color: #fff; }
            .table tbody td { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px dashed #f0f0f0; text-align: right; }
            .table tbody td:last-child { border-bottom: none; padding-bottom: 0; justify-content: center; margin-top: 10px; }
            .table tbody td::before { content: attr(data-label); font-weight: 600; color: #6c757d; font-size: 0.85rem; text-transform: uppercase; text-align: left; padding-right: 15px; flex-shrink: 0; }
            .table tbody td .id-booking { font-size: 1.1rem; }
            .table tbody td .text-secondary { text-align: right; width: 100%; display: flex; justify-content: flex-end; align-items: center;}
            .table tbody td[data-label="Status"] { flex-direction: column; align-items: flex-end; }
            .table tbody td[data-label="Status"]::before { align-self: flex-start; margin-bottom: 5px; }
        }
    </style>
</head>
<body>

    <nav class="navbar-custom shadow-sm mb-5 sticky-top">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ url('/') }}" class="btn-kembali">
                <i class="fas fa-arrow-left me-2"></i> <span class="d-none d-sm-inline">Kembali ke Beranda</span>
            </a>
            
            <div class="d-flex align-items-center dropdown">
                <a class="text-decoration-none d-flex align-items-center text-dark dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <div class="bg-light rounded-circle p-2 me-2 text-danger shadow-sm">
                        <i class="fas fa-user-circle fs-5"></i>
                    </div>
                    <span class="fw-bold d-none d-sm-inline">Halo, {{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 mt-3">
                    <li><a class="dropdown-item py-2" href="{{ route('tamu.profil') }}"><i class="fas fa-user-cog me-2 text-danger"></i> Profil Saya</a></li>
                    <li><a class="dropdown-item py-2 active" href="{{ route('tamu.riwayat') }}"><i class="fas fa-list me-2"></i> Riwayat Pesanan</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 text-danger fw-bold">
                                <i class="fas fa-sign-out-alt me-2"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-5 pb-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div class="d-flex align-items-center">
                <div class="bg-danger text-white rounded-3 p-3 me-3 shadow-sm">
                    <i class="fas fa-history fs-4"></i>
                </div>
                <div>
                    <h3 class="fw-bold text-dark mb-0">Riwayat Pesanan</h3>
                    <p class="text-muted small mb-0">Pantau dan kelola seluruh transaksi kamar Anda di sini.</p>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <label class="small fw-bold text-secondary text-nowrap"><i class="fas fa-filter me-1"></i> Filter:</label>
                <select class="form-select form-select-sm fw-medium shadow-sm border-0" id="filterStatus" style="border-radius: 8px;">
                    <option value="Semua">Semua Status</option>
                    <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                    <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
                    <option value="Lunas">Lunas / Selesai</option>
                    <option value="Dibatalkan">Dibatalkan</option>
                </select>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-modern alert-dismissible fade show shadow-sm mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i><strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card card-history bg-transparent bg-md-white shadow-none shadow-md">
            <div class="table-responsive-md"> 
                <table class="table table-hover align-middle" id="tabelRiwayat">
                    <thead>
                        <tr>
                            <th class="ps-md-4">ID Booking</th>
                            <th>Kamar</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Total Bayar</th>
                            <th>Status & Info</th>
                            <th class="text-center pe-md-4">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data_pesanan as $p)
                        @php
                            $status_filter = $p->status;
                            if($status_filter == 'Pending') $status_filter = 'Menunggu Pembayaran'; 
                            if($status_filter == 'Selesai') $status_filter = 'Lunas';
                            if($status_filter == 'Batal') $status_filter = 'Dibatalkan';
                        @endphp
                        <tr data-status="{{ $status_filter }}">
                            <td data-label="ID Booking" class="ps-md-4"><span class="id-booking">{{ $p->id_reservasi }}</span></td>
                            
                            <td data-label="Kamar">
                                <span class="fw-bold text-dark d-block">{{ $p->kamar->tipe_kamar }}</span>
                                @if($p->nomor_kamar_assigned)
                                    <span class="badge bg-secondary mt-1" style="font-size: 0.7rem;"><i class="fas fa-key me-1"></i>No. {{ $p->nomor_kamar_assigned }}</span>
                                @endif
                            </td>
                            
                            <td data-label="Check-In">
                                <div class="text-secondary"><i class="fas fa-calendar-alt me-1 text-muted d-none d-md-inline"></i> {{ date('d-m-Y', strtotime($p->tgl_check_in)) }}</div>
                            </td> 
                            <td data-label="Check-Out">
                                <div class="text-secondary"><i class="fas fa-calendar-check me-1 text-muted d-none d-md-inline"></i> {{ date('d-m-Y', strtotime($p->tgl_check_out)) }}</div>
                            </td> 
                            <td data-label="Total Bayar" class="fw-bold text-dark">Rp {{ number_format($p->total_bayar, 0, ',', '.') }}</td>
                            
                            <td data-label="Status">
                                @if($p->status == 'Pending')
                                    <div class="badge-soft badge-warning-soft">
                                        <i class="fas fa-clock me-1"></i> Menunggu Pembayaran
                                    </div>
                                    <div class="mt-1 small text-danger fw-bold" style="font-size: 0.75rem;">
                                        <i class="fas fa-exclamation-circle me-1"></i> Batas: {{ \Carbon\Carbon::parse($p->expired_at)->format('H:i') }} WIB
                                    </div>
                                @elseif($p->status == 'Menunggu Konfirmasi')
                                    <div class="badge-soft badge-warning-soft">
                                        <i class="fas fa-hourglass-half me-1"></i> Menunggu Konfirmasi
                                    </div>
                                @elseif($p->status == 'Selesai' || $p->status == 'Lunas')
                                    <div class="badge-soft badge-success-soft">
                                        <i class="fas fa-check-circle me-1"></i> Lunas
                                    </div>
                                @elseif($p->status == 'Batal')
                                    <div class="badge-soft badge-danger-soft mb-1">
                                        <i class="fas fa-times-circle me-1"></i> Dibatalkan
                                    </div>
                                    
                                    @if($p->alasan_batal)
                                        <div class="mt-1 d-block" style="font-size: 0.8rem; line-height: 1.3;">
                                            <span class="text-danger fw-bold">Alasan:</span> <span class="text-muted">{{ $p->alasan_batal }}</span>
                                        </div>
                                    @endif

                                    @if($p->status_refund == 'Menunggu Refund')
                                        <div class="badge-soft badge-warning-soft mt-2" style="font-size: 0.75rem; padding: 4px 8px;">
                                            <i class="fas fa-undo-alt me-1"></i> Menunggu Refund Dana
                                        </div>
                                    @elseif($p->status_refund == 'Refund Selesai')
                                        <div class="badge-soft badge-success-soft mt-2" style="font-size: 0.75rem; padding: 4px 8px;">
                                            <i class="fas fa-check-double me-1"></i> Dana Dikembalikan
                                        </div>
                                        @if($p->bukti_refund)
                                            <div class="mt-2 d-block">
                                                <a href="{{ asset('gambar_bukti/' . $p->bukti_refund) }}" target="_blank" class="btn btn-sm btn-outline-success border-success" style="font-size: 0.75rem; padding: 4px 8px; border-radius: 6px;">
                                                    <i class="fas fa-receipt me-1"></i> Cek Bukti Refund
                                                </a>
                                            </div>
                                        @endif
                                    @endif
                                @else
                                    <div class="badge-soft badge-secondary-soft">
                                        <i class="fas fa-info-circle me-1"></i> {{ $p->status }}
                                    </div>
                                @endif
                            </td>
                            
                            <td data-label="" class="text-center pe-md-4 pt-3 pt-md-0">
                                <div class="d-flex justify-content-center gap-2 w-100">
                                    <button type="button" class="btn btn-outline-secondary btn-action btn-icon bg-white shadow-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $p->id_reservasi }}" title="Lihat Detail Pesanan">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    @if($p->status == 'Pending')
                                        <a href="{{ route('pembayaran', $p->id_reservasi) }}" class="btn btn-success btn-action btn-action-text shadow-sm position-relative flex-grow-1 flex-md-grow-0 justify-content-center">
                                            <i class="fas fa-wallet me-1"></i> Bayar
                                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                                <span class="visually-hidden">Peringatan</span>
                                            </span>
                                        </a>
                                        <form action="{{ route('tamu.reservasi.batal', $p->id_reservasi) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-action btn-icon bg-white">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @elseif($p->status == 'Selesai' || $p->status == 'Lunas')
                                        <a href="{{ route('tamu.cetak', $p->id_reservasi) }}" target="_blank" class="btn btn-outline-primary btn-action btn-action-text bg-white shadow-sm flex-grow-1 flex-md-grow-0 justify-content-center">
                                            <i class="fas fa-print me-1"></i> Cetak Bukti
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="detailModal{{ $p->id_reservasi }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
                                    <div class="modal-header modal-header-custom py-3">
                                        <h5 class="modal-title fw-bold text-dark"><i class="fas fa-receipt text-danger me-2"></i> Detail Pesanan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        
                                        @php
                                            $durasiModal = \Carbon\Carbon::parse($p->tgl_check_in)->diffInDays(\Carbon\Carbon::parse($p->tgl_check_out));
                                            if($durasiModal == 0) $durasiModal = 1;
                                        @endphp

                                        <div class="text-center mb-4">
                                            <span class="badge bg-danger px-3 py-2 fs-6 rounded-pill shadow-sm">{{ $p->id_reservasi }}</span>
                                        </div>

                                        <div class="detail-row d-flex justify-content-between">
                                            <span class="detail-item">Tipe Kamar</span>
                                            <span class="detail-value text-danger">{{ $p->kamar->tipe_kamar }}</span>
                                        </div>
                                        
                                        @if($p->nomor_kamar_assigned)
                                        <div class="detail-row d-flex justify-content-between">
                                            <span class="detail-item">Nomor Kamar</span>
                                            <span class="detail-value"><span class="badge bg-secondary"><i class="fas fa-key me-1"></i> {{ $p->nomor_kamar_assigned }}</span></span>
                                        </div>
                                        @endif

                                        <div class="detail-row d-flex justify-content-between">
                                            <span class="detail-item">Check-in</span>
                                            <span class="detail-value">{{ \Carbon\Carbon::parse($p->tgl_check_in)->format('d M Y') }}</span>
                                        </div>
                                        <div class="detail-row d-flex justify-content-between">
                                            <span class="detail-item">Check-out</span>
                                            <span class="detail-value">{{ \Carbon\Carbon::parse($p->tgl_check_out)->format('d M Y') }}</span>
                                        </div>
                                        <div class="detail-row d-flex justify-content-between">
                                            <span class="detail-item">Durasi Menginap</span>
                                            <span class="detail-value">{{ $durasiModal }} Malam</span>
                                        </div>
                                        <div class="detail-row d-flex justify-content-between">
                                            <span class="detail-item">Jumlah Kamar</span>
                                            <span class="detail-value">{{ $p->jumlah_kamar }} Unit</span>
                                        </div>

                                        @if($p->ekstra_orang > 0)
                                        <div class="detail-row d-flex justify-content-between">
                                            <span class="detail-item text-success">Ekstra Orang (x{{ $p->ekstra_orang }})</span>
                                            <span class="detail-value text-success">+ Rp {{ number_format($p->ekstra_orang * 50000 * $durasiModal, 0, ',', '.') }}</span>
                                        </div>
                                        @endif
                                        
                                        @if($p->ekstra_kasur > 0)
                                        <div class="detail-row d-flex justify-content-between">
                                            <span class="detail-item text-success">Ekstra Kasur (x{{ $p->ekstra_kasur }})</span>
                                            <span class="detail-value text-success">+ Rp {{ number_format($p->ekstra_kasur * 75000 * $durasiModal, 0, ',', '.') }}</span>
                                        </div>
                                        @endif

                                        <div class="mt-4 pt-3 border-top d-flex justify-content-between align-items-center">
                                            <span class="fw-bold text-dark fs-5">Total Tagihan</span>
                                            <span class="fw-bold text-danger fs-4">Rp {{ number_format($p->total_bayar, 0, ',', '.') }}</span>
                                        </div>

                                        @if($p->status == 'Batal')
                                        <div class="mt-4 pt-3 border-top text-start">
                                            <h6 class="fw-bold text-danger mb-2"><i class="fas fa-exclamation-triangle me-1"></i> Detail Pembatalan</h6>
                                            <p class="small text-muted mb-2"><strong>Alasan:</strong> {{ $p->alasan_batal ?? 'Dibatalkan oleh sistem/admin.' }}</p>
                                            
                                            @if($p->status_refund == 'Menunggu Refund')
                                                <div class="alert alert-warning py-2 px-3 small m-0 border-0">
                                                    <i class="fas fa-clock me-1"></i> Admin sedang memproses pengembalian dana Anda.
                                                </div>
                                            @elseif($p->status_refund == 'Refund Selesai')
                                                <div class="alert alert-success py-2 px-3 small m-0 border-0">
                                                    <i class="fas fa-check-circle me-1"></i> Dana telah dikembalikan. 
                                                    @if($p->bukti_refund)
                                                        <a href="{{ asset('gambar_bukti/' . $p->bukti_refund) }}" target="_blank" class="fw-bold text-success text-decoration-none ms-1 text-nowrap"><i class="fas fa-receipt me-1"></i>Lihat Bukti</a>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                        @endif

                                    </div>
                                    <div class="modal-footer border-0 pb-4 pt-0 justify-content-center">
                                        <button type="button" class="btn btn-light fw-bold px-4 rounded-pill" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted" id="noDataRow" data-label="">
                                <div class="mb-3"><i class="fas fa-box-open fa-3x text-light"></i></div>
                                <h6 class="fw-bold text-secondary">Belum Ada Pesanan</h6>
                                <p class="small mb-0">Anda belum memiliki riwayat transaksi pemesanan kamar.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#filterStatus').on('change', function() {
                var selectedStatus = $(this).val();
                var visibleRows = 0;

                $('#tabelRiwayat tbody tr').not('#noDataRow').each(function() {
                    if (selectedStatus === 'Semua' || $(this).data('status') === selectedStatus) {
                        $(this).show();
                        visibleRows++;
                    } else {
                        $(this).hide();
                    }
                });

                if(visibleRows === 0 && $('#tabelRiwayat tbody tr').not('#noDataRow').length > 0) {
                    if($('#emptyFilterMsg').length === 0) {
                        $('#tabelRiwayat tbody').append('<tr id="emptyFilterMsg"><td colspan="7" class="text-center py-4 text-muted small" data-label=""><i class="fas fa-search me-2"></i>Tidak ada transaksi dengan status "'+selectedStatus+'".</td></tr>');
                    }
                } else {
                    $('#emptyFilterMsg').remove();
                }
            });
        });
    </script>
</body>
</html>