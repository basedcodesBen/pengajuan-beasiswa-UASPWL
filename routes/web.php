<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('pages/login/login-page');
});

Route::get('/admin-page', function () {
    return view('pages/admin/index-admin');
});

Route::get('/admin/welcome', [AdminController::class, 'welcome'])->name('admin.welcome');
Route::get('/admin/proposals', [AdminController::class, 'proposals'])->name('admin.proposals');
Route::get('/admin/students', [AdminController::class, 'students'])->name('admin.students');
Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');