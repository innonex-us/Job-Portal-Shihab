<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZipcodeController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\BackgroundCheckController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

// Debug routes
Route::get('/debug', [App\Http\Controllers\DebugController::class, 'index'])->name('debug.index');
Route::post('/debug/session', [App\Http\Controllers\DebugController::class, 'testSession'])->name('debug.session');

// Public routes
Route::get('/', [ZipcodeController::class, 'index'])->name('zipcode.index');
Route::post('/zipcode', [ZipcodeController::class, 'store'])->name('zipcode.store');
Route::get('/user-info', [UserProfileController::class, 'index'])->name('user-info.index');
Route::post('/user-info', [UserProfileController::class, 'store'])->name('user-info.store');
Route::get('/background-check', [BackgroundCheckController::class, 'index'])->name('background-check.index');
Route::post('/background-check/verify', [BackgroundCheckController::class, 'verify'])->name('background-check.verify');

// Auth routes
Route::prefix('bd/system')->group(function () {
    Auth::routes([
        'register' => false, // Disable registration
        'reset' => false,    // Disable password reset
        'verify' => false,   // Disable email verification
    ]);
});

// Admin routes
Route::prefix('bd/system/admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
