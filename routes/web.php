<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\FakultasController;

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
    Route::post('pengajuan/{id}/approve', [PengajuanController::class, 'approve'])->name('pengajuan.approve');
    Route::post('pengajuan/{id}/reject', [PengajuanController::class, 'reject'])->name('pengajuan.reject');
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
Route::middleware(['auth', 'role:prodi'])->group(function (){
    // Route::resource('prodi', ProdiController::class);
    Route::get('/prodi/dashboard', [ProdiController::class, 'dashboard'])->name('prodi.dashboard');
    Route::post('pengajuan/{id}/approve', [PengajuanController::class, 'approve'])->name('pengajuan.approve');
    Route::post('pengajuan/{id}/reject', [PengajuanController::class, 'reject'])->name('pengajuan.reject');
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
