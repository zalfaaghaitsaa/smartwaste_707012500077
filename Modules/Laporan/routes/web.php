<?php

use Illuminate\Support\Facades\Route;
use Modules\Laporan\Http\Controllers\LaporanController;

Route::middleware('auth')->group(function () {

    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');

    Route::middleware('role:admin')->group(function () {
        Route::get('laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
    });

    Route::post('laporan', [LaporanController::class, 'store'])->name('laporan.store');
});
