<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\LayananServisController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemesananServisController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'home'])->name('home');
Route::get('/inventory', [GuestController::class, 'inventory'])->name('inventory.index');

Route::get('/admin', function () {
    return view('Admin.dashboard');
});

Route::resource('pelanggan', PelangganController::class);
Route::resource('barang', BarangController::class);
Route::resource('kendaraan', KendaraanController::class);
Route::resource('layanan', LayananServisController::class)
    ->parameters(['layanan' => 'layananServis'])
    ->except('show');
Route::resource('pemesanan-servis', PemesananServisController::class)
    ->parameters(['pemesanan-servis' => 'pemesananServis'])
    ->except('show');
Route::resource('users', UserController::class)->except('show');
