<?php

namespace App\Http\Controllers\foto;

use App\Foto;
use App\Petugas;
use App\Foto_file;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use PDF;

class FotoController extends Controller
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
        return view('foto.index', $data);
    }

    public function chart()
    {
        $tahun = date('Y');
        $data['jan'] = Foto::whereYear('tanggal', $tahun)->whereMonth('tanggal', '01')->count();
        $data['feb'] = Foto::whereYear('tanggal', $tahun)->whereMonth('tanggal', '02')->count();
        $data['mar'] = Foto::whereYear('tanggal', $tahun)->whereMonth('tanggal', '03')->count();
        $data['apr'] = Foto::whereYear('tanggal', $tahun)->whereMonth('tanggal', '04')->count();
        $data['mei'] = Foto::whereYear('tanggal', $tahun)->whereMonth('tanggal', '05')->count();
        $data['jun'] = Foto::whereYear('tanggal', $tahun)->whereMonth('tanggal', '06')->count();
        $data['jul'] = Foto::whereYear('tanggal', $tahun)->whereMonth('tanggal', '07')->count();
        $data['agt'] = Foto::whereYear('tanggal', $tahun)->whereMonth('tanggal', '08')->count();
        $data['sep'] = Foto::whereYear('tanggal', $tahun)->whereMonth('tanggal', '09')->count();
        $data['okt'] = Foto::whereYear('tanggal', $tahun)->whereMonth('tanggal', '10')->count();
        $data['nop'] = Foto::whereYear('tanggal', $tahun)->whereMonth('tanggal', '11')->count();
        $data['des'] = Foto::whereYear('tanggal', $tahun)->whereMonth('tanggal', '12')->count();
        return view('foto.chart', $data);
    }

    public function data(Request $request)
    {
        $orderBy = 'tbl_master_arsip_foto.id';
        switch ($request->input('order.0.column')) {
            case "0":
                $orderBy = 'tbl_master_arsip_foto.tanggal';
                break;
        }
        $data = Foto::select(['tbl_master_arsip_foto.*', 'tbl_master_petugas.nama as nama'])
            ->join('tbl_master_petugas', 'tbl_master_petugas.id', '=', 'tbl_master_arsip_foto.master_petugas_id');
        if ($request->input('search.value') != null) {
            $data = $data->where(function ($q) use ($request) {
                $q->whereRaw('LOWER(tbl_master_arsip_foto.id) like ?', ['%' . strtolower($request->input('search.value')) . '%'])
                    ->orWhereRaw('LOWER(tbl_master_arsip_foto.tanggal) like ?', ['%' . strtolower($request->input('search.value')) . '%']);
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
            $foto = DB::table('tbl_master_arsip_foto')->insertGetId([
                'tanggal' => $tanggal,
                'judul' => $request->input('judul'),
                'master_petugas_id' => $request->input('master_petugas_id'),
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);

            $keterangan = $request->input('keterangan');
            foreach ($request->file('nama_file') as $i => $nama_file) {
                $foto_file = DB::table('tbl_master_arsip_foto_file')->insertGetId([
                    'master_arsip_foto_id' => $foto,
                    'nama_file' => $nama_file->store('arsip_foto', 'public'),
                    'keterangan' => $keterangan[$i],
                    "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                    "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                ]);
            }
        });

        return response()->json(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Foto $foto)
    {
        $data['data'] = Foto::where('id', $request->input('id'))->get();
        return view('foto.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function edit(Foto $foto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foto $foto)
    {
        //
        $will_insert = $request->except(['_token']);

        $sasaran = Foto::where('id', $request->input('id'))->update($will_insert);
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Foto $foto)
    {
        //
        Foto::where('id', $request->input('id'))->delete();

        return response()->json(true);
    }

    public function download(Request $request, $id)
    {
        //
        $file = Foto_file::where('id', $id)->firstOrFail();

        return Storage::download($file->nama_file);
    }

    public function pdf(Request $request)
    {

        $data['foto'] = Foto::all();

        $pdf = PDF::loadview('foto/pdf', $data);
        return $pdf->download('Foto.pdf');
    }

    public function pdf_filter(Request $request)
    {

        $tanggal = strtotime($request->input('tanggal'));
        $date = date('Y-m-d', $tanggal);

        $query = Foto::select('tbl_master_arsip_foto.*');
        if ($request->input('tanggal') != null) {
            $query->where('tanggal', $date);
        }
        if ($request->input('judul') != null) {
            $query->where('judul', $request->input('judul'));
        }
        if ($request->input('master_petugas_id') != null) {
            $query->where('master_petugas_id', $request->input('master_petugas_id'));
        }

        $data['foto'] = $query->get();

        $pdf = PDF::loadview('foto/pdf', $data);
        return $pdf->download('Foto.pdf');
    }

    public function pdf_filter_bulan(Request $request)
    {

        $tanggal = strtotime($request->input('bulan'));
        $bulan = date('m', $tanggal);
        $tahun = date('Y', $tanggal);


        $query = Foto::select('tbl_master_arsip_foto.*');
        if ($request->input('bulan') != null) {
            $query->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun);
        }

        $data['foto'] = $query->get();

        $pdf = PDF::loadview('foto/pdf', $data);
        return $pdf->download('foto.pdf');
    }
}
