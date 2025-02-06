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

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user', [UserController::class, 'index']);
});

// Route::middleware(['auth', 'dpd'])->group(function () {
//     Route::get('/dpd', [DPDController::class, 'index']);
//     Route::get('/dpd/rfk', [RFKController::class, 'index']);
//     Route::get('/dpd/rfk/create', [RFKController::class, 'create']);
//     Route::post('/dpd/rfk/create', [RFKController::class, 'store']);
//     Route::get('/dpd/rfk/edit/{id}', [RFKController::class, 'edit']);
//     Route::post('/dpd/rfk/edit/{id}', [RFKController::class, 'update']);
//     Route::get('/dpd/rfk/delete/{id}', [RFKController::class, 'delete']);
//     Route::get('/dpd/rfk/detail/{id}/akun', [RFKController::class, 'akun']);

//     Route::get('/dpd/rfk/detail/{id}/okk', [RFKController::class, 'okk']);
//     Route::post('/dpd/rfk/detail/{id}/okk', [RFKController::class, 'okkStore']);
//     Route::get('/dpd/rfk/detail/{id}/okk/edit/{okk_id}', [RFKController::class, 'okkEdit']);
//     Route::post('/dpd/rfk/detail/{id}/okk/edit/{okk_id}', [RFKController::class, 'okkUpdate']);
//     Route::get('/dpd/rfk/detail/{id}/okk/delete/{okk_id}', [RFKController::class, 'okkDelete']);
//     Route::get('/dpd/rfk/detail/{id}/okk/sub/{okk_id}', [RFKController::class, 'okkSub']);
//     Route::post('/dpd/rfk/detail/{id}/okk/sub/{okk_id}', [RFKController::class, 'okkSubStore']);
//     Route::get('/dpd/rfk/detail/{id}/okk/sub/{okk_id}/delete/{sub_id}', [RFKController::class, 'okkSubDelete']);
//     Route::get('/dpd/rfk/detail/{id}/okk/sub/{okk_id}/edit/{sub_id}', [RFKController::class, 'okkSubEdit']);
//     Route::post('/dpd/rfk/detail/{id}/okk/sub/{okk_id}/edit/{sub_id}', [RFKController::class, 'okkSubUpdate']);

//     Route::get('/dpd/rfk/detail/{id}/hp', [RFKController::class, 'hp']);
//     Route::post('/dpd/rfk/detail/{id}/hp', [RFKController::class, 'hpStore']);
//     Route::get('/dpd/rfk/detail/{id}/hp/edit/{hp_id}', [RFKController::class, 'hpEdit']);
//     Route::post('/dpd/rfk/detail/{id}/hp/edit/{hp_id}', [RFKController::class, 'hpUpdate']);
//     Route::get('/dpd/rfk/detail/{id}/hp/delete/{hp_id}', [RFKController::class, 'hpDelete']);
//     Route::get('/dpd/rfk/detail/{id}/hp/sub/{hp_id}', [RFKController::class, 'hpSub']);
//     Route::post('/dpd/rfk/detail/{id}/hp/sub/{hp_id}', [RFKController::class, 'hpSubStore']);
//     Route::get('/dpd/rfk/detail/{id}/hp/sub/{hp_id}/delete/{sub_id}', [RFKController::class, 'hpSubDelete']);
//     Route::get('/dpd/rfk/detail/{id}/hp/sub/{hp_id}/edit/{sub_id}', [RFKController::class, 'hpSubEdit']);
//     Route::post('/dpd/rfk/detail/{id}/hp/sub/{hp_id}/edit/{sub_id}', [RFKController::class, 'hpSubUpdate']);


//     Route::get('/dpd/rfk/detail/{id}/pp', [RFKController::class, 'pp']);
//     Route::get('/dpd/rfk/detail/{id}/kdln', [RFKController::class, 'kdln']);
//     Route::get('/dpd/rfk/detail/{id}/diklat', [RFKController::class, 'diklat']);
//     Route::get('/dpd/rfk/detail/{id}/penelitian', [RFKController::class, 'penelitian']);
//     Route::get('/dpd/rfk/detail/{id}/sisinfokom', [RFKController::class, 'sisinfokom']);
//     Route::get('/dpd/rfk/detail/{id}/pelayanan', [RFKController::class, 'pelayanan']);
//     Route::get('/dpd/rfk/detail/{id}/kesejahteraan', [RFKController::class, 'kesejahteraan']);
// });
Route::middleware(['auth', 'dpd'])->group(function () {
    Route::get('/dpd', [DPDController::class, 'index']);
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

    Route::get('/dpw/aset', [DPWController::class, 'aset']);
    Route::get('/dpw/aset/create', [DPWController::class, 'aset_create']);
    Route::post('/dpw/aset/create', [DPWController::class, 'aset_store']);
    Route::get('/dpw/aset/edit/{id}', [DPWController::class, 'aset_edit']);
    Route::post('/dpw/aset/edit/{id}', [DPWController::class, 'aset_update']);
    Route::get('/dpw/aset/delete/{id}', [DPWController::class, 'aset_delete']);

    Route::get('/dpw/keuangan', [DPWController::class, 'keuangan']);
    Route::get('/dpw/keuangan/create', [DPWController::class, 'keuangan_create']);
    Route::post('/dpw/keuangan/create', [DPWController::class, 'keuangan_store']);
    Route::get('/dpw/keuangan/edit/{id}', [DPWController::class, 'keuangan_edit']);
    Route::post('/dpw/keuangan/edit/{id}', [DPWController::class, 'keuangan_update']);
    Route::get('/dpw/keuangan/delete/{id}', [DPWController::class, 'keuangan_delete']);
});

Route::get('/logout', function () {
    Auth::logout();
    Session::flash('success', 'Anda Telah Logout');
    return redirect('/');
});
