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
    <style>
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
        <nav class="main-header navbar navbar-expand-md navbar-light bg-gray bg-gray-dark" style="padding:0px">
            <div class="container-fluid p-0">
                <a href="#" class="navbar-brand p-0 d-flex align-items-center">
                    <img src="/logo/rfk.png" alt="Logo">
                </a>

                <button class="navbar-toggler order-1 ml-auto ml-md-0" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="background-color: white"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav ml-md-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="color: silver; padding-left:1rem">Masuk</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-image: url('/logo/bg.jpg'); background-size:cover">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">


                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body"
                                    style="background-image: url('/logo/ilus.jpeg'); height:20rem; background-size:cover">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="card">

                                <form action='login' method="POST" class="form-horizontal">
                                    @csrf
                                    <div class="card-body">
                                        <h2 class="text-center"><u>LOGIN APLIKASI RFK</u></h2><br />
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username"
                                                placeholder="username">
                                            @error('username')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="password">
                                            @error('password')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-block">MASUK</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
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
        <footer class="main-footer bg-gray bg-gray-dark text-center">
            <strong style="font-size:0.9rem; padding:0;">Sistem Informasi Realisasi Fisik Dan Keuangan</strong><br />
            <strong style="font-size:0.9rem; padding:0;">Developed By 2025</strong>
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
    <script type="text/javascript">
        @include('layouts.notif')
    </script>
</body>

</html>