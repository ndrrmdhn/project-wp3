@extends('backend.v_layouts.app')
@section('content')
<div class="col-xs-12">
    <div class="box-content">
        <h4 class="box-title">{{ $judul }}</h4>

        <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nomor_pembayaran">Nomor Pembayaran</label>
                <input type="text" name="nomor_pembayaran" id="nomor_pembayaran" class="form-control" value="{{ old('nomor_pembayaran', $pembayaran->nomor_pembayaran) }}" required>
                @error('nomor_pembayaran')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
                <input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran" class="form-control" value="{{ old('tanggal_pembayaran', $pembayaran->tanggal_pembayaran) }}" required>
                @error('tanggal_pembayaran')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="jumlah_pembayaran">Jumlah Pembayaran</label>
                <input type="number" name="jumlah_pembayaran" id="jumlah_pembayaran" class="form-control" value="{{ old('jumlah_pembayaran', $pembayaran->jumlah_pembayaran) }}" required>
                @error('jumlah_pembayaran')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="keterangan">Keterangan (Lunas/Belum Lunas)</label>
                <textarea name="keterangan" id="keterangan" class="form-control">{{ old('keterangan', $pembayaran->keterangan) }}</textarea>
                @error('keterangan')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="penyewa_id">Penyewa</label>
                <select name="penyewa_id" id="penyewa_id" class="form-control" required>
                    <option value="">Pilih Penyewa</option>
                    @foreach($penyewa as $p)
                        <option value="{{ $p->id }}" {{ old('penyewa_id', $pembayaran->penyewa_id) == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                    @endforeach
                </select>
                @error('penyewa_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="kamar_id">Kamar</label>
                <select name="kamar_id" id="kamar_id" class="form-control" required>
                    <option value="">Pilih Kamar</option>
                    @foreach($kamar as $k)
                        <option value="{{ $k->id }}" {{ old('kamar_id', $pembayaran->kamar_id) == $k->id ? 'selected' : '' }}>{{ $k->nomor }}</option>
                    @endforeach
                </select>
                @error('kamar_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('pembayaran.index') }}" class="btn btn-default">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection