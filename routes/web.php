<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

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
Route::resource('/', HomeController::class)->only(['index', 'store']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::resource('/urls', UrlController::class)->middleware('auth');
Route::resource('/domains', DomainController::class)->middleware('auth');

Route::get('/{code}', [UrlController::class, 'showHost'])->name('urls.showHost');

Route::domain('{domain}')->group(function () {
    Route::get('/{code}', [UrlController::class, 'show'])->name('urls.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/user/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
