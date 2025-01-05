@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">SKPD</dt>
                    <dd class="col-sm-8">{{$data->skpd->nama}}</dd>
                    <dt class="col-sm-4">Tahun</dt>
                    <dd class="col-sm-8">{{$data->tahun}}</dd>
                    <dt class="col-sm-4">Nama</dt>
                    <dd class="col-sm-8">{{$data->nama}}</dd>
                    <dt class="col-sm-4">Jabatan</dt>
                    <dd class="col-sm-8">{{$data->jabatan}}</dd>
                </dl>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Semester</dt>
                    <dd class="col-sm-8">{{$data->semester}}</dd>
                    <dt class="col-sm-4">Triwulan</dt>
                    <dd class="col-sm-8">{{$data->triwulan}}</dd>
                    <dt class="col-sm-4">Bulan</dt>
                    <dd class="col-sm-8">{{$data->bulan}}</dd>
                </dl>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <div class="col-md-12">
        <h2>Revisi DPA</h2>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table class="table table-sm" style="border: 1px solid black; text-align:center">
                    <thead>
                        <tr style="font-size:12px" class="bg-warning" style="border: 1px solid black">
                            <th style="border: 1px solid black" rowspan="2">No</th>
                            <th style="border: 1px solid black">Tanggal Nota Dinas Pergeseran DPA oleh SKPD*</th>
                            <th style="border: 1px solid black">Tanggal Pengesahan oleh BPKPAD*</th>
                            <th style="border: 1px solid black">Revisi Ke</th>
                            <th style="border: 1px solid black">Jenis Revisi</th>
                            <th style="border: 1px solid black">Pagu Awal</th>
                            <th style="border: 1px solid black">Pagu Akhir</th>
                            <th style="border: 1px solid black">Perubahan Pagu</th>
                            <th style="border: 1px solid black">Termasuk Objek Perhitungan</th>
                            <th style="border: 1px solid black" rowspan="2" colspan="2"></th>
                        </tr>
                        <tr style="font-size:10px" class="bg-warning" style="border: 1px solid black">
                            <th style="border: 1px solid black">semester {{$data->semester}}</th>
                            <th style="border: 1px solid black">(a)</th>
                            <th style="border: 1px solid black">(b)</th>
                            <th style="border: 1px solid black">(c)</th>
                            <th style="border: 1px solid black">(d)</th>
                            <th style="border: 1px solid black">(e)</th>
                            <th style="border: 1px solid black">(f)</th>
                            <th style="border: 1px solid black">(g)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($revisi as $key => $item)
                        @if ($revisi_id == $item->id)
                        <form method="post" action="/superadmin/ikpa/revisi/{{$data->id}}/edit/{{$revisi_id}}">
                            @csrf
                            <tr style="background-color: rgb(234, 233, 231); font-size:12px">
                                <td style="border: 1px solid black">{{$key + 1}}</td>
                                <td style="border: 1px solid black">
                                    <input type="date" name="tanggal_nodin" value="{{$item->tanggal_nodin}}">
                                </td>
                                <td style="border: 1px solid black">
                                    <input type="date" name="tanggal_pengesahan" value="{{$item->tanggal_pengesahan}}">
                                </td>
                                <td style="border: 1px solid black">
                                    <input type="text" name="revisi_ke" value="{{$item->revisi_ke}}" required>
                                </td>
                                <td style="border: 1px solid black">
                                    <input type="text" name="jenis_revisi" value="{{$item->jenis_revisi}}" required>
                                </td>
                                <td style="border: 1px solid black; text-align:right">
                                    <input type="text" name="pagu_awal" value="{{$item->pagu_awal}}" required>
                                </td>
                                <td style="border: 1px solid black; text-align:right">
                                    <input type="text" name="pagu_akhir" value="{{$item->pagu_akhir}}" required>
                                </td>
                                <td style="border: 1px solid black;">{{$item->pp}}</td>
                                <td style="border: 1px solid black;">{{$item->top}}</td>
                                <td style="border: 1px solid black;" colspan="2">
                                    <button type="submit" class="btn btn-primary btn-xs">
                                        update</button>
                                </td>
                            </tr>
                        </form>
                        @else

                        <tr style="background-color: rgb(234, 233, 231); font-size:12px">
                            <td style="border: 1px solid black">{{$key + 1}}</td>
                            <td style="border: 1px solid black">
                                {{\Carbon\Carbon::parse($item->tanggal_nodin)->translatedFormat('d F Y')}}
                            </td>
                            <td style="border: 1px solid black">
                                {{\Carbon\Carbon::parse($item->tanggal_pengesahan)->translatedFormat('d F Y')}}
                            </td>
                            <td style="border: 1px solid black">{{$item->revisi_ke}}</td>
                            <td style="border: 1px solid black">{{$item->jenis_revisi}}</td>
                            <td style="border: 1px solid black; text-align:right">
                                {{number_format($item->pagu_awal)}}
                            </td>
                            <td style="border: 1px solid black; text-align:right">
                                {{number_format($item->pagu_akhir)}}
                            </td>
                            <td style="border: 1px solid black;">{{$item->pp}}</td>
                            <td style="border: 1px solid black;">{{$item->top}}</td>
                            <td style="border: 1px solid black;">
                                <a href="/superadmin/ikpa/revisi/{{$data->id}}/edit/{{$item->id}}"><i
                                        class="fa fa-edit"></i></a>
                            </td>

                            <td style="border: 1px solid black;">
                                <a href="/superadmin/ikpa/revisi/{{$data->id}}/delete/{{$item->id}}"
                                    onclick="return confirm('Yakin ingin dihapus?');" class="text-danger"><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <form method="post" action="/superadmin/ikpa/revisi/{{$data->id}}">
                                @csrf
                                <td style="border: 1px solid black"></td>
                                <td style="border: 1px solid black">
                                    <input type="date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                        name="tanggal_nodin">
                                </td>
                                <td style="border: 1px solid black">
                                    <input type="date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                                        name="tanggal_pengesahan">
                                </td>
                                <td style="border: 1px solid black">
                                    <input type="text" name="revisi_ke" required>
                                </td>
                                <td style="border: 1px solid black">
                                    <input type="text" name="jenis_revisi" required>
                                </td>
                                <td style="border: 1px solid black">
                                    <input type="text" name="pagu_awal" required
                                        onkeypress="return hanyaAngka(event)" />
                                </td>
                                <td style="border: 1px solid black">
                                    <input type="text" name="pagu_akhir" required
                                        onkeypress="return hanyaAngka(event)" />
                                </td>
                                <td style="border: 1px solid black" colspan="3">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>
                                        save / enter</button>
                                </td>

                            </form>
                        </tr>
                    </tfoot>
                </table>
                <br /><br />
                <table class="table table-sm" style="border: 1px solid black; text-align:center">
                    <thead>
                        <tr style="font-size:12px" class="bg-warning" style="border: 1px solid black">
                            <th style="border: 1px solid black">Jumlah Revisi</th>
                            <th style="border: 1px solid black">NKRA Semester {{$data->semester}}</th>
                            <th style="border: 1px solid black">NKRA Tahunan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color: rgb(234, 233, 231); font-size:12px">
                            <td style="border: 1px solid black">{{$jml_revisi}}</td>
                            <td style="border: 1px solid black">{{$nkra_semester}}</td>
                            <td style="border: 1px solid black">{{$nkra_tahunan}}</td>
                        </tr>
                    </tbody>
                </table>
                <br />
                <table class="table table-sm" style="border: 1px solid black; text-align:center">
                    <thead>
                        <tr style="font-size:12px" class="bg-warning" style="border: 1px solid black">
                            <th style="border: 1px solid black">Indikator</th>
                            <th style="border: 1px solid black">Skor</th>
                            <th style="border: 1px solid black">Bobot</th>
                            <th style="border: 1px solid black">Skor Indikator Tertimbang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color: rgb(234, 233, 231); font-size:12px">
                            <td style="border: 1px solid black">Revisi DPA</td>
                            <td style="border: 1px solid black">{{$skor}}</td>
                            <td style="border: 1px solid black">{{$bobot_revisi * 100}} %</td>
                            <td style="border: 1px solid black">{{$sit}}</td>
                        </tr>
                    </tbody>
                </table>
                <br />
            </div>
        </div>
    </div>
</div>
@endsection