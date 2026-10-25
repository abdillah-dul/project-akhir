<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Guest.home');
});

Route::get('/admin', function () {
    return view('Admin.dashboard');
});

Route::resource('pelanggan', PelangganController::class);
Route::resource('barang', BarangController::class);
Route::resource('kendaraan', KendaraanController::class);
Route::resource('users', UserController::class)->except('show');
