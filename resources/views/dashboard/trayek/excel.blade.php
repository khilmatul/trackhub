<!DOCTYPE html>
<html lang="en">

<body>
    Judul 
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th><b>No.</b></th>
                <th><b>Nama Trayek</b></th>
                <th><b>Lokasi Berangkat</b></th>
                <th><b>Lokasi Tiba</b></th>
                <th><b>Via</b></th>

  
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($trayek as $data)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{$data->nama_trayek}}</td>
                <td>{{$data->lokasi_berangkat}}</td>
                <td>{{$data->lokasi_tiba}}</td>
                <td>{{$data->via}}</td>s
              
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
