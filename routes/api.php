<?php

use App\Http\Controllers\Api\AlmtController;
use Illuminate\Support\Facades\Route;


Route::prefix('almt')->group(function () {
    Route::get('provinsi', [AlmtController::class, 'provinsi'])
        ->name('api.almt.provinsi');
    Route::get('kabupaten/{id}', [AlmtController::class, 'kabupaten'])
        ->name('api.almt.kabupaten')
        ->whereNumber('id');
    Route::get('kecamatan/{id}', [AlmtController::class, 'kecamatan'])
        ->name('api.almt.kecamatan')
        ->whereNumber('id');
    Route::get('desa/{id}', [AlmtController::class, 'desa'])
        ->name('api.almt.desa')
        ->whereNumber('id');
});
