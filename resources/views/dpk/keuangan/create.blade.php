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
            <a href="/dpk/keuangan" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>
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
                    <form method="post" action="/dpk/keuangan/create">
                        @csrf
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="created_at"
                                value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                        </div>
                        <div class="form-group">
                            <label>Kode Akun</label>
                            <select class="form-control select2" name="coa">
                                @foreach (coa() as $item)
                                <option value="{{$item->kode}}">{{$item->kode}} - {{$item->nama}}</option>
                                @endforeach
                            </select>
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
                        <div class="form-group">
                            <label>Pajak</label>
                            <select class="form-control select2" name="pajak">
                                <option value="">-</option>
                                <option value="21">PPH 21</option>
                                <option value="23">PPH 23</option>
                                <option value="25">PPH 25</option>
                            </select>
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

<script src="/assets/plugins/select2/js/select2.full.min.js"></script>
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
      return true;
    }
</script>

<script>
    $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  });
</script>
@endpush