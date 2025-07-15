<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\COAController;
use App\Http\Controllers\DPDController;
use App\Http\Controllers\DPKController;
use App\Http\Controllers\DPWController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PusbangdiklatController;
use App\Http\Controllers\RFKController;
use App\Http\Controllers\SuperadminController;

Route::get('/', [LoginController::class, 'home']);
Route::get('/masuk', [LoginController::class, 'masuk']);
Route::post('/masuk', [LoginController::class, 'storeMasuk']);
Route::get('/daftar', [LoginController::class, 'daftar']);
Route::post('/daftar', [LoginController::class, 'storeDaftar']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/get-dpk/{kota_id}', [LoginController::class, 'getDpk'])->name('get.dpk');

Route::middleware(['auth', 'pusbangdiklat'])->group(function () {
    Route::get('/pusbangdiklat', [PusbangdiklatController::class, 'index']);
    Route::get('/pusbangdiklat/pengajuan/baru', [PusbangdiklatController::class, 'baru']);
    Route::get('/pusbangdiklat/pengajuan/diproses', [PusbangdiklatController::class, 'diproses']);
    Route::get('/pusbangdiklat/pengajuan/selesai', [PusbangdiklatController::class, 'selesai']);
    Route::get('/pusbangdiklat/pengajuan/download-invoice/{id}', [PusbangdiklatController::class, 'downloadInvoice']);
    Route::get('/pusbangdiklat/pengajuan/proses1-verif/{id}', [PusbangdiklatController::class, 'proses1']);
    Route::get('/pusbangdiklat/pengajuan/proses2-verif/{id}', [PusbangdiklatController::class, 'proses2']);
    Route::get('/pusbangdiklat/pengajuan/proses3-verif/{id}', [PusbangdiklatController::class, 'proses3']);
    Route::get('/pusbangdiklat/pengajuan/proses4-verif/{id}', [PusbangdiklatController::class, 'proses4']);
    Route::get('/pusbangdiklat/pengajuan/proses5-verif/{id}', [PusbangdiklatController::class, 'proses5']);
    Route::get('/pusbangdiklat/pengajuan/proses6-verif/{id}', [PusbangdiklatController::class, 'proses6']);
    Route::post('/pusbangdiklat/pengajuan/link-lms/{id}', [PusbangdiklatController::class, 'link_lms']);
    Route::get('/pusbangdiklat/pengajuan/delete/{id}', [PusbangdiklatController::class, 'pengajuan_delete']);
    Route::get('/pusbangdiklat/pengajuan/verifikasi/{id}', [PusbangdiklatController::class, 'verifikasi']);
    Route::post('/pusbangdiklat/pengajuan/verifikasi/{id}/invoice', [PusbangdiklatController::class, 'storeInvoice']);
    Route::get('/pusbangdiklat/pengajuan/invoice/{id}/hapus', [PusbangdiklatController::class, 'hapusInvoice']);
    Route::get('/pusbangdiklat/pengajuan/berkas/{id}', [PusbangdiklatController::class, 'berkas']);
    Route::get('/pusbangdiklat/pengajuan/download/{id}', [PusbangdiklatController::class, 'downloadFiles']);
});
Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/superadmin', [HomeController::class, 'superadmin']);

    Route::get('/superadmin/user', [UserController::class, 'index']);
    Route::get('/superadmin/user/create', [UserController::class, 'create']);
    Route::post('/superadmin/user/create', [UserController::class, 'store']);
    Route::get('/superadmin/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('/superadmin/user/edit/{id}', [UserController::class, 'update']);
    Route::get('/superadmin/user/delete/{id}', [UserController::class, 'delete']);

    Route::get('/superadmin/datadpk', [SuperadminController::class, 'dpk']);
    Route::post('/superadmin/datadpk/import', [SuperadminController::class, 'importdpk']);

    Route::get('/superadmin/coa', [COAController::class, 'index']);
    Route::get('/superadmin/coa/create', [COAController::class, 'create']);
    Route::post('/superadmin/coa/create', [COAController::class, 'store']);
    Route::get('/superadmin/coa/edit/{id}', [COAController::class, 'edit']);
    Route::post('/superadmin/coa/edit/{id}', [COAController::class, 'update']);
    Route::get('/superadmin/coa/delete/{id}', [COAController::class, 'delete']);
});

Route::middleware(['auth', 'pusbangdiklat'])->group(function () {
    Route::get('/gantipass', [UserController::class, 'gantipass']);
    Route::post('/gantipass', [UserController::class, 'updatepass']);
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/gantipass', [UserController::class, 'gantipass']);
    Route::post('/gantipass', [UserController::class, 'updatepass']);
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/pengajuan/progress/{id}', [UserController::class, 'progress']);
    Route::get('/user/pengajuan', [UserController::class, 'pengajuan']);
    Route::post('/user/pengajuan/kirimrating/{id}', [UserController::class, 'rating']);
    Route::get('/user/pengajuan/download-invoice/{id}', [UserController::class, 'downloadInvoice']);
    Route::get('/user/pengajuan/create', [UserController::class, 'pengajuan_create']);
    Route::post('/user/pengajuan/create', [UserController::class, 'pengajuan_store']);
    Route::get('/user/pengajuan/edit/{id}', [UserController::class, 'pengajuan_edit']);
    Route::get('/user/pengajuan/kirim/{id}', [UserController::class, 'pengajuan_kirim']);
    Route::get('/user/pengajuan/upload/{id}', [UserController::class, 'pengajuan_upload']);
    Route::post('/user/pengajuan/upload/{id}', [UserController::class, 'pengajuan_upload_store']);
    Route::post('/user/pengajuan/edit/{id}', [UserController::class, 'pengajuan_update']);
    Route::get('/user/pengajuan/delete/{id}', [UserController::class, 'pengajuan_delete']);
});

Route::middleware(['auth', 'dpd'])->group(function () {
    Route::get('/dpd', [DPDController::class, 'index']);
    Route::get('/dpd/monev', [DPDController::class, 'monev']);
    Route::get('/dpd/monev/create', [DPDController::class, 'monev_create']);
    Route::post('/dpd/monev/create', [DPDController::class, 'monev_store']);
    Route::get('/dpd/monev/edit/{id}', [DPDController::class, 'monev_edit']);
    Route::post('/dpd/monev/edit/{id}', [DPDController::class, 'monev_update']);
    Route::get('/dpd/monev/delete/{id}', [DPDController::class, 'monev_delete']);
    Route::get('/dpd/rfk', [DPDController::class, 'rfk']);
    Route::get('/dpd/rfk/create', [DPDController::class, 'rfk_create']);
    Route::post('/dpd/rfk/create', [DPDController::class, 'rfk_store']);
    Route::get('/dpd/rfk/edit/{id}', [DPDController::class, 'rfk_edit']);
    Route::post('/dpd/rfk/edit/{id}', [DPDController::class, 'rfk_update']);
    Route::get('/dpd/rfk/delete/{id}', [DPDController::class, 'rfk_delete']);
    Route::get('/dpd/rfk/detail/{id}', [DPDController::class, 'rfk_detail']);
    Route::get('/dpd/rfk/detail/{id}/edit/{detail_id}', [DPDController::class, 'rfk_detail_edit']);
    Route::post('/dpd/rfk/detail/{id}/edit/{detail_id}', [DPDController::class, 'rfk_detail_update']);
    Route::get('/dpd/rfk/detail/{id}/editsub/{detail_sub_id}', [DPDController::class, 'rfk_detail_editsub']);
    Route::post('/dpd/rfk/detail/{id}/editsub/{detail_sub_id}', [DPDController::class, 'rfk_detail_updatesub']);

    Route::get('/dpd/surat-masuk', [DPDController::class, 'surat_masuk']);
    Route::get('/dpd/surat-masuk/create', [DPDController::class, 'surat_masuk_create']);
    Route::post('/dpd/surat-masuk/create', [DPDController::class, 'surat_masuk_store']);
    Route::get('/dpd/surat-masuk/edit/{id}', [DPDController::class, 'surat_masuk_edit']);
    Route::post('/dpd/surat-masuk/edit/{id}', [DPDController::class, 'surat_masuk_update']);
    Route::get('/dpd/surat-masuk/delete/{id}', [DPDController::class, 'surat_masuk_delete']);

    Route::get('/dpd/surat-keluar', [DPDController::class, 'surat_keluar']);
    Route::get('/dpd/surat-keluar/create', [DPDController::class, 'surat_keluar_create']);
    Route::post('/dpd/surat-keluar/create', [DPDController::class, 'surat_keluar_store']);
    Route::get('/dpd/surat-keluar/edit/{id}', [DPDController::class, 'surat_keluar_edit']);
    Route::post('/dpd/surat-keluar/edit/{id}', [DPDController::class, 'surat_keluar_update']);
    Route::get('/dpd/surat-keluar/delete/{id}', [DPDController::class, 'surat_keluar_delete']);

    Route::get('/dpd/anggota', [DPDController::class, 'anggota']);
    Route::get('/dpd/anggota/create', [DPDController::class, 'anggota_create']);
    Route::post('/dpd/anggota/create', [DPDController::class, 'anggota_store']);
    Route::get('/dpd/anggota/edit/{id}', [DPDController::class, 'anggota_edit']);
    Route::post('/dpd/anggota/edit/{id}', [DPDController::class, 'anggota_update']);
    Route::get('/dpd/anggota/delete/{id}', [DPDController::class, 'anggota_delete']);

    Route::get('/dpd/aset', [DPDController::class, 'aset']);
    Route::get('/dpd/aset/create', [DPDController::class, 'aset_create']);
    Route::post('/dpd/aset/create', [DPDController::class, 'aset_store']);
    Route::get('/dpd/aset/edit/{id}', [DPDController::class, 'aset_edit']);
    Route::post('/dpd/aset/edit/{id}', [DPDController::class, 'aset_update']);
    Route::get('/dpd/aset/delete/{id}', [DPDController::class, 'aset_delete']);


    Route::get('/dpd/keuangan', [DPDController::class, 'keuangan']);
    Route::get('/dpd/keuangan/laporan', [DPDController::class, 'laporan']);
    Route::get('/dpd/keuangan/create', [DPDController::class, 'keuangan_create']);
    Route::post('/dpd/keuangan/create', [DPDController::class, 'keuangan_store']);
    Route::get('/dpd/keuangan/edit/{id}', [DPDController::class, 'keuangan_edit']);
    Route::post('/dpd/keuangan/edit/{id}', [DPDController::class, 'keuangan_update']);
    Route::get('/dpd/keuangan/delete/{id}', [DPDController::class, 'keuangan_delete']);

    Route::get('/dpd/surat-keputusan', [DPDController::class, 'surat_keputusan']);
    Route::get('/dpd/surat-keputusan/create', [DPDController::class, 'surat_keputusan_create']);
    Route::post('/dpd/surat-keputusan/create', [DPDController::class, 'surat_keputusan_store']);
    Route::get('/dpd/surat-keputusan/edit/{id}', [DPDController::class, 'surat_keputusan_edit']);
    Route::post('/dpd/surat-keputusan/edit/{id}', [DPDController::class, 'surat_keputusan_update']);
    Route::get('/dpd/surat-keputusan/delete/{id}', [DPDController::class, 'surat_keputusan_delete']);

    Route::get('/dpd/surat-nt', [DPDController::class, 'surat_nt']);
    Route::get('/dpd/surat-nt/create', [DPDController::class, 'surat_nt_create']);
    Route::post('/dpd/surat-nt/create', [DPDController::class, 'surat_nt_store']);
    Route::get('/dpd/surat-nt/edit/{id}', [DPDController::class, 'surat_nt_edit']);
    Route::post('/dpd/surat-nt/edit/{id}', [DPDController::class, 'surat_nt_update']);
    Route::get('/dpd/surat-nt/delete/{id}', [DPDController::class, 'surat_nt_delete']);
});
Route::middleware(['auth', 'dpk'])->group(function () {
    Route::get('/dpk', [DPKController::class, 'index']);
    Route::get('/dpk/rfk', [DPKController::class, 'rfk']);
    Route::get('/dpk/rfk/create', [DPKController::class, 'rfk_create']);
    Route::post('/dpk/rfk/create', [DPKController::class, 'rfk_store']);
    Route::get('/dpk/rfk/edit/{id}', [DPKController::class, 'rfk_edit']);
    Route::post('/dpk/rfk/edit/{id}', [DPKController::class, 'rfk_update']);
    Route::get('/dpk/rfk/delete/{id}', [DPKController::class, 'rfk_delete']);
    Route::get('/dpk/rfk/detail/{id}', [DPKController::class, 'rfk_detail']);
    Route::get('/dpk/rfk/detail/{id}/edit/{detail_id}', [DPKController::class, 'rfk_detail_edit']);
    Route::post('/dpk/rfk/detail/{id}/edit/{detail_id}', [DPKController::class, 'rfk_detail_update']);
    Route::get('/dpk/rfk/detail/{id}/editsub/{detail_sub_id}', [DPKController::class, 'rfk_detail_editsub']);
    Route::post('/dpk/rfk/detail/{id}/editsub/{detail_sub_id}', [DPKController::class, 'rfk_detail_updatesub']);

    Route::get('/dpk/surat-masuk', [DPKController::class, 'surat_masuk']);
    Route::get('/dpk/surat-masuk/create', [DPKController::class, 'surat_masuk_create']);
    Route::post('/dpk/surat-masuk/create', [DPKController::class, 'surat_masuk_store']);
    Route::get('/dpk/surat-masuk/edit/{id}', [DPKController::class, 'surat_masuk_edit']);
    Route::post('/dpk/surat-masuk/edit/{id}', [DPKController::class, 'surat_masuk_update']);
    Route::get('/dpk/surat-masuk/delete/{id}', [DPKController::class, 'surat_masuk_delete']);

    Route::get('/dpk/surat-keluar', [DPKController::class, 'surat_keluar']);
    Route::get('/dpk/surat-keluar/create', [DPKController::class, 'surat_keluar_create']);
    Route::post('/dpk/surat-keluar/create', [DPKController::class, 'surat_keluar_store']);
    Route::get('/dpk/surat-keluar/edit/{id}', [DPKController::class, 'surat_keluar_edit']);
    Route::post('/dpk/surat-keluar/edit/{id}', [DPKController::class, 'surat_keluar_update']);
    Route::get('/dpk/surat-keluar/delete/{id}', [DPKController::class, 'surat_keluar_delete']);

    Route::get('/dpk/anggota', [DPKController::class, 'anggota']);
    Route::get('/dpk/anggota/create', [DPKController::class, 'anggota_create']);
    Route::post('/dpk/anggota/create', [DPKController::class, 'anggota_store']);
    Route::get('/dpk/anggota/edit/{id}', [DPKController::class, 'anggota_edit']);
    Route::post('/dpk/anggota/edit/{id}', [DPKController::class, 'anggota_update']);
    Route::get('/dpk/anggota/delete/{id}', [DPKController::class, 'anggota_delete']);

    Route::get('/dpk/aset', [DPKController::class, 'aset']);
    Route::get('/dpk/aset/create', [DPKController::class, 'aset_create']);
    Route::post('/dpk/aset/create', [DPKController::class, 'aset_store']);
    Route::get('/dpk/aset/edit/{id}', [DPKController::class, 'aset_edit']);
    Route::post('/dpk/aset/edit/{id}', [DPKController::class, 'aset_update']);
    Route::get('/dpk/aset/delete/{id}', [DPKController::class, 'aset_delete']);

    Route::get('/dpk/keuangan', [DPKController::class, 'keuangan']);
    Route::get('/dpk/keuangan/laporan', [DPKController::class, 'laporan']);
    Route::get('/dpk/keuangan/create', [DPKController::class, 'keuangan_create']);
    Route::post('/dpk/keuangan/create', [DPKController::class, 'keuangan_store']);
    Route::get('/dpk/keuangan/edit/{id}', [DPKController::class, 'keuangan_edit']);
    Route::post('/dpk/keuangan/edit/{id}', [DPKController::class, 'keuangan_update']);
    Route::get('/dpk/keuangan/delete/{id}', [DPKController::class, 'keuangan_delete']);

    Route::get('/dpk/surat-keputusan', [DPKController::class, 'surat_keputusan']);
    Route::get('/dpk/surat-keputusan/create', [DPKController::class, 'surat_keputusan_create']);
    Route::post('/dpk/surat-keputusan/create', [DPKController::class, 'surat_keputusan_store']);
    Route::get('/dpk/surat-keputusan/edit/{id}', [DPKController::class, 'surat_keputusan_edit']);
    Route::post('/dpk/surat-keputusan/edit/{id}', [DPKController::class, 'surat_keputusan_update']);
    Route::get('/dpk/surat-keputusan/delete/{id}', [DPKController::class, 'surat_keputusan_delete']);

    Route::get('/dpk/surat-nt', [DPKController::class, 'surat_nt']);
    Route::get('/dpk/surat-nt/create', [DPKController::class, 'surat_nt_create']);
    Route::post('/dpk/surat-nt/create', [DPKController::class, 'surat_nt_store']);
    Route::get('/dpk/surat-nt/edit/{id}', [DPKController::class, 'surat_nt_edit']);
    Route::post('/dpk/surat-nt/edit/{id}', [DPKController::class, 'surat_nt_update']);
    Route::get('/dpk/surat-nt/delete/{id}', [DPKController::class, 'surat_nt_delete']);
});
Route::middleware(['auth', 'dpw'])->group(function () {
    Route::get('/dpw', [DPWController::class, 'index']);
    Route::get('/dpw/rfk', [DPWController::class, 'rfk']);
    Route::get('/dpw/rfk/create', [DPWController::class, 'rfk_create']);
    Route::post('/dpw/rfk/create', [DPWController::class, 'rfk_store']);
    Route::get('/dpw/rfk/edit/{id}', [DPWController::class, 'rfk_edit']);
    Route::post('/dpw/rfk/edit/{id}', [DPWController::class, 'rfk_update']);
    Route::get('/dpw/rfk/delete/{id}', [DPWController::class, 'rfk_delete']);
    Route::get('/dpw/rfk/detail/{id}', [DPWController::class, 'rfk_detail']);
    Route::get('/dpw/rfk/detail/{id}/edit/{detail_id}', [DPWController::class, 'rfk_detail_edit']);
    Route::post('/dpw/rfk/detail/{id}/edit/{detail_id}', [DPWController::class, 'rfk_detail_update']);
    Route::get('/dpw/rfk/detail/{id}/editsub/{detail_sub_id}', [DPWController::class, 'rfk_detail_editsub']);
    Route::post('/dpw/rfk/detail/{id}/editsub/{detail_sub_id}', [DPWController::class, 'rfk_detail_updatesub']);


    Route::get('/dpw/surat-masuk', [DPWController::class, 'surat_masuk']);
    Route::get('/dpw/surat-masuk/create', [DPWController::class, 'surat_masuk_create']);
    Route::post('/dpw/surat-masuk/create', [DPWController::class, 'surat_masuk_store']);
    Route::get('/dpw/surat-masuk/edit/{id}', [DPWController::class, 'surat_masuk_edit']);
    Route::post('/dpw/surat-masuk/edit/{id}', [DPWController::class, 'surat_masuk_update']);
    Route::get('/dpw/surat-masuk/delete/{id}', [DPWController::class, 'surat_masuk_delete']);

    Route::get('/dpw/surat-keluar', [DPWController::class, 'surat_keluar']);
    Route::get('/dpw/surat-keluar/create', [DPWController::class, 'surat_keluar_create']);
    Route::post('/dpw/surat-keluar/create', [DPWController::class, 'surat_keluar_store']);
    Route::get('/dpw/surat-keluar/edit/{id}', [DPWController::class, 'surat_keluar_edit']);
    Route::post('/dpw/surat-keluar/edit/{id}', [DPWController::class, 'surat_keluar_update']);
    Route::get('/dpw/surat-keluar/delete/{id}', [DPWController::class, 'surat_keluar_delete']);

    Route::get('/dpw/surat-keputusan', [DPWController::class, 'surat_keputusan']);
    Route::get('/dpw/surat-keputusan/create', [DPWController::class, 'surat_keputusan_create']);
    Route::post('/dpw/surat-keputusan/create', [DPWController::class, 'surat_keputusan_store']);
    Route::get('/dpw/surat-keputusan/edit/{id}', [DPWController::class, 'surat_keputusan_edit']);
    Route::post('/dpw/surat-keputusan/edit/{id}', [DPWController::class, 'surat_keputusan_update']);
    Route::get('/dpw/surat-keputusan/delete/{id}', [DPWController::class, 'surat_keputusan_delete']);

    Route::get('/dpw/surat-nt', [DPWController::class, 'surat_nt']);
    Route::get('/dpw/surat-nt/create', [DPWController::class, 'surat_nt_create']);
    Route::post('/dpw/surat-nt/create', [DPWController::class, 'surat_nt_store']);
    Route::get('/dpw/surat-nt/edit/{id}', [DPWController::class, 'surat_nt_edit']);
    Route::post('/dpw/surat-nt/edit/{id}', [DPWController::class, 'surat_nt_update']);
    Route::get('/dpw/surat-nt/delete/{id}', [DPWController::class, 'surat_nt_delete']);

    Route::get('/dpw/anggota', [DPWController::class, 'anggota']);
    Route::get('/dpw/anggota/create', [DPWController::class, 'anggota_create']);
    Route::post('/dpw/anggota/create', [DPWController::class, 'anggota_store']);
    Route::get('/dpw/anggota/edit/{id}', [DPWController::class, 'anggota_edit']);
    Route::post('/dpw/anggota/edit/{id}', [DPWController::class, 'anggota_update']);
    Route::get('/dpw/anggota/delete/{id}', [DPWController::class, 'anggota_delete']);

    Route::get('/dpw/aset_lain/get', [DPWController::class, 'aset_lain_get']);
    Route::get('/dpw/aset_lain', [DPWController::class, 'aset_lain']);
    Route::get('/dpw/aset', [DPWController::class, 'aset']);
    Route::get('/dpw/aset/create', [DPWController::class, 'aset_create']);
    Route::post('/dpw/aset/create', [DPWController::class, 'aset_store']);
    Route::get('/dpw/aset/edit/{id}', [DPWController::class, 'aset_edit']);
    Route::post('/dpw/aset/edit/{id}', [DPWController::class, 'aset_update']);
    Route::get('/dpw/aset/delete/{id}', [DPWController::class, 'aset_delete']);

    Route::get('/dpw/keuangan', [DPWController::class, 'keuangan']);
    Route::get('/dpw/keuangan/laporan', [DPWController::class, 'laporan']);
    Route::get('/dpw/keuangan/create', [DPWController::class, 'keuangan_create']);
    Route::post('/dpw/keuangan/create', [DPWController::class, 'keuangan_store']);
    Route::get('/dpw/keuangan/edit/{id}', [DPWController::class, 'keuangan_edit']);
    Route::post('/dpw/keuangan/edit/{id}', [DPWController::class, 'keuangan_update']);
    Route::get('/dpw/keuangan/delete/{id}', [DPWController::class, 'keuangan_delete']);

    Route::get('/dpw/coa', [DPWController::class, 'coa']);
    Route::get('/dpw/coa/create', [DPWController::class, 'coa_create']);
    Route::post('/dpw/coa/create', [DPWController::class, 'coa_store']);
    Route::get('/dpw/coa/edit/{id}', [DPWController::class, 'coa_edit']);
    Route::post('/dpw/coa/edit/{id}', [DPWController::class, 'coa_update']);
    Route::get('/dpw/coa/delete/{id}', [DPWController::class, 'coa_delete']);
});

Route::get('/logout', function () {
    Auth::logout();
    Session::flash('success', 'Anda Telah Logout');
    return redirect('/');
});
