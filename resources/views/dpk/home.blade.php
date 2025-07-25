@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <br />
            <h1 style="">Selamat Datang, {{Auth::user()->name}}</h1><br />
            <img src="/logo/ppni.png" class="img-fluid" width="10%"><br /><br />

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
                    <a href="/dpk/rfk" class="btn btn-app" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fa fa-money-bill"></i> <strong>RFK</strong>
                    </a>

                    @if(Auth::user()->dpk->bidang == 'KESEKRETARIATAN')
                    <a href="/dpk/surat-masuk" class="btn btn-app" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fa fa-envelope"></i> <strong>SURAT MASUK</strong>
                    </a>
                    <a href="/dpk/surat-keluar" class="btn btn-app" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fa fa-envelope"></i> <strong>SURAT KELUAR</strong>
                    </a>
                    <a href="/dpk/surat-keputusan" class="btn btn-app"
                        style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fa fa-envelope"></i> <strong>SURAT KEPUTUSAN</strong>
                    </a>
                    <a href="/dpk/surat-nt" class="btn btn-app" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fa fa-envelope"></i> <strong>NODIN/TELAAHAN</strong>
                    </a>
                    <a href="/dpk/anggota" class="btn btn-app" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fa fa-envelope"></i> <strong>ANGGOTA PPNI</strong>
                    </a>
                    @endif
                    @if(Auth::user()->dpk->bidang == 'KEBENDAHARAAN / KEUANGAN')
                    <a href="/dpk/aset" class="btn btn-app" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fa fa-cubes"></i> <strong>ASET</strong>
                    </a>
                    <a href="/dpk/keuangan" class="btn btn-app" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fa fa-chart-bar"></i> <strong>JURNAL KEUANGAN</strong>
                    </a>
                    <a href="/dpk/ketua" class="btn btn-app" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);">
                        <i class="fa fa-users"></i> <strong>Profil</strong>
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