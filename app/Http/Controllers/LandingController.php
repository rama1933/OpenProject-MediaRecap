<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Tamu;
use File;

class LandingController extends Controller
{
    //
    public function index() {
        return view('landing/landing2');
    }

    public function store(Request $request)
    {
           $will_insert = $request->except(['foto','_token']);

           if ($request->hasFile('foto')) {
            $this->validate($request, [
                'foto' => 'max:2000',
            ],
            [
                'foto.max' => 'Maksimal 2 Mb',
            ]

        );
            $path_file = $request->file('foto')->store(
                'foto','public'
            );

            $will_insert['foto']=$path_file;
            }

             $tamu = Tamu::create($will_insert);

             return redirect()->back()->with('message','Berhasil menyimpan data');
    }

}
