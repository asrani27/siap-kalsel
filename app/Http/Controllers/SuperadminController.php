<?php

namespace App\Http\Controllers;

use App\Models\Dpk;
use App\Imports\DpkImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SuperadminController extends Controller
{
    public function dpk()
    {
        $data = Dpk::where('bidang', '!=', null)->get();
        return view('superadmin.dpk.index', compact('data'));
    }

    public function importdpk(Request $req)
    {

        $validator = Validator::make($req->all(), [
            'file' => 'required|mimes:xlsx,xls,csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|max:5120',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Validasi gagal! Pastikan file yang diunggah sesuai format.');
            return redirect()->back();
        }

        try {

            Excel::import(new DpkImport(), $req->file('file'));

            return redirect()->back()->with('success', 'Data berhasil diimport!');
        } catch (\Exception $e) {
            Session::flash('error', 'Gagal mengimport data: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
