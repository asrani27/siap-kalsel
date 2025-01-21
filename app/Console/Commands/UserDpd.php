<?php

namespace App\Console\Commands;

use App\Models\Dpd;
use App\Models\Kota;
use App\Models\User;
use App\Models\Bidang;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UserDpd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:user-dpd';

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
        $kotaList = Kota::get();

        foreach ($bidangList as $bidang) {
            foreach ($kotaList as $kota) {
                $check = Dpd::where('bidang', $bidang->nama)->where('kota', $kota->nama)->first();
                if ($check == null) {
                    $new = new Dpd();
                    $new->nama = 'DPD';
                    $new->bidang = $bidang->nama;
                    $new->kota = $kota->nama;
                    $new->save();

                    $checkUser = User::where('username', '6471' . $new->id)->first();
                    if ($checkUser == null) {
                        $n = new User();
                        $n->username = '6271' . $new->id;
                        $n->name = $new->nama . ' ' . $new->kota;
                        $n->password = Hash::make('admindpd');
                        $n->roles = 'dpd';
                        $n->save();

                        $new->update(['user_id' => $n->id]);
                    } else {
                        $checkUser->update([
                            'name' => $new->nama . ' ' . $new->kota
                        ]);
                        $new->update(['user_id' => $checkUser->id]);
                    }
                } else {
                    $check->user->update(['name' => 'DPD ' . $kota->nama]);
                }
            }
        }
    }
}
