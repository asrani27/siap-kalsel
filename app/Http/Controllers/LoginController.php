<?php

namespace App\Http\Controllers;

use App\Models\Dpd;
use App\Models\Dpk;
use App\Models\Dpw;
use App\Models\Kota;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function getDpk($kota_id)
    {
        // Ambil daftar kota berdasarkan provinsi_id
        $dpk = Dpk::where('kota', $kota_id)->where('bidang', null)->get();

        // Mengembalikan data sebagai response JSON
        return response()->json($dpk);
    }
    public function home()
    {
        return view('home');
    }
    public function masuk()
    {
        return view('masuk');
    }
    public function daftar()
    {
        return view('daftar');
    }
    public function index()
    {
        if (Auth::check()) {
            $role = Auth::user()->roles;
            $routes = [
                'superadmin' => '/superadmin',
                'dpw' => '/dpw',
                'dpd' => '/dpd',
                'dpk' => '/dpk',
            ];

            if (array_key_exists($role, $routes)) {
                Session::flash('success', 'Selamat Datang');
                return redirect($routes[$role]);
            }

            // Jika role tidak ada di routes, logout dan kembali ke login
            Auth::logout();
            Session::flash('error', 'Role tidak valid. Silakan login ulang.');
            return redirect('login');
        }

        $kota = Kota::get();
        $bidang = Bidang::get();
        return view('login2', compact('kota', 'bidang'));
    }
    public function login(Request $req)
    {
        if ($req->dpw == null) {
            if ($req->dpd == 'DPD') {
                $username = Dpd::where('kota', $req->kota)->where('bidang', $req->bidang)->first()->user->username;
            } else {
                $username = Dpk::where('nama', $req->dpd)->where('kota', $req->kota)->where('bidang', $req->bidang)->first()->user->username;
            }
        } else {
            $username = Dpw::where('bidang', $req->bidang)->first()->user->username;
        }

        $param['username'] = $username;
        $param['password'] = $req->password;

        $remember = $req->remember ? true : false;
        $credential = $req->only('username', 'password');

        if (Auth::attempt($param, $remember)) {
            $role = Auth::user()->roles;
            $routes = [
                'superadmin' => '/superadmin',
                'dpw' => '/dpw',
                'dpd' => '/dpd',
                'dpk' => '/dpk',
            ];

            if (array_key_exists($role, $routes)) {
                Session::flash('success', 'Selamat Datang');
                return redirect($routes[$role]);
            }

            // Jika role tidak ada di routes, logout dan kembali ke login
            Auth::logout();
            Session::flash('error', 'Role tidak valid. Silakan login ulang.');
            return redirect('login');
        } else {

            Session::flash('error', 'username/password salah');
            $req->flash();
            return back();
        }
        //         }
        //     }
    }
}
