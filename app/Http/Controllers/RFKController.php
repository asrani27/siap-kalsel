<?php

namespace App\Http\Controllers;

use App\Models\RFK;
use App\Models\RFKhp;
use App\Models\RFKokk;
use App\Models\RFKhpsub;
use App\Models\RFKokksub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RFKController extends Controller
{
    public function index()
    {
        $data = RFK::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('dpd.rfk.index', compact('data'));
    }

    public function create()
    {
        return view('dpd.rfk.create');
    }

    public function edit($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.rfk.edit', compact('data'));
    }
    public function store(Request $req)
    {
        RFK::create([
            'user_id' => Auth::user()->id,
            ...$req->all(),
        ]);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpd/rfk');
    }

    public function update(Request $req, $id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpd/rfk');
    }

    public function delete($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpd/rfk');
    }

    public function akun($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.rfk.detail.akun', compact('data', 'id'));
    }

    public function okk($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.rfk.detail.okk', compact('data', 'id'));
    }

    public function okkStore(Request $req, $id)
    {
        RFKokk::create([
            'rfk_id' => $id,
            ...$req->all(),
        ]);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpd/rfk/detail/' . $id . '/okk');
    }

    public function okkDelete($id, $okk_id)
    {
        $rfkOkk = RFKokk::where('id', $okk_id)
            ->whereHas('rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();

        $rfkOkk->delete();

        Session::flash('success', 'RFKokk berhasil dihapus');
        return redirect('/dpd/rfk/detail/' . $id . '/okk');
    }

    public function okkEdit($id, $okk_id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();

        $edit = RFKokk::where('id', $okk_id)
            ->whereHas('rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();

        return view('dpd.rfk.detail.okk_edit', compact('data', 'id', 'edit'));
    }
    public function okkUpdate(Request $req, $id, $okk_id)
    {
        $data = RFKokk::where('id', $okk_id)
            ->whereHas('rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpd/rfk/detail/' . $id . '/okk');
    }

    public function okkSub($id, $okk_id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.rfk.detail.okk_sub', compact('data', 'id', 'okk_id'));
    }
    public function okkSubStore(Request $req, $id, $okk_id)
    {
        RFKokksub::create([
            'rfk_okk_id' => $okk_id,
            ...$req->all(),
        ]);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpd/rfk/detail/' . $id . '/okk');
    }

    public function okkSubDelete($id, $okk_id, $okksub_id)
    {
        // Temukan RFKokksub yang terkait dengan RFKokk milik pengguna yang sedang login
        $rfkOkkSub = RFKokksub::where('id', $okksub_id)
            ->whereHas('rfkokk.rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();

        // Hapus RFKokksub yang ditemukan
        $rfkOkkSub->delete();

        Session::flash('success', 'RFKokksub berhasil dihapus');
        return redirect('/dpd/rfk/detail/' . $id . '/okk');
    }

    public function okkSubEdit($id, $okk_id, $okksub_id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();

        $edit = RFKokksub::where('id', $okksub_id)
            ->whereHas('rfkokk.rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();
        return view('dpd.rfk.detail.okk_sub_edit', compact('data', 'id', 'edit', 'okk_id', 'okksub_id'));
    }

    public function okkSubUpdate($id, $okk_id, $okksub_id, Request $req)
    {
        $data = RFKokksub::where('id', $okksub_id)
            ->whereHas('rfkokk.rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpd/rfk/detail/' . $id . '/okk');
    }

    public function hp($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.rfk.detail.hp', compact('data', 'id'));
    }

    public function hpStore(Request $req, $id)
    {
        RFKhp::create([
            'rfk_id' => $id,
            ...$req->all(),
        ]);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpd/rfk/detail/' . $id . '/hp');
    }

    public function hpDelete($id, $hp_id)
    {
        $rfkhp = RFKhp::where('id', $hp_id)
            ->whereHas('rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();

        $rfkhp->delete();

        Session::flash('success', 'RFKhp berhasil dihapus');
        return redirect('/dpd/rfk/detail/' . $id . '/hp');
    }

    public function hpEdit($id, $hp_id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();

        $edit = RFKhp::where('id', $hp_id)
            ->whereHas('rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();

        return view('dpd.rfk.detail.hp_edit', compact('data', 'id', 'edit'));
    }
    public function hpUpdate(Request $req, $id, $hp_id)
    {
        $data = RFKhp::where('id', $hp_id)
            ->whereHas('rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpd/rfk/detail/' . $id . '/hp');
    }

    public function hpSub($id, $hp_id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.rfk.detail.hp_sub', compact('data', 'id', 'hp_id'));
    }
    public function hpSubStore(Request $req, $id, $hp_id)
    {
        RFKhpsub::create([
            'rfk_hp_id' => $hp_id,
            ...$req->all(),
        ]);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpd/rfk/detail/' . $id . '/hp');
    }

    public function hpSubDelete($id, $hp_id, $hpsub_id)
    {
        // Temukan RFKhpsub yang terkait dengan RFKhp milik pengguna yang sedang login
        $rfkhpSub = RFKhpsub::where('id', $hpsub_id)
            ->whereHas('rfkhp.rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();

        // Hapus RFKhpsub yang ditemukan
        $rfkhpSub->delete();

        Session::flash('success', 'RFKhpsub berhasil dihapus');
        return redirect('/dpd/rfk/detail/' . $id . '/hp');
    }

    public function hpSubEdit($id, $hp_id, $hpsub_id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();

        $edit = RFKhpsub::where('id', $hpsub_id)
            ->whereHas('rfkhp.rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();
        return view('dpd.rfk.detail.hp_sub_edit', compact('data', 'id', 'edit', 'hp_id', 'hpsub_id'));
    }

    public function hpSubUpdate($id, $hp_id, $hpsub_id, Request $req)
    {
        $data = RFKhpsub::where('id', $hpsub_id)
            ->whereHas('rfkhp.rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpd/rfk/detail/' . $id . '/hp');
    }

    public function pp($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.rfk.detail.pp', compact('data', 'id'));
    }
    public function kdln($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.rfk.detail.kdln', compact('data', 'id'));
    }
    public function diklat($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.rfk.detail.diklat', compact('data', 'id'));
    }
    public function penelitian($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.rfk.detail.penelitian', compact('data', 'id'));
    }
    public function sisinfokom($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.rfk.detail.sisinfokom', compact('data', 'id'));
    }
    public function pelayanan($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.rfk.detail.pelayanan', compact('data', 'id'));
    }
    public function kesejahteraan($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.rfk.detail.kesejahteraan', compact('data', 'id'));
    }
}
