@extends('layout.master')
@section('css')
<style>
    .zoom:hover {
        transform: scale(3);
        /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
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
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{-- <li class="breadcrumb-item"><a href="#">Data Buku Tamu</a></li> --}}
                    {{-- <li class="breadcrumb-item active">Data Buku Tamu</li> --}}
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card-body">
                    <div class="row">

                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Edit Password</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        @foreach ($user as $user)
                                        <form method="post" id="form-edit" action="{{ url('/user_update') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <label for="username">Username <small
                                                            class="text-danger">*</small></label>
                                                    <input type="text" name="username" class="form-control"
                                                        value="{{ $user->username }}" readonly>
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="password">Password <small
                                                            class="text-danger">*</small></label>
                                                    <input type="password" name="password" class="form-control" value=""
                                                        required>
                                                </div>


                                            </div>
                                            <br>

                                            <button type="reset" class="btn btn-default"
                                                data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>

                                        </form>
                                        @endforeach
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.card-body -->
            </div>
        </div>
    </div>


</section>



@endsection
@section('js')


<script src="{{ url('') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{ url('') }}/plugins/raphael/raphael.min.js"></script>
<script src="{{ url('') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{ url('') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
{{-- <script src="dist/js/pages/dashboard2.js"></script> --}}

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });

    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah2').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp2").change(function(){
        readURL2(this);
    });

    $(function () {
     $('#datetimepicker').datetimepicker({
       format: 'L'
        });
     });

     $(function () {
     $('#datetimepicker2').datetimepicker({
       format: 'L'
        });
     });

    $('.select2bs4').select2({
          theme: 'bootstrap4'
        });
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
