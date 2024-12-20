<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Barang::select('created_at')
            ->selectRaw('SUM(qty) as total_qty')
            ->groupBy('created_at')
            ->orderBy('created_at', 'desc')
            ->get();
        $dataKeluar = BarangKeluar::select('created_at')
            ->selectRaw('SUM(qty) as total_qty')
            ->groupBy('created_at')
            ->orderBy('created_at', 'desc')
            ->get();
        $total = 0;
        $stok = Barang::sum('qty');
        $ttlBarang = Barang::count();
        $totalPengeluaran = 0;
        foreach ($data as $item) {
            $total += $item->total_qty;
            // $totalPengeleuaran += $item->total_qty;
        }
        foreach ($dataKeluar as $item) {

            $totalPengeluaran += $item->total_qty;
        }

        return view('pages.home', compact('data', 'dataKeluar', 'total', 'totalPengeluaran', 'stok', 'ttlBarang'));
    }
}
