@extends('dashboard.layouts.mainDashboard')

@section('container')
<div class="main-pages">
  <div class="container-fluid">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Edit Data Trayek</h1>
      </div>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card justify-content-center">
          <div class="card-body" >
              <form action="{{ url('trayek/'. $model->id) }}" method="POST">
                  @csrf
                  <input type="hidden" name="_method" value="PATCH">

                      <div class="mb-2">
                        <label class="form-label" for="nama_trayek">Nama Trayek</label>
                        <input type="text" name="nama_trayek" class="form-control" value="{{ $model->nama_trayek }}" required/>                        
                      </div>
          
                  <div class="mb-2">
                    <label class="form-label" for="lokasi_berangkat">Lokasi Berangkat</label>
                    <input type="text" name="lokasi_berangkat" class="form-control" value="{{ $model->lokasi_berangkat }}" required>
                  </div>
          
                  <div class="mb-2">
                    <label class="form-label" for="lokasi_tiba">Lokasi Tiba</label>
                    <input type="text" name="lokasi_tiba" class="form-control" value="{{ $model->lokasi_tiba }}" required/>             
                  </div>  
    
                  <div class="mb-2">
                    <label class="form-label" for="via">Via</label>
                    <input type="text" name="via" class="form-control" value="{{ $model->via }}"/>        
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