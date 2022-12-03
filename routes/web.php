<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\User\UserDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/login', [UserLoginController::class, 'index'])->name('user.login.form');
Route::post('/login-store', [UserLoginController::class, 'login'])->name('user.login.store');
Route::post('/user-logout', [UserLoginController::class, 'logout'])->name('user.logout');

Route::prefix('user')->middleware(['auth'])->group(function(){
    // Dashboard
    Route::get('/dashboard',[UserDashboardController::class, 'index'])->name('user.dashboard');
});




Route::get('/admin-login', [AdminLoginController::class, 'index'])->name('admin.login.form');
Route::post('/admin-login/store', [AdminLoginController::class, 'login'])->name('admin.login.store');
Route::post('/admin-logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware(['admin'])->group(function(){
    // Dashboard
    Route::get('/dashboard',[AdminDashboardController::class, 'index'])->name('admin.dashboard');
});
