<?php

namespace App\Console\Commands;

use App\Models\Dpd;
use App\Models\Dpk;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UserDpk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:user-dpk';

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
        $dpkList = Dpk::where('bidang', '!=', null)->get();

        foreach ($dpkList as $item) {
            
            $check = User::where('username', '63' . $item->id)->first();
            
            if ($check == null) {
                $n = new User();
                $n->username = '63' . $item->id;
                $n->name = $item->nama;
                $n->password = Hash::make('admindpk');
                $n->roles = 'dpk';
                $n->save();

                $item->update(['user_id' => $n->id]);
            } else {
            }
        }
    }
}
