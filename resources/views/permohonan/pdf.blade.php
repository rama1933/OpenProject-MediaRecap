<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
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

    table,
    th,
    td {
        border: 1px solid;
        border-collapse: collapse;
    }

    header {
        position: fixed;
        top: -30px;
        left: 0px;
        right: 0px;
    }

    footer {
        position: fixed;
        bottom: -10px;
        left: 0px;
        right: 0px;
    }
</style>

<body>
    <header>
        <hr>
    </header>
    <footer>
        <hr>
    </footer>
    <div class="row">
        <div class="column left">
            <img src="{{  public_path() }}/login/images/kominfo.png" style="width:50px">
        </div>
        <div class="column right">
            <h3 style="margin-top: 12px;margin-left: -10px;">E-Arsip DIskominfo</h3>
        </div>
    </div>
    <table style="width: 100%;margin-top:10px;">
        <thead>
            <tr>
                <th colspan="8">
                    Arsip Permohonan Data
                </th>
            </tr>
            <tr>
                <th>No</th>
                <th>Nama Pemohon</th>
                <th>Nik</th>
                <th>Alamat</th>
                <th>Pekerjaan</th>
                <th>No Hp</th>
                <th>Nama Data</th>
                <th>Ket</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($permohonan as $permohonan)
            <tr>
                <td style="">{{$loop->iteration}}</td>
                <td style="">{{ $permohonan->nama_pemohon }}</td>
                <td style="">{{ $permohonan->nik }}</td>
                <td style="">{{ $permohonan->alamat }}</td>
                <td style="">{{ $permohonan->pekerjaan }}</td>
                <td style="">{{ $permohonan->no_hp }}</td>
                <td style="">{{ $permohonan->nama_data }}</td>
                <td style="">{{ $permohonan->ket }}</td>

            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center">--Data Kosong--</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
