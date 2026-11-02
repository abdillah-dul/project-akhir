<?php

namespace App\Http\Controllers;

use App\Models\LayananServis;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class LayananServisController extends Controller
{
    public function index(): View
    {
        return view('Admin.layanan.index', [
            'layanan' => LayananServis::query()->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('Admin.layanan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        LayananServis::query()->create($this->validatedData($request));

        return redirect()->route('layanan.index')->with('success', 'Layanan servis berhasil ditambahkan.');
    }

    public function edit(LayananServis $layananServis): View
    {
        return view('Admin.layanan.edit', ['layanan' => $layananServis]);
    }

    public function update(Request $request, LayananServis $layananServis): RedirectResponse
    {
        $layananServis->update($this->validatedData($request, $layananServis));

        return redirect()->route('layanan.index')->with('success', 'Layanan servis berhasil diperbarui.');
    }

    public function destroy(LayananServis $layananServis): RedirectResponse
    {
        if (DB::table('pemesanan_servis')->where('layanan_servis_id', $layananServis->id)->exists()) {
            return redirect()->route('layanan.index')
                ->with('error', 'Layanan tidak dapat dihapus karena sudah digunakan pada pemesanan servis.');
        }

        $layananServis->delete();

        return redirect()->route('layanan.index')->with('success', 'Layanan servis berhasil dihapus.');
    }

    /**
     * @return array{nama: string, deskripsi: string, harga: numeric-string|int|float, estimasi_menit: int, is_active: bool}
     */
    private function validatedData(Request $request, ?LayananServis $layananServis = null): array
    {
        return $request->validate([
            'nama' => [
                'required',
                'string',
                'max:100',
                Rule::unique('layanan_servis', 'nama')->ignore($layananServis?->id),
            ],
            'deskripsi' => ['required', 'string', 'max:1000'],
            'harga' => ['required', 'numeric', 'min:0'],
            'estimasi_menit' => ['required', 'integer', 'min:15', 'max:1440'],
            'is_active' => ['required', 'boolean'],
        ]);
    }
}
