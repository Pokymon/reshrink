<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
  return Inertia::render('welcome');
})->name('home');

Route::get('/{link:short_url}', [LinkController::class, 'show'])->name('links.show');

Route::middleware(['auth', 'verified'])->group(function () {
  Route::get('/my/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  Route::get('/my/links', [LinkController::class, 'index'])->name('links.index');
  Route::post('/my/links', [LinkController::class, 'store'])->name('links.store');
  Route::patch('/my/links/{link:id}', [LinkController::class, 'update'])->name('links.update');
  Route::delete('/my/links/{link:id}', [LinkController::class, 'destroy'])->name('links.destroy');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
