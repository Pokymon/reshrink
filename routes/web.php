<?php

use App\Http\Controllers\DomainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlController;
use App\Models\Url;
use Illuminate\Http\Request;
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
    return view('welcome');
})->name('welcome');

Route::post('/', function (Request $request) {
    $request->validate([
        'url' => 'required|url',
    ]);

    try {
        $url = new Url();
        $code = $url->generateCode();

        $url->url = $request->url;
        $url->code = $code;
        $url->domain_id = 1;
        $url->user_id = 1;
        $url->save();

        // Construct the shortened URL
        $shortenedUrl = url('/') . '/' . $code;

        // Flash a success message and the shortened URL to the session
        session()->flash('success', 'URL created successfully!');
        session()->flash('shortenedUrl', $shortenedUrl);

    } catch (Exception $e) {
        // Flash an error message to the session
        session()->flash('error', 'Failed to create URL: ' . $e->getMessage());
    }

    return redirect()->route('welcome');
})->name('welcome.store');

Route::get('/dashboard', function () {
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
