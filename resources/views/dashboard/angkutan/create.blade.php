@extends('dashboard.layouts.mainDashboard')

@section('container')
<div class="main-pages">
  <div class="container-fluid">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Tambah Data Angkutan</h1>
      </div>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card justify-content-center">
          <div class="card-body" >
            <form action="{{url('angkutan')}}" method="POST">
              @csrf
              <div class="mb-2">
                <label class="form-label" for="no_polisi">No Polisi</label>
                <input type="text" id="no_polisi" name="no_polisi" class="form-control @error('no_polisi')is-invalid @enderror" value="{{ old('no_polisi') }}" required/>                        
                @error('no_polisi')
                <div class="invalid-feedback">
                  {{ $message}}
                </div>
                @enderror
              </div>


                <div class="mb-2">
                  <label class="form-label" for="nama_angkutan">Nama Angkutan</label>
                  <input type="text" id="nama_angkutan" name="nama_angkutan" class="form-control @error('nama_angkutan')is-invalid @enderror" value="{{ old('nama_angkutan') }}" required/>                        
                  @error('nama_angkutan')
                  <div class="invalid-feedback">
                    {{ $message}}
                  </div>
                  @enderror
                </div> 

                <div class="mb-2">
                  <label class="form-label" for="sopir">Sopir</label>
                  <select name="sopir" id="sopir" class="form-control @error('sopir')is-invalid @enderror" required>
                    <option value selected disabled="">Pilih Sopir</option>
                    @foreach ($user as $item)
                      <option value ="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                  </select>
                  @error('sopir')
                  <div class="invalid-feedback">
                    {{ $message}}
                  </div>
                  @enderror
                </div>
                 
                  <div class="mb-2">
                    <label class="form-label" for="trayek_id">Trayek</label>
                    <select name="trayek_id" id="trayek_id" class="form-control @error('trayek_id')is-invalid @enderror" required>
                      <option value selected disabled="">Pilih Trayek</option>
                      @foreach ($trayek as $trayeks)
                        <option value="{{ $trayeks->id }}">{{ $trayeks->nama_trayek }}</option>
                      @endforeach
                    </select>
                    @error('trayek_id')
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