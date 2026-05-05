<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/pos');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/pos', function () {
    return view('pos.index');
})->name('pos.index');

Route::get('/inventory', function () {
    return view('inventory.index');
})->name('inventory.index');

