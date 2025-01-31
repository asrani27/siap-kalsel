@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <br />
            <h1 style="">Selamat Datang, {{Auth::user()->name}}</h1><br />
            <img src="/logo/321.png" class="img-fluid" width="10%"><br /><br />

            <div class="card">
                <div class="card-header" style="cursor: move;">

                    <h3 class="card-title">
                        <i class="fa fa-list"></i>
                        Main Navigation
                    </h3>
                    <!-- tools card -->
                    <div class="card-tools">

                    </div>
                    <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <p>Silahkan pilih menu di bawah ini untuk mengelola konten anda</p>
                    <a href="/dpd/rfk" class="btn btn-app" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fa fa-money-bill"></i> <strong>RFK</strong>
                    </a>
                    @if(Auth::user()->dpd->bidang == 'KESEKRETARIATAN')
                    <a href="/dpd/surat-masuk" class="btn btn-app" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fa fa-envelope"></i> <strong>SURAT MASUK</strong>
                    </a>
                    <a href="/dpd/surat-keluar" class="btn btn-app" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fa fa-envelope"></i> <strong>SURAT KELUAR</strong>
                    </a>
                    <a href="/dpd/anggota" class="btn btn-app" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fa fa-envelope"></i> <strong>ANGGOTA PPNI</strong>
                    </a>
                    @endif
                    @if(Auth::user()->dpd->bidang == 'KEBENDAHARAAN / KEUANGAN')
                    <a href="/dpd/aset" class="btn btn-app" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fa fa-envelope"></i> <strong>ASET</strong>
                    </a>
                    <a href="/dpd/keuangan" class="btn btn-app" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fa fa-money-o"></i> <strong>JURNAL KEUANGAN</strong>
                    </a>
                    @endif

                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')

@endpush