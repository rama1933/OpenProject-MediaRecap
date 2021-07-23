<?php

namespace App\Http\Controllers\permohonan;

use App\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use PDF;

class PermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('permohonan.index');
    }

    public function chart()
    {
        $tahun = date('Y');
        $data['jan'] = Permohonan::whereYear('tanggal', $tahun)->whereMonth('tanggal', '01')->count();
        $data['feb'] = Permohonan::whereYear('tanggal', $tahun)->whereMonth('tanggal', '02')->count();
        $data['mar'] = Permohonan::whereYear('tanggal', $tahun)->whereMonth('tanggal', '03')->count();
        $data['apr'] = Permohonan::whereYear('tanggal', $tahun)->whereMonth('tanggal', '04')->count();
        $data['mei'] = Permohonan::whereYear('tanggal', $tahun)->whereMonth('tanggal', '05')->count();
        $data['jun'] = Permohonan::whereYear('tanggal', $tahun)->whereMonth('tanggal', '06')->count();
        $data['jul'] = Permohonan::whereYear('tanggal', $tahun)->whereMonth('tanggal', '07')->count();
        $data['agt'] = Permohonan::whereYear('tanggal', $tahun)->whereMonth('tanggal', '08')->count();
        $data['sep'] = Permohonan::whereYear('tanggal', $tahun)->whereMonth('tanggal', '09')->count();
        $data['okt'] = Permohonan::whereYear('tanggal', $tahun)->whereMonth('tanggal', '10')->count();
        $data['nop'] = Permohonan::whereYear('tanggal', $tahun)->whereMonth('tanggal', '11')->count();
        $data['des'] = Permohonan::whereYear('tanggal', $tahun)->whereMonth('tanggal', '12')->count();
        return view('permohonan.chart', $data);
    }

    public function data(Request $request)
    {
        $orderBy = 'tbl_master_permohonan_data.id';
        switch ($request->input('order.0.column')) {
            case "0":
                $orderBy = 'tbl_master_permohonan_data.tanggal';
                break;
        }
        $data = Permohonan::select(['tbl_master_permohonan_data.*']);
        if ($request->input('search.value') != null) {
            $data = $data->where(function ($q) use ($request) {
                $q->whereRaw('LOWER(tbl_master_permohonan_data.id) like ?', ['%' . strtolower($request->input('search.value')) . '%'])
                    ->orWhereRaw('LOWER(tbl_master_permohonan_data.tanggal) like ?', ['%' . strtolower($request->input('search.value')) . '%']);
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

        DB::transaction(function () use ($request) {
            $str = strtotime($request->input('tanggal'));
            $tanggal = date('Y-m-d', $str);
            $foto = DB::table('tbl_master_permohonan_data')->insertGetId([
                'tanggal' => $tanggal,
                'nama_pemohon' => $request->input('nama_pemohon'),
                'nik' => $request->input('nik'),
                'alamat' => $request->input('alamat'),
                'pekerjaan' => $request->input('pekerjaan'),
                'no_hp' => $request->input('no_hp'),
                'nama_data' => $request->input('nama_data'),
                'ket' => $request->input('ket'),
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
        });

        return response()->json(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function show(Permohonan $permohonan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function edit(Permohonan $permohonan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permohonan $permohonan)
    {
        //
        $will_insert = $request->except(['_token']);

        $sasaran = Permohonan::where('id', $request->input('id'))->update($will_insert);
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        Permohonan::where('id', $request->input('id'))->delete();

        return response()->json(true);
    }

    public function pdf(Request $request)
    {

        $data['permohonan'] = Permohonan::all();

        $pdf = PDF::loadview('permohonan/pdf', $data);
        return $pdf->download('Permohonan.pdf');
    }

    public function pdf_filter(Request $request)
    {

        $tanggal = strtotime($request->input('tanggal'));
        $date = date('Y-m-d', $tanggal);

        $query = Permohonan::select('tbl_master_permohonan_data.*');
        if ($request->input('tanggal') != null) {
            $query->where('tanggal', $date);
        }
        if ($request->input('nama_pemohon') != null) {
            $query->where('nama_pemohon', $request->input('nama_pemohon'));
        }

        if ($request->input('nik') != null) {
            $query->where('nik', $request->input('nik'));
        }

        if ($request->input('nama_data') != null) {
            $query->where('nama_data', $request->input('nama_data'));
        }


        $data['permohonan'] = $query->get();

        $pdf = PDF::loadview('permohonan/pdf', $data);
        return $pdf->download('Permohonan.pdf');
    }

    public function pdf_filter_bulan(Request $request)
    {

        $tanggal = strtotime($request->input('bulan'));
        $bulan = date('m', $tanggal);
        $tahun = date('Y', $tanggal);


        $query = Permohonan::select('tbl_master_permohonan_data.*');
        if ($request->input('bulan') != null) {
            $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }

        $data['permohonan'] = $query->get();

        $pdf = PDF::loadview('permohonan/pdf', $data);
        return $pdf->download('Permohonan.pdf');
    }
}
