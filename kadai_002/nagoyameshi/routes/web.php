<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\RestaurantController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RestaurantController as mainRestaurantController;
use App\Http\Controllers\UserController as mainUserController;


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

// Route::get('/', function () {
//     $restaurants = Restaurant::all();
//     return view('index', compact('restaurants'));
// });

Route::get('/terms', function () {
    return view('terms');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth:admins')->name('dashboard.index');

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function() {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::resource('categories', CategoryController::class)->middleware('auth:admins');
    Route::resource('restaurants', RestaurantController::class)->middleware('auth:admins');
    Route::get('company', [CompanyController::class, 'index'])->middleware('auth:admins')->name('company.index');
    Route::put('company/{company}', [CompanyController::class, 'update'])->middleware('auth:admins')->name('company.update');
    Route::get('users', [UserController::class, 'index'])->middleware('auth:admins')->name('users.index');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('auth:admins')->name('users.destroy');
});

Route::get('/restaurants/{restaurant}', [App\Http\Controllers\RestaurantController::class, 'show'])->name('restaurants.show');

Route::get('/reservations/create/{restaurant}', [ReservationController::class, 'create'])->middleware('auth')->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->middleware('auth')->name('reservations.store');

Route::get('/reviews/{restaurant}', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/create/{restaurant}', [ReviewController::class, 'create'])->middleware('auth')->name('reviews.create');
Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');
Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
Route::get('/reviews/{review}/edit/{restaurant}', [ReviewController::class, 'edit'])->middleware('auth')->name('reviews.edit');
Route::put('/reviews/{review}', [ReviewController::class, 'update'])->middleware('auth')->name('reviews.update');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->middleware('auth')->name('reviews.destroy');

Route::get('restaurants/{restaurant}/favorite', [mainRestaurantController::class, 'favorite'])->middleware('auth')->name('restaurants.favorite');

Route::controller(mainUserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage');
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('user/mypage/reviews', 'reviews')->name('mypage.reviews');
    Route::get('user/mypage/favorite', 'favorite')->name('mypage.favorite');
    Route::delete('users/mypage/delete', 'destroy')->name('mypage.destroy');
});