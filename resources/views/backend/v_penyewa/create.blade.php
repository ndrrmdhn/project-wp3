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

        <form action="{{ route('penyewa.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @if($user->isEmpty())
                        <option value="">Semua user sudah dipilih</option>
                    @else
                        @foreach($user as $u)
                            <option value="{{ $u->id }}">{{ $u->nama }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            
            <div class="mb-3">
                <label for="kamar_id" class="form-label">Kamar ID</label>
                <select name="kamar_id" id="kamar_id" class="form-control" required>
                    @if($kamar->isEmpty())
                        <option value="">Semua kamar sudah dipilih</option>
                    @else
                        @foreach($kamar as $k)
                            <option value="{{ $k->id }}">{{ $k->nomor }}</option>
                        @endforeach
                    @endif
                </select>
            </div>            
            
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="kartu_identitas" class="form-label">Kartu Identitas</label>
                <input type="file" name="kartu_identitas" id="kartu_identitas" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="aktif">Aktif</option>
                    <option value="tidak aktif">Tidak Aktif</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('penyewa.index') }}" class="btn btn-default">Kembali</a>
            </div>
        </form>
    </div>
@endsection