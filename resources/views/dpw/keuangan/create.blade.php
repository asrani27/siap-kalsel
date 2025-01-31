@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <a href="/dpw/keuangan" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>
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
                    <form method="post" action="/dpw/keuangan/create">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="text" class="form-control" name="nama"
                                value="{{\Carbon\Carbon::now()->format('d M Y H:i:s')}}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Uraian</label>
                            <input type="text" class="form-control" name="keterangan" />
                        </div>
                        <div class="form-group">
                            <label>Pemasukan</label>
                            <input type="text" class="form-control" name="masuk" onkeypress="return hanyaAngka(event)">
                        </div>
                        <div class="form-group">
                            <label>Pengeluaran</label>
                            <input type="text" class="form-control" name="keluar" onkeypress="return hanyaAngka(event)">
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
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>
@endpush