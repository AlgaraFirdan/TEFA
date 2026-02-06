<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformationLabController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AuthController;


Route::get('/', [InformationLabController::class, 'index'])->name('information-lab.index');
Route::get('/api/jadwal-sekarang', [InformationLabController::class, 'getJadwalSekarang'])->name('jadwal.sekarang');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes (Protected by Auth Middleware)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/preview', [InformationLabController::class, 'preview'])->name('preview');
    Route::resource('guru', GuruController::class);
    Route::resource('ruangan', RuanganController::class);
    Route::resource('mapel', MapelController::class);
    Route::resource('jadwal', JadwalController::class);
});

