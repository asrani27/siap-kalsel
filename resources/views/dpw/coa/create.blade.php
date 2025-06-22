@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <a href="/dpw/coa" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>
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
                    <form method="post" action="/dpw/coa/create">
                        @csrf
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" class="form-control" name="kode">
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama">
                        </div>
                        <div class="form-group">
                            <label>COA</label>
                            <input type="text" class="form-control" name="coa">
                        </div>
                        <div class="form-group">
                            <label>Penjelasan Umum</label>
                            <input type="text" class="form-control" name="umum">
                        </div>
                        <div class="form-group">
                            <label>Penjelasan Khusus</label>
                            <input type="text" class="form-control" name="khusus">
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