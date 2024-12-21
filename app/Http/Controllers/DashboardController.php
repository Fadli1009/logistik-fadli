<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Barang::selectRaw('DATE(created_at) as tanggal, SUM(qty) as total_qty')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();
        $dataKeluar = BarangKeluar::selectRaw('DATE(created_at) as tanggal, SUM(qty) as total_qty')
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();
        $dataGabungan = $data->pluck('tanggal')->merge($dataKeluar->pluck('tanggal'));
        $tanggalArray = [];
        $barangMasukData = [];
        $barangKeluarData = [];
        foreach ($data as $item) {
            $tanggalArray[$item->tanggal] = true;
            $barangMasukData[$item->tanggal] = $item->total_qty;
        }
        foreach ($dataKeluar as $item) {
            $tanggalArray[$item->tanggal] = true;
            $barangKeluarData[$item->tanggal] = $item->total_qty;
        }
        $finalTanggal = [];
        $finalBarangMasukData = [];
        $finalBarangKeluarData = [];
        foreach (array_keys($tanggalArray) as $tanggal) {
            $finalTanggal[] = Carbon::parse($tanggal)->format('Y-m-d');
            $finalBarangMasukData[] = $barangMasukData[$tanggal] ?? 0;
            $finalBarangKeluarData[] = $barangKeluarData[$tanggal] ?? 0;
        }
        $total = 0;
        $stok = Barang::sum('qty');
        $ttlBarang = Barang::count();
        // $totalPengeluaran = 0;
        // foreach ($data as $item) {
        //     $total += $item->total_qty;
        //     // $totalPengeleuaran += $item->total_qty;
        // }
        // foreach ($dataKeluar as $item) {

        //     $totalPengeluaran += $item->total_qty;
        // }
        return view('pages.home', compact('data', 'dataKeluar', 'total', 'stok', 'ttlBarang', 'dataGabungan', 'finalBarangMasukData', 'finalBarangKeluarData', 'finalTanggal'));
    }
}
