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
                                      <h3 class="card-title">Edit Data Kategori</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        @foreach ($data as $data)
                                        <form method="post" id="form-edit" action="{{ url('/kategori_update') }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="nama_kategori">Nama Kategori <small class="text-danger">*</small></label>
                                                    <input type="text" value="{{ $data->nama_kategori }}" name="nama_kategori" class="form-control" required>
                                                </div>
                                            </div>
                                              <br>


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

@endsection


