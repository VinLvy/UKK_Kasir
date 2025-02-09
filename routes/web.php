<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\KategoriBarangController;
use App\Http\Controllers\Admin\ItemBarangController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\Kasir\PembelianController;
use App\Http\Controllers\Kasir\MemberController;
use App\Http\Controllers\Kasir\RiwayatController;
use App\Http\Controllers\Kasir\BarangController;
use App\Models\ActivityLog;

// Redirect ke halaman login saat mengakses root URL
Route::get('/', function () {
    return redirect()->route('login');
});

// Halaman login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk admin
Route::middleware(['auth', 'role:administrator'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('petugas', PetugasController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
    Route::resource('kategori', KategoriBarangController::class);
    Route::resource('barang', ItemBarangController::class);
    Route::resource('logs', ActivityLogController::class);
});

// Route untuk kasir
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/dashboard', [KasirController::class, 'dashboard'])->name('dashboard');
    Route::get('pembelian', [PembelianController::class, 'create'])->name('pembelian.index');
    Route::post('pembelian', [PembelianController::class, 'store'])->name('pembelian.store');
    Route::resource('member', MemberController::class);
    Route::resource('riwayat', RiwayatController::class);
    Route::resource('barang', BarangController::class);
});