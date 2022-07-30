<!DOCTYPE html>
<html lang="en">

<body>
    Data Angkutan 
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th><b>No.</b></th>
                <th><b>Nama Angkutan</b></th>
                <th><b>No Polisi</b></th>
                <th><b>Nama Supir</b></th>
                <th><b>Nama Trayek</b></th>  
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($angkutan as $data)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{$data->nama_angkutan}}</td>
                <td>{{$data->no_polisi}}</td>
                <td>{{$data->nama}}</td>
                <td>{{$data->nama_trayek}}</td>               
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
