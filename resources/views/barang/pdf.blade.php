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
                    Data Inventaris Barang
                </th>
            </tr>
            <tr>
                <th>No</th>
                <th>Id Barang</th>
                <th>kategori</th>
                <th>Nama barang</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barang as $barang)
            <tr>
                <td style="">{{$loop->iteration}}</td>
                <td style="">{{ $barang->id_barang }}</td>
                <td style="">
                    @if ($barang->kategori == 1)
                    Kamera Foto
                    @endif
                    @if ($barang->kategori == 2)
                    Kamera Video
                    @endif
                    @if ($barang->kategori == 3)
                    Tripot
                    @endif
                    @if ($barang->kategori == 4)
                    Drone
                    @endif
                </td>
                <td style="">{{ $barang->nama }}</td>
                <td style="">{{ $barang->stok }}</td>
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
