<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INVOICE</title>
</head>

<body>

    <table width="100%">
        <tr>
            <td width="15%">
                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('logo/ppni.png'))) }}"
                    width="70px"> &nbsp;&nbsp;
            </td>
            <td style="text-align: center;" width="60%">
                <font size="24px"><b>PPNI KALSEL <br /></b></font>
                Organisasi Persatuan Perawat Nasional Indonesia (PPNI)
                Provinsi Kalimantan Selatan
            </td>
            <td width="15%">
            </td>
        </tr>
    </table>
    <hr>
    <h3 style="text-align: center">INVOICE<br>NAMA PEMOHON : {{$data->nama}}
    </h3>
    <br />
    <table width="100%" border="1" cellpadding="5" cellspacing="0">
        <tr>
            <td style="border:1px solid black">No</td>
            <td style="border:1px solid black">Keterangan</td>
            <td style="border:1px solid black" style="text-align: center">Biaya</td>
        </tr>
        @foreach (invoice($data->id) as $key=> $item2)
        <tr>
            <td style="border:1px solid black">{{$key + 1}}</td>
            <td style="border:1px solid black">{{$item2->keterangan}}</td>
            <td style="border:1px solid black" style="text-align: right">
                {{number_format($item2->biaya)}}</td>
        </tr>
        @endforeach
        <tr>
            <td style="border:1px solid black" colspan="2" style="text-align: right">Total</td>
            <td style="border:1px solid black" style="text-align: right">Rp.
                {{number_format(invoice($data->id)->sum('biaya'))}}</td>
        </tr>
    </table>
    <br />
    <br />
    <table width="100%">
        <tr>
            <td width="50%"></td>
            <td></td>
            <td>{{\Carbon\Carbon::now()->translatedFormat('d F Y')}}<br />
                Bendahara DPW PPNI Kalimantan Selatan<br /><br /><br /><br /><br />

                <u>Heryani, S.Kep, Ns, M.Kep</u><br /><br />
                Transfer Payment:<br />
                Bank Transfer<br />
                Bank BNI<br />
                Rekening: 5551703747<br />
                a.n. DPW PPNI PROV KALSEL<br />

                Konfirmasi ke 0815-614-8686 (Heryani)<br />
            </td>
        </tr>
    </table>
</body>

</html>