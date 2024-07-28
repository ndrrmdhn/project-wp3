@extends('backend.v_layouts.app')
@section('content')
<div class="col-xs-12">
    <div class="box-content">
        <h4 class="box-title">{{ $judul }}</h4>
        <form action="{{ route('kamar.update', $kamar->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nomor">Nomor Kamar</label>
                <input type="text" class="form-control" id="nomor" name="nomor" value="{{ old('nomor', $kamar->nomor) }}" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi">{{ old('deskripsi', $kamar->deskripsi) }}</textarea>
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga', $kamar->harga) }}" required>
            </div>

            <div class="form-group">
                <label for="luas">Luas</label>
                <input type="number" class="form-control" id="luas" name="luas" value="{{ old('luas', $kamar->luas) }}" required>
            </div>

            <div class="form-group">
                <label for="tipe_kamar">Tipe Kamar</label>
                <select class="form-control" id="tipe_kamar" name="tipe_kamar" required>
                    <option value="putra" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'putra' ? 'selected' : '' }}>Putra</option>
                    <option value="putri" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'putri' ? 'selected' : '' }}>Putri</option>
                    <option value="campuran" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'campuran' ? 'selected' : '' }}>Campuran</option>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="tersedia" {{ old('status', $kamar->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="disewa" {{ old('status', $kamar->status) == 'disewa' ? 'selected' : '' }}>Disewa</option>
                    <option value="terbooking" {{ old('status', $kamar->status) == 'terbooking' ? 'selected' : '' }}>Terbooking</option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $kamar->alamat) }}" required>
            </div>

            <div class="form-group">
                <label for="fasilitas_ac">Fasilitas AC</label>
                <input type="checkbox" id="fasilitas_ac" name="fasilitas_ac" value="1" {{ old('fasilitas_ac', $kamar->fasilitas_ac) ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="fasilitas_wifi">Fasilitas Wifi</label>
                <input type="checkbox" id="fasilitas_wifi" name="fasilitas_wifi" value="1" {{ old('fasilitas_wifi', $kamar->fasilitas_wifi) ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="fasilitas_tv">Fasilitas TV</label>
                <input type="checkbox" id="fasilitas_tv" name="fasilitas_tv" value="1" {{ old('fasilitas_tv', $kamar->fasilitas_tv) ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="fasilitas_perabotan">Fasilitas Perabotan</label>
                <input type="checkbox" id="fasilitas_perabotan" name="fasilitas_perabotan" value="1" {{ old('fasilitas_perabotan', $kamar->fasilitas_perabotan) ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="fasilitas_dapur">Fasilitas Dapur</label>
                <input type="checkbox" id="fasilitas_dapur" name="fasilitas_dapur" value="1" {{ old('fasilitas_dapur', $kamar->fasilitas_dapur) ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="fasilitas_kamar_mandi_dalam">Fasilitas Kamar Mandi Dalam</label>
                <input type="checkbox" id="fasilitas_kamar_mandi_dalam" name="fasilitas_kamar_mandi_dalam" value="1" {{ old('fasilitas_kamar_mandi_dalam', $kamar->fasilitas_kamar_mandi_dalam) ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="fasilitas_keamanan_24_jam">Fasilitas Keamanan 24 Jam</label>
                <input type="checkbox" id="fasilitas_keamanan_24_jam" name="fasilitas_keamanan_24_jam" value="1" {{ old('fasilitas_keamanan_24_jam', $kamar->fasilitas_keamanan_24_jam) ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="fasilitas_tempat_parkir">Fasilitas Tempat Parkir</label>
                <input type="checkbox" id="fasilitas_tempat_parkir" name="fasilitas_tempat_parkir" value="1" {{ old('fasilitas_tempat_parkir', $kamar->fasilitas_tempat_parkir) ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
                @if ($kamar->foto)
                    <img src="{{ asset('storage/' . $kamar->foto) }}" alt="Foto" class="img-thumbnail" style="width: 150px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kamar.index') }}">
                <button type="button" class="btn waves-effect btn-sm waves-effect waves-light">Kembali</button>
            </a>
        </form>
    </div>
</div>
@endsection