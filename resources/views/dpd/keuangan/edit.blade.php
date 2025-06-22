@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <a href="/dpd/keuangan" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>
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
                    <form method="post" action="/dpd/keuangan/edit/{{$data->id}}">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="text" class="form-control" name="" value="{{$data->created_at}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Kode Akun</label>
                            <select class="form-control" name="coa">
                                @foreach (coa() as $item)
                                <option value="{{$item->kode}}" {{$data->coa == $item->kode ?
                                    'selected':''}}>{{$item->kode}} - {{$item->nama}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Uraian</label>
                            <input type="text" class="form-control" name="keterangan" value="{{$data->keterangan}}" />
                        </div>
                        <div class="form-group">
                            <label>Pemasukan</label>
                            <input type="text" class="form-control" name="masuk" value="{{$data->masuk}}" onkeypress="
                                return hanyaAngka(event)">
                        </div>
                        <div class="form-group">
                            <label>Pengeluaran</label>
                            <input type="text" class="form-control" name="keluar" value="{{$data->keluar}}" onkeypress="
                                return hanyaAngka(event)">
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