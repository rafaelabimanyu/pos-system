<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PosController;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin' ? redirect('/dashboard') : redirect('/pos');
    }
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('inventory/products', ProductController::class);
    
    // Redirect /inventory to /inventory/products
    Route::get('/inventory', function () {
        return redirect()->route('products.index');
    })->name('inventory.index');
});

Route::middleware(['auth', 'role:cashier'])->group(function () {
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/checkout', [PosController::class, 'checkout'])->name('pos.checkout');
});

