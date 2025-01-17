<?php

namespace App\Http\Controllers;

use App\Models\RFK;
use App\Models\RfkDetail;
use App\Models\RfkDetailSub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DPKController extends Controller
{
    public function index()
    {
        return view('dpk.home');
    }
    public function rfk()
    {
        $data = RFK::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('dpk.rfk.index', compact('data'));
    }

    public function rfk_create()
    {
        return view('dpk.rfk.create');
    }
    public function rfk_store(Request $req)
    {
        $rfk = RFK::create([
            'user_id' => Auth::user()->id,
            ...$req->all(),
        ]);

        //create detail
        $detail = new RfkDetail();
        $detail->rfk_id = $rfk->id;
        $detail->kode_akun = 'Penguatan Organisasi pada semua struktur';
        $detail->indikator = 'Terlaksananya penguatan organisasi';
        $detail->kegiatan = 'Konsulidasi ke 13 DPD PPNI Kab/Kota se Kalsel';
        $detail->satuan = 'kali';
        $detail->save();

        $sub = new RfkDetailSub();
        $sub->rfk_detail_id = $detail->id;
        $sub->program = 'Sosialisasi kebijakan kepada Personel Pengurus DPW dan DPD dan melaksanakan PO, Juklak dan Juknis';
        $sub->satuan = 'kali';
        $sub->save();

        $sub = new RfkDetailSub();
        $sub->rfk_detail_id = $detail->id;
        $sub->program = 'Melakukan pendampingan kepada DPD, Badan Kelengkapan tingkat Provinsi';
        $detail->indikator = 'Terlaksananya pendampingan kepada DPD, Badan Kelengkapan tingkat Provinsi';
        $detail->kegiatan = 'Pendampingan Pelaksanaan MUSDA DPD PPNI Se Kalimantan Selatan';
        $sub->satuan = 'kali';
        $sub->save();

        $sub = new RfkDetailSub();
        $sub->rfk_detail_id = $detail->id;
        $sub->program = 'Melakukan advokasi organisasi kepada pemerintah Provinsi, Pemerintah Kabupaten/Kota dan kepada lembaga non pemerintah';
        $sub->satuan = 'kali';
        $sub->save();

        $sub = new RfkDetailSub();
        $sub->rfk_detail_id = $detail->id;
        $sub->program = 'Melaksanakan MONEV menganai pelaksanaan PO oleh DPW kepada DPD serta Badan kelengkapan tingkat Provinsi';
        $sub->satuan = 'kali';
        $sub->save();

        $detail = new RfkDetail();
        $detail->rfk_id = $rfk->id;
        $detail->kode_akun = 'Pemetaan, Pengkawalan dan Penguatan Organisasi';
        $detail->satuan = 'kali';
        $detail->save();

        $sub = new RfkDetailSub();
        $sub->rfk_detail_id = $detail->id;
        $sub->program = 'Komunikasi dan koordinasi dengan bidang Sistem Informasi dan Komunikasi untuk optimalisasi sistem online keanggotaan yang semakin baik dan memberikan daya ungkit untuk pemenuhan kebutuhan anggota ';
        $sub->satuan = 'kali';
        $sub->save();

        $sub = new RfkDetailSub();
        $sub->rfk_detail_id = $detail->id;
        $sub->program = 'Monitoring dan evaluasi sistem keanggotaan secara berkala koordinasi dengan divisi Infokom ';
        $sub->satuan = 'kali';
        $sub->save();

        $detail = new RfkDetail();
        $detail->rfk_id = $rfk->id;
        $detail->kode_akun = 'Pengelolaan dan Pembinaan Anggota';
        $detail->satuan = 'kali';
        $detail->save();

        $sub = new RfkDetailSub();
        $sub->rfk_detail_id = $detail->id;
        $sub->program = 'Peningkatan pemberian edukasi dan pemahaman pentingnya pembinaan anggota kepada DPW dan Badan Kelengkapan';
        $sub->satuan = 'kali';
        $sub->save();

        $sub = new RfkDetailSub();
        $sub->rfk_detail_id = $detail->id;
        $sub->program = 'Pendampingan anggota PPNI baru';
        $sub->satuan = 'kali';
        $sub->save();

        $detail = new RfkDetail();
        $detail->rfk_id = $rfk->id;
        $detail->kode_akun = 'Penguatan Peran dan fungsi badan Kelengkapan';
        $detail->satuan = 'kali';
        $detail->save();


        $sub = new RfkDetailSub();
        $sub->rfk_detail_id = $detail->id;
        $sub->program = 'Melaksanakan sosialisasi PO Badan kelengkapan kepada DPD dan Badan Kelengkapan tingkat Provinsi didampingi perwakilan DPP';
        $sub->satuan = 'kali';
        $sub->save();

        $sub = new RfkDetailSub();
        $sub->rfk_detail_id = $detail->id;
        $sub->program = 'Melakukan pendampingan Badan Kelengkapan Tingkat Provinsi';
        $sub->satuan = 'kali';
        $sub->save();

        $sub = new RfkDetailSub();
        $sub->rfk_detail_id = $detail->id;
        $sub->program = 'Advokasi lembaga pemerintahan dan non pemerintah';
        $sub->satuan = 'kali';
        $sub->save();

        $sub = new RfkDetailSub();
        $sub->rfk_detail_id = $detail->id;
        $sub->program = 'Monitoring dan evaluasi tentang pelaksanaan PO Badan Kelengkapan';
        $sub->satuan = 'kali';
        $sub->save();

        $detail = new RfkDetail();
        $detail->rfk_id = $rfk->id;
        $detail->kode_akun = 'Kaderisasi Kepemimpinan Organisasi';
        $detail->satuan = 'kali';
        $detail->save();

        $sub = new RfkDetailSub();
        $sub->rfk_detail_id = $detail->id;
        $sub->program = 'Melaksanakan kaderisasi kader Madya';
        $sub->satuan = 'kali';
        $sub->save();

        $sub = new RfkDetailSub();
        $sub->rfk_detail_id = $detail->id;
        $sub->program = 'Monitoring dan Evaluasi Pelatihan Kaderisasi di DPW dan DPD';
        $sub->satuan = 'kali';
        $sub->save();

        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpk/rfk');
    }
    public function rfk_edit($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpk.rfk.edit', compact('data'));
    }
    public function rfk_update(Request $req, $id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpk/rfk');
    }
    public function rfk_delete($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpk/rfk');
    }
    public function rfk_detail($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpk.rfk.detail', compact('data', 'id'));
    }
}
