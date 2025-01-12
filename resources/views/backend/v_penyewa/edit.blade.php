@extends('backend.v_layouts.app')
@section('content')
<div class="col-xs-12">
        <h1>{{ $judul }}</h1>
        <br>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('penyewa.update', $penyewa->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @if($user->isEmpty())
                        <option value="">Tidak ada user tersedia</option>
                    @else
                        @foreach($user as $u)
                            <option value="{{ $u->id }}" {{ $penyewa->user_id == $u->id ? 'selected' : '' }}>
                                {{ $u->nama }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
            
            <div class="mb-3">
                <label for="kamar_id" class="form-label">Kamar ID</label>
                <select name="kamar_id" id="kamar_id" class="form-control" required>
                    @if($kamar->isEmpty())
                        <option value="">Tidak ada kamar tersedia</option>
                    @else
                        @foreach($kamar as $k)
                            <option value="{{ $k->id }}" {{ $penyewa->kamar_id == $k->id ? 'selected' : '' }}>
                                {{ $k->nomor }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>            
            
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $penyewa->nama) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat', $penyewa->alamat) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="kartu_identitas" class="form-label">Kartu Identitas</label>
                @if($penyewa->kartu_identitas)
                    <div class="mb-2">
                        <a href="{{ asset('storage/kartu_identitas/' . $penyewa->kartu_identitas) }}" target="_blank">Lihat Kartu Identitas Saat Ini</a>
                    </div>
                @endif
                <input type="file" name="kartu_identitas" id="kartu_identitas" class="form-control">
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah kartu identitas.</small>
            </div>
            
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="laki-laki" {{ $penyewa->gender == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="perempuan" {{ $penyewa->gender == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $penyewa->tanggal_mulai) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $penyewa->tanggal_selesai) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="aktif" {{ $penyewa->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="tidak aktif" {{ $penyewa->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            <br> 
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('penyewa.index') }}" class="btn btn-default">Kembali</a>
        </form>
    </div>
@endsection