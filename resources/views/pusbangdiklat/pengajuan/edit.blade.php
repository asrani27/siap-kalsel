@extends('layouts.userapp')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <a href="/user/pengajuan" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>
                Kembali
            </a><br /><br />
            <div class="card">
                <div class="card-header" style="cursor: move;">

                    <h3 class="card-title">
                        <i class="fa fa-list"></i>
                        Tambah Data
                    </h3>
                    <div class="card-tools">

                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" action="/user/pengajuan/edit/{{$data->id}}">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                name="tanggal_lahir" value="{{$data->tanggal_lahir}}">
                        </div>
                        <div class="form-group">
                            <label>Tanggal pengajuan</label>
                            <input type="date" class="form-control" value="{{$data->tanggal}}" name="tanggal">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="kategori" required>
                                <option value=''>-pilih-</option>
                                <option value='WEBINAR' {{$data->kategori == 'WEBINAR' ? 'selected':''}}>WEBINAR
                                </option>
                                <option value='PELATIHAN' {{$data->kategori == 'PELATIHAN' ? 'selected':''}}>PELATIHAN
                                </option>
                                <option value='WORKSHOP' {{$data->kategori == 'WORKSHOP' ? 'selected':''}}>WORKSHOP
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Pemohon</label>
                            <input type="text" class="form-control" name="nama" value="{{$data->nama}}">
                        </div>
                        <div class="form-group">
                            <label>NIK Pemohon</label>
                            <input type="text" class="form-control" name="nik" value="{{$data->nik}}">
                        </div>
                        <div class="form-group">
                            <label>Instansi</label>
                            <input type="text" class="form-control" name="instansi" value="{{$data->instansi}}">
                        </div>
                        <div class="form-group">
                            <label>Alamat Instansi</label>
                            <input type="text" class="form-control" name="alamat" value="{{$data->alamat}}">
                        </div>
                        <div class="form-group">
                            <label>Telp Instansi</label>
                            <input type="text" class="form-control" name="telp" value="{{$data->telp}}">
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> UPDATE</button>

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