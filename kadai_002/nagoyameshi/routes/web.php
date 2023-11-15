<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\RestaurantController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\UserController;

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

Route::get('/terms', function () {
    return view('terms');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth:admins')->name('dashboard.index');

// Route::prefix('dashboard')->group(function () {
//     Route::get('login', [LoginController::class, 'showLoginForm'])->name('dashboard.login');
//     Route::post('login', [LoginController::class, 'login'])->name('dashboard.login');
//     Route::resource('categories', CategoryController::class)->middleware('auth:admins');
//     Route::resource('restaurants', RestaurantController::class)->as('dashboard.restaurants')->middleware('auth:admins');
// });

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function() {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::resource('categories', CategoryController::class)->middleware('auth:admins');
    Route::resource('restaurants', RestaurantController::class)->middleware('auth:admins');
    // CompanyControllerのindexアクションとupdateアクションのルーティングのみを追加
    Route::get('company', [CompanyController::class, 'index'])->middleware('auth:admins')->name('company.index');
    Route::put('company/{company}', [CompanyController::class, 'update'])->middleware('auth:admins')->name('company.update');
    Route::get('users', [UserController::class, 'index'])->middleware('auth:admins')->name('users.index');
    Route::post('users/{user}', [UserController::class, 'destroy'])->middleware('auth:admins')->name('users.destroy');
});