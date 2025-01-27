<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function detailPembelian()
    {
        return $this->hasMany(DetailPembelian::class);
    }
}
