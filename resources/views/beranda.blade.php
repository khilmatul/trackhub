@extends('layouts.main')

@section('content')
<section class="home" id="home">
  <div class="content">
    <h3 class="fw-bolder">SELAMAT DATANG</h3>
    <h4 class="fw-bolder">LAYANAN ANGKUTAN PERKOTAAN</h4>
    <h4 class="fw-bolder">SIAP MELAYANI KEBUTUHAN</h4>
    <h4 class="fw-bolder">TRANSPORTASI ANDA</h4>
  </div>

  <div class="image">
    <img src="img/bg.png" alt="" />
  </div>
</section>

<!-- checking card -->
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-8 cek">
      @if(session()->has('error'))
      <div class="alert alert-danger" role="alert" id="notif">

        <span data-notify="icon" class="fa fa-bell"></span>
        <span data-notify="title">Gagal</span> <br>
        <span data-notify="message">{{session()->get('error')}}</span>
      </div>
      @endif
      <h4 class="fw-bolder text-center">Unduh Kartu</h4>
      <form action="{{'cetak'}}" method="POST">
        <div class="row row-cols-md-auto justify-content-center ">
          <div class="row">

          @csrf

          <div class="col-4">
            <label class="form-label h6" for="nama">Nama</label>
            <div class="input-group">
              <input type="nama" id="nama" name="nama" class="form-control @error('nama')is-invalid @enderror" value="{{ old('nama') }}" required>
              @error('nama')
              <div class="invalid-feedback">
                {{ $message}}
              </div>
              @enderror
            </div>
          </div>


          <div class="col-4">
            <label class="form-label h6" for="tgl_lahir">Tanggal Lahir</label>
            <div class="input-group">
              <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control @error('tgl_lahir')is-invalid @enderror" value="{{ old('tgl_lahir') }}" required>
              @error('tgl_lahir')
              <div class="invalid-feedback">
                {{ $message}}
              </div>
              @enderror
            </div>
          </div>




          <div class="col-4">
            <button type="submit" class="btn">Cetak Kartu</button>
          </div>

          </div>

        </div>
      </form>
    </div>
  </div>
</div>
<!-- checking card end-->

<!-- form regist -->
{{-- <div class="form-regis" id="register">
  <div class="container">
    <div class="row justify-content-center ">
      <div class="col-md-7 col-lg-5 regis ">
        <h4 class="fw-bolder text-center mb-4">Pendaftaran Kartu Penumpang</h4>
        <div class="card">
          <div class="card-body">
            <form>
              <div class="mb-2">
                <label class="form-label">Nama Lengkap</label>
                <input type="input" class="form-control"/>
              </div>

              <div class="mb-2">
                <label class="form-label">Tanggal Lahir</label>
                <div class="input-group">
                  <input class="form-control" type="date" />
                </div>
              </div>

              <div class="mb-2">
                <label class="form-label">Alamat</label>
                <textarea type="text-area" class="form-control"></textarea>
              </div>

              <div class="mb-2">
                <label class="form-label">No. Telepon</label>
                <input type="input" class="form-control" />
              </div>

              <div class="mb-2">
                <label class="form-label">Asal Sekolah (Jika Pelajar)</label>
                <input type="input" class="form-control" />
              </div>

              <div class="col-md-12 d-grid gap-2">
                <button class="btn" type="submit">Daftar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> --}}
<!-- form regist end -->

<!-- footer -->
<div class="container">
  <footer class="py-3 my-3">

    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Belum Terdaftar ?</a></li>
      <li class="nav-item"><a href="{{url('register')}}" class="nav-link px-2 text-muted">Daftar Kartu</a></li>
      <!-- <li class="nav-item"><a href="/beranda" class="nav-link px-2 text-muted">Unduh Kartu</a></li>
      <li class="nav-item"><a href="/login" class="nav-link px-2 text-muted">Masuk</a></li> -->
    </ul>
    <p class="text-center text-muted">&copy; 2022 Layanan Angkutan Perkotaan Kabupaten Banyuwangi</p>
  </footer>
</div>
<!-- end footer -->

<!-- custom js -->
<script src="{{asset('js/index.js')}}"></script>
@endsection
//CREATE UL TEXT COLOR
// <ul class="nav justify-content-center border-bottom pb-3 mb-3">