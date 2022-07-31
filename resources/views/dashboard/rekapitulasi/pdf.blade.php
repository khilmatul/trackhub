<!DOCTYPE html>
<html>
<head>
<style>
#penumpang {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#penumpang td, #penumpang th {
  border: 1px solid #ddd;
  padding: 8px;
}

#penumpang tr:nth-child(even){background-color: #cfccd8;}

#penumpang tr:hover {background-color: #ddd;}

#penumpang th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #5a43a0;
  color: white;
}
</style>
</head>
<body>
  <div class="container">
<h1>Rekapitulasi Penumpang</h1>
<table id="penumpang">
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
    <th scope="col">Petugas</th>
  </tr>
  @php
      $no = 1;
  @endphp
  @foreach ($data as $row)
    <tr>
      <td>{{ $no++ }}</td>
      <td>{{date('d-m-Y', strtotime($row->created_at))}}</td>
      <td>{{date('H:i', strtotime($row->created_at))}}</td>
      <td>{{ $row->nama }}</td>
      <td>{{ $row->tgl_lahir }}</td>
      <td>{{ $row->alamat }}</td>
      <td>{{ $row->no_telp }}</td>
      <td>{{ $row->asal_sekolah }}</td>
      <td>{{ $row->supir }}</td>
      <td>{{ $row->nama_angkutan }}</td>
      <td>{{ $row->nama_petugas }}</td>
    </tr>                      
 @endforeach    
</table>
</div>
</body>
</html>