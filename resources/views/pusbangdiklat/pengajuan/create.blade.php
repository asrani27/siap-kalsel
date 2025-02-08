@extends('layouts.userapp')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="/user/pengajuan" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>
                Kembali
            </a><br /><br />
            <div class="card">
                <div class="card-header" style="cursor: move;">

                    <h3 class="card-title">
                        <i class="fa fa-list"></i>
                        Isi Formulir Pengajuan Online
                    </h3>
                    <div class="card-tools">

                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" action="/user/pengajuan/create">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal pengajuan</label>
                            <input type="date" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                name="tanggal">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="kategori" required>
                                <option value=''>-pilih-</option>
                                <option value='WEBINAR'>WEBINAR</option>
                                <option value='PELATIHAN'>PELATIHAN</option>
                                <option value='WORKSHOP'>WORKSHOP</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Pemohon</label>
                            <input type="text" class="form-control" name="nama" value="{{Auth::user()->name}}">
                        </div>
                        <div class="form-group">
                            <label>NIK Pemohon</label>
                            <input type="text" class="form-control" name="nik" value="{{Auth::user()->username}}">
                        </div>
                        <div class="form-group">
                            <label>Instansi</label>
                            <input type="text" class="form-control" name="instansi">
                        </div>
                        <div class="form-group">
                            <label>Alamat Instansi</label>
                            <input type="text" class="form-control" name="alamat">
                        </div>
                        <div class="form-group">
                            <label>Telp Instansi</label>
                            <input type="text" class="form-control" name="telp">
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> SIMPAN</button>

                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')

@endpush