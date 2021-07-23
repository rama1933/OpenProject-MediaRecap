<?php

namespace App\Http\Controllers\arsip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Arsip;
use App\User;
use App\Kategori;
use PDF;

class ArsipController extends Controller
{

    public function index()
    {
        $data['data'] = '';
        if (auth()->user()->id == 1) {
            $data['data'] = Arsip::select(['tbl_master_arsip.*', 'tbl_master_kategori.nama_kategori as nama_kategori', 'users.nama as nama'])
                ->join('tbl_master_kategori', 'tbl_master_kategori.id', '=', 'tbl_master_arsip.kategori_id')
                ->join('users', 'users.id', '=', 'tbl_master_arsip.user_id')
                ->get();
        } else {
            $data['data'] = Arsip::select(['tbl_master_arsip.*', 'tbl_master_kategori.nama_kategori as nama_kategori', 'users.nama as nama'])
                ->join('tbl_master_kategori', 'tbl_master_kategori.id', '=', 'tbl_master_arsip.kategori_id')
                ->join('users', 'users.id', '=', 'tbl_master_arsip.user_id')
                ->where('user_id', auth()->user()->id)
                ->get();
        }

        $data['user'] = User::where('role', 'user')->get();
        $data['kategori'] = Kategori::all();
        return view('arsip.index', $data);
    }

    public function index_tambah()
    {
        $data['data'] = User::where('role', 'user')->get();

        $data['kategori'] = Kategori::all();

        return view('arsip.index_tambah', $data);
    }

    public function index_tambah_user()
    {
        $data['kategori'] = Kategori::all();
        return view('arsip.index_tambah_user', $data);
    }

    public function index_edit(Request $request, $id)
    {
        $data['data'] = Arsip::select(['tbl_master_arsip.*', 'tbl_master_kategori.nama_kategori as nama_kategori', 'users.nama as nama'])
            ->join('tbl_master_kategori', 'tbl_master_kategori.id', '=', 'tbl_master_arsip.kategori_id')
            ->join('users', 'users.id', '=', 'tbl_master_arsip.user_id')
            ->where('tbl_master_arsip.id', $id)
            ->get();

        $data['user'] = User::where('role', 'user')->get();

        $data['kategori'] = Kategori::all();
        return view('arsip.index_edit', $data);
    }


    public function index_edit_user(Request $request, $id)
    {
        $data['data'] = Arsip::select(['tbl_master_arsip.*', 'tbl_master_kategori.nama_kategori as nama_kategori', 'users.nama as nama'])
            ->join('tbl_master_kategori', 'tbl_master_kategori.id', '=', 'tbl_master_arsip.kategori_id')
            ->join('users', 'users.id', '=', 'tbl_master_arsip.user_id')
            ->where('tbl_master_arsip.id', $id)
            ->get();

        $data['kategori'] = Kategori::all();
        return view('arsip.index_edit_user', $data);
    }

    public function store(Request $request)
    {
        $will_insert = $request->except(['foto', 'tanggal', '_token']);
        $tanggal = strtotime($request->input('tanggal'));
        $will_insert['tanggal'] = date('Y-m-d', $tanggal);

        $arsip = Arsip::create($will_insert);

        return redirect('arsip')->with('message', 'Berhasil menyimpan data');
    }

    public function update(Request $request)
    {
        $will_insert = $request->except(['foto', 'tanggal', '_token', '_method']);
        $tanggal = strtotime($request->input('tanggal'));
        $will_insert['tanggal'] = date('Y-m-d', $tanggal);


        $arsip = Arsip::where('id', $request->input('id'))->update($will_insert);
        // return response()->json(true);
        return redirect('arsip')->with('message', 'Berhasil menyimpan data');
    }

    public function hapus(Request $request, $id)
    {
        // hapus file
        $arsip = Arsip::where('id', $id)->first();

        // hapus data
        Arsip::where('id', $id)->delete();

        return redirect()->back()->with('message', 'Berhasil menghapus data');
    }

    public function pdf(Request $request)
    {

        $query = Arsip::select(['tbl_master_arsip.*', 'tbl_master_kategori.nama_kategori as nama_kategori', 'users.nama as nama'])
            ->join('tbl_master_kategori', 'tbl_master_kategori.id', '=', 'tbl_master_arsip.kategori_id')
            ->join('users', 'users.id', '=', 'tbl_master_arsip.user_id');

        if ($request->input('petugas') != null) {
            $query->where('tbl_master_arsip.user_id', $request->input('petugas'));
        }
        if ($request->input('tanggal') != null) {
            $query->where('tbl_master_arsip.tanggal', $request->input('tanggal'));
        }
        if ($request->input('tahun') != null) {
            $query->whereYear('tbl_master_arsip.tanggal', $request->input('tahun'));
        }
        if ($request->input('kategori') != null) {
            $query->where('tbl_master_arsip.kategori_id', $request->input('kategori'));
        }

        $data['data'] = $query->get();
        $pdf = PDF::loadview('arsip.indexpdf', $data)->setPaper('a4', 'landscape');
        return $pdf->download('arsip_video.pdf');
    }
}
