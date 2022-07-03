<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Angkutan Banyuwangi</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href=" {{ asset('css/index2.css') }}">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@yield('css')
        <!-- Boostrap Icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>

    <body>
        <div class="wrapper">
          
            @include('dashboard.layouts.topbar') 
         
            @include('dashboard.layouts.sidebar')
           

            @yield('container')
        </div>

        @include('sweetalert::alert')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/jquery.js') }}"></script>
        {{-- <script src="{{ asset('assets/app/js/bootstrap.min.js') }}"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="{{ asset('js/dashboard.js') }}"></script>
        <script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        @yield('js')
        <script>
    var minDate, maxDate;
 
 // Custom filtering function which will search data in column four between two values
 $.fn.dataTable.ext.search.push(
     function( settings, data, dataIndex ) {
         var min = minDate.val();
         var max = maxDate.val();
         var date = new Date( data[4] );
  
         if (
             ( min === null && max === null ) ||
             ( min === null && date <= max ) ||
             ( min <= date   && max === null ) ||
             ( min <= date   && date <= max )
         ) {
             return true;
         }
         return false;
     }
 );
  
 $(document).ready(function() {
     // Create date inputs
     minDate = new DateTime($('#tanggal_awal'), {
         format: 'DD-MM-YYYY',
     });
     maxDate = new DateTime($('#tanggal_akhir'), {
         format: 'DD-MM-YYYY'
     });
  
     // DataTables initialisation
     var table = $('#myTable1').DataTable();
  
     // Refilter the table
     $('#tanggal_akhir, #tanggal_akhir').on('change', function () {
         table.draw();
     });
    });

</script>
    </body>

</html>