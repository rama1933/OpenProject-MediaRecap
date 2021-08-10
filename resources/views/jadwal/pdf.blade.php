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
    <div class="row" style="text-align: center">
        <div class="column left">
            <img src="{{  public_path() }}/login/images/hss.png" style="width:50px">
        </div>
        <div class="column right">
            <h5 style="margin-top: -10px">
                PEMERINTAH KABUPATEN HULU SUNGAI SELATAN
            </h5>
            <h3 style="margin-top: -15px">
                DINAS KOMUNIKASI DAN INFORMATIKA
            </h3>
            <h6 style="margin-top: -15px">
                Jalan Aluh Idut No. 66 A Kandangan Kab. Hulu Sungai Selatan
                KANDANGAN 71211
            </h6>
        </div>
    </div>
    <hr style="margin-top: -15px">
    <table style="width: 100%;margin-top:10px;">
        <thead>
            <tr>
                <th colspan="7">
                    Data Jadwal Peliputan
                </th>
            </tr>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Tempat</th>
                <th>Nama</th>
                <th>Peliput</th>
                <th>Editor</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($jadwal as $jadwal)
            <tr>
                <td style="">{{$loop->iteration}}</td>
                <td style="">{{ $jadwal->tanggal }}</td>
                <td style="">{{ $jadwal->jam }}</td>
                <td style="">{{ $jadwal->tempat }}</td>
                <td style="">{{ $jadwal->nama_kegiatan }}</td>
                @foreach ($jadwal->petugas as $c)
                <td>{{ $c->nama }}</td>
                @endforeach
                @foreach ($jadwal->editors as $d)
                <td>{{ $d->nama }}</td>
                @endforeach
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center">--Data Kosong--</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="row" style="text-align: center;float:right;width: 30%;">
        <div>
            <h4>
                KEPALA DINAS, <br>
                Hj. RAHMAWATY, ST. MT. <br>
                Pembina Tingkat I
            </h4>
            <br>
            <br>
            <br>
            <h4>
                NIP. 19710726 199703 2 005
            </h4>
        </div>
    </div>
</body>

</html>
