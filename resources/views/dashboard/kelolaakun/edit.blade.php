@extends('dashboard.layouts.mainDashboard')

@section('container')
<div class="main-pages">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Akun User</h1>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card justify-content-center">
                    <div class="card-body">
                        <form action="{{ url('kelolaakun/'. $user->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="mb-2">
                                <label class="form-label" for="nama">Nama</label>
                                <input type="text" id="nama" name="nama" class="form-control @error('nama')is-invalid @enderror" value="{{$user->nama}}" required />
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label class="form-label" for="username">username</label>
                                <input type="text" id="username" name="username" class="form-control @error('username')is-invalid @enderror" value="{{$user->username}}" required />
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>




                            <div class="mb-2">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control" value=""  />
                               

                                <div class="mb-2">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <input type="text" id="alamat" name="alamat" class="form-control @error('alamat')is-invalid @enderror" value="{{$user->alamat}}" required />
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message}}
                                    </div>
                                    @enderror

                                    <div class="mb-2">
                                        <label class="form-label" for="nohp">No HP</label>
                                        <input type="text" id="nohp" name="nohp" class="form-control @error('nohp')is-invalid @enderror" value="{{$user->notelp}}" required />
                                        @error('nohp')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>


                                    <div class="mb-2">
                                        <label class="form-label" for="profesi">Profesi</label>
                                        <select name="profesi" id="profesi" class="form-control @error('profesi')is-invalid @enderror" value="" required>
                                            <option value="admin">Admin</option>
                                            <option value="supir">Supir</option>
                                            <option value="petugas_terminal">Petugas Terminal</option>
                                        </select>
                                        @error('profesi')
                                        <div class="invalid-feedback">
                                            {{ $message}}
                                        </div>
                                        @enderror

                                    </div>
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    document.getElementById('profesi').value = "{{$user->profesi}}";
</script>
@endsection