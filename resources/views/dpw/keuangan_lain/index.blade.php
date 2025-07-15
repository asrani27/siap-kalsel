@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <form method="get" action="/dpw/keuangan_lain/get">
                @csrf
                <div class="form-group">
                    <select id="kota" class="form-control" name="kota" onchange="getDPK()">
                        <option value="">Pilih Kota</option>
                        @foreach($kota as $ko)
                        <option value="{{ $ko->nama }}" {{ request('kota')==$ko->nama ? 'selected' : '' }}>
                            {{ $ko->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select id="dpk" name="dpd" class="form-control" required>
                        <option value="">Pilih</option>
                    </select>
                </div>
                <div class="form-group">
                    Mulai <input type="date" name="mulai" value="{{old('mulai')}}" required>
                    S/D <input type="date" name="sampai" value="{{old('sampai')}}" required>
                </div>
                <button type="submit" name="button" value="tampilkan" class="btn btn-sm btn-primary">Tampilkan
                    Data</button>
                <button type="submit" name="button" value="pdf" class="btn btn-sm btn-danger">PDF</button>
            </form>
            <br />
            {{-- <div class="row">
                <div class="col-md-9 col-sm-6 col-12">
                    <form method="get" action="/dpw/keuangan/laporan" target="_blank">
                        @csrf
                        <input type="date" name="mulai" value="{{\carbon\carbon::now()->format('Y-m-d')}}">
                        <input type="date" name="sampai" value="{{\carbon\carbon::now()->format('Y-m-d')}}">
                        <button type="submit" class="btn btn-sm btn-secondary">Laporan</button>
                    </form>
                </div>
                <div class="col-md-3 col-sm-6 col-12 text-right">

                </div>

            </div>
            <br /> --}}
            <div class="card">
                <div class="card-header" style="cursor: move;">

                    <h3 class="card-title">
                        <i class="fa fa-list"></i>
                        Jurnal keuangan
                    </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 220px;">

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
                                <th style="border:1px solid black">Deskripsi</th>
                                <th style="border:1px solid black">Penerimaan</th>
                                <th style="border:1px solid black">Pengeluaran</th>
                                <th style="border:1px solid black">Pajak</th>
                                <th style="border:1px solid black">Saldo</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if ($data != null)
                            @foreach ($data as $key => $item)
                            <tr>
                                <td>{{1 + $key}}</td>
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

                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')

<script>
    function getDPK() {
        var kota_id = $('#kota').val();

        if (kota_id) {
            $.ajax({
                url: '/get-dpk/' + kota_id,
                type: 'GET',
                success: function(response) {
                    $('#dpk').empty();
                    $('#dpk').append('<option value="">-Pilih-</option>');

                    const selectedDPD = "{{ request('dpd') }}" === "DPD" ? 'selected' : '';
                    $('#dpk').append('<option value="DPD" ' + selectedDPD + '>DPD</option>');

                    $.each(response, function(key, dpk) {
                        const selected = dpk.nama === "{{ request('dpd') }}" ? 'selected' : '';
                        $('#dpk').append('<option value="' + dpk.nama + '" ' + selected + '>' + dpk.nama + '</option>');
                    });
                }
            });
        } else {
            $('#dpk').empty();
            $('#dpk').append('<option value="">Pilih</option>');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Panggil fungsi ini saat pertama kali halaman dimuat agar dpd tetap muncul
        getDPK();
    });
</script>
@endpush