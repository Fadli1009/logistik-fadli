<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
// use Barryvdh\DomPDF\Facade\Pdf;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::all();
        $dataBarangKeluar = BarangKeluar::orderBy('id', 'desc')->with('barang')->get();
        return view('pages.barang-keluar.index', compact('barang', 'dataBarangKeluar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'id_barang' => 'required',
            'qty' => 'required|numeric',
            'destination' => 'required|max:100',
            'stokBarang' => 'nullable',
        ], [
            'id_barang.required' => 'Pilih barang terlebih dahulu',
            'qty.numeric' => 'QTY harus berformat numeric',
            'qty.required' => 'Jumlah barang yang dikeluarkan harus diisi',
            'destination.required' => 'Tujuan pengiriman harus diisi',
            'destination.max' => 'Tujuan pengiriman maksimal 100 karakter'
        ]);
        $barang = Barang::find($val['id_barang']);
        $hasilKurang = $barang->qty - $val['qty'];

        if ($val['stokBarang'] < $val['qty']) {
            return redirect()->back()->with('error', 'Stok tidak cukup')->withInput();
        } else {
            $barang->update([
                'qty' => max(0, $hasilKurang)
            ]);
        }
        BarangKeluar::create($val);
        return redirect()->route('barangKeluar.index')->with('success', 'Data barang keluar berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        $val = $request->validate([
            'id_barang' => 'required',
            'qty' => 'required|numeric',
            'destination' => 'required|max:100'
        ], [
            'id_barang.required' => 'Pilih barang terlebih dahulu',
            'qty.numeric' => 'QTY harus berformat numeric',
            'qty.required' => 'Jumlah barang yang dikeluarkan harus diisi',
            'destination.required' => 'Tujuan pengiriman harus diisi',
            'destination.max' => 'Tujuan pengiriman maksimal 100 karakter'
        ]);
        $barang = Barang::find($val['id_barang']);
        $hasilKurang = $barang->qty - $val['qty'];
        // dd($barang->qty);
        if ($barang['qty'] < $val['qty']) {
            return redirect()->back()->with('error', 'Stok tidak cukup')->withInput();
        } else {
            $barang->update([
                'qty' => max(0, $hasilKurang)
            ]);
        }
        $barangKeluar->update($val);
        return redirect()->route('barangKeluar.index')->with('success', 'Barang keluar berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        $barangKeluar->delete();
        return redirect()->route('barangKeluar.index')->with('success', 'Data barang keluar berhasil dihapus');
    }
    public function getById(Request $request)
    {
        $id = $request->input('id_barang');
        $data = Barang::find($id);
        if ($data) {
            return response()->json(["status" => True, "data" => $data]);
        } else {
            return response()->json(["status" => False, "data" => $data]);
        }
    }
    public function getBarangKeluar(Request $request)
    {
        $id = $request->input('id');
        $data = BarangKeluar::find($id);
        if ($data) {
            return response()->json(["status" => True, "data" => $data]);
        } else {
            return response()->json(["status" => False, "data" => $data]);
        }
    }


    public function printKeluar(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $dataBarangKeluar = BarangKeluar::orderBy('id', 'desc')->with('barang')->get();
        $pdf = Pdf::loadView('pages.barang-keluar.laporan', ['dataBarangKeluar' => $dataBarangKeluar, 'startDate' => $startDate, 'endDate' => $endDate]);
        return $pdf->download('datapengeluaranbarang.pdf');
        // return view('pages.barang-keluar.laporan', compact('dataBarangKeluar'));
    }

    public function filterBarangKeluar(Request $request)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $request->startDate)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $request->endDate)->endOfDay();
        $barang = Barang::all();
        $dataBarangKeluar = BarangKeluar::whereBetween('created_at', [$startDate, $endDate])->with('barang')->get();
        if ($dataBarangKeluar->isEmpty()) {
            return redirect()->route('barangKeluar.index')->with('warning', 'Tidak ada data pengeluaran barang pada tanggal yang dipilih');
        }
        // $pdf = Pdf::loadView('pages.barang-keluar.laporan', ['dataBarangKeluar' => $dataBarangKeluar]);
        // return $pdf->download('datapengeluaran-tanggal.pdf');
        return view('pages.barang-keluar.filter', compact('startDate', 'endDate', 'dataBarangKeluar', 'barang'));
    }
    public function printbarangKeluar(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $dataBarangKeluar = BarangKeluar::whereBetween('created_at', [$startDate, $endDate])->with('barang')->get();
        $pdf = Pdf::loadView('pages.barang-keluar.laporanFilter', ['dataBarangKeluar' => $dataBarangKeluar, 'startDate' => $startDate, 'endDate' => $endDate]);
        return $pdf->download('datapengeluaran-tanggal.pdf');
    }
}
