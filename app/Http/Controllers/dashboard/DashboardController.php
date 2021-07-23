<?php

namespace App\Http\Controllers\dashboard;

use App\Barang;
use App\Petugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kliping;
use App\Permohonan;

class DashboardController extends Controller
{
    public function index()
    {
        $data['petugas'] = Petugas::count();
        $data['barang'] = Barang::count();
        $data['kliping'] = Kliping::count();
        $data['permohonan'] = Permohonan::count();
        return view('dashboard.index', $data);
    }
}
