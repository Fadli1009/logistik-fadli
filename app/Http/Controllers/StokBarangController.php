<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokBarangController extends Controller
{
    public function index()
    {
        $dataMasuk = Barang::selectRaw('DATE(created_at) as tanggal, SUM(qty) as total_brng_masuk')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();
        $dataKeluar = BarangKeluar::selectRaw('DATE(created_at) as tanggal, SUM(qty) as total_brng_keluar')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('pages.stokbarang.index', compact('dataMasuk', 'dataKeluar'));
    }
}
