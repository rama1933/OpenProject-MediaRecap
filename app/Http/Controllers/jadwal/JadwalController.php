<?php

namespace App\Http\Controllers\jadwal;

use App\Jadwal;
use App\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use PDF;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['petugas'] = Petugas::all();
        $data['petugas2'] = Petugas::all();
        $data['petugas3'] = Petugas::all();
        $data['editor'] = Petugas::all();
        $data['editor2'] = Petugas::all();
        $data['editor3'] = Petugas::all();
        return view('jadwal.index', $data);
    }

    public function chart()
    {
        $tahun = date('Y');
        $data['jan'] = Jadwal::whereYear('tanggal', $tahun)->whereMonth('tanggal', '01')->count();
        $data['feb'] = Jadwal::whereYear('tanggal', $tahun)->whereMonth('tanggal', '02')->count();
        $data['mar'] = Jadwal::whereYear('tanggal', $tahun)->whereMonth('tanggal', '03')->count();
        $data['apr'] = Jadwal::whereYear('tanggal', $tahun)->whereMonth('tanggal', '04')->count();
        $data['mei'] = Jadwal::whereYear('tanggal', $tahun)->whereMonth('tanggal', '05')->count();
        $data['jun'] = Jadwal::whereYear('tanggal', $tahun)->whereMonth('tanggal', '06')->count();
        $data['jul'] = Jadwal::whereYear('tanggal', $tahun)->whereMonth('tanggal', '07')->count();
        $data['agt'] = Jadwal::whereYear('tanggal', $tahun)->whereMonth('tanggal', '08')->count();
        $data['sep'] = Jadwal::whereYear('tanggal', $tahun)->whereMonth('tanggal', '09')->count();
        $data['okt'] = Jadwal::whereYear('tanggal', $tahun)->whereMonth('tanggal', '10')->count();
        $data['nop'] = Jadwal::whereYear('tanggal', $tahun)->whereMonth('tanggal', '11')->count();
        $data['des'] = Jadwal::whereYear('tanggal', $tahun)->whereMonth('tanggal', '12')->count();
        return view('jadwal.chart', $data);
    }

    public function data(Request $request)
    {
        $orderBy = 'tbl_master_peliputan.id';
        switch ($request->input('order.0.column')) {
            case "0":
                $orderBy = 'tbl_master_peliputan.tanggal';
                break;
        }
        $data = Jadwal::select(['tbl_master_peliputan.*', 'tbl_master_petugas.nama as nama', 'editor.nama as nama_editor'])
            ->join('tbl_master_petugas', 'tbl_master_petugas.id', '=', 'tbl_master_peliputan.master_petugas_id')
            ->join('tbl_master_petugas as editor', 'editor.id', '=', 'tbl_master_peliputan.master_petugas_editor_id');
        if ($request->input('search.value') != null) {
            $data = $data->where(function ($q) use ($request) {
                $q->whereRaw('LOWER(tbl_master_peliputan.id) like ?', ['%' . strtolower($request->input('search.value')) . '%'])
                    ->orWhereRaw('LOWER(tbl_master_peliputan.tanggal) like ?', ['%' . strtolower($request->input('search.value')) . '%']);
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
            $foto = DB::table('tbl_master_peliputan')->insertGetId([
                'tanggal' => $tanggal,
                'jam' => $request->input('jam'),
                'tempat' => $request->input('tempat'),
                'nama_kegiatan' => $request->input('nama_kegiatan'),
                'master_petugas_id' => $request->input('master_petugas_id'),
                'master_petugas_editor_id' => $request->input('master_petugas_editor_id'),
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
        });

        return response()->json(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        //
        $will_insert = $request->except(['_token']);

        $sasaran = Jadwal::where('id', $request->input('id'))->update($will_insert);
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Jadwal::where('id', $request->input('id'))->delete();

        return response()->json(true);
    }

    public function pdf(Request $request)
    {

        $data['jadwal'] = Jadwal::all();

        $pdf = PDF::loadview('jadwal/pdf', $data);
        return $pdf->download('Jadwal.pdf');
    }

    public function pdf_filter(Request $request)
    {

        $tanggal = strtotime($request->input('tanggal'));
        $date = date('Y-m-d', $tanggal);

        $query = Jadwal::select('tbl_master_peliputan.*');
        if ($request->input('tanggal') != null) {
            $query->where('tanggal', $date);
        }
        if ($request->input('tempat') != null) {
            $query->where('tempat', $request->input('tempat'));
        }

        if ($request->input('nama_kegiatan') != null) {
            $query->where('nama_kegiatan', $request->input('nama_kegiatan'));
        }

        if ($request->input('master_petugas_id') != null) {
            $query->where('master_petugas_id', $request->input('master_petugas_id'));
        }

        if ($request->input('master_editor_petugas_id') != null) {
            $query->where('master_editor_petugas_id', $request->input('master_editor_petugas_id'));
        }

        $data['jadwal'] = $query->get();

        $pdf = PDF::loadview('jadwal/pdf', $data);
        return $pdf->download('Jadwal.pdf');
    }

    public function pdf_filter_bulan(Request $request)
    {

        $tanggal = strtotime($request->input('bulan'));
        $bulan = date('m', $tanggal);
        $tahun = date('Y', $tanggal);


        $query = Jadwal::select('tbl_master_peliputan.*');
        if ($request->input('bulan') != null) {
            $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }

        $data['jadwal'] = $query->get();

        $pdf = PDF::loadview('jadwal/pdf', $data);
        return $pdf->download('Jadwal.pdf');
    }
}
