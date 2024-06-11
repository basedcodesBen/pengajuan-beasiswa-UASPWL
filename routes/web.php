<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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

Route::middleware(['auth', 'role:admin'])->group(function (){

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


