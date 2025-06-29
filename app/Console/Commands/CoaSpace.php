<?php

namespace App\Console\Commands;

use App\Models\COA;
use Illuminate\Console\Command;

class CoaSpace extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:coa-space';

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
        $data = COA::get();
        foreach ($data as $item) {
            $item->kode = trim($item->kode);
            $item->save();
        }
    }
}
