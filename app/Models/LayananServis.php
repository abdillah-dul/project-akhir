<?php

namespace App\Models;

use Database\Factories\LayananServisFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananServis extends Model
{
    /** @use HasFactory<LayananServisFactory> */
    use HasFactory;

    protected $table = 'layanan_servis';

    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'estimasi_menit',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'harga' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }
}
