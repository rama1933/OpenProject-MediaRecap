<div class="row-12 container">
    @forelse ($data as $data)
    <table class="table table-bordered table-striped">
        <tr style="text-align: center;background-color:cornflowerblue;color:white">
            <th colspan="5">Keterangan</th>
        </tr>
        <tr style="text-align: center">
            <th>Tanggal</th>
            <th>Judul</th>
            <th>kategori</th>
            <th>Peliput</th>
        </tr>

        <tr>
            <td>{{ $data->tanggal }}</td>
            <td>{{ $data->judul }}</td>
            <td>
                @if ($data->kategori == 1)
                Berita Harian
                @endif
                @if ($data->kategori == 2)
                Berita Lepas
                @endif
                @if ($data->kategori == 3)
                Ucapan
                @endif
                @if ($data->kategori == 4)
                Iklan
                @endif
            </td>
            @foreach ($data->petugas as $c)
            <td>{{ $c->nama }}</td>
            @endforeach
        </tr>
    </table>

    <table class="table table-bordered table-striped">
        <tr style="text-align: center;background-color:cornflowerblue;color:white">
            <th colspan="5">Video</th>
        </tr>
        <tr style="text-align: center">
            <th>Keterangan</th>
            <th>Download</th>
        </tr>

        @foreach ($data->videos as $b)
        <tr>
            <td>{{ $b->keterangan }}</td>
            <td style="text-align: center"><a class="btn btn-sm btn-primary"
                    href="{{ route('video_download', $b->id) }}"><i class="fa fa-download"></i></a>
            </td>
        </tr>
        @endforeach
    </table>

    @empty
    <tr>
        <td colspan="3">--Data Tidak Ditemukan--</td>
    </tr>
    @endforelse

</div>
