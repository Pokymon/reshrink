<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
  Route::get('auth/register', [RegisteredUserController::class, 'create'])
    ->name('register');

  Route::post('auth/register', [RegisteredUserController::class, 'store']);

  Route::get('auth/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

  Route::post('auth/login', [AuthenticatedSessionController::class, 'store']);

  Route::get('auth/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

  Route::post('auth/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

  Route::get('auth/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

  Route::post('auth/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store');
});

Route::middleware('auth')->group(function () {
  Route::get('auth/verify-email', EmailVerificationPromptController::class)
    ->name('verification.notice');

  Route::get('auth/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

  Route::post('auth/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('verification.send');

  Route::get('auth/confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->name('password.confirm');

  Route::post('auth/confirm-password', [ConfirmablePasswordController::class, 'store']);

  Route::post('auth/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
});
