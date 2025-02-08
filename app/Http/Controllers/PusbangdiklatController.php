<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PusbangdiklatController extends Controller
{
    public function index()
    {
        return view('pusbangdiklat.home');
    }
    public function pengajuan()
    {
        $data = Pengajuan::orderBy('id', 'desc')
            ->paginate(10);
        return view('pusbangdiklat.pengajuan.index', compact('data'));
    }
    public function verifikasi($id)
    {
        $data = Pengajuan::find($id);
        return view('pusbangdiklat.pengajuan.upload', compact('data'));
    }
    public function pengajuan_delete($id)
    {
        $data = Pengajuan::where('id', $id)->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/pusbangdiklat/pengajuan');
    }
}
