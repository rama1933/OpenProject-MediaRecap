<?php

namespace App\Http\Controllers\barang;

use App\Barang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('barang.index');
    }

    public function chart()
    {
        $data['foto'] = Barang::where('kategori', 1)->sum('stok');
        $data['video'] = Barang::where('kategori', 2)->sum('stok');
        $data['tripod'] = Barang::where('kategori', 3)->sum('stok');
        $data['drone'] = Barang::where('kategori', 4)->sum('stok');
        return view('barang.chart', $data);
    }

    public function data(Request $request)
    {
        $orderBy = 'tbl_master_inventaris_barang.id';
        switch ($request->input('order.0.column')) {
            case "0":
                $orderBy = 'tbl_master_inventaris_barang.id_barang';
                break;
        }
        $data = Barang::select(['tbl_master_inventaris_barang.*']);
        if ($request->input('search.value') != null) {
            $data = $data->where(function ($q) use ($request) {
                $q->whereRaw('LOWER(tbl_master_inventaris_barang.id_barang) like ?', ['%' . strtolower($request->input('search.value')) . '%'])
                    ->orWhereRaw('LOWER(tbl_master_inventaris_barang.kategori) like ?', ['%' . strtolower($request->input('search.value')) . '%']);
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
        Barang::create($request->all());

        return response()->json(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $will_insert = $request->except(['_token']);

        $sasaran = Barang::where('id', $request->input('id'))->update($will_insert);
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        Barang::where('id', $request->input('id'))->delete();

        return response()->json(true);
    }

    public function pdf(Request $request)
    {

        $data['barang'] = Barang::all();

        $pdf = PDF::loadview('barang/pdf', $data);
        return $pdf->download('Barang.pdf');
    }

    public function pdf_filter(Request $request)
    {

        $query = Barang::select('tbl_master_inventaris_barang.*');
        if ($request->input('id_barang') != null) {
            $query->where('id_barang', $request->input('id_barang'));
        }
        if ($request->input('kategori') != null) {
            $query->where('kategori', $request->input('kategori'));
        }
        if ($request->input('nama') != null) {
            $query->where('nama', $request->input('nama'));
        }
        if ($request->input('kondisi') != null) {
            $query->where('kondisi', $request->input('kondisi'));
        }
        if ($request->input('pemakai') != null) {
            $query->where('pemakai', $request->input('pemakai'));
        }


        $data['barang'] = $query->get();

        $pdf = PDF::loadview('barang/pdf', $data);
        return $pdf->download('Barang.pdf');
    }
}
