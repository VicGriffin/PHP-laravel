<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', ProductController::class);

    Route::resource('sales', SaleController::class)->only(['index', 'create', 'store', 'show']);

    Route::resource('expenses', ExpenseController::class)->only(['index', 'store', 'destroy']);
});

require __DIR__.'/settings.php';
