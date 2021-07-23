<?php

namespace App\Http\Controllers\kategori;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $data['data'] = Kategori::all();
        return view('kategori.index', $data);
    }

    public function index_tambah()
    {
        return view('kategori.index_tambah');
    }

    public function index_edit(Request $request, $id)
    {
        $data['data'] = Kategori::where('id', $id)
            ->get();

        return view('kategori.index_edit', $data);
    }

    public function store(Request $request)
    {
        $will_insert = $request->except(['_token']);

        $kategori = Kategori::create($will_insert);

        return redirect('kategori')->with('message', 'Berhasil menyimpan data');
    }

    public function update(Request $request)
    {
        $will_insert = $request->except(['_token', '_method']);

        $kategori = Kategori::where('id', $request->input('id'))->update($will_insert);
        // return response()->json(true);
        return redirect('kategori')->with('message', 'Berhasil menyimpan data');
    }

    public function hapus(Request $request, $id)
    {
        // hapus file
        $kategori = Kategori::where('id', $id)->first();

        // hapus data
        Kategori::where('id', $id)->delete();

        return redirect()->back()->with('message', 'Berhasil menghapus data');
    }
}
