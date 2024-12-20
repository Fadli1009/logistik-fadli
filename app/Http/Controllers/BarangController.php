<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::orderBy('id', 'desc')->get();
        $lastCode = DB::table('barang')->orderBy('id', 'desc')->value('kodeBarang');
        $cekBarang = Barang::where('qty', 0)->count();
        if (!$lastCode) {
            $kodeBarang = "B000001";
        } else {
            $lastNumber = (int)substr($lastCode, 1);
            $kodeBarang = "B" . str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        }

        return view('pages.barang-masuk.index', compact('barang', 'kodeBarang', 'cekBarang'));
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
            'nomorSeri' => 'required',
            'kodeBarang' => 'required',
            'qty' => 'required|numeric',
            'origin' => 'required'
        ], [
            'nomorSeri.required' => 'Nomor Seri Wajib diisi',
            'kodeBarang.required' => 'Kode Barang Wajib diisi',
            'qty.required' => 'Jumlah Wajib diisi',
            'qty.numeric' => 'Jumlah Harus Angka',
            'origin.required' => 'Asal Barang Harus Dipilih'
        ]);
        Barang::create($val);
        return redirect()->route('barang.index')->with('success', 'Data Barang Masuk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $val = $request->validate([
            'nomorSeri' => 'required',
            'kodeBarang' => 'required',
            'qty' => 'required|numeric',
            'origin' => 'required'
        ], [
            'nomorSeri.required' => 'Nomor Seri Wajib diisi',
            'kodeBarang.required' => 'Kode Barang Wajib diisi',
            'qty.required' => 'Jumlah Wajib diisi',
            'qty.numeric' => 'Jumlah Harus Angka',
            'origin.required' => 'Asal Barang Harus Dipilih'
        ]);
        $barang->update($val);
        return redirect()->route('barang.index')->with('success', 'Data Barang Masuk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Data Barang Masuk berhasil dihapus');
    }
}
