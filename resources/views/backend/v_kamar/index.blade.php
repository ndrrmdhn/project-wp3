@extends('backend.v_layouts.app')
@section('content')
<div class="col-xs-12">
    <div class="box-content">
        <h4 class="box-title">{{ $judul }} <br><br>
            @if(auth()->user()->role == 'admin') <!-- Cek apakah pengguna adalah admin -->
                <a href="{{ route('kamar.create') }}">
                    <button type="button" class="btn btn-icon btn-icon-left btn-info btn-xs waves-effect waves-light">
                        <i class="ico fa fa-plus"></i>Tambah</button>
                </a>
            @endif
        </h4>

        <table id="example" class="table table-striped table-bordered display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor</th>
                    <th>Harga</th>
                    <th>Luas</th>
                    <th>Tipe Kamar</th>
                    <th>Status</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kamar as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->nomor }}</td>
                    <td>Rp. {{ number_format($row->harga, 0, ',', '.') }}</td>
                    <td>{{ $row->luas }} m²</td>
                    <td>{{ ucfirst($row->tipe_kamar) }}</td>
                    <td>
                        @if ($row->status == 'tersedia')
                        <span class="label label-success">Tersedia</span>
                        @elseif($row->status == 'disewa')
                        <span class="label label-warning">Disewa</span>
                        @elseif($row->status == 'terbooking')
                        <span class="label label-primary">Terbooking</span>
                        @endif
                    </td>
                    <td>{{ $row->alamat }}</td>
                    <td>
                        <a href="{{ route('kamar.show', $row->id) }}" title="Lihat Detail">
                            <span class="label label-info"><i class="fa fa-eye"></i> Lihat</span>
                        </a>
                        @if(auth()->user()->role == 'admin') <!-- Cek apakah pengguna adalah admin -->
                            <a href="{{ route('kamar.edit', $row->id) }}" title="Ubah Data">
                                <span class="label label-primary"><i class="fa fa-edit"></i> Ubah</span>
                            </a>
                            <form method="POST" action="{{ route('kamar.destroy', $row->id) }}" style="display: inline-block;">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="label label-danger btn-sm show_confirm" data-toggle="tooltip" title="Hapus" data-konf-delete="{{ $row->id }}">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
