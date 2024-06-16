@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<div class="col-xs-12">
    <div class="box-content">
        <h4 class="box-title">{{ $judul }}</h4>
        <br>
        <form action="{{ route('penghuni.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="text" name="telepon" id="telepon" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kamar_id">Kamar:</label>
                <select name="kamar_id" id="kamar_id" class="form-control" required>
                    @foreach ($kamar as $item)
                        <option value="{{ $item->id }}">{{ $item->nomor }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="pemilik_id">Pemilik:</label>
                <select name="pemilik_id" id="pemilik_id" class="form-control" required>
                    @foreach ($pemilik as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('penghuni.index') }}">
                <button type="button" class="btn waves-effect btn-sm waves-effect waves-light">Kembali</button>
            </a>
        </form>
    </div>
    <!-- /.box-content -->
</div>

<!-- end template-->
@endsection