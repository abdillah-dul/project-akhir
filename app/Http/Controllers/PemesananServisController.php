<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PemesananServisController extends Controller
{
    private const STATUSES = ['Menunggu', 'Dikonfirmasi', 'Selesai', 'Dibatalkan'];

    public function index(): View
    {
        $pemesananServis = DB::table('pemesanan_servis')
            ->join('pelanggan', 'pelanggan.id', '=', 'pemesanan_servis.pelanggan_id')
            ->join('kendaraan', 'kendaraan.id', '=', 'pemesanan_servis.kendaraan_id')
            ->join('layanan_servis', 'layanan_servis.id', '=', 'pemesanan_servis.layanan_servis_id')
            ->select(
                'pemesanan_servis.*',
                'pelanggan.nama as nama_pelanggan',
                'kendaraan.nama_kendaraan',
                'layanan_servis.nama as nama_layanan',
            )
            ->orderByDesc('pemesanan_servis.tanggal_servis')
            ->paginate(10);

        return view('Admin.pemesanan-servis.index', [
            'pemesananServis' => $pemesananServis,
        ]);
    }

    public function create(): View
    {
        return view('Admin.pemesanan-servis.create', $this->formOptions());
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $now = now();

        DB::table('pemesanan_servis')->insert([
            ...$data,
            'biaya' => $this->servicePrice($data['layanan_servis_id']),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return redirect()->route('pemesanan-servis.index')
            ->with('success', 'Pemesanan servis berhasil ditambahkan.');
    }

    public function edit(int $pemesananServis): View
    {
        $booking = DB::table('pemesanan_servis')->where('id', $pemesananServis)->firstOrFail();

        return view('Admin.pemesanan-servis.edit', [
            ...$this->formOptions(),
            'pemesananServis' => $booking,
        ]);
    }

    public function update(Request $request, int $pemesananServis): RedirectResponse
    {
        $data = $this->validatedData($request);
        $booking = DB::table('pemesanan_servis')->where('id', $pemesananServis)->firstOrFail();

        DB::table('pemesanan_servis')->where('id', $pemesananServis)->update([
            ...$data,
            'biaya' => (int) $booking->layanan_servis_id === (int) $data['layanan_servis_id']
                ? $booking->biaya
                : $this->servicePrice($data['layanan_servis_id']),
            'updated_at' => now(),
        ]);

        return redirect()->route('pemesanan-servis.index')
            ->with('success', 'Pemesanan servis berhasil diperbarui.');
    }

    public function destroy(int $pemesananServis): RedirectResponse
    {
        $deletedRows = DB::table('pemesanan_servis')->where('id', $pemesananServis)->delete();

        if ($deletedRows === 0) {
            return redirect()->route('pemesanan-servis.index')
                ->with('error', 'Pemesanan servis tidak ditemukan atau sudah dihapus.');
        }

        return redirect()->route('pemesanan-servis.index')
            ->with('success', 'Pemesanan servis berhasil dihapus.');
    }

    /**
     * @return array{customers: Collection, vehicles: Collection, services: Collection, statuses: array<int, string>}
     */
    private function formOptions(): array
    {
        return [
            'customers' => DB::table('pelanggan')->orderBy('nama')->get(['id', 'nama']),
            'vehicles' => DB::table('kendaraan')->orderBy('nama_kendaraan')->get(['id', 'nama_kendaraan']),
            'services' => DB::table('layanan_servis')->orderBy('nama')->get(['id', 'nama', 'harga']),
            'statuses' => self::STATUSES,
        ];
    }

    /**
     * @return array{pelanggan_id: int, kendaraan_id: int, layanan_servis_id: int, tanggal_servis: string, keluhan: string, status: string}
     */
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'pelanggan_id' => ['required', 'integer', 'exists:pelanggan,id'],
            'kendaraan_id' => ['required', 'integer', 'exists:kendaraan,id'],
            'layanan_servis_id' => ['required', 'integer', 'exists:layanan_servis,id'],
            'tanggal_servis' => ['required', 'date'],
            'keluhan' => ['required', 'string', 'max:1000'],
            'status' => ['required', 'in:'.implode(',', self::STATUSES)],
        ]);
    }

    private function servicePrice(int $serviceId): string
    {
        return (string) DB::table('layanan_servis')->where('id', $serviceId)->firstOrFail()->harga;
    }
}
