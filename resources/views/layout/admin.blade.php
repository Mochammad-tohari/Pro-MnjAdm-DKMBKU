<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <title>AdminLTE 3 | Dashboard 2</title> --}}

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    {{-- <link rel="stylesheet" href="{{ secure_asset('Tema_LTE/plugins/fontawesome-free/css/all.min.css') }} ">
    "secure_asset" untuk menjalankan di NGROK --}}
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('Tema_LTE/plugins/fontawesome-free/css/all.min.css') }} ">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('Tema_LTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }} ">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('Tema_LTE/dist/css/adminlte.min.css') }} ">
    {{-- nav colour --}}
    <link rel="stylesheet" href="{{ asset('public/Design/admin_layout.css') }}">
    <!-- Web Icon (Favicon) -->
    <link rel="icon" type="image/x-icon" href="Tema_LTE/dist/img/Logo_Masjid.png">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader Mengubah tampilan Loading -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('Tema_LTE/dist/img/Logo_Masjid.png') }} " alt="AdminLTELogo"
                height="80" width="80">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/contact_header_page" class="nav-link">Contact</a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo Mengubah Logo-->
            <a href="#" class="brand-link">
                <img src="{{ asset('Tema_LTE/dist/img/Logo_Masjid.png') }}" alt="Logo_Masjid"
                    class="brand-image img-circle elevation-3" style="opacity: .8" height="50" width="50">
                <span class="brand-text font-weight-light">DKMBKU</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) Logo user-->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('Tema_LTE/dist/img/Logo_Manajemen_MBKU.png') }}"
                            class="img-circle elevation-2" alt="User Image" height="80" width="80">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }} ({{ Auth::user()->akses }}) </a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="/" class="nav-link active">
                                <i class="nav-icon far fa-compass"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Daftar Data
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="/bidang_nawa_data"
                                        class="nav-link{{ Request::is('bidang_nawa_data') ? ' active' : '' }}">
                                        <i class="nav-icon fa fa-columns"></i>
                                        <p>
                                            Data Bidang Nawa
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/pengurus_nawa_data"
                                        class="nav-link{{ Request::is('pengurus_nawa_data') ? ' active' : '' }}">
                                        <i class="nav-icon fa fa-columns"></i>
                                        <p>
                                            Data Pengurus Nawa
                                        </p>
                                    </a>
                                </li>



                                <li class="nav-item">
                                    <a href="/gedung_data"
                                        class="nav-link{{ Request::is('gedung_data') ? ' active' : '' }}">
                                        <i class="nav-icon fa fa-columns"></i>
                                        <p>
                                            Data Gedung
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/ruangan_data"
                                        class="nav-link{{ Request::is('ruangan_data') ? ' active' : '' }}">
                                        <i class="nav-icon fa fa-columns"></i>
                                        <p>
                                            Data Ruangan
                                        </p>
                                    </a>
                                </li>



                                <li class="nav-item">
                                    <a href="/murid_madrasah_data"
                                        class="nav-link{{ Request::is('murid_madrasah_data') ? ' active' : '' }}">
                                        <i class="nav-icon fa fa-columns"></i>
                                        <p>
                                            Data Murid Madrasah
                                        </p>
                                    </a>
                                </li>



                                <li class="nav-item">
                                    <a href="/bidang_khodim_data"
                                        class="nav-link{{ Request::is('bidang_khodim_data') ? ' active' : '' }}">
                                        <i class="nav-icon fa fa-columns"></i>
                                        <p>
                                            Data Bidang Khodim
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/khodim_dkm_data"
                                        class="nav-link{{ Request::is('khodim_dkm_data') ? ' active' : '' }}">
                                        <i class="nav-icon fa fa-columns"></i>
                                        <p>
                                            Data Khodim DKM
                                        </p>
                                    </a>
                                </li>



                                <li class="nav-item">
                                    <a href="/bidang_pengurus_dkm_data"
                                        class="nav-link{{ Request::is('bidang_pengurus_dkm_data') ? ' active' : '' }}">
                                        <i class="nav-icon fa fa-columns"></i>
                                        <p>
                                            Data Bidang Pengurus DKM
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/pengurus_dkm_data"
                                        class="nav-link{{ Request::is('pengurus_dkm_data') ? ' active' : '' }}">
                                        <i class="nav-icon fa fa-columns"></i>
                                        <p>
                                            Data Pengurus DKM
                                        </p>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="/majlistalim_data"
                                        class="nav-link{{ Request::is('majlistalim_data') ? ' active' : '' }}">
                                        <i class="nav-icon fa fa-columns"></i>
                                        <p>
                                            Data Majlistalim
                                        </p>
                                    </a>
                                </li>



                                <li class="nav-item">
                                    <a href="/inventaris_data"
                                        class="nav-link{{ Request::is('inventaris_data') ? ' active' : '' }}">
                                        <i class="nav-icon fa fa-columns"></i>
                                        <p>
                                            Data Inventaris
                                        </p>
                                    </a>
                                </li>



                                <li class="nav-item">
                                    <a href="/uji_bidang_data_new"
                                        class="nav-link{{ Request::is('uji_bidang_data_new') ? ' active' : '' }}">
                                        <i class="nav-icon fa fa-columns"></i>
                                        <p>
                                            Data Bidang Uji
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/uji_user_data_new"
                                        class="nav-link{{ Request::is('uji_user_data_new') ? ' active' : '' }}">
                                        <i class="nav-icon fa fa-columns"></i>
                                        <p>
                                            Data User Uji
                                        </p>
                                    </a>
                                </li>


                                {{--
                                <li class="nav-item">
                                    <a href="/data_uji"
                                        class="nav-link{{ Request::is('data_uji') ? ' active' : '' }}">
                                        <i class="nav-icon fa fa-columns"></i>
                                        <p>
                                            Data Uji
                                        </p>
                                    </a>
                                </li> --}}

                            </ul>
                        </li>

                        <li class="nav-item keluar">
                            <a href="/logout" class="nav-link active">
                                <i class="nav-icon fas fa-times-circle"></i>
                                <p>
                                    Keluar
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong><a>Manajemen DKMBKU</a></strong>
            AdminLTE.io All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                {{-- <b>Version</b> 3.2.0 --}}
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('Tema_LTE/plugins/jquery/jquery.min.js') }} "></script>
    <!-- Bootstrap -->
    <script src="{{ asset('Tema_LTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('Tema_LTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }} "></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('Tema_LTE/dist/js/adminlte.js') }} "></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('Tema_LTE/plugins/jquery-mousewheel/jquery.mousewheel.js') }} "></script>
    <script src="{{ asset('Tema_LTE/plugins/raphael/raphael.min.js') }} "></script>
    <script src="{{ asset('Tema_LTE/plugins/jquery-mapael/jquery.mapael.min.js') }} "></script>
    <script src="{{ asset('Tema_LTE/plugins/jquery-mapael/maps/usa_states.min.js') }} "></script>
    <!-- ChartJS -->
    <script src="{{ asset('Tema_LTE/plugins/chart.js/Chart.min.js') }}"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('Tema_LTE/dist/js/demo.js') }} "></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('Tema_LTE/dist/js/pages/dashboard2.js') }} "></script> --}}

</body>

</html>
