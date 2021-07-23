@extends('layout.master')
@section('css')
    <link href="{{ url('') }}/sbadmin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
.zoom:hover {
    transform: scale(3); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1 class="m-0 text-dark">Karyawan {{ $jenis }}</h1> --}}
        </div>

      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                {{--  <button class="btn btn-primary my-3" data-toggle="modal" data-target="#modal-create">Tambah</button>  --}}
                <div class="card-body">
                    <div class="row">

                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card">
                                    <div class="card-header">
                                        @if (auth()->user()->role=='admin')
                                        <a href="{{ route('kategori_tambah') }}" class="btn btn-primary float-right" > <i class="fa fa-plus">  Tambah Data</i></a>
                                        @endif
                                      <h3 class="card-title">Data Master Kategori</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        @if (session('message'))
                                        <div class="alert alert-success alert-dismissible show fade">
                                        <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>×</span>
                                        </button>
                                        {{ session('message') }}
                                        </div>
                                        </div>
                                      @endif
                                      <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $data)
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $data->nama_kategori }}</td>
                                            <td> <a href="{{ route('kategori_edit',$data->id) }}" class="btn btn-sm btn-primary edit"> <i class="fa fa-pen"> Edit Data</i></a>
                                            <a href="{{ route('kategori_hapus',$data->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash" onclick="return confirm('Hapus data {{  $data->nama  }} ?')"> Hapus Data</i></a>
                                            </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                      </table>
                                    </div>
                                    <!-- /.card-body -->
                                  </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</section>



@endsection
@section('js')


    <script src="{{ url('') }}/sbadmin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('') }}/sbadmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- PAGE SCRIPTS -->
{{-- <script src="dist/js/pages/dashboard2.js"></script> --}}

<script>
    // let list_karyawan = [];
    const table = $("#table").DataTable({
            "language": {
        "sProcessing":    "Sedang Diproses",
        "sLengthMenu":    "Tampilkan _MENU_ Data",
        "sZeroRecords":   "Data Kosong",
        "sEmptyTable":    "Data Kosong",
        "sInfo":          "Menampilkan dari _START_ sampai _END_ data dari total _TOTAL_ data",
        "sInfoEmpty":     "Menampilkan data dari 0 hingga 0 dari total 0 data",
        "sInfoFiltered":  "(di filter dari _MAX_ data)",
        "sInfoPostFix":   "",
        "sSearch":        "Cari:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Sedang Diproses...",
        "oPaginate": {
            "sFirst":    "Pertama",
            "sLast":    "Terakhir",
            "sNext":    "Lanjut",
            "sPrevious": "Kembali"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    },
          "responsive": true,
          "autoWidth": false,
          "pageLength":10,
          "lengthMenu":[[10,25,50,100,-1],[10,25,50,100,'semua']],
          "bLengthChange":true,
          "bFilter":true,
          "bInfo":true,
          "processing":true,
            });

            table.on('click','.edit',function (e) {

                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');

                }

                var data = table.row($tr).data();

                var link = e.relatedTarget(),
                modal    = $(this),
                id = link.data("id");
                console.log(id)


                $('#nik').val(data[2]);
                $('#nama').val(data[3]);
                $('#alamat').val(data[4]);
                $('#keperluan').val(data[5]);
                $('#no_hp').val(data[6]);
                $('input[name=tanggal]').val(data[7]);
                // $('#tanggal').val(data[7]);

             })


function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
    </script>
@endsection


