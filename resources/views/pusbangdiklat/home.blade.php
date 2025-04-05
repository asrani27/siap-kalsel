@extends('layouts.userapp')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card bg-gradient-danger">
            <div class="card-header">
                <h3 class="card-title">Aplikasi SIAP KALSEL</h3>
            </div>
            <div class="card-body">
                <h4>Hi, {{Auth::user()->name}}, Selamat Datang di aplikasi PPNI</h4>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{baru()}}</h3>

                <p>PENGAJUAN BARU</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="/pusbangdiklat/pengajuan/baru" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{diproses()}}</h3>

                <p>PENGAJUAN DI PROSES</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="/pusbangdiklat/pengajuan/diproses" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{selesai()}}</h3>

                <p>PENGAJUAN SELESAI</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/pusbangdiklat/pengajuan/selesai" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
@endsection