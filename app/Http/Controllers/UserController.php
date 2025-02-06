<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengajuan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        return view('user.home');
    }
    public function create()
    {

        return view('superadmin.user.create');
    }
    public function store(Request $req)
    {
        $check = User::where('username', $req->username)->first();
        if ($check == null) {
            if ($req->password1 != $req->password2) {
                $req->flash();
                Session::flash('warning', 'password tidak sama');
                return back();
            } else {
                $new = new User();
                $new->name = $req->name;
                $new->username = $req->username;
                $new->password = Hash::make($req->password1);
                $new->roles = $req->roles;
                $new->save();
                Session::flash('success', 'Berhasil');
                return redirect('/superadmin/user');
            }
        } else {
            $req->flash();
            Session::flash('warning', 'username sudah ad');
            return back();
        }
    }
    public function edit($id)
    {
        $data = User::find($id);
        return view('superadmin.user.edit', compact('data'));
    }
    public function update(Request $req, $id)
    {
        if ($req->password1 == null) {
            $data = User::find($id);
            $data->name = $req->name;
            $data->roles = $req->roles;
            $data->save();
            Session::flash('success', 'berhasil diupdate');
            return redirect('/superadmin/user');
        } else {
            if ($req->password1 != $req->password2) {
                Session::flash('warning', 'password tidak sama');
                return back();
            } else {
                $data = User::find($id);
                $data->name = $req->name;
                $data->roles = $req->roles;
                $data->password = Hash::make($req->password1);
                $data->save();
                Session::flash('success', 'berhasil diupdate');
                return redirect('/superadmin/user');
            }
        }
    }
    public function delete($id)
    {
        User::find($id)->delete();
        Session::flash('success', 'berhasil dihapus');
        return redirect('/superadmin/user');
    }

    public function pengajuan()
    {
        $data = Pengajuan::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('user.pengajuan.index', compact('data'));
    }
    public function pengajuan_create()
    {
        return view('user.pengajuan.create');
    }
    public function pengajuan_store(Request $req)
    {
        $param = $req->all();
        $param['user_id'] = Auth::user()->id;
        Pengajuan::create($param);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/user/pengajuan');
    }
    public function pengajuan_edit($id)
    {
        $data = Pengajuan::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('user.pengajuan.edit', compact('data'));
    }
    public function pengajuan_update(Request $req, $id)
    {
        $data = Pengajuan::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/user/pengajuan');
    }
    public function pengajuan_delete($id)
    {
        $data = Pengajuan::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/user/pengajuan');
    }

    public function pengajuan_upload($id)
    {
        $data = Pengajuan::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        return view('user.pengajuan.upload', compact('data'));
    }

    public function pengajuan_upload_store(Request $req, $id)
    {
        $filename = Str::random(20) . '.' . $req->file('file')->getClientOriginalExtension();

        Pengajuan::find($id)->update([
            'file1' => $filename
        ]);

        $file = $req->file('file');
        $filePath = $file->store("uploads/user_$id", 'public'); // Simpan sesuai ID pengguna

        return response()->json([
            'message' => 'File uploaded successfully',
            'file' => asset('storage/' . $filePath),
            'user_id' => $id
        ]);
    }
}
