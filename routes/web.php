<?php

use App\Models\Staff;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubclassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\SearchController;
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
Route::post('/sesi/login', [SessionController::class, 'onSchoolLogin'])->middleware('guest');
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
    Route::get('/change-password', [SekolahController::class, 'v_changePassword']);
    Route::put('/change-password', [SekolahController::class, 'changePassword'])->name('password.change');
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
    Route::get('/staff/create', [StaffController::class, 'create']);
    Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
    Route::get('/staff/{id}/edit', [StaffController::class, 'edit']);
    Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');
    Route::delete('/staff/{id}', [StaffController::class, 'destroy']);

    // View Detail
    Route::get('/daftar_sekolah/{id}/detail', [SekolahController::class, 'detail']);
    Route::get('/daftar_siswa/{id}/detail', [SiswaController::class, 'detail']);
    Route::get('/staff/{id}/detail', [StaffController::class, 'detail']);
});

// laporan dashboard
// Route::get('/dashboard', [DashboardController::class, 'index']);
// Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard.show');

Route::get('/school/login', [SessionController::class, 'schoolLogin'])->name('school.login');
Route::post('/school/login', [SessionController::class, 'onSchoolLogin'])->name('school.onLogin');

Route::group(['prefix' => 'school', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'schoolIndex'])->name('dashboard.show');

    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/change-password', [ProfileController::class, 'change_password']);

    Route::get('/dashboard/siswa', [SiswaController::class, ''])->name('student.all');

    Route::resource('/dashboard/academic-year', AcademicYearController::class);

    Route::resource('/dashboard/major', MajorController::class);

    Route::resource('/dashboard/class', ClassController::class);

    Route::resource('/dashboard/subclass', SubclassController::class);

    Route::resource('/dashboard/course', CourseController::class);

    Route::resource('/dashboard/teacher', TeacherController::class);

    Route::get('/dashboard/student', [SiswaController::class, 'schoolStudents']);
    Route::get('/dashboard/student/detail/{id}', [SiswaController::class, 'schoolStudentDetail']);
    Route::get('/dashboard/student/create', [SiswaController::class, 'schoolStudentCreate']);
    Route::post('/dashboard/student', [SiswaController::class, 'schoolStudentStore']);
    Route::get('/dashboard/student/{id}/edit', [SiswaController::class, 'schoolStudentEdit']);
    Route::put('/dashboard/student/{id}', [SiswaController::class, 'schoolStudentUpdate']);
    Route::delete('/dashboard/student/{id}', [SiswaController::class, 'schoolStudentDestroy']);

    Route::get('/dashboard/student/search', [SearchController::class, 'studentSearch'])->name('student.search');
    Route::get('/dashboard/year/search', [SearchController::class, 'yearSearch'])->name('academicYear.search');
    Route::get('/dashboard/majoric/search', [SearchController::class, 'majorSearch'])->name('major.search');
    Route::get('/dashboard/guru/search', [SearchController::class, 'teacherSearch'])->name('teacher.search');
    Route::get('/dashboard/kelas/search', [SearchController::class, 'kelasSearch'])->name('kelas.search');
    Route::get('/dashboard/subkelas/search', [SearchController::class, 'subClassSearch'])->name('subkelas.search');
    Route::get('/dashboard/mapel/search', [SearchController::class, 'courseSearch'])->name('course.search');

});
