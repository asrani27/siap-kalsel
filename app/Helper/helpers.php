<?php

use Carbon\Carbon;
use App\Models\COA;
use App\Models\Skpd;
use App\Models\Bidang;
use App\Models\Invoice;
use App\Models\Pengajuan;


function bulan()
{
    Carbon::setLocale('id');
    // Array untuk menyimpan nama bulan
    $namaBulan = [];

    // Loop untuk mendapatkan nama semua bulan
    for ($i = 1; $i <= 12; $i++) {
        $namaBulan[] = Carbon::createFromDate(2024, $i, 1)->translatedFormat('F');
    }

    return $namaBulan;
}

function invoice($id)
{
    return Invoice::where('pengajuan_id', $id)->get();
}
function baru()
{
    return Pengajuan::where('proses1', null)->count();
}
function diproses()
{
    return Pengajuan::where('proses1', '!=', null)->where('link_lms', null)->count();
}
function selesai()
{
    return Pengajuan::where('link_lms', '!=', null)->count();
}
function bidang()
{
    return Bidang::get();
}
function skpd()
{
    return Skpd::get();
}

function coa()
{
    return COA::get();
}
function coa_name($coa)
{
    return COA::where('kode', $coa)->first();
}
