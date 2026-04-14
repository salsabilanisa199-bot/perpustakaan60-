<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnggotaController;

// Halaman utama: redirect ke login
Route::get('/', function () {
    return view('login');
});



// Route untuk halaman login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Siswa Routes
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class.':siswa'])->group(function () {
    Route::get('/siswa/dashboard', [\App\Http\Controllers\SiswaDashboardController::class, 'index']);
    Route::post('/siswa/pinjam', [\App\Http\Controllers\SiswaDashboardController::class, 'pinjam'])->name('siswa.pinjam');
    Route::post('/siswa/kembalikan/{id}', [\App\Http\Controllers\SiswaDashboardController::class, 'kembalikan'])->name('siswa.kembalikan');
});

// Admin Routes
Route::middleware(['auth', \App\Http\Middleware\RoleMiddleware::class.':admin'])->group(function () {
    Route::get('/peminjaman', [PeminjamanController::class, 'index']);
    Route::post('/pinjam', [PeminjamanController::class, 'store']);
    Route::get('/laporan', [PeminjamanController::class, 'laporan']);

    Route::get('/anggota', [AnggotaController::class, 'index']);
    Route::post('/anggota', [AnggotaController::class, 'store']);

    Route::get('/buku', [\App\Http\Controllers\BukuController::class, 'index']);
    Route::post('/buku', [\App\Http\Controllers\BukuController::class, 'store']);
    Route::post('/peminjaman/{id}/kembali', [\App\Http\Controllers\PeminjamanController::class, 'kembalikan']);
});
