<?php

namespace App\Exports;

use App\Models\Dpd;
use App\Models\Dpk;
use App\Models\Dpw;
use App\Models\Keuangan;
use PHPUnit\Event\Event;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Concerns\FromCollection;

class KeuanganExport implements WithEvents
{
    protected $mulai;
    protected $sampai;

    public function __construct($mulai, $sampai)
    {
        $this->mulai = $mulai;
        $this->sampai = $sampai;
    }

    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function (BeforeWriting $event) {
                // Load the template
                $templatePath = public_path('ppni/template.xlsx');
                $spreadsheet = IOFactory::load($templatePath);
                $sheet = $spreadsheet->getActiveSheet();

                $mulai = $this->mulai;
                $sampai = $this->sampai;

                $dpw = Dpw::where('bidang', 'KEBENDAHARAAN / KEUANGAN')->get()->map(function ($item) use ($mulai, $sampai) {
                    $item->penerimaan = DB::table('keuangan')
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->where('user_id', $item->user_id)
                        ->value(DB::raw('SUM(masuk)'));
                    $item->pengeluaran = DB::table('keuangan')
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->where('user_id', $item->user_id)
                        ->value(DB::raw('SUM(keluar)'));

                    $pajak = Keuangan::where('user_id',   $item->user_id)->whereBetween('created_at', [
                        $mulai . ' 00:00:00',
                        $sampai . ' 23:59:59'
                    ])->orderBy('created_at', 'asc')->get();

                    $pajak->each(function ($keuangan) use (&$saldo) {
                        $pajak = 0;
                        if (!is_null($keuangan->pajak)) {
                            $persenPajak = floatval($keuangan->nilai_pajak) / 100;
                            if ($keuangan->masuk > 0) {
                                $pajak = $keuangan->masuk * $persenPajak;
                            } elseif ($keuangan->keluar > 0) {
                                $pajak = $keuangan->keluar * $persenPajak;
                            }
                        } else {
                        }

                        $keuangan->nilai_pajak = $pajak;
                    });

                    $item->pajak = $pajak->sum('nilai_pajak');

                    return $item;
                });

                $dpd = Dpd::where('bidang', 'KEBENDAHARAAN / KEUANGAN')->get()->map(function ($item) use ($mulai, $sampai) {
                    $item->penerimaan = DB::table('keuangan')
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->where('user_id', $item->user_id)
                        ->value(DB::raw('SUM(masuk)'));
                    $item->pengeluaran = DB::table('keuangan')
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->where('user_id', $item->user_id)
                        ->value(DB::raw('SUM(keluar)'));

                    $pajak = Keuangan::where('user_id',   $item->user_id)->whereBetween('created_at', [
                        $mulai . ' 00:00:00',
                        $sampai . ' 23:59:59'
                    ])->orderBy('created_at', 'asc')->get();

                    $pajak->each(function ($keuangan) use (&$saldo) {
                        $pajak = 0;
                        if (!is_null($keuangan->pajak)) {
                            $persenPajak = floatval($keuangan->nilai_pajak) / 100;
                            if ($keuangan->masuk > 0) {
                                $pajak = $keuangan->masuk * $persenPajak;
                            } elseif ($keuangan->keluar > 0) {
                                $pajak = $keuangan->keluar * $persenPajak;
                            }
                        } else {
                        }

                        $keuangan->nilai_pajak = $pajak;
                    });

                    $item->pajak = $pajak->sum('nilai_pajak');
                    return $item;
                });
                $dpk = Dpk::where('bidang', 'KEBENDAHARAAN / KEUANGAN')->get()->map(function ($item) use ($mulai, $sampai) {
                    $item->penerimaan = DB::table('keuangan')
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->where('user_id', $item->user_id)
                        ->value(DB::raw('SUM(masuk)'));
                    $item->pengeluaran = DB::table('keuangan')
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->where('user_id', $item->user_id)
                        ->value(DB::raw('SUM(keluar)'));

                    $pajak = Keuangan::where('user_id',   $item->user_id)->whereBetween('created_at', [
                        $mulai . ' 00:00:00',
                        $sampai . ' 23:59:59'
                    ])->orderBy('created_at', 'asc')->get();

                    $pajak->each(function ($keuangan) use (&$saldo) {
                        $pajak = 0;
                        if (!is_null($keuangan->pajak)) {
                            $persenPajak = floatval($keuangan->nilai_pajak) / 100;
                            if ($keuangan->masuk > 0) {
                                $pajak = $keuangan->masuk * $persenPajak;
                            } elseif ($keuangan->keluar > 0) {
                                $pajak = $keuangan->keluar * $persenPajak;
                            }
                        } else {
                        }

                        $keuangan->nilai_pajak = $pajak;
                    });

                    $item->pajak = $pajak->sum('nilai_pajak');
                    return $item;
                });

                $row = 12; // Mulai dari baris 5 misalnya
                foreach ($dpw as $item) {
                    $sheet->setCellValue("A{$row}", $item->id);
                    $sheet->setCellValue("B{$row}", $item->nama);
                    $row++;
                }

                $filename = 'laporan-keuangan-' . now()->format('YmdHis') . '.xlsx';
                $folderPath = storage_path('app/temp');

                // Cek dan buat folder jika belum ada
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0755, true);
                }

                $tempPath = $folderPath . '/' . $filename;
                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
                $writer->save($tempPath);

                return $tempPath;
            },
        ];
    }
}
