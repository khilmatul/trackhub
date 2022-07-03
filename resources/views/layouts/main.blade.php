<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>{{ $title }} | Angkutan Kota Banyuwangi</title> --}}
    <title>Angkutan Kota Banyuwangi</title>

    {{-- CSS Boostrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- Boostrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- CSS custom --}}
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
</head>
<body>
    @include('partials.navbar') 

    <main class="py-5">
      @yield('content')
    </main>
    <script src="{{asset('jquery/jquery.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('sweetalert/sweetalert.all.js')}}"></script>
    <script type="text/javascript" >
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/jquery.js') }}"></script>
        {{-- <script src="{{ asset('assets/app/js/bootstrap.min.js') }}"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>