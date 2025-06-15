<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice INV2534</title>

</head>
<style>
    @page {
        margin-top: 2mm;
        margin-bottom: 10mm;
        margin-left: 10mm;
        margin-right: 10mm;
    }
</style>

<body>

    <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('logo/ppni.jpeg'))) }}"
        width="100%">

    <table width="100%">
        <tr>
            <td width="65%">
                <table style="padding-left: 20px;">
                    <tr>
                        <td>No. Invoice</td>
                        <td>:</td>
                        <td>INV{{$data->id}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td>{{\Carbon\carbon::parse($data->created_at)->format('d-m-Y')}}</td>
                    </tr>
                    <tr>
                        <td><br /><br /></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td>
                <table style="padding-left: 20px">
                    <tr>
                        <td style="text-align: right">Penerima :</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right">
                            {{$data->nama}} <br /> {{$data->instansi}} <br /> {{$data->telp}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="content">
        <table style="padding-left: 20px" width="100%" border="1" cellpadding="5" cellspacing="0">
            <tr style="background-color:#2e7d32; color:white">
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
                <td style="border:1px solid black" style="text-align: right; background-color:rgb(113, 250, 152)">Rp.
                    {{number_format(invoice($data->id)->sum('biaya'))}}</td>
            </tr>
        </table>
    </div>

    <table width="100%">
        <tr>
            <td width="50%" style="padding-left: 20px">
                <b>Transfer Payment:</b><br />
                Bank Transfer<br />
                Bank BNI<br />
                Rekening: 5551703747<br />
                a.n. DPW PPNI PROV KALSEL<br />
                <br />
                Konfirmasi ke 0815-614-8686 (Heryani)<br />
            </td>
            <td></td>
            <td><br />
                {{\Carbon\Carbon::now()->translatedFormat('d F Y')}}<br />
                Bendahara DPW PPNI Kalimantan Selatan<br /><br /><br /><br /><br />

                <u>Heryani, S.Kep, Ns, M.Kep</u><br /><br />
            </td>
        </tr>
    </table>
</body>

</html>