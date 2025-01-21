<?php

namespace App\Console\Commands;

use App\Models\Dpw;
use App\Models\Kota;
use App\Models\User;
use App\Models\Bidang;
use App\Models\Dpd;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UserDpw extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:user-dpw';

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
        $bidangList = Bidang::get();

        foreach ($bidangList as $bidang) {
            $check = Dpw::where('bidang', $bidang->nama)->first();
            if ($check == null) {
                $new = new Dpw();
                $new->nama = 'DPW KALSEL';
                $new->bidang = $bidang->nama;
                $new->save();

                $checkUser = User::where('username', '6271' . $new->id)->first();
                if ($checkUser == null) {
                    $n = new User();
                    $n->username = '6271' . $new->id;
                    $n->name = $new->nama . ' ' . $new->bidang;
                    $n->password = Hash::make('admindpw');
                    $n->roles = 'dpw';
                    $n->save();

                    $new->update(['user_id' => $n->id]);
                } else {
                    $checkUser->update([
                        'name' => $new->nama . ' ' . $new->bidang
                    ]);
                }
            } else {
                $check->user->update(['name' => 'DPW ' . $bidang->nama]);
            }
        }
    }
}
