<!DOCTYPE html>
<html lang="en">

<body>
    Judul 
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th><b>No.</b></th>
                <th><b>Waktu Pendataan</b></th>
                <th><b>Nama Penumpang</b></th>
                <th><b>Tanggal Lahir</b></th>
                <th><b>Alamat</b></th>
                <th><b>No. Telepon</b></th>
<<<<<<< HEAD
                <th><b>Asal Sekolah</b></th>
                <th><b>Type absen</b></th>
                <th><b>Nama Angkutan</b></th>
               

  
=======
                <th><b>Asal Sekolah (Pelajar)</b></th>
                <th><b>Sopir</b></th>
                <th><b>Nama Angkutan</b></th>
>>>>>>> b49556890d951d8e5eebe59dba7640efdc7d50f8
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($pendataan as $data)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{$data->waktu_pendataan}}</td>
                <td>{{$data->nama}}</td>
                <td>{{$data->tgl_lahir}}</td>
                <td>{{$data->alamat}}</td>
                <td>{{$data->no_telp}}</td>
                <td>{{$data->asal_sekolah}}</td>
<<<<<<< HEAD
                <td>{{$data->type_absen}}</td>
=======
                <td>{{$data->nama_petugas}}</td>
>>>>>>> b49556890d951d8e5eebe59dba7640efdc7d50f8
                <td>{{$data->nama_angkutan}}</td>
               
              
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
