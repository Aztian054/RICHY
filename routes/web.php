<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SpjController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengaturanController;

/*
|--------------------------------------------------------------------------
| Web Routes — Role-Based Access Control
|--------------------------------------------------------------------------
|
| Level 1 = Super Admin   (full access)
| Level 2 = Admin         (full access minus super admin privileges)
| Level 3 = Kabid         (approval SPJ + disposisi kirim)
| Level 4 = Kasubbag      (terima disposisi + input data)
| Level 5 = Verifikator   (verifikasi SPJ only)
| Level 6 = Pegawai       (input & pengajuan only)
|
*/

// ===== AUTH ROUTES =====
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ===== PROTECTED ROUTES =====
Route::middleware('auth')->group(function () {

    // Redirect root to dashboard
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    // ========== DASHBOARD (ALL ROLES) ==========
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/api/dashboard/stats', [DashboardController::class, 'stats'])->name('dashboard.stats');

    // ========== SPJ KEUANGAN ==========
    // Buat & lihat: semua role bisa. Approve/reject: hanya level <= 3 (Super Admin, Admin, Kabid)
    Route::prefix('spj')->name('spj.')->group(function () {
        Route::get('/', [SpjController::class, 'index'])->name('index');
        Route::get('/create', [SpjController::class, 'create'])->name('create');
        Route::post('/', [SpjController::class, 'store'])->name('store');
        Route::get('/{id}', [SpjController::class, 'show'])->name('show');
        Route::put('/{id}', [SpjController::class, 'update'])->name('update');
        // Approve/reject: hanya level 1-3
        Route::post('/{id}/approve', [SpjController::class, 'approve'])->name('approve')->middleware('role:1,2,3');
        Route::post('/{id}/reject', [SpjController::class, 'reject'])->name('reject')->middleware('role:1,2,3');
        // Verifikasi: level 1,2,5 (Super Admin, Admin, Verifikator)
        Route::post('/{id}/verify', [SpjController::class, 'verify'])->name('verify')->middleware('role:1,2,5');
    });

    // ========== SURAT & DISPOSISI ==========
    Route::prefix('surat')->name('surat.')->group(function () {
        Route::get('/', [SuratController::class, 'index'])->name('index');
        Route::post('/masuk', [SuratController::class, 'storeMasuk'])->name('store.masuk');
        Route::post('/keluar', [SuratController::class, 'storeKeluar'])->name('store.keluar');
        Route::get('/masuk/{id}', [SuratController::class, 'showMasuk'])->name('show.masuk');
        // Disposisi: hanya level 1-4 (Super Admin, Admin, Kabid, Kasubbag)
        Route::post('/{id}/disposisi', [SuratController::class, 'disposisi'])->name('disposisi')->middleware('role:1,2,3,4');
    });

    // ========== KEPEGAWAIAN ==========
    Route::prefix('pegawai')->name('pegawai.')->group(function () {
        Route::get('/', [PegawaiController::class, 'index'])->name('index');
        // Tambah pegawai: level 1-3
        Route::post('/', [PegawaiController::class, 'store'])->name('store')->middleware('role:1,2,3');
        Route::get('/{id}', [PegawaiController::class, 'show'])->name('show');
        Route::put('/{id}', [PegawaiController::class, 'update'])->name('update')->middleware('role:1,2,3');
        // Approve pegawai baru: level 1-3
        Route::post('/{id}/approve', [PegawaiController::class, 'approve'])->name('approve')->middleware('role:1,2,3');
    });

    // ========== ARSIP DIGITAL ==========
    Route::prefix('arsip')->name('arsip.')->group(function () {
        Route::get('/', [ArsipController::class, 'index'])->name('index');
        Route::post('/', [ArsipController::class, 'store'])->name('store');
        Route::get('/{id}/download', [ArsipController::class, 'download'])->name('download');
        // Hapus arsip: hanya level 1-2
        Route::delete('/{id}', [ArsipController::class, 'destroy'])->name('destroy')->middleware('role:1,2');
    });

    // ========== LAPORAN ==========
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // ========== ANGGARAN ==========
    Route::prefix('anggaran')->name('anggaran.')->group(function () {
        Route::get('/', [AnggaranController::class, 'index'])->name('index');
        // Input anggaran: level 1-3
        Route::post('/', [AnggaranController::class, 'store'])->name('store')->middleware('role:1,2,3');
        Route::get('/chart-data', [AnggaranController::class, 'chartData'])->name('chart.data');
    });

    // ========== ABSENSI ==========
    Route::prefix('absensi')->name('absensi.')->group(function () {
        Route::get('/', [AbsensiController::class, 'index'])->name('index');
        Route::post('/', [AbsensiController::class, 'store'])->name('store');
    });

    // ========== PROFILE ==========
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::put('/password', [ProfileController::class, 'changePassword'])->name('password');
    });

    // ========== PENGATURAN (Level 1-2 ONLY) ==========
    Route::prefix('pengaturan')->name('pengaturan.')->group(function () {
        Route::get('/', [PengaturanController::class, 'index'])->name('index')->middleware('role:1,2');
        Route::put('/', [PengaturanController::class, 'update'])->name('update')->middleware('role:1,2');
    });
});