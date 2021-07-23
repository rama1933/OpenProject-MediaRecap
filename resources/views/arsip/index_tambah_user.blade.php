@extends('layout.master')
@section('css')
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

                <div class="card-body">
                    <div class="row">

                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card">
                                    <div class="card-header">
                                      <h3 class="card-title">Tambah Data Video</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <form method="post" id="form-create" action="{{ url('/arsip_store') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                    <div class="col-md-12">
                                                        <label for="nama_petugas">Nama Petugas <small class="text-danger">*</small></label>
                                                        <input type="text" name="" value="{{ auth()->user()->nama }}" class="form-control" readonly>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="kategori">Kategori <small class="text-danger">*</small></label>
                                                        <select name="kategori_id" id="" class="form-control" required>
                                                            <option value="">Pilih Kategori</option>
                                                            @foreach ($kategori as $kategori)
                                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="tanggal">Tanggal<small class="text-danger">*</small></label>
                                                        <input type="date" name="tanggal" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="tempat">Tempat<small class="text-danger">*</small></label>
                                                        <input type="text" name="tempat" class="form-control" required>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="uraian">Uraian Kegiatan<small class="text-danger">*</small></label>
                                                        <textarea name="uraian" id="uraian" cols="30" rows="2" class="form-control" required></textarea>
                                                        {{--  <input type="text" name="alamat" class="form-control" required>  --}}
                                                    </div>


                                                        <div class="col-md-12">
                                                            <label for="link_video">Link Video <small class="text-danger">*</small></label>
                                                            <input type="text" name="link_video" class="form-control" required>
                                                        </div>
                                                </div>
                                              <br>


                                              <button type="submit" class="btn btn-primary">Simpan</button>

                                        </form>

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

@endsection


