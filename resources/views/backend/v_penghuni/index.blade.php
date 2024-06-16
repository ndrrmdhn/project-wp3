@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<div class="col-xs-12">
    <div class="box-content">
        <h4 class="box-title">{{ $judul }}</h4>
        <br>
        <a href="{{ route('penghuni.create') }}">
            <button type="button" class="btn btn-icon btn-icon-left btn-info btn-xs waves-effect waves-light">
                <i class="ico fa fa-plus"></i>Tambah
            </button>
        </a>
        <br><br>

        <!-- /.box-title -->

        <!-- /.dropdown js__dropdown -->
        <table id="example" class="table table-striped table-bordered display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Kamar</th>
                    <th>Pemilik</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penghuni as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->telepon }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->kamar->nomor }}</td>
                    <td>{{ $row->pemilik->nama }}</td>
                    <td>
                        <a href="{{ route('penghuni.show', $row->id) }}" title="Lihat Detail">
                            <span class="label label-info"><i class="fa fa-eye"></i> Lihat</span>
                        </a>
                        <a href="{{ route('penghuni.edit', $row->id) }}" title="Ubah Data">
                            <span class="label label-primary"><i class="fa fa-edit"></i> Ubah</span>
                        </a>
                        <form method="POST" action="{{ route('penghuni.destroy', $row->id) }}" style="display: inline-block;">
                            @method('DELETE')
                            @csrf
                            <button type="button" class="label label-danger btn-sm show_confirm" data-toggle="tooltip" title='Delete' data-konf-delete="{{ $row->nama }}"><i class="fa fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-content -->
</div>

<!-- end template-->
@endsection