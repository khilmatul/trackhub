@extends('dashboard.layouts.mainDashboard')

@section('container')
<div class="main-pages">
  <div class="container my-1 ">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
      <h1 class="h3 mb-0 text-gray-800">Rekapitulasi Penumpang</h1>
    </div>
    <div class="card">
      <div class="d-grid gap-1 d-md-flex justify-content-end card-header">
        <form class="d-flex" role="search" action="{{ url('rekapitulasi') }}" method="GET">
          <input class="form-control form-control-sm me-1" type="search" name="search" placeholder="Cari" aria-label="Search">
          <button class="btn btn-warning btn-sm" type="submit">Cari</button>
        </form>
      </div>
      <div class="row form-group gap-1 d-md-flex justify-content-end card-header ">
        <form class="form" method="get" action="{{ url('eksportrekapitulasi')}}">
          @csrf
          <div class="container">
            <div class="row">
              <div class="col-sm-3">
                <label for="">Tanggal awal</label>
                <input type="date" class="form-control ml-2" name="tanggal_awal" id="tanggal_awal">
              </div>
              <div class="col-sm-3">
                <label for="">Tanggal Akhir</label>
                <input type="date" class="form-control ml-2" name="tanggal_akhir" id="tanggal_akhir">
              </div>
              <div class="col-sm-3">
                <label for=""> Cetak Laporan</label>
                <select name="cetak" id="cetak" class="form-control ml-2">
                  <option value selected disabled="">Pilih Cetak Laporan</option>
                  <option value="excel">Excel</option>
                  <option value="pdf">PDF</option>
                </select>
              </div>
              <div class="col-sm-3"><br>
                <label for=""></label>
                <button type="submit" class="btn btn-sm btn-info ml-2"><i class="fa fa-print"></i> Cetak</button>
              </div>
            </div>
          </div>
        </form>
      </div>
   
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Tanggal Absen</th>
              <th scope="col">Jam Absen</th>
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Tanggal Lahir</th>
              <th scope="col">Alamat</th>
              <th scope="col">No.Telp</th>
              <th scope="col">Asal Sekolah (Pelajar)</th>
              <th scope="col">Sopir</th>
              <th scope="col">Angkutan</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            @foreach ($data as $index => $row)
            <tr>
              <td>{{ $index + $data->firstItem() }}</td>
              <td>{{date('d-m-Y', strtotime($row->created_at))}}</td>
              <td>{{date('H:i', strtotime($row->created_at))}}</td>
              <td>{{ $row->nama }}</td>
              <td>{{ $row->tgl_lahir }}</td>
              <td>{{ $row->alamat }}</td>
              <td>{{ $row->no_telp }}</td>
              <td>{{ $row->asal_sekolah }}</td>
              <td>{{ $row->nama_petugas }}</td>
              <td>{{ $row->nama_angkutan }}</td>
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