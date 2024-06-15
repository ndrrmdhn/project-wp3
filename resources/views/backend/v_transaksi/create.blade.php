@extends('backend.v_layouts.app')
@section('content')
<div class="col-lg-12 col-xs-12">
    <div class="box-content card white">
        <h4 class="box-title">{{ $judul }}</h4>
        <div class="card-content">
            <form action="{{ route('transaksi.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No. Transaksi</label><br>
                            <input type="text" name="notran" value="{{ $notran }}" class="form-control @error('notran') is-invalid @enderror" readonly>
                            @error('notran')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
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
                </div>


                <h5>Detail Produk</h5>

                <button type="button" class="btn btn-icon btn-icon-left btn-info btn-xs waves-effect waves-light add-produk">
                    <i class="ico fa fa-plus"></i>Tambah Produk</button>

                <!-- <button type="button" class="btn btn-primary add-produk">Tambah Produk</button> -->
                <div id="produk-container">
                    <div class="row produk-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>ID Produk</label>
                                <select class="form-control produk-select @error('produk_id') is-invalid @enderror" name="produk_id[]" id="produk">
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
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga[]" id="harga" readonly>
                                @error('harga')
                                <span class="invalid-feedback alert-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="text" class="form-control @error('stok') is-invalid @enderror" name="stok[]" id="stok" readonly>
                                @error('stok')
                                <span class="invalid-feedback alert-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Jumlah Beli</label>
                                <input type="number" class="form-control @error('jumbel') is-invalid @enderror" name="jumbel[]" id="jumbel">
                                @error('jumbel')
                                <span class="invalid-feedback alert-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-produk" style="margin-top: 24px;">Hapus</button>
                        </div>
                    </div>
                </div>


                <br><br>
                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Simpan</button>
                <a href="{{ route('anggota.index') }}">
                    <button type="button" class="btn waves-effect btn-sm waves-effect waves-light">Kembali</button>
                </a>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('anggota').addEventListener('change', function() {
        var anggotaId = this.value;
        if (anggotaId) {
            fetch(`/get-anggota/${anggotaId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('nama').value = data.nama;
                });
        } else {
            document.getElementById('nama').value = '';
        }
    });

    document.addEventListener('change', function(e) {
        if (e.target && e.target.classList.contains('produk-select')) {
            var produkId = e.target.value;
            var parentRow = e.target.closest('.produk-row');
            if (produkId) {
                fetch(`/get-produk/${produkId}`)
                    .then(response => response.json())
                    .then(data => {
                        parentRow.querySelector('#harga').value = data.harga;
                        parentRow.querySelector('#stok').value = data.stok;
                        parentRow.querySelector('#jumbel').focus();
                    });
            } else {
                parentRow.querySelector('#harga').value = '';
                parentRow.querySelector('#stok').value = '';
            }
        }
    });

    document.querySelector('.add-produk').addEventListener('click', function() {
        var container = document.getElementById('produk-container');
        var row = container.querySelector('.produk-row').cloneNode(true);
        row.querySelectorAll('input').forEach(input => input.value = '');
        container.appendChild(row);
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-produk')) {
            e.target.closest('.produk-row').remove();
        }
    });
</script>
@endsection