@extends('dashboard.layouts.mainDashboard')

@section('container')
<div class="main-pages">
    <div class="container my-1 ">
      <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Data Angkutan</h1>
      </div>
        <div class="card">
            <div class="d-grid gap-1 d-md-flex justify-content-end card-header">
              <form class="d-flex" role="search" action="{{ url('angkutan') }}" method="GET">
                <input class="form-control form-control-sm me-1" type="search" name="search" placeholder="Cari" aria-label="Search">
                <button class="btn btn-warning btn-sm" type="submit">Cari</button>
              </form>
              <a href="{{ url('angkutan/create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i>Tambah Data</a>
              <div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Generate Data
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a href="{{ url('export_excel_angkutan') }}" class="dropdown-item">CSV</a></li>
                  <li><a href="{{ url('eksportangkutan') }}" class="dropdown-item">PDF</a></li>
                </ul>
              </div>
            </div> 

            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead >
                        <tr>
                          <th scope="col">No.</th>
                          <th scope="col">Nomor Polisi</th>
                          <th scope="col">Nama Angkutan</th>
                          <th scope="col">Sopir</th>
                          <th scope="col">Trayek</th>
                          <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($data as $index => $row)
                        <tr>
                          <td>{{ $index + $data->firstItem() }}</td>
                          <td>{{ $row->no_polisi }}</td>
                          <td>{{ $row->nama_angkutan }}</td>
                          <td>{{ $row->nama }}</td>
                          <td>{{ $row->nama_trayek}}</td>
                          <td >
                            <div class="row m-1">
                              <div class="col-md-6">
                                <a href="{{ url('angkutan/'.$row->id.'/edit') }}" class="btn btn-secondary btn-sm border-0"><i class="fa-solid fa-pen-to-square"></i></a>                                                     
                              </div>
                              <div class="col-md-6">
                                <form action="{{ url('angkutan/'.$row->id) }}" method="post">
                                  @csrf
                                  <input type="hidden" name="_method" value="delete">
                                  <button class="btn btn-danger btn-sm border-0 delete" data-id="{{ $row->id }}" data-name="{{ $row->nama_angkutan }}"><i class="fa-solid fa-trash-can"></i></button>
                                </form> 
                              </div>
                            </div>
                          </td>
                        </tr>                      
                      @endforeach 
                    </tbody>
                  </table>
                  <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    {{ $data->links() }}
                  </div>
                  <div class="d-grid gap-2 d-md-flex justify-content-md-start text-gray-600 fs-6">
                   <p>Menampilkan</p> 
                    {{ $data->firstItem() }}
                    <p>-</p> 
                    {{ $data->lastItem() }}
                    <p>dari</p>
                    {{ $data->total() }}
                    <p>data</p>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection