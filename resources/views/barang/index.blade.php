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
                                        <h3 class="card-title">Inventaris Barang</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <button class="btn btn-primary mb-5" data-toggle="modal"
                                            data-target="#modal-tambah">Tambah</button>
                                        <a href="{{ url('') }}/barang_chart" class="btn btn-danger mb-5"><i
                                                class="fa fa-chart"> Grafik</i></a>
                                        <a href="{{ url('') }}/barang_pdf" title="Unduh Dokumen (PDF)"
                                            class="btn btn-info mb-5"><i class="fa fa-print"> Cetak Semua
                                                Data</i></a>
                                        <button id="filter_pdf" class="btn btn-success mb-5"><i class="fa fa-print">
                                                Cetak Berdasarkan</i></button>

                                        <div id="cetak_filter" class="mb-4" style="display: none">
                                            <form action="{{ url('') }}/barang_pdf_filter" class="form-inline">
                                                <div class="form-group mr-2">
                                                    <label class="mr-3" for="">Id Barang</label>
                                                    <input type="text" name="id_barang" class="form-control">
                                                </div>

                                                <div class="form-group mr-2">
                                                    <label class="mr-3" for="">Kategori</label>
                                                    <select name="kategori" class="form-control">
                                                        <option value="">--Pilih Kategori--</option>
                                                        <option value="1">Kamera Foto</option>
                                                        <option value="2">Kamera Video</option>
                                                        <option value="3">Tripod</option>
                                                        <option value="4">Drone</option>

                                                    </select>
                                                </div>

                                                <div class="form-group mr-2">
                                                    <label class="mr-3" for="">Nama</label>
                                                    <input type="text" name="nama_barang" class="form-control">
                                                </div>

                                                <div class="form-group mr-2">
                                                    <label class="mr-3" for="">Kondisi</label>
                                                    <select name="kondisi" class="form-control">
                                                        <option value="">--Pilih Kondisi--</option>
                                                        <option value="Bagus">Bagus</option>
                                                        <option value="Rusak">Rusak</option>
                                                    </select>
                                                </div>

                                                <div class="form-group mr-2">
                                                    <label class="mr-3" for="">Pemakai</label>
                                                    <input type="text" name="pemakai" class="form-control">
                                                </div>

                                                <button type="submit" class="btn btn-success">Cetak</button>
                                            </form>
                                        </div>
                                        <table id="table" class="table table-bordered table-striped responsive">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>ID Barang</th>
                                                    <th>Kategori</th>
                                                    <th>Nama Barang</th>
                                                    <th>Kondisi</th>
                                                    <th>Pemakai</th>
                                                    <th>Stok</th>
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
                        <form method="post" id="form-edit" action="{{ url('/barang_update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: cornflowerblue">
                                    <h4 class="modal-title" style="color: white">Edit Barang</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <label for="id_barang">ID Barang <small
                                                    class="text-danger">*</small></label>
                                            <input type="text" name="id_barang" id="id_barang" class="form-control"
                                                required>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="kategori">Pilih kategori<small
                                                    class="text-danger">*</small></label>
                                            <select name="kategori" id="kategori" class="form-control select2bs4"
                                                data-placeholder="Pilih Kategori" required>
                                                <option value="">--Pilih Kategori--</option>
                                                <option value="1">Kamera Foto</option>
                                                <option value="2">Kamera Video</option>
                                                <option value="3">Tripod</option>
                                                <option value="4">Drone</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="nama">Nama Barang <small class="text-danger">*</small></label>
                                            <input type="text" name="nama" id="nama" class="form-control" required>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="mr-3" for="">Kondisi</label>
                                            <select name="kondisi" class="form-control" required>
                                                <option value="">--Pilih--</option>
                                                <option value="Bagus">Bagus</option>
                                                <option value="Rusak">Rusak</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="pemakai">Pemakai<small class="text-danger">*</small></label>
                                            <input type="text" name="pemakai" class="form-control" required>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="stok">Stok <small class="text-danger">*</small></label>
                                            <input type="text" name="stok" onkeypress="return hanyaAngka(event)"
                                                id="stok" class="form-control" required>
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
        </div>
    </div>


    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
            <form method="post" id="form-tambah" action="{{ url('/barang_store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header" style="background-color: cornflowerblue">
                        <h4 class="modal-title" style="color: white">Tambah Barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <label for="id_barang">ID Barang <small class="text-danger">*</small></label>
                                <input type="text" name="id_barang" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label for="kategori">Pilih kategori<small class="text-danger">*</small></label>
                                <select name="kategori" class="form-control select2bs4"
                                    data-placeholder="Pilih Kategori" required>
                                    <option value="">--Pilih Kategori--</option>
                                    <option value="1">Kamera Foto</option>
                                    <option value="2">Kamera Video</option>
                                    <option value="3">Tripod</option>
                                    <option value="4">Drone</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="nama">Nama Barang <small class="text-danger">*</small></label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label class="mr-3" for="">Kondisi</label>
                                <select name="kondisi" class="form-control" required>
                                    <option value="">--Pilih--</option>
                                    <option value="Bagus">Bagus</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="pemakai">Pemakai<small class="text-danger">*</small></label>
                                <input type="text" name="pemakai" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label for="stok">Stok <small class="text-danger">*</small></label>
                                <input type="text" name="stok" onkeypress="return hanyaAngka(event)"
                                    class="form-control" required>
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
    url: "{{ url('') }}/barang_data",
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
    return row.id_barang;
    }
    },
    {
    "targets":2,
    "class":"text-nowrap",
    "render":function(data, type, row, meta){

    let tampilan =``;
    if (row.kategori == 1) {
        tampilan =`Kamera Foto`;
    }
    if (row.kategori == 2) {
    tampilan =`Kamera Video`;
    }
    if (row.kategori == 3) {
    tampilan =`Tripot`;
    }
    if (row.kategori == 4) {
    tampilan =`Drone`;
    }
    return tampilan;
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

    return row.kondisi;
    }
    },
    {
    "targets":5,
    "class":"text-nowrap",
    "render":function(data, type, row, meta){

    return row.pemakai;
    }
    },
    {
    "targets":6,
    "class":"text-nowrap",
    "render":function(data, type, row, meta){

    return row.stok;
    }
    },
    {
    "targets":7,
    "class":"text-nowrap",
    "render":function(data, type, row, meta){

    // let download = `<a href="{{ url('')}}/user_download/${row.file}" title="Download file"></i></a>`

    let tampilan =`<button title="Edit" onclick="edit('${row.id}')" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></button> <button title="Hapus" onclick="hapus('${row.id}')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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

    }

    })

    });

    function edit(id) {
    let edit = list_data[id]
    $('#modal-edit').modal('show')
    //set semua ke default
    $("#form-edit input:not([name='_token'])").val('')
    $("#form-edit [name='id']").val(id)
    $("#form-edit [name='id_barang']").val(edit.id_barang)
    $("#form-edit [name='kategori']").val(edit.kategori)
    $("#form-edit [name='nama']").val(edit.nama)
    $("#form-edit [name='kondisi']").val(edit.kondisi)
    $("#form-edit [name='pemakai']").val(edit.pemakai)
    $("#form-edit [name='stok']").val(edit.stok)
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
    url: "{{ url('') }}/barang_destroy",
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

    $("#filter_pdf").click(function(){
    $("#cetak_filter").toggle();
    });

    function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode> 57))

        return false;
        return true;
        }

</script>


@endsection
