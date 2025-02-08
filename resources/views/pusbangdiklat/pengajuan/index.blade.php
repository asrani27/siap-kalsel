@extends('layouts.userapp')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header" style="cursor: move;">

                    <h3 class="card-title">
                        <i class="fa fa-list"></i>
                        Data Pengajuan
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
                            <tr style="border:1px solid black; font-size:14px; text-align:center" class="bg-danger">
                                <th style="border:1px solid black">No</th>
                                <th style="border:1px solid black">Tanggal</th>
                                <th style="border:1px solid black">Kategori</th>
                                <th style="border:1px solid black">Pemohon</th>
                                <th style="border:1px solid black">Nama Instansi</th>
                                <th style="border:1px solid black">Alamat Instansi</th>
                                <th style="border:1px solid black">Telp Instansi</th>
                                <th style="border:1px solid black">Status</th>
                                <th style="border:1px solid black">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            <tr>
                                <td>{{$data->firstItem() + $key}}</td>
                                <td>{{\Carbon\Carbon::parse($item->tanggal_lahir)->format('d M
                                    Y')}}</td>
                                <td>{{$item->kategori}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->instansi}}</td>
                                <td>{{$item->alamat}}, </td>
                                <td>{{$item->telp}}</td>
                                <td style="text-align: center"><span class="badge badge-success">BARU</span></td>
                                <td style="text-align: center">
                                    <a href="/pusbangdiklat/pengajuan/verifikasi/{{$item->id}}"
                                        class="btn btn-xs btn-primary text-bold">
                                        PROSES VERIFIKASI
                                    </a>

                                    <a href="/pusbangdiklat/pengajuan/delete/{{$item->id}}"
                                        class="btn btn-xs btn-danger text-bold"
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