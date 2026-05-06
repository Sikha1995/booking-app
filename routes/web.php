<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\HotelManagementController;
use App\Http\Controllers\Web\RoomManagementController;
use App\Http\Controllers\Web\SearchPageController;
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
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/hotels', [HotelManagementController::class, 'index'])->name('hotels.index');
    Route::post('/hotels', [HotelManagementController::class, 'store'])->name('hotels.store');
    Route::get('/rooms', [RoomManagementController::class, 'index'])->name('rooms.index');
    Route::post('/rooms', [RoomManagementController::class, 'store'])->name('rooms.store');
    Route::get('/search', [SearchPageController::class, 'index'])->name('search.index');
    Route::post('/search', [SearchPageController::class, 'search'])->name('search.submit');
});
