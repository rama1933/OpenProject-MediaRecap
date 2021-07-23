<!DOCTYPE html>
<html>
<head>
	<title>Laporan Inovasi Daerah</title>
</head>
<style>


    /* Create two equal columns that floats next to each other */
    .column {
      float: left;
    }
    .left {
  width: 10%;
}

.right {
  width: 90%;
}

    /* Clear floats after the columns */
    .row:after {
      content: "";
      clear: both;
    }
    table, th, td {
  border: 1px solid;
  border-collapse: collapse;
}

header { position: fixed; top: -30px; left: 0px; right: 0px;}
    footer { position: fixed; bottom: -10px; left: 0px; right: 0px;}
    </style>
<body>
    <header><hr></header>
    <footer><hr></footer>
        <h3 style="text-align: center;">DATA ARSIP VIDEO DISKOMINFO</h3>
        <table style="width: 100%">
            <thead>
                <tr>
                <th>No</th>
                <th>Nama Petugas</th>
                <th>Tanggal</th>
                <th>Tempat</th>
                <th>Uraian Kegiaan</th>
                <th>kaegori Video</th>
                <th>Video</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($data as $data)
                    <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ date('d-m-Y',strtotime($data->tanggal)) }}</td>
                    <td>{{ $data->tempat }}</td>
                    <td>{{ $data->uraian }}</td>
                    <td>{{ $data->nama_kategori }}</td>
                    <td>{{ $data->link_video }}</td>
                    @endforeach
                </tbody>
              </table>
            </body>
            </html>
