<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
</head>

<body>

    <table width="100%">
        <tr>
            <td style="text-align: center;" width="100%">

                <font size="16px"><b>LAPORAN OPERASIONAL GLOBAL<br />PERSATUAN PERAWAT NASIONAL INDONESIA<BR />
                        DEWAN PENGURUS WILAYAH DAN DAERAH<br />

                    </b></font>
                Periode : {{\Carbon\Carbon::parse($mulai)->format('d M Y')}} s/d
                {{\Carbon\Carbon::parse($sampai)->format('d M Y')}}
            </td>

        </tr>
    </table>
    <hr>
    </h3>
    <br />
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
        $no =1;
        @endphp

        @foreach ($dpw as $key => $item)
        <tr style="font-size:12px">
            <td>{{$key + 1}}</td>
            <td>{{$item->nama}} {{$item->kota}}</td>
            <td style="text-align: right">{{number_format($item->penerimaan)}}</td>
        </tr>
        @endforeach
        @foreach ($dpd as $key => $item)
        <tr style="font-size:12px">
            <td>{{$key + 1}}</td>
            <td style="padding-left: 20px">{{$item->nama}} {{$item->kota}}</td>
            <td style="text-align: right">{{number_format($item->penerimaan)}}</td>
        </tr>
        @foreach ($dpk->where('kota', $item->kota) as $keydpk => $itemdpk)
        <tr style="font-size:12px">
            <td>{{$keydpk + 1}}</td>
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
            <td>{{$key + 1}}</td>
            <td>{{$item->nama}} {{$item->kota}}</td>
            <td style="text-align: right">{{number_format($item->pengeluaran)}}</td>
        </tr>
        @endforeach
        @foreach ($dpd as $key => $item)
        <tr style="font-size:12px">
            <td>{{$key + 1}}</td>
            <td style="padding-left: 20px">{{$item->nama}} {{$item->kota}}</td>
            <td style="text-align: right">{{number_format($item->pengeluaran)}}</td>
        </tr>

        @foreach ($dpk->where('kota', $item->kota) as $keydpk => $itemdpk)
        <tr style="font-size:12px">
            <td>{{$keydpk + 1}}</td>
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
            <td>{{$nopajak++}}</td>
            <td>{{$item->nama}} {{$item->kota}}</td>
            <td style="text-align: right">{{number_format($item->pajak)}}</td>
        </tr>
        @endforeach
        @foreach ($dpd as $key => $item)
        <tr style="font-size:12px">
            <td>{{$nopajak++}}</td>
            <td style="padding-left: 20px">{{$item->nama}} {{$item->kota}}</td>
            <td style="text-align: right">{{number_format($item->pajak)}}</td>
        </tr>

        @foreach ($dpk->where('kota', $item->kota) as $keydpk => $itemdpk)
        <tr style="font-size:12px">
            <td>{{$keydpk + 1}}</td>
            <td style="padding-left: 40px">{{$itemdpk->nama}} {{$itemdpk->kota}}</td>
            <td style="text-align: right">{{number_format($itemdpk->pajak)}}</td>
        </tr>
        @endforeach
        @endforeach

        <tr style="background-color: rgb(193, 195, 195);font-size:14px">
            <th colspan="2">SURPLUS/DEFISIT OPERASIONAL</th>
            <th style="text-align: right">{{number_format($dpw->sum('penerimaan') + $dpd->sum('penerimaan') +
                $dpk->sum('penerimaan') - $dpw->sum('pengeluaran') + $dpd->sum('pengeluaran') +
                $dpk->sum('pengeluaran'))}}</th>
        </tr>
    </table>


</body>

</html>