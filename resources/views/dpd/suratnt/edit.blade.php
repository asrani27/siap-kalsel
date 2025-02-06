@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <a href="/dpd/surat-nt" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>
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
                    <form method="post" action="/dpd/surat-nt/edit/{{$data->id}}">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                name="tanggal" value="{{$data->tanggal}}">
                        </div>
                        <div class="form-group">
                            <label>Jenis Surat</label>
                            <select class="form-control" name="jenis" required>
                                <option value="">-pilih-</option>
                                <option value="NODIN" {{$data->jenis == 'NODIN' ? 'selected':''}}>NODIN</option>
                                <option value="TELAAHAN" {{$data->jenis == 'TELAAHAN' ? 'selected':''}}>TELAAHAN
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dari</label>
                            <input type="text" class="form-control" name="dari" value="{{$data->dari}}">
                        </div>
                        <div class="form-group">
                            <label>Nomor</label>
                            <input type="text" class="form-control" name="nomor" value="{{$data->nomor}}">
                        </div>
                        <div class="form-group">
                            <label>Perihal</label>
                            <input type="text" class="form-control" name="perihal" value="{{$data->perihal}}">
                        </div>
                        <div class="form-group">
                            <label>Isi</label>
                            <input type="text" class="form-control" name="isi" value="{{$data->isi}}">
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