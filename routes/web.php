<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/login', [LoginController::class, 'redirectTo'])->name('login');

Route::get('/forgot-password', [App\Http\Controllers\Auth\CustomResetPasswordController::class, 'showResetForm'])->name('custom.password.request');
Route::post('/forgot-password/verify', [App\Http\Controllers\Auth\CustomResetPasswordController::class, 'verifyStudent'])->name('custom.password.verify');
Route::get('/forgot-password/reset', [App\Http\Controllers\Auth\CustomResetPasswordController::class, 'showNewPasswordForm'])->name('custom.password.reset_form');
Route::post('/forgot-password/reset', [App\Http\Controllers\Auth\CustomResetPasswordController::class, 'reset'])->name('custom.password.update');

Route::get('/home', function () {
    $user = Auth::user()->role;

    return match ($user) {
        'admin'   => redirect()->route('admin.index'),
        'user' => redirect()->route('user.index'),
    };
})->name('home');

include __DIR__ . '/admin.php';
include __DIR__ . '/user.php';

