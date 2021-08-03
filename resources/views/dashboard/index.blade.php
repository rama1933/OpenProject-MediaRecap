@extends('layout.master')
@section('css')
<link href="{{ url('') }}/sbadmin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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

<section class="content"
    style="background-image: url('{{ asset('/login/images/IMG_2079.jpg')}}');background-size: 2000px 1000px;background-repeat: no-repeat;">
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

                                <div class="row">
                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <div class="card  shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="h5 text-xl font-weight-bold text-uppercase mb-1 text-center">
                                                            visi :</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            Terwujudnya efektivitas komunikasi dan informatika dalam
                                                            penyelenggaraan pemerintah daerah untuk mendukung Kabupaten
                                                            Hulu Sungai Selatan yang Sejahtera, Agamis dan Produktif
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6 mb-4">
                                        <div class="card  shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="h5 text-xl font-weight-bold text-uppercase mb-1 text-center">
                                                            Misi :</div>
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                            Berkembangnya tata kelola pemerintahan berbasis E-Goverment
                                                            Meningkatkan kualitas infrastruktur jaringan
                                                            Mewujudkan peningkatan kualita pelayanan publik
                                                            Membangun citra positif Kabupaten Hulu Sungai Selatan
                                                            Melaksanakan pengamanan informasi Pemerintah Daerah dan
                                                            layanan dokumen aktif statistik sektoral
                                                            Meningkatkan kapasitas dan akuntabilitas kinerja
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            Jumlah Petugas</div>
                                                        <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                            {{ $petugas }}
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-users fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-success shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                            Jumlah Inventaris Barang</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            {{ $barang }}
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-info shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                            Jumlah Kliping Media
                                                        </div>
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col-auto">
                                                                <div
                                                                    class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                    {{ $kliping }}</div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-icons fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pending Requests Card Example -->
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card border-left-warning shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                            Jumlah Permohonan Data</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            {{ $permohonan }}</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fa-file-signature fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card shadow mb-4" style="opacity: 0;">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary"></h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 30rem;"
                                                src="{{ url('') }}/sbadmin/img/off.svg" alt="">
                                            <p>Selamat Datang di Aplikasi Kearsipan Berbasis Elektronik Diskominfo
                                                Kabupaten
                                                Hulu Sungai Selatan</p>
                                        </div>

                                    </div>
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


@endsection
