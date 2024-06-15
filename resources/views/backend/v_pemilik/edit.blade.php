@extends('backend.v_layouts.app')

@section('content')
<!-- template -->

<div class="col-xs-12">
    <div class="box-content">
        <h4 class="box-title">{{ $judul }}</h4>
        <br>

        <!-- Form -->
        <form method="POST" action="{{ route('pemilik.update', $pemilik->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $pemilik->nama }}" required>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $pemilik->telepon }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $pemilik->email }}" required>
            </div>
            <!-- Add more fields as needed -->

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('pemilik.index') }}" class="btn btn-default">Batal</a>
        </form>
        <!-- End Form -->

    </div>
    <!-- /.box-content -->
</div>

<!-- end template -->
@endsection