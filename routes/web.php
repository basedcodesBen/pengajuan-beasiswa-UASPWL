<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdiController;

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
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware(['auth', 'role:prodi'])->group(function (){
    Route::get('/prodi/welcome', [ProdiController::class, 'welcome'])->name('prodi.dashboard');
});

Route::middleware(['auth', 'role:user'])->get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');


// Route::get('/', function () {
//     return view('pages/login/login-page');
// });

// Route::get('/', function () {
//     return view('pages/login/login-page');
// });

// Route::get('/admin-page', function () {
//     return view('pages/admin/index-admin');
// });
