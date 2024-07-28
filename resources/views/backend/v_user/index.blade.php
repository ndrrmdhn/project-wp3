@extends('backend.v_layouts.app')
@section('content')
<div class="col-xs-12">
    <div class="box-content">
        <h4 class="box-title">{{ $judul }} <br><br>
            <a href="{{ route('user.create') }}">
                <button type="button" class="btn btn-icon btn-icon-left btn-info btn-xs waves-effect waves-light">
                    <i class="ico fa fa-plus"></i>Tambah</button>
            </a>
        </h4>
        <table id="example" class="table table-striped table-bordered display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($index as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>
                        @if ($row->role == 'admin')
                        <span class="label label-success">Admin</span>
                        @elseif($row->role == 'user')
                        <span class="label label-info">User</span>
                        @endif
                    </td>
                    <td>
                        @if ($row->status == 1)
                        <span class="label label-success">Aktif</span>
                        @elseif($row->status == 0)
                        <span class="label label-default">NonAktif</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('user.show', $row->id) }}" title="Lihat Detail">
                            <span class="label label-info"><i class="fa fa-eye"></i> Lihat</span>
                        </a>
                        <a href="{{ route('user.edit', $row->id) }}" title="Ubah Data">
                            <span class="label label-primary"><i class="fa fa-edit"></i> Ubah</span>
                        </a>
                        <form method="POST" action="{{ route('user.destroy', $row->id) }}" style="display: inline-block;">
                            @method('delete')
                            @csrf
                            <button type="button" class="label label-danger btn-sm show_confirm" data-toggle="tooltip" title="Delete" data-konf-delete="{{ $row->email }}"><i class="fa fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection