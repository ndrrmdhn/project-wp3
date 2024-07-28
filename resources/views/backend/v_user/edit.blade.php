@extends('backend.v_layouts.app')
@section('content')
<div class="col-lg-12 col-xs-12">
    <div class="box-content card white">
        <h4 class="box-title">{{ $judul }}</h4>
        <div class="card-content">
            <form action="{{ url('/user/' . $edit->id) }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            @if ($edit->foto)
                            <img src="{{ asset('storage/img-user/' . $edit->foto) }}" class="foto-preview img-responsive" width="100%">
                            @else
                            <img src="{{ asset('storage/img-user/img-default.jpg') }}" class="foto-preview img-responsive" width="100%">
                            @endif
                            <input type="file" id="foto" name="foto" class="form-control-file @error('foto') is-invalid @enderror" onchange="previewFoto()">
                            @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="role">Hak Akses</label>
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                <option value="" {{ old('role', $edit->role) == '' ? 'selected' : '' }}> - Pilih Hak Akses - </option>
                                <option value="admin" {{ old('role', $edit->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('role', $edit->role) == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="" {{ old('status', $edit->status) == '' ? 'selected' : '' }}> - Pilih Status - </option>
                                <option value="1" {{ old('status', $edit->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status', $edit->status) == '0' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama', $edit->nama) }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama">
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $edit->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="hp">HP</label>
                            <input type="text" id="hp" name="hp" value="{{ old('hp', $edit->hp) }}" class="form-control @error('hp') is-invalid @enderror" placeholder="Masukkan Nomor HP" onkeypress="return hanyaAngka(event)">
                            @error('hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">Perbaharui</button>
                    <a href="{{ route('user.index') }}" class="btn btn-default btn-sm waves-effect waves-light">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewFoto() {
        var fileInput = document.getElementById('foto');
        var preview = document.querySelector('.foto-preview');

        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
            }

            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>
@endpush