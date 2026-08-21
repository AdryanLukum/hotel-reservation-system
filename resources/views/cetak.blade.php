<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Reservasi - {{ $reservasi->id_reservasi }}</title>
    <style>
        body { font-family: 'Arial', sans-serif; color: #333; padding: 20px; }
        .invoice-box { max-width: 800px; margin: auto; border: 1px solid #eee; padding: 30px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); }
        .header { border-bottom: 2px solid #dc3545; padding-bottom: 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .hotel-name { color: #dc3545; font-size: 24px; font-weight: bold; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .info-table td { padding: 8px 0; vertical-align: top; }
        .details-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .details-table th { background: #f8f9fa; border-bottom: 2px solid #dee2e6; padding: 12px; text-align: left; }
        .details-table td { padding: 12px; border-bottom: 1px solid #dee2e6; }
        .total-section { text-align: right; margin-top: 30px; font-size: 18px; font-weight: bold; }
        .footer-note { margin-top: 50px; font-size: 12px; color: #666; text-align: center; border-top: 1px dashed #ccc; padding-top: 20px; }
        
        .btn { padding: 10px 20px; cursor: pointer; border: none; border-radius: 4px; font-size: 14px; text-decoration: none; display: inline-block; font-weight: bold; }
        .btn-print { background-color: #dc3545; color: white; margin-right: 10px; }
        .btn-back { background-color: #6c757d; color: white; }
        
        @media print { 
            .no-print { display: none !important; } 
            .invoice-box { box-shadow: none; border: none; padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="invoice-box">
        <div class="header">
            <div>
                <div class="hotel-name">HOTEL HIDAYAH</div>
                <div style="font-size: 12px;">JL. Pangeran Kesuma Negara, No. 07, Kotabaru</div>
            </div>
            <div style="text-align: right;">
                <h2 style="margin: 0;">BUKTI RESERVASI</h2>
                <div style="color: #666;">ID: {{ $reservasi->id_reservasi }}</div>
            </div>
        </div>

        <table class="info-table">
            <tr>
                <td width="50%">
                    <strong>Detail Tamu:</strong><br>
                    Nama: {{ $reservasi->tamu->name }}<br>
                    Username: {{ explode('@', $reservasi->tamu->email)[0] }}
                </td>
                <td width="50%" style="text-align: right;">
                    <strong>Waktu Transaksi:</strong><br>
                    {{ \Carbon\Carbon::parse($reservasi->tgl_pesan)->format('d F Y, H:i') }}
                </td>
            </tr>
        </table>

        <table class="details-table">
            <thead>
                <tr>
                    <th>Tipe Kamar</th>
                    <th>No. Kamar</th> <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $reservasi->kamar->tipe_kamar }}</td>
                    <td><strong>{{ $reservasi->nomor_kamar_assigned ?? '-' }}</strong></td> <td>{{ \Carbon\Carbon::parse($reservasi->tgl_check_in)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservasi->tgl_check_out)->format('d-m-Y') }}</td>
                    <td>{{ $reservasi->jumlah_kamar }} Kamar</td>
                </tr>
            </tbody>
        </table>

        <div class="total-section">
            TOTAL BAYAR: Rp {{ number_format($reservasi->total_bayar, 0, ',', '.') }}
            <div style="font-size: 14px; color: green; margin-top: 5px;">Status: {{ $reservasi->status }}</div>
        </div>

        <div class="footer-note">
            Terima kasih telah memilih Hotel Hidayah Kotabaru.<br>
            Harap bawa struk ini saat melakukan Check-In untuk mempercepat proses verifikasi.
        </div>

        <div class="no-print" style="margin-top: 30px; text-align: center;">
            <button onclick="window.print()" class="btn btn-print">Cetak Ulang</button>
            <a href="{{ route('tamu.riwayat') }}" class="btn btn-back">Kembali</a>
        </div>
    </div>
</body>
</html>