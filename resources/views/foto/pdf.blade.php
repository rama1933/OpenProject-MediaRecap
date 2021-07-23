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
                <th colspan="4">
                    Data Arsip Foto
                </th>
            </tr>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Judul</th>
                <th>Peliput</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($foto as $foto)
            <tr>
                <td style="">{{$loop->iteration}}</td>
                <td style="">{{ $foto->tanggal }}</td>
                <td style="">{{ $foto->judul }}</td>
                @foreach ($foto->petugas as $c)
                <td>{{ $c->nama }}</td>
                @endforeach
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
