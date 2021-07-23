<?php

namespace App\Http\Controllers\otentikasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class OtentikasiController extends Controller
{
    use AuthenticatesUsers;
    //
    public function index()
    {

        return view('otentikasi.login');
    }

    public function login(Request $request)
    {

        // $data = User::where('email',$request->email)->firstOrFail();
        // if ($data) {
        //     if (Hash::check($request->password,$data->password)) {
        //         session(['berhasil_login'=>true]);
        //         return redirect('/dashboard');
        //     }
        // }
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect('/arsip');
        }
        return redirect('/')->with('message', 'Username atau Password Salah');
    }

    public function logout(Request $request)
    {
        // $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
