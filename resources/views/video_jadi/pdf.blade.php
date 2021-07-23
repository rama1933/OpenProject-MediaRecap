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
                <th colspan="5">
                    Data Arsip Video Jadi
                </th>
            </tr>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Judul</th>
                <th>Peliput</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($video as $video)
            <tr>
                <td style="">{{$loop->iteration}}</td>
                <td style="">{{ $video->tanggal }}</td>
                <td style="">{{ $video->judul }}</td>
                @foreach ($video->petugas as $c)
                <td>{{ $c->nama }}</td>
                <td style="">
                    @if ($video->kategori == 1)
                    Berita Harian
                    @endif
                    @if ($video->kategori == 2)
                    Berita Lepas
                    @endif
                    @if ($video->kategori == 3)
                    Ucapan
                    @endif
                    @if ($video->kategori == 4)
                    Iklan
                    @endif
                </td>
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
