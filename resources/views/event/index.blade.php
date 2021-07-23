@extends('layout.master')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1 class="m-0 text-dark">Karyawan {{ $jenis }}</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Event</li>
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
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card">
                                    <div class="card-header">
                                        @if (auth()->user()->role=='admin')
                                        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-create"> <i class="fa fa-plus"></i></button>
                                        @endif
                                      <h3 class="card-title">Data Event</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                      <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                        <th>Nama Event</th>
                                        <th>Tingkat</th>
                                        <th>Lokasi</th>
                                        <th>Tahun</th>
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
                    </div><!-- /.card-body -->
                    <div class="modal fade" id="modal-edit">
                        <div class="modal-dialog modal-lg">
                        <form method="post" id="form-edit" action="{{ url('/event_update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Edit Event</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="nama">Nama Event<small class="text-danger">*</small></label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="tingkat">Tingkat <small class="text-danger">*</small></label>
                                        <select name="tingkat" class="form-control" data-placeholder="Pilih Kategori" required>
                                            <option value=""></option>
                                            <option value="Sekolah">Sekolah</option>
                                            <option value="Kecamatan">Kecamatan</option>
                                            <option value="Kabupaten">Kabupaten</option>
                                            <option value="Provinsi">Provinsi</option>
                                            <option value="Nasional">Nasional</option>
                                            <option value="Internasional">Internasional</option>
                                        </select>
                                    </div>


                                    <div class="col-md-12">
                                        <label for="lokasi">Loakasi<small class="text-danger">*</small></label>
                                        <input type="text" name="lokasi" class="form-control" required>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="tahun">Tahun<small class="text-danger">*</small></label>
                                        <input type="text" name="tahun" class="form-control" required>
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
    <form method="post" id="form-create" action="{{ url('/event_store') }}" enctype="multipart/form-data">
        @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Event</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <label for="nama_event">Nama Event<small class="text-danger">*</small></label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="col-md-12">
                    <label for="tingkat">Tingkat <small class="text-danger">*</small></label>
                    <select name="tingkat" class="form-control select2bs4" data-placeholder="Pilih Kategori" required>
                        <option value=""></option>
                        <option value="Sekolah">Sekolah</option>
                        <option value="Kecamatan">Kecamatan</option>
                        <option value="Kabupaten">Kabupaten</option>
                        <option value="Provinsi">Provinsi</option>
                        <option value="Nasional">Nasional</option>
                        <option value="Internasional">Internasional</option>
                    </select>
                </div>


                <div class="col-md-12">
                    <label for="lokasi">Loakasi<small class="text-danger">*</small></label>
                    <input type="text" name="lokasi" class="form-control" required>
                </div>

                <div class="col-md-12">
                    <label for="tahun">Tahun<small class="text-danger">*</small></label>
                    <input type="text" name="tahun" class="form-control" required>
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
    let list_data = [];
    tahapan = $("#filter_tahapan").val(),
    covid = $("#filter_covid").val()
    const table = $("#table").DataTable({
          "responsive": true,
          "autoWidth": false,
          "pageLength":10,
          "lengthMenu":[[10,25,50,100,-1],[10,25,50,100,'semua']],
          "bLengthChange":true,
          "bFilter":true,
          "bInfo":true,
          "processing":true,
          "bServerSide":true,
          ajax:{
              url: "{{ url('') }}/event_data",
              type: "POST",
              data : function(d){
                //   d.kecamatan = kecamatan;
                //   d.tahapan = tahapan;
                //   d.covid = covid;
                  return d
              }
          },
        columnDefs:[
         { target:'_all', visible:true },
         {
            "targets":0,
            "class":"text-nowrap",
            "render":function(data, type, row, meta){
                list_data[row.id]=row;
                return row.nama;
            }
        },
        {
            "targets":1,
            "class":"text-nowrap",
            "render":function(data, type, row, meta){
                list_data[row.id]=row;
                return row.tingkat;
            }
        },
        {
            "targets":2,
            "class":"text-nowrap",
            "render":function(data, type, row, meta){
                list_data[row.id]=row;
                return row.tahun;
            }
        },
        {
            "targets":3,
            "class":"text-nowrap",
            "render":function(data, type, row, meta){
                list_data[row.id]=row;
                return row.lokasi;
            }
        },
        {
            "targets":4,
            "class":"text-nowrap",
            "render":function(data, type, row, meta){

                // let download = `<a href="{{ url('')}}/user_download/${row.file}" title="Download file"></i></a>`
                let tampilan =`
                 <button title="Kembalikan Inovasi" onclick="edit('${row.id}')" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button>
                 <button title="Hapus" onclick="toggleHapus('${row.id}')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                 `
                return tampilan;
            }
        }
        ]
            });

    //          function toggleKirim(id){

    // Swal.fire({
    // title: "Anda Yakin Mengembalikan Inovasi?",
    // text: "Silahkan Konfirmasi!",
    // icon: 'warning',
    // showCancelButton: !0,
    // confirmButtonText: "Ya, Saya Yakin",
    // cancelButtonText: "Tida, Batal",
    // reverseButtons: !0
    // }).then(function (e) {

    // if (e.value === true) {
    //     let trx_kecamatan = list_data[id]
    //     let posting ='0'

    //     $.ajax({
    //         url: "{{ url('') }}/user_kirim_kecamatan",
    //         method:"POST",
    //         data: {id:id,posting:posting,_token:'{{ csrf_token() }}'},
    //         success: function (results) {
    //             table.ajax.reload(null,false)

    //             if (results.success === true) {
    //                 Swal.fire("Berhasil Mengirim!", results.message, "success");
    //             } else {
    //                 Swal.fire("Berhasil Mengirim!", results.message, "success");
    //             }
    //         }
    //     });

    // } else {
    //     e.dismiss;
    // }

    // }, function (dismiss) {
    // return false;
    // })
    // }

    $('#form-create').on('submit', function(e) {
            e.preventtDefault()

            $("#form-create").ajaxSubmit({
                success:function(res){
                table.ajax.reload(null,true)
                location.reload();
                toastr.success('Data Berhasil Disimpan')
                //set semua ke default
                $("#form-create input:not([name='_token'])").val('')
                $("#modal-create").modal('hide')
                },error:function(err){
                    // let err_log = err.responseJSON.errors
                    // if(err.status == 422){
                    //     if (err_log.anggaran) {
                    //     toastr.error(err_log.anggaran)
                    //     }
                    //     if(err_log.profil_bisnis){
                    //     toastr.error(err_log.profil_bisnis)
                    //     }
                    //     if (err_log.rancangan_bangun ) {
                    //     toastr.error(err_log.rancangan_bangun)
                    //     }
                    //     if (err_log.tujuan_inovasi ) {
                    //     toastr.error(err_log.tujuan_inovasi)
                    //     }
                    //     if (err_log.manfaat ) {
                    //     toastr.error(err_log.manfaat)
                    //     }
                    //     if (err_log.hasil ) {
                    //     toastr.error(err_log.hasil)
                    //     }
                    //     console.log(err)
                    // }
                }
            })
        })

        function edit(id) {
            let edit = list_data[id]
            $('#modal-edit').modal('show')
            //set semua ke default
            $("#form-create input:not([name='_token'])").val('')
            $("#form-edit textarea").val('')

            $("#form-edit [name='id']").val(id)
            $("#form-edit [name='nama']").val(edit.nama)
            $("#form-edit [name='tingkat']").val(edit.tingkat)
            $("#form-edit [name='tahun']").val(edit.tahun)
            $("#form-edit [name='lokasi']").val(edit.lokasi)
         }

          $('#form-edit').on('submit', function(e) {
            e.preventtDefault()

            $("#form-edit").ajaxSubmit({
                success:function(res){
                    if (res===true) {
                    toastr.success('Data Berhasil Disimpan')
                    location.reload();
                    table.ajax.reload(null,false)
                //set semua ke default
                // $("#form-edit input:not([name='_token'])").val('')
                     $("#modal-edit").modal('hide')
                     }

                }
            })
        });


        function toggleHapus(id){

Swal.fire({
title: "Anda Yakin Menghapus Inovasi?",
text: "Silahkan Konfirmasi!",
icon: 'warning',
showCancelButton: !0,
confirmButtonText: "Ya, Saya Yakin",
cancelButtonText: "Tidak, Batal",
reverseButtons: !0
}).then(function (e) {

if (e.value === true) {
    let trx_skpd = list_data[id]

    $.ajax({
        url: "{{ url('') }}/event_hapus",
        method:"POST",
        data: {id:id,_token:'{{ csrf_token() }}'},
        success: function (results) {
            table.ajax.reload(null,false)

            if (results.success === true) {
                Swal.fire("Berhasil Menghapus Data!", results.message, "success");
            } else {
                Swal.fire("Berhasil Menghapus Data!", results.message, "success");
            }
        }
    });

} else {
    e.dismiss;
}

}, function (dismiss) {
return false;
})
}

function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : eventt.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }

    </script>
@endsection


