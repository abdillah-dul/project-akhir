<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraan = Kendaraan::latest()->get();
        return view('Admin.kendaraan.index', compact('kendaraan'));
    }

    public function create()
    {
        return view('Admin.kendaraan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kendaraan' => 'required|string|max:100',
            'merek' => 'required|string|max:50',
            'tahun' => 'required|integer|min:1900|max:2026',
            'harga' => 'required|numeric|min:0',
            'kondisi' => 'required|string|max:20',
        ]);

        Kendaraan::create($data);

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil ditambahkan!');
    }

    public function edit(Kendaraan $kendaraan)
    {
        return view('Admin.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan)
    {
        $data = $request->validate([
            'nama_kendaraan' => 'required|string|max:100',
            'merek' => 'required|string|max:50',
            'tahun' => 'required|integer|min:1900|max:2026',
            'harga' => 'required|numeric|min:0',
            'kondisi' => 'required|string|max:20',
        ]);

        $kendaraan->update($data);

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil diperbarui!');
    }

    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')
            ->with('success', 'Data kendaraan berhasil dihapus!');
    }
}
