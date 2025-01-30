@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <a href="/dpw/surat-masuk" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>
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
                    <form method="post" action="/dpw/surat-masuk/edit/{{$data->id}}">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                name="tanggal" value="{{$data->tanggal}}">
                        </div>
                        <div class="form-group">
                            <label>Alamat Pengirim</label>
                            <input type="text" class="form-control" name="alamat_pengirim"
                                value="{{$data->alamat_pengirim}}">
                        </div>
                        <div class="form-group">
                            <label>No Surat</label>
                            <input type="text" class="form-control" name="nomor_surat" value="{{$data->nomor_surat}}">
                        </div>
                        <div class="form-group">
                            <label>Perihal</label>
                            <input type="text" class="form-control" name="perihal" value="{{$data->perihal}}">
                        </div>
                        <div class="form-group">
                            <label>diteruskan ke</label>
                            <input type="text" class="form-control" name="diteruskan_ke"
                                value="{{$data->diteruskan_ke}}">
                        </div>
                        <div class="form-group">
                            <label>Sifat</label>
                            <input type="text" class="form-control" name="sifat" value="{{$data->sifat}}">
                        </div>
                        <div class="form-group">
                            <label>isi disposisi</label>
                            <input type="text" class="form-control" name="isi" value="{{$data->isi}}">
                        </div>
                        <div class="form-group">
                            <label>Tgl Diterima Disposisi</label>
                            <input type="date" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                name="tanggal_diterima_disposisi" value="{{$data->tanggal_diterima_disposisi}}">
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