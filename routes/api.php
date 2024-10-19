<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\ApiAuthContoller;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainFolderController;
use App\Http\Controllers\SubFolderController;
use Illuminate\Support\Facades\Route;

/*
|---------------------------------------------------------------------------
| API Routes
|---------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Make something great!
|
*/



// Route Autentikasi API untuk pengguna guest (belum login)
Route::middleware('guest')->group(function () {
    Route::post('register', [RegisteredUserController::class, 'store'])->name('api.register');
    Route::post('login', [ApiAuthContoller::class, 'login'])->name('api.login');
    
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('api.password.email');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('api.password.update');
});

// Route API untuk pengguna yang sudah login
Route::middleware('auth:api')->group(function () {
    Route::get('dashboard',[DashboardController::class,'index'])->name('api.index');
    Route::post('/create-folder',[DashboardController::class,'create'])->name('api.create-main');
    Route::post('/save-link-folder',[DashboardController::class,'saveLink'])->name('api.create-link-sub');
    //main index folder
    Route::get('/{folderName}/{id}',[MainFolderController::class,'getsubFolderData'])->name('api.getFolderData');
    Route::post('/create-sub-folder',[MainFolderController::class,'createSub'])->name('api.createSub');
    
    // sub folder
    Route::get('/subfolder/{subFolderName}/{id}',[SubFolderController::class,'getNextsubFolderData'])->name('api.SubGetFolderData');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('api.logout');
});
