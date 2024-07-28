@extends('backend.v_layouts.app')
@section('content')
<div class="col-lg-12 col-xs-12">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="box-title">{{ $judul }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th scope="row" class="w-25">Nama:</th>
                            <td>{{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nomor HP:</th>
                            <td>{{ $user->hp }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Foto:</th>
                            <td>
                                @if ($user->foto)
                                    <img src="{{ asset('storage/img-user/' . $user->foto) }}" class="img-thumbnail" width="200">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th scope="row">Status:</th>
                            <td>
                                @if ($user->status == 1)
                                    <span class="label label-success">Aktif</span>
                                @else
                                    <span class="label label-default">Nonaktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="w-25">Hak Akses:</th>
                            <td>
                                @if ($user->role == 'admin')
                                    <span class="label label-success">Admin</span>
                                @else
                                    <span class="label label-info">User</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Dibuat pada:</th>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Terakhir diperbarui:</th>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
