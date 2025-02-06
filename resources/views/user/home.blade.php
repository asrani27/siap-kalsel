@extends('layouts.userapp')

@section('content')
<div class="col-md-12">
    <div class="card bg-gradient-danger">
        <div class="card-header">
            <h3 class="card-title">Aplikasi SIAP KALSEL</h3>
        </div>
        <div class="card-body">
            <h4>Hi, {{Auth::user()->name}}. Selamat Datang di aplikasi PPNI, anda bisa mengajukan permohonan webinar,
                pelatihan dan workshop dengan mengklik menu "pengajuan" di samping</h4>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection