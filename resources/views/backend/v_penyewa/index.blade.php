@extends('backend.v_layouts.app')
@section('content')
<div class="col-xs-12">
    <div class="box-content">
        <h4 class="box-title">{{ $judul }} <br><br>
            <a href="{{ route('penyewa.create') }}">
                <button type="button" class="btn btn-icon btn-icon-left btn-info btn-xs waves-effect waves-light">
                    <i class="ico fa fa-plus"></i>Tambah</button>
            </a>
        </h4>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kartu Identitas</th>
                <th>Gender</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
                <th>Kamar ID</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penyewa as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->user_id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>
                        @if($item->kartu_identitas)
                            <img src="{{ asset('storage/kartu_identitas/' . $item->kartu_identitas) }}" alt="Kartu Identitas" width="100">
                            <a href="{{ asset('storage/kartu_identitas/' . $item->kartu_identitas) }}" target="_blank">Lihat Kartu Identitas</a>
                        @else
                            Tidak Ada
                        @endif
                    </td>
                    <td>{{ $item->gender }}</td>
                    <td>{{ $item->tanggal_mulai }}</td>
                    <td>{{ $item->tanggal_selesai }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->kamar_id }}</td>
                    <td>
                        <a href="{{ route('penyewa.show', $item->id) }}" title="Lihat Detail">
                            <span class="label label-info"><i class="fa fa-eye"></i> Lihat</span>
                        </a>
                        <a href="{{ route('penyewa.edit', $item->id) }}" title="Ubah Data">
                            <span class="label label-primary"><i class="fa fa-edit"></i> Ubah</span>
                        </a>
                        <form method="POST" action="{{ route('penyewa.destroy', $item->id) }}" style="display: inline-block;">
                            @method('delete')
                            @csrf
                            <button type="button" class="label label-danger btn-sm show_confirm" data-toggle="tooltip" title="Delete" data-konf-delete="{{ $item->id }}"><i class="fa fa-trash"></i> Hapus</button>
                        </form>
                        {{-- <a href="{{ route('penyewa.show', $item->id) }}" class="btn btn-info btn-sm">Lihat</a> --}}
                        {{-- <a href="{{ route('penyewa.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                        {{-- <form action="{{ route('penyewa.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection