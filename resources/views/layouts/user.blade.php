<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RFK</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/notif/dist/css/iziToast.min.css">
    <script src="/notif/dist/js/iziToast.min.js" type="text/javascript"></script>

    @stack('css')
    <style>
        .active {
            background-color: green;
            border-radius: 25px;
            color: white
        }

        @media (max-width: 768px) {
            .navbar-toggler {
                margin-left: auto;
            }
        }

        @media (max-width: 768px) {
            .navbar-brand>img {
                max-width: 290px;
            }
        }

        @media (min-width: 768px) {
            .navbar-nav.ml-md-auto .nav-item {
                margin-left: auto;
            }
        }
    </style>

</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light bg-gray bg-gray-dark">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">
                    <img src="/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light" style="color: silver">SIAP KALSEL</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        @if (Auth::user()->roles == 'dpw')
                        <li class="nav-item" style="">
                            <a href="/dpw" class="nav-link {{request()->is('dpw') ? 'active':''}}"
                                style="color: white"><i class="fa fa-home"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="/dpw/rfk" class="nav-link {{request()->is('dpw/rfk*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-money-bill"></i> RFK</a>
                        </li>
                        @if (Auth::user()->dpw->bidang == 'KEBENDAHARAAN / KEUANGAN')
                        <li class="nav-item">
                            <a href="/dpw/aset" class="nav-link {{request()->is('dpw/aset*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-cubes"></i> ASET</a>
                        </li>
                        <li class="nav-item">
                            <a href="/dpw/keuangan" class="nav-link {{request()->is('dpw/keuangan*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-money-bill"></i> KEUANGAN</a>
                        </li>
                        <li class="nav-item">
                            <a href="/dpw/coa" class="nav-link {{request()->is('dpw/coa*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-list"></i> COA</a>
                        </li>
                        @endif
                        @if (Auth::user()->dpw->bidang == 'KESEKRETARIATAN')
                        <li class="nav-item">
                            <a href="/dpw/surat-masuk"
                                class="nav-link {{request()->is('dpw/surat-masuk*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-envelope"></i> SURAT MASUK</a>
                        </li>
                        <li class="nav-item">
                            <a href="/dpw/surat-keluar"
                                class="nav-link {{request()->is('dpw/surat-keluar*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-envelope"></i> SURAT KELUAR</a>
                        </li>
                        <li class="nav-item">
                            <a href="/dpw/anggota" class="nav-link {{request()->is('dpw/anggota*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-users"></i> ANGGOTA</a>
                        </li>
                        @endif
                        @endif
                        @if (Auth::user()->roles == 'dpk')
                        <li class="nav-item" style="">
                            <a href="/dpk" class="nav-link {{request()->is('dpk') ? 'active':''}}"
                                style="color: white"><i class="fa fa-home"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="/dpk/rfk" class="nav-link {{request()->is('dpk/rfk*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-money-bill"></i> RFK</a>
                        </li>

                        @if (Auth::user()->dpk->bidang == 'KEBENDAHARAAN / KEUANGAN')
                        <li class="nav-item">
                            <a href="/dpk/aset" class="nav-link {{request()->is('dpk/aset*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-cubes"></i> ASET</a>
                        </li>
                        <li class="nav-item">
                            <a href="/dpk/keuangan" class="nav-link {{request()->is('dpk/keuangan*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-money-bill"></i> KEUANGAN</a>
                        </li>
                        @endif
                        @if (Auth::user()->dpk->bidang == 'KESEKRETARIATAN')
                        <li class="nav-item">
                            <a href="/dpk/surat-masuk"
                                class="nav-link {{request()->is('dpk/surat-masuk*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-envelope"></i> SURAT MASUK</a>
                        </li>
                        <li class="nav-item">
                            <a href="/dpk/surat-keluar"
                                class="nav-link {{request()->is('dpk/surat-keluar*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-envelope"></i> SURAT KELUAR</a>
                        </li>
                        <li class="nav-item">
                            <a href="/dpk/anggota" class="nav-link {{request()->is('dpk/anggota*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-users"></i> ANGGOTA</a>
                        </li>
                        @endif
                        @endif

                        @if (Auth::user()->roles == 'dpd')
                        <li class="nav-item" style="">
                            <a href="/dpd" class="nav-link {{request()->is('dpd') ? 'active':''}}"
                                style="color: white"><i class="fa fa-home"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="/dpd/rfk" class="nav-link {{request()->is('dpd/rfk*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-money-bill"></i> RFK</a>
                        </li>
                        @if (Auth::user()->dpd->bidang == 'KEBENDAHARAAN / KEUANGAN')
                        <li class="nav-item">
                            <a href="/dpd/aset" class="nav-link {{request()->is('dpd/aset*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-cubes"></i> ASET</a>
                        </li>
                        <li class="nav-item">
                            <a href="/dpd/keuangan" class="nav-link {{request()->is('dpd/keuangan*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-money-bill"></i> KEUANGAN</a>
                        </li>
                        @endif
                        @if (Auth::user()->dpd->bidang == 'KESEKRETARIATAN')
                        <li class="nav-item">
                            <a href="/dpd/surat-masuk"
                                class="nav-link {{request()->is('dpd/surat-masuk*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-envelope"></i> SURAT MASUK</a>
                        </li>
                        <li class="nav-item">
                            <a href="/dpd/surat-keluar"
                                class="nav-link {{request()->is('dpd/surat-keluar*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-envelope"></i> SURAT KELUAR</a>
                        </li>
                        <li class="nav-item">
                            <a href="/dpd/anggota" class="nav-link {{request()->is('dpd/anggota*') ? 'active':''}}"
                                style="color: white"><i class="fa fa-users"></i> ANGGOTA</a>
                        </li>
                        @endif
                        @endif
                    </ul>


                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" style="color: silver" href="/logout" role="button"
                            onclick="return confirm('Yakin ingin keluar?');">
                            Logout <i class="fa fa-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            {{-- <div class="content-header">
                <div class="container">


                </div><!-- /.container-fluid -->
            </div> --}}
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                @yield('content')
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer text-center"
            style="box-shadow: inset 0px 1px 4px rgba(0,0,0,0.4); padding:0.2rem; font-size:12px; font-weight:bold">
            <!-- Default to the left -->
            Copyright © 2025 <span class="text-red">AsranDev</span><br>
            SIAP KALSEL V.1.0.0
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/dist/js/adminlte.min.js"></script>
    @stack('js')
    <script type="text/javascript">
        @include('layouts.notif')
    </script>
</body>

</html>