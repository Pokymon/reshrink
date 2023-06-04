<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/user/register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('/user/register', [RegisteredUserController::class, 'store']);

    Route::get('/user/login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('/user/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/user/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('/user/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('/user/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('/user/reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/user/verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('/user/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('/user/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('/user/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('/user/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('/user/password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('/user/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
