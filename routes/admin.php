<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\SubmajorController;
use App\Http\Controllers\CurriculumSubjectController;
use App\Http\Controllers\SubjectTypeController;
use App\Http\Controllers\SubjectOwnController;
use App\Http\Controllers\SubjectCategoryController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('subjects', SubjectController::class);
    Route::resource('curriculums', CurriculumController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('submajors', SubmajorController::class);
    Route::resource('curriculum-subjects', CurriculumSubjectController::class)->parameters(['curriculum-subjects' => 'curriculum_subject'])->names('curriculum_subjects');
    Route::resource('subject-types', SubjectTypeController::class)->parameters(['subject-types' => 'subject_type'])->names('subject_types');
    Route::resource('subject-owns', SubjectOwnController::class)->parameters(['subject-owns' => 'subject_own'])->names('subject_owns');
    Route::resource('subject-categories', SubjectCategoryController::class)->parameters(['subject-categories' => 'subject_category'])->names('subject_categories');
});
