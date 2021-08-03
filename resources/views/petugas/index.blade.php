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
                                        <h3 class="card-title">Data Petugas</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <button class="btn btn-primary mb-5" data-toggle="modal"
                                            data-target="#modal-tambah">Tambah</button>
                                        <a href="{{ url('') }}/petugas_pdf" title="Unduh Dokumen (PDF)"
                                            class="btn btn-info mb-5"><i class="fa fa-print"> Cetak
                                                Data</i></a>
                                        <table id="table" class="table table-bordered table-striped responsive">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Foto</th>
                                                    <th>Nama</th>
                                                    <th>Jabatan</th>
                                                    <th>alamat</th>
                                                    <th>No Hp</th>
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
                        <form method="post" id="form-edit" action="{{ url('/petugas_update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: cornflowerblue">
                                    <h4 class="modal-title" style="color: white">Edit Petugas</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <label for="nama">Nama Petugas<small class="text-danger">*</small></label>
                                            <input type="text" name="nama" id="nama" class="form-control" required>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="jabatan">Jabatan<small class="text-danger">*</small></label>
                                            <input type="text" name="jabatan" id="jabatan" class="form-control"
                                                required>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="alamat">Alamat<small class="text-danger">*</small></label>
                                            <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control"
                                                required></textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="no_hp">No Hp<small class="text-danger">*</small></label>
                                            <input type="text" name="no_hp" maxlength="13" minlength="8"
                                                onkeypress="return hanyaAngka(event)" id="no_hp" class="form-control"
                                                required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="foto">Foto</label>
                                            <input type="file" class="form-control" name="foto" id="imgInpEdit">
                                            <small class="text-danger">*Kosongkan Jika Tidak Ingin Mengganti</small>

                                            <div class="card mt-2" style="width: 200px;height:200px;">
                                                <img src="#" style="height:200px;" id="blahEdit" alt="">
                                            </div>
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
            <form method="post" id="form-tambah" action="{{ url('/petugas_store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header" style="background-color: cornflowerblue">
                        <h4 class="modal-title" style="color: white">Tambah Petugas</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-12">
                                <label for="nama">Nama Petugas<small class="text-danger">*</small></label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label for="jabatan">Jabatan<small class="text-danger">*</small></label>
                                <input type="text" name="jabatan" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label for="alamat">Alamat<small class="text-danger">*</small></label>
                                <textarea name="alamat" cols="30" rows="2" class="form-control" required></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="no_hp">No Hp<small class="text-danger">*</small></label>
                                <input type="text" name="no_hp" maxlength="13" minlength="8"
                                    onkeypress="return hanyaAngka(event)" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control" name="foto" id="imgInp">

                                <div class="card mt-2" style="width: 200px;height:200px;">
                                    <img src="#" style="height:200px;" id="blah" alt="">
                                </div>
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
    url: "{{ url('') }}/petugas_data",
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
    return '<img style="width:100px;height:100px;" class="zoom" src="{{ url('') }}/storage/'+row.foto+'">';
    }
    },
    {
    "targets":2,
    "class":"text-nowrap",
    "render":function(data, type, row, meta){

    return row.nama;
    }
    },
    {
    "targets":3,
    "class":"text-nowrap",
    "render":function(data, type, row, meta){

    return row.jabatan;
    }
    },
    {
    "targets":4,
    "class":"text-nowrap",
    "render":function(data, type, row, meta){

    return row.alamat;
    }
    },
    {
    "targets":5,
    "class":"text-nowrap",
    "render":function(data, type, row, meta){

    return row.no_hp;
    }
    },
    {
    "targets":6,
    "class":"text-nowrap",
    "render":function(data, type, row, meta){

    // let download = `<a href="{{ url('')}}/user_download/${row.file}" title="Download file"></i></a>`

    let tampilan =`<button title="Edit" onclick="edit('${row.id}')" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></button> <button title="Hapus" onclick="hapus('${row.id}')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
    <a href="{{ url('') }}/petugas_pdf_detail/${row.id}" title="Unduh Dokumen (PDF)" class="btn btn-sm btn-success"><i class="fa fa-print"></i></a>
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
    },error:function(err){
    let err_log = err.responseJSON.errors
    if(err.status == 422){
    if (err_log.foto) {
    swal('Jenis File Salah', '', 'error');
    }
    console.log(err)
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
    $("#form-edit [name='nama']").val(edit.nama)
    $("#form-edit [name='alamat']").val(edit.alamat)
    $("#form-edit [name='jabatan']").val(edit.jabatan)
    $("#form-edit [name='no_hp']").val(edit.no_hp)
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
    },
    error:function(err){
    let err_log = err.responseJSON.errors
    if(err.status == 422){
    if (err_log.foto) {
    swal('Jenis File Salah', '', 'error');
    }
    console.log(err)
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
    url: "{{ url('') }}/petugas_destroy",
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

    $("#imgInp").change(function(){
    readURL(this);
    });

    function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
    }

    $("#imgInpEdit").change(function(){
    readURLEdit(this);
    });

    function readURLEdit(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('#blahEdit').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
    }

    function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode> 57))

        return false;
        return true;
        }
</script>


@endsection
