@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <a href="/dpw/aset" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>
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
                    <form method="post" action="/dpw/aset/edit/{{$data->id}}">
                        @csrf
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" name="nama" value="{{$data->nama}}">
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="text" class="form-control" name="jumlah" value="{{$data->jumlah}}"
                                onkeypress="return hanyaAngka(event)" />
                        </div>
                        <div class="form-group">
                            <label>Identitas</label>
                            <input type="text" class="form-control" name="identitas" value="{{$data->identitas}}">
                        </div>
                        <div class="form-group">
                            <label>Asal Usul</label>
                            <select class="form-control" name="asal" required>
                                <option value="Iuran aset" {{$data->asal == 'Iuran aset' ? 'selected':''}}>Iuran aset
                                </option>
                                <option value="Hibah" {{$data->asal == 'Hibah' ? 'selected':''}}>Hibah</option>
                                <option value="Badan Usaha" {{$data->asal == 'Badan Usaha' ? 'selected':''}}>Badan Usaha
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>tahun</label>
                            <input type="text" class="form-control" name="tahun" value="{{$data->tahun}}"
                                onkeypress="return hanyaAngka(event)" />
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" class="form-control" name="harga" value="{{$data->harga}}"
                                onkeypress="return hanyaAngka(event)" />
                        </div>
                        <div class="form-group">
                            <label>Kondisi</label>
                            <select class="form-control" name="kondisi" required>
                                <option value="B" {{$data->kondisi == 'B' ? 'selected':''}}>B</option>
                                <option value="KB" {{$data->kondisi == 'KB' ? 'selected':''}}>KB</option>
                                <option value="RB" {{$data->kondisi == 'RB' ? 'selected':''}}>RB</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Penyusutan</label>
                            <input type="text" class="form-control" name="penyusutan" value="{{$data->penyusutan}}">
                        </div>
                        <div class="form-group">
                            <label>keterangan</label>
                            <input type="text" class="form-control" name="keterangan" value="{{$data->keterangan}}">
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