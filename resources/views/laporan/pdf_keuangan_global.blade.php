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
                <div style="font-size:18px; color:rgb(0, 155, 103);font-weight:bold">DEWAN PENGURUS WILAYAH DAN
                    DAERAH<br />PERSATUAN
                    PERAWAT NASIONAL
                    INDONESIA<BR />
                    (INDONESIAN NATIONAL NURSES ASSOCIATION)<br />
                    PROVINSI KALIMANTAN SELATAN<BR /></div>
                <div style="font-size: 12px; color:rgb(0, 155, 103)"> Jl. A Yani KM 2 No. 43 Gedung Ulin Tower Lt.9
                    Banjarmasin <br />
                    Email : dpwkalsel.ppni@gmail.com<br />
                </div>
            </td>
            <td width="100px">
            </td>
        </tr>
    </table>
    <br />
    Periode : {{\Carbon\Carbon::parse($mulai)->format('d M Y')}} s/d
    {{\Carbon\Carbon::parse($sampai)->format('d M Y')}}
    </h3>

    <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <tr style="background-color: rgb(193, 195, 195)">
            <th>NO</th>
            <th>DESCRIPTION</th>
            <th>NOMINAL</th>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center; font-weight:bold">PENERIMAAN</td>
        </tr>
        @php
        $no_penerimaan =1;
        $no_pengeluaran =1;
        $no_pajak =1;
        @endphp

        @foreach ($dpw as $key => $item)
        <tr style="font-size:12px">
            <td>{{$no_penerimaan++}}</td>
            <td>{{$item->nama}} {{$item->kota}}</td>
            <td style="text-align: right">{{number_format($item->penerimaan)}}</td>
        </tr>
        @endforeach
        @foreach ($dpd as $key => $item)
        <tr style="font-size:12px">
            <td>{{$no_penerimaan++}}</td>
            <td style="padding-left: 20px">{{$item->nama}} {{$item->kota}}</td>
            <td style="text-align: right">{{number_format($item->penerimaan)}}</td>
        </tr>
        @foreach ($dpk->where('kota', $item->kota) as $keydpk => $itemdpk)
        <tr style="font-size:12px">
            <td>{{$no_penerimaan++}}</td>
            <td style="padding-left: 40px">{{$itemdpk->nama}} {{$itemdpk->kota}}</td>
            <td style="text-align: right">{{number_format($itemdpk->penerimaan)}}</td>
        </tr>
        @endforeach
        @endforeach
        <tr style="background-color: rgb(193, 195, 195);font-size:14px">
            <th colspan="2">TOTAL PENERIMAAN</th>
            <th style="text-align: right">{{number_format($dpw->sum('penerimaan') + $dpd->sum('penerimaan') +
                $dpk->sum('penerimaan'))}}</th>
        </tr>
        <tr>
            <td colspan=3>
                <br />
            </td>
        </tr>

        <tr>
            <td colspan="3" style="text-align: center; font-weight:bold">PENGELUARAN</td>
        </tr>
        @foreach ($dpw as $key => $item)
        <tr style="font-size:12px">
            <td>{{$no_pengeluaran++}}</td>
            <td>{{$item->nama}} {{$item->kota}}</td>
            <td style="text-align: right">{{number_format($item->pengeluaran)}}</td>
        </tr>
        @endforeach
        @foreach ($dpd as $key => $item)
        <tr style="font-size:12px">
            <td>{{$no_pengeluaran++}}</td>
            <td style="padding-left: 20px">{{$item->nama}} {{$item->kota}}</td>
            <td style="text-align: right">{{number_format($item->pengeluaran)}}</td>
        </tr>

        @foreach ($dpk->where('kota', $item->kota) as $keydpk => $itemdpk)
        <tr style="font-size:12px">
            <td>{{$no_pengeluaran++}}</td>
            <td style="padding-left: 40px">{{$itemdpk->nama}} {{$itemdpk->kota}}</td>
            <td style="text-align: right">{{number_format($itemdpk->pengeluaran)}}</td>
        </tr>
        @endforeach
        @endforeach
        <tr style="background-color: rgb(193, 195, 195);font-size:14px">
            <th colspan="2">TOTAL PENGELUARAN</th>
            <th style="text-align: right">{{number_format($dpw->sum('pengeluaran') + $dpd->sum('pengeluaran') +
                $dpk->sum('pengeluaran'))}}</th>
        </tr>
        <tr>
            <td colspan=3>
                <br />
            </td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center; font-weight:bold">PAJAK</td>
        </tr>
        @php
        $nopajak = 1;
        @endphp
        @foreach ($dpw as $key => $item)
        <tr style="font-size:12px">
            <td>{{$no_pajak++}}</td>
            <td>{{$item->nama}} {{$item->kota}}</td>
            <td style="text-align: right">{{number_format($item->pajak)}}</td>
        </tr>
        @endforeach
        @foreach ($dpd as $key => $item)
        <tr style="font-size:12px">
            <td>{{$no_pajak++}}</td>
            <td style="padding-left: 20px">{{$item->nama}} {{$item->kota}}</td>
            <td style="text-align: right">{{number_format($item->pajak)}}</td>
        </tr>

        @foreach ($dpk->where('kota', $item->kota) as $keydpk => $itemdpk)
        <tr style="font-size:12px">
            <td>{{$no_pajak++}}</td>
            <td style="padding-left: 40px">{{$itemdpk->nama}} {{$itemdpk->kota}}</td>
            <td style="text-align: right">{{number_format($itemdpk->pajak)}}</td>
        </tr>
        @endforeach
        @endforeach
        <tr style="background-color: rgb(193, 195, 195);font-size:14px">
            <th colspan="2">TOTAL PAJAK</th>
            <th style="text-align: right">{{number_format($dpw->sum('pajak') + $dpd->sum('pajak') +
                $dpk->sum('pajak'))}}</th>
        </tr>
        <tr style="background-color: rgb(193, 195, 195);font-size:14px">
            <th colspan="2">SURPLUS/DEFISIT OPERASIONAL</th>
            <th style="text-align: right">{{number_format(($dpw->sum('penerimaan') + $dpd->sum('penerimaan') +
                $dpk->sum('penerimaan')) - ($dpw->sum('pengeluaran') + $dpd->sum('pengeluaran') +
                $dpk->sum('pengeluaran')) - ($dpw->sum('pajak') + $dpd->sum('pajak') +
                $dpk->sum('pajak')))}}</th>
        </tr>
    </table>


</body>

</html>