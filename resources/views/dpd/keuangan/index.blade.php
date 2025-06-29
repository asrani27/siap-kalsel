@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <div class="row">
                <div class="col-md-9 col-sm-6 col-12">
                    <form method="get" action="/dpd/keuangan/laporan" target="_blank">
                        @csrf
                        <input type="date" name="mulai" value="{{\carbon\carbon::now()->format('Y-m-d')}}">
                        <input type="date" name="sampai" value="{{\carbon\carbon::now()->format('Y-m-d')}}">
                        <button type="submit" class="btn btn-sm btn-secondary">Laporan</button>
                    </form>
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12 text-right">
                    <a href="/dpk/keuangan/create" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i>
                        keuangan</a>
                </div>

            </div>
            <br />
            <div class="card">
                <div class="card-header" style="cursor: move;">

                    <h3 class="card-title">
                        <i class="fa fa-list"></i>
                        Jurnal keuangan
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
                                <th style="border:1px solid black">COA</th>
                                <th style="border:1px solid black">Deksripsi</th>
                                <th style="border:1px solid black">Penerimaan</th>
                                <th style="border:1px solid black">Pengeluaran</th>
                                <th style="border:1px solid black">Pajak</th>
                                <th style="border:1px solid black">Saldo</th>
                                <th style="border:1px solid black">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            <tr>
                                <td>{{$data->firstItem() + $key}}</td>
                                <td>{{\Carbon\Carbon::parse($item->created_at)->format('d M Y H:i:s')}}</td>
                                <td>{{$item->coa}} - {{$item->coa_name}}</td>
                                <td>{{$item->keterangan}}</td>
                                <td style="text-align: right">{{number_format($item->masuk)}}</td>
                                <td style="text-align: right">{{number_format($item->keluar)}}</td>
                                <td style="text-align: right">
                                    @if ($item->pajak == null)

                                    @else
                                    PPH {{$item->pajak}} - Rp. {{number_format($item->nilai_pajak)}}
                                    @endif
                                </td>
                                <td style="text-align: right">{{number_format($item->saldo)}}</td>
                                <td>

                                    <a href="/dpd/keuangan/edit/{{$item->id}}" class="btn btn-xs btn-success text-bold">
                                        EDIT
                                    </a>
                                    <a href="/dpd/keuangan/delete/{{$item->id}}" class="btn btn-xs btn-danger text-bold"
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