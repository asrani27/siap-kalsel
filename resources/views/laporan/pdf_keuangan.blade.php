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

                <font size="16px"><b>LAPORAN OPERASIONAL<br />PERSATUAN PERAWAT NASIONAL INDONESIA<BR />
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
        <tr style="background-color: rgb(193, 195, 195);font-size:14px">
            <th colspan="3">SURPLUS/DEFISIT OPERASIONAL</th>
            <th style="text-align: right">{{number_format($penerimaan->sum('total_penerimaan') -
                $pengeluaran->sum('total_pengeluaran'))}}</th>
        </tr>
    </table>


</body>

</html>