<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlController;
use App\Models\Url;
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

Route::get('/', function () {
    $user = auth()->user();
    $urls = Url::where('user_id', $user->id);
    if (request()->has('search')) {
        $urls = $urls->where('url', 'like', '%' . request()->search . '%')
            ->orWhere('code', 'like', '%' . request()->search . '%');
    }
    $urls = $urls->latest()->paginate(10);
    return view('dashboard', compact('user', 'urls'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/urls', UrlController::class)->middleware('auth');
Route::get('/{code}', [UrlController::class, 'show'])->name('urls.show');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/user/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/user/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
