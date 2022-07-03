@extends('layouts.main')

@section('content')
<div class="container login">
  <div class="row align-text-center justify-content-center">
    <div class="col-md-6 col-lg-4 bg-white rounded p-4 shadow">
      <div class="row justify-content-center mb-4">
        <img src="img/logo.png" alt="" class="w-25" />
        <div>
          <h5 class="fw-bolder text-center text-uppercase mt-4">Layanan Angkutan Kota Kabupaten Banyuwangi</h5>
        </div>
      </div>
      @if(session()->has('error'))
      <div class="alert alert-danger" role="alert" id="notif">

        <span data-notify="icon" class="fa fa-bell"></span>
        <span data-notify="title">Gagal</span> <br>
        <span data-notify="message">{{session()->get('error')}}</span>
      </div>
      @endif
      <form action="{{url('login')}}" method="POST">
        @csrf
        <div class="mb-3">
          <label class="form-label">Nama Pengguna</label>
          <input type="text" name="username" class="form-control @error('username')is-invalid @enderror" placeholder="Masukkan nama pengguna" value="{{ old('username') }}" autofocus required />
        </div>
        <div class="mb-3">
          <label class="form-label">Kata Sandi</label>
          <input type="password" name="password" class="form-control" placeholder="Masukkan kata sandi" required />
        </div>
        <div class="col-md-12 d-grid gap-2">
          <button type="submit" class="btn loginbtn">Masuk</button>
        </div>
      </form>
      <!-- <small class="d-block text-center mt-3">Belum Daftar? <a href="/register">Silahkan Daftar</a></small> -->
    </div>
  </div>
</div>
@endsection
@section('script')
 <!-- Bootstrap core JavaScript-->
 <script src="{{asset('public/admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('public/admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->

    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

    <script>

$(document).ready(function() {

@if(session()->has('message'))
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: "{{session()->get('message')}}",
})
@endif


});

    </script>
@endsection