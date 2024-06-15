@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<div class="col-lg-12 col-xs-12">
    <div class="box-content card white">
        <h4 class="box-title">{{ $judul }}</h4>
        <!-- /.box-title -->
        <div class="card-content">
            <form action="/anggota" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No. Transaksi</label><br>
                            <input type="text" onkeypress="return hanyaAngka(event)" name="notran" value="{{ $notran }}" class="form-control @error('notran') is-invalid @enderror" placeholder="Masukkan notran">
                            @error('notran')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>ID Anggota</label>
                            <select class="form-control @error('anggota_id') is-invalid @enderror" name="anggota_id" id="anggota">
                                <option value="" selected>-- Pilih ID Anggota --</option>
                                @foreach ($anggota as $row)
                                <option value="{{ $row->id }}">{{ $row->user->email }}</option>
                                @endforeach
                            </select>
                            @error('anggota_id')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" readonly>
                            @error('nama')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="produk">ID Produk</label>
                            <select class="form-control @error('produk_id') is-invalid @enderror" name="produk_id" id="produk">
                                <option value="" selected>-- Pilih ID Produk --</option>
                                @foreach ($produk as $row)
                                <option value="{{ $row->id }}">{{ $row->nama_produk }}</option>
                                @endforeach
                            </select>
                            @error('produk_id')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" readonly>
                            @error('harga')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="text" class="form-control @error('stok') is-invalid @enderror" name="stok" id="stok" readonly>
                            @error('stok')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jumlah Beli</label>
                            <input type="text" onkeypress="return hanyaAngka(event)" name="jumbel" value="{{ old('jumbel') }}" class="form-control @error('jumbel') is-invalid @enderror" placeholder="Masukkan Jumlah Beli">
                            @error('jumbel')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <br>
                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
                <a href="{{ route('anggota.index') }}">
                    <button type="button" class="btn waves-effect btn-sm waves-effect waves-light">Kembali</button>
                </a>

            </form>
        </div>
        <!-- /.card-content -->
    </div>
    <!-- /.box-content -->
</div>

<script>
    // data anggota
    document.getElementById('anggota').addEventListener('change', function() {
        var anggotaId = this.value;
        if (anggotaId) {
            fetch(`/get-anggota/${anggotaId}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    document.getElementById('nama').value = data.nama;
                });
        } else {
            document.getElementById('nama').value = '';
        }
    });
    // data produk
    document.getElementById('produk').addEventListener('change', function() {
        var produkId = this.value;
        if (produkId) {
            fetch(`/get-produk/${produkId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('harga').value = data.harga;
                    document.getElementById('stok').value = data.stok;
                    document.getElementById('jumbel').focus();
                });
        } else {
            document.getElementById('harga').value = '';
            document.getElementById('stok').value = '';
        }
    });
</script>


<!-- end template-->
@endsection