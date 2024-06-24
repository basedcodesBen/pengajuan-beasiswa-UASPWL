<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\PengajuanProdiController;
use App\Http\Controllers\PengajuanFakultasController;

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
// Route::get('/prodi/dashboard', [ProdiController::class, 'dashboard'])->name('prodi.dashboard');

Route::middleware(['auth', 'role:fakultas'])->group(function(){
    Route::get('/fakultas/pengajuan', [PengajuanFakultasController::class, 'index'])->name('fakultas.pengajuan.index');
    Route::post('/fakultas/pengajuan/{id_user}/{id_beasiswa}/{id_periode}/approve', [PengajuanFakultasController::class, 'approve'])->name('fakultas.pengajuan.approve');
    Route::post('/fakultas/pengajuan/{id_user}/{id_beasiswa}/{id_periode}/reject', [PengajuanFakultasController::class, 'reject'])->name('fakultas.pengajuan.reject');
});

Route::middleware(['auth', 'role:prodi'])->group(function (){
    // Route::resource('prodi', ProdiController::class);
    Route::get('/prodi/dashboard', [ProdiController::class, 'dashboard'])->name('prodi.dashboard');
    Route::get('/prodi/pengajuan', [PengajuanProdiController::class, 'index'])->name('prodi.pengajuan.index');
    Route::get('/prodi/pengajuan/{periode_id}/select-beasiswa', [PengajuanProdiController::class, 'selectBeasiswa'])->name('prodi.pengajuan.select-beasiswa');
    Route::get('/prodi/pengajuan/{periode_id}/{beasiswa_id}/show', [PengajuanProdiController::class, 'showPengajuan'])->name('prodi.pengajuan.show');
    Route::post('/prodi/pengajuan/{id_user}/{id_beasiswa}/{id_periode}/approve', [PengajuanProdiController::class, 'approve'])->name('prodi.pengajuan.approve');
    Route::post('/prodi/pengajuan/{id_user}/{id_beasiswa}/{id_periode}/reject', [PengajuanProdiController::class, 'reject'])->name('prodi.pengajuan.reject');
});

// Role-based dashboard routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/welcome', [AdminController::class, 'welcome'])->name('admin.dashboard');

    // CRUD for Users
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

    // CRUD for Fakultas
    Route::resource('fakultas', FakultasController::class);

    // CRUD for Prodi
    Route::resource('prodi', ProdiController::class);
});


Route::middleware(['auth', 'role:mahasiswa'])->get('/user/dashboard', function () {
    return view('user.mahasiswa');
})->name('user.dashboard');
