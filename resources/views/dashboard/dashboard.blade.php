@extends('dashboard.layouts.mainDashboard')

@section('container')
<div class="main-pages">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-700">Dashboard</h1>
        </div>

        <div class="row">
            <!-- tracking data-->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow ">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Data Tracking</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$tracking}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-car-side fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Penumpang-->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Data Penumpang</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$penumpang}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-address-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Users
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$user}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-group fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>              
        <div class="row">
        <div class="card mb-3 col-md-12">
            <div class="card-header">
                <h5 class="card-title text-gray-700">
                  <i class="fas fa-chart-bar mr-1 "></i>
                 Data Penumpang
                </h5>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                  
                  
                   
                  </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body mb-5">
                <div class="tab-content p-0">
                  <div class="chart tab-pane active" id=""
                       style="height: 250px; width:100%;">
                      <canvas id="grafik_penumpang" height="200" width="700"></canvas>
                   </div>
             
                </div>
            </div><!-- /.card-body -->
        </div>
        </div>

        <div class="row">
        <div class="card mb-3 col-md-12">
            <div class="card-header">
                <h5 class="card-title text-gray-700">
                  <i class="fas fa-chart-bar mr-1"></i>
                 Data Angkutan
                </h5>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                  
                  
                   
                  </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body mb-5">
                <div class="tab-content p-0">
                  <div class="chart tab-pane active" id=""
                       style="height: 250px; width:100%;">
                      <canvas id="grafik_angkutan" height="200" width="700"></canvas>
                   </div>
             
                </div>
            </div><!-- /.card-body -->
        </div>
        </div>
  
            
        </div>
        
    </div>

    <!-- Footer -->
    <footer class="sticky-footer mt-4">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>&copy; 2022 Layanan Angkutan Perkotaan Kabupaten Banyuwangi</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
</div>


@endsection
@section('js')
<script src="{{asset('chart.js/Chart.min.js')}}"></script>

<script>
    var ctx = document.getElementById('grafik_penumpang').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:  {!!json_encode($chart->labels_bulan)!!} ,
            datasets: [
                {
                    label: {!! json_encode($chart->tahun_ini)!!},
                    backgroundColor: {!! json_encode($chart->colours)!!} ,
                    data:  {!! json_encode($chart->data_Penumpang_bulan)!!} ,
                },
            ]
        },


        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },
            legend: {
                labels: {
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10,
                }
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('grafik_angkutan').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:  {!!json_encode($chart->labels_bulan)!!} ,
            datasets: [
                {
                    label: {!! json_encode($chart->tahun_ini)!!},
                    backgroundColor: {!! json_encode($chart->colours)!!} ,
                    data:  {!! json_encode($chart->data_angkutan_bulan)!!} ,
                },
            ]
        },


        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value) {if (value % 1 === 0) {return value;}}
                    },
                    scaleLabel: {
                        display: false
                    }
                }]
            },
            legend: {
                labels: {
                    fontColor: '#122C4B',
                    fontFamily: "'Muli', sans-serif",
                    padding: 25,
                    boxWidth: 25,
                    fontSize: 14,
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 0,
                    bottom: 10,
                }
            }
        }
    });
</script>





@endsection	