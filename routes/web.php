<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformationLabController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\JadwalController;


Route::get('/', [InformationLabController::class, 'index'])->name('information-lab.index');
Route::get('/api/jadwal-sekarang', [InformationLabController::class, 'getJadwalSekarang'])->name('jadwal.sekarang');

