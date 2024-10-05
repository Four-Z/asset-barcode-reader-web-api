<?php

use App\Http\Controllers\web\AsetsWebController;
use App\Http\Controllers\web\AuthWebController;
use App\Http\Controllers\web\BarcodeWebController;
use App\Http\Controllers\web\DashboardAdminController;
use App\Http\Controllers\web\LaporanWebController;
use App\Http\Controllers\web\PengadaanWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login-page');
});

Route::get('/login', [AuthWebController::class, 'login_page'])->name('login_page');
Route::post('/login', [AuthWebController::class, 'login'])->name('login');

Route::get('/home', [DashboardAdminController::class, 'home'])->name('home_page');

Route::get('/daftar-aset', [AsetsWebController::class, 'daftar_aset'])->name('daftar_aset_page');
Route::get('/detail-aset/{id}', [AsetsWebController::class, 'detail_aset'])->name('detail_aset_page');
Route::put('/edit-aset/{id}', [AsetsWebController::class, 'edit_aset'])->name('edit_aset');
Route::delete('/hapus-aset/{id}', [AsetsWebController::class, 'hapus_aset'])->name('hapus_aset');

Route::get('/gudang', [AsetsWebController::class, 'gudang'])->name('gudang_page');
Route::get('/gudang/klasifikasi-aset}', [AsetsWebController::class, 'klasifikasi_aset'])->name('klasifikasi_aset');
Route::put('/restore-aset/{id}', [AsetsWebController::class, 'restore_aset'])->name('restore_aset');
Route::delete('/hapus-aset-permanen/{id}', [AsetsWebController::class, 'hapus_aset_permanen'])->name('hapus_aset_permanen');

Route::get('/generate_barcode/{id}', [BarcodeWebController::class, 'generate_barcode'])->name('generate_barcode');

Route::get('/laporan-init', [LaporanWebController::class, 'laporan_init'])->name('laporan_init');
Route::get('/cetak-laporan', [LaporanWebController::class, 'cetak_laporan'])->name('cetak_laporan');
Route::get('/cetak-semua-aset', [LaporanWebController::class, 'cetak_semua_aset'])->name('cetak_semua_aset');
Route::get('/cetak-semua-aset-gudang', [LaporanWebController::class, 'cetak_semua_aset_gudang'])->name('cetak_semua_aset_gudang');
Route::post('/cetak-berdasarkan-kondisi', [LaporanWebController::class, 'cetak_aset_berdasarkan_kondisi'])->name('cetak_aset_berdasarkan_kondisi');

Route::get('/daftar-surat', [PengadaanWebController::class, 'daftar_surat_page'])->name('daftar_surat_page');
Route::get('/tambah-surat', [PengadaanWebController::class, 'tambah_surat_page'])->name('tambah_surat_page');
Route::post('/tambah-surat', [PengadaanWebController::class, 'tambah_surat'])->name('tambah_surat');
Route::delete('/hapus-surat/{id}', [PengadaanWebController::class, 'hapus_surat'])->name('hapus_surat');
Route::get('/cetak-surat/{id}', [PengadaanWebController::class, 'cetak_surat_pengadaan'])->name('cetak_surat_pengadaan');
