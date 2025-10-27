<?php

use App\Http\Controllers\Content\PortalController;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

Route::get('/', [PortalController::class, 'login'])->name('index');
Route::post('/login', [PortalController::class, 'logindb'])->name('logindb');





