@extends('backend.v_layouts.app')
@section('content')
<div class="col-xs-12">
    <div class="box-content">
        <h4 class="box-title">{{ $judul }} <br><br>
            <a href="{{ route('pembayaran.create') }}">
                <button type="button" class="btn btn-icon btn-icon-left btn-info btn-xs waves-effect waves-light">
                    <i class="ico fa fa-plus"></i>Tambah</button>
            </a>
        </h4>

        <table id="example" class="table table-striped table-bordered display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Pembayaran</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Keterangan</th>
                    <th>Nama Penyewa</th>
                    <th>Nomor Kamar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembayaran as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->nomor_pembayaran }}</td>
                    <td>{{ $row->tanggal_pembayaran }}</td>
                    <td>Rp. {{ number_format($row->jumlah_pembayaran, 0, ',', '.') }}</td>
                    <td>{{ $row->keterangan ?? '-' }}</td>
                    <td>{{ $row->penyewa->nama }}</td>
                    <td>{{ $row->kamar->nomor }}</td>
                    <td>
                        <a href="{{ route('pembayaran.show', $row->id) }}" title="Lihat Detail">
                            <span class="label label-info"><i class="fa fa-eye"></i> Lihat</span>
                        </a>
                        <a href="{{ route('pembayaran.edit', $row->id) }}" title="Ubah Data">
                            <span class="label label-primary"><i class="fa fa-edit"></i> Ubah</span>
                        </a>
                        <form method="POST" action="{{ route('pembayaran.destroy', $row->id) }}" style="display: inline-block;">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="label label-danger btn-sm show_confirm" data-toggle="tooltip" title='Hapus' data-konf-delete="{{ $row->nomor_pembayaran }}"><i class="fa fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("konf-delete");
        event.preventDefault();
        Swal.fire({
            title: Apakah Anda yakin ingin menghapus ${name}?,
            text: "Jika Anda menghapus ini, data akan hilang selamanya.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Tidak, batalkan!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endpush