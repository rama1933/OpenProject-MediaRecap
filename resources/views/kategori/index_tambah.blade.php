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
                                      <h3 class="card-title">Tambah Data Kategori</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <form method="post" id="form-create" action="{{ url('/kategori_store') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="nama_kategori">Nama Kategori <small class="text-danger">*</small></label>
                                                        <input type="text" name="nama_kategori" class="form-control" required>
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


