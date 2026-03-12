<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('user')->middleware(['auth', 'role:user'])->name('user.')->controller(UserController::class)->group(function () {
    Route::get('index', 'index')->name('index');
    Route::get('detail/{id}', 'detail')->name('detail');
    Route::get('show/{id}/{type_id}', 'show')->name('show');

    // Add registered subject
    Route::get('add-subject', 'addSubject')->name('add_subject');
    Route::post('store-subject', 'storeSubject')->name('store_subject');

    // Edit student info
    Route::get('edit-student', 'editStudent')->name('edit_student');
    Route::put('update-student', 'updateStudent')->name('update_student');
});