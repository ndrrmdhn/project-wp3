@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<div class="col-xs-12">
    <div class="box-content">
        <h4 class="box-title">{{ $judul }}</h4>
        <br>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>Pemilik</strong></td>
                            <td>{{ $kamar->pemilik }}</td>
                        </tr>
                        <tr>
                            <td><strong>Nomor</strong></td>
                            <td>{{ $kamar->nomor }}</td>
                        </tr>
                        <tr>
                            <td><strong>Deskripsi</strong></td>
                            <td>{{ $kamar->deskripsi ?: '-' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Harga</strong></td>
                            <td>Rp. {{ number_format($kamar->harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Luas</strong></td>
                            <td>{{ $kamar->luas }} m²</td>
                        </tr>
                        <tr>
                            <td><strong>Tipe Kamar</strong></td>
                            <td>{{ ucfirst($kamar->tipe_kamar) }}</td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>
                                @if ($kamar->status == 'tersedia')
                                <span class="label label-success">Tersedia</span>
                                @elseif ($kamar->status == 'disewa')
                                <span class="label label-warning">Disewa</span>
                                @elseif ($kamar->status == 'terbooking')
                                <span class="label label-primary">Terbooking</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>{{ $kamar->alamat }}</td>
                        </tr>
                        <tr>
                            <td><strong>Fasilitas</strong></td>
                            <td>
                                @if ($kamar->fasilitas_ac)
                                <span class="label label-info">AC</span>
                                @endif
                                @if ($kamar->fasilitas_wifi)
                                <span class="label label-info">WiFi</span>
                                @endif
                                @if ($kamar->fasilitas_tv)
                                <span class="label label-info">TV</span>
                                @endif
                                @if ($kamar->fasilitas_perabotan)
                                <span class="label label-info">Perabotan</span>
                                @endif
                                @if ($kamar->fasilitas_dapur)
                                <span class="label label-info">Dapur</span>
                                @endif
                                @if ($kamar->fasilitas_kamar_mandi_dalam)
                                <span class="label label-info">Kamar Mandi Dalam</span>
                                @endif
                                @if ($kamar->fasilitas_keamanan_24_jam)
                                <span class="label label-info">Keamanan 24 Jam</span>
                                @endif
                                @if ($kamar->fasilitas_tempat_parkir)
                                <span class="label label-info">Tempat Parkir</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Foto Utama</strong></td>
                            <td>
                                @if ($kamar->foto_utama)
                                <img src="{{ asset('storage/img-kamar/' . $kamar->foto_utama) }}" alt="Foto Utama" class="img-thumbnail" style="max-width: 300px;">
                                @else
                                <span>Tidak ada foto utama</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Foto Tambahan</strong></td>
                            <td>
                                @if ($kamar->foto_tambahan)
                                @foreach ($kamar->foto_tambahan as $foto)
                                <img src="{{ asset('storage/img-kamar/' . $foto) }}" alt="Foto Tambahan" class="img-thumbnail" style="max-width: 150px; margin-right: 10px;">
                                @endforeach
                                @else
                                <span>Tidak ada foto tambahan</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('kamar.index') }}">
                    <button type="button" class="btn waves-effect btn-sm waves-effect waves-light">Kembali</button>
                </a>
            </div>
        </div>
    </div>
    <!-- /.box-content -->
</div>

<!-- end template-->
@endsection