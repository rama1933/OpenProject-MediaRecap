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
                                        <h3 class="card-title">Grafik Arsip Kliping Media</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <!-- Card Body -->
                                        <div class="card-body">
                                            <div class="chart">
                                                <canvas id="speedChart"
                                                    style="min-height: 600px; height: 600px; max-height: 600px; max-width: 100%;"></canvas>
                                            </div>
                                        </div>
                                    </div> <!-- /.card-body -->
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


<script src="{{ url('') }}/sbadmin/vendor/chart.js/Chart.min.js"></script>

<script>
    var speedCanvas = document.getElementById("speedChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var speedData = {
labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun","Jul", "Agt", "Sep", "Okt", "Nop", "Des"],
datasets: [{
label: "Jumlah Kliping Media",
backgroundColor: [
'rgba(75, 192, 192, 0.2)',
],
data: ['{{ $jan }}', '{{ $feb }}', '{{ $mar }}', '{{ $apr }}', '{{ $mei }}',
'{{ $jun }}','{{ $jul }}', '{{ $agt }}', '{{ $sep }}', '{{ $okt }}',
'{{ $nop }}', '{{ $des }}'],
}]
};

var chartOptions = {
legend: {
display: true,
position: 'top',
labels: {
boxWidth: 80,
fontColor: 'black'
}
}
};

var lineChart = new Chart(speedCanvas, {
type: 'line',
data: speedData,
options: chartOptions
});
</script>


@endsection
