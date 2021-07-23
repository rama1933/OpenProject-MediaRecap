<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use File;

class UserController extends Controller
{
    //
    public function index()
    {
        $data['user'] = User::where('role', 'admin')->get();
        return view('user.index', $data);
    }

    public function index_tambah()
    {

        return view('user.index_tambah');
    }

    public function index_edit(Request $request, $id)
    {
        $data['user'] = User::where('id', $id)->get();
        return view('user.index_edit', $data);
    }

    public function ubah_password(Request $request)
    {
        $data['user'] = User::where('id', auth()->user()->id)->get();
        return view('user.ubah_password', $data);
    }

    public function store(Request $request)
    {
        $user = new \App\User;
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->role = $request->role;
        $user->password = bcrypt($request->input('password'));
        $user->assignRole($request->role);
        $user->save();

        return redirect('user')->with('message', 'Berhasil menyimpan data');
    }

    public function update(Request $request)
    {
        $will_insert = $request->except(['password', '_token', '_method']);
        $will_insert['password'] = bcrypt($request->input('password'));

        $user = User::where('id', $request->input('id'))->update($will_insert);
        // return response()->json(true);
        return redirect('user')->with('message', 'Berhasil mengubah password');
    }

    public function update_user(Request $request)
    {
        $will_insert = $request->except(['password', '_token', '_method']);
        $will_insert['password'] = bcrypt($request->input('password'));

        $user = User::where('id', $request->input('id'))->update($will_insert);
        // return response()->json(true);
        return redirect()->back()->with('message', 'Berhasil mengubah password');
    }

    public function hapus(Request $request, $id)
    {
        // hapus file
        $user = User::where('id', $id)->first();

        User::where('id', $id)->delete();

        return redirect()->back()->with('message', 'Berhasil menghapus data');
    }
}
