<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 10pt;
        }
    </style>
    <p style="text-align:center; font-size:16pt">
<<<<<<< HEAD
        <b>Kartu Penumpang</b> <br>
        <b>Angkutan Kota kabupaten Banyuwangi</b>
=======
<<<<<<< HEAD
        <b>Kartu Penumpang</b> <br>
        <b>Angkutan Perkotaan Kabupaten Banyuwangi</b>
=======
        <b> Kartu Penumpang Angkutan Kota </b> <br>
        <b> Kabupaten Banyuwangi</b>
>>>>>>> 19cad015b11d01aa4fd799b0d90ee59c0f67063a
>>>>>>> b49556890d951d8e5eebe59dba7640efdc7d50f8
    </p>
    <p style="text-align:center; font-size:16pt">
        <b> Nama : {{$data->nama}}</b>
    </p>
    <p style="text-align:center; font-size:16pt">
        <b> Tanggal Lahir : {{$data->tgl_lahir}}</b>
    </p>
    <p style="text-align:center; font-size:16pt">
        <b> Alamat : {{$data->alamat}}</b>
<<<<<<< HEAD
=======
    </p>
    <p style="text-align:center; font-size:16pt">
        <b> Alamat  : {{$data->alamat}}</b>
>>>>>>> b49556890d951d8e5eebe59dba7640efdc7d50f8
    </p>
    <p style="text-align:center; font-size:16pt">
        <b> No. Telp : {{$data->no_telp}}</b>
    </p>
    <p style="text-align:center; font-size:16pt">
        <b> Asal Sekolah  : {{$data->asal_sekolah}}</b>
    </p>
    <br>
    <br>
    <p style="text-align:center; font-size:16pt">
        <img src="data:image/png;base64, {!! $qrcode !!}">
    </p>
    <br>
    <p style="text-align:center; font-size:16pt">
        {{$data->kode_qrcode}}
    </p>

</body>

</html>
