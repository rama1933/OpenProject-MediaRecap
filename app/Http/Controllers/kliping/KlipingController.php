<?php

namespace App\Http\Controllers\kliping;

use App\Kliping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use PDF;

class KlipingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kliping.index');
    }

    public function chart()
    {
        $tahun = date('Y');
        $data['jan'] = Kliping::whereYear('tanggal', $tahun)->whereMonth('tanggal', '01')->sum('jumlah');
        $data['feb'] = Kliping::whereYear('tanggal', $tahun)->whereMonth('tanggal', '02')->sum('jumlah');
        $data['mar'] = Kliping::whereYear('tanggal', $tahun)->whereMonth('tanggal', '03')->sum('jumlah');
        $data['apr'] = Kliping::whereYear('tanggal', $tahun)->whereMonth('tanggal', '04')->sum('jumlah');
        $data['mei'] = Kliping::whereYear('tanggal', $tahun)->whereMonth('tanggal', '05')->sum('jumlah');
        $data['jun'] = Kliping::whereYear('tanggal', $tahun)->whereMonth('tanggal', '06')->sum('jumlah');
        $data['jul'] = Kliping::whereYear('tanggal', $tahun)->whereMonth('tanggal', '07')->sum('jumlah');
        $data['agt'] = Kliping::whereYear('tanggal', $tahun)->whereMonth('tanggal', '08')->sum('jumlah');
        $data['sep'] = Kliping::whereYear('tanggal', $tahun)->whereMonth('tanggal', '09')->sum('jumlah');
        $data['okt'] = Kliping::whereYear('tanggal', $tahun)->whereMonth('tanggal', '10')->sum('jumlah');
        $data['nop'] = Kliping::whereYear('tanggal', $tahun)->whereMonth('tanggal', '11')->sum('jumlah');
        $data['des'] = Kliping::whereYear('tanggal', $tahun)->whereMonth('tanggal', '12')->sum('jumlah');
        return view('kliping.chart', $data);
    }

    public function data(Request $request)
    {
        $orderBy = 'tbl_master_kliping.id';
        switch ($request->input('order.0.column')) {
            case "0":
                $orderBy = 'tbl_master_kliping.tanggal';
                break;
        }
        $data = Kliping::select(['tbl_master_kliping.*']);
        if ($request->input('search.value') != null) {
            $data = $data->where(function ($q) use ($request) {
                $q->whereRaw('LOWER(tbl_master_kliping.tanggal) like ?', ['%' . strtolower($request->input('search.value')) . '%'])
                    ->orWhereRaw('LOWER(tbl_master_kliping.nama) like ?', ['%' . strtolower($request->input('search.value')) . '%']);
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
        $file = [
            'nama_file.*' => 'mimes:jpg,jpeg,png',
        ];
        $file_val = validator()->make(request()->all(), $file);
        if ($file_val->fails()) {
            return response()->json('file');
        }

        DB::transaction(function () use ($request) {
            $str = strtotime($request->input('tanggal'));
            $tanggal = date('Y-m-d', $str);
            $foto = DB::table('tbl_master_kliping')->insertGetId([
                'tanggal' => $tanggal,
                'nama' => $request->input('nama'),
                'jumlah' => $request->input('jumlah'),

                // 'master_petugas_id' => $request->input('master_petugas_id'),
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
        });

        return response()->json(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kliping  $kliping
     * @return \Illuminate\Http\Response
     */
    public function show(Kliping $kliping)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kliping  $kliping
     * @return \Illuminate\Http\Response
     */
    public function edit(Kliping $kliping)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kliping  $kliping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kliping $kliping)
    {
        //
        $will_insert = $request->except(['_token']);

        $sasaran = Kliping::where('id', $request->input('id'))->update($will_insert);
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kliping  $kliping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        Kliping::where('id', $request->input('id'))->delete();

        return response()->json(true);
    }

    public function pdf(Request $request)
    {

        $data['kliping'] = Kliping::all();

        $pdf = PDF::loadview('kliping/pdf', $data);
        return $pdf->download('Kliping.pdf');
    }

    public function pdf_filter(Request $request)
    {

        $tanggal = strtotime($request->input('tanggal'));
        $date = date('Y-m-d', $tanggal);

        $query = Kliping::select('tbl_master_kliping.*');
        if ($request->input('tanggal') != null) {
            $query->where('tanggal', $date);
        }
        if ($request->input('nama') != null) {
            $query->where('nama', $request->input('nama'));
        }

        $data['kliping'] = $query->get();

        $pdf = PDF::loadview('kliping/pdf', $data);
        return $pdf->download('Kliping.pdf');
    }

    public function pdf_filter_bulan(Request $request)
    {

        $tanggal = strtotime($request->input('bulan'));
        $bulan = date('m', $tanggal);
        $tahun = date('Y', $tanggal);


        $query = Kliping::select('tbl_master_kliping.*');
        if ($request->input('bulan') != null) {
            $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }

        $data['kliping'] = $query->get();

        $pdf = PDF::loadview('kliping/pdf', $data);
        return $pdf->download('Kliping.pdf');
    }
}
