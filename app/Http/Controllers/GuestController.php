<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GuestController extends Controller
{
    public function home(): View
    {
        $merekList = Kendaraan::query()->distinct()->orderBy('merek')->pluck('merek');
        $kondisiList = Kendaraan::query()->distinct()->orderBy('kondisi')->pluck('kondisi');
        $vehicleCount = Kendaraan::query()->count();
        $minimumPrice = (float) (Kendaraan::query()->min('harga') ?? 0);
        $maximumPrice = max((float) (Kendaraan::query()->max('harga') ?? 0) * 2, 10000000);

        return view('Guest.home', [
            'featuredVehicles' => Kendaraan::query()->latest()->limit(3)->get(),
            'merekList' => $merekList,
            'kondisiList' => $kondisiList,
            'vehicleCount' => $vehicleCount,
            'calculatorPrice' => $minimumPrice,
            'calculatorMaxPrice' => $maximumPrice,
            'stats' => [
                ['number' => $vehicleCount, 'label' => 'Kendaraan tersedia'],
                ['number' => $merekList->count(), 'label' => 'Merek kendaraan'],
                ['number' => $kondisiList->count(), 'label' => 'Pilihan kondisi'],
                ['number' => Kendaraan::query()->max('tahun') ?? 0, 'label' => 'Tahun terbaru'],
            ],
        ]);
    }

    public function inventory(Request $request): View
    {
        $filters = $request->validate([
            'nama_kendaraan' => ['nullable', 'string', 'max:100'],
            'merek' => ['nullable', 'string', 'max:50'],
            'max_price' => ['nullable', 'numeric', 'min:0'],
            'kondisi' => ['nullable', 'string', 'max:20'],
            'sort' => ['nullable', 'in:featured,price-asc,price-desc,year-desc'],
        ]);

        $query = Kendaraan::query();

        if (! empty($filters['nama_kendaraan'])) {
            $query->where('nama_kendaraan', 'like', '%'.$filters['nama_kendaraan'].'%');
        }

        if (! empty($filters['merek'])) {
            $query->where('merek', $filters['merek']);
        }

        if (isset($filters['max_price'])) {
            $query->where('harga', '<=', $filters['max_price']);
        }

        if (! empty($filters['kondisi'])) {
            $query->where('kondisi', $filters['kondisi']);
        }

        match ($filters['sort'] ?? null) {
            'price-asc' => $query->orderBy('harga'),
            'price-desc' => $query->orderByDesc('harga'),
            'year-desc' => $query->orderByDesc('tahun'),
            default => $query->latest(),
        };

        return view('Guest.inventory', [
            'kendaraan' => $query->get(),
            'kondisiList' => Kendaraan::query()->distinct()->orderBy('kondisi')->pluck('kondisi'),
        ]);
    }
}
