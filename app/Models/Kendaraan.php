<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';

    protected $fillable = [
        'nama_kendaraan',
        'merek',
        'tahun',
        'harga',
        'kondisi',
    ];
}
