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

                <font size="16px"><b>LAPORAN DATA ASET<br />PERSATUAN PERAWAT NASIONAL INDONESIA<BR />
                        {{dpd_dpk($user_id)}}<br />

                    </b></font>

            </td>

        </tr>
    </table>
    <hr>
    </h3>
    <br />
    <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr style="background-color: rgb(193, 195, 195); font-size:12px">
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
            <tr style="font-size:12px">
                <td>{{ 1 + $key }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->identitas }}</td>
                <td>{{ $item->asal }}</td>
                <td>{{ $item->tahun }}</td>
                <td style="text-align: right">{{ number_format($item->harga) }}</td>
                <td>{{ $item->kondisi }}</td>
                <td>{{$item->penyusutan }}</td>
            </tr>
            @endforeach
            <tr style="background-color: rgb(194, 243, 230); font-size:12px">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>TOTAL</td>
                <td style="text-align: right">{{ number_format($data->sum('harga')) }}</td>
                <td></td>
                <td></td>
            </tr>
            @endif
        </tbody>
    </table>


</body>

</html>