<?php

namespace Database\Seeders;

use App\Models\LayananServis;
use Illuminate\Database\Seeder;

class LayananServisSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            [
                'nama' => 'Ganti Oli',
                'deskripsi' => 'Penggantian oli mesin dan pemeriksaan dasar kendaraan.',
                'harga' => 250000,
                'estimasi_menit' => 45,
            ],
            [
                'nama' => 'Tune Up',
                'deskripsi' => 'Pemeriksaan dan penyetelan komponen mesin agar performa tetap optimal.',
                'harga' => 450000,
                'estimasi_menit' => 90,
            ],
            [
                'nama' => 'Inspeksi Kendaraan',
                'deskripsi' => 'Pemeriksaan menyeluruh kondisi kendaraan oleh teknisi.',
                'harga' => 300000,
                'estimasi_menit' => 60,
            ],
        ] as $layanan) {
            LayananServis::query()->firstOrCreate(
                ['nama' => $layanan['nama']],
                $layanan + ['is_active' => true],
            );
        }
    }
}
