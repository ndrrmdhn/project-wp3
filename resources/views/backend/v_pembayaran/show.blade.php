@extends('backend.v_layouts.app')
@section('content')
<div class="col-xs-12">
    <div class="box-content">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="box-title text-center mb-4">{{ $judul }}</h4>
                
                <table class="table table-borderless">
                    <tr>
                        <th scope="row" class="w-25">Nomor Pembayaran:</th>
                        <td>{{ $pembayaran->nomor_pembayaran }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal Pembayaran:</th>
                        <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Jumlah Pembayaran:</th>
                        <td style="font-weight: bold; color: red;">
                            Rp. {{ number_format($pembayaran->jumlah_pembayaran, 0, ',', '.') }}
                        </td>                        
                    </tr>
                    <tr>
                        <th scope="row">Keterangan (Lunas/Belum Lunas):</th>
                        <td>{{ $pembayaran->keterangan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nama Penyewa:</th>
                        <td>{{ $pembayaran->penyewa->nama }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Nomor Kamar:</th>
                        <td>{{ $pembayaran->kamar->nomor }}</td>
                    </tr>
                </table>

                <div class="text-center mt-4">
                    <a href="{{ route('pembayaran.index') }}" class="btn btn-default">Kembali</a>
                    <a href="{{ route('pembayaran.edit', $pembayaran->id) }}" class="btn btn-primary" 
                        @if(auth()->user()->role != 'admin') style="display: none;" @endif> <!-- Cek apakah pengguna adalah admin -->
                        Ubah
                    </a>                    
                    <button onclick="window.print()" class="btn btn-success">Cetak</button>
                    <button onclick="sharePayment()" class="btn btn-success">
                        <i class="fab fa-whatsapp"></i> Bagikan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function sharePayment() {
        const nomorPembayaran = "{{ $pembayaran->nomor_pembayaran }}";
        const tanggalPembayaran = "{{ $pembayaran->tanggal_pembayaran }}";
        const jumlahPembayaran = "Rp. {{ number_format($pembayaran->jumlah_pembayaran, 0, ',', '.') }}";
        const keterangan = "{{ $pembayaran->keterangan ?? '-' }}";
        const namaPenyewa = "{{ $pembayaran->penyewa->nama }}";
        const nomorKamar = "{{ $pembayaran->kamar->nomor }}";

        const message = `Nomor Pembayaran: ${nomorPembayaran}\nTanggal Pembayaran: ${tanggalPembayaran}\nJumlah Pembayaran: ${jumlahPembayaran}\nKeterangan: ${keterangan}\nNama Penyewa: ${namaPenyewa}\nNomor Kamar: ${nomorKamar}`;
        
        const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
        
        window.open(whatsappUrl, '_blank');
    }
</script>
@endsection

<style>
    @media print {
        .btn, .navbar, .card-header, .footer, .form-group {
            display: none;
        }
        .card {
            border: none;
        }
        .card-body {
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            width: 30%;
        }
    }
</style>