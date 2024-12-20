<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StokBarangController;
use App\Http\Controllers\BarangKeluarController;

Route::get('/', action: [DashboardController::class, 'index']);

Route::resource('barang', BarangController::class);
Route::resource('barangKeluar', BarangKeluarController::class);
Route::post('/getData', [BarangKeluarController::class, 'getById'])->name('getById');
Route::post('/getBarangKeluar', [BarangKeluarController::class, 'getBarangKeluar'])->name('getBarangKeluar');

Route::get('/stokbarang', [StokBarangController::class, 'index']);
Route::get('/print', [BarangKeluarController::class, 'printKeluar'])->name('printBarangKeluar');
Route::get('/printbarang', [BarangController::class, 'print']);
Route::get('/printbarangFilter', [BarangController::class, 'printFilter'])->name('printFilter');
Route::get('/printbarangKeluar', [BarangKeluarController::class, 'printbarangKeluar'])->name('printFilterBarangs');

Route::get('/filterdate', [BarangController::class, 'filterDate'])->name('filterDate');
Route::get('/filterBarangKeluar', [BarangKeluarController::class, 'filterBarangKeluar'])->name('filterBarangKeluar');
