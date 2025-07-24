<?php

namespace App\Console\Commands;

use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class JamCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:jam-command';

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
        $keuangan = Keuangan::get();
        foreach ($keuangan as $key => $item) {

            // Ambil tanggal dari created_at
            $tanggal = Carbon::parse($item->created_at)->format('Y-m-d');

            // Buat jam, menit, dan detik random
            $jam    = rand(0, 23);
            $menit  = rand(0, 59);
            $detik  = rand(0, 59);

            // Gabungkan tanggal + jam random
            $item->created_at = Carbon::parse($tanggal)
                ->setTime($jam, $menit, $detik);

            $item->save();
        }
    }
}
