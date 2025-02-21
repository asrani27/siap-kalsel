<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Pengajuan;
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
