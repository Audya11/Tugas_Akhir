<?php

use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('admin.layouts.default');
});

// Login//

// Menampilkan form login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Memproses data login
Route::post('/login', [AuthController::class, 'login']);

// Menampilkan form forgot password
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');

// Memproses permintaan reset password
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::get('/daftar_sekolah', [SekolahController::class, 'index'])->name('sekolah.all');
Route::get('/sekolah/data', [SekolahController::class, 'getData'])->name('sekolah.data');
Route::get('/daftar_siswa', [SiswaController::class, 'index'])->name('siswa.all');
// CRUD Daftar Sekolah
Route::get('/daftar_sekolah/create', [SekolahController::class, 'create']);
Route::post('/daftar_sekolah', [SekolahController::class, 'store'])->name('sekolah.store');
Route::get('/daftar_sekolah/{id}/edit', [SekolahController::class, 'edit']);
Route::put('/daftar_sekolah/{id}', [SekolahController::class, 'update'])->name('sekolah.update');
Route::delete('/daftar_sekolah/{id}', [SekolahController::class, 'destroy']);

// CRUD Daftar Siswa
Route::get('/daftar_siswa/create', [SiswaController::class, 'create']);
Route::post('/daftar_siswa', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('/daftar_siswa/{id}/edit', [SiswaController::class, 'edit']);
Route::put('/daftar_siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/daftar_siswa/{id}', [SiswaController::class, 'destroy']);

// View Detail
Route::get('/daftar_sekolah/{id}/detail', [SekolahController::class, 'detail']);
Route::get('/daftar_siswa/{id}/detail', [SiswaController::class, 'detail']);

// laporan dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);
// Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard.show');


