@extends('layout.master')
@section('css')
<link href="{{ url('') }}/sbadmin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('plugins/izitoast/dist/css/iziToast.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2/dist/css/select2.min.css') }}">
<style>

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

                                <div class="card mb-5">
                                    <div class="card-header">
                                        <h3 class="card-title">Arsip Foto</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <button class="btn btn-primary mb-5" data-toggle="modal"
                                            data-target="#modal-tambah">Tambah</button>
                                        <a href="{{ url('') }}/foto_chart" class="btn btn-danger mb-5"><i
                                                class="fa fa-chart"> Grafik</i></a>
                                        <a href="{{ url('') }}/foto_pdf" title="Unduh Dokumen (PDF)"
                                            class="btn btn-info mb-5"><i class="fa fa-print"> Cetak
                                                Semua
                                                Data</i></a>
                                        <button id="filter_pdf_bulan" class="btn btn-warning mb-5"><i
                                                class="fa fa-print">
                                                Cetak Berdasarkan Bulan</i></button>
                                        <button id="filter_pdf" class="btn btn-success mb-5"><i class="fa fa-print">
                                                Cetak Berdasarkan</i></button>

                                        <div id="cetak_filter_bulan" class="mb-4" style="display: none">
                                            <form action="{{ url('') }}/foto_pdf_filter_bulan" class="form-inline">
                                                <div class="form-group mr-2">
                                                    <label class="mr-3" for="">Bulan</label>
                                                    <input type="month" name="bulan" class="form-control">
                                                </div>

                                                <button type="submit" class="btn btn-warning">Cetak</button>
                                            </form>
                                        </div>

                                        <div id="cetak_filter" class="mb-4" style="display: none">
                                            <form action="{{ url('') }}/foto_pdf_filter" class="form-inline">
                                                <div class="form-group mr-2">
                                                    <label class="mr-3" for="">Tanggal</label>
                                                    <input type="date" name="tanggal" class="form-control">
                                                </div>

                                                <div class="form-group mr-2">
                                                    <label class="mr-3" for="">Judul</label>
                                                    <input type="text" name="judul" class="form-control">
                                                </div>

                                                <div class="form-group mr-2">
                                                    <label class="mr-3" for="">Peliput</label>
                                                    <select name="master_petugas_id" class="form-control "
                                                        data-placeholder="Pilih Peliput">
                                                        <option value="">--Pilih Pliput--</option>
                                                        @foreach ($petugas3 as $petugas3)
                                                        <option value="{{ $petugas3->id }}">{{ $petugas3->nama }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>



                                                <button type="submit" class="btn btn-success">Cetak</button>
                                            </form>
                                        </div>

                                        <table id="table" class="table table-bordered table-striped responsive">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Judul</th>
                                                    <th>Peliput</th>

                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>

                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="modal-edit">
                    <div class="modal-dialog modal-lg">
                        <form method="post" id="form-edit" action="{{ url('/foto_update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: cornflowerblue">
                                    <h4 class="modal-title" style="color: white">Edit Arsip Foto</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <label for="tanggal">Tanggal<small class="text-danger">*</small></label>
                                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                                required>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="judul">Judul <small class="text-danger">*</small></label>
                                            <input type="text" name="judul" id="judul" class="form-control" required>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="peliput">Peliput <small class="text-danger">*</small></label>
                                            <select name="master_petugas_id" class="form-control "
                                                data-placeholder="Pilih Peliput" required>
                                                <option value="">--Pilih Pliput--</option>
                                                @foreach ($petugas2 as $petugas2)
                                                <option value="{{ $petugas2->id }}">{{ $petugas2->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                        </form>
                    </div>
                </div>


            </div>

            <div class="modal fade" id="modal-show">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Detail</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row" id="sucses">

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
            <form method="post" id="form-tambah" action="{{ url('/foto_store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header" style="background-color: cornflowerblue">
                        <h4 class="modal-title" style="color: white">Tambah Arsip Foto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <label for="tanggal">Tanggal<small class="text-danger">*</small></label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label for="judul">Judul <small class="text-danger">*</small></label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label for="peliput">Peliput <small class="text-danger">*</small></label>
                                <select name="master_petugas_id" class="form-control " data-placeholder="Pilih Peliput"
                                    required>
                                    <option value="">--Pilih Pliput--</option>
                                    @foreach ($petugas as $petugas)
                                    <option value="{{ $petugas->id }}">{{ $petugas->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <table class="table table-bordered mt-3" id="dynamic_field_lampiran">
                                <tr>
                                    <td>
                                        <input style="color:black" type="file" id="file" name="nama_file[]"
                                            class="form-control file_list" required>
                                    </td>
                                    <td>
                                        <input style="color:black" type="text" name="keterangan[]"
                                            placeholder="keterangan" class="form-control keterangan_list" required>
                                    </td>
                                    <td>
                                        <button type="button" name="add_lampiran" id="add_lampiran"
                                            class="btn btn-success">+</button>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
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


<script src="{{ url('') }}/sbadmin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/sbadmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('') }}/sbadmin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/sbadmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('plugins/jquery.form.min.js') }}"></script>
<script src="{{asset('plugins/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{ asset('plugins/izitoast/dist/js/iziToast.min.js') }}"></script>
<script src="{{ asset('plugins/select2/dist/js/select2.full.min.js') }}"></script>

<script>
    if(jQuery().select2) {
    $(".select2").select2(
    {
    // theme: 'bootstrap4'
    }
    );
    }

    let list_data = [];
    const table = $("#table").DataTable({
    "responsive":true,
    "autoWidth":true,
    "pageLength":5,
    "lengthMenu":[[5,10,25,50,100,-1],[5,10,25,50,100,'semua']],
    "bLengthChange":true,
    "bFilter":true,
    "bInfo":true,
    "processing":true,
    "bServerSide":true,
    // searching: false,
    // paging: false,
    // info: false,
    ajax:{
    url: "{{ url('') }}/foto_data",
    type: "POST"
    },
    columnDefs:[
    { target:'_all', visible:true },
    {
    "targets":0,
    "class":"text-nowrap",
    "render":function(data, type, row, meta){
    list_data[row.id]=row;
    return meta.row + meta.settings._iDisplayStart + 1;
    }
    },
    {
    "targets":1,
    "class":"text-nowrap",
    "render":function(data, type, row, meta){
    var bulanIndo = ['', '01', '02', '03', '04', '05', '06', '07', '08', '09' , '10',
    '11', '12'];
    var hari = row.tanggal.split("-")[2];
    var bulan = row.tanggal.split("-")[1];
    var tahun = row.tanggal.split("-")[0];
    return hari + "-" + bulanIndo[Math.abs(bulan)] + "-" + tahun;
    }
    },
    {
    "targets":2,
    "class":"text-nowrap",
    "render":function(data, type, row, meta){

    return row.judul;
    }
    },
    {
    "targets":3,
    "class":"text-nowrap",
    "render":function(data, type, row, meta){

    return row.nama;
    }
    },
    {
    "targets":4,
    "class":"text-nowrap",
    "render":function(data, type, row, meta){

    // let download = `<a href="{{ url('')}}/user_download/${row.file}" title="Download file"></i></a>`

    let tampilan =`<button title="Detail" onclick="show('${row.id}')" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></button>
    <button title="Edit" onclick="edit('${row.id}')" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></button> <button title="Hapus" onclick="hapus('${row.id}')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
    `;
    return tampilan;
    }
    }
    ]
    });

    $('#form-tambah').on('submit', function (e) {
    e.preventDefault()

    $("#form-tambah").ajaxSubmit({
    beforeSend: function () {
    swal({
    title:"",
    text:"Loading...",
    icon: "https://www.boasnotas.com/img/loading2.gif",
    buttons: false,
    closeOnClickOutside: false,
    timer: 1000,
    //icon: "success"
    });
    },
    success: function (res) {
    if (res===true) {
    swal('Data Berhasil Di Tambah', '', 'success');
    table.ajax.reload(null,false)
    // location.reload();
    //set semua ke default
    $("#form-tambah input:not([name='_token'])").val('')
    $("#modal-tambah").modal('hide')
    }
    else if (res === 'file') {
    swal('Jenis File Salah', '', 'error');
    console.log(res)

    }

    }

    })

    });

    function edit(id) {
    let edit = list_data[id]
    $('#modal-edit').modal('show')
    //set semua ke default
    $("#form-edit input:not([name='_token'])").val('')
    $("#form-edit [name='id']").val(id)
    $("#form-edit [name='tanggal']").val(edit.tanggal)
    $("#form-edit [name='judul']").val(edit.judul)
    $("#form-edit [name='master_petugas_id']").val(edit.master_petugas_id)
    }
    $('#form-edit').on('submit', function(e) {
    e.preventDefault()
    $("#form-edit").ajaxSubmit({
    beforeSend: function () {
    swal({
    title:"",
    text:"Loading...",
    icon: "https://www.boasnotas.com/img/loading2.gif",
    buttons: false,
    closeOnClickOutside: false,
    timer: 1000,
    //icon: "success"
    });
    },
    success:function(res){
    if (res===true) {
    swal('Data Berhasil Dirubah', '', 'success');
    table.ajax.reload(null,false)
    //set semua ke default
    $("#form-edit input:not([name='_token'])").val('')
    $("#modal-edit").modal('hide')
    }

    }
    })
    });


    function hapus(id){
    swal({
    title: 'Anda Yakin Ingin Menghapus ?',
    text: '',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
    })
    .then((willDelete) => {
    if (willDelete) {

    $.ajax({
    url: "{{ url('') }}/foto_destroy",
    method:"POST",
    data: {id:id,_token:'{{ csrf_token() }}'},
    beforeSend: function () {
    swal({
    title:"",
    text:"Loading...",
    icon: "https://www.boasnotas.com/img/loading2.gif",
    buttons: false,
    closeOnClickOutside: false,
    timer: 1000,
    //icon: "success"
    });
    },
    success: function (results) {
    table.ajax.reload(null,false)
    swal('Berhasil Menghapus Data', {
    icon: 'success',
    });
    }
    });

    } else {
    swal('Data Batal Dihapus');
    }
    });
    }

    var i=1;
    $('#add_lampiran').click(function(){
    i++;
    $('#dynamic_field_lampiran').append('<tr id="row'+i+'" class="dynamic-added"> <td><input style="color:black" type="file" id="file" name="nama_file[]" class="form-control file_list" required> </td> <td><input style="color:black" type="text" name="keterangan[]" placeholder="keterangan" class="form-control keterangan_list" required></td> <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_lampiran">X</button></td> </tr>'); });

    $(document).on('click', '.btn_remove_lampiran', function(){
    var button_id = $(this).attr("id");
    $('#row'+button_id+'').remove();
    });

    function show(id){
    $('#modal-show').modal('show')
    $.ajax({
    url: "{{ url('') }}/foto_show",
    method: "POST",
    data: {id:id,_token: '{{ csrf_token() }}'},
    success: function (data) {
    $('#sucses').html(data)
    }
    });


    }

    $("#filter_pdf_bulan").click(function(){
    $("#cetak_filter_bulan").toggle();
    });

    $("#filter_pdf").click(function(){
    $("#cetak_filter").toggle();
    });
</script>


@endsection
