<?php

namespace App\Http\Controllers\petugas;

use App\Petugas;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('petugas.index');
    }

    public function data(Request $request)
    {
        $orderBy = 'tbl_master_petugas.id';
        switch ($request->input('order.0.column')) {
            case "0":
                $orderBy = 'tbl_master_petugas.nama';
                break;
        }
        $data = Petugas::select(['tbl_master_petugas.*']);
        if ($request->input('search.value') != null) {
            $data = $data->where(function ($q) use ($request) {
                $q->whereRaw('LOWER(tbl_master_petugas.nama) like ?', ['%' . strtolower($request->input('search.value')) . '%'])
                    ->orWhereRaw('LOWER(tbl_master_petugas.jabatan) like ?', ['%' . strtolower($request->input('search.value')) . '%']);
            });
        }

        // if ($request->input('kecamatan') != null) {
        //     $data = $data->where('tbl_master_inventaris_barang.kecamatan_id', $request->kecamatan);
        // }

        // if ($request->input('kategori') != null) {
        //     $data = $data->where('tbl_master_inventaris_barang.kategori', $request->kategori);
        // }
        // if ($request->input('kelompok') != null) {
        //     $data = $data->where('tbl_master_inventaris_barang.kelompok', $request->kelompok);
        // }


        $recordsFiltered = $data->get()->count();

        if ($request->input('length') != -1) $data = $data->skip($request->input('start'))->take($request->input('length'));

        $data = $data->orderBy($orderBy, $request->input('order.0.dir'))->get();

        $recordsTotal = $data->count();
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $will_insert = $request->except(['foto', '_token']);
        if ($request->hasFile('foto')) {
            $this->validate(
                $request,
                [
                    'foto' => 'mimes:jpg,jpeg,png',
                ],
                [
                    'foto.mimes' => 'Format Foto Salah',
                ]
            );

            $path_file = $request->file('foto')->store(
                'foto_petugas',
                'public'
            );

            $will_insert['foto'] = $path_file;
        }

        Petugas::create($will_insert);

        return response()->json(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function show(Petugas $petugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Petugas $petugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Petugas $petugas)
    {
        $will_insert = $request->except(['foto', '_token', '_method']);
        if ($request->hasFile('foto')) {
            $this->validate(
                $request,
                [
                    'foto' => 'mimes:jpg,jpeg,png',
                ],
                [
                    'foto.mimes' => 'Format Foto Salah',
                ]
            );

            $path_file = $request->file('foto')->store(
                'foto_petugas',
                'public'
            );

            $will_insert['foto'] = $path_file;
        }

        $petugas = Petugas::where('id', $request->input('id'))->update($will_insert);
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        Petugas::where('id', $request->input('id'))->delete();

        return response()->json(true);
    }

    public function pdf(Request $request)
    {

        $data['petugas'] = Petugas::all();

        $pdf = PDF::loadview('petugas/pdf', $data);
        return $pdf->download('Petugas.pdf');
    }

    public function pdf_detail(Request $request, $id)
    {

        $data['petugas'] = Petugas::where('id', $id)->get();

        $pdf = PDF::loadview('petugas/pdf_detail', $data);
        return $pdf->download('Biodata.pdf');
    }
}
