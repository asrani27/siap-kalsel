@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <a href="/dpk/surat-masuk/create" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Surat
                Masuk</a><br /><br />
            <div class="card">
                <div class="card-header" style="cursor: move;">

                    <h3 class="card-title">
                        <i class="fa fa-list"></i>
                        Data Surat Masuk
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
                                <th style="border:1px solid black">Tanggal</th>
                                <th style="border:1px solid black">Alamat Pengirim</th>
                                <th style="border:1px solid black">Nomor Surat</th>
                                <th style="border:1px solid black">Perihal</th>
                                <th style="border:1px solid black">Diteruskan Ke</th>
                                <th style="border:1px solid black">Isi Disposisi</th>
                                <th style="border:1px solid black">Sifat</th>
                                <th style="border:1px solid black">Tgl Diterima Disposisi</th>
                                <th style="border:1px solid black">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            <tr>
                                <td>{{$data->firstItem() + $key}}</td>
                                <td>{{\Carbon\Carbon::parse($item->tanggal)->format('d M Y')}}</td>
                                <td>{{$item->alamat_pengirim}}</td>
                                <td>{{$item->nomor_surat}}</td>
                                <td>{{$item->perihal}}</td>
                                <td>{{$item->diteruskan_ke}}</td>
                                <td>{{$item->isi}}</td>
                                <td>{{$item->sifat}}</td>
                                <td>{{\Carbon\Carbon::parse($item->tanggal_diterima_disposisi)->format('d M Y')}}</td>
                                <td>

                                    <a href="/dpk/surat-masuk/edit/{{$item->id}}"
                                        class="btn btn-xs btn-success text-bold"> EDIT
                                    </a>
                                    <a href="/dpk/surat-masuk/delete/{{$item->id}}"
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