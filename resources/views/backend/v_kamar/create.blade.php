@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<div class="col-xs-12">
    <div class="box-content">
        <h4 class="box-title">{{ $judul }}</h4>
        <!-- /.box-title -->

        <form action="{{ route('kamar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="pemilik">Pemilik</label>
                <input type="text" class="form-control" id="pemilik" name="pemilik" value="{{ old('pemilik') }}" required>
            </div>

            <div class="form-group">
                <label for="nomor">Nomor Kamar</label>
                <input type="text" class="form-control" id="nomor" name="nomor" value="{{ old('nomor') }}" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" required>
            </div>

            <div class="form-group">
                <label for="luas">Luas</label>
                <input type="number" class="form-control" id="luas" name="luas" value="{{ old('luas') }}" required>
            </div>

            <div class="form-group">
                <label for="tipe_kamar">Tipe Kamar</label>
                <select class="form-control" id="tipe_kamar" name="tipe_kamar" required>
                    <option value="putra" {{ old('tipe_kamar') == 'putra' ? 'selected' : '' }}>Putra</option>
                    <option value="putri" {{ old('tipe_kamar') == 'putri' ? 'selected' : '' }}>Putri</option>
                    <option value="campuran" {{ old('tipe_kamar') == 'campuran' ? 'selected' : '' }}>Campuran</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="disewa" {{ old('status') == 'disewa' ? 'selected' : '' }}>Disewa</option>
                    <option value="terbooking" {{ old('status') == 'terbooking' ? 'selected' : '' }}>Terbooking</option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}" required>
            </div>

            <div class="form-group">
                <label for="fasilitas_ac">Fasilitas AC</label>
                <input type="checkbox" id="fasilitas_ac" name="fasilitas_ac" value="1" {{ old('fasilitas_ac') ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="fasilitas_wifi">Fasilitas Wifi</label>
                <input type="checkbox" id="fasilitas_wifi" name="fasilitas_wifi" value="1" {{ old('fasilitas_wifi') ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="fasilitas_tv">Fasilitas TV</label>
                <input type="checkbox" id="fasilitas_tv" name="fasilitas_tv" value="1" {{ old('fasilitas_tv') ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="fasilitas_perabotan">Fasilitas Perabotan</label>
                <input type="checkbox" id="fasilitas_perabotan" name="fasilitas_perabotan" value="1" {{ old('fasilitas_perabotan') ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="fasilitas_dapur">Fasilitas Dapur</label>
                <input type="checkbox" id="fasilitas_dapur" name="fasilitas_dapur" value="1" {{ old('fasilitas_dapur') ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="fasilitas_kamar_mandi_dalam">Fasilitas Kamar Mandi Dalam</label>
                <input type="checkbox" id="fasilitas_kamar_mandi_dalam" name="fasilitas_kamar_mandi_dalam" value="1" {{ old('fasilitas_kamar_mandi_dalam') ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="fasilitas_keamanan_24_jam">Fasilitas Keamanan 24 Jam</label>
                <input type="checkbox" id="fasilitas_keamanan_24_jam" name="fasilitas_keamanan_24_jam" value="1" {{ old('fasilitas_keamanan_24_jam') ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="fasilitas_tempat_parkir">Fasilitas Tempat Parkir</label>
                <input type="checkbox" id="fasilitas_tempat_parkir" name="fasilitas_tempat_parkir" value="1" {{ old('fasilitas_tempat_parkir') ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="foto_utama">Foto Utama</label>
                <input type="file" class="form-control" id="foto_utama" name="foto_utama">
            </div>

            <div class="form-group">
                <label for="foto_tambahan">Foto Tambahan</label>
                <input type="file" class="form-control" id="foto_tambahan" name="foto_tambahan[]" multiple>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kamar.index') }}">
                <button type="button" class="btn waves-effect btn-sm waves-effect waves-light">Kembali</button>
            </a>
        </form>
    </div>
    <!-- /.box-content -->
</div>

<!-- end template-->
@endsection