@extends('backend.v_layouts.app')

@section('content')
<!-- template -->

<div class="col-xs-12">
    <div class="box-content">
        <h4 class="box-title">{{ $judul }}</h4>
        <br>

        <div class="row">
            <div class="col-md-6">
                <dl class="dl-horizontal">
                    <dt>Nama:</dt>
                    <dd>{{ $pemilik->nama }}</dd>

                    <dt>Telepon:</dt>
                    <dd>{{ $pemilik->telepon }}</dd>

                    <dt>Email:</dt>
                    <dd>{{ $pemilik->email }}</dd>

                    <!-- Add more details as needed -->
                </dl>
            </div>
        </div>

        <div class="box-footer">
            <a href="{{ route('pemilik.index') }}" class="btn btn-default">Kembali</a>
            <a href="{{ route('pemilik.edit', $pemilik->id) }}" class="btn btn-primary">Ubah</a>
        </div>

    </div>
    <!-- /.box-content -->
</div>

<!-- end template -->
@endsection