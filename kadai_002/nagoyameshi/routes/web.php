<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\Auth\LoginController;

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
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth:admins');

Route::prefix('dashboard')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('dashboard.login');
    Route::post('login', [LoginController::class, 'login'])->name('dashboard.login');
    Route::resource('categories', CategoryController::class)->middleware('auth:admins');
});