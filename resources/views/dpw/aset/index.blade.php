@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <a href="/dpw/aset/create" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i>
                aset</a><br /><br />
            <div class="card">
                <div class="card-header" style="cursor: move;">

                    <h3 class="card-title">
                        <i class="fa fa-list"></i>
                        Data aset
                    </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 220px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Cari">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table class="table table-hover table-bordered table-sm text-nowrap">
                        <thead>
                            <tr style="border:1px solid black; font-size:14px" class="bg-primary">
                                <th style="border:1px solid black">No</th>
                                <th style="border:1px solid black">Nama barang</th>
                                <th style="border:1px solid black">Jumlah</th>
                                <th style="border:1px solid black">Identitas</th>
                                <th style="border:1px solid black">Asal Usul</th>
                                <th style="border:1px solid black">Tahun Perolehan</th>
                                <th style="border:1px solid black">Harga</th>
                                <th style="border:1px solid black">Kondisi B/KB/RB</th>
                                <th style="border:1px solid black">Penyusutan</th>
                                <th style="border:1px solid black">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            <tr>
                                <td>{{$data->firstItem() + $key}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->jumlah}}</td>
                                <td>{{$item->identitas}}</td>
                                <td>{{$item->asal}}</td>
                                <td>{{$item->tahun}}</td>
                                <td>{{number_format($item->harga)}}</td>
                                <td>{{$item->kondisi}}</td>
                                <td>{{$item->penyusutan}}</td>
                                <td>

                                    <a href="/dpw/aset/edit/{{$item->id}}" class="btn btn-xs btn-success text-bold">
                                        EDIT
                                    </a>
                                    <a href="/dpw/aset/delete/{{$item->id}}" class="btn btn-xs btn-danger text-bold"
                                        onclick="return confirm('Yakin ingin dihapus?');">
                                        HAPUS
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            {{$data->links()}}
        </div>
    </div>
</div>
@endsection
@push('js')

@endpush