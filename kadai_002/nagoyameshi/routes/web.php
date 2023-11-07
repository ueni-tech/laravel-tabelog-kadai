<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard/login', [App\Http\Controllers\Dashboard\Auth\LoginController::class, 'showLoginForm'])->name('dashboard.login');
Route::post('/dashboard/login', [App\Http\Controllers\Dashboard\Auth\LoginController::class, 'login'])->name('dashboard.login');