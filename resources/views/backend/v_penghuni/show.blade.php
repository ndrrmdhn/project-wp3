@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<div class="col-xs-12">
    <div class="box-content">
        <h4 class="box-title">{{ $judul }}</h4>
        <br>
        <table class="table table-bordered">
            <tr>
                <th>Nama:</th>
                <td>{{ $penghuni->nama }}</td>
            </tr>
            <tr>
                <th>Telepon:</th>
                <td>{{ $penghuni->telepon }}</td>
            </tr>
            <tr>
                <th>Email:</th>
                <td>{{ $penghuni->email }}</td>
            </tr>
            <tr>
                <th>Kamar:</th>
                <td>{{ $penghuni->kamar->nomor }}</td>
            </tr>
            <tr>
                <th>Pemilik:</th>
                <td>{{ $penghuni->pemilik->nama }}</td>
            </tr>
        </table>
        <a href="{{ route('penghuni.index') }}">
            <button type="button" class="btn waves-effect btn-sm waves-effect waves-light">Kembali</button>
        </a>
    </div>
    <!-- /.box-content -->
</div>

<!-- end template-->
@endsection