<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Halaman Utama</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('') }}Knight/{{ asset('') }}Knight/assets/img/favicon.png" rel="icon">
  <link href="{{ asset('') }}Knight/{{ asset('') }}Knight/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('') }}Knight/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('') }}Knight/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="{{ asset('') }}Knight/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('') }}Knight/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ asset('') }}Knight/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="{{ asset('') }}Knight/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('') }}Knight/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: KnightOne - v2.2.0
  * Template URL: https://bootstrapmade.com/knight-simple-one-page-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container-fluid">

      <div class="row justify-content-center mt-3 mb-3">
        <div class="col-xl-9 d-flex align-items-center justify-content-between">
          <h1 class="logo"><a href="#">KEJARI HSS</a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

          <nav class="nav-menu d-none d-lg-block">

          </nav><!-- .nav-menu -->

          <a href="{{ route('masuk') }}" class="get-started-btn scrollto">Masuk</a>
        </div>
      </div>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
            <h1>BUKU TAMU KEJARI HSS</h1>
            <div class="card mb-5" style="background-color:rgba(0,0,0,0.5);">

                <div class="col-xl-12 mt-4 mb-4">
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
                    <form action="{{ url('/landing_store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                          <div class="form-group">
                            <label for="nik" style="color: white">NIK</label>
                            <input type="text" name="nik" class="form-control" maxlength="16"  onkeypress="return hanyaAngka(event)"  placeholder="NIK" data-rule="minlen:4" required />
                          </div>


                        <div class="form-group">
                            <label for="nama" style="color: white">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama"  placeholder="Nama " data-rule="minlen:4"required />
                          </div>

                        <div class="form-group">
                            <label for="alamat" style="color: white">Alamat</label>
                        <textarea class="form-control" name="alamat"  rows="5" placeholder="Alamat" data-rule="required"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="keperluan" style="color: white">Keperluan</label>
                            <input type="text" class="form-control" name="keperluan"  placeholder="Keperluan" required />
                          </div>

                            <div class="form-group">
                                <label for="no_hp" style="color: white">Nomor Hp</label>
                                <input type="text" class="form-control" maxlength="13"  onkeypress="return hanyaAngka(event)"  name="no_hp"  placeholder="Nomor Hp" required />

                              </div>

                              <div class="form-group">
                                <label for="tanggal" style="color: white">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal"placeholder="Subject" required />

                              </div>

                              <div class="form-group">
                                <label for="foto" style="color: white">Foto</label>
                                <input type="file" class="form-control" name="foto" required />

                              </div>
                              <div class="btn-group">
                        <div class="text-center">
                            <button class="btn btn-lg btn-success mr-3" type="submit">Kirim</button></div>
                        <div class="text-center"><button class="btn btn-lg btn-danger" type="reset">Batal</button></div>
                    </div>
                      </form>
                </div>
            </div>
          </div>

      </div>
    </div>
  </section><!-- End Hero -->





  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('') }}Knight/assets/vendor/jquery/jquery.min.js"></script>
  <script src="{{ asset('') }}Knight/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('') }}Knight/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="{{ asset('') }}Knight/assets/vendor/php-email-form/validate.js"></script>
  <script src="{{ asset('') }}Knight/assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="{{ asset('') }}Knight/assets/vendor/counterup/counterup.min.js"></script>
  <script src="{{ asset('') }}Knight/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{ asset('') }}Knight/assets/vendor/venobox/venobox.min.js"></script>
  <script src="{{ asset('') }}Knight/assets/vendor/owl.carousel/owl.carousel.min.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('') }}Knight/assets/js/main.js"></script>
  <script>
      function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
  </script>

</body>

</html>
