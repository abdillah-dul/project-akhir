<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Guest.home');
});

Route::get('/admin', function () {
    return view('Admin.dashboard');
});