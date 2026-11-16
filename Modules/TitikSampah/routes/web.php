<?php

use Illuminate\Support\Facades\Route; 
use Modules\TitikSampah\Http\Controllers\TitikSampahController;

Route::middleware('auth')->group(function () {

    Route::get('fasilitas', [TitikSampahController::class, 'index'])->name('titik_sampahs.index');

    Route::middleware('role:warga')->group(function () {
        Route::get('titik_sampahs/create', [TitikSampahController::class, 'create'])->name('titik_sampahs.create');
        Route::post('titik_sampahs', [TitikSampahController::class, 'store'])->name('titik_sampahs.store');
        Route::get('titik_sampahs/{titik_sampahs}/edit', [TitikSampahController::class, 'edit'])->name('titik_sampahs.edit');
        Route::put('titik_sampahs/{titik_sampahs}', [TitikSampahController::class, 'update'])->name('titik_sampahs.update');
        Route::delete('titik_sampahs/{titik_sampahs}', [TitikSampahController::class, 'destroy'])->name('titik_sampahs.destroy');
    });
});
