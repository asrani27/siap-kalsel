<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
</head>

<body>

    <table width="100%" style="border-bottom:2px solid black">
        <tr>
            <td width="100px">
                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('logo/ppni.png'))) }}"
                    width="100%">
            </td>
            <td style="text-align: center;" width="70%">
                <div style="font-size:18px; color:rgb(0, 155, 103);font-weight:bold">
                    {{strtoupper(Auth::user()->name)}}
                    <br />PERSATUAN
                    PERAWAT NASIONAL
                    INDONESIA<BR />
                    (INDONESIAN NATIONAL NURSES ASSOCIATION)<br />
                    PROVINSI KALIMANTAN SELATAN<BR />
                </div>
                <div style="font-size: 12px; color:rgb(0, 155, 103)"> {{Auth::user()->alamat}} <br />
                    Email : {{Auth::user()->email}}<br />
                </div>
            </td>
            <td width="100px">
            </td>
        </tr>
    </table>

    <br />
    Periode : {{\Carbon\Carbon::parse($mulai)->format('d M Y')}} S/D {{\Carbon\Carbon::parse($sampai)->format('d M Y')}}
    <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <tr style="background-color: rgb(193, 195, 195)">
            <th>NO</th>
            <th>NO COA</th>
            <th>DESCRIPTION</th>
            <th>NOMINAL</th>
        </tr>
        <tr>
            <td colspan="4" style="text-align: center; font-weight:bold">PENERIMAAN</td>
        </tr>
        @php
        $no =1;
        @endphp

        @foreach ($penerimaan as $key => $item)
        <tr style="font-size:12px">
            <td>{{$key + 1}}</td>
            <td>{{$item->coa}}</td>
            <td>{{coa_name($item->coa) == null ? null : coa_name($item->coa)->nama}}</td>
            <td style="text-align: right">{{number_format($item->total_penerimaan)}}</td>
        </tr>
        @endforeach
        <tr style="background-color: rgb(193, 195, 195);font-size:14px">
            <th colspan="3">TOTAL PENERIMAAN</th>
            <th style="text-align: right">{{number_format($penerimaan->sum('total_penerimaan'))}}</th>
        </tr>
        <tr>
            <td colspan=4>
                <br />
            </td>
        </tr>

        <tr>
            <td colspan="4" style="text-align: center; font-weight:bold">PENGELUARAN</td>
        </tr>
        @foreach ($pengeluaran as $key => $item)
        <tr style="font-size:12px">
            <td>{{$key + 1}}</td>
            <td>{{$item->coa}}</td>
            <td>{{coa_name($item->coa) == null ? null : coa_name($item->coa)->nama}}</td>
            <td style="text-align: right">{{number_format($item->total_pengeluaran)}}</td>
        </tr>
        @endforeach
        <tr style="background-color: rgb(193, 195, 195);font-size:14px">
            <th colspan="3">TOTAL PENGELUARAN</th>
            <th style="text-align: right">{{number_format($pengeluaran->sum('total_pengeluaran'))}}</th>
        </tr>

        <tr>
            <td colspan="4" style="text-align: center; font-weight:bold">PAJAK</td>
        </tr>
        @php
        $nopajak = 1;
        @endphp
        @foreach ($pajak as $key => $item)
        <tr style="font-size:12px">
            <td>{{$nopajak++}}</td>
            <td>{{$key}}</td>
            <td>{{coa_name($key) == null ? null : coa_name($key)->nama}}</td>
            <td style="text-align: right">{{number_format($item)}}</td>
        </tr>
        @endforeach
        <tr style="background-color: rgb(193, 195, 195);font-size:14px">
            <th colspan="3">TOTAL PAJAK</th>
            <th style="text-align: right">{{number_format($pajak21 + $pajak23 + $pajak25)}}</th>
        </tr>
        <tr style="font-size:12px">
            <td></td>
            <td></td>
            <td>Pajak 21</td>
            <td style="text-align: right">{{number_format($pajak21)}}</td>
        </tr>
        <tr style="font-size:12px">
            <td></td>
            <td></td>
            <td>Pajak 23</td>
            <td style="text-align: right">{{number_format($pajak23)}}</td>
        </tr>
        <tr style="font-size:12px">
            <td></td>
            <td></td>
            <td>Pajak 25</td>
            <td style="text-align: right">{{number_format($pajak25)}}</td>
        </tr>
        <tr style="background-color: rgb(193, 195, 195);font-size:14px">
            <th colspan="3">SURPLUS/DEFISIT OPERASIONAL</th>
            <th style="text-align: right">{{number_format($penerimaan->sum('total_penerimaan') -
                $pengeluaran->sum('total_pengeluaran') - $pajak21 - $pajak23 - $pajak25)}}</th>
        </tr>
    </table>
    <br /><br />
    <table width="100%">
        <tr>
            <td width="65%">
                Mengetahui, <br />
                Ketua <br /><br /><br /><br /><br />
                {{Auth::user()->nama_ketua}}
            </td>
            <td>
                {{$kota}}, {{\Carbon\CArbon::now()->format('d M Y')}}
                <br />
                Bendahara <br /><br /><br /><br /><br />
                {{Auth::user()->nama_bendahara}}
            </td>
        </tr>
    </table>

</body>

</html>