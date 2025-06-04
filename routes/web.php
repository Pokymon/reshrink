<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
  return Inertia::render('welcome');
})->name('home');

Route::get('/@{link}', [LinkController::class, 'show'])->name('links.show');

Route::middleware(['auth', 'verified'])->group(function () {
  Route::get('/dashboard', [LinkController::class, 'index'])->name('dashboard');
  Route::post('/links', [LinkController::class, 'store'])->name('links.store');
  Route::put('/links/{link:id}', [LinkController::class, 'update'])->name('links.update');
  Route::delete('/links/{link:id}', [LinkController::class, 'destroy'])->name('links.destroy');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
