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
                        {{-- <div class="col-sm-3 mb-3 ml-2">
                            <label for="">Filter Kecamatan</label>
                            <select name="filter_kecamatan" id="filter_kecamatan" class="form-control select2bs4 filter">
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($kecamatan3 as $kecamatan3)
                                <option value="{{ $kecamatan3->id }}">{{ $kecamatan3->nama_kecamatan }}</option>
                        @endforeach
                        </select>
                    </div> --}}

                    {{--  <div class="col-sm-3 mb-3 ml-2">
                            <label for="">Filter Tahapan Inovasi</label>
                            <select name="filter_tahapan" id="filter_tahapan" class="form-control select2bs4 filter">
                                <option value="">Pilih Tahapan</option>
                                <option value="Uji coba">Uji coba</option>
                                <option value="Inisiatif">Inisiatif</option>
                                <option value="Penerapan">Penerapan</option>
                            </select>
                        </div>

                        <div class="col-sm-3 mb-3 ml-2">
                            <label for="">Filter Covid</label>
                            <select name="filter_covid" id="filter_covid" class="form-control select2bs4 filter">
                                <option value="">Pilih</option>
                                <option value="Non Covid-19">Non Covid-19</option>
                                <option value="Covid-19">Covid-19</option>
                            </select>
                        </div>  --}}

                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card">
                                <div class="card-header">
                                    {{-- @if (auth()->user()->role=='admin')
                                        <a href="{{ route('user_tambah') }}" class="btn btn-primary float-right" > <i
                                        class="fa fa-plus"> Tambah User</i></a>
                                    @endif --}}
                                    <h3 class="card-title">Ubah Password</h3>
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
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th style="text-align: center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user as $user)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td style="text-align: center"> <a
                                                        href="{{ route('user_edit',$user->id) }}"
                                                        class="btn btn-sm btn-success edit"> <i class="fa fa-pen"> Ubah
                                                            Password</i></a>
                                                    {{-- <a href="{{ route('user_hapus',$user->id) }}"
                                                    class="btn btn-sm btn-danger"><i class="fa fa-trash"
                                                        onclick="return confirm('Hapus data {{  $user->nama  }} ?')">
                                                        Hapus Data</i></a> --}}
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
            </div><!-- /.card-body -->
            <div class="modal fade" id="modal-edit">
                <div class="modal-dialog modal-lg">
                    <form method="post" id="form-edit" action="{{ url('/buku_update/') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Atlet</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <label for="nik">NIK<small class="text-danger">*</small></label>
                                        <input type="text" name="nik" id="nik" class="form-control" maxlength="3"
                                            onkeypress="return hanyaAngka(event)" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="nama">Nama <small class="text-danger">*</small></label>
                                        <input type="text" name="nama" id="nama" class="form-control" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="alamat">Alamat<small class="text-danger">*</small></label>
                                        <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control"
                                            required></textarea>
                                        {{--  <input type="text" name="alamat" class="form-control" required>  --}}
                                    </div>


                                    <div class="col-md-12">
                                        <label for="keperluan">Keperluan <small class="text-danger">*</small></label>
                                        <input type="text" name="keperluan" id="keperluan" class="form-control"
                                            required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="no_hp">Nomor Hp<small class="text-danger">*</small></label>
                                        <input type="text" name="no_hp" id="no_hp" class="form-control" maxlength="3"
                                            onkeypress="return hanyaAngka(event)" required>
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="tanggal">Tanggal<small class="text-danger">*</small></label>
                                        <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                                            <input type="text" name="tanggal" class="form-control datetimepicker-input"
                                                data-target="#datetimepicker2"/ required>
                                            <div class="input-group-append" data-target="#datetimepicker2"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="foto_atlet">Foto</label>
                                        <input type="file" class="form-control" name="foto" id="imgInp" required>

                                        <div class="card mt-2" style="width: 200px;height:200px;">
                                            <img src="#" style="height:200px;" id="blah" alt="">
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="modal fade" id="modal-create">
        <div class="modal-dialog modal-lg">
            <form method="post" id="form-create" action="{{ url('/user_store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Buku Tamu</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <label for="nik">NIK<small class="text-danger">*</small></label>
                                <input type="text" name="nik" class="form-control" maxlength="16"
                                    onkeypress="return hanyaAngka(event)" required>
                            </div>

                            <div class="col-md-12">
                                <label for="nama">Nama <small class="text-danger">*</small></label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label for="alamat">Alamat<small class="text-danger">*</small></label>
                                <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control"
                                    required></textarea>
                                {{--  <input type="text" name="alamat" class="form-control" required>  --}}
                            </div>


                            <div class="col-md-12">
                                <label for="keperluan">Keperluan <small class="text-danger">*</small></label>
                                <input type="text" name="keperluan" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label for="no_hp">Nomor Hp<small class="text-danger">*</small></label>
                                <input type="text" name="no_hp" class="form-control" maxlength="13"
                                    onkeypress="return hanyaAngka(event)" required>
                            </div>

                            <div class="col-sm-12">
                                <label for="tanggal">Tanggal<small class="text-danger">*</small></label>
                                <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                    <input type="text" name="tanggal" class="form-control datetimepicker-input"
                                        data-target="#datetimepicker"/ required>
                                    <div class="input-group-append" data-target="#datetimepicker"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="foto_atlet">Foto</label>
                                <input type="file" class="form-control" name="foto" id="imgInp2" required>

                                <div class="card mt-2" style="width: 200px;height:200px;">
                                    <img src="#" style="height:200px;" id="blah2" alt="">
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
            </form>
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
