<?php

use App\Http\Controllers\api\AsetsController;
use App\Http\Controllers\api\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/aset/{id}', [AsetsController::class, 'get_aset_by_idBarcode']);
Route::get('/lihat-aset', [AsetsController::class, 'get_all_asets']);
Route::get('/lihat-gudang', [AsetsController::class, 'get_asets_gudang']);

Route::post('/tambah-aset', [AsetsController::class, 'tambah_aset']);
Route::put('/edit-aset/{id}', [AsetsController::class, 'edit_aset']);

Route::delete('/hapus-aset/{id}', [AsetsController::class, 'hapus_aset']);
Route::delete('/hapus-aset-permanen/{id}', [AsetsController::class, 'hapus_permanen_aset']);
Route::put('/restore-aset/{id}', [AsetsController::class, 'restore_aset']);
