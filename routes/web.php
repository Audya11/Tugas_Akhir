<?php

use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StaffController;
use App\Models\Staff;
use GuzzleHttp\Promise\Create;
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


Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/sesi', [SessionController::class, 'index'])->name('login')->middleware('guest');
Route::post('/sesi/login', [SessionController::class, 'login']);
Route::post('/sesi/logout', [SessionController::class, 'logout'])->middleware('auth');

// Login//

// Menampilkan form login

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// // Memproses data login
// Route::post('/login', [AuthController::class, 'login']);

// // Menampilkan form forgot password
// Route::get('/forgot_password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');

// // Memproses permintaan reset password
// Route::post('/forgot_password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
// Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    // Rute yang dilindungi middleware auth


Route::get('/daftar_sekolah', [SekolahController::class, 'index'])->name('sekolah.all');
Route::get('/sekolah/data', [SekolahController::class, 'getData'])->name('sekolah.data');
Route::get('/daftar_siswa', [SiswaController::class, 'index'])->name('siswa.all');
Route::get('/staff', [StaffController::class, 'index'])->name('staff.all');

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

// CRUD Staff
Route::get('/staff/create', [StaffController::class,'create']);
Route::post('/staff', [StaffController::class,'store'])->name('staff.store');
Route::get('/staff/{id}/edit', [StaffController::class,'edit']);
Route::put('/staff/{id}', [StaffController::class,'update'])->name('staff.update');
Route::delete('/staff/{id}', [StaffController::class,'destroy']);

// View Detail
Route::get('/daftar_sekolah/{id}/detail', [SekolahController::class, 'detail']);
Route::get('/daftar_siswa/{id}/detail', [SiswaController::class, 'detail']);
Route::get('/staff/{id}/detail', [StaffController::class, 'detail']);
});

// laporan dashboard
// Route::get('/dashboard', [DashboardController::class, 'index']);
// Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard.show');


