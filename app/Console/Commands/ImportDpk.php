<?php

namespace App\Console\Commands;

use App\Models\Dpk;
use Illuminate\Console\Command;

class ImportDpk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-dpk';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Daftar bidang yang akan diimport
        $bidangList = [
            'ORGANISASI DAN KADERISASI',
            'BIDANG HUKUM DAN PERUNDANG-UNDANGAN',
            'BIDANG PEMBERDAYAAN POLITIK',
            'BIDANG KERJA SAMA DLN',
            'DIKLAT',
            'PENELITIAN',
            'SISINFOKOM',
            'PELAYANAN',
            'KESEJAHTERAAN',
            'KESEKRETARIATAN',
            'KEBENDAHARAAN / KEUANGAN',
        ];

        // Ambil semua data DPK sekali saja.
        $dpkList = Dpk::where('bidang',null)->get();

        // Iterasi setiap bidang
        foreach ($bidangList as $bidang) {
            foreach ($dpkList as $item) {
                // Cek apakah data sudah ada untuk bidang ini
                $exists = Dpk::where('nama', $item->nama)
                    ->where('kota', $item->kota)
                    ->where('provinsi', $item->provinsi)
                    ->where('bidang', $bidang)
                    ->exists();

                // Jika tidak ada, buat data baru
                if (!$exists) {
                    Dpk::create([
                        'nama' => $item->nama,
                        'kota' => $item->kota,
                        'provinsi' => $item->provinsi,
                        'bidang' => $bidang,
                    ]);
                }
            }
        }
    }
}
