@extends('layouts.main')

@section('content')
<div class="form-regis">
    <div class="container">
      <div class="row justify-content-center ">
        <div class="col-md-12 col-lg-5 regis ">          
          <div class="card">            
            <div class="card-body">
              <h4 class="fw-bolder text-center">Pendaftaran Kartu Penumpangs</h4>
              <hr>
              <form action="{{url('daftar_penumpang')}}" method="POST">
                @csrf
                <div class="row">                
                    <div class="col-6">
                      <div class="mb-2">
                        <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control @error('nama_lengkap')is-invalid @enderror" value="{{ old('nama_lengkap') }}" required/>                        
                        @error('nama_lengkap')
                        <div class="invalid-feedback">
                          {{ $message}}
                        </div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="mb-2">
                        <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control @error('tanggal_lahir')is-invalid @enderror" value="{{ old('tanggal_lahir') }}" required/>                        
                        @error('tanggal_lahir')
                        <div class="invalid-feedback">
                          {{ $message}}
                        </div>
                        @enderror
                      </div>
                    </div>
                  </div>            
          
                  <div class="mb-2">
                    <label class="form-label" for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="form-control @error('alamat')is-invalid @enderror"
                    value="{{ old('alamat') }}" required>
                    @error('alamat')
                      <div class="invalid-feedback">
                        {{ $message}}
                      </div>
                    @enderror
                  </div>
          
                  <div class="mb-2">
                    <label class="form-label" for="no_telepon">No. Telp</label>
                    <input type="text" id="no_telepon" name="no_telepon" class="form-control @error('no_telepon')is-invalid @enderror"
                    value="{{ old('no_telepon') }}" required/>  
                    @error('no_telepon')
                      <div class="invalid-feedback">
                        {{ $message}}
                      </div>
                    @enderror             
                  </div>  
    
                  <div class="mb-2">
                    <label class="form-label" for="asal_sekolah">Asal Sekolah</label>
                    <input type="text" id="asal_sekolah" name="asal_sekolah" class="form-control @error('asal_sekolah')is-invalid @enderror"
                    value="{{ old('asal_sekolah') }}" required/>
                    @error('asal_sekolah')
                      <div class="invalid-feedback">
                        {{ $message}}
                      </div>
                    @enderror                  
                  </div>  
    
          
  
                <div class="col-md-12 d-grid gap-2">
                  <button class="btn" type="submit">Daftar</button>
                </div>
              </form>
              <small class="d-block text-center mt-3">Sudah Punya Akun? <a href="/">Silahkan Cetak Kartu Penumpang Anda</a></small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection