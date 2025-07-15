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
                    <form method="post" action="/dpw/aset/create">
                        @csrf
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" name="nama">
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="text" class="form-control" name="jumlah"
                                onkeypress="return hanyaAngka(event)" />
                        </div>
                        <div class="form-group">
                            <label>Identitas</label>
                            <input type="text" class="form-control" name="identitas">
                        </div>
                        <div class="form-group">
                            <label>Asal Usul</label>
                            <select class="form-control" name="asal" required>
                                <option value="Iuran Anggota">Iuran Anggota</option>
                                <option value="Hibah">Hibah</option>
                                <option value="Badan Usaha">Badan Usaha</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>tahun</label>
                            <input type="text" class="form-control" name="tahun"
                                onkeypress="return hanyaAngka(event)" />
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" class="form-control" name="harga"
                                onkeypress="return hanyaAngka(event)" />
                        </div>
                        <div class="form-group">
                            <label>Kondisi</label>
                            <select class="form-control" name="kondisi" required>
                                <option value="B">B</option>
                                <option value="KB">KB</option>
                                <option value="RB">RB</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Penyusutan</label>
                            <input type="text" class="form-control" name="penyusutan">
                        </div>
                        <div class="form-group">
                            <label>keterangan</label>
                            <input type="text" class="form-control" name="keterangan">
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