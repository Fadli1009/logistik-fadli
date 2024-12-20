<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';
    protected $fillable = ['id_barang', 'qty', 'destination'];
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang',ownerKey: 'id');
    }
}
