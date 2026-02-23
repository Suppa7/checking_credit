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

Route::get('/home', function () {
    $user = Auth::user()->role;

    return match ($user) {
        'admin'   => redirect()->route('admin.index'),
        'user' => redirect()->route('user.index'),
    };
})->name('home');

include __DIR__ . '/admin.php';
include __DIR__ . '/user.php';

