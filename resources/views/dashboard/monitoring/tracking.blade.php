@extends('dashboard.layouts.mainDashboard')
@section('css')

<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
<style>
    #map-layer {
        max-width: 900px;
        min-height: 550px;
    }

    .lbl-locations {
        font-weight: bold;
        margin-bottom: 15px;
    }

    .locations-option {
        display: inline-block;
        margin-right: 15px;
    }

    .btn-draw {
        background: green;
        color: #ffffff;
    }
</style>
@endsection

@section('container')
<div class="main-pages">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-700">Monitoring Trayek</h1>
        </div>


        <div class="container">
            <div class="row form-group ">

                <div class="col-md-2">

                    <select id="supir" name="supir" type="text" class="col-md-3 form-control">
                        <option value selected disabled="">Pilih Supir</option>
                        @foreach($supir as $v)
                        <option value="{{ $v->id }}">{{ $v->nama}}</option>
                        @endforeach
                    </select>


                </div>


                <div class="col-md-3">
                    <input type="button" id="drawPath" value="Refresh" class="btn-draw" />

                </div>
            </div>

            <br>
            <div class="row form-group ">

                <div class="col-md-2">
                    <input type="text"  value="Nama Angkutan :" class="form-control"  readonly/>

                </div>
                <div class="col-md-2">
                    <input type="text" id="kendaraan"  class="form-control" readonly />

                </div>
            </div>

        </div>
        <br>

        <div class="container mx-auto">
            <div id="map-layer"></div>

        </div>

    </div>


    @endsection
    @section('js')

    <script>
        var map;
        var waypoints;

        function initMap() {
            var mapLayer = document.getElementById("map-layer");
            var centerCoordinates = new google.maps.LatLng(-8.4845011, 114.3281116);
            var defaultOptions = {
                center: centerCoordinates,
                zoom: 8
            }
            map = new google.maps.Map(mapLayer, defaultOptions);

            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            directionsDisplay.setMap(map);

            $("#drawPath").on("click", function() {
                ceklokasi()

            });

            ceklokasi()

            setInterval(function() {
                ceklokasi()
            }, 10000);


            function ceklokasi() {
                var nama_supir = $("#supir").val()
                axios.post("{{url('/api/tracking-web')}}", {
                        supir: nama_supir
                    })
                    .then((res) => {
                        var data = res.data.tracking[0]
                        console.log(data)
                        document.getElementById("kendaraan").value = data.nama_angkutan
                        // console.log(data.latitude_tracking_akhir)
                        var start = `${data.latitude_tracking_awal},${data.longitude_tracking_awal}`
                        var end = `${data.latitude_tracking_akhir},${data.longitude_tracking_akhir}`

                        drawPath(directionsService, directionsDisplay, start, end);


                    })
            }

            $("#supir").on("change", () => {

                ceklokasi()
            })


        }

        function drawPath(directionsService, directionsDisplay, start, end) {
            directionsService.route({
                origin: start,
                destination: end,
                optimizeWaypoints: true,
                travelMode: 'DRIVING'
            }, function(response, status) {
                if (status === 'OK') {
                    directionsDisplay.setDirections(response);
                } else {
                    window.alert('Problem in showing direction due to ' + status);
                }
            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATLas4hCAqv4Cyyt_CxYvzUS66vTOt6ds&callback=initMap">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.js" integrity="sha512-MNW6IbpNuZZ2VH9ngFhzh6cUt8L/0rSVa60F8L22K1H72ro4Ki3M/816eSDLnhICu7vwH/+/yb8oB3BtBLhMsA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @endsection
  