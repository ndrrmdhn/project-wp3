@extends('backend.v_layouts.app')
@section('content')
<div class="col-xs-12">
    <h1 class="mb-4">{{ $judul }}</h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th scope="row" class="w-25">ID:</th>
                            <td>{{ $penyewa->id }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nama:</th>
                            <td>{{ $penyewa->nama }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Alamat:</th>
                            <td>{{ $penyewa->alamat }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Gender:</th>
                            <td>{{ $penyewa->gender }}</td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25">Kartu Identitas:</th>
                            <td>
                                @if($penyewa->kartu_identitas)
                                    <img src="{{ asset('storage/kartu_identitas/' . $penyewa->kartu_identitas) }}" alt="Kartu Identitas" class="img-thumbnail" style="max-width: 300px;">
                                @else
                                    Tidak Ada
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th scope="row">User ID:</th>
                            <td>{{ $penyewa->user_id }} ({{ $penyewa->user->nama ?? 'Tidak Diketahui' }})</td>
                        </tr>
                        <tr>
                            <th scope="row">Kamar ID:</th>
                            <td>{{ $penyewa->kamar_id }} ({{ $penyewa->kamar->nomor ?? 'Tidak Diketahui' }})</td>
                        </tr>
                        <tr>
                            <th scope="row">Status:</th>
                            <td>{{ $penyewa->status }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Tanggal Mulai:</th>
                            <td>{{ $penyewa->tanggal_mulai }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Tanggal Selesai:</th>
                            <td>{{ $penyewa->tanggal_selesai }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <a href="{{ route('penyewa.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('penyewa.edit', $penyewa->id) }}" class="btn btn-primary">Edit Penyewa</a>
    </div>
</div>
@endsection
