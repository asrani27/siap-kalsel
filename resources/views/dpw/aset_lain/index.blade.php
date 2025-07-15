@extends('layouts.user')
@push('css')
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <form method="get" action="/dpw/aset_lain/get">
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
                        {{-- Opsi ini akan diisi ulang via JavaScript --}}
                    </select>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Tampilkan Data</button>
            </form>
            <br />
            <div class="card">
                <div class="card-header" style="cursor: move;">
                    <h3 class="card-title">
                        <i class="fa fa-list"></i> Data aset
                    </h3>
                </div>
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
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data != null)
                            @foreach ($data as $key => $item)
                            <tr>
                                <td>{{ 1 + $key }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ $item->identitas }}</td>
                                <td>{{ $item->asal }}</td>
                                <td>{{ $item->tahun }}</td>
                                <td style="text-align: right">{{ number_format($item->harga) }}</td>
                                <td>{{ $item->kondisi }}</td>
                                <td style="text-align: right">{{ number_format($item->penyusutan) }}</td>
                            </tr>
                            @endforeach
                            <tr style="background-color: rgb(194, 243, 230)">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>TOTAL</td>
                                <td style="text-align: right">{{ number_format($data->sum('harga')) }}</td>
                                <td></td>
                                <td style="text-align: right">{{ number_format($data->sum('penyusutan')) }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
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