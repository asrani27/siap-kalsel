@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <a href="/dpd/surat-keluar" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>
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
                    <form method="post" action="/dpd/surat-keluar/create">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                name="tanggal">
                        </div>
                        <div class="form-group">
                            <label>Alamat Penerima</label>
                            <input type="text" class="form-control" name="alamat_penerima">
                        </div>
                        <div class="form-group">
                            <label>No Surat</label>
                            <input type="text" class="form-control" name="nomor_surat">
                        </div>
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" class="form-control" name="kode">
                        </div>
                        <div class="form-group">
                            <label>Bidang</label>
                            <input type="text" class="form-control" name="bidang">
                        </div>
                        <div class="form-group">
                            <label>Perihal</label>
                            <input type="text" class="form-control" name="perihal">
                        </div>
                        <div class="form-group">
                            <label>Tindak Lanjut</label>
                            <input type="text" class="form-control" name="tindak_lanjut">
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