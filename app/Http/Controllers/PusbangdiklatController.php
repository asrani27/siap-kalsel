<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PusbangdiklatController extends Controller
{
    public function downloadFiles($id)
    {
        $data = Pengajuan::find($id);
        $folderPath = storage_path("app/public/uploads/user_{$id}");
        $zipFileName = "{$data->nama}_{$id}_files.zip";
        $zipFilePath = storage_path("app/public/uploads/{$zipFileName}");

        // Pastikan folder user ada
        if (!file_exists($folderPath)) {
            return response()->json(['error' => 'Folder tidak ditemukan'], 404);
        }

        // Buat objek ZipArchive
        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($folderPath), \RecursiveIteratorIterator::LEAVES_ONLY);

            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($folderPath) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }

            $zip->close();
        } else {
            return response()->json(['error' => 'Gagal membuat file ZIP'], 500);
        }

        // Mengunduh file ZIP dan menghapusnya setelah selesai
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
    public function index()
    {
        return view('pusbangdiklat.home');
    }
    public function baru()
    {
        $data = Pengajuan::where('proses1', null)
            ->paginate(10);
        return view('pusbangdiklat.pengajuan.index', compact('data'));
    }
    public function diproses()
    {
        $data = Pengajuan::where('proses1', '!=', null)->where('link_lms', null)
            ->paginate(10);
        return view('pusbangdiklat.pengajuan.index', compact('data'));
    }
    public function selesai()
    {
        $data = Pengajuan::where('link_lms', '!=', null)
            ->paginate(10);
        return view('pusbangdiklat.pengajuan.index', compact('data'));
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
        return view('pusbangdiklat.pengajuan.progress', compact('data'));
    }
    public function berkas($id)
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
    public function proses1($id)
    {
        $data = Pengajuan::find($id);
        if ($data->status_kirim == null) {
            Session::flash('error', 'Pemohon belum selesai upload');
            return redirect('/pusbangdiklat/pengajuan/verifikasi/' . $id);
        } else {
            $data->proses1 = 1;
            $data->tanggal_proses1 = Carbon::now();
            $data->save();
            Session::flash('success', 'di verifikasi');
            return redirect('/pusbangdiklat/pengajuan/verifikasi/' . $id);
        }
    }
    public function proses2($id)
    {
        $data = Pengajuan::find($id);

        if ($data->proses1 == null) {
            Session::flash('error', 'proses sebelumnya belum selesai');
            return redirect('/pusbangdiklat/pengajuan/verifikasi/' . $id);
        } else {
            $data->proses2 = 1;
            $data->tanggal_proses2 = Carbon::now();
            $data->save();
            Session::flash('success', 'di verifikasi');
            return redirect('/pusbangdiklat/pengajuan/verifikasi/' . $id);
        }
    }
    public function proses3($id)
    {
        $data = Pengajuan::find($id);
        if ($data->proses2 == null) {
            Session::flash('error', 'proses sebelumnya belum selesai');
            return redirect('/pusbangdiklat/pengajuan/verifikasi/' . $id);
        } else {
            $data->proses3 = 1;
            $data->tanggal_proses3 = Carbon::now();
            $data->save();
            Session::flash('success', 'di verifikasi');
            return redirect('/pusbangdiklat/pengajuan/verifikasi/' . $id);
        }
    }
    public function proses4($id)
    {
        $data = Pengajuan::find($id);
        if ($data->proses3 == null) {
            Session::flash('error', 'proses sebelumnya belum selesai');
            return redirect('/pusbangdiklat/pengajuan/verifikasi/' . $id);
        } else {
            $data->proses4 = 1;
            $data->tanggal_proses4 = Carbon::now();
            $data->save();
            Session::flash('success', 'di verifikasi');
            return redirect('/pusbangdiklat/pengajuan/verifikasi/' . $id);
        }
    }
    public function proses5($id)
    {
        $data = Pengajuan::find($id);
        if ($data->proses4 == null) {
            Session::flash('error', 'proses sebelumnya belum selesai');
            return redirect('/pusbangdiklat/pengajuan/verifikasi/' . $id);
        } else {
            $data->proses5 = 1;
            $data->tanggal_proses5 = Carbon::now();
            $data->save();
            Session::flash('success', 'di verifikasi');
            return redirect('/pusbangdiklat/pengajuan/verifikasi/' . $id);
        }
    }
    public function proses6($id)
    {
        $data = Pengajuan::find($id);
        if ($data->proses5 == null) {
            Session::flash('error', 'proses sebelumnya belum selesai');
            return redirect('/pusbangdiklat/pengajuan/verifikasi/' . $id);
        } else {
            $data->proses6 = 1;
            $data->tanggal_proses6 = Carbon::now();
            $data->save();
            Session::flash('success', 'di verifikasi');
            return redirect('/pusbangdiklat/pengajuan/verifikasi/' . $id);
        }
    }

    public function link_lms(Request $req, $id)
    {
        $data = Pengajuan::find($id);
        if ($data->proses6 == null) {
            Session::flash('error', 'proses sebelumnya belum selesai');
            return redirect('/pusbangdiklat/pengajuan/verifikasi/' . $id);
        } else {
            $data->link_lms = $req->link_lms;
            $data->tanggal_link_lms = Carbon::now();
            $data->save();
            Session::flash('success', 'di verifikasi');
            return redirect('/pusbangdiklat/pengajuan/verifikasi/' . $id);
        }
    }
}
