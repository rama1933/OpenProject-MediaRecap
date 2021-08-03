<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-Arsip Diskominfo</title>
    <link rel="icon" type="image/png" href="{{ url('') }}/login/images/kominfo.png" />

    <!-- Custom fonts for this template-->
    <link href="{{ url('') }}/sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ url('') }}/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
    @yield('css')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-folder-open"></i>
                </div>
                <div class="sidebar-brand-text mx-3">E-Arsip</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            @if ((auth()->user()->role == 'admin'))

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('') }}/dashboard">
                    <i class="fas fa-fw fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('') }}/petugas">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Petugas</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('') }}/barang">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Inventaris Barang</span>
                </a>
            </li>



            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('') }}/foto">
                    <i class="fas fa-fw fa-photo-video"></i>
                    <span>Arsip Foto</span>
                </a>
            </li>



            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('') }}/video">
                    <i class="fas fa-fw fa-video"></i>
                    <span>Arsip Video Mentah</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('') }}/video_jadi">
                    <i class="fas fa-fw fa-file-video"></i>
                    <span>Arsip Video Jadi</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('') }}/kliping">
                    <i class="fas fa-fw fa-icons"></i>
                    <span>Kliping Media</span>
                </a>
            </li>



            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('') }}/jadwal">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Jadwal Peliputan</span>
                </a>
            </li>



            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('') }}/permohonan">
                    <i class="fas fa-fw fa-file-signature"></i>
                    <span>Permohonan Data</span>
                </a>
            </li>


            <!-- Divider -->
            {{--  <hr class="sidebar-divider">  --}}
            <!-- Heading -->


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('') }}/user">
                    <i class="fas fa-fw fa-user-cog"></i>
                    <span>Ganti Password</span>
                </a>
            </li>
            @endif

            @if ((auth()->user()->role == 'user'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('') }}/ubah_password">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Ubah Password</span>
                </a>
            </li>
            @endif


            <hr class="sidebar-divider">
            <!-- Heading -->


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('logout') }}">
                    <i class="fas fa-fw fa-arrow-left"></i>
                    <span>Keluar</span>
                </a>
            </li>

            <!-- Heading -->

            <!-- Divider -->

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->nama }}</span>
                            </a>
                            <!-- Dropdown - User Information -->
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span> &copy; DISKOMINFOHSS2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('') }}/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="{{ url('') }}/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('') }}/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('') }}/sbadmin/js/sb-admin-2.min.js"></script>

    @yield('js')

</body>

</html>
