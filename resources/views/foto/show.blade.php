<div class="row-12 container">
    @forelse ($data as $data)
    <table class="table table-bordered table-striped">
        <tr style="text-align: center;background-color:cornflowerblue;color:white">
            <th colspan="5">Keterangan</th>
        </tr>
        <tr style="text-align: center">
            <th>Tanggal</th>
            <th>Judul</th>
            <th>Peliput</th>
        </tr>

        <tr>
            <td>{{ $data->tanggal }}</td>
            <td>{{ $data->judul }}</td>
            @foreach ($data->petugas as $c)
            <td>{{ $c->nama }}</td>
            @endforeach
        </tr>
    </table>

    <table class="table table-bordered table-striped">
        <tr style="text-align: center;background-color:cornflowerblue;color:white">
            <th colspan="5">Foto</th>
        </tr>
        <tr style="text-align: center">
            <th>Keterangan</th>
            <th>Foto</th>
            <th>Download</th>
        </tr>

        @foreach ($data->fotos as $b)
        <tr>
            <td>{{ $b->keterangan }}</td>
            <td style="text-align: center"><img src="{{ url('') }}/storage/{{ $b->nama_file }}"
                    style="width: 70px;height:70px;" alt=""></td>
            <td style="text-align: center"><a class="btn btn-sm btn-primary"
                    href="{{ route('foto_download', $b->id) }}"><i class="fa fa-download"></i></a>
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
