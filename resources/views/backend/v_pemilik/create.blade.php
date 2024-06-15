@extends('backend.v_layouts.app')

@section('content')
<!-- template -->

<div class="col-xs-12">
    <div class="box-content">
        <h4 class="box-title">{{ $judul }}</h4>
        <br>

        <!-- Form -->
        <form method="POST" action="{{ route('pemilik.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <!-- Add more fields as needed -->

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('pemilik.index') }}" class="btn btn-default">Batal</a>
        </form>
        <!-- End Form -->

    </div>
    <!-- /.box-content -->
</div>

<!-- end template -->
@endsection