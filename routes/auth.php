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

// Route Autentikasi API untuk pengguna guest (belum login)
Route::middleware('guest')->group(function () {
    Route::post('register', [RegisteredUserController::class, 'store'])->name('api.register');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('api.login');
    
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('api.password.email');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('api.password.reset'); // Ubah nama ini
});

// Route API untuk pengguna yang sudah login
Route::middleware('auth:api')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)->name('api.verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('api.verification.verify');
        
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('api.verification.send');
        
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('api.password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('api.password.update'); // Pastikan ini tetap sama
    
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('api.logout');
});
