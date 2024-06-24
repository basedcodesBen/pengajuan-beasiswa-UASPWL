<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;

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

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Role-based dashboard routes

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/welcome', [AdminController::class, 'welcome'])->name('admin.dashboard');
    Route::get('/admin/proposals', [AdminController::class, 'proposals'])->name('admin.proposals');
    Route::get('/admin/students', [AdminController::class, 'students'])->name('admin.students');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
});

Route::middleware(['auth', 'role:mahasiswa'])->group(function (){
    Route::get('/mahasiswa/dashboard',[MahasiswaController::class, 'welcome'])->name('mahasiswa.dashboard');
    Route::get('/mahasiswa/daftar-beasiswa',[MahasiswaController::class,'beasiswa'])->name('mahasiswa.beasiswa');
    Route::get('/mahasiswa/pengajuan/{id_beasiswa}',[MahasiswaController::class ,'validateInput']) ->name('pengajuan');
    Route::get('/mahasiswa/pengajuan-beasiswa/{id_beasiswa}',[MahasiswaController::class,'pengajuan'])->name('pengajuan.beasiswa');
    Route::post('/mahasiswa/input-pengajuan' , [MahasiswaController::class , 'store']) -> name('input.pengajuan');
    Route::get('/mahasiwa/edit-pengajuan-beasiswa/{id_beasiswa}', [MahasiswaController::class ,'validatePengajuan'])->name('edit.pengajuan.beasiswa');
    Route::get('/mahasiswa/edit-pengajuan-beasiswa/{id_beasiswa}',[MahasiswaController::class,'editPengajuan'])->name('edit.pengajuan');
    Route::put('mahasiswa/edit-pengajuan',[MahasiswaController::class,'update'])->name('update.pengajuan');
    Route::get('/mahasiswa/delete-pengajuan/{id_beasiswa}', [MahasiswaController::class, 'VerifyDestroy'])->name('delete.pengajuan.beasiswa');
    Route::delete('/mahasiswa/delete-pengajuan-beasiswa/{id_beasiswa}', [MahasiswaController::class ,'destroy'])->name('delete.pengajuan');
});

// Route::get('/', function () {
//     return view('pages/login/login-page');
// });

// Route::get('/', function () {
//     return view('pages/login/login-page');
// });

// Route::get('/admin-page', function () {
//     return view('pages/admin/index-admin');
// });


