<?php

namespace App\Http\Controllers;

use App\Models\Dpd;
use App\Models\Dpk;
use App\Models\Dpw;
use App\Models\Kota;
use App\Models\User;
use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function getDpk($kota_id)
    {
        // Ambil daftar kota berdasarkan provinsi_id
        $dpk = Dpk::where('kota', 'LIKE', '%' . $kota_id . '%')->where('bidang', null)->get();

        // Mengembalikan data sebagai response JSON
        return response()->json($dpk);
    }
    public function home()
    {
        return view('home');
    }
    public function masuk()
    {
        if (Auth::check()) {
            return redirect('/user');
        }
        return view('masuk');
    }
    public function daftar()
    {
        return view('daftar');
    }
    public function storeDaftar(Request $req)
    {
        $checkNIK = User::where('username', $req->nik)->first();
        if ($checkNIK != null) {
            Session::flash('error', 'NIK sudah terdaftar, silahkan gunakan NIK lain');
            $req->flash();
            return back();
        }
        $checkEmail = User::where('email', $req->email)->first();
        if ($checkEmail != null) {
            Session::flash('error', 'Email sudah terdaftar, silahkan gunakan Email lain');
            $req->flash();
            return back();
        }
        if ($req->password != $req->confirm_password) {
            Session::flash('error', 'Password dan Confirm Password Tidak Sama');
            $req->flash();
            return back();
        }

        $new = new User();
        $new->name = $req->name;
        $new->username = $req->nik;
        $new->password = Hash::make($req->password);
        $new->email = $req->email;
        $new->roles = 'user';
        $new->save();

        // Login otomatis
        Auth::login($new);

        // Redirect ke home
        return redirect('/user');
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
                'pusbangdiklat' => '/pusbangdiklat',
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

    public function storeMasuk(Request $req)
    {
        $remember = $req->remember ? true : false;
        $credential = $req->only('username', 'password');

        if (Auth::attempt($credential, $remember)) {
            Session::flash('success', 'Selamat Datang');
            return redirect('/user');
        } else {
            Session::flash('error', 'username/password salah');
            $req->flash();
            return back();
        }
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
            if ($req->dpw === 'PUSBANGDIKLAT') {
                $username = 'pusbangdiklat';
            } elseif ($req->dpw === 'superadmin') {
                $username = 'superadmin';
            } else {
                $username = Dpw::where('bidang', $req->bidang)->first()->user->username;
            }
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
                'pusbangdiklat' => '/pusbangdiklat',
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
    }
}
