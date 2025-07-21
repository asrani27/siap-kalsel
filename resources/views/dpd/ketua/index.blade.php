@extends('layouts.user')
@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <a href="/dpd" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>
                Kembali
            </a><br /><br />
            <div class="card">
                <div class="card-header" style="cursor: move;">

                    <h3 class="card-title">
                        <i class="fa fa-list"></i>
                        Profil
                    </h3>
                    <div class="card-tools">

                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post" action="/dpd/ketua">
                        @csrf

                        <div class="form-group">
                            <label>Nama Ketua</label>
                            <input type="text" class="form-control" name="nama_ketua" value="{{$data->nama_ketua}}" />
                        </div>
                        <div class="form-group">
                            <label>Nama Bendahara</label>
                            <input type="text" class="form-control" name="nama_bendahara"
                                value="{{$data->nama_bendahara}}" />
                        </div>
                        <div class="form-group">
                            <label>Nama DPD</label>
                            <input type="text" class="form-control" name="name" value="{{$data->name}}" />
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{$data->alamat}}" />
                        </div>
                        <div class="form-group">
                            <label>email</label>
                            <input type="text" class="form-control" name="email" value="{{$data->email}}" />
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