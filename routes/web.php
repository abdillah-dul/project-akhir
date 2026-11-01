<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PelangganController;
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
Route::resource('users', UserController::class)->except('show');
