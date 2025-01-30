@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <a href="/dpw/surat-keluar/create" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Surat
                keluar</a><br /><br />
            <div class="card">
                <div class="card-header" style="cursor: move;">

                    <h3 class="card-title">
                        <i class="fa fa-list"></i>
                        Data Surat keluar
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
                                <th style="border:1px solid black">Alamat Penerima</th>
                                <th style="border:1px solid black">Nomor Surat</th>
                                <th style="border:1px solid black">Kode</th>
                                <th style="border:1px solid black">Bidang</th>
                                <th style="border:1px solid black">Perihal</th>
                                <th style="border:1px solid black">Tindak Lanjut</th>
                                <th style="border:1px solid black">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            <tr>
                                <td>{{$data->firstItem() + $key}}</td>
                                <td>{{\Carbon\Carbon::parse($item->tanggal)->format('d M Y')}}</td>
                                <td>{{$item->alamat_penerima}}</td>
                                <td>{{$item->nomor_surat}}</td>
                                <td>{{$item->kode}}</td>
                                <td>{{$item->bidang}}</td>
                                <td>{{$item->perihal}}</td>
                                <td>{{$item->tindak_lanjut}}</td>
                                <td>

                                    <a href="/dpw/surat-keluar/edit/{{$item->id}}"
                                        class="btn btn-xs btn-success text-bold"> EDIT
                                    </a>
                                    <a href="/dpw/surat-keluar/delete/{{$item->id}}"
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