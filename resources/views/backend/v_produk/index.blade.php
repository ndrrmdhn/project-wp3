@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<div class="col-xs-12">

    <div class="box-content">

        <h4 class="box-title"> {{$judul}} <br><br>
            <a href="/produk/create">
                <button type="button" class="btn btn-icon btn-icon-left btn-info btn-xs waves-effect waves-light">
                    <i class="ico fa fa-plus"></i>Tambah</button>
            </a>
        </h4>

        <!-- /.box-title -->

        <!-- /.dropdown js__dropdown -->
        <table id="example" class="table table-striped table-bordered display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Status</th>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($index as $row)
                <tr>
                    <td> {{ $loop->iteration }}</td>
                    <td>
                        @if ($row->status ==1)
                        <span class="label label-success"></i>
                            Publis</span>
                        @elseif($row->status ==0)
                        <span class="label label-default"></i>
                            Blok</span>
                        @endif
                    </td>
                    <td> {{ $row->kategori->nama_kategori }} </td>
                    <td> {{ $row->nama_produk }} </td>
                    <td> Rp. {{ number_format($row->harga, 0, ',', '.') }} </td>
                    <td>
                        <a href="/produk/{{ $row->id }}/edit" title="Ubah Data">
                            <span class="label label-primary"><i class="fa fa-edit"></i> Ubah</span>
                        </a>
                        <form method="POST" action="{{ route('produk.destroy', $row->id) }}" style="display: inline-block;">
                            @method('delete')
                            @csrf
                            <button type="button" class="label label-danger btn-sm show_confirm" data-toggle="tooltip" title='Delete' data-konf-delete="{{ $row->nama_produk }}"><i class="fa fa-trash"></i>Hapus</button></button>
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