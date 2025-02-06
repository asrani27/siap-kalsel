@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <a href="/dpd/surat-nt/create" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Surat
                Nodin/Telaahan</a><br /><br />
            <div class="card">
                <div class="card-header" style="cursor: move;">

                    <h3 class="card-title">
                        <i class="fa fa-list"></i>
                        Data Surat Nodin/Telaahan
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
                                <th style="border:1px solid black">Jenis</th>
                                <th style="border:1px solid black">Dari</th>
                                <th style="border:1px solid black">nomor</th>
                                <th style="border:1px solid black">Perihal</th>
                                <th style="border:1px solid black">Isi</th>
                                <th style="border:1px solid black">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            <tr>
                                <td>{{$data->firstItem() + $key}}</td>
                                <td>{{\Carbon\Carbon::parse($item->tanggal)->format('d M Y')}}</td>
                                <td>{{$item->jenis}}</td>
                                <td>{{$item->dari}}</td>
                                <td>{{$item->nomor}}</td>
                                <td>{{$item->perihal}}</td>
                                <td>{{$item->isi}}</td>
                                <td>

                                    <a href="/dpd/surat-nt/edit/{{$item->id}}" class="btn btn-xs btn-success text-bold">
                                        EDIT
                                    </a>
                                    <a href="/dpd/surat-nt/delete/{{$item->id}}" class="btn btn-xs btn-danger text-bold"
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