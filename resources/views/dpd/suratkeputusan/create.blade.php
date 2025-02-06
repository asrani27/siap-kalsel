@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <a href="/dpd/surat-keputusan" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>
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
                    <form method="post" action="/dpd/surat-keputusan/create">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                name="tanggal">
                        </div>
                        <div class="form-group">
                            <label>Kode Bidang</label>
                            <input type="text" class="form-control" name="kode_bidang" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Bidang</label>
                            <select class="form-control" name="nama_bidang" required>
                                @foreach (bidang() as $item)
                                <option value="{{$item->nama}}" {{Auth::user()->dpd->bidang == $item->nama ?
                                    'selected':''}}>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nomor SK</label>
                            <input type="text" class="form-control" name="nomor_sk" required>
                        </div>
                        <div class="form-group">
                            <label>Perihal</label>
                            <input type="text" class="form-control" name="perihal" required>
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