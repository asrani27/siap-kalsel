@extends('layouts.userapp')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card bg-gradient-danger">
            <div class="card-header">
                <h3 class="card-title">Aplikasi SIAP KALSEL</h3>
            </div>
            <div class="card-body">
                <h4>Hi, {{Auth::user()->name}}. Selamat Datang di aplikasi PPNI, anda bisa mengajukan permohonan
                    webinar,
                    pelatihan dan workshop dengan mengklik menu "pengajuan" di samping</h4>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-4">
        <!-- Widget: user widget style 2 -->
        <div class="card card-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-success">
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="/logo/user.png" alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">{{Auth::user()->name}}</h3>
                <h5 class="widget-user-desc">Pemohon</h5>
            </div>
            <div class="card-footer p-0">
                {{-- <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="#" class="nav-link btn btn-sm btn-primary">
                            <i class="fa fa-user"></i> <strong>EDIT PROFILE </strong></a>
                    </li>

                </ul> --}}
            </div>

        </div>
        <!-- /.widget-user -->
    </div>
</div>
@endsection